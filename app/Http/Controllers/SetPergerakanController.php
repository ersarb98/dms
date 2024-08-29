<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JobContainer;
use App\Models\JobOperation;
use Illuminate\Support\Facades\Log;

class SetPergerakanController extends Controller
{
    public function index()
    {
        return view('pergerakan.set_pergerakan');
    }
    public function search(Request $request)
    {
        $containerNumber = $request->input('containerNumber');

        // Raw SQL for ROW_NUMBER() subquery
        $subquery = DB::table('t_job_operation')
            ->select('*', DB::raw('ROW_NUMBER() OVER (PARTITION BY id_job_container ORDER BY created_at DESC) as rn'))
            ->toSql();

        // Main query
        $operations = DB::table('t_job_hdr as A')
            ->join('t_job_container as B', 'A.id', '=', 'B.id_job_hdr')
            ->join(DB::raw("($subquery) as C"), 'B.id', '=', 'C.id_job_container')
            ->where('C.rn', 1)
            ->where('A.status', 'Pending')
            ->where('C.status', 'done')
            ->where('B.no_cont', $containerNumber)
            ->select('A.*', 'B.id as container_id', 'B.no_cont', 'C.*') // Alias columns to avoid conflicts
            ->get()
            ->map(function ($operation) {
                // Manually map to a custom structure or object
                return (object) [
                    'id' => $operation->id,
                    'nomor_order' => $operation->nomor_order,
                    'container_id' => $operation->container_id,
                    'no_cont' => $operation->no_cont,
                    'jenis_job' => $operation->jenis_job,
                    'status' => $operation->status,
                ];
            });

        return view('pergerakan.set_pergerakan', compact('operations'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'containerId' => 'required',
            'containerNumber' => 'required|string',
            'jenis_job' => 'required|string',
            'lokasi_akhir' => 'required|string',
            'tier_akhir' => 'required|string',
        ]);


        try {
            // Extract validated data
            $containerId = $validated['containerId'];
            $containerNumber = $validated['containerNumber'];
            $jenisJob = $validated['jenis_job'];
            $lokasiAkhir = $validated['lokasi_akhir'];
            $tierAkhir = $validated['tier_akhir'];

            // Create a new JobOperation entry
            JobOperation::create([
                'id_job_container' => $containerId,
                'no_cont' => $containerNumber,
                'wk_status_created' => now(),
                'jenis_job' => $jenisJob,
                'lokasi_akhir' => $lokasiAkhir,
                'tier_akhir' => $tierAkhir,
                'status' => 'Pending', // Or any default status you need
            ]);

            return redirect()->route('setpergerakan.index')->with('success', 'Job created successfully.');
        } catch (\Exception $e) {
            // Log the error and redirect back with an error message
            Log::error('Failed to create job operation: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to create job. Please try again.');
        }
    }
}

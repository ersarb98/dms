<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\JobOperation;
use Illuminate\Support\Carbon;
class SetRealisasiController extends Controller
{
    public function index()
    {
        return view('pergerakan.set_realisasi');
    }

    public function search(Request $request)
    {
        $containerNumber = $request->input('containerNumber');


        // SQL query using Laravel's DB facade
        $operations = DB::select("
            SELECT * 
            FROM t_job_hdr A
            JOIN t_job_container B ON A.id = B.id_job_hdr
            JOIN (
                SELECT *, ROW_NUMBER() OVER (PARTITION BY id_job_container ORDER BY created_at DESC) AS rn
                FROM t_job_operation
            ) C ON B.id = C.id_job_container
            WHERE C.rn = 1 
              AND A.status = 'Pending'
              AND C.status = 'Pending'
              AND B.no_cont = ?
        ", [$containerNumber]);

        $operations = collect($operations);
        // dd($operations);
        return view('pergerakan.set_realisasi', compact('operations'));
    }

    public function store(Request $request)
    {
        // Validate the request
        $request->validate([
            'containerId' => 'required|exists:t_job_operation,id',
        ]);

        // Retrieve the JobOperation instance using the containerId
        $jobOperation = JobOperation::where('id', $request->input('containerId'))->first();

        if ($jobOperation) {
            // Update the status to 'done' and set wk_status_done to current timestamp
            $jobOperation->status = 'done';
            $jobOperation->wk_status_done = Carbon::now();

            // Save the updated JobOperation
            $jobOperation->save();

            // Redirect back with a success message
            return redirect()->route('setrealisasi.index')->with('success', 'Realisasi has been set successfully.');
        }

        // If no matching JobOperation is found, redirect with an error message
        return redirect()->route('setrealisasi.index')->with('error', 'Job operation not found.');
    }
}

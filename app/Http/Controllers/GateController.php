<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\JobOperation;
use Carbon\Carbon;

class GateController extends Controller
{
    public function index()
    {
        return view('gate.gatein');
    }

    public function search(Request $request)
    {
        $containerNumber = $request->input('containerNumber');

        // Query to find the matching job operation
        $jobOperations = JobOperation::where('no_cont', $containerNumber)
            ->where('jenis_job', 'AWAITING_GATE_IN')
            ->where('status', 'pending')
            ->get();

        return view('gate.gatein', [
            'jobOperations' => $jobOperations,
            'containerNumber' => $containerNumber,
        ]);
    }
    public function setGateIn($id)
    {
        $jobOperation = JobOperation::findOrFail($id);
        $jobOperation->status = 'done';
        $jobOperation->wk_status_done = Carbon::now(); // Set the current time
        $jobOperation->save();

        return redirect()->route('operation.index')->with('success', 'Gate In sukses.');
    }

    public function gateout()
    {
        return view('gate.gateout');
    }
    public function outsearch(Request $request)
    {
        $containerNumber = $request->input('containerNumber');

        // Query to find the matching job operation
        $jobOperations = JobOperation::where('no_cont', $containerNumber)
            ->where('jenis_job', 'INSPECTION')
            ->where('status', 'done')
            ->get();

        return view('gate.gateout', [
            'jobOperations' => $jobOperations,
            'containerNumber' => $containerNumber,
        ]);
    }
    public function setGateOut($id)
    {
        $jobOperation = JobOperation::findOrFail($id);

        $id = $jobOperation->id;
        $idJobContainer = $jobOperation->id_job_container;
        $no_cont = $jobOperation->no_cont;


        $jobOperation = JobOperation::create([
            'id_job_container' => $idJobContainer,
            'no_cont' => $no_cont,
            'jenis_job' => "GATE OUT",
            'wk_status_created' => now(),
            'lokasi_awal' => null,
            'tier_awal' => null,
            'lokasi_akhir' => null,
            'tier_akhir' => null,
            'status' => "done",
            'wk_status_done' => now(),
        ]);


        return redirect()->route('gate.out')->with('success', 'Set Gate Out sukses.');
    }
}

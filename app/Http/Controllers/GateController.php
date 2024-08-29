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
}

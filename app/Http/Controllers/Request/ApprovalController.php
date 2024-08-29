<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Models\OrderReceivingDtl;
use App\Models\OrderReceivingHdr;
use App\Models\JobHdr;
use App\Models\JobContainer;
use App\Models\JobOperation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApprovalController extends Controller

{
    public function index()
    {
        // Fetch all records with status 'N'
        $orders = OrderReceivingHdr::where('status', 'N')->get();

        // Pass the data to the view
        return view('request.approvalreceiving', compact('orders'));
    }
    // Approve the order
    public function approve($id)
    {
        DB::transaction(function () use ($id) {
            // Find and approve the order
            $order = OrderReceivingHdr::findOrFail($id);
            $order->status = 'Y'; // Update status to 'Approved'
            $order->save();

            // Insert into t_job_hdr
            $jobHdr = JobHdr::create([
                'jenis' => 'RECEIVING', // or another appropriate field
                'nomor_order' => $order->order_number,
                'status' => 'Pending', // or another appropriate status
            ]);

            // Find related containers in t_order_receiving_dtl using order_receiving_hdr_id
            $containers = OrderReceivingDtl::where('order_receiving_hdr_id', $id)->get();

            // Insert into t_job_container and t_job_operation
            foreach ($containers as $container) {
                // Insert into t_job_container
                $jobContainer = JobContainer::create([
                    'id_job_hdr' => $jobHdr->id,
                    'no_cont' => $container->no_cont,
                    'size' => $container->size,
                    'type_cont' => $container->type,
                ]);

                // Insert the first job into t_job_operation
                JobOperation::create([
                    'id_job_container' => $jobContainer->id,
                    'no_cont' => $container->no_cont,
                    'jenis_job' => 'AWAITING_GATE_IN', // or another appropriate value
                    'wk_status_created' => now(),
                    'status' => 'Pending', // or another appropriate status
                ]);
            }
        });

        return redirect()->route('approval.index')->with('success', 'Order approved and job created successfully.');
    }

    // Reject the order
    public function reject($id)
    {
        $order = OrderReceivingHdr::findOrFail($id);
        $order->status = 'X'; // Update status to 'Rejected'
        $order->save();

        return redirect()->route('approval.index')->with('success', 'Order rejected successfully.');
    }
}

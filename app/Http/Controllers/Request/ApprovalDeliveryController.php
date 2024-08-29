<?php

namespace App\Http\Controllers\Request;

use App\Models\OrderDeliveryHdr;
use App\Models\JobHdr;
use App\Http\Controllers\Controller;
use App\Models\OrderDeliveryDtl;
use App\Models\JobContainer;
use App\Models\JobOperation;
use Illuminate\Http\Request;

class ApprovalDeliveryController extends Controller
{
    public function index()
    {
        // Fetch all records with status 'N'
        $orders = OrderDeliveryHdr::where('FL_STATUS', 'N')->get();

        // Pass the data to the view
        return view('request.approvaldelivery', compact('orders'));
    }
    // Approve the order
    public function approve($id)
    {
        $order = OrderDeliveryHdr::findOrFail($id);
        $order->FL_STATUS = 'Y'; // Update status to 'Approved'
        $order->save();

        $jobHdr = JobHdr::create([
            'jenis' => 'DELIVERY', // or another appropriate field
            'nomor_order' => $order->order_number,
            'status' => 'Pending', // or another appropriate status
        ]);

        // Find related containers in t_order_receiving_dtl using order_receiving_hdr_id
        $containers = OrderDeliveryDtl::where('order_id', $id)->get();

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
                'jenis_job' => 'RELOCATION', // or another appropriate value
                'wk_status_created' => now(),
                'status' => 'Pending', // or another appropriate status
            ]);
        }

        return redirect()->route('approvaldel.index')->with('success', 'Order approved successfully.');
    }

    // Reject the order
    public function reject($id)
    {
        $order = OrderDeliveryHdr::findOrFail($id);
        $order->FL_STATUS = 'X'; // Update status to 'Rejected'
        $order->save();

        return redirect()->route('approvaldel.index')->with('success', 'Order rejected successfully.');
    }
}

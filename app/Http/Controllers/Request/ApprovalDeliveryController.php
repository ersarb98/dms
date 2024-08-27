<?php

namespace App\Http\Controllers\Request;
use App\Models\OrderDeliveryHdr;

use App\Http\Controllers\Controller;
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

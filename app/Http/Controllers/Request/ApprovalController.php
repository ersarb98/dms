<?php

namespace App\Http\Controllers\Request;

use App\Http\Controllers\Controller;
use App\Models\OrderReceivingHdr;
use Illuminate\Http\Request;
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
        $order = OrderReceivingHdr::findOrFail($id);
        $order->status = 'Y'; // Update status to 'Approved'
        $order->save();

        return redirect()->route('approval.index')->with('success', 'Order approved successfully.');
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

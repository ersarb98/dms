<?php

namespace App\Http\Controllers;
use App\Models\OrderReceivingHdr;
use Illuminate\Http\Request;

class InboundController extends Controller
{
    public function index()
    {
        $orderReceivings = OrderReceivingHdr::all();
        return view('inbound.index', compact('orderReceivings'));
    }
    public function show($id)
    {
        // Fetch the order receiving record by ID
        $orderReceiving = OrderReceivingHdr::findOrFail($id);

        // Pass the record to the view
        return view('inbound.show', compact('orderReceiving'));
    }
    public function destroy($id)
    {
        // Find the record and delete it
        $orderReceiving = OrderReceivingHdr::findOrFail($id);
        $orderReceiving->delete();

        // Redirect or return response
        return redirect()->route('inbound.index')->with('success', 'Order Receiving deleted successfully.');
    }
}

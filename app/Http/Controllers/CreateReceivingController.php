<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderReceivingHdr;
use App\Models\OrderReceivingDtl;
class CreateReceivingController extends Controller
{
    public function index()
    {
        return view('inbound.create'); // Ensure this view file exists
    }
    public function store(Request $request)
    {
        try {
            // Create the order receiving header
            $orderReceivingHdr = OrderReceivingHdr::create([
                'order_number' => $request->order_number,
                'tipe_dokumen' => $request->tipe_dokumen,
                'nomor_dokumen' => $request->nomor_dokumen,
                'tanggal_dokumen' => $request->tanggal_dokumen,
                'pengirim' => $request->pengirim,
                'shipping_line' => $request->shipping_line,
                'voyage' => $request->voyage,
                'vessel' => $request->vessel,
                'asal' => $request->asal,
                'moda' => $request->moda,
                'waktu_gate_in' => $request->waktu_gate_in,
                'catatan' => $request->catatan,
            ]);
        
            // Loop through each container input and create OrderReceivingDtl records
            foreach ($request->nomor_kontainer as $index => $no_cont) {
                OrderReceivingDtl::create([
                    'order_receiving_hdr_id' => $orderReceivingHdr->id,
                    'no_cont' => $no_cont,
                    'type' => $request->tipe_kontainer[$index],
                    'size' => $request->ukuran_kontainer[$index],
                ]);
            }
        
            return redirect()->route('inbound.index')->with('success', 'Order Receiving created successfully.');
        } catch (\Exception $e) {
            // Log the error or handle it
            \Log::error('Error creating order receiving: ' . $e->getMessage());
            return redirect()->back()->withErrors(['error' => 'Failed to create order receiving.']);
        }        
    }
}

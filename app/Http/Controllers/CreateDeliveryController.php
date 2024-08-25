<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDeliveryHdr;
use App\Models\OrderDeliveryDtl;
class CreateDeliveryController extends Controller
{
    public function index()
    {
        return view('outbound.create'); // Ensure this view file exists
    }

    public function store(Request $request)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'order_number' => 'required|string|max:255',
            'release_time' => 'required|date',
            'document_type' => 'required|string|max:255',
            'document_number' => 'required|string|max:255',
            'document_date' => 'required|date',
            'truck_type' => 'required|string|max:255',
            'license_plate' => 'required|string|max:255',
            'destination' => 'required|string|max:255',
            'notes' => 'nullable|string',
            'container_number' => 'required|array',
            'container_number.*' => 'required|string|max:255',
            'container_size' => 'required|array',
            'container_size.*' => 'required|string|max:255',
            'ukuran_cont' => 'required|array',
            'ukuran_cont.*' => 'required|numeric',
        ]);

        // Create the main order record
        $order = new OrderDeliveryHdr();
        $order->order_number = $validatedData['order_number'];
        $order->release_time = $validatedData['release_time'];
        $order->document_type = $validatedData['document_type'];
        $order->document_number = $validatedData['document_number'];
        $order->document_date = $validatedData['document_date'];
        $order->truck_type = $validatedData['truck_type'];
        $order->license_plate = $validatedData['license_plate'];
        $order->destination = $validatedData['destination'];
        $order->notes = $validatedData['notes'];
        $order->save();

        // Create the container records
        foreach ($validatedData['container_number'] as $index => $container_number) {
            $container = new OrderDeliveryDtl();
            $container->order_id = $order->id; // Link to the main order's ID
            $container->no_cont = $container_number;
            $container->size = $validatedData['container_size'][$index];
            $container->type = $validatedData['ukuran_cont'][$index];
            $container->save();
        }

        // Redirect back with a success message
        return redirect()->route('deliveries.index')->with('success', 'Order Delivery created successfully.');
    }
}

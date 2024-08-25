<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\OrderDeliveryHdr;

class OutboundController extends Controller
{
    public function index()
    {
        // Fetch data from t_order_delivery_hdr
        $deliveries = OrderDeliveryHdr::all();

        // Pass the data to the view
        return view('outbound.index', compact('deliveries'));
    }
    public function getData()
    {
        // Example data to return
        $data = [
            'message' => 'Hello from the controller!',
            'status' => 'success'
        ];

        return response()->json($data);
    }

    public function destroy($id)
    {
        $delivery = OrderDeliveryHdr::find($id);

        // Check if the delivery status is 'N' (Pending)
        if ($delivery && $delivery->FL_STATUS === 'N') {
            $delivery->delete();
            return redirect()->route('deliveries.index')->with('success', 'Delivery deleted successfully.');
        }

        return redirect()->route('deliveries.index')->with('error', 'Cannot delete this delivery. Only Pending deliveries can be deleted.');
    }
    public function show($id)
    {
        // Retrieve the delivery record by ID
        $delivery = OrderDeliveryHdr::with('orderDeliveryDtl')
            ->where('id', $id)
            ->firstOrFail();

        // Pass the delivery data to the detail view
        return view('outbound.detail', compact('delivery'));
    }

}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OutboundController extends Controller
{
    public function index()
    {
        return view('outbound.index');
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
}

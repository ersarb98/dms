<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateReceivingController extends Controller
{
    public function index()
    {
        return view('inbound.create'); // Ensure this view file exists
    }
}

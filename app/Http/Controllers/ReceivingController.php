<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReceivingController extends Controller
{
    public function index()
    {
        return view('outbound.index');
    }
}

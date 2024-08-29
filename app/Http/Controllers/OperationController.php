<?php

namespace App\Http\Controllers;

use App\Models\JobOperation;
use App\Models\JobHdr;
use App\Models\JobContainer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OperationController extends Controller
{
    public function index()
    {
        $subquery = DB::table('t_job_operation')
        ->select('*', DB::raw('ROW_NUMBER() OVER (PARTITION BY id_job_container ORDER BY created_at DESC) as rn'))
        ->toSql();

    // Main query
    $operations = DB::table('t_job_hdr as A')
        ->join('t_job_container as B', 'A.id', '=', 'B.id_job_hdr')
        ->join(DB::raw("($subquery) as C"), 'B.id', '=', 'C.id_job_container')
        ->where('C.rn', 1)
        ->where('A.status', 'Pending')
        ->select('A.*', 'B.*', 'C.*') // Adjust the columns as needed
        ->get();

    return view('operations.index', compact('operations'));
    }
    
}

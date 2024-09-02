<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InspectionController extends Controller
{
    public function index(){
        return view('inspection.index');
    }

    public function search(Request $request)
    {
        $containerNumber = $request->input('containerNumber');


        // SQL query using Laravel's DB facade
        $operations = DB::select("
            SELECT * 
            FROM t_job_hdr A
            JOIN t_job_container B ON A.id = B.id_job_hdr
            JOIN (
                SELECT *, ROW_NUMBER() OVER (PARTITION BY id_job_container ORDER BY created_at DESC) AS rn
                FROM t_job_operation
            ) C ON B.id = C.id_job_container
            WHERE C.rn = 1 
              AND A.status = 'Pending'
              AND C.status = 'Pending'
              AND C.jenis_job = 'INSPECTION'
              AND B.no_cont = ?
        ", [$containerNumber]);

        $operations = collect($operations);
        // dd($operations);
        return view('pergerakan.set_realisasi', compact('operations'));
    }
}

<?php

namespace App\Http\Controllers\Analisis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AnalisisController extends Controller
{
    public function index( )
    {
        $totalCelebradas = DB::table('audiencias')->where('estadoAudiencia_id', 6)->count();
        $totalReservadas = DB::table('audiencias')->where('estadoAudiencia_id', 1)->count();
        $totalCanceladas = DB::table('audiencias')->where('estadoAudiencia_id', 5)->count();
        // $audienciaMayorDuracion = DB::table('audiencias')->where('estadoAudiencia_id',1)->latest();

        return view('estadistica.index', compact(['totalCelebradas', 'totalReservadas', 'totalCanceladas']));
    }
}
 
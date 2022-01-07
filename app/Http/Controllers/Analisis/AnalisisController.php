<?php

namespace App\Http\Controllers\Analisis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Audiencia;
use App\Models\VideoAudiencia;


class AnalisisController extends Controller
{
    public function index( )
    {
        $totalCelebradas = DB::table('audiencias')->where('estadoAudiencia_id', 6)->count();
        $totalReservadas = DB::table('audiencias')->where('estadoAudiencia_id', 1)->count();
        $totalCanceladas = DB::table('audiencias')->where('estadoAudiencia_id', 5)->count();
        $audienciaMayorDuracion = VideoAudiencia::all()->max('duracion');
        // $audienciaMayorDuracion = DB::table('audiencias')->where('estadoAudiencia_id',1)->latest();

        return view('estadistica.index', compact(['totalCelebradas', 'totalReservadas', 'totalCanceladas', 'audienciaMayorDuracion']));
    }

    public function audienciasCelebreadasAlYear() {
        // TODO: Obtener el total de audiencias celebredas del año actual
        $yearActually= date('Y'); // Obtenemos el año actial
        $dateStart = $yearActually . '-01-01';  // '202X-01-01'; 
        $dateEnd   = $yearActually . '-12-31';  // '202X-12-31'; 

        $audienciasCelebradas = Audiencia::where('estadoAudiencia_id', 6)
        ->where('fechaCelebracion','>=', $dateStart)
        ->where('fechaCelebracion','<=', $dateEnd)->get();

        // TODO: Obtener el total de audiencia celebradas por meses del año
        
        $monthActually = 01;
        $monthStart = $yearActually . '-'. $monthActually . '-01';
        $monthEnd   = $yearActually . '-'. $monthActually . '-31';

        $data = [];

        foreach ($audienciasCelebradas as $audiencia) {
            if($audiencia->fechaCelebracion >= $monthStart || $audiencia->fechaCelebracion <= $monthEnd) {
                array_push($data, $audiencia);
            } else {
                $monthActually ++;
            }
        }



        //$audiencias = Audiencia::where('estadoAudiencia_id', 6)->get();  // El número 6 es el estado de la audiencia
        return $monthActually;
    }
}
 
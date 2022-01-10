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

        $january   = [];
        $february  = [];
        $march     = [];
        $april     = [];
        $may       = [];
        $june      = [];
        $july      = [];
        $august    = [];
        $september = [];
        $october   = [];
        $november  = [];
        $december  = [];       

        foreach ($audienciasCelebradas as $audiencia) {
            //return  date("Ymd", strtotime($audiencia->fechaCelebracion));
            // Enero
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-01-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-01-31'))) {

                array_push($january, $audiencia->fechaCelebracion);
            } 
            // Febrero
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-02-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-02-31'))) {

                array_push($february, $audiencia->fechaCelebracion);
            } 
            // Marzo
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-03-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-03-31'))) {

                array_push($march, $audiencia->fechaCelebracion);
            } 

            // Abril
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-04-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-04-31'))) {

                array_push($april, $audiencia->fechaCelebracion);
            } 

            // Mayo
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-05-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-05-31'))) {

                array_push($may, $audiencia->fechaCelebracion);
            } 

             // Junio
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-06-01')) &&
                  date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-06-31'))) {

                array_push($june, $audiencia->fechaCelebracion);
            } 

            // Julio
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-07-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-07-31'))) {

                array_push($july, $audiencia->fechaCelebracion);
            }
            
            // Agosto
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-08-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-08-31'))) {

                array_push($august, $audiencia->fechaCelebracion);
            }

            // Septiembre
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-09-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-09-31'))) {

                array_push($september, $audiencia->fechaCelebracion);
            }

            // Octumbre
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-10-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-10-31'))) {

                array_push($october, $audiencia->fechaCelebracion);
            }

            // Noviembre
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-11-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-11-31'))) {

                array_push($november, $audiencia->fechaCelebracion);
            }

            // Diciembre
            if ( date("Ymd", strtotime($audiencia->fechaCelebracion)) >= date("Ymd", strtotime($yearActually . '-12-01')) &&
                 date("Ymd", strtotime($audiencia->fechaCelebracion)) <= date("Ymd", strtotime($yearActually . '-12-31'))) {

                array_push($december, $audiencia->fechaCelebracion);
            }
        }

        // Develvemos un array con el numero de audiencias celebradas por mes
        $data = [
            count($january), 
            count($february), 
            count($march), 
            count($april), 
            count($may), 
            count($june), 
            count($july), 
            count($august), 
            count($september), 
            count($october), 
            count($november), 
            count($december)
        ];



        //$audiencias = Audiencia::where('estadoAudiencia_id', 6)->get();  // El número 6 es el estado de la audiencia
        return $data;
    }
}
 
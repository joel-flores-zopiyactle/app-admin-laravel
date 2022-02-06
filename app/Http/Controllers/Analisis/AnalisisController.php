<?php

namespace App\Http\Controllers\Analisis;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Audiencia;
use App\Models\ControlDeConsumoDisco;
use App\Models\Expediente as ExpedienteModel;
use App\Models\VideoAudiencia;


class AnalisisController extends Controller 
{
    public function index( )
    {
        $totalCelebradas = DB::table('audiencias')->where('estadoAudiencia_id', 6)->count();
        $totalReservadas = DB::table('audiencias')->where('estadoAudiencia_id', 1)->count();
        $totalCanceladas = DB::table('audiencias')->where('estadoAudiencia_id', 5)->count();
        $totalCanceladas = DB::table('audiencias')->where('estadoAudiencia_id', 5)->count();

        $audienciaMayorDuracionExpedinete = [];
        $durationMaxVideo = DB::table('video_audiencias')->max('duracion'); // Obtengo la duracion maxica

        if($durationMaxVideo) { // Si hay video grabado obtenemos los datos de la grabacion maximo

            $getInfoVideoMaxDuraction = VideoAudiencia::where('duracion', $durationMaxVideo)->first(); // Buscado en la lista el video de mayor duracion y obtengo toda la informacion
            $expedienteMaxVideo = ExpedienteModel::find($getInfoVideoMaxDuraction->expediente_id); // Consulto el expediente relacionado con la mayor duracion
            $audienciaMayorDuracion = array(
                'duracion' => $getInfoVideoMaxDuraction->duracion,
                'numero_expediente' => $expedienteMaxVideo->numero_expediente
            );

        } else { // Si no enviamos un array vacio
            $audienciaMayorDuracion = [];
        }   

       
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

    public function totalDeVideoconferenciasSiyNo( )
    {
        // Se obtienen el numero de Videoconferencias que se llevaron a cabo
        $getAllAudienciasConVideoconferenciaSi = Audiencia::where('videoconferencia', 'si')->select('videoconferencia')->get();
        $totalAudienciasConVideoconferenciaSi  = count($getAllAudienciasConVideoconferenciaSi);

        // Se obtienen el numero de audiencias que no fueron con Videoconferencias
        $getAllAudienciasConVideoconferenciaNo = Audiencia::where('videoconferencia', 'no')->select('videoconferencia')->get();
        $totalAudienciasConVideoconferenciaNo  = count($getAllAudienciasConVideoconferenciaNo);

        return [$totalAudienciasConVideoconferenciaSi, $totalAudienciasConVideoconferenciaNo];

    }

    public function totalDatosConsumidoPorYear() {
        // TODO: Obtener el total de audiencias celebredas del año actual
        $yearActually= date('Y'); // Obtenemos el año actial
        $dateStart = $yearActually . '-01-01';  // '202X-01-01'; 
        $dateEnd   = $yearActually . '-12-31';  // '202X-12-31'; 

        $controlDiscoConsumoMB = DB::table('control_de_consumo_discos')
                                ->where('created_at','>=', $dateStart)
                                ->where('created_at','<=', $dateEnd)
                                ->get();

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

        foreach ($controlDiscoConsumoMB as $video) {
            //return  date("Ymd", strtotime($video->fechaCelebracion));
            // Enero
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-01-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-01-31'))) {
                            
                array_push($january, $video->total_mb_usado);
            } 
            // Febrero
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-02-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-02-31'))) {

                array_push($february, $video->total_mb_usado);
            } 
            // Marzo
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-03-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-03-31'))) {

                array_push($march, $video->total_mb_usado);
            } 

            // Abril
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-04-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-04-31'))) {

                array_push($april, $video->total_mb_usado);
            } 

            // Mayo
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-05-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-05-31'))) {

                array_push($may, $video->total_mb_usado);
            } 

             // Junio
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-06-01')) &&
                  date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-06-31'))) {

                array_push($june, $video->total_mb_usado);
            } 

            // Julio
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-07-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-07-31'))) {

                array_push($july, $video->total_mb_usado);
            }
            
            // Agosto
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-08-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-08-31'))) {

                array_push($august, $video->total_mb_usado);
            }

            // Septiembre
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-09-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-09-31'))) {

                array_push($september, $video->total_mb_usado);
            }

            // Octumbre
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-10-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-10-31'))) {

                array_push($october, $video->total_mb_usado);
            }

            // Noviembre
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-11-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-11-31'))) {

                array_push($november, $video->total_mb_usado);
            }

            // Diciembre
            if ( date("Ymd", strtotime($video->created_at)) >= date("Ymd", strtotime($yearActually . '-12-01')) &&
                 date("Ymd", strtotime($video->created_at)) <= date("Ymd", strtotime($yearActually . '-12-31'))) {

                array_push($december, $video->total_mb_usado);
            }
        }

        // Develvemos un array con el numero de videos celebradas por mes DiskController
        $data = [
            [
                'mes'   => 'Enero',
                'datos' => $this->FileSizeConvert(array_sum($january))
            ],
            [
                'mes'   => 'Febrero',
                'datos' =>  $this->FileSizeConvert(array_sum($february)), 
            ],

            [
                'mes'   => 'Marzo',
                'datos' => $this->FileSizeConvert(array_sum($march)), 
            ],

            [
                'mes'   => 'Abril',
                'datos' =>  $this->FileSizeConvert(array_sum($april)),
            ],

            [
                'mes'   => 'Mayo',
                'datos' =>  $this->FileSizeConvert(array_sum($may)), 
            ],

            [
                'mes'   => 'Junio',
                'datos' => $this->FileSizeConvert(array_sum($june)), 
            ],


            [
                'mes'   => 'Julio',
                'datos' =>  $this->FileSizeConvert(array_sum($july)), 
            ],


            [
                'mes'   => 'Agosto',
                'datos' => $this->FileSizeConvert(array_sum($august)), 
            ],


            [
                'mes'   => 'Septiembre',
                'datos' => $this->FileSizeConvert(array_sum($september)), 
            ],

            [
                'mes'   => 'Octubre',
                'datos' => $this->FileSizeConvert(array_sum($october)), 
            ],

            [
                'mes'   => 'Noviembre',
                'datos' => $this->FileSizeConvert(array_sum($november)), 
            ],

            [
                'mes'   => 'Diciembre',
                'datos' => $this->FileSizeConvert(array_sum($december))
            ],
        ];

        return $data;
    }

    public function FileSizeConvert($totalBytes)
    {

        $bytes = $totalBytes;
        $result = 0;
        
        $arBytes = array(
            0 => array(
                "UNIT" => "TB",
                "VALUE" => pow(1024, 4)
            ),
            1 => array(
                "UNIT" => "GB",
                "VALUE" => pow(1024, 3)
            ),
            2 => array(
                "UNIT" => "MB",
                "VALUE" => pow(1024, 2)
            ),
            3 => array(
                "UNIT" => "KB",
                "VALUE" => 1024
            ),
            4 => array(
                "UNIT" => "B",
                "VALUE" => 1
            ),
        );

        foreach($arBytes as $arItem)
        {
            if($bytes >= $arItem["VALUE"])
            {
                $result = $bytes / $arItem["VALUE"];
                $result = str_replace(".", "," , strval(round($result, 2)))." ".$arItem["UNIT"];
                break;
            }
        }
        return $result;
    }
}
           
<?php

namespace App\Http\Controllers;

use App\Models\Audiencia as AudienciaModel;
use App\Models\EstadoAudiencia as EstadoAudienciaModel;
use App\Models\Expediente;
use App\Models\TipoAudiencia as TipoAudienciaModel;
use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function show()
    {
        return view('agenda.index');
    }

    public function getEventosAudiencia()
    {
        $eventos = [];

        $audiencias  =  AudienciaModel::where('estado', 1)->select('id','tipo_id', 'expediente_id', 'estadoAudiencia_id', 'fechaCelebracion', 'horaInicio')->get();

        foreach ($audiencias as $event ) {

            //$tipoAudiencia = TipoAudienciaModel::find($event->tipo_id);
            $estadoAudiencia = EstadoAudienciaModel::find($event->estadoAudiencia_id);
            $expediente = Expediente::find($event->expediente_id);

            $data = array(
                'title' => $expediente->numero_expediente ,//$tipoAudiencia->nombre,
                'start' => $event->fechaCelebracion."T".$event->horaInicio,
                'backgroundColor' => $estadoAudiencia->color,
                'textColor' => '#3e1a53',
                'allDay' => false
            );

           array_push($eventos, $data);
        }

        return response()->json($eventos);
    }
}
 
<?php

namespace App\Http\Controllers;

use App\Models\Audiencia as AudienciaModel;
use App\Models\EstadoAudiencia as EstadoAudienciaModel;
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

        $audiencias  =  AudienciaModel::where('estado', 1)->select('id','tipo_id', 'estadoAudiencia_id', 'fechaCelebracion', 'horaInicio')->get();

        foreach ($audiencias as $event ) {

            $tipoAudiencia = TipoAudienciaModel::find($event->tipo_id);
            $estadoAudiencia = EstadoAudienciaModel::find($event->estadoAudiencia_id);

            $data = array(
                'title' => $tipoAudiencia->nombre,
                'start' => $event->fechaCelebracion."T".$event->horaInicio,
                'color' => $estadoAudiencia->color,
                'allDay' => false
            );

           array_push($eventos, $data);
        }

        return response()->json($eventos);
    }
}
 
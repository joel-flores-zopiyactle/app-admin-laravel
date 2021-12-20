<?php

namespace App\Http\Controllers;

use App\Models\Audiencia as AudienciaModel;
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

        $audiencias  =  AudienciaModel::where('estado', 1)->select('id', 'fechaCelebracion', 'horaInicio')->get();

        foreach ($audiencias as $event ) {
            $data = array(
                'title' => $event->id,
                'start' => $event->fechaCelebracion."T".$event->horaInicio,
                'allDay' => false
            );

           array_push($eventos, $data);
        }

        return response()->json($eventos);
    }
}
 
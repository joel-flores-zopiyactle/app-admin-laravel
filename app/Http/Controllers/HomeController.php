<?php

namespace App\Http\Controllers;

use App\Models\Audiencia;
use App\Models\EstadoAudiencia as EstadoAudienciaModel;
use App\Models\RolesPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->insertDataEstadoAudiencia();
        $this->insertDataParaPersonal();
        $fechaHoy =  date('Y,m,d');  // '2021-12-31'; 

        $audienciasAgendadasHoy = Audiencia::where('fechaCelebracion', $fechaHoy)->get();
        $audienciasCelebrandoseHoy = Audiencia::where('estadoAudiencia_id', 3)->get(); // eL 3 es el estado de la audiencia
        $audienciasFinalizadasHoy = Audiencia::where('fechaCelebracion', $fechaHoy)->where('estadoAudiencia_id', 6)->get();

        return view('home', compact(['audienciasAgendadasHoy', 'audienciasCelebrandoseHoy', 'audienciasFinalizadasHoy']));
    }

    /* 
    *   insertDataEstadoAudiencia AL ARRANCAR lA APP por primera vez inserta los datos a la
    *   BD para controlar los estados de las audiencias
    *   Solo una vez ibnserta los datos
    */

    public function insertDataEstadoAudiencia()
    {
        
        try {
            $estado = EstadoAudienciaModel::all();
            
            $data = [
                [
                 'estado' => 'Agendada',
                 'color' => '#2ba5c8',
                ],
                [
                 'estado' => 'Reagendada',
                 'color' => '#FA9E03',
                ],
                [
                 'estado' => 'Celebrándose',
                 'color' => '#d6d164',
                ],
                [
                 'estado' => 'Pausada',
                 'color' => '#9b266e',
                ],
                [
                 'estado' => 'Cancelada',
                 'color' => '#d90156',
                ],
                [
                    'estado' => 'Finalizada',
                    'color' => '#379000',
                ],
            ];

            if(count($estado) > 0) return;
            foreach ($data as $value) {
                $estado =  new EstadoAudienciaModel;
                $estado->estado = $value['estado'];
                $estado->color  = $value['color'];
                $estado->save();
            }
        } catch (\Throwable $th) {
            return "La aplicaccion no se puede inicar ya que no se esta conectado a una Base de datos";
        }



    }


    public function insertDataParaPersonal()
    {
        
        try {
            $roles = RolesPersonal::all();
            
            $data = [
                [
                 'personal' => 'Juez',
                ],
                [
                 'personal' => 'Secretario',
                ],
                [
                 'personal' => 'Testigo',
                ],
                [
                 'personal' => 'Parte Actora',
                ],
                [
                 'personal' => 'Parte Demandada',
                ],
            ];

            if(count($roles) > 0) return;
            foreach ($data as $value) {
                $estado =  new RolesPersonal;
                $estado->tipo_personal = $value['personal'];
                $estado->save();
            }
        } catch (\Throwable $th) {
            return "La aplicaccion no se puede inicar ya que no se esta conectado a una Base de datos";
        }


        
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\EstadoAudiencia as EstadoAudienciaModel;
use Illuminate\Http\Request;
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

        return view('home');
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
                 'color' => 'verde',
                ],
                [
                 'estado' => 'Reagendada',
                 'color' => 'azul',
                ],
                [
                 'estado' => 'Celebrándose',
                 'color' => 'amarrillo',
                ],
                [
                 'estado' => 'Pausadas',
                 'color' => 'rojo',
                ],
                [
                 'estado' => 'Canceladas',
                 'color' => 'gris',
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
}

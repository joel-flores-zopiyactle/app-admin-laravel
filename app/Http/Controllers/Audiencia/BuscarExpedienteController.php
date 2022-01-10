<?php


namespace App\Http\Controllers\Audiencia;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Audiencia as AudienciaModel;
use App\Models\TipoAudiencia as TipoAudienciaModel;
use App\Models\Expediente as ExpedienteModel;

class BuscarExpedienteController extends Controller
{
     /* 
    *   show viws expediente
    */
    public function expediente()
    {
        return view('reservas.expediente');
    }

    public function getTipoAudiencia()
    {
        $listaTipoAudiencia  =  TipoAudienciaModel::where('estado', 1)->select('id', 'nombre')->orderBy('nombre')->get();

        return response()->json($listaTipoAudiencia);
    }

    public function buscarExpediente(Request $request)
    {
        // return $request->all();
        $tipoBusqueda = $request->tipo_de_busqueda; // Recibe el tipo de busqueda
        $buscar = $request->buscar; // Recibi el dato a buscar

        $resultExpedientes = [];


        switch ($tipoBusqueda) {
            case '1': // Numero de expediente
                $result = ExpedienteModel::where('id', $buscar)->orderBy('id', 'desc')->paginate(15);
                $resultExpedientes = $result;
                break;
            case '2': // fecha de expediente fechaCelebracion
                $result = AudienciaModel::where('fechaCelebracion', $buscar)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($result as $value) {
                    $expediente = ExpedienteModel::find($value->expediente_id);
                    array_push($data, $expediente);
                }
                $resultExpedientes = $data;
                break; 
            case '3': // juez de expediente
                $result = ExpedienteModel::where('juez', $buscar)->orderBy('id', 'desc')->paginate(15);
                $resultExpedientes = $result;
                break;  
                
            case '6': // tipo de audiencia de expediente
                $result = AudienciaModel::where('tipo_id', $buscar)->orderBy('id', 'desc')->get();
                $data = [];
                foreach ($result as $value) {
                    $expediente = ExpedienteModel::find($value->expediente_id);
                    array_push($data, $expediente);
                }
                $resultExpedientes = $data;
                break;      
            
            default:
                # code...
                break;
        }

        return view('reservas.expediente', compact('resultExpedientes'));

    }
}

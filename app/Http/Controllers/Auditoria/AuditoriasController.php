<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\Expediente as ExpedienteModel;
use App\Models\TokenAudiencia as TokenAudienciaModel;
use App\Models\Audiencia as AudienciaModel;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AuditoriasController extends Controller
{
    public function login()
    {
        return view('auditoria.login');
    }

    public function singInAudiencia(Request $request)
    {
        $validatedData = $request->validate([
            'token' => ['required', 'max:255'],
            'numero_de_expediente' => ['required', 'string'],
        ]);

        $expediente = ExpedienteModel::where('numero_expediente', $request->numero_de_expediente)->first();

        $token = TokenAudienciaModel::where('token', $request->token)->where('expediente_id', $expediente->id)->get();

        if(count($token) > 0) {

            $estadoAudiencia = AudienciaModel::where('expediente_id',$expediente->id)->first();

            if($estadoAudiencia->estadoAudiencia_id === 5 ||$estadoAudiencia->estadoAudiencia_id === 6 ) {
                return back()->with('warning', "No puedes acceder a la audiencia, ya que fue cancelada o ya finalizo!");
            } 
            

            try {
                    $audiencia = AudienciaModel::where('expediente_id',$expediente->id)->first(); // Obtener el id del audiencia
                    
                    $actualizarAudiencia = AudienciaModel::find($audiencia->id);
                    $actualizarAudiencia->estadoAudiencia_id = 3; // estado celebrandose
                    $actualizarAudiencia->save();

                    $numero_de_expediente = encrypt($expediente->id); // encriptamos el id y lo pasamos al url

                    return redirect("/evento/$numero_de_expediente");

            } catch (\Throwable $th) {
                return back()->with('error', "Hubo un error al acceder, intente de nuevo!");
            }
           //evento/{id}
        } else {
            return back()->with('error', "El token o Número de expediente son incorrectos!");
        }
    }

    public function showEvento($id)
    {
        $id = decrypt($id);
        
        $expediente = ExpedienteModel::findOrFail($id);

        return view('auditoria.index', compact('expediente'));
    }

    // Id de la audiencia
    public function exitAudiencia($id)
    {
        try {

            // $actualizarAudiencia = AudienciaModel::find($id);
            // $actualizarAudiencia->estadoAudiencia_id = 6; // estado celebrandose
            // $actualizarAudiencia->save();

            return view('auditoria.login');

        } catch (\Throwable $th) {
            return back()->with('error', "Hubo un error al salir de la audiencia!");
        }
    }
}

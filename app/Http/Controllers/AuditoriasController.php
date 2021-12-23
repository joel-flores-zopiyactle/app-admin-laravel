<?php

namespace App\Http\Controllers;

use App\Models\Expediente as ExpedienteModel;
use App\Models\TokenAudiencia as TokenAudienciaModel;
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
            'numero_de_expediente' => ['required', 'numeric'],
        ]);

        $acceso = TokenAudienciaModel::where('token', $request->token)->where('expediente_id', $request->numero_de_expediente)->get();

        if(count($acceso) > 0) {
            return redirect("/evento/$request->numero_de_expediente");
           //evento/{id}
        } else {
            return back()->with('error', "El token o Número de expediente son incorrectos!");
        }
    }

    public function showEvento($id)
    {
        $expediente = ExpedienteModel::find($id);

        return view('auditoria.index', compact('expediente'));
    }
}

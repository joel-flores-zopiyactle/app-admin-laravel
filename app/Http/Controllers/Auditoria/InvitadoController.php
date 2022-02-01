<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\Expediente as ExpedienteModel;
use Illuminate\Http\Request;
use App\Models\TokenAudienciaInvitado as TokenAudienciaInvitadoModel;

class InvitadoController extends Controller
{
    public function show()
    {
        return view('invitado.login');
    }

    public function singIn(Request $request)
    {
        $validatedData = $request->validate([
            'token' => ['required', 'max:255'],
        ]);

        $acceso = TokenAudienciaInvitadoModel::where('token', $request->token)->first();
        
        if($acceso) {
            $expediente = ExpedienteModel::where('id', $acceso->expediente_id)->first();
            return view('invitado.sala',compact('expediente'));
        }

        return back()->with('error', "El token es invalido!");
    }
}

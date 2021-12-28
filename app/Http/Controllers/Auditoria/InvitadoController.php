<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
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
            return view('invitado.sala');
        }

        return back()->with('error', "El token es invalido!");
    }
}

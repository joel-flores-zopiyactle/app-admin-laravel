<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuditoriasController extends Controller
{
    public function login()
    {
        return view('auditoria.login');
    }

    public function singInAudiencia(Request $request)
    {
        # code...
    }
}

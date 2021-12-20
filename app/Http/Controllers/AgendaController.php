<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AgendaController extends Controller
{
    public function show()
    {
        return view('agenda.index');
    }
}

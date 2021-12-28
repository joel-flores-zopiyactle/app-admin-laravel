<?php

namespace App\Http\Controllers\Audiencia;

use App\Http\Controllers\Controller;
use App\Models\Expediente as ExpedienteModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class ExpedientePDFController extends Controller
{
    public function index($id)
    {
       return view('reservas.pdf.index', compact('id'));
    }
    
    public function show($id)
    {
        $id = decrypt($id);
        
        $expediente = ExpedienteModel::find($id);
        //return view('reservas.pdf.expediente', compact('expediente'));
        
        $pdf = PDF::loadView('reservas.pdf.expediente', compact('expediente'));
        return $pdf->download("expediente-$expediente->id.pdf");
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Expediente as ExpedienteModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;


class ExpedientePDFController extends Controller
{
    public function show($id)
    {
        $expediente = ExpedienteModel::find($id);
        //return view('reservas.pdf.expediente', compact('expediente'));
        
        $pdf = PDF::loadView('reservas.pdf.expediente', compact('expediente'));
        return $pdf->download("expediente-$expediente->id.pdf");
    }
}

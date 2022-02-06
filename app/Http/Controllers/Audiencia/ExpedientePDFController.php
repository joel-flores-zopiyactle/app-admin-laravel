<?php

namespace App\Http\Controllers\Audiencia;

use App\Http\Controllers\Controller;
use App\Models\Audiencia;
use App\Models\Expediente as ExpedienteModel;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use DateTime;

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
        $audiencia = Audiencia::where('expediente_id', $id)->first();
        //return view('reservas.pdf.expediente', compact('expediente'));

        $horaInicio = new DateTime($audiencia->horaInicio); 
        $meridianoInicio = $horaInicio->format('H:i A'); // nos dice si es AM o PM
        
        $pdf = PDF::loadView('reservas.pdf.expediente', compact('expediente'));
        return $pdf->download("$expediente->numero_expediente - $audiencia->fechaCelebracion - $meridianoInicio.pdf");
    }

    public function showPDFDownload($id)
    {
        $id = decrypt($id);
        
        $expediente = ExpedienteModel::find($id);
        return view('reservas.pdf.expediente', compact('expediente'));
        
      
    }
}

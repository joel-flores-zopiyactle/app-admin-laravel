<?php

namespace App\Http\Controllers\Auditoria;

use App\Http\Controllers\Controller;
use App\Models\Audiencia as AudienciaModel;
use App\Models\Expediente as ExpedienteModel;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auditorias = AudienciaModel::where('estadoAudiencia_id',6)->get();
        return view('auditoria.reportes.lista-auditorias', compact('auditorias'));
    }


    public function showExpediente(Request $request)
    {
        $audiencia = AudienciaModel::where('id', $request->buscar)->where('estadoAudiencia_id',6)->first();
        return view('auditoria.reportes.resultado-busqueda', compact('audiencia'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id =  decrypt($id);
        $expediente = ExpedienteModel::where('id', $id)->first();
        return view('auditoria.reportes.expediente', compact('expediente'));
    }

    
}

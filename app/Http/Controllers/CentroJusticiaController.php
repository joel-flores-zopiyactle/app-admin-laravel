<?php

namespace App\Http\Controllers;

use App\Models\CentroJusticia;
use Illuminate\Http\Request;

class CentroJusticiaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $centros = CentroJusticia::orderBy('id', 'desc')->paginate(15);
        return view('ajustes.centro_justicia.index', compact('centros'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.centro_justicia.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => ['required', 'unique:centro_justicias', 'max:255'],
            'descripcion' => ['required'],
        ]);

        try {

            $newCentro = CentroJusticia::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);
    
            if($newCentro) {
                return back()->with('success', 'Centro de justicia registrado exitosamente!');;
            }
            
        } catch (\Throwable $th) {
            return back()->with('danger', 'Fallo al registrar los datos!');;
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $centro = CentroJusticia::findOrFail($id);

        return view('ajustes.centro_justicia.create', compact('centro'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {   
        //return $request->estado;

        $updateCentro = CentroJusticia::find($id);
        $updateCentro->nombre = $request->nombre;
        $updateCentro->descripcion = $request->descripcion;
        $updateCentro->estado = $request->estado ?? 0;

        if($updateCentro->save()) {
            return back()->with('success', 'Centro de justicia actualizado exitosamente!');;
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $centroDelete = CentroJusticia::find($id);

        if($centroDelete->delete()) {
            return back()->with('success', 'Dato eliminado correctamente!');;
        }
    }
}

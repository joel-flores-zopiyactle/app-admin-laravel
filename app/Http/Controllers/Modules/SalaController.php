<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\Sala;
use Illuminate\Http\Request;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = Sala::orderBy('id', 'desc')->paginate(15);
        return view('ajustes.sala.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.sala.create');
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
            'sala' => ['required', 'unique:salas', 'max:255'],
            'numero' => ['required'],
            'capacidad' => ['required'],
            'ubicacion' => ['required'],
        ]);

        try {

            $newSala = Sala::create([
                'sala' => $request->sala,
                'numero' => $request->numero,
                'capacidad' => $request->capacidad,
                'ubicacion' => $request->ubicacion
            ]);
    
            if($newSala) {
                return back()->with('success', 'Nuevo Sala registrado exitosamente!');
            }

            return back()->with('warning', 'Hubo un error al guardar los datos por favor verifique sus datos.');
            
        } catch (\Throwable $th) {
            return back()->with('danger', 'Fallo al registrar los datos!, verifique su conexion a Internet o recarga la página!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id =  decrypt($id);
        $sala = Sala::findOrFail($id);

        return view('ajustes.sala.create', compact('sala'));
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
        try {
            
            $updateSala = Sala::find($id);
            $updateSala->sala = $request->sala;
            $updateSala->numero = $request->numero;
            $updateSala->capacidad = $request->capacidad;
            $updateSala->ubicacion = $request->ubicacion;
            $updateSala->estado = $request->estado ?? 0;

            if($updateSala->save()) {
                return back()->with('success', 'Datos de la Sala actualizados exitosamente!');
            }

            return back()->with('warning', 'Hubo un error al actualizar los datos por favor verifique de nuevo sus datos.');

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al actualizar los datos!, verifique su conexion a Internet o recarga la página');
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
        try {

            $salaDelete = Sala::find($id);

            if($salaDelete->delete()) {
                return back()->with('success', "$salaDelete->sala eliminado correctamente!");
            }

            return back()->with('warning', "$salaDelete->sala no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\TipoJuicio;
use Illuminate\Http\Request;

class JuiciosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $juicios = TipoJuicio::orderBy('id', 'desc')->paginate(15);
        return view('ajustes.tipo_juicio.index', compact('juicios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.tipo_juicio.create');
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
            'nombre' => ['required', 'unique:tipo_juicios', 'max:255'],
            'descripcion' => ['required'],
        ]);
        

        try {

            $newJuicio = TipoJuicio::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);
    
            if($newJuicio) {
                return back()->with('success', 'Nuevo Juicio registrado exitosamente!');
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
        
        $juicio = TipoJuicio::findOrFail($id);

        return view('ajustes.tipo_juicio.create', compact('juicio'));
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

        $updateCentro = TipoJuicio::find($id);
        $updateCentro->nombre = $request->nombre;
        $updateCentro->descripcion = $request->descripcion;
        $updateCentro->estado = $request->estado ?? 0;

        if($updateCentro->save()) {
            return back()->with('success', 'Datos del Tipo de Juicio actualizados exitosamente!');
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
            $juicioDelete = TipoJuicio::find($id);

            if($juicioDelete->delete()) {
                return back()->with('success', "$juicioDelete->nombre eliminado correctamente!");
            }

            return back()->with('warning', "$juicioDelete->nombre no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

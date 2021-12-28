<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
use App\Models\TipoAudiencia;
use Illuminate\Http\Request;

class TipoAudienciaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $audiencias = TipoAudiencia::orderBy('id', 'desc')->paginate(15);
        return view('ajustes.tipo_audiencia.index', compact('audiencias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.tipo_audiencia.create');
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

            $newAudiencia = TipoAudiencia::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion
            ]);
    
            if($newAudiencia) {
                return back()->with('success', 'Nuevo Audiencia registrado exitosamente!');
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
        $audiencia = TipoAudiencia::findOrFail($id);

        return view('ajustes.tipo_audiencia.create', compact('audiencia'));
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

            $updateAudiencia = TipoAudiencia::find($id);
            $updateAudiencia->nombre = $request->nombre;
            $updateAudiencia->descripcion = $request->descripcion;
            $updateAudiencia->estado = $request->estado ?? 0;

            if($updateAudiencia->save()) {
                return back()->with('success', 'Datos de la Audiencia actualizados exitosamente!');
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
            $audienciaDelete = TipoAudiencia::find($id);

            if($audienciaDelete->delete()) {
                return back()->with('success', "$audienciaDelete->nombre eliminado correctamente!");
            }

            return back()->with('warning', "$audienciaDelete->nombre no se pudo eliminar, Intente de nuevo!");

       } catch (\Throwable $th) {
             return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
       }
    }
}

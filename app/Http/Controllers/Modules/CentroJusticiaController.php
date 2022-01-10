<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
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
            'nombre'      => ['required', 'unique:centro_justicias', 'max:255'],
            'descripcion' => ['required'],
        ]);

        try {

            $newCentro = CentroJusticia::create([
                'nombre'      => $request->nombre,
                'descripcion' => $request->descripcion
            ]);
    
            if($newCentro) {
                return back()->with('success', 'Nuevo Centro de justicia registrado exitosamente!');
            }

            return back()->with('warning', 'Hubo un error al guardar los datos por favor verifique sus datos.');
            
        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al registrar los datos!, verifique su conexion a Internet o recarga la página');
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
        $id =  decrypt($id);
        $centro = CentroJusticia::findOrFail( $id );

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

        try {
            $updateCentro = CentroJusticia::find($id);
            $updateCentro->nombre       = $request->nombre;
            $updateCentro->descripcion  = $request->descripcion;
            $updateCentro->estado       = $request->estado ?? 0;

            if($updateCentro->save()) {
                return back()->with('success', 'Datos del Centro de justicia actualizados exitosamente!');
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
                $centroDelete = CentroJusticia::find($id);

                if($centroDelete->delete()) {
                    return back()->with('success', "$centroDelete->nombre eliminado correctamente!");
                } 

                return back()->with('warning', "$centroDelete->nombre no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
                return back()->with('error', 'Hubo un error al eliminar el dato.');
        }
    }
}

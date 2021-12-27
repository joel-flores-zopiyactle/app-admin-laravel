<?php

namespace App\Http\Controllers\Audience;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Nota as NotaModel;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request->all();
        $validatedData = $request->validate([
            'nota'          => ['required', 'max:255'],
            'visibilidad'   => ['required'],
            'expediente_id' => ['required', 'numeric'],
        ]);

        try {
            
            $nota = new NotaModel;
            $nota->nota          = $request->nota;
            $nota->visibilidad   = $request->visibilidad;
            $nota->expediente_id = $request->expediente_id;

            if($nota->save()) {
                return array('status' =>  201, 'mensaje' => "Nota creado correctamente" );
            }

        } catch (\Throwable $th) {
            return array('status' =>  500, 'mensaje' => "Fallo al crear la notas" );
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
        try {
            
            $notas = NotaModel::where('expediente_id', $id)->orderBy('id', 'desc')->get();
            return $notas;

        } catch (\Throwable $th) {
            return array('status' =>  500, 'mensaje' => "Fallo al obtener las notas" );
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       try {
        
        $nota = NotaModel::find($id);

        if($nota) { return $nota; } 

        return array('status' =>  404, 'mensaje' => "Nota no encontrada" );
        

       } catch (\Throwable $th) {
            return array('status' =>  500, 'mensaje' => "Fallo al obtener la nota" );
       }
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
        $validatedData = $request->validate([
            'nota'          => ['required', 'max:255'],
            'visibilidad'   => ['required'],
        ]);

        try {
            
            $nota = NotaModel::find($id);
            $nota->nota          = $request->nota;
            $nota->visibilidad   = $request->visibilidad;
           
            return $nota->save();

        } catch (\Throwable $th) {
            return array('status' =>  500, 'mensaje' => "Fallo al actualizar la notas" );
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
            $nota = NotaModel::find($id);

            if($nota->delete()) {
                return array( 'status' =>  200, 'mensaje' => "$nota->nota eliminado correctamente!");
            } 

            return array('status' =>  200, 'mensaje' =>"$nota->nota no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {

            return array('status' =>  500, 'mensaje' => "Fallo al eliminar la nota" );
        }
    }
}

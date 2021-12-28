<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario as TipoUsuarioModel;
use Illuminate\Http\Request;


class TipoUsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = TipoUsuarioModel::all();
        return view('ajustes.usuario.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.usuario.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        try {

            $validatedData = $request->validate([
                'rol' => ['required', 'max:255'],
                'descripcion' => ['required', 'max:255'],
            ]);
            
            $tipo = new TipoUsuarioModel;
            $tipo->tipo          = $request->rol;
            $tipo->descripcion   = $request->descripcion;

            if($tipo->save()) {
                return back()->with('success', "Rol de usuario registrado correctamente!");
            }

        } catch (\Throwable $th) {
            return back()->with('success', "Ocurrio un error al registrar el rol de usuario, Intente más tarde!");
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
        
        $rol = TipoUsuarioModel::find($id);
        return view('ajustes.usuario.roles.create', compact('rol'));
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

            $validatedData = $request->validate([
                'rol' => ['required', 'max:255'],
                'descripcion' => ['required', 'max:255'],
            ]);
            
            $tipo = TipoUsuarioModel::find($id);
            $tipo->tipo          = $request->rol;
            $tipo->descripcion   = $request->descripcion;
            $tipo->estado        = $request->estado ?? 0;

            if($tipo->save()) {
                return back()->with('success', "Rol de usuario actualizados correctamente!");
            }

        } catch (\Throwable $th) {
            return back()->with('success', "Ocurrio un error al actualizar el rol de usuario, Intente más tarde!");
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
            $tipo = TipoUsuarioModel::find($id);

            if($tipo->delete()) {
                return back()->with('success', "$tipo->tipo eliminado correctamente!");
            }

            return back()->with('warning', "$tipo->tipo no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\role as Role;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderBy('id', 'desc')->paginate(15);
        return view('ajustes.rol.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('ajustes.rol.create');
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
            'rol' => ['required', 'unique:roles', 'max:255'],
            'descripcion' => ['required'],
        ]);

        try {

            $newCentro = Role::create([
                'rol' => $request->rol,
                'descripcion' => $request->descripcion
            ]);
    
            if($newCentro) {
                return back()->with('success', 'Rol registrado exitosamente!');;
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
        $rol = Role::findOrFail($id);

        return view('ajustes.rol.create', compact('rol'));
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
        $updateRol = Role::find($id);
        $updateRol->rol = $request->rol;
        $updateRol->descripcion = $request->descripcion;
        $updateRol->estado = $request->estado ?? 0;

        if($updateRol->save()) {
            return back()->with('success', 'Rol actualizado exitosamente!');;
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
        $rolDelete = Role::find($id);

        if($rolDelete->delete()) {
            return back()->with('success', 'Rol eliminado correctamente!');;
        }
    }
}

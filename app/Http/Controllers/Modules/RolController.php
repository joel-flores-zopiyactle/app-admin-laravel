<?php

namespace App\Http\Controllers\Modules;

use App\Http\Controllers\Controller;
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
                return back()->with('success', 'Nuevo Rol registrado exitosamente!');
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
    public function show()
    {
        $roles = Role::orderBy('id', 'desc')->get();

        return response()->json($roles);
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
        try {
            
            $updateRol = Role::find($id);
            $updateRol->rol = $request->rol;
            $updateRol->descripcion = $request->descripcion;
            $updateRol->estado = $request->estado ?? 0;

            if($updateRol->save()) {
                return back()->with('success', 'Datos del Rol actualizados exitosamente!');
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
            $rolDelete = Role::find($id);

            if($rolDelete->delete()) {
                return back()->with('success', "$rolDelete->rol eliminado correctamente!");
            }
            return back()->with('warning', "$rolDelete->rol no se pudo eliminar, Intente de nuevo!");

       } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
       }
    }

}

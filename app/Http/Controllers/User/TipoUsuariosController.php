<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Permisos as PermisosModel;
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
                
                $permisos = new PermisosModel;
                $permisos->tipo_user_id         = $tipo->id;
                $permisos->agendar              = $request->permiso_1   === 'on' ? true : false; // Si no hay valor entonces es falso checbocx
                $permisos->eliminar             = $request->permiso_2   === 'on' ? true : false;
                $permisos->descargar            = $request->permiso_3   === 'on' ? true : false;
                $permisos->cancelar             = $request->permiso_4   === 'on' ? true : false;
                $permisos->ver_auditoria        = $request->permiso_5   === 'on' ? true : false;
                $permisos->ver_lista_auditoria  = $request->permiso_6   === 'on' ? true : false;
                $permisos->ver_reservar         = $request->permiso_7   === 'on' ? true : false;
                $permisos->ver_buscar           = $request->permiso_8   === 'on' ? true : false;
                $permisos->ver_admin            = $request->permiso_9   === 'on' ? true : false;
                $permisos->ver_agenda           = $request->permiso_10  === 'on' ? true : false;
                $permisos->ver_invitado         = $request->permiso_11  === 'on' ? true : false;
                $permisos->ver_config           = $request->permiso_12  === 'on' ? true : false;
                $permisos->ver_estadistica      = $request->permiso_13  === 'on' ? true : false;

                $permisos->save();


                return back()->with('success', "Rol de usuario registrado correctamente!");
            }

        } catch (\Throwable $th) {

            /* 
                Si ocuure un error en el registro de permisos
                eliminamos el rol registrado para tener limpio la base de dattos 
            */

            if($tipo) {
                $tipo = TipoUsuarioModel::find($tipo->id);
                $tipo->delete();
            }

            return back()->with('success', "Ocurrio un error al registrar el rol de usuario, Intente más tarde!". $th);
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
        return view('ajustes.usuario.roles.edit', compact('rol'));
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
            'rol' => ['required', 'max:255'],
            'descripcion' => ['required', 'max:255'],
            'permiso_id' => ['required'],
        ]);

        try {
                     
            $tipo = TipoUsuarioModel::find($id);
            $tipo->tipo          = $request->rol;
            $tipo->descripcion   = $request->descripcion;
            $tipo->estado        = $request->estado ?? 0;

            if($tipo->save()) {

                $permiso_id = decrypt($request->permiso_id); // Recibimos el id del permiso y lo desincriptamos

                $permisos = PermisosModel::find($permiso_id);
                $permisos->agendar              = $request->permiso_1   === 'on' ? true : false; // Si no hay valor entonces es falso checbocx
                $permisos->eliminar             = $request->permiso_2   === 'on' ? true : false;
                $permisos->descargar            = $request->permiso_3   === 'on' ? true : false;
                $permisos->cancelar             = $request->permiso_4   === 'on' ? true : false;
                $permisos->ver_auditoria        = $request->permiso_5   === 'on' ? true : false;
                $permisos->ver_lista_auditoria  = $request->permiso_6   === 'on' ? true : false;
                $permisos->ver_reservar         = $request->permiso_7   === 'on' ? true : false;
                $permisos->ver_buscar           = $request->permiso_8   === 'on' ? true : false;
                $permisos->ver_admin            = $request->permiso_9   === 'on' ? true : false;
                $permisos->ver_agenda           = $request->permiso_10  === 'on' ? true : false;
                $permisos->ver_invitado         = $request->permiso_11  === 'on' ? true : false;
                $permisos->ver_config           = $request->permiso_12  === 'on' ? true : false;
                $permisos->ver_estadistica      = $request->permiso_13  === 'on' ? true : false;

                $permisos->save();

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

            if($tipo->id === 1) {
                return back()->with('warning', "No se puede eliminar el Rol ya que es un Rol principial de la Aplicación!");
            }

            if($tipo->delete()) {
                return back()->with('success', "$tipo->tipo eliminado correctamente!");
            }

            return back()->with('warning', "$tipo->tipo no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

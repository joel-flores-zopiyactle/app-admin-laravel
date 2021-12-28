<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\TipoUsuario;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $usuarios = User::all();
        return view('ajustes.usuario.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tipoUsuarios = TipoUsuario::Where('estado', '1')->get();
        return view('ajustes.usuario.create', compact('tipoUsuarios'));
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
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telefono' => ['required', 'numeric', 'min:10',  'unique:users'],
                'avatar' => ['required'],
                'tipo_usuario_id' => ['required', 'numeric'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $urlFile  =  'default'; // Si no hay archivo se queda como defaul
            
            if($request->file('avatar')) {
                $path = Storage::disk('public')->put('AVATARS', $request->file('avatar'));
                $urlFile  =  asset($path);
            }

            $user = new User;
            $user->name             = $request->name;
            $user->email            = $request->email;
            $user->telefono         = $request->telefono;
            $user->tipo_usuario_id  = $request->tipo_usuario_id;
            $user->avatar           = $urlFile;
            $user->password         = Hash::make($request->password);
    
            $user->save();
            
            return back()->with('success', 'Nuevo usuario registrado!');

        } catch (\Throwable $th) {
            return back()->with('error', 'No se puedo dar de alta el usuario. Intente de nuevo!');
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
        // Si el registro lo reazila un admin entonces returanos
        // un mensaje al adminisrador

       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tipoUsuarios = TipoUsuario::Where('estado', 1)->get();
        $usuario = User::find($id);
        $tipoUsuarioActual = TipoUsuario::Where('id', $usuario->tipo_usuario_id)->first();

        return view('ajustes.usuario.edit', compact(['usuario', 'tipoUsuarios', 'tipoUsuarioActual']));
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
                'name' => ['required', 'string', 'max:255'],
                //'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
                'telefono' => ['required', 'numeric', 'min:10'],
                'avatar' => ['required'],
                'tipo_usuario_id' => ['required', 'numeric'],
            ]);

            $user = User::find($id);
            $user->name = $request->name;
            $user->telefono = $request->telefono;
            $user->tipo_usuario_id = $request->tipo_usuario_id;
            $user->avatar = $request->avatar;
            $user->save();

            return back()->with('success', 'Usuario actualizado!');

       } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrio un error al actualizar los datos del usuario. Intente de nuevo!');
       }

    }

    public function updatePassword(Request $request, $id)
    {
        try {

            $validatedData = $request->validate([
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user = User::find($id);
            $user->password = Hash::make($request->password);
            $user->save();

            return back()->with('success', 'Contraseña actualizado!');

        } catch (\Throwable $th) {
            return back()->with('error', 'Ocurrio un error al actualizarla contraseña. Intente de nuevo!');
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
            $user = User::find($id);

            if($user->delete()) {
                return back()->with('success', "$user->name eliminado correctamente!");
            }

            return back()->with('warning', "$user->name no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

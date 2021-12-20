<?php

namespace App\Http\Controllers;

use App\Models\Participantes as ParticipantesModel;
use App\Models\role as RoleModel;
use Illuminate\Http\Request;

class ParticipanteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id, $expediente_id)
    {
        $roles = RoleModel::where('estado', 1)->select('id', 'rol')->orderBy('rol')->get();
        $participantes = ParticipantesModel::where('audiencia_id', $id)->where('estado', 1)->orderBy('id')->get();
        return view('reservas.participantes', compact(['id', 'expediente_id', 'roles', 'participantes']));
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
            'nombre' => ['required', 'max:100'],
            'descripcion' => ['required','max:255'],
            'rol_id' => ['required', 'numeric'],
            'audiencia_id' => ['required', 'numeric'],
        ]);

        try {

            $newParticipante = ParticipantesModel::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'rol_id' => $request->rol_id,
                'audiencia_id' => $request->audiencia_id,
            ]);
    
            if($newParticipante) {
                return back()->with('success', 'Nuevo Participante registrado exitosamente!');
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
        //
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
        //
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
            $deleteParticipante = ParticipantesModel::find($id);

            if($deleteParticipante->delete()) {
                return back()->with('success', "$deleteParticipante->nombre eliminado correctamente!");
            }

            return back()->with('warning', "$deleteParticipante->nombre no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Fallo al eliminar los datos!, verifique su conexion a Internet o recarga la página');
        }
    }
}

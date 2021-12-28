<?php

namespace App\Http\Controllers;

use App\Http\Resources\ParticipantesResourcean;
use App\Http\Resources\RolResource;
use App\Models\Asistencia as AsistenciaModel;
use App\Models\Participantes as ParticipantesModel;
use App\Models\role as RoleModel;
use GrahamCampbell\ResultType\Result;
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
        // return count($request->nombre);
        $validatedData = $request->validate([
            'nombre' => ['required', 'array'],
            'descripcion' =>['required', 'array'],
            'rol_id' => ['required', 'array'],
            'audiencia_id' => ['required', 'numeric'],
        ]);

        try {

            if( count($request->nombre) < 1) {
                return back()->with('warning', 'Hubo un error al guardar los datos, debe de enviar al menos un partcipante.');
            }


            for ($i=0; $i < count($request->nombre) ; $i++) { 
                
                $newParticipante = ParticipantesModel::create([
                    'nombre' => $request->nombre[$i],
                    'descripcion' => $request->descripcion[$i],
                    'rol_id' => $request->rol_id[$i],
                    'audiencia_id' => $request->audiencia_id,
                ]);
        
                if($newParticipante) {

                    $asistencia  = new AsistenciaModel;
                    $asistencia->asistencia = 'resgistrado';
                    $asistencia->color = 'bg-dark';
                    $asistencia->participante_id = $newParticipante->id;

                    $asistencia->save();
                }

            
            }

            //  '/expediente/pdf
            return redirect("/expediente/pdf/vista/$request->audiencia_id");

            return back()->with('success', 'Nuevo Participante registrado exitosamente!');

        } catch (\Throwable $th) {
            return back()->with('warning', 'Hubo un error al guardar los datos por favor verifique sus datos.');
        }

        // try {

        //     $newParticipante = ParticipantesModel::create([
        //         'nombre' => $request->nombre,
        //         'descripcion' => $request->descripcion,
        //         'rol_id' => $request->rol_id,
        //         'audiencia_id' => $request->audiencia_id,
        //     ]);
    
        //     if($newParticipante) {

        //         $asistencia  = new AsistenciaModel;
        //         $asistencia->asistencia = 'resgistrado';
        //         $asistencia->color = 'bg-light';
        //         $asistencia->participante_id = $newParticipante->id;

        //         $asistencia->save();

        //         return back()->with('success', 'Nuevo Participante registrado exitosamente!');
        //     }

        //     return back()->with('warning', 'Hubo un error al guardar los datos por favor verifique sus datos.');
            
        // } catch (\Throwable $th) {
        //     return back()->with('error', 'Fallo al registrar los datos!, verifique su conexion a Internet o recarga la página');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = [];

        $participantes = ParticipantesModel::where('audiencia_id', $id)->get();

        foreach ($participantes as $participante) {

            $asistencia = AsistenciaModel::where('participante_id', $participante->id)->first(); // Get asistencia participante

            $newParticipante = array(
                'id' => $participante->id,
                'nombre' => $participante->nombre,
                'descripcion' => $participante->descripcion,
                'rol' => new RolResource(RoleModel::findOrFail($participante->rol_id)),
                'asistencia' => array(
                    'id' =>  $asistencia->id ?? 0,
                    'asistencia' => $asistencia->asistencia ?? 'registrado',
                    'color' => $asistencia->color ?? 'bg-dark'
                )
            );

            array_push($data, $newParticipante);
        }
 

        return response()->json($data);
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

    // Tomar asistencia del participante
    public function asistencia(Request $request, $id)
    {

        $validatedData = $request->validate([
            'asistencia' => ['required','max:20'],
            'color' => ['required']
        ]);

        $asistencia  = AsistenciaModel::find($id);
        $asistencia->asistencia = $request->asistencia;
        $asistencia->color = $request->color;
        return $asistencia->save();
    }
}

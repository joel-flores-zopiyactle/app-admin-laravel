<?php

namespace App\Http\Controllers\Audiencia;

use App\Http\Controllers\Controller;
use App\Models\AsistenciaPersonalAudiencia;
use App\Models\Audiencia as AudienciaModel;
use App\Models\CentroJusticia as CentroJusticiaModel;
use App\Models\EstadoAudiencia as EstadoAudienciaModel;
use App\Models\Expediente as ExpedienteModel;
use App\Models\PersonalAudiencia;
use App\Models\Sala as SalaModel;
use App\Models\TipoAudiencia as TipoAudienciaModel;
use App\Models\TipoJuicio as TipoJuicioModel;
use App\Models\TokenAudiencia as TokenAudienciaModel;
use App\Models\TokenAudienciaInvitado as TokenAudienciaInvitadoModel;
use Illuminate\Http\Request;

class ReservaSalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //TODO: Necesito obetner Expediente, SALA, AUDIENCIA, TIPO AUDIENCIA, Y ESTADO AUDIENCIA

        $expedientes = ExpedienteModel::orderBy('id', 'desc')->paginate(20);

        return view('reservas.index', compact('expedientes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $listOptions = [];

        // Centro de justicia
        $listaCentroJusticia =  CentroJusticiaModel::where('estado', 1)->select('id', 'nombre')->orderBy('nombre')->get();
        $salas               =  SalaModel::where('estado', 1)->select('id', 'sala')->orderBy('sala')->get();
        $listaTipoAudiencia  =  TipoAudienciaModel::where('estado', 1)->select('id', 'nombre')->orderBy('nombre')->get();
        $listaTipoJuicio     =  TipoJuicioModel::where('estado', 1)->select('id', 'nombre')->orderBy('nombre')->get();
        
        $audienciaLast      =  ExpedienteModel::all()->last(); // Obtiene el ultimo registro a la BD del expediente
        $folio =  isset($audienciaLast->id)  ? $audienciaLast->id + 1:  $audienciaLast + 1; // Si id expediente existe accedemos al id y sumanos uno al siguiente expdiente si no asigamos 1 por defecto
        

        return view('reservas.create', compact(['listaCentroJusticia','salas', 'listaTipoAudiencia', 'listaTipoJuicio', 'folio']));
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
            // Expediente
            'numero_expediente'  => ['required','string', 'unique:expedientes'],
            'folio'                 => ['required', 'numeric', 'unique:expedientes'],
            'juez'                  => ['required'],
            'testigo'               => ['required'],
            'actor'                 => ['required'],
            'demandado'             => ['required'],
            'secretario'            => ['required'],
            'juicio_id'             => ['required', 'numeric'],
            // Audiencia
            'centroJusticia_id' => ['required', 'numeric'],
            'sala_id' => ['required', 'numeric'],
            'tipo_id' => ['required', 'numeric'],
            //'expediente_id' => ['required'],
            //'estadoAudiencia_id' => ['required'],
            'fechaCelebracion'  => ['required'],
            'horaInicio'        => ['required'],
            'horaFinalizar'     => ['required'],
            'videoconferencia'     => ['required'],
        ]);

        try {
            
                $newExpediente = new ExpedienteModel;
                $newExpediente->numero_expediente   = $request->numero_expediente;
                $newExpediente->folio   = $request->folio;
                $newExpediente->juez    = $request->juez;
                $newExpediente->juzgado = $request->testigo;
                $newExpediente->actor   = $request->actor;
                $newExpediente->demandado  = $request->demandado;
                $newExpediente->secretario = $request->secretario;
                $newExpediente->juicio_id  = $request->juicio_id;

                if($newExpediente->save()) {

                    $newAudiencia = new AudienciaModel;
                    $newAudiencia->centroJusticia_id  = $request->centroJusticia_id;
                    $newAudiencia->sala_id            = $request->sala_id;
                    $newAudiencia->tipo_id            = $request->tipo_id;
                    $newAudiencia->expediente_id      = $newExpediente->id;
                    $newAudiencia->estadoAudiencia_id = 1; //Por Defecto es el Uno "Programado" ['Programado, 'En progreso', 'Cancelado', 'Reprogramado', 'Finalizado']
                    $newAudiencia->fechaCelebracion   = $request->fechaCelebracion;
                    $newAudiencia->horaInicio         = $request->horaInicio;
                    $newAudiencia->horaFinalizar      = $request->horaFinalizar;
                    $newAudiencia->videoconferencia   = $request->videoconferencia;
    

                    if($newAudiencia->save()) {

                        $this->registerPersonalAudiencia($request, $newAudiencia->id); // Se registran juez, demandado, secrretario actor, testigo en un tabla mas para tomar asistencia

                        $audiencia_id = $newAudiencia->id;
                        
                        //return view(('reservas.participantes'));
                        // Generamos un Token para la audiencia
                        $token = $this->tokenExpediente(60, $newExpediente->id);
                        $tokenAudiencia = new TokenAudienciaModel;
                        $tokenAudiencia->token = $token;
                        $tokenAudiencia->expediente_id =  $newExpediente->id;
                        $tokenAudiencia->save();

                        // Token del invitado
                        $tokenInvitado = $this->tokenExpediente(50, $newExpediente->id);
                        $tokenAudiencia = new TokenAudienciaInvitadoModel;
                        $tokenAudiencia->token = $tokenInvitado;
                        $tokenAudiencia->expediente_id =  $newExpediente->id;
                        $tokenAudiencia->save();

                        $id_audiencia = encrypt($audiencia_id);
                        $id_nuevo_expediente = encrypt($newExpediente->id);

                        return redirect("/agregar/participantes/$id_audiencia/$id_nuevo_expediente");
                        
                        //return back()->with('success', 'Audiencia programada exitosamente!');
                    } 
                    // Si no se pudo registrar los datos a la tabla Audiencia Elimanos el expediente anterior registrado y repetimos el proceso
                    $deleteExpediente = ExpedienteModel::find($newExpediente->id);
                    $deleteExpediente->delete();

                    return back()->with('warning', 'No se pudo programar la audiencia Intente de nuevo por favor y verifique sus datos!');
                }

                return back()->with('warning', 'No se pudo programar la audiencia Intente de nuevo por favor!');

        } catch (\Throwable $th) {
            /* 
            Si occurre un errro al registar datos a la tabla AudienciaModel
            Elimino los datos del expediente para poder generar una nueva y mantener limpio la BD
            */
            $deleteExpediente = ExpedienteModel::findOrFail($newExpediente->id);
            $deleteExpediente->delete();

            return back()->with('error', 'Hubo un error al guaradar los datos. Verifique su conexion a Internte o recarga la página!'.$th);
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        try {
            
            $expedientes = ExpedienteModel::where('numero_expediente', $request->num)->get(); // el id es la referencia del numero de expdiente

            if(count($expedientes) > 0) {
                return view('reservas.resultado-busqueda', compact('expedientes'));
            }

            return back()->with('warning', 'No hay resultados del expediente número: '. $request->num);

        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al consultar los datos!. Intentalo mas tarde..');
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
        $id =  decrypt($id);
        
        $expediente = ExpedienteModel::find($id); 
        $salas =  SalaModel::all();
        $salaActual = SalaModel::find($expediente->audiencia->sala_id);
        $estadoAudiencia = EstadoAudienciaModel::all();
        $estadoAudienciaActual = EstadoAudienciaModel::find($expediente->audiencia->estadoAudiencia_id);

        return view('reservas.opciones.editar-reservacion', compact(['expediente', 'salaActual', 'salas', 'estadoAudienciaActual', 'estadoAudiencia']) );
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
            
            //'sala_id' => ['required', 'numeric'],
            'fechaCelebracion'  => ['required', 'date'],
            'horaInicio'        => ['required'],
            'horaFinalizar'     => ['required'],
        ]);

        try {
            $audiencia = AudienciaModel::find($id);

            $audiencia->fechaCelebracion    = $request->fechaCelebracion;
            $audiencia->horaInicio          = $request->horaInicio;
            $audiencia->horaFinalizar       = $request->horaFinalizar;
            $audiencia->estadoAudiencia_id  = 2;
            
            if($audiencia->save()) {
                return back()->with('success', 'Audiencia reagendada');
            }

            return back()->with('warning', 'Hubo un error al reagendar la Audiencia, verifique sus datos.');

        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al reagendar la Audiencia, Refresca la páguina o intente mas tarde.');
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
            $expedienteDelete = ExpedienteModel::find($id);

            if($expedienteDelete->delete()) {
                return back()->with('success', "Expediente numero $expedienteDelete->numero_expediente eliminado correctamente!");
            } 

            return back()->with('warning', "Expediente numero $expedienteDelete->numero_expediente no se pudo eliminar, Intente de nuevo!");

        } catch (\Throwable $th) {
            return back()->with('error', 'Hubo un error al eliminar el dato.');
       }
    }

    
    // Genera un token para el expediente y es usado para acceder a la celebracion del audiecia
    public function tokenExpediente($len, $id)
    {
        $cadena = "Sinjo_ABCDFGHIJKLMNOPQRSTVWXYZabcdefghijklmnopqrstvwxyz0123456789_".$id;
        $token = "";

        for($i = 0; $i < $len; $i++) {
            $token .= $cadena[rand(0, $len)];       
        }

        return $token;

    }


    public function cancelarAudiencia($id)
    {
        try {
            $audiencia = AudienciaModel::find($id);

            if (!$audiencia) {
                return back()->with('warning', 'No se pudo cancelar la audiencia. Intente de nuevo.');
            }

            $audiencia->estadoAudiencia_id = 5;
                
            if($audiencia->save()) {
                return back()->with('success', 'Audiencia cancelada exitosamente.');
            }

            return back()->with('warning', 'No se pudo cancelar la audiencia. Intente de nuevo.');
            
        } catch (\Throwable $th) {
             return back()->with('error', 'Fallo al cancelar la audiencia. Intente tarde.');
        }
    }

    // Pausa la audiencia para ser renaudad despues
    public function pausarAudiencia($id)
    {
        //$expediente = ExpedienteModel::find($id);
        try {
            $audiencia = AudienciaModel::where('expediente_id', $id)->first();
            $audiencia->estadoAudiencia_id = 4; // Actaulizamos la audiencia a (4 => Pausada)

            if( $audiencia->save()) {

                return array( 'mensaje' => 'Audiencia pausada correctamente','status' => 200);

            }
            // Si  no se pudo actualizar returnamos este mensaje de error
            return array( 'mensaje' => 'Fallo al pausar la Audiencia, Intenete de nuevo', 'status' => 404);
           
        } catch (\Throwable $th) {
            return array( 'mensaje' => 'Hubo un error al pausar la Audiencia, Intente de nuevo', 'status' => 500);
        }
        
    }

    public function stopAudiencia($id)
    {
        try {
            $audiencia = AudienciaModel::where('expediente_id', $id)->first();
            $audiencia->estadoAudiencia_id = 6; // Actaulizamos la audiencia a (6 => Finalizar)

            if( $audiencia->save()) {

                return array( 'mensaje' => 'Audiencia finalizada correctamente','status' => 200);

            }
            // Si  no se pudo actualizar returnamos este mensaje de error
            return array( 'mensaje' => 'Fallo al finalizar la Audiencia, Intenete de nuevo', 'status' => 404);
           
        } catch (\Throwable $th) {
            return array( 'mensaje' => 'Hubo un error al finalizar la Audiencia, Intente de nuevo', 'status' => 500);
        }
    }


    public function registerPersonalAudiencia(Request $request, $audiencia_id)
    {
        /* 
        *    Add participantes
        **/
    
        if($request->juez ) {

            $newPersonal = new PersonalAudiencia;
            $newPersonal->nombre = $request->juez;
            $newPersonal->rol_personal_id = 1;
            $newPersonal->audiencia_id = $audiencia_id; // desencriptamos el id


            if($newPersonal->save()) {

                $asistencia  = new AsistenciaPersonalAudiencia;
                $asistencia->asistencia = 'resgistrado';
                $asistencia->color = 'bg-dark';
                $asistencia->personal_id = $newPersonal->id;

                $asistencia->save();
            }
        }

        if($request->secretario ) {

            $newPersonal = new PersonalAudiencia;
            $newPersonal->nombre = $request->secretario;
            $newPersonal->rol_personal_id = 2;
            $newPersonal->audiencia_id = $audiencia_id; // desencriptamos el id


            if($newPersonal->save()) {

                $asistencia  = new AsistenciaPersonalAudiencia;
                $asistencia->asistencia = 'resgistrado';
                $asistencia->color = 'bg-dark';
                $asistencia->personal_id = $newPersonal->id;

                $asistencia->save();
            }
        }

        if($request->testigo ) {

            $newPersonal = new PersonalAudiencia;
            $newPersonal->nombre = $request->testigo;
            $newPersonal->rol_personal_id = 3;
            $newPersonal->audiencia_id = $audiencia_id; // desencriptamos el id


            if($newPersonal->save()) {

                $asistencia  = new AsistenciaPersonalAudiencia;
                $asistencia->asistencia = 'resgistrado';
                $asistencia->color = 'bg-dark';
                $asistencia->personal_id = $newPersonal->id;

                $asistencia->save();
            }
        }

        if($request->actor ) {
            $newPersonal = new PersonalAudiencia;
            $newPersonal->nombre = $request->actor;
            $newPersonal->rol_personal_id = 4;
            $newPersonal->audiencia_id = $audiencia_id; // desencriptamos el id


            if($newPersonal->save()) {

                $asistencia  = new AsistenciaPersonalAudiencia;
                $asistencia->asistencia = 'resgistrado';
                $asistencia->color = 'bg-dark';
                $asistencia->personal_id = $newPersonal->id;

                $asistencia->save();
            }
        }

        if($request->demandado) {
            $newPersonal = new PersonalAudiencia;
            $newPersonal->nombre = $request->demandado;
            $newPersonal->rol_personal_id = 5;
            $newPersonal->audiencia_id = $audiencia_id; // desencriptamos el id


            if($newPersonal->save()) {

                $asistencia  = new AsistenciaPersonalAudiencia;
                $asistencia->asistencia = 'resgistrado';
                $asistencia->color = 'bg-dark';
                $asistencia->personal_id = $newPersonal->id;

                $asistencia->save();
            }
        }      


    }

}

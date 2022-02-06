@extends('layouts.dashboard')

@section('title')
    Reporte General
@endsection

@section('content')
<div class="container w-75">

    <x-alert-message/>

    <div>
        <h5>Datos de la audiencia</h5>
        <hr>
    </div>

  <div class="bg-white p-2 shadow rounded">
      {{-- folio --}}
        <table class="table w-50 table-responsive">
            <thead class="table-dark">
                <tr>
                    <td>Número de Expediente</td>
                    <td>Folio</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> {{ $expediente->numero_expediente }} </td>
                    <td> {{ $expediente->folio }} </td>
                </tr>
            </tbody>
        </table>

        {{-- Datos del expediente --}}
        <table class="table w-100 table-responsive">
            <thead class="table-dark">
                <tr>
                    <td>Centro de Justicia</td>
                    <td>Sala</td>
                    <td>Tipo de Audiencia</td>
                    <td>Tipo de juicio</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> {{ $expediente->audiencia->centroJusticia->nombre }} </td>
                    <td> {{ $expediente->audiencia->sala->sala }} </td>
                    <td> {{ $expediente->audiencia->tipoAudiencia->nombre }} </td>
                    <td> {{ $expediente->tipoJuicio->nombre }} </td>
                </tr>
            </tbody>
        </table>

        {{-- Tiempos de la audiencia--}}
        <table class="table w-100 table-responsive">
            <thead class="table-dark">
                <tr>
                    <td>Fecha de celebración</td>
                    <td>Hora Inicio</td>
                    <td>Hora de finalización</td>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td> {{ $expediente->audiencia->fechaCelebracion }} </td>
                    <td> {{ $expediente->audiencia->horaInicio }} </td>
                    <td> {{ $expediente->audiencia->horaFinalizar }} </td>
                </tr>
            </tbody>
        </table>

        {{-- Participantesde personal--}}
        <table class="table w-100 table-responsive mt-3">
            <thead class="table-dark">
                <tr>
                    <td>Nombre</td>
                    <td>Rol</td>
                    <td>Asistencia</td>
                </tr>
            </thead>

            <tbody>
                @foreach ($expediente->audiencia->personal as $personal)
                <tr>
                    <td> {{ $personal->nombre }} </td>
                    <td> {{ $personal->rolPersonal->tipo_personal }} </td>
                    <td> {{ $personal->asitencia->asistencia }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>


        {{-- Participantes--}}
        <hr>
        <h5 class="fs-5 mt-5">Participante</h5>
        @if (count($expediente->audiencia->participantes) >  0)
            <table class="table w-100 table-responsive">
                <thead class="table-dark">
                    <tr>
                        <td>Nombre</td>
                        <td>Rol</td>
                        <td>Descripción</td>
                        <td>Asistencia</td>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($expediente->audiencia->participantes as $participante)
                    <tr>
                        <td> {{ $participante->nombre }} </td>
                        <td> {{ $participante->rol->rol }} </td>
                        <td> {{ $participante->descripcion }} </td>
                        <td> {{ $participante->asitencia->asistencia }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-dark p-2">No hubo participantes a la audiencia</p>
        @endif
       


         {{-- Notas--}}
        <div class="w-100 bg-dark d-flex justify-content-between align-items-center p-2">
            <p class="text-center text-white">Notas agregadas</p>
            <!-- Button trigger modal -->
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addNotas">
                Agregar Nota
            </button>
        </div>

        @if (count($expediente->notas) > 0)
            <table class="table w-100 table-responsive">
                {{-- <thead class="table-light">
                    <tr>
                        <td>Notas</td>
                        <td>Visto</td>
                    </tr>
                </thead> --}}

                <tbody>
                
                    @foreach ( $expediente->notas as $nota)
                    <tr>
                        <td> {{ $nota->nota }} </td>
                       {{--  <td>
                            @if ($nota->visibilidad)
                                <p>Privado</p>
                            @else
                                <p>Publico</p>
                            @endif
                        </td> --}}
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-dark p-2">No se agregaron notas a la audiencia</p>
        @endif
        

         {{-- Archivos--}}
         <div class="w-100 bg-dark d-flex justify-content-between align-items-center p-2">
            <p class="text-center text-white">Archivos subidos</p>
            <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#addFile">
                Subir archivo
            </button>
        </div>

        @if (count($expediente->archivos) > 0)
            <table class="table w-100 table-responsive">
                <thead class="table-dark">
                    <tr>
                        <td>Nombre</td>
                        <td>Tipo Archivo</td>
                        <td></td>
                    </tr>
                </thead>

                <tbody>
                
                    @foreach ( $expediente->archivos as $archivo)
                    <tr>
                        <td> {{  $archivo->nombre }} </td>
                        <td> {{ $archivo->tipo_archivo }} </td>
                        <td>
                            <div class="d-flex justify-content-end">
                                {{-- <a class="btn btn-sm btn-outline-secondary me-1" href="{{ $archivo->url }}">Ver</a> --}}

                                {{-- permiso de descargar archivos --}}
                                @if ( Auth::user()->tipoUsuario->permiso->descargar)
                                    <a class="btn btn-sm btn-outline-secondary" href="{{ route('dowload.archivo', encrypt($archivo->id)) }}">Descargar</a>
                                @endif
                            
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-dark p-2">No se agregaron archivos a la audiencia</p>
        @endif
        

        {{-- Video audiencia --}}
        <table class="table w-100 table-responsive">
            <thead class="table-dark">
                <tr>
                   <td>Grabación de la audiencia</td>
                   <td></td>
                   <td></td>
                </tr>
                <tr>
                    <td>Nombre</td>
                    <td>Duración</td>
                    <td>Grabación </td>
                </tr>
            </thead>

            <tbody>
               
                @foreach ( $expediente->videoAudiencia as $video)
                <tr>
                    <td> {{ $video->nombre }} </td>
                    <td> {{ $video->duracion }} </td>
                    <td>
                        {{ $video->created_at->diffForHumans()  }}
                        <div class="d-flex justify-content-end">
                            {{-- <a class="btn btn-sm btn-outline-secondary me-1" href="{{ $video->url }}">Ver</a> --}}

                            {{-- permiso de descargar archivos --}}
                            {{-- @if ( Auth::user()->tipoUsuario->permiso->descargar)
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('video.download.audiencia', encrypt($video->id)) }}">Descargar</a>
                            @endif --}}
                           
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
     {{--  {{ $expediente }} --}}
  </div>

    
<!-- Modal notas -->
<div class="modal fade" id="addNotas" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addNotas" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('post.nota.add') }}" method="POST">
            @csrf
            <input type="hidden" name="expediente_id" value="{{ $expediente->id }}">
        
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Agregar nueva nota</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div>
                    <textarea name="nota" class="form-control" rows="2" placeholder="Ingrese su Nota..." minlength="4"></textarea>
                </div>

                {{-- <div class="mb-3 mt-3 form-check">
                    <input type="checkbox" class="form-check-input" name="visibilidad" id="visibilidad">
                    <label class="form-check-label" id="visibilidad_label" for="visibilidad">Privado</label>
                </div> --}}
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Agregar</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal File -->
<div class="modal fade" id="addFile" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addFile" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" action="{{ route('post.archivo.add') }}" enctype="multipart/form-data" method="POST">
            @csrf
            <input type="hidden" name="expediente_id" value="{{ $expediente->id }}">
        
            <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Subir archivo</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            
            <div class="modal-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Subir archivos</label>
                    <input class="form-control" type="file" name="file" id="file" required>
                </div>

                <div class="mt-3">
                    <select class="form-select form-select-sm" name="tipo_archivo" required>
                    <option selected>Seleccione tipo de archivo</option>
                    <option value="pdf">PDF</option>
                    <option value="imagen">Imagen</option>
                    <option value="video">Video</option>
                    <option value="audio">Audio</option>  
                    <option value="doc">Documento de Word</option>  
                    </select>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Subir</button>
            </div>
        </form>
    </div>
</div>

</div>
@endsection

@extends('layouts.dashboard')

@section('title')
    Reporte General
@endsection

@section('content')
<div class="container w-75">
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
                    <td> {{ $expediente->id }} </td>
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


        {{-- Participantes--}}
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


         {{-- Notas--}}
        <div class="w-100 bg-dark">
            <p class="text-center text-white p-2">Notas agregadas</p>
        </div>

        @if (count($expediente->notas) > 0)
            <table class="table w-100 table-responsive">
                <thead class="table-dark">
                    <tr>
                        <td>Notas</td>
                        <td>Visto</td>
                    </tr>
                </thead>

                <tbody>
                
                    @foreach ( $expediente->notas as $nota)
                    <tr>
                        <td> {{ $nota->nota }} </td>
                        <td>
                            @if ($nota->visibilidad)
                                <p>Privado</p>
                            @else
                                <p>Publico</p>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p class="text-center text-dark p-2">No se agregaron notas en la audiencia</p>
        @endif
        

         {{-- Archivos--}}
         <div class="w-100 bg-dark">
            <p class="text-center text-white p-2">Archivos subidos</p>
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
            <p class="text-center text-dark p-2">No se agregaron archivos en la audiencia</p>
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
                    <td></td>
                </tr>
            </thead>

            <tbody>
               
                @foreach ( $expediente->videoAudiencia as $video)
                <tr>
                    <td> {{ $video->nombre }} </td>
                    <td> {{ $video->duracion }} </td>
                    <td>
                        <div class="d-flex justify-content-end">
                            {{-- <a class="btn btn-sm btn-outline-secondary me-1" href="{{ $video->url }}">Ver</a> --}}

                            {{-- permiso de descargar archivos --}}
                            @if ( Auth::user()->tipoUsuario->permiso->descargar)
                                <a class="btn btn-sm btn-outline-secondary" href="{{ route('video.download.audiencia', encrypt($video->id)) }}">Descargar</a>
                            @endif
                           
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
     {{--  {{ $expediente }} --}}
  </div>

</div>
@endsection

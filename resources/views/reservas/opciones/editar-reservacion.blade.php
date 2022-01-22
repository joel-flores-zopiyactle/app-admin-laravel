@extends('layouts.dashboard')

@section('title')
    Editar servación de la sala
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Reagendar audiencia actual</h4>
    </div>

    <hr>

    <x-alert-message/>

    <div>

        <form action="{{ route('update.room', $expediente->audiencia->id) }}" method="POST">
            @csrf

            @method('PUT')

            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label class="form-label">Numero de Expediente:</label>
                        <input type="text" class="form-control" value="{{ $expediente->numero_expediente}}" disabled>
                    </div>
                </div>
                
                <div class="col-3">
                    <div class="mb-3">
                        <label for="folio" class="form-label">Folio:</label>
                        <input type="number" class="form-control @error('folio') is-invalid @enderror" name="folio" id="folio" value="{{ $expediente->folio }}" disabled placeholder="Ingresar Folio">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="sala" class="form-label">Sala:</label>
                        <select class="form-select  @error('sala_id') is-invalid @enderror" name="sala_id" id="sala" value="{{ old('sala_id') }}">
                            <option value=" {{  $salaActual->id }} "> {{ $salaActual->sala }} </option>
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}">{{ $sala->sala}}</option>
                            @endforeach
                          </select>
                        @error('sala_id')
                            <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                        @enderror
                    </div>
                </div>
            </div>

             {{-- TIEMPOS --}}
            <div class="row">

                <div class="col-4">
                    <div class="mb-3">
                        <label for="fechaCelebracion" class="form-label">Fecha de Celebración:</label>
                        <input type="date" class="form-control @error('fechaCelebracion') is-invalid @enderror" name="fechaCelebracion" id="fechaCelebracion" value="{{ isset($expediente->audiencia->fechaCelebracion) ?$expediente->audiencia->fechaCelebracion : old('fechaCelebracion') }}">
                        @error('fechaCelebracion')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-4">
                        <label for="horaInicio" class="form-label">Hora de Inicio:</label>
                        <input type="time" class="form-control @error('horaInicio') is-invalid @enderror" name="horaInicio" id="horaInicio" value="{{ isset($expediente->audiencia->horaInicio) ?$expediente->audiencia->horaInicio : old('horaInicio') }}">
                        @error('horaInicio')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-3">
                    <div class="mb-4">
                        <label for="horaFinalizar" class="form-label">Hora a Finalizar:</label>
                        <input type="time" class="form-control  @error('horaFinalizar') is-invalid @enderror" name="horaFinalizar" id="horaFinalizar" value="{{ isset($expediente->audiencia->horaFinalizar) ?$expediente->audiencia->horaFinalizar : old('horaFinalizar') }}">
                        @error('horaFinalizar')
                            <div class="alert alert-danger mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>

           {{--  <div class="row">
                <div class="col-3">
                    <div class="mb-3">
                        <label for="sala" class="form-label">Estado audiencia:</label>
                        <select class="form-select  @error('estado_audiencia') is-invalid @enderror" name="estado_audiencia_id" id="sala" value="{{ old('estado_audiencia') }}">
                            <option value=" {{  $estadoAudienciaActual->id }} "> {{ $estadoAudienciaActual->estado }} </option>
                            @foreach ($estadoAudiencia as $estado)
                                <option value="{{ $estado->id }}">{{ $estado->estado}}</option>
                            @endforeach
                          </select>
                        @error('estado_audiencia')
                            <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                        @enderror
                    </div>
                </div>
            </div> --}}

            <hr>
          <div>
            <a href="{{ route('reservas.salas') }}" class="btn btn-outline-danger me-2">Regresar</a>
            <button type="submit" class="btn btn-success">Reagendar</button>
          </div>
        </form>


    </div>
</div>
@endsection

@section('js')
   
@endsection

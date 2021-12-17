@extends('layouts.dashboard')

@section('content')
<div>
    <h2>Reservar nueva sala</h2>
    <hr>

    <div class="mt-2">
        <x-alert-message />
    </div>

    <form action="{{ route('post-room') }}" method="POST">

        @csrf

        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">Numero de Expediente</label>
                    <input type="number" class="form-control" value="{{$numeroDeExpediente}}" disabled>
                </div>
            </div>
            
            <div class="col-3">
                <div class="mb-3">
                    <label for="folio" class="form-label">Folio</label>
                    <input type="number" class="form-control @error('folio') is-invalid @enderror" name="folio" id="folio" value="{{ old('folio') }}" placeholder="Ingresar Folio">
                    @error('folio')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-4">
                <div class="mb-3">
                    <label for="juez" class="form-label">Juez</label>
                    <input type="text" class="form-control @error('juez') is-invalid @enderror" name="juez" id="juez" value="{{ old('juez') }}" placeholder="Nombre del Juez">
                    @error('juez')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="juzgado" class="form-label">Juzgado</label>
                    <input type="text" class="form-control @error('juzgado') is-invalid @enderror" name="juzgado" id="juzgado" value="{{ old('juzgado') }}" placeholder="Nombre del Juzgado">
                    @error('juzgado')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="actor" class="form-label">Actor</label>
                    <input type="text" class="form-control  @error('actor') is-invalid @enderror" name="actor" id="actor" value="{{ old('actor') }}" placeholder="Nombre del Actor">
                    @error('actor')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

        </div>

        <div class="row">
            
            <div class="col-4">
                <div class="mb-3">
                    <label for="demandado" class="form-label">Demandado:</label>
                    <input type="text" class="form-control @error('demandado') is-invalid @enderror" name="demandado" id="demandado" value="{{ old('demandado') }}" placeholder="Nombre del Demandado">
                    @error('demandado')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="secretario" class="form-label">Secretario:</label>
                    <input type="text" class="form-control @error('secretario') is-invalid @enderror" name="secretario" id="secretario" value="{{ old('secretario') }}" placeholder="Nombre del Secretario">
                    @error('secretario')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        {{-- LISTAS DE SELECCION --}}
        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label for="centroJusticia" class="form-label">Centro de justicia</label>
                    <select class="form-select  @error('centroJusticia_id') is-invalid @enderror"  name="centroJusticia_id" value="{{ old('centroJusticia_id') }}">
                        <option selected>Seleccione una un Centro</option>
                        @foreach ($listaCentroJusticia as $centro)
                            <option value="{{ $centro->id }}">{{ $centro->nombre}}</option>
                        @endforeach
                      </select>
                    @error('centroJusticia_id')
                        <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="sala" class="form-label">Sala:</label>
                    <select class="form-select  @error('sala_id') is-invalid @enderror" name="sala_id" id="sala" value="{{ old('sala_id') }}">
                        <option selected>Seleccione una Sala</option>
                        @foreach ($salas as $sala)
                            <option value="{{ $sala->id }}">{{ $sala->sala}}</option>
                        @endforeach
                      </select>
                    @error('sala_id')
                        <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="tipo_id" class="form-label">Tipo de audiencia</label>
                    <select class="form-select  @error('tipo_id') is-invalid @enderror" name="tipo_id" id="tipo_id" value="{{ old('tipo_id') }}">
                        <option selected>Seleccione una audiencia</option>
                        @foreach ($listaTipoAudiencia as $audiencia)
                            <option value="{{ $audiencia->id }}">{{ $audiencia->nombre}}</option>
                        @endforeach
                      </select>
                    @error('tipo_id')
                        <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="juicio" class="form-label">Tipo de Juicio</label>
                    <select class="form-select  @error('juicio_id') is-invalid @enderror" name="juicio_id" id="juicio" value="{{ old('juicio_id') }}" >
                        <option selected>Seleccione un Juicios</option>
                        @foreach ($listaTipoJuicio as $juicio)
                            <option value="{{ $juicio->id }}">{{ $juicio->nombre}}</option>
                        @endforeach
                      </select>
                    @error('juicio_id')
                        <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                    @enderror
                </div>
            </div>
        </div>
        
        {{-- TIEMPOS --}}
        <div class="row">

            <div class="col-4">
                <div class="mb-3">
                    <label for="fechaCelebracion" class="form-label">Fecha de Celebración</label>
                    <input type="date" class="form-control @error('juicio_id') is-invalid @enderror" name="fechaCelebracion" id="fechaCelebracion" value="{{ old('fechaCelebracion') }}">
                    @error('fechaCelebracion')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="mb-4">
                    <label for="horaInicio" class="form-label">Hora de Inicio</label>
                    <input type="time" class="form-control @error('horaInicio') is-invalid @enderror" name="horaInicio" id="horaInicio" value="{{ old('horaInicio') }}">
                    @error('horaInicio')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-3">
                <div class="mb-4">
                    <label for="horaFinalizar" class="form-label">Hora a Finalizar</label>
                    <input type="time" class="form-control  @error('horaFinalizar') is-invalid @enderror" name="horaFinalizar" id="horaFinalizar" value="{{ old('horaFinalizar') }}">
                    @error('horaFinalizar')
                        <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <hr>

        <hr>

        <div class="mb-5 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Crear nueva audiencia</button>
        </div>
    </form>
</div>
@endsection
@extends('layouts.dashboard')

@section('title')
    Agendar nueva audiencia
@endsection

@section('content')
<div>
    <h3>Agendar nueva audiencia</h3>
    <hr>

    <div class="mt-2">
        <x-alert-message />
    </div>

    <form action="{{ route('post.room') }}" method="POST" autocomplete="off">

        @csrf

        <div class="row">
            <div class="col-3">
                <div class="mb-3">
                    <label class="form-label">Número de expediente:</label>
                    <input type="text" name="numero_expediente" class="form-control  @error('numero_expediente') is-invalid @enderror" value="{{ old('numero_expediente') }}"  placeholder="Ingresar número de expediente">
                    @error('numero_expediente')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    {{-- El campo num expediente es obligatorio. --}}
                    @enderror
                </div>
            </div>
            
            <div class="col-3">
                <div class="mb-3">
                    <label for="folio" class="form-label">Folio:</label>
                <input type="number" class="form-control @error('folio') is-invalid @enderror" name="folio" id="folio" value="{{ isset($folio) ? $folio : old('folio') }}" placeholder="Ingresar Folio"  readonly>
                    @error('folio')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="row">
            
            <div class="col-4">
                <div class="mb-3">
                    <label for="juez" class="form-label">Juez:</label>
                    <input type="text" class="form-control @error('juez') is-invalid @enderror" name="juez" id="juez" value="{{ old('juez') }}" placeholder="Nombre del juez">
                    @error('juez')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="juzgado" class="form-label">Juzgado:</label>
                    <input type="text" class="form-control @error('juzgado') is-invalid @enderror" name="juzgado" id="juzgado" value="{{ old('juzgado') }}" placeholder="Nombre del juzgado">
                    @error('juzgado')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="actor" class="form-label">Actor:</label>
                    <input type="text" class="form-control  @error('actor') is-invalid @enderror" name="actor" id="actor" value="{{ old('actor') }}" placeholder="Nombre del actor">
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
                    <input type="text" class="form-control @error('demandado') is-invalid @enderror" name="demandado" id="demandado" value="{{ old('demandado') }}" placeholder="Nombre del demandado">
                    @error('demandado')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <div class="col-4">
                <div class="mb-3">
                    <label for="secretario" class="form-label">Secretario:</label>
                    <input type="text" class="form-control @error('secretario') is-invalid @enderror" name="secretario" id="secretario" value="{{ old('secretario') }}" placeholder="Nombre del secretario">
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
                    <label for="centroJusticia" class="form-label">Centro de justicia:</label>

                    @if ($listaCentroJusticia->count() === 0)
                        <input type="text" class="form-control  @error('centroJusticia_id') is-invalid @enderror" placeholder="No hay un centro de justicia registrada todavía" disabled>
                        @error('centroJusticia_id')
                            <div class="alert alert-danger mt-1">{{ 'No hay un centro de justicia registrada todavía' }}</div>
                        @enderror
                    @elseif($salas->count() === 1) {{-- Si hay 1 centro mostramos como default con input type text --}}

                        @foreach ($listaCentroJusticia as $centro) 
                            <input type="hidden" name="centroJusticia_id" value="{{ $centro->id}}"> {{-- Envia el id del centro --}}
                            <input type="text" class="form-control @error('centroJusticia_id') is-invalid @enderror" value="{{ $centro->nombre}}" disabled> {{-- Muetsra el nombre del centro --}}
                        @endforeach  

                    @elseif($salas->count() > 1) {{-- Si hay mas de 1 mostramos un lista de centro para seleccionar --}}    
                        <select class="form-select  @error('centroJusticia_id') is-invalid @enderror"  name="centroJusticia_id" value="{{ old('centroJusticia_id') }}">
                            <option selected>Seleccione un centro de justicia</option>
                            @foreach ($listaCentroJusticia as $centro)
                                <option value="{{ $centro->id }}">{{ $centro->nombre}}</option>
                            @endforeach
                        </select>
                        @error('centroJusticia_id')
                            <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                        @enderror
                    @else
                        
                    @endif

                   
                    
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="sala"  class="form-label">Sala:</label>

                    @if ($listaCentroJusticia->count() === 0)
                        <input type="text" class="form-control @error('sala_id') is-invalid @enderror" placeholder="No hay una sala registrada todavía" disabled>
                        
                        @error('sala_id')
                            <div class="alert alert-danger mt-1">{{ 'No hay una sala registrada todavía' }}</div>
                        @enderror
                    @elseif($salas->count() === 1) {{-- Si hay 1 sala mostramos como default con input type text --}}

                        @foreach ($salas as $sala) 
                            <input type="hidden" name="sala_id" value="{{  $sala->id }}"> {{-- Envia el id de la sala --}}
                            <input type="text" class="form-control @error('sala_id') is-invalid @enderror" value="{{ $sala->sala }}" disabled> {{-- Muetsra el nombre de la sala --}}
                        @endforeach  

                    @elseif($salas->count() > 1) {{-- Si hay mas de 1 mostramos un lista de centro para seleccionar --}}    
                        <select class="form-select  @error('sala_id') is-invalid @enderror" name="sala_id" id="sala" value="{{ old('sala_id') }}">
                            <option selected>Seleccione una sala</option>
                            @foreach ($salas as $sala)
                                <option value="{{ $sala->id }}">{{ $sala->sala}}</option>
                            @endforeach
                        </select>
                        @error('sala_id')
                            <div class="alert alert-danger mt-1">{{ 'Debe de seleccionar una opción de la lista' }}</div>
                        @enderror
                    @else
                        
                    @endif
 
                </div>
            </div>

            <div class="col-3">
                <div class="mb-3">
                    <label for="tipo_id" class="form-label">Tipo de audiencia:</label>
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
                    <label for="juicio" class="form-label">Tipo de juicio:</label>
                    <select class="form-select  @error('juicio_id') is-invalid @enderror" name="juicio_id" id="juicio" value="{{ old('juicio_id') }}" >
                        <option selected>Seleccione un Juicio</option>
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
                    <label for="fechaCelebracion" class="form-label">Fecha de celebración</label>
                    <input type="date" class="form-control @error('fechaCelebracion') is-invalid @enderror" name="fechaCelebracion" id="fechaCelebracion" value="{{ old('fechaCelebracion') }}">
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

        {{-- VIDEOCONFERENCIA --}}
        <div class="row">
            <div class="col-5">
                <label>Habra videoconferencia?</label>
                <div class="form-group">
                    <label for="conferenciaSi" class="form-check-label me-3">
                        <input class="form-check-input" type="radio" name="videoconferencia" id="conferenciaSi" value="si">
                        Si
                    </label>

                    <label for="conferenciaNo" class="form-check-label">
                        <input class="form-check-input" type="radio" name="videoconferencia" id="conferenciaNo" value="no">
                        No
                    </label>
                </div>

                @error('videoconferencia')
                    <div class="alert alert-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
        </div>

        <hr>

        <div class="mb-5 d-flex justify-content-end">
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </div>
    </form>
</div>
@endsection
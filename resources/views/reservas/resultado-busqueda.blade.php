@extends('layouts.dashboard')

@section('title')
   Resultados
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Resultados</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('book.new.room') }}">Reservar Nueva Audiencia</a>
        </div>
    </div>

    <hr>

    <x-alert-message/>

    
    <div class="shadow p-2 mb-2 bg-body rounded card">
        @if (count($expedientes) > 0)

            <table class="table table-hover mt-2">
                <thead class="table-success">
                <tr>
                    <th scope="col">Número de expediente</th>
                    <th scope="col">Folio</th>
                    <th scope="col">Hora de Inicio</th>
                    <th scope="col">Fin de la audiencia</th>
                    <th scope="col">Tipo de Audiencia</th>
                    <th scope="col">Sala</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($expedientes as $expediente)
                            <tr>
                                <td>{{ $expediente->id }}</td>
                                <td>{{ $expediente->folio }}</td>
                                <td>{{ $expediente->audiencia->horaInicio }}</td>
                                <td>{{ $expediente->audiencia->horaFinalizar }}</td>
                                <td>{{ $expediente->audiencia->tipoAudiencia->nombre }}</td>
                                <td>{{ $expediente->audiencia->sala->sala }}</td>
                                <td> 
                                    <x-control-estado-audiencia :estadoAudiencia="$expediente->audiencia->estadoAudiencia" />                                       
                                </td>
                                <td>
                                    <x-btn-options-table :expedienteId="$expediente->id" :estado="$expediente->audiencia->estadoAudiencia" />                                 
                                </td>
                            </tr>
                        @endforeach                            
                </tbody>
            </table>  
            
        
        @else
            <div class="p-3">
                <h3>No hay resultados de la busqueda</h3>
            </div>
        @endif
    </div>

    <div class="mt-5">
        <a class="d-flex align-content-center" href="{{ route('reservas.salas') }}">
            <span class="iconify h3 mr-2" data-icon="bx:bxs-left-arrow-circle"></span> 
            <span>Regresar</span>
        </a>
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('title')
    Lista de reservas
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Administración de auduencia</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('book-new-room') }}">Reservar Nueva Audiencia</a>
        </div>
    </div>

    <hr>

    <x-alert-message/>
    

    <div class="shadow p-2 mb-2 bg-body rounded card">
        @if (count($expedientes) > 0)

            <div clas="w-50">
                <form  action="{{ route('search-room') }}" class="w-25 d-flex" method="post">
                    @csrf
                    @method('GET')
                    <input type="search" class="form-control me-1" name="num" id="buscar" placeholder="Buscar por número de expediente">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>

            <table class="table table-responsive table-hover mt-2">
                <thead class="table-success">
                <tr>
                    <th scope="col">Numero de expediente</th>
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
                                    <x-btn-options-table :expedienteId="$expediente->id" />
                                </td>
                            </tr>

                           
                        @endforeach                            
                </tbody>
            </table>  
            
            {{ $expedientes->links() }} 
        
        @else
            <div class="p-3">
                <h3>No hay salas reservadas todabía</h3>
            </div>
        @endif
    </div>
</div>

@endsection

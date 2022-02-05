@extends('layouts.dashboard')

@section('title')
    Lista de reservas
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Administración de auduencia</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('book.new.room') }}">Agendar nueva audiencia</a>
        </div>
    </div>

    <hr>

    <x-alert-message/>
    

    <div class="shadow p-2 mb-2 bg-body rounded card">
        @if (count($expedientes) > 0)

            <div clas="w-50">
                <form  action="{{ route('search.room') }}" class="w-25 d-flex" method="post">
                    @csrf
                    @method('GET')
                    <input type="search" class="form-control me-1" name="num" id="buscar" placeholder="Buscar por número de expediente">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                </form>
            </div>

            <hr>

            <table class="table table-responsive table-hover mt-2">
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
                                <td>{{ $expediente->numero_expediente }}</td>
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
            
            {{ $expedientes->links() }} 
        
        @else
            <div class="p-3">
                <h3>No hay ningún audiencia agendada todavía</h3>
            </div>
        @endif
    </div>
</div>

@endsection

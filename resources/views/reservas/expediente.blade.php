@extends('layouts.dashboard')

@section('title')
    Buscar Expedientes
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Buscar expediente</h4>
    </div>

    <hr>

    <x-alert-message/>

    <div>
        {{-- formulario de busqueda --}}
        <form action="{{ route('buscar.expediente') }}" method="POST">
            @csrf
            @method('GET')

            <div>
                <form-search />
            </div>
        </form>
    </div>
    

   
        @isset($resultExpedientes)
            @if (count($resultExpedientes) > 0)
            <div class="shadow p-2 mb-2 bg-body rounded card mt-3">
                <table class="table table-hover mt-2">
                    <thead class="table-success">
                    <tr>
                        <th scope="col">Número de expediente</th>
                        <th scope="col">Folio</th>
                        <th scope="col">Hora de Inicio</th>
                        <th scope="col">Fin de la audiencia</th>
                        <th scope="col">Tipo de audiencia</th>
                        <th scope="col">Sala</th>
                        <th scope="col">Estado</th>
                        <th class="text-center" scope="col"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($resultExpedientes as $expediente)
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


                <a class="mb-3" href="{{ route('buscar.expediente') }}">Regresar</a>
                
            {{--   {{ $resultExpedientes->links() }}  --}}
            </div>
            @else
                <div class="p-3">
                
                </div>
            @endif
           
        @endisset
        
   
</div>
@endsection

@section('js')
    <script src="{{ asset('js/filtroBusqueda.js') }}"></script>
@endsection

@extends('layouts.dashboard')

@section('title')
    Buscar Expedientes
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Buscar Expediente</h4>
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
                    @foreach ($resultExpedientes as $expediente)
                        <tr>
                            <td>{{ $expediente->id }}</td>
                            <td>{{ $expediente->folio }}</td>
                            <td>{{ $expediente->audiencia->horaInicio }}</td>
                            <td>{{ $expediente->audiencia->horaFinalizar }}</td>
                            <td>{{ $expediente->audiencia->tipoAudiencia->nombre }}</td>
                            <td>{{ $expediente->audiencia->sala->sala }}</td>
                            <td>{{ $expediente->audiencia->estadoAudiencia->estado }}</td>
                            <td>
                                <div class="d-flex justify-content-center align-items-center">
                                    <div class="dropdown">
                            
                                        <button class="btn btn-light rounded-circle d-flex justify-content-center align-items-center p-1"  type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            <span class="iconify h4 m-0" data-icon="fluent:more-circle-32-regular" data-rotate="90deg"></span>
                                        </button>

                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        
                                            <li>
                                                <form action="{{route('delete.room', $expediente->id)}}" method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="dropdown-item" type="submit" 
                                                    onclick="return confirm('¿Estas seguro de eliminar el expdiente numero : {{ $expediente->id }}?')" title="Eliminar">
                                                    <span class="iconify mr-1" data-icon="fluent:delete-20-regular"></span>Eliminar
                                                    </button>
                                                </form>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="{{ route('show.pdf.expediente', $expediente->id) }}"><span class="iconify mr-1" data-icon="cil:print"></span>Imprimir Expediente</a>
                                            </li>

                                        </ul>
                                    </div>
                                </div>
                            
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

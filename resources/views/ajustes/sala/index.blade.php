@extends('layouts.dashboard')

@section('title')
    Sala
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Sala</h4>

         {{-- 
            El siguiente condicion evalua si ya hay un registro en la base de datos, si existe un registro ocultamos la opcion
            agregar un nuevo sala, si queremos agregar mas de un centro simplemente quitamos el condicional...
        --}}
        @if ($salas->count() === 0)
            <div>
                <a class="btn btn-primary btn-sm" href="{{ route('create.sala') }}">Registrar sala</a>
            </div>
        @endif
    </div>

    <hr>

    {{-- Lista de datos  --}}
   <x-alert-message />

   
   
    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($salas) > 0)
            <table class="table table-hover">
                <thead class="table-success">
                <tr>
                    <th scope="col">Sala</th>
                    <th scope="col">Número</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($salas as $sala)
                        <tr>
                            <td>{{ $sala->sala }}</td>
                            <td>{{ $sala->numero}}</td>
                            <td>{{ $sala->ubicacion}}</td>
                            <td>{{ $sala->capacidad}}</td>
                            <td>
                                @if ($sala->estado)
                                    Disponible
                                @else
                                    No disponible
                                @endif

                            </td>
                            <td>
                                <div class="text-center d-flex justify-content-center">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.sala', encrypt($sala->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>

                                     {{-- 
                                        El siguiente codigo ejecuta la funcion de eliminar una sala
                                        Para usar esta opcion hay que descomentar el codigo de form eleminar
                                    --}}
    
                                   {{--  <form class="ml-2" action="{{route('delete.sala', $sala->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                        onclick="return confirm('¿Estas seguro de eliminar: {{$sala->sala}}?')">
                                            <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                        </button>
                                    </form> --}}
                                </div>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>  
            
            <div>
                {{ $salas->links() }}  
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No hay sala registrada todavía</h3>
            </div>
        @endif
    </div>
</div>
@endsection

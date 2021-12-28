@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Lista de salas</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create.sala') }}">Agregar nuevo sala</a>
        </div>
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
                    <th scope="col">Numero</th>
                    <th scope="col">Ubicación</th>
                    <th scope="col">Capacidad</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col">Acciones</th>
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
                            <td class="text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.sala', encrypt($sala->id)) }}" title="Editar"> 
                                    <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                </a>

                                <form class="ml-2" action="{{route('delete.sala', $sala->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                    onclick="return confirm('¿Estas seguro de eliminar: {{$sala->sala}}?')">
                                        <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>  
            
            <div>
                {{ $salas->links() }}  
            </div>
        @else
            <div class="p-3">
                <h3>No hay salas todabia</h3>
            </div>
        @endif
    </div>
</div>
@endsection

@extends('layouts.dashboard')

@section('title')
    Audiencias
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Listado de Audiencias</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create.audiencia') }}">Agregar nueva audiencia</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />
   
   
    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($audiencias) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($audiencias as $audiencia)
                        <tr>
                            <td>{{ $audiencia->nombre }}</td>
                            <td>{{ $audiencia->descripcion}}</td>
                            <td>
                                @if ($audiencia->estado)
                                    Disponible
                                @else
                                    No disponible
                                @endif

                            </td>
                            <td>
                                <div class="text-center d-flex justify-content-center">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.audiencia', encrypt($audiencia->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>
    
                                    <form class="ml-2" action="{{route('delete.audiencia', $audiencia->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                        onclick="return confirm('¿Estas seguro de eliminar: {{ $audiencia->nombre }}?')">
                                            <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>  

            <div>
                {{ $audiencias->links() }}  
            </div>   
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No hay audiencias registradas todavía</h3>
            </div>
        @endif
    </div>
</div>
@endsection

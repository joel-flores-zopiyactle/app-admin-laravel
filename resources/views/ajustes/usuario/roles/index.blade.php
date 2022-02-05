@extends('layouts.dashboard')

@section('title')
    Roles de administración     
@endsection

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4> Control de roles para la administración del sistema</h4>
        <div>
            <a class="btn btn-outline-success btn-sm me-3" href="{{ route('usuarios') }}">Listado de usuarios</a>
            <a class="btn btn-primary btn-sm" href="{{ route('create.roles.usuarios') }}">Agregar nuevo rol</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />   


    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($roles) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Tipo de Rol</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Disponible</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->tipo }}</td>
                            <td>{{ $rol->descripcion }}</td>
                            <td>
                                @if ($rol->estado)
                                    <p>Disponible</p>
                                @else
                                    <p>No Disponible</p>
                                @endif

                            </td>
                            <td>
                                @if ($rol->id !== 1)
                                <div class="text-center d-flex justify-content-center">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.roles.usuarios', encrypt($rol->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>

                                    <form class="ml-2" action="{{route('delete.roles.usuarios', $rol->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                        onclick="return confirm('¿Estas seguro de eliminar: {{$rol->tipo}}?')">
                                            <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                        </button>
                                    </form>
                                </div>
                                @endif
                               
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>     
            <div>
                {{-- {{ $juicios->links() }} --}}  
            </div> 
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No hay roles de usuario registrados todavía para el control del sistema</h3>
            </div>
        @endif
    </div>
   
   
</div>
@endsection

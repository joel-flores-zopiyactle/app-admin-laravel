@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Listado de roles</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create.rol') }}">Agregar nuevo rol</a>
        </div>
    </div>

    <hr>

    <x-alert-message />

   {{-- Lista de datos  --}}
    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($roles) > 0)
            <table class="table table-hover">
                <thead class="table-success">
                <tr>
                    <th scope="col">Rol</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $rol)
                        <tr>
                            <td>{{ $rol->rol }}</td>
                            <td>{{ $rol->descripcion}}</td>
                            <td>
                                @if ($rol->estado)
                                    Disponible
                                @else
                                    No disponible
                                @endif

                            </td>
                            <td>
                                <div class="text-center d-flex justify-content-center">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.rol', encrypt($rol->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>
    
                                    <form class="ml-2" action="{{route('delete.rol', $rol->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                        onclick="return confirm('¿Estas seguro de eliminar {{$rol->rol}}?')">
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
                {{ $roles->links() }}  
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No hay roles registradas todavía</h3>
            </div>
        @endif
    </div>
</div>
@endsection

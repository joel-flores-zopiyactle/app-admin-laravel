@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Lista de roles</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create-rol') }}">Agregar nuevo rol</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

   
   
    <div class="card p-2 mt-3">
        @if (count($roles) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Rol</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col">Acciones</th>
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
                            <td class="text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit-rol', $rol->id) }}" title="Editar"> 
                                    <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                </a>

                                <form class="ml-2" action="{{route('delete-rol', $rol->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" onclick="return confirm('¿Estas seguro de eliminar el datos?')">
                                        <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>     
        @else
            <div class="p-3">
                <h3>No hay Roles todabia</h3>
            </div>
        @endif
    </div>
</div>
@endsection

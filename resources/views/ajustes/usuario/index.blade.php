@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4> Control de usuarios </h4>
        <div>
            <a class="btn btn-outline-primary btn-sm me-3" href="{{ route('roles.usuarios') }}">Listado de roles de administración</a>
            <a class="btn btn-primary btn-sm" href="{{ route('create.usuario') }}">Agregar nuevo usuario</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />   


    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($usuarios) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Correo</th>
                    <th scope="col">Teléfono</th>
                    <th scope="col">Tipo de usuarios</th>
                    <th scope="col">Avatar</th>
                    <th class="text-center" scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->tipoUsuario->tipo }}</td>
                            <td>
                                <img width="40px" class="rounded-circle" src="{{ Storage::url($usuario->avatar) }}" alt="">
                            </td>
                            <td>
                                <div class="text-center d-flex justify-content-end">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1 me-2" href="{{ route('edit.usuario', encrypt($usuario->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>

                                    {{-- Si el usuarios es un administrador principal desactivamos la opcion de eleiminar --}}
                                    @if ($usuario->id !== 1)
                                        <form class="ml-2" action="{{route('delete.usuario', $usuario->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                            onclick="return confirm('¿Estas seguro de eliminar: {{$usuario->name}}?')">
                                                <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                            </button>
                                        </form>
                                    @endif
                                </div>
                               
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
                <h3 class="fs-5">No hay usuarios registrados todavía</h3>
            </div>
        @endif
    </div>
   
   
</div>
@endsection

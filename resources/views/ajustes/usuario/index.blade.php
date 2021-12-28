@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4> Control de usuarios </h4>
        <div>
            <a class="btn btn-outline-primary btn-sm me-3" href="{{ route('roles.usuarios') }}">Lista de roles de administración</a>
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
                    <th scope="col">Telefono</th>
                    <th scope="col">Tipo de usuarios</th>
                   {{--  <th scope="col">Avatar</th> --}}
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->name }}</td>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ $usuario->telefono }}</td>
                            <td>{{ $usuario->tipoUsuario->tipo }}</td>
                           {{--  <td>
                                <img src="{{asset( $usuario->avatar) }}" alt="">
                            </td> --}}
                            <td>
                                <div class="text-center d-flex justify-content-center">
                                    <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.usuario', encrypt($usuario->id)) }}" title="Editar"> 
                                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                    </a>

                                    <form class="ml-2" action="{{route('delete.usuario', $usuario->id)}}" method="post">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                        onclick="return confirm('¿Estas seguro de eliminar: {{$usuario->name}}?')">
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
                {{-- {{ $juicios->links() }} --}}  
            </div> 
        @else
            <div class="p-3">
                <h3>No hay usuarios registrados</h3>
            </div>
        @endif
    </div>
   
   
</div>
@endsection

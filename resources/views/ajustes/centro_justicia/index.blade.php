@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Lista de centros de justicia</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create-centro') }}">Agregar nuevo centro</a>
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
        @if (count($centros) > 0)
            <table class="table table-hover">
                <thead class="table-primary">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($centros as $centro)
                        <tr>
                            <td>{{ $centro->nombre }}</td>
                            <td>{{ $centro->descripcion}}</td>
                            <td>
                                @if ($centro->estado)
                                    Disponible
                                @else
                                    No disponible
                                @endif

                            </td>
                            <td class="text-center d-flex justify-content-center">
                                <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit-centro', $centro->id) }}" title="Editar"> 
                                    <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                </a>

                                <form class="ml-2" action="{{route('delete-centro', $centro->id)}}" method="post">
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
                <h3>No hay centros de justacia todabia</h3>
            </div>
        @endif
    </div>
</div>
@endsection

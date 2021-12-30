@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="con d-flex justify-content-between align-items-center">
        <h4>Lista de centros de justicias</h4>
        <div>
            <a class="btn btn-primary btn-sm" href="{{ route('create.centro') }}">Agregar nuevo centro</a>
        </div>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />   
   
    <div class="shadow p-3 mb-5 bg-body rounded card">
        @if (count($centros) > 0)
            <table class="table table-hover">
                <thead class="table-success">
                <tr>
                    <th scope="col">Nombre</th>
                    <th scope="col">Descripción</th>
                    <th scope="col">Estado</th>
                    <th class="text-center" scope="col"></th>
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
                                <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="{{ route('edit.centro', encrypt($centro->id) ) }}" title="Editar"> 
                                    <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                                </a>

                                <form class="ml-2" action="{{route('delete.centro', $centro->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                                    onclick="return confirm('¿Estas seguro de eliminar : {{ $centro->nombre }}?')" title="Eliminar">
                                        <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                                    </button>
                                </form>
                            </td>
                        </tr>       
                    @endforeach              
                </tbody>
            </table>  
            
            {{ $centros->links() }}  
        @else
            <div class="d-flex justify-content-center align-items-center">
                <h3 class="fs-5">No hay centros de justicia registradas todavía</h3>
            </div>
        @endif
    </div>
</div>
@endsection

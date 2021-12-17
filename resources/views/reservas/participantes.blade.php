@extends('layouts.dashboard')

@section('content')
  <div class="container-fluid">
   <div>
    <h2>Agregar lista de participantes</h2>
    <hr>
   </div>

   <x-alert-message />

    <div>
      <form class="w-100" action="{{ route('post-participante') }}" method="post">
        @csrf
        <div class="row">
          <div class="col-4">
            <input type="number" value="{{ $id }}" name="audiencia_id" hidden>
            <input type="text" class="form-control @error('nombre') is-invalid @enderror" name="nombre" value="{{ old('nombre') }}" placeholder="Nombre completo ...">
            @error('nombre')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-3">
            <select class="form-select @error('rol_id') is-invalid @enderror" name="rol_id">
              <option selected>Seleccione un Rol</option>
              @foreach ($roles as $rol)
                <option value="{{$rol->id}}">{{$rol->rol}}</option>
              @endforeach            
            </select>

            @error('rol_id')
            <div class="alert alert-danger mt-1">{{ '¿Debe  de seleccione un Rol para el participante?' }}</div>
            @enderror
          </div>

          <div class="col-4">
            <textarea class="form-control  @error('descripcion') is-invalid @enderror" id="desc" rows="1" name="descripcion" value="{{ old('descripcion') }}" placeholder="Descripcion del participante..."></textarea>
            @error('descripcion')
            <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
          </div>

          <div class="col-1">
            <button type="submit" class="btn btn-primary d-flex justify-content-center align-items-center">
              <span class="iconify h5" data-icon="akar-icons:person-add"></span>
            </button>
          </div>
        </div>

      </form>
    </div>
   
    <hr>

    <div class="shadow p-2 mb-2 bg-body rounded card">
      <h6 class="mb-1">Total de participantes: <strong>{{count($participantes)}}</strong></h6>

      @if (count($participantes) > 0)
        <table class="table table-hover">
          <thead class="table-success">
          <tr>
              <th scope="col">Nombre</th>
              <th scope="col">Rol</th>
              <th scope="col">Descripción</th>
              <th class="text-center" scope="col"></th>
          </tr>
          </thead>
          <tbody>

            @foreach ($participantes as $participante)
                <tr>
                  <td>{{$participante->nombre }}</td>
                  <td>{{$participante->rol->rol}}</td>
                  <td>{{ $participante->descripcion}}</td>
                  <td>
                    <div class="text-center d-flex justify-content-center">
                      <a class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" href="#" title="Editar"> 
                        <span class="iconify h5 m-0" data-icon="akar-icons:edit"></span>
                      </a>

                      <form class="ml-2" action="#" method="post">
                          @csrf
                          @method('DELETE')
                          <button class="btn btn-sm btn-light rounded-circle d-flex justify-content-center align-items-center p-1" type="submit" 
                          onclick="return confirm('¿Estas seguro de eliminar {{$participante->nombre}}?')">
                              <span class="iconify h5 m-0" data-icon="fluent:delete-20-filled"></span>
                          </button>
                      </form>
                    </div>
                </td>
                </tr>
            @endforeach
                                  
          </tbody>
        </table>
      @else
        <div>
          <h2>No hay usuarios registrados todabia</h2>
        </div>   
      @endif 
    </div>
    
    <hr>
    
    <div>
        <form action="{{ route('reservas-salas') }}">
          <button class="btn btn-primary">Finalizar</button>
        </form>
    </div>
  </div>

  
@endsection

@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center">
        <h4>Actualizar datos de usuario </h4>
    </div>

    <hr>

    {{-- Lista de datos  --}}
    <x-alert-message />  
    
    <div>
        <form method="POST" action="{{ route('update.usuario', encrypt($usuario->id)) }}" enctype="multipart/form-data">
            @csrf

            @method('PUT')
           
            <div class="row mb-3">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $usuario->name }}" required autocomplete="name" placeholder="Nombre de usuario" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $usuario->email }}" placeholder="Correo electrónico" disabled required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>


            <div class="row mb-3">
                <label for="telefono" class="col-md-4 col-form-label text-md-right">{{ __('Teléfono') }}</label>

                <div class="col-md-6">
                    <input id="telefono" type="tel" class="form-control @error('telefono') is-invalid @enderror" name="telefono" value="{{ $usuario->telefono }}" placeholder="Número de Teléfono" required autocomplete="telefono">

                    @error('telefono')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">

                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Avatar') }}</label>

                <div class="col-md-6">
                    <div class="mb-2">
                        {{-- <img width="80px" height="80px" class="rounded-circle" src="{{ Storage::url($usuario->avatar) }}" alt="" style="background-image: cover;"> --}}
                        <div class="avatar" style="background-image: url({{ Storage::url($usuario->avatar) }})"></div>
                    </div>
                    <input id="avatar" type="file" class="form-control @error('avatar') is-invalid @enderror" name="avatar" value="{{ old('avatar') }}" autocomplete="avatar" >

                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            {{-- Si el usuario es un Administrador principal desactivamos la opcion de cambiar tipo de usuario --}}
           
            <div class="row mb-3">
                <label for="avatar" class="col-md-4 col-form-label text-md-right">{{ __('Tipo de usuario') }}</label>

                <div class="col-md-6">
                    <select class="form-control  @error('tipo_usuario_id') is-invalid @enderror" name="tipo_usuario_id" id="tipo_usuario_id">
                        <option value="{{ encrypt($tipoUsuarioActual->id) }}">{{ $tipoUsuarioActual->tipo }}</option>
                        @if($usuario->id !== 1)
                            @foreach ($tipoUsuarios as $tipo)
                                <option value="{{ encrypt($tipo->id) }}"> {{ $tipo->tipo }} </option>
                            @endforeach
                        @endif
                    </select>

                    @error('tipo_usuario_id')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
           
           
            <div class="row mb-0 mt-3">
                <div class="col-md-6 offset-md-4">
                    <a href="{{ route('usuarios') }}" class="btn btn-outline-danger">
                        {{ __('Regresar') }}
                    </a>

                    <button type="submit" class="btn btn-primary">
                        {{ __('Actualizar') }}
                    </button>
                </div>
            </div>
        </form>

        {{-- Actualizar contraseña del usuario --}}
        <form method="POST" action="{{ route('update.password', $usuario->id) }}">
            @csrf
            @method('PUT')
            <hr>

            <small>Actualizar contraseña nueva (*Opcional)</small>


            <div class="row mb-3 mt-4">
                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Nueva contraseña') }}</label>

                <div class="col-md-6">
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Nueva Contraseña" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="row mb-3">
                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                <div class="col-md-6">
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="Confirmar contraseña" required autocomplete="new-password">
                </div>
            </div>

            <div class="row mb-0 mt-3">
                <div class="col-md-6 offset-md-4">
                    <button type="submit" class="btn btn-success">
                        {{ __('Actualizar contraseña') }}
                    </button>
                </div>
            </div>

        </form>
    </div>
   
</div>
@endsection

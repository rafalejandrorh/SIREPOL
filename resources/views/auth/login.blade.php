@extends('layouts.auth_app')
@extends('auth.partials.header')
@section('content')
    <div class="login-main-text">
        <div class="title text-center">
            <h2 style="color:#000000"><b>Sistema de Reseña Policial</b></h2>
            <h2 style="color:#000000"><b>Servicio de Investigación Penal</b></h2>
        </div>  
    </div>
    <div class="card card-primary">
        <div class="card-header">
            <h4>Inicio de Sesión</h4>
        </div>

        <div class="card-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger p-0">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group has-feedback">
                    <label for="email">Usuario</label>
                    <input aria-describedby="emailHelpBlock" id="email" type="text"
                           class="form-control{{ $errors->has('users') ? ' is-invalid' : '' }}" name="users"
                           placeholder="Ingresa tu Usuario" tabindex="1"
                           value="{{ (Cookie::get('users') !== null) ? Cookie::get('users') : old('users') }}" autofocus
                           required>   
                    <div class="invalid-feedback">
                        {{ $errors->first('users') }}
                    </div>
                </div>

                <div class="form-group">
                    <div class="d-block">
                        <label for="password" class="control-label">Contraseña</label>
                    </div>
                    <input aria-describedby="passwordHelpBlock" id="password" type="password"
                           value="{{ (Cookie::get('password') !== null) ? Cookie::get('password') : null }}"
                           placeholder="Ingresa tu Contraseña"
                           class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password"
                           tabindex="2" required>
                    <div class="invalid-feedback">
                        {{ $errors->first('password') }}
                    </div>
                </div>

                {{-- <div class="form-group">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="remember" class="custom-control-input" tabindex="3"
                               id="remember"{{ (Cookie::get('remember') !== null) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="remember">Recuérdame</label>
                    </div>
                </div> --}}

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                        Ingresar
                    </button>
                </div>

                <div class="form-group">
                    <p class="mt-3 mb-1">
                        <a href="{{ route('password.request') }}">Olvide mi Contraseña</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
@endsection

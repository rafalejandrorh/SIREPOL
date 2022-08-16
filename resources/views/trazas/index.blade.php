@extends('layouts.app')

@section('content')
<section class="section">
    <div class="section-header">
        <h3 class="page__heading"><b>Trazas</b></h3>
    </div>
    <div class="section-body">
        <div class="row">
            <div class="col-lg-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <a class="btn btn-primary" href="{{ route('historial_sesion.index') }}"><i class='fa fa-history'> Historial de Sesión</i></a>
                                <br><br><hr>
                                <a class="btn btn-primary" href="{{ route('traza_resenna.index') }}"><i class='fa fa-balance-scale'> Reseñas</i></a>
                                <br><br><hr>
                                <a class="btn btn-primary" href="{{ route('traza_user.index') }}"><i class='fa fa-user'> Usuarios</i></a>
                                <br><br><hr>
                                <a class="btn btn-primary" href="{{ route('traza_roles.index') }}"><i class='fa fa-key'> Roles</i></a>
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
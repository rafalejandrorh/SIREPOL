@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Detallado de Usuario</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                     
                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif
 
                        {{-- {!! Form::open(array('method' => 'PATCH','route' => 'users.update')) !!} --}}
                        {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update', $user->id]]) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ route('trazas.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="name">Credencial</label>
                                    {!! Form::text('credencial', $user->funcionario->credencial, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Cédula</label>
                                    {!! Form::text('cedula', $user->funcionario->person->cedula, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Nombre</label>
                                    {!! Form::text('primer_nombre', $user->funcionario->person->primer_nombre, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Nombre</label>
                                    {!! Form::text('segundo_nombre', $user->funcionario->person->segundo_nombre, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Apellido</label>
                                    {!! Form::text('primer_apellido', $user->funcionario->person->primer_apellido, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Apellido</label>
                                    {!! Form::text('segundo_apellido', $user->funcionario->person->segundo_apellido, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Género</label>
                                    {!! Form::text('id_genero', $user->funcionario->person->genero->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Fecha de Nacimiento</label>
                                    {!! Form::text('fecha_nacimiento', $user->funcionario->person->fecha_nacimiento, ['class'=>'form-control datepicker','autocomplete' => 'off', 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estado de Nacimiento</label>
                                    {!! Form::text('id_estado_nacimiento', $user->funcionario->person->estado_nacimiento->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Teléfono</label>
                                    {!! Form::text('telefono', $user->funcionario->telefono, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Jerarquía</label>
                                    {!! Form::text('id_jerarquia', $user->funcionario->jerarquia->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estatus Laboral</label>
                                    {!! Form::text('id_estatus', $user->funcionario->estatus->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="">Roles</label>
                                    {!! Form::select('roles', $roles, $user->roles, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Usuario</label>
                                    {!! Form::text('users', $user->users, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

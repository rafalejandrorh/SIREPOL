@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Realizar Reseña</b></h3>
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
                        
                        {!! Form::open(array('route' => 'resenna.store','method' => 'POST','files' => true)) !!}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ route('resenna.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="card">
                                    <div class="card-block border-bottom">
                                        <div class="row d-flex align-items-center">
                                            <div class="col-auto">
                                                <i class="fa fa-address-card f-30 text-c-blue"></i>
                                                <span class="help-block">Ficha Fotográfica</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-block">
                                        {!! Form::file('url_foto', ['class' => 'form-control-file', 'id'=>'url', 'accept' => 'image/*']) !!}
                                        
                                    </div>
                                </div>
                            </div>    
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="name">Fecha de Reseña</label>
                                    {!! Form::date('fecha_resenna', null, array('class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estatus de Documentación</label>
                                    {!! Form::select('id_tipo_documentacion', $documentacion, [], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Letra de Cédula</label>
                                    {!! Form::select('letra_cedula', ['V' => 'V', 'E' => 'E'], 'V', array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Cédula</label>
                                    {!! Form::text('cedula', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Nombre</label>
                                    {!! Form::text('primer_nombre', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Nombre</label>
                                    {!! Form::text('segundo_nombre', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Apellido</label>
                                    {!! Form::text('primer_apellido', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Apellido</label>
                                    {!! Form::text('segundo_apellido', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Fecha de Nacimiento</label>
                                    {!! Form::date('fecha_nacimiento', null, array('class' => 'form-control datepicker')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estado de Nacimiento</label>
                                    {!! Form::select('id_estado_nacimiento', $estado, [], array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Municipio de Nacimiento</label>
                                    {!! Form::select('id_municipio_nacimiento', $municipio, [], array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-9">
                                <div class="form-group">
                                    <label for="email">Dirección</label>
                                    {!! Form::text('direccion', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estado Civil</label>
                                    {!! Form::select('id_estado_civil', $estado_civil, [], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Genero</label>
                                    {!! Form::select('id_genero', $genero, [], ['class'=>'form-control','autocomplete' => 'off']) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Tez</label>
                                    {!! Form::select('id_tez', $tez, [], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-3">
                                <div class="form-group">
                                    <label for="email">Contextura</label>
                                    {!! Form::select('id_contextura', $contextura, [], array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">Profesión</label>
                                    {!! Form::select('id_profesion',  $profesion, [], array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="email">Motivo de Reseña</label>
                                    {!! Form::select('id_motivo_resenna', $motivo_resenna, [], array('class' => 'form-control select2')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Funcionario Aprehensor</label>
                                    <select name="id_funcionario_aprehensor" id="" class="form-control select2">
                                    @foreach ($funcionario_aprehensor as $funcionario)
                                        <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-6">
                                <div class="form-group">
                                    <label for="">Funcionario que Reseña</label>
                                    <select name="id_funcionario_resenna" id="" class="form-control select2">
                                    @foreach ($funcionario_resenna as $funcionario)
                                        <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
                                    @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label for="email">Observaciones</label>
                                    {!! Form::textarea('observaciones', null, array('class' => 'form-control')) !!}
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
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

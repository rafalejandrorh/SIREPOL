@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Detallado de Reseña</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    </div>
                    <div class="card">
                        <div class="card-body">
   
                        {{-- {!! Form::open(array('route' => 'resenna.show','method' => 'POST')) !!} --}}
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ route('resenna.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                            </div>
                        </div>
                        <br>
                        
                        <div class="row">

                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <i class="fa fa-address-card f-30 text-c-blue"></i>
                                    <label for="name">Ficha Fotográfica</label>
                                </div>
                            </div>
                            <div class="col-xs-2 col-sm-2 col-md-2">
                                <div class="form-group">
                                    <center><img src="{{asset($resenna->url_foto)}}" alt="foto_reseñado"  class="img-responsive" width="150"></center>
                                </div>
                            </div>  
                        </div>

                        <div class="row">
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="name">Fecha de Reseña</label>
                                    {!! Form::text('fecha_resenna', date('d/m/Y', strtotime($resenna->fecha_resenna)).'. Hace '.$resenna->fecha_resenna->diff(date('Y-m-d'))->days.' días', array('class' => 'form-control', 'disabled', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estatus de Documentación</label>
                                    {!! Form::text('cedula', $resenna->resennado->documentacion->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Letra de Cédula</label>
                                    {!! Form::text('cedula', $resenna->resennado->letra_cedula, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Cédula</label>
                                    {!! Form::text('cedula', $resenna->resennado->cedula, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Nombre</label>
                                    {!! Form::text('primer_nombre', $resenna->resennado->primer_nombre, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Nombre</label>
                                    {!! Form::text('segundo_nombre', $resenna->resennado->segundo_nombre, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Primer Apellido</label>
                                    {!! Form::text('primer_apellido', $resenna->resennado->primer_apellido, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Segundo Apellido</label>
                                    {!! Form::text('segundo_apellido', $resenna->resennado->segundo_apellido, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Fecha de Nacimiento</label>
                                    {!! Form::date('fecha_nacimiento', $resenna->resennado->fecha_nacimiento, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Edad</label>
                                    {!! Form::text('Edad', $edad, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Genero</label>
                                    {!! Form::text('id_genero', $resenna->resennado->genero->valor, ['class'=>'form-control datepicker', 'disabled']) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Tez</label>
                                    {!! Form::text('id_tez', $resenna->tez->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Contextura</label>
                                    {!! Form::text('id_contextura', $resenna->contextura->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-3 col-sm-3 col-md-3">
                                <div class="form-group">
                                    <label for="email">Estado Civil</label>
                                    {!! Form::text('id_estado_civil', $resenna->estado_civil->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Estado de Nacimiento</label>
                                    {!! Form::text('estado_nacimiento', $resenna->resennado->estado_nacimiento->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Municipio de Nacimiento</label>
                                    {!! Form::text('municipio_nacimiento', $resenna->resennado->municipio_nacimiento->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Dirección</label>
                                    {!! Form::text('direccion', $resenna->direccion, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Profesión</label>
                                    {!! Form::text('id_profesion',  $resenna->profesion->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Motivo de Reseña</label>
                                    {!! Form::text('id_motivo_resenna', $resenna->motivo_resenna->valor, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="">Funcionario Aprehensor</label>
                                        <input type="text" class="form-control" value="{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="">Funcionario que Reseña</label>
                                    <input type="text" class="form-control" value="{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}" disabled>
                                </div>
                            </div>
                            <div class="col-xs-6 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <label for="email">Observaciones</label>
                                    {!! Form::textarea('observaciones', $resenna->observaciones, array('class' => 'form-control', 'disabled')) !!}
                                </div>
                            </div>
                        </div>
                        {{-- {!! Form::close() !!} --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

    {!! Form::open(array('route' => 'resenna.store','method' => 'POST','files' => true)) !!}
        <div class="row">
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
                        {!! Form::date('fecha_resenna', $fecha_hoy, array('class' => 'form-control datepicker', 'required' => 'required')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Estatus de Documentación</label>
                        {!! Form::select('id_tipo_documentacion', $documentacion, isset($resennado->id_tipo_documentacion) ? $resennado->id_tipo_documentacion : null, array('class' => 'form-control select2')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Letra de Cédula</label>
                        {!! Form::select('letra_cedula', ['V' => 'V', 'E' => 'E'], isset($resennado->letra_cedula) ? $resennado->letra_cedula : null, array('class' => 'form-control select2')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Cédula</label>
                        {!! Form::text('cedula', isset($resennado->cedula) ? $resennado->cedula : null, array('class' => 'form-control numero cedula', 'maxlength' => '10')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Primer Nombre</label>
                        {!! Form::text('primer_nombre', isset($resennado->primer_nombre) ? $resennado->primer_nombre : null, array('class' => 'form-control letras', 'required' => 'required', 'id' => 'primer_nombre')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Segundo Nombre</label>
                        {!! Form::text('segundo_nombre', isset($resennado->segundo_nombre) ? $resennado->segundo_nombre : null, array('class' => 'form-control letras')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Primer Apellido</label>
                        {!! Form::text('primer_apellido', isset($resennado->primer_apellido) ? $resennado->primer_apellido : null, array('class' => 'form-control letras', 'required' => 'required', 'id' => 'primer_apellido')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Segundo Apellido</label>
                        {!! Form::text('segundo_apellido', isset($resennado->segundo_apellido) ? $resennado->segundo_apellido : null, array('class' => 'form-control letras')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Fecha de Nacimiento</label>
                        {!! Form::date('fecha_nacimiento', isset($resennado->fecha_nacimiento) ? $resennado->fecha_nacimiento : null, array('class' => 'form-control datepicker')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Estado de Nacimiento</label>
                        {!! Form::select('id_estado_nacimiento', $estados['estados'], isset($resennado->id_estado_nacimiento) ? $resennado->id_estado_nacimiento : null, array('class' => 'form-control select2', 'placeholder' => 'Seleccione', 'id'=>'estados1')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Municipio de Nacimiento</label>
                        {!! Form::select('id_municipio_nacimiento', $estados['municipios'], isset($resennado->id_municipio_nacimiento) ? $resennado->id_municipio_nacimiento : null, array('class' => 'form-control select2', 
                        'id'=>'municipios1','title'=>'Municipio', 'placeholder'=>'Seleccione', 'onchange'=>"cargarCombo(109,this.value,'#parroquias')")) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9">
                    <div class="form-group">
                        <label for="email">Dirección</label>
                        {!! Form::text('direccion', isset($resennado->direccion) ? $resennado->direccion : null, array('class' => 'form-control')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Estado Civil</label>
                        {!! Form::select('id_estado_civil', $estado_civil, isset($resennado->id_estado_civil) ? $resennado->id_estado_civil : null, array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Genero</label>
                        {!! Form::select('id_genero', $genero, isset($resennado->id_genero) ? $resennado->id_genero : null, ['class'=>'form-control select2','autocomplete' => 'off', 'placeholder'=>'Seleccione', 'required' => 'required']) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Tez</label>
                        {!! Form::select('id_tez', $tez, isset($resennado->id_tez) ? $resennado->id_tez : null, array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-3">
                    <div class="form-group">
                        <label for="email">Contextura</label>
                        {!! Form::select('id_contextura', $contextura, isset($resennado->id_contextura) ? $resennado->id_contextura : null, array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="email">Profesión</label>
                        {!! Form::select('id_profesion',  $profesion, isset($resennado->id_profesion) ? $resennado->id_profesion : null, array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="email">Motivo de Reseña</label>
                        {!! Form::select('id_motivo_resenna', $motivo_resenna, [], array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Funcionario Aprehensor</label>
                        <select name="id_funcionario_aprehensor" id="" class="form-control select2" required>
                            <option value="">Seleccione</option>
                        @foreach ($funcionario_aprehensor as $funcionario)
                            <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
                        @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6">
                    <div class="form-group">
                        <label for="">Funcionario que Reseña</label>
                        <select name="id_funcionario_resenna" id="" class="form-control select2" required>
                            <option value="">Seleccione</option>
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
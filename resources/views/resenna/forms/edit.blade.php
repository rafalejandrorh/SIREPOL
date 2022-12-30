{!! Form::model($resenna, array('method' => 'PATCH','route' => ['resenna.update', $resenna->id], 'files' => true)) !!}
<div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <i class="fa fa-address-card f-30 text-c-blue"></i>
                <label for="name">Ficha Fotográfica</label>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <img src="{{asset('public/'.$resenna->url_foto)}}" alt="foto_reseñado"  width="150">
        </div>
        <br>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="card">
                <div class="card-block border-bottom">
                    <div class="row d-flex align-items-center">
                        <div class="col-auto">
                            <i class="fa fa-address-card f-30 text-c-blue"></i>
                            <label for="name">Editar Fotografía</label>
                        </div>
                    </div>
                </div>
                    <div class="card-block">
                        {!! Form::file('url_foto', ['class' => 'form-control-file upload', 'id'=>'url', 'accept' => 'image/*']) !!}
                    </div>
            </div>
        </div>  
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="name">Fecha de Reseña</label>
                {!! Form::date('fecha_resenna', $resenna->fecha_resenna, array('class' => 'form-control datepicker', 'required' => 'required')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Estatus de Documentación</label>
                {!! Form::select('id_tipo_documentacion', $documentacion, $resenna->resennado->documentacion->valor, array('class' => 'form-control select2')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Letra de Cédula</label>
                {!! Form::select('letra_cedula', ['V' => 'V', 'E' => 'E'], $resenna->resennado->letra_cedula, array('class' => 'form-control select2')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Cédula</label>
                {!! Form::text('cedula', $resenna->resennado->cedula, array('class' => 'form-control numero')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Primer Nombre</label>
                {!! Form::text('primer_nombre', $resenna->resennado->primer_nombre, array('class' => 'form-control letras', 'required' => 'required')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Segundo Nombre</label>
                {!! Form::text('segundo_nombre', $resenna->resennado->segundo_nombre, array('class' => 'form-control letras')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Primer Apellido</label>
                {!! Form::text('primer_apellido', $resenna->resennado->primer_apellido, array('class' => 'form-control letras', 'required' => 'required')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Segundo Apellido</label>
                {!! Form::text('segundo_apellido', $resenna->resennado->segundo_apellido, array('class' => 'form-control letras')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Fecha de Nacimiento</label>
                {!! Form::date('fecha_nacimiento', $resenna->resennado->fecha_nacimiento, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Edad</label>
                {!! Form::text('fecha_nacimiento', $edad, array('class' => 'form-control', 'readonly')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Estado de Nacimiento</label>
                {!! Form::select('id_estado_nacimiento', $estados['estados'], $resenna->resennado->id_estado_nacimiento, array('class' => 'form-control select2', 'placeholder' => 'Seleccione', 'id'=>'estados2')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Municipio de Nacimiento</label>
                {!! Form::select('id_municipio_nacimiento', $estados['municipios'], $resenna->resennado->id_municipio_nacimiento, array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 
                'id'=>'municipios2','title'=>'Municipio', 'onchange'=>"cargarCombo(109,this.value,'#parroquias')")) !!}
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="email">Dirección</label>
                {!! Form::text('direccion', $resenna->direccion, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Estado Civil</label>
                {!! Form::select('id_estado_civil', $estado_civil, $resenna->id_estado_civil, array('class' => 'form-control select2')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Genero</label>
                {!! Form::select('id_genero', $genero, $resenna->resennado->id_genero, ['class'=>'form-control select2', 'required' => 'required']) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Tez</label>
                {!! Form::select('id_tez', $tez, $resenna->id_tez, array('class' => 'form-control select2', 'required' => 'required')) !!}
            </div>
        </div>
        <div class="col-xs-3 col-sm-3 col-md-3">
            <div class="form-group">
                <label for="email">Contextura</label>
                {!! Form::select('id_contextura', $contextura, $resenna->id_contextura, array('class' => 'form-control select2', 'required' => 'required')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="email">Profesión</label>
                {!! Form::select('id_profesion', $profesion, $resenna->id_profesion, array('class' => 'form-control select2')) !!}
            </div>
        </div>
        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="email">Motivo de Reseña</label>
                {!! Form::select('id_motivo_resenna', $motivo_resenna, $resenna->id_motivo_resenna, array('class' => 'form-control select2', 'required' => 'required')) !!}
            </div>
        </div>

        <div class="col-xs-4 col-sm-4 col-md-4">
            <div class="form-group">
                <label for="email"><i class="fa fa-globe text-info"></i> Coordenadas de Aprehensión</label>
                {!! Form::text('coordenadas_aprehension', $resenna->coordenadas_aprehension, array('class' => 'form-control', 'required' => 'required')) !!}
            </div>
        </div>

        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="">Funcionario Aprehensor</label>
                <select name="id_funcionario_aprehensor" id="" class="form-control select2" required>
                    <option value="{{ $resenna->id_funcionario_aprehensor}}">{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido}}</option>
                @foreach ($funcionario_aprehensor as $funcionario)
                    <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-6 col-sm-6 col-md-6">
            <div class="form-group">
                <label for="">Funcionario que Reseña</label>
                <select name="id_funcionario_resenna" id="" class="form-control select2" required>
                    <option value="{{ $resenna->id_funcionario_resenna}}">{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido}}</option>
                @foreach ($funcionario_resenna as $funcionario)
                    <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
                @endforeach
                </select>
            </div>
        </div>
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <label for="email">Observaciones</label>
                {!! Form::textarea('observaciones', $resenna->observaciones, array('class' => 'form-control')) !!}
            </div>
        </div>
        <div class="col-xs-10 col-sm-10 col-md-10">
            {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit']) !!}
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            {!! Form::button('<i class="fa fa-globe"></i> Georeferencia', ['type' => 'button', 'class' => 'btn btn-terciary ', 'id' => 'newPageGeoreference']) !!}
        </div>
    </div>
{!! Form::close() !!}
    
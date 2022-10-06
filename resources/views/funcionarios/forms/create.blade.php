{!! Form::open(array('route' => 'funcionarios.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="name">Credencial</label>
            {!! Form::text('credencial', null, array('class' => 'form-control', 'maxlength' => '10')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Cédula</label>
            {!! Form::text('cedula', null, array('class' => 'form-control', 'required' => 'required', 'maxlength' => '10')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Primer Nombre</label>
            {!! Form::text('primer_nombre', null, array('class' => 'form-control', 'required' => 'required')) !!}
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
            {!! Form::text('primer_apellido', null, array('class' => 'form-control', 'required' => 'required')) !!}
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
            <label for="email">Género</label>
            {!! Form::select('id_genero', $genero,[], array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Fecha de Nacimiento</label>
            {!! Form::date('fecha_nacimiento', null, ['class'=>'form-control datepicker','autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Estado de Nacimiento</label>
            {!! Form::select('id_estado_nacimiento', $estado, [], ['class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required']) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Teléfono</label>
            {!! Form::text('telefono', null, array('class' => 'form-control')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Jerarquía</label>
            {!! Form::select('id_jerarquia', $jerarquia,[], array('class' => 'form-control select2', 'placeholder'=>'Seleccione', 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Estatus Laboral</label>
            {!! Form::select('id_estatus', $estatus,[], array('class' => 'form-control select2', 'required' => 'required', 'placeholder'=>'Seleccione')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
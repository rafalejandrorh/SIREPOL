{{-- Formulario para Registrar y Editar Funcionarios --}}
@if (isset($funcionario))
    {!! Form::model($funcionario, ['method' => 'PUT','route' => ['funcionarios.update', $funcionario->id]]) !!}
@else
    {!! Form::open(array('route' => 'funcionarios.store','method'=>'POST')) !!}
@endif

<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="name">Credencial</label>
            {!! Form::text('credencial', isset($funcionario->credencial) ? $funcionario->credencial : null, array('class' => 'form-control numero', 'maxlength' => '10')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Cédula</label>
            {!! Form::text('cedula', isset($funcionario->person->cedula) ? $funcionario->person->cedula : null, array('class' => 'form-control numero', isset($funcionario->person->cedula) ? 'readonly' : '')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Primer Nombre</label>
            {!! Form::text('primer_nombre', isset($funcionario->person->primer_nombre) ? $funcionario->person->primer_nombre : null, array('class' => 'form-control letras', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Segundo Nombre</label>
            {!! Form::text('segundo_nombre', isset($funcionario->person->segundo_nombre) ? $funcionario->person->segundo_nombre : null, array('class' => 'form-control letras')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Primer Apellido</label>
            {!! Form::text('primer_apellido', isset($funcionario->person->primer_apellido) ? $funcionario->person->primer_apellido : null, array('class' => 'form-control letras', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Segundo Apellido</label>
            {!! Form::text('segundo_apellido', isset($funcionario->person->segundo_apellido) ? $funcionario->person->segundo_apellido : null, array('class' => 'form-control letras')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Género</label>
            {!! Form::select('id_genero', $genero, isset($funcionario->person->id_genero) ? $funcionario->person->id_genero : [], array('class' => 'form-control select2', isset($funcionario->person->id_genero) ? 'Seleccione' : '')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Fecha de Nacimiento</label>
            {!! Form::date('fecha_nacimiento', isset($funcionario->person->fecha_nacimiento) ? $funcionario->person->fecha_nacimiento : null, ['class' => 'form-control datepicker', 'autocomplete' => 'off']) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Estado de Nacimiento</label>
            {!! Form::select('id_estado_nacimiento', $estado, isset($funcionario->person->id_estado_nacimiento) ? $funcionario->person->id_estado_nacimiento : [], array('class' => 'form-control select2')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Teléfono</label>
            {!! Form::text('telefono', isset($funcionario->telefono) ? $funcionario->telefono : null, array('class' => 'form-control numero')) !!}
        </div>
    </div>
    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="email">Organismo</label>
            {!! Form::select('id_organismo', $organismo, isset($organismoPredeterminado->id) ? $organismoPredeterminado->id : [], array('class' => 'form-control select2', 'placeholder' => isset($organismoPredeterminado->id) ? 'Seleccione' : '', 'required', 'id' => 'organismo')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Estatus Laboral</label>
            {!! Form::select('id_estatus', $estatus, isset($funcionario->id_estatus) ? $funcionario->id_estatus : [], array('class' => 'form-control select2', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <label for="email">Jerarquía</label>
            {!! Form::select('id_jerarquia', $jerarquia, isset($funcionario->id_jerarquia) ? $funcionario->id_jerarquia : [], array('class' => 'form-control select2', 'id' => 'jerarquia', 'placeholder' => isset($funcionario->id_jerarquia) ? 'Seleccione' : '')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
</div>
{!! Form::close() !!}
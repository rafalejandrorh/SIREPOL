{!! Form::model($permiso, array('method' => 'PATCH', 'route' => ['permisos.update', $permiso->id])) !!}
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="name">Nomenclatura</label>
            {!! Form::text('nomenclatura', $permiso->name, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Descripción</label>
            {!! Form::text('descripcion', $permiso->description, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Tipo de Permiso</label>
            {!! Form::text('tipo_permiso', $permiso->guard_name, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit']) !!}
    </div>
</div>
{!! Form::close() !!}
    
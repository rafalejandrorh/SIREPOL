{!! Form::model($almacenamiento, array('method' => 'PATCH', 'route' => ['rutasAlmacenamiento.update', $almacenamiento->id])) !!}
<div class="row">
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="name">Ruta</label>
            {!! Form::text('ruta', $almacenamiento->ruta, array('class' => 'form-control', 'placeholder' => 'Ejm: imagenes/resennados', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Tipos de Archivo</label>
            {!! Form::text('tipo_archivo', $almacenamiento->tipo_archivo, array('class' => 'form-control', 'placeholder' => 'Ejm: jpeg, png, jpg', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Nomenclatura</label>
            {!! Form::text('nomenclatura', $almacenamiento->nomenclatura, array('class' => 'form-control', 'placeholder' => 'Ejm: resenna.resennado.imagen', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Módulo</label>
            {!! Form::text('modulo', $almacenamiento->modulo, array('class' => 'form-control', 'placeholder' => 'Ejm: Reseñas', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-6 col-sm-6 col-md-6">
        <div class="form-group">
            <label for="email">Descripción</label>
            {!! Form::text('descripcion', $almacenamiento->descripcion, array('class' => 'form-control', 'placeholder' => 'Ejm: Imágen correspondiente del Reseñado', 'required' => 'required')) !!}
        </div>
    </div>

    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit']) !!}
    </div>
</div>
{!! Form::close() !!}
    
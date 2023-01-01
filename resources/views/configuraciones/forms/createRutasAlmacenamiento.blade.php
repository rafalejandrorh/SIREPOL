    {!! Form::open(array('route' => 'rutasAlmacenamiento.store','method' => 'POST')) !!}
        <div class="row">
            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="name">Ruta</label>
                    {!! Form::text('ruta', null, array('class' => 'form-control', 'placeholder' => 'Ejm: storage/imagenes/resennados', 'required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="email">Tipos de Archivo</label>
                    {!! Form::text('tipo_archivo', null, array('class' => 'form-control', 'placeholder' => 'Ejm: jpeg, png, jpg', 'required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-4 col-sm-4 col-md-4">
                <div class="form-group">
                    <label for="email">Módulo</label>
                    {!! Form::text('modulo', null, array('class' => 'form-control', 'placeholder' => 'Ejm: Reseñas', 'required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-6 col-sm-6 col-md-6">
                <div class="form-group">
                    <label for="email">Descripción</label>
                    {!! Form::text('descripcion', null, array('class' => 'form-control', 'placeholder' => 'Ejm: Imagen correspondiente del Reseñado', 'required' => 'required')) !!}
                </div>
            </div>

            <div class="col-xs-12 col-sm-12 col-md-12">
                {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'submit']) !!}
            </div>
        </div>
    {!! Form::close() !!}

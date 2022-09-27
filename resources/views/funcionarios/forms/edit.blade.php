    {!! Form::model($funcionario, ['method' => 'PUT','route' => ['funcionarios.update', $funcionario->id]]) !!}
        <div class="row">
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="name">Credencial</label>
                    {!! Form::text('credencial', $funcionario->credencial, array('class' => 'form-control', 'maxlength' => '10')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Cédula</label>
                    {!! Form::text('cedula', $funcionario->person->cedula, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Primer Nombre</label>
                    {!! Form::text('primer_nombre', $funcionario->person->primer_nombre, array('class' => 'form-control', 'required' => 'required')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Segundo Nombre</label>
                    {!! Form::text('segundo_nombre', $funcionario->person->segundo_nombre, array('class' => 'form-control',)) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Primer Apellido</label>
                    {!! Form::text('primer_apellido', $funcionario->person->primer_apellido, array('class' => 'form-control', 'required' => 'required')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Segundo Apellido</label>
                    {!! Form::text('segundo_apellido', $funcionario->person->segundo_apellido, array('class' => 'form-control',)) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Género</label>
                    {!! Form::select('id_genero', $genero, $funcionario->person->id_genero, array('class' => 'form-control select2')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Fecha de Nacimiento</label>
                    {!! Form::date('fecha_nacimiento', $funcionario->person->fecha_nacimiento, ['class'=>'form-control datepicker','autocomplete' => 'off']) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Estado de Nacimiento</label>
                    {!! Form::select('id_estado_nacimiento', $estado, $funcionario->person->id_estado_nacimiento, array('class' => 'form-control select2')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Teléfono</label>
                    {!! Form::text('telefono', $funcionario->telefono, array('class' => 'form-control')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Jerarquía</label>
                    {!! Form::select('id_jerarquia', $jerarquia, $funcionario->id_jerarquia, array('class' => 'form-control select2')) !!}
                </div>
            </div>
            <div class="col-xs-3 col-sm-3 col-md-3">
                <div class="form-group">
                    <label for="email">Estatus Laboral</label>
                    {!! Form::select('id_estatus', $estatus, $funcionario->id_estatus, array('class' => 'form-control select2', 'required' => 'required')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-12">
                <div class="form-group">
                    {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
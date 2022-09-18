    {!! Form::model($funcionario, ['method' => 'PATCH','route' => ['funcionarios.update', $funcionario->id]]) !!}
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="name">Credencial</label>
                    {!! Form::text('credencial', $funcionario->credencial, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Cédula</label>
                    {!! Form::text('cedula', $funcionario->person->cedula, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Primer Nombre</label>
                    {!! Form::text('primer_nombre', $funcionario->person->primer_nombre, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Segundo Nombre</label>
                    {!! Form::text('segundo_nombre', $funcionario->person->segundo_nombre, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Primer Apellido</label>
                    {!! Form::text('primer_apellido', $funcionario->person->primer_apellido, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Segundo Apellido</label>
                    {!! Form::text('segundo_apellido', $funcionario->person->segundo_apellido, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Género</label>
                    {!! Form::text('id_genero', $funcionario->person->genero->valor, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Fecha de Nacimiento</label>
                    {!! Form::date('fecha_nacimiento', $funcionario->person->fecha_nacimiento, ['class'=>'form-control datepicker','autocomplete' => 'off', 'readonly']) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Estado de Nacimiento</label>
                    {!! Form::text('id_estado_nacimiento', $funcionario->person->estado_nacimiento->valor, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Teléfono</label>
                    {!! Form::text('telefono', $funcionario->telefono, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Jerarquía</label>
                    {!! Form::text('id_jerarquia', $funcionario->jerarquia->valor, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-3">
                <div class="form-group">
                    <label for="email">Estatus Laboral</label>
                    {!! Form::text('id_estatus', $funcionario->estatus->valor, array('class' => 'form-control', 'readonly')) !!}
                </div>
            </div>
        </div>
    {!! Form::close() !!}
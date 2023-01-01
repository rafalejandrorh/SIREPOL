{!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-5">
        <div class="form-group">
            <label for="">Asignar Funcionario</label>
            <select name="id_funcionario" id="" class="form-control select2" required>
                <option value="">Seleccione</option>
            @foreach ($funcionarios as $funcionario)
                <option value="{{ $funcionario->id }}"> {{$funcionario->valor.'. '.$funcionario->primer_nombre.' '.$funcionario->primer_apellido }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <label for="">Roles</label>
            {!! Form::select('roles[]', $roles, [], array('class' => 'form-control select2', 'required' => 'required', 'placeholder' => 'Seleccione', 'multiple' => 'multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        <div class="form-group">
            <label for="email">Usuario</label>
            {!! Form::text('users', null, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="password">Password</label>
            {!! Form::password('password', array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-6">
        <div class="form-group">
            <label for="confirm-password">Confirmar Password</label>
            {!! Form::password('confirm-password', array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-3">
        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
    </div>
</div>
{!! Form::close() !!}
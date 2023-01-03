{{-- Formulario para Registrar y Editar Usuarios --}}
@if (isset($user))
    {!! Form::model($user, ['method' => 'PUT','route' => ['users.update', $user->id]]) !!}
    <div class="row">
        <div class="col-xs-5 col-sm-5 col-md-5">
            <div class="form-group">
                <label for="">Funcionario Asignado</label>
                <input type="text" class="form-control" value="{{$user->funcionario->jerarquia->valor.'. '.$user->funcionario->person->primer_nombre.' '.$user->funcionario->person->primer_apellido}}" readonly>
            </div>
        </div>
@else
    {!! Form::open(array('route' => 'users.store','method'=>'POST')) !!}
    <div class="row">
        <div class="col-xs-5 col-sm-5 col-md-5">
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
@endif

    <div class="col-xs-4 col-sm-4 col-md-4">
        <div class="form-group">
            <label for="">Roles</label>
            {!! Form::select('roles[]', $roles, isset($user->roles) ? $user->roles : [], array('class' => 'form-control select2', 'required' => 'required', 'multiple' => 'multiple')) !!}
        </div>
    </div>
    <div class="col-xs-3 col-sm-3 col-md-3">
        <div class="form-group">
            <label for="email">Usuario</label>
            {!! Form::text('users', isset($user->users) ? $user->users : null, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
@if (!isset($user))
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
@endif
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
{!! Form::close() !!}

@if (isset($user))
    {!! Form::model($user, ['method' => 'PATCH','route' => ['users.reset', $user->id], 'class' => 'contrasenna']) !!}
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                {!! Form::button('<i class="fa fa-reply"> Reestablecer Contraseña</i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
            </div>
        </div>
    {!! Form::close() !!}
@endif
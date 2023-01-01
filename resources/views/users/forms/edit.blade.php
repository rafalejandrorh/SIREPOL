{!! Form::model($user, ['method' => 'PUT','route' => ['users.update', $user->id]]) !!}
<div class="row">
    <div class="col-xs-6 col-sm-6 col-md-4">
        <div class="form-group">
            <label for="">Funcionario Asignado</label>
            <input type="text" class="form-control" value="{{$user->funcionario->jerarquia->valor.'. '.$user->funcionario->person->primer_nombre.' '.$user->funcionario->person->primer_apellido}}" readonly>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <label for="">Roles</label>
            {!! Form::select('roles[]', $roles, $user->roles, array('class' => 'form-control select2', 'required' => 'required', 'multiple' => 'multiple')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-4">
        <div class="form-group">
            <label for="email">Usuario</label>
            {!! Form::text('users', $user->users, array('class' => 'form-control', 'required' => 'required')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
        </div>
    </div>
{!! Form::close() !!}

{!! Form::model($user, ['method' => 'PATCH','route' => ['users.reset', $user->id], 'class' => 'contrasenna']) !!}
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            {!! Form::button('<i class="fa fa-reply"> Reestablecer Contraseña</i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
        </div>
    </div>
{!! Form::close() !!}

@section('scripts')
    <script src="{{ asset('public/js/users/edit.js') }}"></script>
@endsection
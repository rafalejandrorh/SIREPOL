{!! Form::model($user, ['method' => 'PATCH','route' => ['users.settings.update', $user->id]]) !!}
{{-- {!! Form::open(array('route' => ['sesion.update', $user->id],'method'=>'POST')) !!} --}}
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="email">Funcionario Asignado</label>
            {!! Form::text('user', $user->funcionario->jerarquia->valor.'. '.$user->funcionario->person->primer_nombre.' '.$user->funcionario->person->primer_apellido, array('class' => 'form-control', 'readonly')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="email">Usuario</label>
            {!! Form::text('user', $user->users, array('class' => 'form-control', 'readonly')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="password">Contraseña Actual</label>
            {!! Form::password('curr_password', array('class' => 'form-control', 'id' => 'current_password')) !!}
            <span for="" id="message_password" class="text-danger"></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="password">Contraseña Nueva</label>
            {!! Form::password('password', array('class' => 'form-control', 'id' => 'new_password')) !!}
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        <div class="form-group">
            <label for="confirm-password">Confirmar Contraseña</label>
            {!! Form::password('confirm-password', array('class' => 'form-control', 'id' => 'new_password_confirm')) !!}
            <span for="" id="message_new_password" class="text-danger"></span>
        </div>
    </div>
    <div class="col-xs-12 col-sm-12 col-md-12">
        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'save', 'disabled']) !!}
    </div>
</div>
{!! Form::close() !!}
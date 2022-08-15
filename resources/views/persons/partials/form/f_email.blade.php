<input type="hidden" name="valor" value="2">

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Correo electronico</label>

    <div class="col-md-6">
        {{ Form::email('email', null, ['class' => 'form-control', 'required' => 'required', 'onkeyup'=>'mayus(this);']) }}
    </div>
</div>

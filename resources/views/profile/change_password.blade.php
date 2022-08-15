<div id="changePasswordModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar Contraseña</h5>
                <button type="button" aria-label="Close" class="close outline-none" data-dismiss="modal">×</button>
            </div>
            {!! Form::open(array('route' => ['users.password'],'method' => 'POST', 'id' => 'changePasswordForm')) !!}
                <div class="modal-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="alert alert-danger d-none" id=""></div>
                    <input type="hidden" name="is_active" value="1">
                    <input type="hidden" name="user_id" id="editPasswordValidationErrorsBox">
                    {{csrf_field()}}

                    <div class="row">
                        <div class="form-group col-sm-12">
                            <label>Contraseña Actual:</label><span class="required confirm-pwd"></span><span class="required">*</span>
                                <div class="input-group">
                                    {{-- <input class="form-control input-group__addon" id="pfCurrentPassword" type="password" name="contraseña_actual" required> --}}
                                    {!! Form::text('id_usuario', '{{ \Illuminate\Support\Facades\Auth::id() }}') !!}
                                    {!! Form::password('contraseña_actual', array('class' => 'form-control input-group__addon', 'id' => 'pfCurrentPassword', 'required')) !!}
                                    <div class="input-group-append input-group__icon">
                                    <span class="input-group-text changeType"><i class="icon-ban icons"></i></span>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Nueva Contraseña:</label><span class="required confirm-pwd"></span><span class="required">*</span>
                                <div class="input-group">
                                    {{-- <input class="form-control input-group__addon" id="pfNewPassword" type="password" name="contraseña_nueva" required> --}}
                                    {!! Form::password('contraseña_nueva', array('class' => 'form-control input-group__addon', 'id' => 'pfNewPassword', 'required')) !!}
                                    <div class="input-group-append input-group__icon">
                                    <span class="input-group-text changeType"><i class="icon-ban icons"></i></span>
                                    </div>
                                </div>
                        </div>

                        <div class="form-group col-sm-12">
                            <label>Confirmar Contraseña:</label><span class="required confirm-pwd"></span><span class="required">*</span>
                                <div class="input-group">
                                    {{-- <input class="form-control input-group__addon" id="pfNewConfirmPassword" type="password" name="confirmar_contraseña" required> --}}
                                    {!! Form::password('confirmar_contraseña', array('class' => 'form-control input-group__addon', 'id' => 'pfNewConfirmPassword', 'required')) !!}
                                    <div class="input-group-append input-group__icon">
                                    <span class="input-group-text changeType"><i class="icon-ban icons"></i></span>
                                    </div>
                                </div>
                        </div>

                    </div>
                    <div class="text-right">
                        {{-- <button type="submit" class="btn btn-primary" id="btnPrPasswordEditSave" data-loading-text="<span class='spinner-border spinner-border-sm'></span> Processing...">
                            Save
                        </button> --}}
                        {!! Form::button('<i class="fa fa-save"> Guardar</i>', ['type' => 'submit', 'class' => 'btn btn-primary', 'id' => 'btnPrPasswordEditSave', 
                            'data-loading-text' => '<span class="spinner-border spinner-border-sm"></span> Processing...']) !!}
                        <button type="button" class="btn btn-light ml-1" data-dismiss="modal">
                            Cancel
                        </button>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<?php

    {{-- Modal de Filtro --}}
        <div class="modal fade" id="filtrar" tabindex="-1" aria-labelledby="filtro" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="page__heading text-white"><b>Filtro</b></h3>
                        <span aria-hidden="true" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</span>
                    </div>
                {!! Form::open(array('route' => $filtro,'method' => 'GET')) !!}
                <div class="modal-body">

                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Desde</label>
                                {!! Form::date('fecha_inicio', null, array('class' => 'form-control datepicker')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Hasta</label>
                                {!! Form::date('fecha_fin', null, array('class' => 'form-control datepicker')) !!}
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Acción</label>
                                {!! Form::select('id_accion', $accion, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Usuario</label>
                                {!! Form::select('id_usuario', $user, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            {!! Form::hidden('filtro', 1, array('class' => 'form-control datepicker')) !!}
                            {!! Form::button('<i class="fa fa-check"> Aplicar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
            </div>
        </div>
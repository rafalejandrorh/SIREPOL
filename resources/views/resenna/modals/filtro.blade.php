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
                    @if($filtro == 'resenna.charts')
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                            <label for="email">Gráficos</label>
                                {!! Form::select('tipo_grafico', [
                                '' => 'Seleccione',
                                'origenresennados' => 'Estado de Origen de los Reseñados',
                                // 'edadresennados' => 'Edad de los Reseñados',
                                'cantresennasdelito' => 'Cantidad de Reseñas por Delito',
                                // 'cantresennasmes' => 'Cantidad de Reseñas por Mes', 
                                // 'cantresennasanno' => 'Cantidad de Reseñas por Año', 
                                // 'cantresennasaprehensor' => 'Cantidad de Reseñas por Funcionario Aprehensor',
                                ], 
                                'Seleccionar', array('class' => 'form-control')) !!}
                            </div>
                        </div>
                    @endif    
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
                                <label for="email">Tez</label>
                                {!! Form::select('id_tez', $tez, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Contextura</label>
                                {!! Form::select('id_contextura', $contextura, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-4 col-sm-4 col-md-4">
                            <div class="form-group">
                                <label for="email">Genero</label>
                                {!! Form::select('id_genero', $genero, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Estado de Nacimiento</label>
                                {!! Form::select('id_estado_nacimiento', $estado, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <label for="email">Municipio de Nacimiento</label>
                                {!! Form::select('id_municipio_nacimiento', $municipio, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <label for="email">Motivo de Reseña</label>
                                {!! Form::select('id_motivo_resenna', $motivo_resenna, [], 
                                array('class' => 'form-control', 'placeholder'=>'Seleccione')) !!}
                            </div>
                        </div>
                        <div class="col-xs-3 col-sm-3 col-md-3">
                            {!! Form::hidden('filtro', 1, array('class' => 'form-control datepicker')) !!}
                            {!! Form::button('<i class="fa fa-check"></i> Aplicar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
            </div>
        </div>
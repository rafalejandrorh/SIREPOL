{{-- Modal de WhatsApp --}}
<div class="modal fade" id="enviar" tabindex="-1" aria-labelledby="enviar" aria-hidden="true">
    <div class="modal-dialog modal-lg">
    <div class="modal-content">
            <div class="modal-header bg-success">
                <h3 class="page__heading text-white"><b>Enviar por WhatsApp</b></h3>
                <span aria-hidden="true" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</span>
            </div>
        <div class="modal-body">

            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="email">Número de Teléfono</label>
                        {!! Form::text('telefono', null, array('class' => 'form-control', 'placeholder' => 'Ingrese el Número de Teléfono al que desea enviar la información. Ejemplo: +584120000000', 'id' => 'telefono', 'required' => 'required')) !!}
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="form-group">
                        <label for="email">Información a Enviar</label>
                        {!! Form::textarea('observaciones', 'Reseña Policial. Fecha: '.date('d/m/Y', strtotime($resenna->fecha_resenna)).'. Hace '.$resenna->fecha_resenna->diff(date('Y-m-d'))->days.' días || Cédula: '.
                        $resenna->resennado->letra_cedula.$resenna->resennado->cedula.' || Nombre Completo: '.$resenna->resennado->primer_nombre.' '.$resenna->resennado->segundo_nombre.', '.$resenna->resennado->primer_apellido.' '.$resenna->resennado->segundo_apellido.
                        ' || Género: '.$resenna->resennado->genero->valor.' || Fecha de Nacimiento: '.date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento)).' || Estado Civil: '.$resenna->estado_civil->valor.' || Profesión: '.$resenna->profesion->valor.
                        ' || Motivo de Reseña: '.$resenna->motivo_resenna->valor.' || Tez: '.$resenna->tez->valor.' || Contextura: '.$resenna->contextura->valor.' || Funcionario Aprehensor: '
                        .$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido.
                        ' || Funcionario que Reseña: '.$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido.
                        ' || Dirección: '.$resenna->direccion.' || Observaciones: '.$resenna->observaciones, array('class' => 'form-control', 'readonly' => 'readonly', 'id' => 'observaciones')) !!}
                    </div>
                </div>
                <div class="col-xs-3 col-sm-3 col-md-3">
                    <button type="button" class="btn btn-success btn-flat" name="send" id="send"><i class="fa fa-check"> Enviar</i></button>
                </div>
            </div>

        </div>
    </div>
    </div>
</div>

@section('scripts')
    <script src="{{ asset('public/js/enviar_whatsapp.js') }}"></script>
@endsection
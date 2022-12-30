<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <i class="fa fa-address-card f-30 text-c-blue"></i>
        <label for="name">Ficha Fotográfica</label>
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <left><img src="{{asset('public/'.$resenna->url_foto)}}" alt="foto_reseñado"  class="img-responsive" width="150"></left>
    </div>
</div>
@can('resenna.qr')
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <right><h1>{{ $QR }}</h1></right>
    </div>
</div>
@endcan

</div>

<div class="row">
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="name">Fecha de Reseña</label>
        {!! Form::text('fecha_resenna', date('d/m/Y', strtotime($resenna->fecha_resenna)).'. Hace '.$resenna->fecha_resenna->diff(date('Y-m-d'))->days.' días', array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Estatus de Documentación</label>
        {!! Form::text('cedula', $resenna->resennado->documentacion->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Letra de Cédula</label>
        {!! Form::text('cedula', $resenna->resennado->letra_cedula, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Cédula</label>
        {!! Form::text('cedula', $resenna->resennado->cedula, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Primer Nombre</label>
        {!! Form::text('primer_nombre', $resenna->resennado->primer_nombre, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Segundo Nombre</label>
        {!! Form::text('segundo_nombre', $resenna->resennado->segundo_nombre, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Primer Apellido</label>
        {!! Form::text('primer_apellido', $resenna->resennado->primer_apellido, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Segundo Apellido</label>
        {!! Form::text('segundo_apellido', $resenna->resennado->segundo_apellido, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Fecha de Nacimiento</label>
        {!! Form::date('fecha_nacimiento', $resenna->resennado->fecha_nacimiento, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Edad</label>
        {!! Form::text('Edad', $edad, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Genero</label>
        {!! Form::text('id_genero', $resenna->resennado->genero->valor, ['class'=>'form-control datepicker', 'readonly']) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Tez</label>
        {!! Form::text('id_tez', $resenna->tez->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Contextura</label>
        {!! Form::text('id_contextura', $resenna->contextura->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email">Estado Civil</label>
        {!! Form::text('id_estado_civil', $resenna->estado_civil->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="email">Estado de Nacimiento</label>
        {!! Form::text('estado_nacimiento', $resenna->resennado->estado_nacimiento->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="email">Municipio de Nacimiento</label>
        {!! Form::text('municipio_nacimiento', $resenna->resennado->municipio_nacimiento->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="email">Dirección</label>
        {!! Form::text('direccion', $resenna->direccion, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="email">Profesión</label>
        {!! Form::text('id_profesion',  $resenna->profesion->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="email">Motivo de Reseña</label>
        {!! Form::text('id_motivo_resenna', $resenna->motivo_resenna->valor, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="">Funcionario Aprehensor</label>
            <input type="text" class="form-control" value="{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}" readonly>
    </div>
</div>
<div class="col-xs-6 col-sm-6 col-md-6">
    <div class="form-group">
        <label for="">Funcionario que Reseña</label>
        <input type="text" class="form-control" value="{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}" readonly>
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        <label for="email">Observaciones</label>
        {!! Form::textarea('observaciones', $resenna->observaciones, array('class' => 'form-control', 'readonly')) !!}
    </div>
</div>
<div class="col-xs-3 col-sm-3 col-md-3">
    <div class="form-group">
        <label for="email"><i class="fa fa-globe text-info" id="openBtn"></i> Coordenadas de Aprehensión</label>
        {!! Form::text('coordenadas_aprehension', $resenna->coordenadas_aprehension, array('class' => 'form-control', 'readonly')) !!}  
    </div>
</div>
<div class="col-xs-12 col-sm-12 col-md-12">
    <div class="form-group">
        @include('resenna.partials.maps')
    </div>
</div>
<div class="col-xs-9 col-sm-9 col-md-9">
    @can('resenna.pdf')
    <div class="form-group">
        <a href="{{ route('resenna.pdf', $resenna->id) }}" target="_blank" class="btn btn-danger"><i class="fa fa-file-pdf"></i> Descargar/Imprimir PDF</a>
    </div>
    @endcan
    @can('resenna.whatsapp')
    <div class="form-group">
        <a href="#!" class="btn btn-success" data-toggle="modal" data-target="#enviar"><i class="fa fa-share-square"></i> Enviar Vía WhatsApp</a>
    </div>
    @endcan
</div>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reseña Policial {{$resenna->letra_cedula.$resenna->resennado->cedula.' - '.$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</title>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ public_path('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css">
    @yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ public_path('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ public_path('web/css/components.css')}}">
    @yield('page_css')

    @yield('css')
</head>
<body>
    <img src="{{ public_path('img/logo_pmcr_sin_fondo.png') }}" width="100">
    <img src="{{ public_path('img/logo_mpprijp.png') }}" width="125" align="right">

    <h2 align="center" style="color:#000000"><b>Reseña Policial</b></h2>
    <h3 align="center" style="color:#000000"><b>{{$resenna->letra_cedula.$resenna->resennado->cedula.' - '.$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</b></h3>
    <hr>

    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <i class="fa fa-address-card f-30 text-c-blue"></i>
                {{-- <label for="name">Ficha Fotográfica</label> --}}
                <span><b>Ficha Fotográfica</b></span>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
                <center><img src="{{ public_path($resenna->url_foto) }}" class="img-responsive" width="100" height="110"></center>
            </div>
        </div>  
    </div>

    <table class="table table-striped mt-2 display dataTable table-hover" cellspacing="3" cellpadding="3">

        <tr role="row" class="odd">
            <td class="sorting_1" width="5%"><b>Fecha de Reseña</b></td>
            <td class="sorting_1" width="10%">{{date('d/m/Y', strtotime($resenna->fecha_resenna))}}</td>
            <td class="sorting_1" width="2%"><b>Estatus de Documentación</b></td>
            <td class="sorting_1" width="10%">{{$resenna->resennado->documentacion->valor}}</td>
            <td class="sorting_1" width="5%"><b>Cédula</b></td>
            <td class="sorting_1" width="10%">{{$resenna->resennado->letra_cedula.'-'.$resenna->resennado->cedula}}</td>
        </tr>

        <tr>
            <td class="sorting_1"><b>Nombres</b></td>
            <td class="sorting_1">{{$resenna->resennado->primer_nombre.', '.$resenna->resennado->segundo_nombre}}</td>
            <td class="sorting_1"><b>Apellidos</b></td>
            <td class="sorting_1">{{$resenna->resennado->primer_apellido.', '.$resenna->resennado->segundo_apellido}}</td>
            <td class="sorting_1"><b>Fecha de Nacimiento</b></td>
            <td class="sorting_1">{{date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento))}}</td>
        </tr>
        
        <tr role="row" class="odd">
            <td class="sorting_1"><b>Género</b></td>
            <td class="sorting_1">{{$resenna->resennado->genero->valor}}</td>
            <td class="sorting_1"><b>Tez</b></td>
            <td class="sorting_1">{{$resenna->tez->valor}}</td>
            <td class="sorting_1"><b>Contextura</b></td>
            <td class="sorting_1">{{$resenna->contextura->valor}}</td>
        </tr>
        <tr role="row" class="odd">
            <td class="sorting_1"><b>Estado Civil</b></td>
            <td class="sorting_1">{{$resenna->estado_civil->valor}}</td>
            <td class="sorting_1"><b>Estado de Nacimiento</b></td>
            <td class="sorting_1">{{$resenna->resennado->estado_nacimiento->valor}}</td>
            <td class="sorting_1"><b>Municipio de Nacimiento</b></td>
            <td class="sorting_1">{{$resenna->resennado->municipio_nacimiento->valor}}</td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1"><b>Profesión</b></td>
            <td class="sorting_1">{{$resenna->profesion->valor}}</td>
            <td class="sorting_1"><b>Dirección</b></td>
            <td class="sorting_1">{{$resenna->direccion}}</td>
        </tr>

        <tr>
            <td class="sorting_1"><b>Motivo de Reseña</b></td>
            <td class="sorting_1">{{$resenna->motivo_resenna->valor}}</td>
            <td class="sorting_1"><b>Observaciones</b></td>
            <td class="sorting_1">{{$resenna->observaciones}}</td>
        </tr>
        
        <tr role="row" class="odd">
            <td class="sorting_1"><b>Funcionario Aprehensor</b></td>
            <td class="sorting_1">{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}</td>
            <td class="sorting_1"><b>Funcionario que Reseña</b></td>
            <td class="sorting_1">{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}</td>
        </tr>

    </table>  
    <hr>
    <br><br><br><br><br><hr>

                <label for=""><b>Fecha de Reseña</b></label>
                <label for="">{{date('d/m/Y', strtotime($resenna->fecha_resenna))}}</label>
                <br>
                <label for=""><b>Estatus de Documentación</b></label>
                <label type="text">{{$resenna->resennado->documentacion->valor}}</label>
                <label for=""><b>Cédula</b></label>
                <label type="text">{{$resenna->resennado->letra_cedula.'-'.$resenna->resennado->cedula}}</label>
                <br>
                <label><b>Nombres</b></label>
                <label>{{$resenna->resennado->primer_nombre.', '.$resenna->resennado->segundo_nombre}}</label>
                <label><b>Apellidos</b></label>
                <label>{{$resenna->resennado->primer_apellido.', '.$resenna->resennado->segundo_apellido}}</label>
                <br>
                <label><b>Fecha de Nacimiento</b></label>
                <label>{{date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento))}}</label>
                <label><b>Género</b></label>
                <label>{{$resenna->resennado->genero->valor}}</label>
                <br>
                <label><b>Tez</b></label>
                <label>{{$resenna->tez->valor}}</label>
                <label><b>Contextura</b></label>
                <label>{{$resenna->contextura->valor}}</label>
                <br>
                <label><b>Estado Civil</b></label>
                <label>{{$resenna->estado_civil->valor}}</label>
                <label><b>Profesión</b></label>
                <label>{{$resenna->profesion->valor}}</label>
                <br>
                <label><b>Estado de Nacimiento</b></label>
                <label>{{$resenna->resennado->estado_nacimiento->valor}}</label>
                <label><b>Municipio de Nacimiento</b></label>
                <label>{{$resenna->resennado->municipio_nacimiento->valor}}</label>
                <br>
                <label><b>Dirección</b></label>
                <label>{{$resenna->direccion}}</label>
                <br>
                <label><b>Motivo de Reseña</b></label>
                <label>{{$resenna->motivo_resenna->valor}}</label>
                <br>
                <label><b>Funcionario Aprehensor</b></label>
                <label>{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}</label>
                <br>
                <label><b>Funcionario que Reseña</b></label>
                <label>{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}</label>
                <br>
                <label><b>Observaciones</b></label>
                <label>{{$resenna->observaciones}}</label>

        <br><br><hr>

</body>
</html>

<!-- Template JS File -->
<script src="{{ public_path('web/js/stisla.js') }}"></script>
<script src="{{ public_path('web/js/scripts.js') }}"></script>
<script src="{{ public_path('assets/js/profile.js') }}"></script>
<script src="{{ public_path('assets/js/custom/custom.js') }}"></script>
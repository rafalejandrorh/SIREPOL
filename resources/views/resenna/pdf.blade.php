<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reseña Policial {{$resenna->resennado->letra_cedula.$resenna->resennado->cedula.' - '.$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</title>
    <link rel="icon" href="{{ public_path('img/logo_pmcr_sin_fondo.png')}}">
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ public_path('assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ public_path('css/app.css') }}" type="text/css">
    @yield('page_css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ public_path('web/css/style.css') }}">
    <link rel="stylesheet" href="{{ public_path('web/css/components.css')}}">
    @yield('page_css')

    <style>

        .headt td{
            width: 20%;
            height: 0%
        }

    </style>

    @yield('css')
</head>
<body>
    <img src="{{ public_path('img/logo_pmcr_sin_fondo.png') }}" width="100">
    <img src="{{ public_path('img/logo_mpprijp.png') }}" width="125" align="right">

    <h2 align="center" style="color:#000000"><b>Reseña Policial</b></h2>
    <h3 align="center" style="color:#000000"><b>{{$resenna->resennado->letra_cedula.$resenna->resennado->cedula.' - '.$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</b></h3>
    <hr>

    {{-- <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12">
            <div class="form-group">
                <i class="fa fa-address-card f-30 text-c-blue"></i>
                {{-- <label for="name">Ficha Fotográfica</label> --}}
                {{-- <span><b>Ficha Fotográfica</b></span>
            </div>
        </div>
        <div class="col-xs-2 col-sm-2 col-md-2">
            <div class="form-group">
                <center><img src="{{ public_path($resenna->url_foto) }}" class="img-responsive" width="100" height="110"></center>
            </div>
        </div>  
    </div> --}}

    <table class="table table-striped mt-2 display dataTable table-hover" cellspacing="3" cellpadding="3">
        
        <tr role="row" class="headt">
            <td class="sorting_1" width="5%" colspan="2"><center><b>Ficha Fotográfica</b></center></center></td>
            <td class="sorting_1" width="5%" colspan="2"><center><b>Fecha de Reseña</b></center></td>
            <td class="sorting_1" width="2%" colspan="2"><center><b>Estatus de Documentación</b></center></td>
        </tr>

        <tr  role="row" class="headt">
            <td class="sorting_1" colspan="2" rowspan="3"><center><img src="{{public_path($resenna->url_foto)}}" width="110" height="100"></center></td>
            <td class="sorting_1" width="4%" colspan="2"><center>{{date('d/m/Y', strtotime($resenna->fecha_resenna))}}</center></td>
            <td class="sorting_1" width="5%" colspan="2"><center>{{$resenna->resennado->documentacion->valor}}</center></td>
        </tr>

        <tr role="row" class="headt">
            <td class="sorting_1" width="5%" colspan="1" height="10px"><center><b>Cédula</b></center></td>
            <td class="sorting_1" colspan="2"><center><b>Estado Civil</b></center></td>
            <td class="sorting_1" colspan="1"><center><b>Edad</b></center></td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" width="10%" colspan="1"><center>{{$resenna->resennado->letra_cedula.'-'.$resenna->resennado->cedula}}</center></td>
            <td class="sorting_1" colspan="2"><center>{{$resenna->estado_civil->valor}}</center></td>
            <td class="sorting_1" colspan="1"><center>{{$edad}}</center></td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" colspan="2"><center><b>Nombres</b></center></td>
            <td class="sorting_1" colspan="2"><center><b>Apellidos</b></center></td>
            <td class="sorting_1" colspan="2"><center><b>Fecha de Nacimiento</b></center></td>
            
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" colspan="2"><center>{{$resenna->resennado->primer_nombre.' '.$resenna->resennado->segundo_nombre}}</center></td>
            <td class="sorting_1" colspan="2"><center>{{$resenna->resennado->primer_apellido.' '.$resenna->resennado->segundo_apellido}}</center></td>
            <td class="sorting_1" colspan="2"><center>{{date('d/m/Y', strtotime($resenna->resennado->fecha_nacimiento))}}</center></td>
            
        </tr>
        
        <tr role="row" class="odd">
            <td class="sorting_1" colspan="1"><center><b>Género</b></center></td>
            <td class="sorting_1" colspan="1"><center><b>Tez</b></center></td>
            <td class="sorting_1" colspan="1"><center><b>Contextura</b></center></td>
            <td class="sorting_1"colspan="1"><center><b>Estado de Nacimiento</b></center></td> 
            <td class="sorting_1"colspan="2"><center><b>Municipio de Nacimiento</b></center></td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" colspan="1"><center>{{$resenna->resennado->genero->valor}}</center></td>
            <td class="sorting_1" colspan="1"><center>{{$resenna->tez->valor}}</center></td>
            <td class="sorting_1" colspan="1"><center>{{$resenna->contextura->valor}}</center></td>
            <td class="sorting_1"colspan="1"><center>{{$resenna->resennado->estado_nacimiento->valor}}</center></td>
            <td class="sorting_1"colspan="2"><center>{{$resenna->resennado->municipio_nacimiento->valor}}</center></td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" colspan="3"><center><b>Profesión</b></center></td>
            <td class="sorting_1" colspan="3"><center><b>Dirección</b></center></td>
        </tr>

        <tr>
            <td class="sorting_1" colspan="3"><center>{{$resenna->profesion->valor}}</center></td>
            <td class="sorting_1" colspan="3"><center>{{$resenna->direccion}}</center></td>
        </tr>

        <tr>
            <td class="sorting_1" colspan="2"><center><b>Motivo de Reseña</b></center></td>
            <td class="sorting_1" colspan="2"><center><b>Funcionario Aprehensor</b></center></td>
            <td class="sorting_1" colspan="2"><center><b>Funcionario que Reseña</b></center></td>
        </tr>

        <tr role="row" class="odd">
            <td class="sorting_1" colspan="2"><center>{{$resenna->motivo_resenna->valor}}</center></td>
            <td class="sorting_1" colspan="2"><center>{{$resenna->funcionario_aprehensor->jerarquia->valor.'. '.$resenna->funcionario_aprehensor->person->primer_nombre.' '.$resenna->funcionario_aprehensor->person->primer_apellido }}</center></td>
            <td class="sorting_1" colspan="2"><center>{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido }}</center></td>
        </tr>
        
        <tr role="row" class="odd">
            <td class="sorting_1" colspan="6"><center><b>Observaciones</b></center></td>
        </tr>

        <tr>
            <td class="sorting_1" colspan="6"><center>{{$resenna->observaciones}}</center></td>
        </tr>
        
    </table>  
    <hr>
</body>
</html>

<!-- Template JS File -->
<script src="{{ public_path('web/js/stisla.js') }}"></script>
<script src="{{ public_path('web/js/scripts.js') }}"></script>
<script src="{{ public_path('assets/js/profile.js') }}"></script>
<script src="{{ public_path('assets/js/custom/custom.js') }}"></script>
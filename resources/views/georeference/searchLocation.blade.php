@extends('layouts.app')
@extends('georeference.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Georeferencia</b></h3>
        </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="page__heading"><b>Buscar Localización Geográfica</b></h4>
                            {!! Form::open(array('route' => 'georeference.search','method' => 'GET')) !!}
                            <div class="row">
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        {!! Form::text('buscador', isset($geodata['busqueda']) ? $geodata['busqueda'] : null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 col-md-6">
                                    {!! Form::button('<i class="fa fa-search"></i>  Buscar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                </div>

                                {{-- @foreach ($geodata as $data)
                                    
                                @endforeach --}}
                                <div class="col-xs-9 col-sm-9 col-md-9">
                                    <div class="form-group">
                                        <label for="email">Dirección</label>
                                        {!! Form::text('direccion', isset($geodata['direccion']) ? $geodata['direccion'] : null, array('class' => 'form-control', 'readonly')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Coordenadas</label>
                                        {!! Form::text('coordenadas', isset($geodata['coordenadas']) ? $geodata['coordenadas'] : null, ['class'=>'form-control','autocomplete' => 'off', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Estado</label>
                                        {!! Form::text('estado', isset($geodata['estado']) ? $geodata['estado'] : null, array('class' => 'form-control', 'readonly')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Ciudad</label>
                                        {!! Form::text('ciudad', isset($geodata['ciudad']) ? $geodata['ciudad'] : null, ['class'=>'form-control','autocomplete' => 'off', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Municipio</label>
                                        {!! Form::text('municipio', isset($geodata['municipio']) ? $geodata['municipio'] : null, ['class'=>'form-control','autocomplete' => 'off', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Sector</label>
                                        {!! Form::text('sector', isset($geodata['sector']) ? $geodata['sector'] : null, ['class'=>'form-control','autocomplete' => 'off', 'readonly']) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        <label for="email">Calle/Avenida</label>
                                        {!! Form::text('calle', isset($geodata['calle']) ? $geodata['calle'] : null, ['class'=>'form-control','autocomplete' => 'off', 'readonly']) !!}
                                    </div>
                                </div>

                            {!! Form::close() !!}
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    {{-- @include('georeference.partials.maps') --}}
                                    <div style="width: 1050px; height: 450;">
                                        {!! Mapper::render() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 

    </section>

@endsection

<script src="{{ asset('public/js/maps/index.js')}}"></script>

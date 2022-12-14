@extends('layouts.app')
@extends('resenna.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Gráficos de Reseñas</b></h3>
        </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                                </div>
                            
                                <div class="col-xs-2 col-sm-2 col-md-2"> 
                                    {!! Form::open(array('route' => 'resenna.charts','method' => 'GET')) !!}
                                    <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#filtrar"><i class="fa fa-filter"></i> Filtro</a>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                           
                            @if ($dataType == 'origenresennados')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        @include('resenna.partials.graphicsOriginResennados')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>  
                            @elseif ($dataType == 'cantresennasdelito')
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        @include('resenna.partials.graphicsCrimeResennas')
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @else
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                                        <h3>Aún no haz seleccionado Gráficos para mostrar</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            @endif

                        </div>
                    </div>
                </div>
            </div>
    </section>

    @include('resenna.modals.filtro', ['filtro' => 'resenna.charts'])
@endsection

@section('scripts')
    <script type="application/javascript">
        const last_id_resenna = "@php echo $last_id_resenna['id']; @endphp";
    </script>
    <script src="{{ asset('public/js/resenna/index.js')}}"></script>
    
@endsection

<script src="{{ asset('public/js/maps/index.js')}}"></script>

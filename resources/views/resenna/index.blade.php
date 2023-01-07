@extends('layouts.app')
@extends('resenna.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Reseñas</b></h3>
        </div>

            @if (!isset($restore))
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="page__heading"><b>Indicadores</b></h4>
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card bg-primary order-card">
                                            <div class="card-block">
                                                <h5>Reseñas de Hoy</h5>
                                                <h3 class="text-left"><span>{{$countResennasDia}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card bg-primary order-card">
                                            <div class="card-block">
                                                <h5>Reseñas del Mes</h5>
                                                <h3 class="text-left"><span>{{$countResennasMes}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="card bg-primary order-card">
                                            <div class="card-block">
                                                <h5>Reseñas del Año</h5>
                                                <h3 class="text-left"><span>{{$countResennasAnno}}</span></h3>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @if (!isset($restore))
                                <h4 class="page__heading"><b>Reseñados</b></h4>
                                {!! Form::open(array('route' => 'resenna.index','method' => 'GET')) !!}
                                <div class="row">
                                    <div class="col-xs-4 col-sm-4 col-md-4">
                                        <div class="form-group">
                                            {!! Form::select('tipo_busqueda', ['' => 'Ver todos',
                                            'motivo_resenna' => 'Motivo de Reseña',
                                            'cedula_resennado' => 'Cédula del Reseñado',
                                            'cedula_resenna' => 'Cédula del Funcionario que Reseña',
                                            'cedula_aprehensor' => 'Cédula del Funcionario Aprehensor', 
                                            'credencial_resenna' => 'Credencial del Funcionario que Reseña', 
                                            'credencial_aprehensor' => 'Credencial del Funcionario Aprehensor',
                                            'jerarquia_resenna' => 'Jerarquía del Funcionario que Reseña',
                                            'jerarquia_aprehensor' => 'Jerarquía del Funcionario que Aprehensor',
                                            'nombre_resennado' => 'Primer Nombre del Reseñado',
                                            'apellido_resennado' => 'Primer Apellido del Reseñado',
                                            'nombre_resenna' => 'Primer Nombre del Funcionario que Reseña',
                                            'apellido_resenna' => 'Primer Apellido del Funcionario que Reseña',
                                            'nombre_aprehensor' => 'Primer Nombre del Funcionario Aprehensor',
                                            'apellido_aprehensor' => 'Primer Apellido del Funcionario Aprehensor'], 
                                            'Seleccionar', array('class' => 'form-control select2')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        <div class="form-group">
                                            {!! Form::text('buscador', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        {!! Form::button('<i class="fa fa-search"></i> Buscar', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2"> 
                                        <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#filtrar"><i class="fa fa-filter"></i> Filtro</a>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                            @endif

                            <div class="row">
                                @if(!isset($restore))
                                    <div class="col-xs-8 col-sm-8 col-md-8">
                                        <div class="form-group">
                                            @can('resenna.create')
                                            <a class="btn btn-danger" href="{{ route('resenna.restore.index') }}"><i class="fa fa-trash"></i> Papelera de Reciclaje</a>  
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            @can('resenna.charts')
                                            <a class="btn btn-info" href="{{ route('resenna.charts') }}"><i class="fa fa-bars"></i> Gráficos</a>  
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            @can('resenna.create')
                                            <a class="btn btn-success" href="{{ route('resenna.create') }}"><i class="fa fa-plus"></i> Registrar</a>  
                                            @endcan
                                        </div>
                                    </div>
                                @elseif (isset($restore))
                                    <div class="col-xs-10 col-sm-10 col-md-10">
                                        <div class="form-group">
                                            @can('resenna.index')
                                            <a class="btn btn-info" href="{{ route('resenna.index') }}"><i class="fa fa-list"></i> Listado de Reseñas</a>  
                                            @endcan
                                        </div>
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <div class="form-group">
                                            @can('resenna.index')
                                            <a class="btn btn-success" href="{{ route('resenna.restore.all') }}"><i class="fa fa-recycle"></i> Restaurar Todo</a>  
                                            @endcan
                                        </div>
                                    </div>
                                @endif

                            </div>

                            <table class="table table-striped mt-2 display dataTable table-hover">
                                <thead>
                                    <tr role="row">
                                        <th>Fecha</th>
                                        <th>Cédula de Reseñado</th>
                                        <th>Nombre de Reseñado</th>
                                        <th>Funcionario de Reseña</th>
                                        <th>Acciones</th>
                                    </tr>    
                                </thead>
                                    @foreach ($resennas as $resenna)
                                    <tr role="row" class="odd">
                                        <td class="sorting_1">{{ date('d/m/Y', strtotime($resenna->fecha_resenna)) }}</td>
                                        <td class="sorting_1">{{$resenna->resennado->cedula}}</td>
                                        <td class="sorting_1">{{$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</td>
                                        <td class="sorting_1">{{$resenna->funcionario_resenna->jerarquia->valor.'. '.$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido}}</td>
                                        <td align="center">
                                            @if(!isset($restore))
                                                @can('resenna.show')
                                                    <a class="btn btn-info" href="{{ route('resenna.show', $resenna->id) }}"><i class='fa fa-eye'></i></a>
                                                @endcan
                                                @can('resenna.edit')
                                                    <a class="btn btn-primary" href="{{ route('resenna.edit', $resenna->id) }}"><i class='fa fa-edit'></i></a>
                                                @endcan
                                                @can('resenna.destroy')
                                                {!! Form::open(['method' => 'DELETE', 'route' => ['resenna.destroy', $resenna->id], 'style'=>'display:inline', 'class' => 'eliminar']) !!}
                                                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                {!! Form::close() !!}                                                  
                                                @endcan
                                            @else
                                                <a class="btn btn-success" href="{{ route('resenna.restore', $resenna->id) }}"><i class='fa fa-recycle'></i></a>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="pagination justify-content-end">  
                                {{ $resennas->appends(request()->input())->links() }}          
                            </div> 
                        </div>
                    </div>
                </div>
            </div>

            @if (!isset($restore))
                @can('resenna.georeference')
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="page__heading"><b>Coordenadas Geográficas de Aprehensión de los Reseñados</b></h4>
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                            @include('resenna.partials.maps')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> 
                @endcan

                </section>
                @include('resenna.modals.filtro', ['filtro' => 'resenna.index'])
        
            @endif
@endsection

@if (isset($last_id_resenna))
    @section('scripts')
    <script type="application/javascript">
        const last_id_resenna = "@php echo $last_id_resenna['id']; @endphp";
    </script>
    <script src="{{ asset('public/js/resenna/index.js')}}"></script>
    @endsection
@endif

<script src="{{ asset('public/js/maps/index.js')}}"></script>

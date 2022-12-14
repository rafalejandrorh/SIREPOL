@extends('layouts.app')
@extends('resenna.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Reseñas</b></h3>
        </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                {!! Form::open(array('route' => 'resenna.index','method' => 'GET')) !!}
                                <div class="row">
                                    <div class="col-4 col-auto">
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
                                    <div class="col-3 col-sm-3 col-md-3 col-lg-3 col-auto">
                                        <div class="form-group">
                                            {!! Form::text('buscador', null, array('class' => 'form-control')) !!}
                                        </div>
                                    </div>
                                    <div class="col-3 col-auto">
                                        {!! Form::button('<i class="fa fa-search"> Buscar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                    <div class="col-2 col-auto d-flex justify-content-end" style="height: 2.3rem;"> 
                                        <a href="#!" class="btn btn-primary mr-2" data-toggle="modal" data-target="#filtrar" data-bs-toggle="Filtro" data-bs-placement="top" title="Filtro"><i class="fa fa-filter"></i> Filtro</a>

                                        <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#filtrar"><i class="fa fa-reply"></i></a>
                                    </div>
                                </div>

                                {!! Form::close() !!}
                                @can('resenna.create')
                                <a class="btn btn-success" href="{{ route('resenna.create') }}">Crear Reseña</a>  
                                <br>                      
                                @endcan
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
                    </div>
                </div>
            </div>
        </div> 

        @include('resenna.modals.filtro')

    </section>
@endsection

@section('scripts')

    <script>
        $('.eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esta Acción",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Si, Eliminar!'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }
            })
        });
    </script>

@endsection
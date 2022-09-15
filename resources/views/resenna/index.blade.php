@extends('layouts.app')

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
                                            {!! Form::text('buscador', null, array('class' => 'form-control', 'onkeyup'=>'mayus(this);')) !!}
                                        </div>
                                    </div>
                                    <div class="col-xs-3 col-sm-3 col-md-3">
                                        {!! Form::button('<i class="fa fa-search"> Buscar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                    </div>
                                    <div class="col-xs-2 col-sm-2 col-md-2">
                                        <a href="#!" class="btn btn-primary" data-toggle="modal" data-target="#filtrar"><i class="fa fa-filter"></i> Filtro</a>
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
                                                        {!! Form::open(['method' => 'DELETE','route' => ['resenna.destroy', $resenna->id],'style'=>'display:inline', 'class' => 'eliminar']) !!}
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

        {{-- Modal de Filtro --}}
        <div class="modal fade" id="filtrar" tabindex="-1" aria-labelledby="filtro" aria-hidden="true">
            <div class="modal-dialog modal-lg">
            <div class="modal-content">
                    <div class="modal-header bg-primary">
                        <h3 class="page__heading text-white"><b>Filtro</b></h3>
                        <span aria-hidden="true" class="close text-white" data-dismiss="modal" aria-label="Close">&times;</span>
                    </div>
                {!! Form::open(array('route' => 'resenna.index','method' => 'GET')) !!}
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
                            {!! Form::button('<i class="fa fa-check"> Aplicar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                        </div>
                    </div>

                </div>
                {!! Form::close() !!}
            </div>
            </div>
        </div>

    </section>
@endsection

@section('scripts')

    <script>
        $('.eliminar').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estás seguro?',
            text: "No podrás revertir esto!",
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
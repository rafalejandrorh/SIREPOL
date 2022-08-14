@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Reseñas</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                @can('resenna.create')
                                <a class="btn btn-success" href="{{ route('resenna.create') }}">Añadir Usuario</a>                        
                                @endcan
                                        <table class="table table-striped mt-2">
                                            <thead>
                                                <tr role="row">
                                                    <th>Fecha</th>
                                                    <th>Cédula de Reseñado</th>
                                                    <th>Nombre Completo de Reseñado</th>
                                                    <th>Motivo de Reseña</th>
                                                    <th>Funcionario de Reseña</th>
                                                    <th>Funcionario Aprehensor</th>
                                                    <th>Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($resennas as $resenna)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$resenna->fecha_resenna}}</td>
                                                    <td class="sorting_1">{{$resenna->resennado->cedula}}</td>
                                                    <td class="sorting_1">{{$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</td>>
                                                    <td class="sorting_1">{{$resenna->motivo_resenna->valor}}</td>
                                                    <td class="sorting_1">{{$resenna->funcionario_resenna->primer_nombre.' '.$resenna->funcionario_resenna->primer_apellido}}</td>
                                                    <td class="sorting_1">{{$resenna->funcionario_aprehensor->primer_nombre.' '.$resenna->funcionario_aprehensor->primer_apellido}}</td>
                                                    <td align="center">
                                                        @can('resenna.edit')
                                                        <a class="btn btn-info" href="{{ route('resenna.edit', 1) }}"><i class='fa fa-edit'></i></a>
                                                        {!! Form::open(['method' => 'DELETE','route' => ['resenna.destroy', 1],'style'=>'display:inline']) !!}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}                                                  
                                                        @endcan
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        <div class="pagination justify-content-end">
                                                                
                                        </div> 
                                    </div>
                                </div>
        
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </section>
@endsection
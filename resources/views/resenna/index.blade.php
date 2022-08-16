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
                                                    <th>Nombre de Reseñado</th>
                                                    <th>Funcionario de Reseña</th>
                                                    <th>Acciones</th>
                                            </thead>
                                            <tbody>
                                                @foreach ($resennas as $resenna)
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{ date('d/m/Y', strtotime($resenna->fecha_resenna)).'.'}}</td>
                                                    <td class="sorting_1">{{$resenna->resennado->cedula}}</td>
                                                    <td class="sorting_1">{{$resenna->resennado->primer_nombre.' '.$resenna->resennado->primer_apellido}}</td>
                                                    <td class="sorting_1">{{$resenna->funcionario_resenna->person->primer_nombre.' '.$resenna->funcionario_resenna->person->primer_apellido}}</td>
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
                                            {!! $resennas->links() !!}          
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

@section('scripts')

    @if (session('eliminar') == 'Ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La Reseña ha sido Eliminada.',
                'success'
            )
        </script>
    @endif

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
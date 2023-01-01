@extends('layouts.app')
@extends('configuraciones.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Configuraciones - Rutas de Almacenamiento</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @can('permisos.create')
                            <a class="btn btn-success" href="{{ route('rutasAlmacenamiento.create') }}">Registrar</a>                        
                            @endcan
                                    <table class="table table-striped mt-2 display dataTable table-hover">
                                        <thead>
                                            <tr role="row">
                                                <th>Ruta</th>
                                                <th>Tipos de Archivo</th>
                                                <th>Módulo</th>
                                                <th>Descripción</th>
                                                <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($rutasAlmacenamiento as $almacenamiento)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$almacenamiento->ruta}}</td>
                                                <td class="sorting_1">{{$almacenamiento->tipo_archivo}}</td>
                                                <td class="sorting_1">{{$almacenamiento->modulo}}</td>
                                                <td class="sorting_1">{{$almacenamiento->descripcion}}</td>
                                                <td align="center">
                                                    @can('permisos.edit')
                                                        <a class="btn btn-primary" href="{{ route('rutasAlmacenamiento.edit', $almacenamiento->id) }}"><i class='fa fa-edit'></i></a>
                                                    @endcan
                                                    @can('permisos.destroy')
                                                        {!! Form::open(['method' => 'DELETE', 'route' => ['rutasAlmacenamiento.destroy', $almacenamiento->id], 'style'=>'display:inline', 'class' => 'eliminar']) !!}
                                                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                        {!! Form::close() !!}  
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {{ $rutasAlmacenamiento->appends(request()->input())->links() }}
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
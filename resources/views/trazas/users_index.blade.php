@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Trazas de Usuarios</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <a href="{{ route('trazas.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                            </div>
                                    <table class="table table-striped mt-2">
                                        <thead>
                                            <tr role="row">
                                                <th>Usuario</th>
                                                <th>Acción</th>
                                                <th>Fecha</th>
                                                <th>Opciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$user->user->users}}</td>
                                                <td class="sorting_1">{{$user->acciones->valor}}</td>
                                                <td class="sorting_1">{{$user->created_at}}</td>
                                                <td>
                                                    <a class="btn btn-info" href="{{ route('traza_user.show', $user->id) }}"><i class='fa fa-eye'></i></a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {!! $users->links() !!}
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
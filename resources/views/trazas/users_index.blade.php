@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Historial de Sesión</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                                    <table class="table table-striped mt-2">
                                        <thead>
                                            <tr role="row">
                                                <th>Usuario</th>
                                                <th>Funcionario Asignado</th>
                                                <th>Inicio de Sesión</th>
                                                <th>Cierre de Sesión</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($historial_sesion as $historial)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$historial->user->users}}</td>
                                                <td class="sorting_1">{{$historial->user->funcionario->jerarquia->valor.'. '.$historial->user->funcionario->person->primer_nombre.' '.$historial->user->funcionario->person->primer_apellido}}</td>
                                                <td class="sorting_1">{{$historial->login}}</td>
                                                <td class="sorting_1">{{$historial->logout}}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {!! $historial_sesion->links() !!}
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
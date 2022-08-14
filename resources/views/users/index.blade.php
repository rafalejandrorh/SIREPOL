@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Usuarios</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            @can('users.create')
                            <a class="btn btn-success" href="{{ route('users.create') }}">Añadir Usuario</a>                        
                            @endcan
                                    <table class="table table-striped mt-2">
                                        <thead>
                                            <tr role="row">
                                                <th>Credencial</th>
                                                <th>Cédula</th>
                                                <th>Funcionario</th>
                                                <th>Jerarquía</th>
                                                <th>Usuario</th>
                                                <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($Users as $user)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$user->funcionario->credencial}}</td>
                                                <td class="sorting_1">{{$user->funcionario->person->cedula}}</td>
                                                <td class="sorting_1">{{$user->funcionario->person->primer_nombre.''.$user->funcionario->person->primer_apellido}}</td>
                                                <td class="sorting_1">{{$user->funcionario->jerarquia->valor}}</td>
                                                <td class="sorting_1">{{$user->users}}</td>
                                                <td align="center">
                                                    @can('users.edit')
                                                    <a class="btn btn-info" href="{{ route('users.edit',$user->id) }}"><i class='fa fa-edit'></i></a>
                                                    @endcan
                
                                                    @can('users.destroy')
                                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                    {!! Form::close() !!}                                                  
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {!! $Users->links() !!}
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
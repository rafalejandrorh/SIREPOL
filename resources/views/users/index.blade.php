@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading">Dashboard</h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center">Lista de Usuarios</h3>
                            <div class="row justify-content-md-center">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            @can('users.create')
                                                <a href="{{ route('users.create') }}" class="btn btn-danger">Añadir Usuario</a>
                                            @endcan
                                        </div>
                                        <div class="card-block">
                                            <div class>
                                                <div id="zero-" class="dataTables_wrapper dt-bootstrap4">
                            
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <table id="example" class="display table nowrap table-striped table-hover dataTable" style="width:100%" role="grid" aria-describedby="zero-configuration_info">
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
                                                                            <a class="btn btn-info" href="{{ route('users.edit',$user->id) }}">Editar</a>
                                                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                                                {!! Form::submit('Borrar', ['class' => 'btn btn-danger']) !!}
                                                                            {!! Form::close() !!}                                                  
                                                                            @endcan
                                                                        </td>
                                                                    </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                            
                                                </div>
                                            </div>
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
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
                                                {{-- <a href="#!" class="unread label theme-bg4 text-white f-12 float-right" data-toggle="modal" data-target="#modal_create">Añadir Usuario</a>    --}}
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
                                                                        <th>Usuario</th>
                                                                        <th>División</th>
                                                                        <th>Acciones</th>
                                                                </thead>
                                                                <tbody>
                                                                   @foreach ($Users as $user)
                                                                    <tr role="row" class="odd">
                                                                        <td class="sorting_1"></td>
                                                                        <td class="sorting_1"></td>
                                                                        <td class="sorting_1"></td>
                                                                        <td class="sorting_1">{{$user->name}}</td>
                                                                        <td></td>
                                                                        <td align="center">
                                                                            @can('users.edit')
                                                                            <a href="" class="btn btn-success">Editar</a>{{-- {{route('users.edit')}} --}}
                                                                            <button class="btn btn-warning" title="Eliminar">Bloquear</button>                                                          
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
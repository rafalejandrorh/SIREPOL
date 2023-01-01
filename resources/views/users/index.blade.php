@extends('layouts.app')
@extends('users.partials.header')
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
                            <div class="row">
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-info order-card">
                                        <div class="card-block">
                                            <h5>Total de Usuarios</h5>
                                            <h3 class="text-left"><span>{{$countUsers}}</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-success order-card">
                                        <div class="card-block">
                                            <h5>Usuarios Activos</h5>
                                            <h3 class="text-left"><span>{{$countUsersActive}}</span></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4 col-xl-4">
                                    <div class="card bg-danger order-card">
                                        <div class="card-block">
                                            <h5>Usuarios Inactivos</h5>
                                            <h3 class="text-left"><span>{{$countUsersInactive}}</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(array('route' => 'users.index','method' => 'GET')) !!}
                            <div class="row">
                                <div class="col-xs-3 col-sm-3 col-md-5">
                                    <div class="form-group">
                                        {!! Form::select('tipo_busqueda', ['' => 'Ver todos',
                                        'cedula' => 'Cédula',
                                        'credencial' => 'Credencial',
                                        'jerarquia' => 'Jerarquía', 
                                        'usuario' => 'Usuario', 
                                        'estatus' => 'Estatus',
                                        'nombre' => 'Primer Nombre del Funcionario',
                                        'apellido' => 'Primer Apellido del Funcionario',], 
                                        'Seleccionar', array('class' => 'form-control select2')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    <div class="form-group">
                                        {!! Form::text('buscador', null, array('class' => 'form-control')) !!}
                                    </div>
                                </div>
                                <div class="col-xs-3 col-sm-3 col-md-3">
                                    {!! Form::button('<i class="fa fa-search"> Buscar</i>', ['type' => 'submit', 'class' => 'btn btn-primary']) !!}
                                </div>
                            </div>
                            {!! Form::close() !!}
                            @can('users.create')
                            <a class="btn btn-success" href="{{ route('users.create') }}">Crear</a>                        
                            @endcan
                                    <table class="table table-striped mt-2 display dataTable table-hover">
                                        <thead>
                                            <tr role="row">
                                                <th>Funcionario</th>
                                                <th>Jerarquía</th>
                                                <th>Usuario</th>
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($Users as $user)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$user->funcionario->person->primer_nombre.' '.$user->funcionario->person->primer_apellido}}</td>
                                                <td class="sorting_1">{{$user->funcionario->jerarquia->valor}}</td>
                                                <td class="sorting_1">{{$user->users}}</td>
                                                @can('users.update_status')
                                                {!! Form::model($user, ['method' => 'PATCH','route' => ['users.update_status', $user->id], 'class' => 'estatus']) !!}
                                                    <td class="sorting_1">
                                                        {!! Form::button($user->status ? 'Activo' : 'Inactivo', ['type' => 'submit', 'class' => $user->status ? 'btn btn-info' : 'btn btn-danger']) !!}
                                                    </td>
                                                {!! Form::close() !!} 
                                                @elsecan('users.index')
                                                    @if($user->status == true)
                                                        <td class="sorting_1">
                                                            <button class="btn btn-info">Activo</button>
                                                        </td>
                                                    @else
                                                        <td class="sorting_1">                                                        
                                                            <button class="btn btn-danger">Inactivo</button>
                                                        </td>
                                                    @endif  
                                                @endcan
                                                <td align="center">
                                                    @can('users.show')
                                                        <a class="btn btn-info" href="{{ route('users.show', $user->id) }}"><i class='fa fa-eye'></i></a>
                                                    @endcan
                                                    @can('users.edit')
                                                        <a class="btn btn-primary" href="{{ route('users.edit', $user->id) }}"><i class='fa fa-edit'></i></a>
                                                    @endcan
                                                </td>
                                            </tr>
                                            @endforeach

                                            
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {{ $Users->appends(request()->input())->links() }}
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

    <script>
        $('.estatus').submit(function(e){
            e.preventDefault();

            Swal.fire({
            title: '¿Estás seguro?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Si, Estoy Seguro!'
            }).then((result) => {
            if (result.value) {
                this.submit();
            }
            })
        });
    </script>

@endsection
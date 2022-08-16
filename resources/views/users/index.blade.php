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
                                                <th>Estatus</th>
                                                <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($Users as $user)
                                            <tr role="row" class="odd">
                                                <td class="sorting_1">{{$user->funcionario->credencial}}</td>
                                                <td class="sorting_1">{{$user->funcionario->person->cedula}}</td>
                                                <td class="sorting_1">{{$user->funcionario->person->primer_nombre.' '.$user->funcionario->person->primer_apellido}}</td>
                                                <td class="sorting_1">{{$user->funcionario->jerarquia->valor}}</td>
                                                <td class="sorting_1">{{$user->users}}</td>
                                                @can('users.destroy')
                                                    @if($user->status == 1)
                                                        <td class="sorting_1">
                                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                                {!! Form::button('Activo', ['type' => 'submit', 'class' => 'btn btn-info']) !!}
                                                            {!! Form::close() !!} 
                                                        </td>
                                                    @else
                                                        <td class="sorting_1">                                                        
                                                            {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                                                                {!! Form::button('Inactivo', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!} 
                                                        </td>
                                                    @endif
                                                @elsecan('users.index')
                                                    @if($user->status == 1)
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

@section('scripts')

    @if (session('registrar') == 'Ok')
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'El Usuario ha sido registrado.',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif

    @if (session('editar') == 'Ok')
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'El Usuario ha sido actualizado.',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif

    @if (session('status') == 'Ok')
        <script>
            Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: 'Estatus de Usuario actualizado.',
            showConfirmButton: false,
            timer: 1500
            })
        </script>
    @endif

@endsection
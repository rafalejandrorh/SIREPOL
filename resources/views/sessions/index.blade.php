@extends('layouts.app')
@extends('sessions.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Sesiones</b></h3>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(array('route' => 'sessions.index','method' => 'GET')) !!}
                            <div class="row">
                                <div class="col-xs-4 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        {!! Form::select('tipo_busqueda', ['' => 'Ver todos',
                                        'usuario' => 'Usuario', 
                                        'cedula' => 'Cédula',
                                        'credencial' => 'Credencial',
                                        'jerarquia' => 'Jerarquía', 
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
                                    <table class="table table-striped mt-2 display dataTable table-hover">
                                        <thead>
                                            <tr role="row">
                                                <th>Usuario</th>
                                                <th>IP</th>
                                                <th>Última Actividad</th>
                                                <th>Acciones</th>
                                        </thead>
                                        <tbody>
                                            @foreach ($sessions as $session)
                                            @if (isset($session->user))
                                                <tr role="row" class="odd">
                                                    <td class="sorting_1">{{$session->user ? $session->user->users : 'Sin Inicio de Sesión'}}</td>
                                                    <td class="sorting_1">{{$session->ip_address}}</td>
                                                    <td class="sorting_1">{{\Carbon\Carbon::createFromTimeStamp($session->last_activity)->diffForhumans()}}</td>
                                                    <td class="sorting_1">
                                                        @can('sessions.destroy')
                                                            {!! Form::open(['method' => 'DELETE', 'route' => ['sessions.destroy', $session->session_id], 'style'=>'display:inline', 'class' => 'eliminar']) !!}
                                                                {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-danger']) !!}
                                                            {!! Form::close() !!}                                                  
                                                        @endcan
                                                    </td>
                                                </tr>
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                <div class="pagination justify-content-end">
                                    {{ $sessions->appends(request()->input())->links() }}
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
    <script src="{{ asset('public/js/sessions/index.js') }}"></script>
@endsection
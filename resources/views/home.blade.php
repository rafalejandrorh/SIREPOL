@extends('layouts.app')
@section('title', 'SIREPOL | Inicio')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>SIREPOL</b></h3>
        </div>
            
        <div id="notification"></div>
        
        <div class="section-body">
            <div class="row">

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center" style="color:#000000"><b>Bienvenido al Sistema de Reseña Policial</b></h3>
                            <div class="col-md-12 col-xl-12">
                                <div class="login-brand">
                                    <center><img src="{{ asset('public/img/pmcr_y_mpprjip.jpeg') }}" alt="logo" width="430" height="220" class="shadow-light"></center>
                                </div>
                                @yield('content')
                                <h5 align="center">{!! $QR !!}</h5>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 col-xl-12">
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h4>Total de Usuarios</h4>
                                            <h2 class="text-left"><span>{{$countUsers}}</span></h2>
                                        </div>
                                    </div>
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h4>Sesiones Activas</h4>
                                            <h2 class="text-left"><span>{{$countSessions}}</span></h2>
                                        </div>
                                    </div>
                                    <div class="card bg-primary order-card">
                                        <div class="card-block">
                                            <h4>Reseñas Hoy</h4>
                                            <h2 class="text-left"><span>{{$countResennasDia}}</span></h2>
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




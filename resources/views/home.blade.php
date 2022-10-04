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
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center" style="color:#000000"><b>Bienvenido al Sistema de Reseña Policial</b></h3>
                            <div class="col-md-6 offset-md-3">
                                <div class="login-brand">
                                    <center><img src="{{ asset('public/img/pmcr_y_mpprjip.jpeg') }}" alt="logo" width="530" height="280" class="shadow-light"></center>
                                </div>
                                @yield('content')
                                <h6 align="center">{!! $QR !!}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


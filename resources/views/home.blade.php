@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>SIREPOL</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="text-center" style="color:#000000"><b>Bienvenido al Sistema de Reseña Policial</b></h3>
                            <div class="col-md-6 offset-md-3">
                                <div class="login-brand">
                                    <img src="{{ asset('img/logo_mpprijp_pmcr.png') }}" alt="logo" width="450" height="250" class="shadow-light">
                                </div>
                                @yield('content')

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


@extends('layouts.app')
@extends('resenna.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Detallado de Reseña</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    </div>
                    <div class="card">
                        <div class="card-body">
   
                            <div class="row">
                                <div class="col-xs-10 col-sm-10 col-md-10">
                                    <a href="{{ url()->previous() }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                                </div>
                            </div>
                            <br>
                        
                            <div class="row">
                                @include('resenna.forms.show')
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('resenna.modals.whatsapp')
    </section>
@endsection

<script src="{{ asset('public/js/maps/index.js')}}"></script>

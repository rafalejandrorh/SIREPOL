@extends('layouts.app')
@extends('resenna.partials.header')
@section('content')
    <section class="section">
        <div class="section-header">
            <h3 class="page__heading"><b>Editar Reseña</b></h3>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">

                        <div class="card-body">

                        @if ($errors->any())                                                
                            <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <strong>¡Revise los campos!</strong>                        
                                @foreach ($errors->all() as $error)                                    
                                    <span class="badge badge-danger">{{ $error }}</span>
                                @endforeach                        
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            </div>
                        @endif

                        <div class="row">
                            <div class="col-xs-10 col-sm-10 col-md-10">
                                <a href="{{ route('resenna.index') }}" class="btn btn-danger"><i class="fa fa-reply"></i> Regresar</a>
                            </div>
                        </div>
                        <br>
                        
                        @include('resenna.forms.edit')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script type="application/javascript">
        const url = "{{ route('georeference.search') }}";
    </script>
    <script src="{{ asset('public/js/resenna/georeferenceRedirecting.js')}}"></script>
@endsection

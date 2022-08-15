@include('layout.sidebar')
@include('layout.header' , array('breadcumbs'=>$arrayBreadcumbs))

@foreach ($person as $persona)
<div class="row justify-content-md-center">
    <div class="col-sm-8">
        <div class="card user-card user-card-1">
            <div class="card-body pb-0">
                {{-- <div class="float-end">
                    <span class="badge badge-success">Pro</span>
                </div> --}}
                <div class="media user-about-block align-items-center mt-0 mb-3">
                    <div class="position-relative d-inline-block">
                        <img class="img-radius img-fluid wid-80"  style="width:150px;height:200px"  src="<?php echo URL::to('/');?>/template/assets/images/logocicpc.jpg" alt="User image">
                        {{-- <div class="certificated-badge">
                            <i class="fas fa-certificate text-primary bg-icon"></i>
                            <i class="fas fa-check front-icon text-white"></i>
                        </div> --}}
                    </div>
                    <div class="media-body ms-3">
                        <h6 class="mb-1">{{$persona->funcionario->person->pnombre}} {{$persona->funcionario->person->papellido}}</h6>
                        <p class="mb-0 text-muted">{{$persona->funcionario->rango->valor}}</p>
                    </div>
                </div>
            </div>
            <ul class="list-group list-group-flush">
                <li class="list-group-item">
                    <span class="f-w-500"><i class="feather icon-credit-card m-r-10"></i>Cedula: </span>
                    <a href="mailto:demo@sample" class="float-end text-body">{{$persona->funcionario->person->cedula}}</a>
                </li>
                <li class="list-group-item">
                    <span class="f-w-500"><i class="feather icon-credit-card m-r-10"></i>Credencial: </span>
                    <a href="#" class="float-end text-body">{{$persona->funcionario->credencial}}</a>
                </li>
                <li class="list-group-item border-bottom-0">
                    <span class="f-w-500"><i class="feather icon-mail m-r-10"></i>Email: </span>
                    <span class="float-end">{{$persona->email}}</span>
                </li>
            </ul>
            <div class="card-footer">
                <div class="text-center">
                    <button type="button" class="btn btn-sm bg-success" data-toggle="modal"
                        data-target="#editar_password{{$persona->id}}"><i class="fas fa-key"></i> Cambiar
                        Contraseña</button>
                    @include('persons.partials.edit.password')


                    <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#editar_email{{$persona->id}}"><i class="fas fa-edit"></i> Actualizar
                        correo</button>
                    @include('persons.partials.edit.email')
                </div>
            </div>
        </div>
    </div>
</div>

@endforeach
@include('layout.footer')
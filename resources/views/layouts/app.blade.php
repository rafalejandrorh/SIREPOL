<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', 'SIREPOL')</title>
    <link rel="icon" href="{{ asset('public/img/logo_pmcr_sin_fondo.png')}}">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- Bootstrap 4.1.1 -->
    <link href="{{ asset('public/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css"/>
    <!-- Ionicons -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet"> --}}
    <link href="{{ asset('public/assets/css/@fortawesome/fontawesome-free/css/all.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="{{ asset('public/assets/css/iziToast.min.css') }}">
    <link href="{{ asset('public/assets/css/sweetalert.css') }}" rel="stylesheet" type="text/css"/>
    <link href="{{ asset('public/assets/js/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet"/>
    <link href="{{ asset('public/assets/css/select2.min.css') }}" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="{{ asset('public/css/jquery-confirm.min.css')}}" type="text/css">


@yield('page_css')
<!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('public/web/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('public/web/css/components.css')}}">
    @yield('page_css')

    @yield('css')
</head>
<body>

<div id="app">
    <div class="main-wrapper main-wrapper-1">
        <div class="navbar-bg"></div>
        <nav class="navbar navbar-expand-lg main-navbar">
            @include('layouts.header')

        </nav>
        <div class="main-sidebar main-sidebar-postion">
            @include('layouts.sidebar')
        </div>
        <!-- Main Content -->
        <div class="main-content">
            @yield('content')
        </div>
        <footer class="main-footer">
            @include('layouts.footer')
        </footer>
    </div>
</div>

</body>
<script>
    window.laravelEchoPort = '{{ env("LARAVEL_ECHO_PORT") }}';
</script>
<script src="//{{request()->getHost() }}:{{ env("LARAVEL_ECHO_PORT") }}/socket.io/socket.io.js"></script>
<script src="{{ asset('public/js/app.js') }}"></script>

<script src="{{ asset('public/assets/js/sweetalert2/sweetalert2.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.min.js') }}"></script>
<script src="{{ asset('public/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('public/assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('public/assets/js/sweetalert.min.js') }}"></script>
<script src="{{ asset('public/assets/js/iziToast.min.js') }}"></script>
<script src="{{ asset('public/assets/js/select2.min.js') }}"></script>
<script src="{{ asset('public/assets/js/jquery.nicescroll.js') }}"></script>

<!-- Template JS File -->
<script src="{{ asset('public/web/js/stisla.js') }}"></script>
<script src="{{ asset('public/web/js/scripts.js') }}"></script>
<script src="{{ mix('assets/js/profile.js') }}"></script>
<script src="{{ mix('assets/js/custom/custom.js') }}"></script>
<script src="{{ asset('public/js/jquery-confirm.min.js')}}"></script>
<script src="{{ asset('public/js/funcionesAjaxs.js')}}"></script>

@include('sweetalert::alert')

@yield('page_js')
@yield('scripts')

<script>
    //const userId = '{{ auth()->id() }}'

    window.Echo.channel('public-notification-channel')
    .listen('.NotificationEvent', (data) => {
        //$("#notification").append('<div class="alert alert-success">' + data.message + '</div>');
        if(data.code == '1')
        {
            Swal.fire({
            position: 'top-end',
            icon: data.icon,
            title: data.message,
            showConfirmButton: false,
            timer: 3000
            })
        }
    });

    // window.Echo.private('notification-channel'+userId)
    // .listen('.NotificationEvent', (data) => {
    //     $("#notification").append('<div class="alert alert-warning">'+data.message+'</div>');
    // });
</script>

<script>
    let loggedInUser =@json(\Illuminate\Support\Facades\Auth::user());
    let loginUrl = '{{ route('login') }}';
    const userUrl = '{{url('users')}}';
    // Loading button plugin (removed from BS4)
    (function ($) {
        $.fn.button = function (action) {
            if (action === 'loading' && this.data('loading-text')) {
                this.data('original-text', this.html()).html(this.data('loading-text')).prop('disabled', true);
            }
            if (action === 'reset' && this.data('original-text')) {
                this.html(this.data('original-text')).prop('disabled', false);
            }
        };
    }(jQuery));

</script>

<script>
    function mayus(e){
        e.value = e.value.toUpperCase();
    }

    function minus(e){
        e.value = e.value.toLowerCase();
    }

    $('.numero').on('input', function () { 
        this.value = this.value.replace(/[^0-9]/g,'');
    });
  
    $('.letras').on('input', function () { 
        this.value = this.value.replace(/[^a-zA-Z ]+$/,'');
    });
  
    $('.mail').blur('input', function (){ 
        if($(".mail").val().indexOf('@', 0) == -1 || $(".mail").val().indexOf('.', 0) == -1) {
            Swal.fire({
            title: 'Atención',
            text: "El correo electrónico introducido no es válido",
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            });
        }
    });

    $(".upload").change(function() {
        var file = this.files[0];
        var typefile = file.type;
        var match= ["image/jpg", "image/jpeg", "image/png"];
        document.getElementById('submit').disabled = false;
        if(!((typefile == match[0] || typefile == match[1] || typefile == match[2] || typefile == null || typefile == ""))){
            Swal.fire({
            title: 'Atención',
            text: "Por favor, ingresa un formato de Imágen válido (jpg, jpeg, png)",
            icon: 'error',
            showCancelButton: false,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            });
            document.getElementById('submit').disabled = true;
            return false;
        }
    });

    var timeout;
    document.onmousemove = function(){ 
        clearTimeout(timeout); 
        contadorSesion(); //aqui cargamos la funcion de inactividad
    } 

    function contadorSesion() {
    timeout = setTimeout(function () {
            $.confirm({
                title: 'Alerta de Inactividad!',
                content: 'La sesión esta a punto de expirar.',
                autoClose: 'expirar|10000',//cuanto tiempo necesitamos para cerrar la sess automaticamente
                type: 'red',
                icon: 'fa fa-spinner fa-spin',
                buttons: {
                    expirar: {
                        text: 'Cerrar Sesión',
                        btnClass: 'btn-red',
                        action: function () {
                            salir();
                        }
                    },
                    permanecer: function () {
                        contadorSesion(); //reinicia el conteo
                        $.alert('La Sesión ha sido reiniciada!'); //mensaje
                    }
                }
            });
        }, 2100000);//2100000 son 35 minutos
    }

    function salir() {
        $("#logout-formactivar").click();
        //onclick="event.preventDefault(); document.getElementById('logout-form').submit();"  
        // window.location.href = "/login"; //esta función te saca
    }
</script>
</html>

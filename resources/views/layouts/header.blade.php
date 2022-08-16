<form class="form-inline mr-auto" action="#">
    <ul class="navbar-nav mr-3">
        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i class="fas fa-bars"></i></a></li>
    </ul>
</form>
<ul class="navbar-nav navbar-right">

    @if(\Illuminate\Support\Facades\Auth::user())
        <li class="dropdown">
            <a href="#" data-toggle="dropdown"
               class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="{{ asset('img/profile.jpg') }}"
                     class="rounded-circle mr-1 thumbnail-rounded user-thumbnail ">
                <div class="d-sm-none d-lg-inline-block">
                    Bienvenido, {{\Illuminate\Support\Facades\Auth::user()->users}}</div>
            </a>

            <div class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item has-icon" href="{{ route('sesion.index') }}"><i class="fa fa-lock"></i>Cambiar Contraseña </a>
                <a href="{{ url('logout') }}" class="dropdown-item has-icon text-danger"
                   onclick="event.preventDefault(); localStorage.clear();  document.getElementById('logout-form').submit();">
                    <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
                </a>
                <form id="logout-form" action="{{ url('/logout') }}" method="POST" class="d-none">
                    {{ csrf_field() }}
                </form>
            </div>
        </li>
    @else
        <li class="dropdown"><a href="#" data-toggle="dropdown"
                                class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                {{--                <img alt="image" src="#" class="rounded-circle mr-1">--}}
                <div class="d-sm-none d-lg-inline-block">{{ __('Sesión Expirada. Por favor, ingrese nuevamente.') }}</div>
            </a>
        </li>
    @endif
</ul>

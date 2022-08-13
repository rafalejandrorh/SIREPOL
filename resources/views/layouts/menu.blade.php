<li class="side-menus {{ Request::is('home') ? 'active' : '' }}">
    <a class="nav-link" href="/home">
        <i class=" fas fa-balance-scale"></i><span>Reseña</span>
    </a>
</li>
<li class="side-menus {{ Request::is('users') ? 'active' : '' }}">
    <a class="nav-link" href="/users">
        <i class=" fas fa-user"></i><span>Usuarios</span>
    </a>
</li>
<li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
    <a class="nav-link" href="/roles">
        <i class=" fas fa-key"></i><span>Roles</span>
    </a>
</li>
<li class="side-menus {{ Request::is('roles') ? 'active' : '' }}">
    <a class="nav-link" href="/">
        <i class=" fas fa-save"></i><span>Trazas</span>
    </a>
</li>


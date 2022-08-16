<li class="side-menus {{ Request::is('resenna') ? 'active' : '' }}">
    <a class="nav-link" href="/resenna">
        <i class=" fas fa-balance-scale"></i><span>Reseñas</span>
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
<li class="side-menus {{ Request::is('trazas') ? 'active' : '' }}">
    <a class="nav-link" href="/trazas">
        <i class=" fas fa-save"></i>
        <span>Trazas</span>
    </a>
</li>


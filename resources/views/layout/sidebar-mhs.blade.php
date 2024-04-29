<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ active_class(['user-pages/profile-mhs']) }}">
            <a class="nav-link" href="{{ url('/user-pages/profile-mhs') }}">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">User Profile</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['tables/project-mhs']) }}">
            <a class="nav-link" href="{{ route ('project-mhs')}}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Data Projek</span>
            </a>
        </li>
    </ul>
</nav>

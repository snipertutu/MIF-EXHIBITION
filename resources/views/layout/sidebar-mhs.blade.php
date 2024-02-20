<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ active_class(['tables/Project']) }}">
            <a class="nav-link" href="{{ url('/tables/Project') }}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Data Projek</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['user-pages/profile']) }}">
            <a class="nav-link" href="{{ url('/user-pages/profile') }}">
                <i class="menu-icon mdi mdi-account"></i>
                <span class="menu-title">User Profile</span>
            </a>
        </li>
    </ul>
</nav>

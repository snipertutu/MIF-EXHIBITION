<nav class="sidebar sidebar-offcanvas dynamic-active-class-disabled" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{ active_class(['adm']) }}">
            <a class="nav-link" href="{{ route ('dashboard')}}">
                <i class="menu-icon mdi mdi-television"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['tables/project']) }}">
            <a class="nav-link" href="{{ route ('project.index')}}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Data Projek</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['tables/mahasiswa']) }}">
            <a class="nav-link" href="{{ route ('mahasiswa.index')}}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Data Mahasiswa</span>
            </a>
        </li>
        <li class="nav-item {{ active_class(['homepage']) }}">
            <a class="nav-link" href="{{ route ('homepage.index')}}">
                <i class="menu-icon mdi mdi-table-large"></i>
                <span class="menu-title">Homepage</span>
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

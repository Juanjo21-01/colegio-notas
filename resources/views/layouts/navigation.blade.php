<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="sidebarNav">
    <!-- Logo -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('dashboard') }}">
        <img src="/img/logo.png" alt="Fondo de la página" class="img-fluid pt-3" />
    </a>

    <hr class="sidebar-divider mt-3">

    <!-- Panel de control -->
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-0" href="{{ route('dashboard') }}">
            <i class="bi bi-house-fill"></i>
            <span>Inicio</span>
        </a>
    </li>

    <hr class="sidebar-divider">

    <!-- Usuarios -->
    <div class="sidebar-heading pb-1">
        Usuarios
    </div>
    <li class="nav-item {{ request()->routeIs('roles.index') ? 'active' : '' }}">
        <a class="nav-link pt-2" href="{{ route('roles.index') }}">
            <i class="bi bi-person-circle"></i>
            <span>Roles</span>
        </a>
    </li>
    <li class="nav-item {{ request()->routeIs('usuarios.index') ? 'active' : '' }}">
        <a class="nav-link pt-2" data-bs-toggle="collapse" href="#collapseUsuarios" aria-expanded="true"
            aria-controls="collapseUsuarios">
            <i class="bi bi-people-fill"></i>
            <span>Usuarios</span>
        </a>
        <div id="collapseUsuarios" class="collapse" data-parent="#sidebarNav">
            <div class="card card-body py-2 collapse-inner rounded">
                <h6 class="collapse-header">Según rol:</h6>
                <a class="collapse-item border-bottom-primary mb-1"
                    href="{{ route('usuarios.index', ['rol' => 'administrador']) }}">Administrador</a>
                <a class="collapse-item border-bottom-primary mb-1"
                    href="{{ route('usuarios.index', ['rol' => 'secretaria']) }}">Secretaria</a>
                <a class="collapse-item border-bottom-primary"
                    href="{{ route('usuarios.index', ['rol' => 'profesor']) }}">Profesor</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider">

    <!-- Grados -->
    <div class="sidebar-heading">
        Grados
    </div>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-2" data-bs-toggle="collapse" href="#collapseCursos" aria-expanded="true"
            aria-controls="collapseCursos">
            <i class="bi bi-file-ruled"></i>
            <span>Cursos</span>
        </a>
        <div id="collapseCursos" class="collapse" data-parent="#sidebarNav">
            <div class="card card-body py-2 collapse-inner rounded">
                <h6 class="collapse-header">Por grado:</h6>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Primero</a>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Segundo</a>
                <a class="collapse-item border-bottom-primary" href="{{ route('dashboard') }}">Tercero</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-2" data-bs-toggle="collapse" href="#collapseEstudiantes" aria-expanded="true"
            aria-controls="collapseEstudiantes">
            <i class="bi bi-person-square"></i>
            <span>Estudiantes</span>
        </a>
        <div id="collapseEstudiantes" class="collapse" data-parent="#sidebarNav">
            <div class="card card-body py-2 collapse-inner rounded">
                <h6 class="collapse-header">Por grado:</h6>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Primero</a>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Segundo</a>
                <a class="collapse-item border-bottom-primary" href="{{ route('dashboard') }}">Tercero</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Calificaciones -->
    <div class="sidebar-heading">
        Calificaciones
    </div>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-2" data-bs-toggle="collapse" href="#collapseCalificacionG" aria-expanded="true"
            aria-controls="collapseCalificacionG">
            <i class="bi bi-building"></i>
            <span>Grados</span>
        </a>
        <div id="collapseCalificacionG" class="collapse" data-parent="#sidebarNav">
            <div class="card card-body py-2 collapse-inner rounded">
                <h6 class="collapse-header">Por grado:</h6>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Primero</a>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Segundo</a>
                <a class="collapse-item border-bottom-primary" href="{{ route('dashboard') }}">Tercero</a>
            </div>
        </div>
    </li>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-2" data-bs-toggle="collapse" href="#collapseCalificacionE" aria-expanded="true"
            aria-controls="collapseCalificacionE">
            <i class="bi bi-person-lines-fill"></i>
            <span>Estudiantes</span>
        </a>
        <div id="collapseCalificacionE" class="collapse" data-parent="#sidebarNav">
            <div class="card card-body py-2 collapse-inner rounded">
                <h6 class="collapse-header">Por grado:</h6>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Primero</a>
                <a class="collapse-item border-bottom-primary mb-1" href="{{ route('dashboard') }}">Segundo</a>
                <a class="collapse-item border-bottom-primary" href="{{ route('dashboard') }}">Tercero</a>
            </div>
        </div>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    <!-- Reportes -->
    <div class="sidebar-heading">
        Reportes
    </div>
    <li class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
        <a class="nav-link pt-2" href="{{ route('dashboard') }}">
            <i class="bi bi-bar-chart-fill"></i>
            <span>Reporte</span>
        </a>
    </li>

    <hr class="sidebar-divider d-none d-md-block">

    {{-- <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0">
            <i class="bi bi-app"></i>
        </button>
    </div> --}}
</ul>

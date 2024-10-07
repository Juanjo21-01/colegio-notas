<nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
    <!-- Sidebar Toggle (Topbar) -->
    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
        <i class="bi bi-list"></i>
    </button>

    @isset($header)
        <header class="d-flex justify-content-center align-content-center">
            <nav aria-label="breadcrumb">
                {{ $header }}
            </nav>

        </header>
    @endisset

    <!-- Topbar Navbar -->
    <ul class="navbar-nav ml-auto">
        <div class="topbar-divider d-none d-sm-block"></div>

        <li class="dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="user" data-bs-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600">{{ Auth::user()->nombres }}</span>
            </a>

            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in mt-3" aria-labelledby="user">
                <a class="dropdown-item" href="{{ route('profile.edit') }}">
                    <i class="bi bi-person-fill-gear"></i> Perfil</a>

                <div class="dropdown-divider"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <a href="route('logout')" class="dropdown-item text-danger"
                        onclick="event.preventDefault();
                                                this.closest('form').submit();">
                        <i class="bi bi-arrow-left-circle-fill"></i></i> Cerrar Sesión
                    </a>
                </form>
            </div>
        </li>
    </ul>
</nav>

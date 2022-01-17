<!-- menu -->
<header class="fixed-top py-3 bgVerde4">
    <div class="container-lg">
        <nav class="navbar">
            <div class="container-fluid">
                <a id="marca" class="navbar-brand linkB" href="{{ url('/hub') }}">
                    Sport Team
                </a>
                <div class="row">
                    <div class="col-1">
                        <img class="w-100" src="{{ url('/img/iconos/jugadorMenuDeseleccionado.png') }}" alt="">
                    </div>
                </div>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon">
                        {{-- meter imagen del equipo logueado --}}
                        <img src="{{ ulr() }}" class="w-100">
                    </span>
                </button>
            </div>
        </nav>
        <div class="collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav ms-auto">

                <li id="miClub" class="nav-item logueado generico">
                    <a class="nav-link linkB p-0" href="{{ url('/mi-club') }}">Mi club</a>
                </li>

                <li id="contornoBlanco" class="nav-item logueado generico">
                    <a class="nav-link linkB p-0" href="{{ url('/cerrar-sesion') }}">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</header>

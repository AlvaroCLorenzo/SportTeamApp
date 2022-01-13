<!-- menu -->
<header class="fixed-top py-3 bgVerde4">
    <div class="container-lg">
        <nav class="navbar">
            <div class="container-fluid">
                <a id="marca" class="navbar-brand linkB" href="{{ url('/hub') }}">
                    Sport Team
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarNav" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span id="iconoMenu" class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav ms-auto">

                <li id="miClub" class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="{{ url('/mi-club') }}">Mi club</a>
                </li>

                <li id="contornoBlanco" class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="{{ url('/cerrar-sesion') }}">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</header>

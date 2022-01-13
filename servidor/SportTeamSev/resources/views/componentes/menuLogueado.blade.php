<!-- menu -->
<header class="fixed-top py-3 bgVerde4">
    <div class="container-lg">
        <nav class="navbar">
            <div class="container-fluid">
                <a id="marca" class="navbar-brand linkB" href="{{ url('/') }}">
                    Sport Team
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarToggleExternalContent" aria-controls="navbarNav"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span id="iconoMenu" class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="collapse" id="navbarToggleExternalContent">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="#">Mi club</a>
                </li>
                
                <li class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="#">Partidos</a>
                </li>
                
                <li class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="#">Entrenamientos</a>
                </li>
                
                <li class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="#">Jugadores</a>
                </li>
                
                <li id="contornoBlanco" class="nav-item logueado">
                    <a class="nav-link linkB p-0" href="#">Cerrar sesión</a>
                </li>
            </ul>
        </div>
    </div>
</header>

<!-- menu -->
<header class="py-3 fixed-top bgVerde4">
    <div class="container-lg">
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
                <a id="marca" class="navbar-brand linkB" href="{{ url('/') }}">
                    Sport Team
                </a>

                @if ($btnDesplegable)
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span id="iconoMenu" class="navbar-toggler-icon"></span>
                    </button>
                @endif
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        @if ($btnRegistro)
                        <li id="contornoBlanco" class="nav-item generico">
                            <a class="nav-link linkB p-0" href="{{ url('/registro') }}">Regístrate</a>
                        </li>
                        @endif

                        @if ($btnLogin)
                            <li class="nav-item generico">
                                <a class="nav-link linkB p-0" href="{{ url('/login') }}">Login</a>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

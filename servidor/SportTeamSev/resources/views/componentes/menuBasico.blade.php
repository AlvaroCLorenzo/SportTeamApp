<!-- menu -->
<header class="py-3 fixed-top bgVerde4">
    <div class="container-lg">
        <nav class="navbar navbar-expand-sm">
            <div class="container-fluid">
                <a id="marca" class="navbar-brand linkB" href="{{ url('/') }}">
                    Sport Team
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto">

                        @if ($btnRegistro)
                            <a class="linkB" href="registro">
                                <li id="registrate" class="nav-item">Regístrate</li>
                            </a>
                        @endif

                        @if ($btnLogin)
                            <a class="linkB" href="login">
                                <li class="nav-item">Login</li>
                            </a>
                        @endif
                    </ul>
                </div>
            </div>
        </nav>
    </div>
</header>

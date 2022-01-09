<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap link --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    {{-- CSS LINKS --}}
    {{-- generales --}}
    <link rel="stylesheet" href="../resources/css/comunes/basico.css">
    <link rel="stylesheet" href="../resources/css/comunes/menuBasico.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/fondos.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/textos.css">
    <link rel="stylesheet" href="../resources/css/comunes/colores/textosLinks.css">
    {{-- propios --}}
    <link rel="stylesheet" href="../resources/css/index/section.css">
    <link rel="stylesheet" href="../resources/css/index/botonPlaystore.css">
    <title>SportTeam</title>
</head>

<body>
    <!-- menu -->
    <header class="py-3 fixed-top bgVerde4">
        <div class="container-lg">
            <nav class="navbar navbar-expand-sm">
                <div class="container-fluid">
                    <a id="marca" class="navbar-brand linkB" href="#">
                        Sport Team
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav ms-auto">
                            <li id="registrate" class="nav-item"><a class="linkB" href="#">Regístrate</a>
                            </li>
                            <li class="nav-item"><a class="linkBV" href="#">Login</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>

    <section class="h-100 w-100 mx-auto row align-items-center">
        <div class="container-fluid my-auto textoBlanco">
            <div class="text-center">
                <h1>Sport Team</h1>
            </div>
            <div class="container w-25 px-auto">
                <a class="linkB" href="#">
                    <button id="playstore" class="row align-items-center textoBlanco bgVerde2">
                        <div class="col-lg-4 py-2">
                            <img class="w-50 mx-auto" src="../resources/img/iconos/playstoreIcon.png"
                                alt="Logo PlayStore">
                        </div>
                        <div class="col-lg-8 d-none d-lg-block">
                            <p>Descargar app</p>
                        </div>
                    </button>
                </a>
            </div>
        </div>
    </section>

</body>

</html>

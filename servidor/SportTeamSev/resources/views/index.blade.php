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
    <div>@include('componentes/menuBasico')</div>

    <section class="w-100 mx-auto row align-items-center">
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

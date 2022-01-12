<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('componentes/head/headConstantes')

    {{-- propios --}}
    <link rel="stylesheet" href="css/index/section.css">
    <link rel="stylesheet" href="css/index/botonPlaystore.css">

    <title>Sport Team</title>
</head>

<body>
    @include('componentes/menuDeslogueado', ['btnDesplegable' => true, 'btnRegistro' => true, 'btnLogin' => true])

    <section class="w-100 mx-auto row align-items-center">
        <div class="container-fluid my-auto textoBlanco">
            <div class="text-center">
                <h1>Sport Team</h1>
            </div>
            <div class="container w-25 px-auto">
                <a class="linkB" href="#">
                    <button id="playstore" class="row align-items-center textoBlanco bgVerde2">
                        <div class="col-lg-4 py-2">
                            <img class="w-50 mx-auto" src="{{ url('/img/iconos/playstoreIcon.png') }}"
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

    <script src={{ asset('js/app.js')}}></script>
</body>

</html>

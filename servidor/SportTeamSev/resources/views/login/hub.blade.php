<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>false])

    <link rel="stylesheet" href="css/hub/botonesSecciones.css">

    <title>HUB - Sport Team</title>
</head>

<body>
    @include('componentes/menuLogueado')

    {{-- le pongo padding 0 para quitar el padding el de que pongo en el css de basico --}}
    <section class="px-0 pb-0">
        <div class="mx-0 px-0 row align-items-center">
            <div id="partidos" class="col-lg px-0 text-center seccion">
                <a href="{{ url('/partidos') }}">
                    <h1 class="my-auto centrarTexto textoBlanco">Partidos</h1>
                </a>
            </div>
            <div id="entrenamientos" class="col-lg px-0 text-center seccion">
                <a href="{{ url('/entrenamientos') }}">
                    <h1 class="my-auto centrarTexto textoBlanco">Entrenamientos</h1>
                </a>
            </div>
            <div id="jugadores" class="col-lg px-0 text-center seccion">
                <a href="{{ url('/jugadores') }}">
                    <h1 class="my-auto centrarTexto textoBlanco">Jugadores</h1>
                </a>
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

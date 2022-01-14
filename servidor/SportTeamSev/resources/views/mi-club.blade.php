<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes')

    <title>Mi club - Sport Team</title>
</head>

<body>
    @include('componentes/menuLogueado')
    @include('componentes/menuSecciones', ['partidos' => false,'entrenamientos' => false,'jugadores' => false])

    <section class="bgVerde1">

    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>
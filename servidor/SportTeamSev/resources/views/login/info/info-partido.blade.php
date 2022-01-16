<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    <title>Partidos - Sport Team</title>
</head>
<body>
    @include('componentes/menus/menuLogueado')
    
    <section class="bgVerde1">

    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    <link rel="stylesheet" href="css/comunes/formularios.css">
    
    <title>Información jugador - Sport Team</title>
</head>
<body>
    @include('componentes/menus/menuLogueado')
    
    <section class="bgVerde1 login">
        <div class="container-lg">
            {{-- Resumen --}}
            <div class="row mx-auto p-0">
                @include('componentes/informacion/jugador')
            </div>


            {{-- Observación --}}
            @include('componentes/informacion/observacion')
        </div>
    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>
</html>
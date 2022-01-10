<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- bootstrap link --}}
    <link href={{asset('css/app.css')}} rel="stylesheet">

    {{-- CSS LINKS --}}
    {{-- generales --}}
    <link rel="stylesheet" href="css/comunes/basico.css">
    <link rel="stylesheet" href="css/comunes/menuBasico.css">
    <link rel="stylesheet" href="css/comunes/botones.css">
    <link rel="stylesheet" href="css/comunes/colores/fondos.css">
    <link rel="stylesheet" href="css/comunes/colores/textos.css">
    <link rel="stylesheet" href="css/comunes/colores/textosLinks.css">
    <link rel="stylesheet" href="css/comunes/colores/formularios.css">
    <title>SportTeam</title>
</head>

<body>
    @include('componentes/menuBasico', ['btnRegistro' => true, 'btnLogin' => false])

    <section class="w-100 mx-auto row align-items-center bgVerde1">
        <div class="container-fluid my-auto textoBlanco ">
            <div class="container-sm contenedor formulario bgBlanco">
                <h1 class="textoVerde3 centrado">Login</h1>
                <form action="">
                    <div class="grupo">
                        <input class="textoVerde1" type="text" required>
                        <label class="textoVerde1 textfield" for="">Club</label>
                    </div>
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Contraseña</label>
                    </div>
                    <div class="centrado">
                        <button class="submit">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <div>@include('componentes/footer')</div>
    <script src={{ asset('js/app.js')}}></script>
</body>
</html>

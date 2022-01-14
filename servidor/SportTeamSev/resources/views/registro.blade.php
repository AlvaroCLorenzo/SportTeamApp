<!doctype html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    @include('componentes/head/headConstantes')
    /cssLinks')
    
    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Regístrate - Sport Team</title>
</head>

<body>
    @include('componentes/menuDeslogueado', ['btnDesplegable' => true, 'btnRegistro' => false, 'btnLogin' => true])

    <section class="w-100 mx-auto row align-items-center bgVerde1">
        <div class="container-fluid my-auto textoBlanco ">
            <div class="container-sm contenedor formulario bgBlanco">
                <h1 class="textoVerde3 centrado">Regístrate</h1>
                <form action="">
                    <div class="grupo">
                        <input class="textoVerde1" type="text" required>
                        <label class="textoVerde1 textfield" for="">Nombre club</label>
                    </div>
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Contraseña</label>
                    </div>
                    <div class="grupo">
                        <input class="textoVerde1" type="password" required>
                        <label class="textoVerde1 textfield" for="">Repite la contraseña</label>
                    </div>

                    <div class="grupo">
                        <label class="textoVerde1" for="">Deporte</label>
                        <select class="textoVerde1" name="deportes" id="deportes">
                            <option value="baloncesto">Baloncesto</option>
                            <option value="futbol">Fútbol</option>
                            <option value="tenis">Tenis</option>
                        </select>
                    </div>

                    <div class="grupo">
                        <label class="textoVerde1" for="">Categoría</label>
                        <select class="textoVerde1" name="categorias" id="categorias">
                            <option value="baloncesto">1ª División</option>
                            <option value="futbol">2ª División</option>
                            <option value="tenis">3ª División</option>
                        </select>
                    </div>
                    <div class="centrado">
                        <button class="submit botonVerde">Regístrate</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js')}}></script>
</body>

</html>

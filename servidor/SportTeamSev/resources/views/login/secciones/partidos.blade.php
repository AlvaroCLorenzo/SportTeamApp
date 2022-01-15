<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true,
    'nombrePaginaActivo'=>'Partidos'])

    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">
    <link rel="stylesheet" href="css/secciones/partidos/partidos.css">

    <title>Partidos - Sport Team</title>
</head>

<body>
    @include('componentes/menuLogueado')

    <section class="bgVerde1 login">
        <div class="container-lg mx-auto p-0 row">
            {{-- formulario --}}
            <div class="col-lg-5 my-3">
                <div class="container-sm contenedor formulario bgBlanco">
                    <h1 class="textoVerde3 centrado">Crear partido</h1>
                    <form action="">
                        <div class="grupo">
                            <label class="textoVerde1" for="">Local</label>
                            <select class="textoVerde1" name="deportes" id="local">
                                {{-- casos de ejemplo --}}
                                <option value="baloncesto">Real Madrid</option>
                                <option value="futbol">Fútbol Club Barcelona</option>
                                <option value="tenis">Chamberi FC</option>
                                <option value="tenis">Sevilla</option>
                                <option value="tenis">Rayo vallecano</option>
                                <option value="tenis">Real Madrid</option>
                            </select>
                        </div>

                        <div class="grupo">
                            <label class="textoVerde1" for="">Visitante</label>
                            <select class="textoVerde1" name="deportes" id="visitante">
                                {{-- casos de ejemplo --}}
                                <option value="baloncesto">Real Madrid</option>
                                <option value="futbol">Fútbol Club Barcelona</option>
                                <option value="tenis">Chamberi FC</option>
                                <option value="tenis">Sevilla</option>
                                <option value="tenis">Rayo vallecano</option>
                                <option value="tenis">Real Madrid</option>
                            </select>
                        </div>

                        <div class="grupo">
                            <label class="textoVerde1" for="">Competición</label>
                            <select class="textoVerde1" name="categorias" id="competicion">
                                <option value="baloncesto">1ª Categoría</option>
                                <option value="futbol">2ª Categoría</option>
                                <option value="tenis">3ª Categoría</option>
                            </select>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="date" required>
                            <label class="textoVerde1 textfield" for="">Fecha del entrenamiento</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="text" required>
                            <label class="textoVerde1 textfield" for="">Hora</label>
                        </div>

                        <div class="centrado">
                            <button class="submit botonVerde">Crear</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Partidos --}}
            <div class="col-lg-7 my-3">
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
                @include('componentes/partidosLayout')
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

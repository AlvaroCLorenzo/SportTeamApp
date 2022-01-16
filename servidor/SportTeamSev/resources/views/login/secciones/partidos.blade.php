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
    @include('componentes/menus/menuLogueado')

    <section class="bgVerde1 login">
        <div class="container-lg mx-auto p-0 row">
            {{-- formulario --}}
            <div class="col-lg-5 my-3">
                <div class="container-sm contenedor formulario bgBlanco">
                    <h1 class="textoVerde3 centrado">Crear partido</h1>
                    <form action="">
                        <div class="row grupo">
                            <div class="col-4 p-0">
                                <label class="textoVerde1" for="">Local</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="equipoLocal" id="local">
                                    {{-- casos de ejemplo --}}
                                    <option value="Real Madrid">Real Madrid</option>
                                    <option value="Fútbol Club Barcelona">Fútbol Club Barcelona</option>
                                    <option value="Chamberi FC">Chamberi FC</option>
                                    <option value="Sevilla">Sevilla</option>
                                    <option value="Rayo Vallecano">Rayo Vallecano</option>
                                </select>
                            </div>
                        </div>

                        <div class="row grupo">
                            <div class="col-4 p-0">
                                <label class="textoVerde1" for="">Visitante</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="equipoVisitante" id="visitante">
                                    {{-- casos de ejemplo --}}
                                    <option value="Real Madrid">Real Madrid</option>
                                    <option value="Fútbol Club Barcelona">Fútbol Club Barcelona</option>
                                    <option value="Chamberi FC">Chamberi FC</option>
                                    <option value="Sevilla">Sevilla</option>
                                    <option value="Rayo Vallecano">Rayo Vallecano</option>
                                </select>
                            </div>
                        </div>

                        <div class="row grupo">
                            <div class="col-4 p-0">
                            <label class="textoVerde1" for="">Competición</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="copeticion" id="competicion">
                                    <option value="1ª Categoría">1ª Categoría</option>
                                    <option value="2ª Categoría">2ª Categoría</option>
                                    <option value="3ª Categoría">3ª Categoría</option>
                                </select>
                            </div>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="date" required>
                            <label class="textoVerde1 textfield" for="">Fecha del entrenamiento</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="time" required>
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
                @include('componentes/layoutsSecciones/partidosLayout',['botonInformacion'=>true])
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

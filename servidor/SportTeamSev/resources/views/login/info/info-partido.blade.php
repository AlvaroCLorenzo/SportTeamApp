<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    <link rel="stylesheet" href="css/secciones/partidos/partidos.css">
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Partidos - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuLogueado')
    @include('componentes/menus/menuLogueado')

    <section class="bgVerde1 login">
        <div class="container-lg">
            {{-- Resumen --}}
            <div class="row mx-auto p-0">
                @include('componentes/layoutsSecciones/partidosLayout',['botonInformacion'=>false])
            </div>

            {{-- Observación --}}
            <div class="row mx-auto p-0 textoVerde1">
                <div class="contenedor bgBlanco">
                    <div class="row">
                        <h2>Observaciones</h2>
                    </div>

                    <div class="row">
                        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati repellat dicta ipsum
                            tenetur iusto quo! Veritatis enim delectus ex, vel rem ut quis, totam id dolorum autem dicta
                            neque accusamus?</p>
                    </div>

                    <div class="text-end">
                        <button class="botonVerde">Guardar</button>
                    </div>
                </div>
            </div>

            {{-- Convocar --}}
            <div class="row mx-auto p-0">
                <div class="row align-items-center mx-auto contenedor bgVerde5">
                    <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                        <select class="textoVerde1 m-0" name="deportes" id="local">
                            {{-- casos de ejemplo --}}
                            <option value="baloncesto">Real Madrid</option>
                            <option value="futbol">Fútbol Club Barcelona</option>
                            <option value="tenis">Chamberi FC</option>
                            <option value="tenis">Sevilla</option>
                            <option value="tenis">Rayo vallecano</option>
                            <option value="tenis">Real Madrid</option>
                        </select>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                        <button class="botonVerde">Convocar</button>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                        <button class="botonVerde">Desconvocar</button>
                    </div>
                    <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                        <button class="botonVerde">Convocar todos</button>
                    </div>
                </div>
            </div>

            {{-- Convocatoria --}}
            <div class="row mx-auto p-0 textoVerde1">
                <div class="row mx-auto contenedor bgBlanco">
                    <div class="row">
                        <h2>Convocatoria</h2>
                    </div>
                    <div class="row">
                        <div class="col-6">Adrián Fraile Martín</div>
                        <div class="col-3">
                            <input class="w-25 mx-0 float-left" type="checkbox" name="asistido" value="true">
                            <label>Asisitdo</label>
                        </div>
                        <div class="w-25 m-0" class="col-3">
                            <input type="checkbox" name="justificado" value="true">
                            <label>Justificado</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true, 'nombrePaginaActivo'=>'Entrenamientos'])

    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Entrenamientos - Sport Team</title>
</head>
<body>
    @include('componentes/menus/menuLogueado')
    
    <section class="bgVerde1 login">
        <div class="container-lg mx-auto p-0 row">
            <div class="col-lg-5 my-3">
                <div class="container-sm contenedor formulario bgBlanco">
                    <h1 class="textoVerde3 centrado">Crear entrenamiento</h1>
                    <form action="">
                        <div class="grupo">
                            <input class="textoVerde1" type="text" required>
                            <label class="textoVerde1 textfield" for="">Duración</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="text" required>
                            <label class="textoVerde1 textfield" for="">Fecha</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="text" required>
                            <label class="textoVerde1 textfield" for="">Hora</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="text" required>
                            <label class="textoVerde1 textfield" for="">Lugar</label>
                        </div>

                        <div class="centrado">
                            <button class="submit botonVerde">Crear</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Entrenamientos --}}
            <div class="col-lg-7 my-3">
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
                @include('componentes/layoutsSecciones/entrenamientosLayout', ['botonInformacion'=>true])
            </div>
        </div>
    </section>
    
    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>
</html>
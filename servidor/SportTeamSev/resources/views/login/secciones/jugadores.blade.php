<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true,
    'nombrePaginaActivo'=>'Jugadores'])

    {{-- propios --}}
    <link rel="stylesheet" href="css/comunes/formularios.css">

    <title>Partidos - Sport Team</title>
</head>

<body>
    @include('componentes/menus/menuLogueado')

    <section class="bgVerde1 login">
        <div class="container-lg mx-auto p-0 row">
            <div class="col-lg-5 my-3">
                <div class="container-sm contenedor formulario bgBlanco">
                    <h1 class="textoVerde3 centrado">Agregar jugador</h1>
                    <form action="{{url('/crearJugador')}}" method="post">
                        <div class="grupo">
                            <input class="textoVerde1" type="text" name="nombre" required>
                            <label class="textoVerde1 textfield" for="">Nombre</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="text" name="apellidos" required>
                            <label class="textoVerde1 textfield" for="">Apellidos</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" name="fechaNacimiento" type="date" placeholder="" onfocus="(this.type='date')"
                                required>
                            <label class="textoVerde1 textfield inputFecha" for="">Fecha nacimiento</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="number" name="telefono" required>
                            <label class="textoVerde1 textfield" for="">Teléfono</label>
                        </div>

                        <div class="centrado">
                            <button class="submit botonVerde">Crear</button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- Jugadores --}}

            <div class="col-lg-7 my-3">
                @foreach($jugadores as $jugador)
                        @include('componentes/layoutsSecciones/jugadoresLayout', [
                            'jugador' => $jugador,
                            'botonInformacion'=>true
                            ])
                    
                @endforeach

            </div>

        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

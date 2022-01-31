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
    @include('componentes/menus/menuLogueado',[
        'imagen' => $imagen
    ])

    <section class="bgVerde1 login">
        <div class="container-lg mx-auto p-0 row">
            {{-- formulario --}}
            <div class="col-lg-5 my-3">
                <div class="container-sm contenedor formulario bgBlanco">
                    <h1 class="textoVerde3 centrado">Crear partido</h1>
                    <form action="{{url('/crearPartido')}}"  method="post">
                        <div class="row grupo">
                            <div class="col-4 p-0">
                                <label class="textoVerde1" for="">Local</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="equipoLocal" id="local">
                                    @foreach($clubes as $club)
                                        <option value="{{$club->nombre}}">{{$club->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row grupo">
                            <div class="col-4 p-0">
                                <label class="textoVerde1" for="">Visitante</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="equipoVisitante" id="visitante">
                                    @foreach($clubes as $club)
                                        <option value="{{$club->nombre}}">{{$club->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row grupo">
                            <div class="col-4 p-0">
                            <label class="textoVerde1" for="">Competición</label>
                            </div>
                            <div class="col-8 p-0">
                                <select class="m-0 textoVerde1" name="copeticion" id="competicion">

                                    @foreach($competiciones as $competicion)
                                        <option value="{{$competicion->nombreCompeticion}}">{{$competicion->nombreCompeticion}}</option>
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="date" name="fecha" required>
                            <label class="textoVerde1 textfield" for="">Fecha del entrenamiento</label>
                        </div>

                        <div class="grupo">
                            <input class="textoVerde1" type="time" name="hora" required>
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

                @foreach ($partidos as $partido)
                    
                    @include('componentes/layoutsSecciones/partidosLayout',[
                        'partido'=>$partido,
                        'botonInformacion'=>true
                        ])

                    {{-- Fila contenedor verde --}}
                    <div class="my-5 bgVerde5 separador"></div>

                @endforeach


            </div>
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

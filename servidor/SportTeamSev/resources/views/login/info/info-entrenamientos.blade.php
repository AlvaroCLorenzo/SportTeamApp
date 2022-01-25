<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @include('componentes/head/headConstantes', ['logueado'=>true, 'mostrarMenuSecciones'=>true])

    
    <link rel="stylesheet" href="css/comunes/formularios.css">
    <title>Información entrenamiento - Sport Team</title>
</head>

<body>

    @include('componentes/menus/menuLogueado',[
        'imagen' => $imagen
    ])

    <section class="bgVerde1 login">
        <div class="container-lg">
            {{-- Resumen --}}
            <div class="row mx-auto p-0">
                @include('componentes/layoutsSecciones/entrenamientosLayout',['botonInformacion'=>false])
            </div>


            {{-- Observación --}}
            @include('componentes/informacion/observacion',[
                'observacion' => $entrenamiento->observacion,
                'accion' => url('/actualizarObservacionEntrenamiento'),
                'idToken' => $entrenamiento->id
            ])


            
            {{-- Convocar --}}
            @include('componentes/informacion/convocar',[
                'jugadores' => $jugadores,
                'accion' => url('/actualizarConvocarEntrenamiento'),
                'idToken' => $entrenamiento->id
            ])

            
            @include('componentes/informacion/convocatoria',[
                'convocatorias' => $convocatorias,
                'accion' => url('/actualizarAsistenciaEntrenamiento'),
                'idToken' => $entrenamiento->id
            ])
            
            
        </div>
    </section>

    @include('componentes/footer')
    <script src={{ asset('js/app.js') }}></script>
</body>

</html>

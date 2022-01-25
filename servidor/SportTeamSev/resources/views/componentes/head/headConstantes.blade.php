<link rel="shortcut icon" href="img/iconos/logo.png">

{{-- bootstrap link --}}
<link href={{ asset('css/app.css') }} rel="stylesheet">

{{-- CSS LINKS --}}
<link rel="stylesheet" href="css/comunes/basico.css">
<link rel="stylesheet" href="css/comunes/botones.css">
<link rel="stylesheet" href="css/comunes/menuPrincipal.css">
<link rel="stylesheet" href="css/comunes/colores/fondos.css">
<link rel="stylesheet" href="css/comunes/colores/textos.css">
<link rel="stylesheet" href="css/comunes/colores/textosLinks.css">

@if (isset($logueado))
    <script type="text/javascript">
        //variables para poder pasar el link de cada una de las secciones
        var urlPartido = '{{ url('/partidos') }}';
        var urlEntrenamientos = '{{ url('/entrenamientos') }}';
        var urlJugadores = '{{ url('/jugadores') }}';

        @if (isset($mostrarMenuSecciones))
        //variable para decir si mostrar el menu o no
        var menuSeccionesActivo = @if ($mostrarMenuSecciones) {{ 'true' }} @else {{ 'false' }} @endif;
        @endif

        //Variable que me dirá que link debe tener la clase css linkActual para poder marcar en el menu que pestaña esta activa
        @if (isset($nombrePaginaActivo))
            var paginaActiva = "{{ $nombrePaginaActivo }}";
        @else
            var paginaActiva = null;
        @endif
    </script>

    <script src={{ asset('js/controlMenuLogueado.js') }}></script>
@endif

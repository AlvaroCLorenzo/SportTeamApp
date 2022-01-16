<div id="menuSecciones">
    <nav>
        <ul class="row p-0 my-0 mx-0 align-items-center">
            <li class="nav-item col-4 mx-0 secciones @if ($partidos) linkActual @endif">
                <a class="nav-link py-4 @if ($partidos) linkActual @endif" href="{{ url('/partidos') }}">Partidos</a>
            </li>
            <li class="nav-item col-4 mx-0 secciones @if ($entrenamientos) linkActual @endif">
                <a class="nav-link py-4 @if ($entrenamientos) linkActual @endif"
                    href="{{ url('/entrenamientos') }}">Entrenamientos</a>
            </li>
            <li class="nav-item col-4 mx-0 secciones @if ($entrenamientos) linkActual @endif">
                <a class="nav-link py-4 @if ($jugadores) linkActual @endif" href="{{ url('/jugadores') }}">Jugadores</a>
            </li>
        </ul>
    </nav>
</div>

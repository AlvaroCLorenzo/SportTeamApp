<div class="container-sm textoBlanco mb-5">
    {{-- Fila nombre equipos --}}
    <div class="row align-items-center mb-4">
        <div class="col-6">
            <h3>Local</h3>
        </div>
        <div class="col-6 text-end">
            <h3>Visitante</h3>
        </div>
    </div>

    {{-- Fila resultado y fotos --}}
    <div class="row align-items-center mb-4">
        <div class="col-3">
            <img class="w-100 mx-auto" src="{{ url('/img/iconos/clubIcon.png') }}" alt="">
        </div>
        <div class="col-2 puntuación px-2 text-center">
            <p class="w-50 mx-auto my-0 puntuacion texto bgVerde5">0</p>
        </div>
        <div class="col-2">
            <img class="w-100 mx-auto" src="{{ url('/img/iconos/vsIcon.png') }}" alt="">
        </div>
        <div class="col-2 puntuación px-2 text-center">
            <p class="w-50 mx-auto my-0 puntuacion texto bgVerde5">0</p>
        </div>
        <div class="col-3">
            <img class="w-100 mx-auto" src="{{ url('/img/iconos/clubIcon.png') }}" alt="">
        </div>
    </div>

    {{-- Fila contenedor verde --}}
    <div class="contenedor bgVerde5">
        <div class="row">
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">Competición</p>
            </div>
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">Fecha</p>
            </div>
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">Hora</p>
            </div>
        </div>

        @if ($botonInformacion)
            <div class="row align-items-center mt-4">
                <button class="botonVerde">Información del partido</button>
            </div>
        @endif
    </div>

    {{-- Separador --}}
    <div class="my-5 bgVerde5 separador">
    </div>
</div>

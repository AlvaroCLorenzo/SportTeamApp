<div class="container-sm textoBlanco mb-5">
    {{-- Jugador --}}
    <div>
        <div class="row align-items-center mb-4">
            <div class="col-4 d-none d-lg-block textoBlanco">
                <img class="w-100 mx-auto" src="{{ url('/img/iconos/jugadorIcon.png') }}" alt="">
            </div>
            <div class="col-lg-8">
                <div class="contenedor bgVerde5">
                    <div class="row w-100 mx-auto align-items-center">
                        <div class="col-sm">
                            <h2 class="my-0 text-center">{{$jugador->nombre.' '.$jugador->apellidos}}</h2>
                        </div>
                    </div>
    
                    @if ($botonInformacion)
                        <div class="row w-100 mx-auto align-items-center mt-4">
                            <button class="botonVerde">Información del jugador</button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    {{-- Fila contenedor verde --}}
    <div class="my-5 bgVerde5 separador">
    </div>
</div>

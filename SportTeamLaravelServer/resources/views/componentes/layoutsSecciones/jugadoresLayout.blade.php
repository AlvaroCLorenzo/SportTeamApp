<div class="container-sm p-0 textoBlanco">
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
                
                    <form action="{{url('/info-jugador')}}" method="post">
                        <input type="hidden" name="idJugador" value="{{$jugador->id}}"/>
                        <button class="botonVerde w-100 mt-3">Información del jugador</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

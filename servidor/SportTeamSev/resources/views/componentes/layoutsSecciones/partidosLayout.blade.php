<div class="container-sm p-0 textoBlanco">
    {{-- Fila nombre equipos --}}
    <div class="row align-items-center mb-4">
        <div class="col-6">
            <h3>{{$partido->local}}</h3>
        </div>
        <div class="col-6 text-end">
            <h3>{{$partido->visitante}}</h3>
        </div>
    </div>


    <?php

        $trozosResultado = explode(':', $partido->resultado);


        $trozosFecha = explode(' ',$partido->fechaHora);


        
        if($partido->pathImagenLocal == null){
            $partido->pathImagenLocal = 'userBig.png';
        }

        if($partido->pathImagenVisitante == null){
            $partido->pathImagenVisitante = 'userBig.png';
        }

        
                

    ?>

    {{-- Fila resultado y fotos --}}
    <div class="row align-items-center mb-4">
        <div class="col-3">
            <img class="w-100 mx-auto" src="{{ url('/storage/'.$partido->pathImagenLocal) }}" alt="">
        </div>
        <div class="col-2 puntuación px-2 text-center">
            <p class="w-50 mx-auto my-0 puntuacion texto bgVerde5">{{$trozosResultado[0]}}</p>
        </div>
        <div class="col-2">
            <img class="w-100 mx-auto" src="{{ url('/img/iconos/vsIcon.png') }}" alt="">
        </div>
        <div class="col-2 puntuación px-2 text-center">
            <p class="w-50 mx-auto my-0 puntuacion texto bgVerde5">{{$trozosResultado[0]}}</p>
        </div>
        <div class="col-3">
            <img class="w-100 mx-auto" src="{{ url('/storage/'.$partido->pathImagenVisitante) }}" alt="">
        </div>
    </div>

    {{-- Fila contenedor verde --}}
    <div class="contenedor bgVerde5">
        <div class="row">
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">@if($partido->competicion != null) {{$partido->competicion}} @else sin competicion @endif</p>
            </div>
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">{{$trozosFecha[1]}}</p>
            </div>
            <div class="col-sm-4">
                <p class="w-50 mx-auto my-0 texto text-center">{{$trozosFecha[0]}}</p>
            </div>
        </div>

        @if ($botonInformacion)
            <div class="row align-items-center mt-4">
                
                <form action="{{url('/info-partido')}}" method="post">
                    <input type="hidden" name="idPartido" value="{{$partido->id}}"/>
                    <button class="botonVerde">Información del partido</button>
                </form>

            </div>
        @endif
    </div>
</div>

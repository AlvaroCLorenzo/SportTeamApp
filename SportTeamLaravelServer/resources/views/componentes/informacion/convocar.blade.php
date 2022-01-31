<div class="row mx-auto p-0 mb-5">
    <div class="contenedor bgVerde5">
        <form action="{{$accion}}" method="post" class="row align-items-center mx-auto">
            <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                <select class="textoVerde1 m-0" name="idJugador" id="local">
                    {{-- casos de ejemplo --}}
                    
                    @foreach($jugadores as $jugador)

                        <option value="{{$jugador->id}}">{{$jugador->nombre." ".$jugador->apellidos}}</option>

                    @endforeach

                </select>

                <input type="hidden" name="token" value="{{$idToken}}"/>

            </div>
            <div class="col-lg-3 col-md-6 text-center my-3 my-lg-0">
                <input type="submit" name="convocar" value="convocar">
            </div>
            
        </form>
    </div>
</div>

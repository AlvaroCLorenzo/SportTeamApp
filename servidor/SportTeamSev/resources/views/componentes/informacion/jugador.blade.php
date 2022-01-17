<div class="container-sm textoBlanco">
    {{-- Jugador --}}
    <div class="w-75 mx-auto contenedor bgVerde5">
        <div class="row w-100 mx-auto my-3 align-items-center">
            <div class="col-6">
                <p class="my-0 text-start">Nombre:</p>
            </div>
            <div class="col-6">
                <p class="my-0 text-end">{{$jugador->nombre}}</p>
            </div>
        </div>
        <div class="row w-100 mx-auto my-3 align-items-center">
            <div class="col-6">
                <p class="my-0 text-start">Apellido:</p>
            </div>
            <div class="col-6">
                <p class="my-0 text-end">{{$jugador->apellidos}}</p>
            </div>
        </div>
        <div class="row w-100 mx-auto my-3 align-items-center">
            <div class="col-6">
                <p class="my-0 text-start">Fecha:</p>
            </div>
            <div class="col-6">
                <p class="my-0 text-end">{{$jugador->fechaNacimiento}}</p>
            </div>
        </div>
        <div class="row w-100 mx-auto my-3 align-items-center">
            <div class="col-6">
                <p class="my-0 text-start">Teléfono:</p>
            </div>
            <div class="col-6">
                <p class="my-0 text-end">{{$jugador->telefono}}</p>
            </div>
        </div>
    </div>
</div>

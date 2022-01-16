<div class="container-sm">
    {{-- Entrenamiento --}}
    <div class="contenedor bgVerde5">
        <div class="row align-items-center">
            <div class="col-2 textoBlanco text-center">
                <h2>ID</h2>
            </div>
            <div class="col-9">
                <div class="row align-items-center">
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Duración</p>
                    </div>
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Hora</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Fecha</p>
                    </div>
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Campo</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($botonInformacion)
            <div class="row align-items-center">
                <button class="botonVerde">Información del entrenamiento</button>
            </div>
        @endif
    </div>

    {{-- Fila contenedor verde --}}
    <div class="my-5 bgVerde5 separador">
    </div>
</div>

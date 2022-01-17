<div class="container-sm p-0">
    {{-- Entrenamiento --}}
    <div class="contenedor bgVerde5">
        <div class="row align-items-center">
            <div class="col-2 text-center textoBlanco">
                <h2>ID</h2>
            </div>
            <div class="col-9">
                <div class="row align-items-center">
                    <div class="col-sm">

                        <?php
                        if ($entrenamiento->duracion == null) {
                            $entrenamiento->duracion = 'Sin duración';
                        }
                        ?>

                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Duración:
                            {{ $entrenamiento->duracion }}</p>

                    </div>

                    <?php
                    
                    $trozos = explode(' ', $entrenamiento->fechaHora);
                    
                    ?>

                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Hora: {{ $trozos[1] }}</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">{{ $trozos[0] }}</p>
                    </div>
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Lugar:
                            {{ $entrenamiento->lugar }}</p>
                    </div>
                </div>
            </div>
        </div>

        @if ($botonInformacion)
            <form action="{{ url('/info-jugador') }}" method="post">
                <input type="hidden" name="idEntrenamiento" value="{{ $entrenamiento->id }}" />
                <button class="botonVerde w-100">Información del entrenamiento</button>
            </form>
        @endif
    </div>
</div>

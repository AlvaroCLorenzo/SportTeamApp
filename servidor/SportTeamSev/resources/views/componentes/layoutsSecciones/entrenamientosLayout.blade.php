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
                            if($entrenamiento->duracion == null){
                                $entrenamiento->duracion = "Sin duración";
                            }
                        ?>

                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Duración: {{$entrenamiento->duracion}}</p>

                    </div>

                    <?php

                        $trozos = explode(' ',$entrenamiento->fechaHora);

                    ?>

                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Hora: {{$trozos[1]}}</p>
                    </div>
                </div>
                <div class="row align-items-center">
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">{{$trozos[0]}}</p>
                    </div>
                    <div class="col-sm">
                        <p class="w-50 mx-auto my-0 texto textoVerde1 text-center py-3">Lugar: {{$entrenamiento->lugar}}</p>
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
</div>

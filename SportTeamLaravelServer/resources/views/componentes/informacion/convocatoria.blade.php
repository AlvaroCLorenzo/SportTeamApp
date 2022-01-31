{{-- Convocatoria --}}
<div class="row mx-auto p-0 textoVerde1">
    <div class="row mx-auto contenedor bgBlanco">
        <div class="row p-0">
            <h2 >Convocatoria</h2>

            @foreach($convocatorias as $convocatoria)
                @include('componentes/informacion/jugadorConvocado',[
                    'action' => $accion,
                    'idToken' => $idToken,
                    'idTokenConvocatoria' => $convocatoria->id,
                    'convocatoria' => $convocatoria
                ])
            @endforeach
        </div>
    </div>
</div>
</div>
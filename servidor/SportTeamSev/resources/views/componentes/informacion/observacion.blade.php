<div class="row mx-auto p-0 textoVerde1 my-5">
    <div class="contenedor bgBlanco">
        <div class="row">
            <h2 class="m-0">Observaciones</h2>
        </div>

        <form id="observacionFormulario" action="{{$accion}}" method="post">
            <div class="row texto-justificado">
                <textarea class="my-3 textoVerde1 p-2" name="observacion" id="" placeholder="Inserte aquí su observación" rows="3">
                    @if($observacion != null) {{$observacion}} @endif
                </textarea>
            </div>

            <input type="hidden" name="token" value="{{$idToken}}"/>

            <div class="text-end">
                <input type="submit" name="Guardar" value="Guardar">
            </div>
        </form>
    </div>
</div>

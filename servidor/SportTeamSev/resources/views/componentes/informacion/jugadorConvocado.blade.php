<form class="row w-100 mx-auto" action="{{$action}}" method="post">
    <div class="col-lg-6 p-0 py-3 text-center text-lg-start">
        <label>{{$convocatoria->jugador_nombre." ".$convocatoria->jugador_apellidos}}</label>
    </div>
    <div class="col-lg-2 p-0 py-3 text-center text-lg-start">
        <input type="checkbox" name="asistido" @if(strcmp($convocatoria->asistido,"1")==0) checked @endif>
        <label>Asisitdo</label>
    </div>
    <div class="col-lg-2 p-0 py-3 text-center text-lg-start">
        <input type="checkbox" name="justificado" @if(strcmp($convocatoria->justificado,"1")==0) checked @endif>
        <label>Justificado</label>
    </div>

    <input type="hidden" name="token" value="{{$idToken}}"/>

    <input type="hidden" name="tokenConvocatoria" value="{{$idTokenConvocatoria}}"/>

    <div class="col-lg-2 p-0 text-center text-lg-end">
        <input type="submit" name="Guardar" value="Guardar">
    </div>
</form>
<div class="my-2 bgVerde5 separador"></div>

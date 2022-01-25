package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.ConvocatoriaActivity;
import com.example.sportteamapp.Activities.ObservacionesPartidoActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Partido;
import com.example.sportteamapp.R;

public class ObservacionesPartidoActivityController implements View.OnClickListener {

    //Atributos de la clase.
    private ObservacionesPartidoActivity observacionesPartidoActivity;
    private boolean editando;
    private API api;

    //Constructor.
    public ObservacionesPartidoActivityController(ObservacionesPartidoActivity observacionesPartidoActivity) {
        this.observacionesPartidoActivity = observacionesPartidoActivity;
        editando = false;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonEditarGuardarObsPartido:
                efectoGuardarEditar();
                break;
            case R.id.buttonVerConvocatoriaPartido:
                verConvocatoriaPartido();
                break;
            default:
                break;
        }
    }

    //Metodo que lanza otro activity con los detalles y observaciones del partido.
    private void verConvocatoriaPartido() {
        observacionesPartidoActivity.lanzarToast(observacionesPartidoActivity.getVER_CONVOCATORIA());
        Intent intent = new Intent(observacionesPartidoActivity, ConvocatoriaActivity.class);
        intent.putExtra("idPartido", observacionesPartidoActivity.getPartido().getId());
        intent.putExtra("tipo", 0); //0 = convocatoria partido.
        observacionesPartidoActivity.startActivity(intent);
    }

    //Metodo que habilita y deshabilita la edicion del EditText Multiline segun la eleccion del usuario.
    private void efectoGuardarEditar() {
        //Si esta activado el modo editar observacion.
        if(editando){
            editando = false; //Cambiamos el flag
            String observacion = observacionesPartidoActivity.getTextObservacionPartido();
            Partido partido =  observacionesPartidoActivity.getPartido();
            partido.setObservacion(observacion);
            observacionesPartidoActivity.cambiarAModoEditando(false); //Quitamos el modo editar

            //Si no esta activado el modo editar observacion. (modo guardar activado)
        }else{
            editando = true;
            observacionesPartidoActivity.cambiarAModoEditando(true); //Activamos el modo editar.
        }
    }

    //Metodo que envia la actualizacion del partido en la bbdd mediante envio a la api al ser llamado al volver hacia atrás.
    public void enviarActualizacion() {
        String resLocal = observacionesPartidoActivity.getEditTextResultadoLocal();
        String resVisitante = observacionesPartidoActivity.getEditTextResultadoVisitante();
        String resultado = resLocal+":"+resVisitante;
        String observaciones = observacionesPartidoActivity.getTextObservacionPartido();
        String id = observacionesPartidoActivity.getPartido().getId();

        String parametros = "nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
        parametros+="&resultado="+resultado+"&observacion="+observaciones+"&idPartido="+id;

        api = new API(API.ACTUALIZAR_PARTIDO_URL, parametros);
        String respuesta = api.getRespuesta();
        if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
            observacionesPartidoActivity.lanzarToast(API.ERROR_CONEXION+" 2");
        }
    }
}

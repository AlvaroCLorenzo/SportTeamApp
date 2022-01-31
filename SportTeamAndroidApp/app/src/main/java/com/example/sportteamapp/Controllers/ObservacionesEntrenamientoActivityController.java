package com.example.sportteamapp.Controllers;

import android.content.Intent;
import android.view.View;

import com.example.sportteamapp.API.API;
import com.example.sportteamapp.Activities.ConvocatoriaActivity;
import com.example.sportteamapp.Activities.ObservacionesEntrenamientoActivity;
import com.example.sportteamapp.Models.Club;
import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.R;

public class ObservacionesEntrenamientoActivityController implements View.OnClickListener{

    //Atributos de la clase.
    private ObservacionesEntrenamientoActivity observacionesEntrenamientoActivity;
    private boolean editando;
    private API api;

    //Constructor.
    public ObservacionesEntrenamientoActivityController(ObservacionesEntrenamientoActivity observacionesEntrenamientoActivity) {
        this.observacionesEntrenamientoActivity = observacionesEntrenamientoActivity;
        this.editando = false;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonEditarGuardarObsEntrenamiento:
                efectoEditarGuardar();
                break;
            case R.id.buttonVerConvocatoriaObsEntrenamiento:
                verConvocatoriaEntrenamiento();
                break;
            default:
                break;
        }
    }

    //Metodo que habilita y deshabilita la edicion del EditText Multiline segun la eleccion del usuario.
    private void efectoEditarGuardar() {
        //Si esta activado el modo editar observacion...(modo editar activado)
        if(editando){
            editando = false; //Cambiamos el flag
            String observacion = observacionesEntrenamientoActivity.getTextObservacionEntrenamiento();
            Entrenamiento entrenamiento =  observacionesEntrenamientoActivity.getEntrenamiento();
            entrenamiento.setObservacion(observacion);
            observacionesEntrenamientoActivity.cambiarAModoEditando(false); //Quitamos el modo editar

            //Si esta desactivado el modo editar observacion... (modo guardar activado)
        }else{
            editando = true;
            observacionesEntrenamientoActivity.cambiarAModoEditando(true); //Activamos el modo editar.
        }
    }

    //Metodo que lanza otro activity con los detalles y observaciones del entrenamiento.
    private void verConvocatoriaEntrenamiento() {
        observacionesEntrenamientoActivity.lanzarToast(observacionesEntrenamientoActivity.getVER_CONVOCATORIA());
        Intent intent = new Intent(observacionesEntrenamientoActivity, ConvocatoriaActivity.class);
        intent.putExtra("tipo", 1); //1 = convocatoria entrenamiento.
        intent.putExtra("idEntrenamiento", observacionesEntrenamientoActivity.getEntrenamiento().getId());
        observacionesEntrenamientoActivity.startActivity(intent);
    }

    //Metodo que envia la actualizacion del entrenamiento en la bbdd mediante envio a la api al ser llamado al volver hacia atrás.
    public void enviarActualizacion() {
        String observaciones = observacionesEntrenamientoActivity.getTextObservacionEntrenamiento();
        String iD = observacionesEntrenamientoActivity.getEntrenamiento().getId();

        String parametros = "nombre="+ Club.getClub().getNombreClub() +"&contra="+Club.getClub().getContra();
        parametros+="&idEntrenamiento="+iD+"&observacion="+observaciones;

        api = new API(API.ACTUALIZAR_ENTRENAMIENTO_URL, parametros);
        String respuesta = api.getRespuesta();
        if(!respuesta.equalsIgnoreCase(API.ACTUALIZACION_EXITOSA)){
            observacionesEntrenamientoActivity.lanzarToast(API.ERROR_CONEXION+": Entrenamientos");
        }

    }
}

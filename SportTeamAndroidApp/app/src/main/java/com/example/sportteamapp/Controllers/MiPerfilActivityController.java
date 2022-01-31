package com.example.sportteamapp.Controllers;

import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.view.View;

import com.example.sportteamapp.Activities.MainActivity;
import com.example.sportteamapp.Activities.MiPerfilActivity;
import com.example.sportteamapp.R;

public class MiPerfilActivityController implements View.OnClickListener{

    //Atributos de la clase.
    private MiPerfilActivity miPerfilActivity;
    private SharedPreferences sharedPreferences;
    private SharedPreferences.Editor editorPreferences;

    //Constructor.
    public MiPerfilActivityController(MiPerfilActivity miPerfilActivity) {
        this.miPerfilActivity = miPerfilActivity;
    }

    @Override
    public void onClick(View v) {
        switch (v.getId()){
            case R.id.buttonCerrarSesion:
                cerrarSesionUsuario();
                break;
        }
    }

    //Metodo encargado de cerrar la sesion de usuario guardado.
    public void cerrarSesionUsuario(){
        //Borramos el contenido del fichero SharedPreferences...
        sharedPreferences = miPerfilActivity.getSharedPreferences(miPerfilActivity.getString(R.string.preferences_sportteamapp_file_key), Context.MODE_PRIVATE);
        editorPreferences = sharedPreferences.edit();
        editorPreferences.clear();
        editorPreferences.commit();

        //Cambiamos al activity de login...
        miPerfilActivity.lanzarToast(miPerfilActivity.getCERRAR_SESION());
        Intent intent = new Intent(miPerfilActivity, MainActivity.class);
        intent.setFlags(Intent.FLAG_ACTIVITY_NEW_TASK | Intent.FLAG_ACTIVITY_CLEAR_TOP);
        miPerfilActivity.startActivity(intent);
    }
}

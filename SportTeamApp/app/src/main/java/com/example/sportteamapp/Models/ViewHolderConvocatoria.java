package com.example.sportteamapp.Models;

import android.widget.CheckBox;
import android.widget.TextView;

public class ViewHolderConvocatoria {

    //Clase dedicada a recuperar los datos del layout de convocatoria, debido a su dificil acceso a traves de los checkbox;
    public int posicion;
    public TextView nombreJugador;
    public TextView apellidoJugador;
    public CheckBox checkBoxAsistido;
    public CheckBox checkBoxJustificado;

    public ViewHolderConvocatoria() {
    }


}

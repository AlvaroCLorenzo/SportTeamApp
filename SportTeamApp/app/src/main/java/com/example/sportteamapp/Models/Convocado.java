package com.example.sportteamapp.Models;

import com.google.gson.annotations.Expose;

public class Convocado {

    //Atributos de la clase.
    @Expose
    private String id;
    @Expose
    private String jugador_nombre;
    @Expose
    private String jugador_apellidos;
    @Expose
    private String asistido; //0=no asitido y 1=asistido.
    @Expose
    private String justificado; //0=no justificado y 1=justificado.

    //Constructor.
    public Convocado(String id, String jugador_nombre, String jugador_apellidos, String asistido, String justificado) {
        this.id = id;
        this.jugador_nombre = jugador_nombre;
        this.jugador_apellidos = jugador_apellidos;
        this.asistido = asistido;
        this.justificado = justificado;
    }

    //Getters
    public String getId() {
        return id;
    }

    public String getJugador_nombre() {
        return jugador_nombre;
    }

    public String getJugador_apellidos() {
        return jugador_apellidos;
    }

    public String getAsistido() {
        if(asistido.equals("0")){
            return "false";
        }else{
            return "true";
        }
    }

    public String getJustificado() {
        if(justificado.equals("0")){
            return "false";
        }else{
            return "true";
        }
    }

    //Setters.
    public void setAsistido(String asistido) {
        this.asistido = asistido;
    }

    public void setJustificado(String justificado) {
        this.justificado = justificado;
    }
}

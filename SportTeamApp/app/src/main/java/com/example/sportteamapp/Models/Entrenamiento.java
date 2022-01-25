package com.example.sportteamapp.Models;

import com.google.gson.annotations.Expose;

import java.io.Serializable;

public class Entrenamiento implements Serializable {

    //Atributos de la clase.
    @Expose
    private String id;
    @Expose
    private String lugar;
    @Expose
    private String duracion;
    @Expose
    private String fechaHora;
    private String fecha;
    private String hora;
    @Expose
    private String observacion;

    //Constructor.
    public Entrenamiento(String id, String lugar, String duracion, String fechaHora, String observacion) {
        this.id = id;
        this.lugar = lugar;
        this.duracion = duracion;
        this.fechaHora = fechaHora;
        this.observacion = observacion;
    }

    //Getters.
    public String getId() {
        return id;
    }

    public String getLugar() {
        return lugar;
    }

    public String getDuracion() {
        return duracion;
    }

    public String getFecha() {
        try{
            String[] trozos = this.fechaHora.split(" ");
            fecha = trozos[0];
        }catch (Exception e){
            e.printStackTrace();
        }
        return fecha;
    }

    public String getHora() {
        try{
            String[] trozos = this.fechaHora.split(" ");
            hora = trozos[1];
        }catch (Exception e){
            e.printStackTrace();
        }
        return hora;
    }

    //Getter
    public String getObservacion() {
        return observacion;
    }

    //Setter
    public void setObservacion(String observacion) {
        this.observacion = observacion;
    }
}

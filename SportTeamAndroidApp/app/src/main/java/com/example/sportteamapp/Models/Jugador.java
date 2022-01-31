package com.example.sportteamapp.Models;

import com.google.gson.annotations.Expose;

import java.io.Serializable;

public class Jugador implements Serializable {

    //Atributos de la clase.
    @Expose
    private String id;
    @Expose
    private String nombre;
    @Expose
    private String apellidos;
    @Expose
    private String fechaNacimiento;
    @Expose
    private String telefono;
    @Expose
    private String observacion;

    //Constructor.
    public Jugador(String id, String nombre, String apellidos, String fechaNacimiento, String telefono, String observacion) {
        this.id = id;
        this.nombre = nombre;
        this.apellidos = apellidos;
        this.fechaNacimiento = fechaNacimiento;
        this.telefono = telefono;
        this.observacion = observacion;
    }

    //Getters
    public String getId() {
        return id;
    }

    public String getNombre() {
        return nombre;
    }

    public String getApellidos() {
        return apellidos;
    }

    public String getNombreCompleto(){
        return nombre+" "+apellidos;
    }

    public String getFechaNacimiento() {
        return fechaNacimiento;
    }

    public String getTelefono() {
        return telefono;
    }

    public String getObservacion() {
        return observacion;
    }
}

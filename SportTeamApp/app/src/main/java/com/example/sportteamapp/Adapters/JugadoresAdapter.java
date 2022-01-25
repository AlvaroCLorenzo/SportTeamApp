package com.example.sportteamapp.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.sportteamapp.Models.Jugador;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class JugadoresAdapter extends BaseAdapter {

    //Atributos de la clase.
    private Context context;
    private int layout;
    private ArrayList<Jugador> jugadores;
    private String nombreJugador;

    //Constructor.
    public JugadoresAdapter(Context context, int layout, ArrayList<Jugador> jugadores) {
        this.context = context;
        this.layout = layout;
        this.jugadores = jugadores;
    }

    @Override
    public int getCount() {
        return jugadores.size();
    }

    @Override
    public Object getItem(int position) {
        return jugadores.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        //ViewHolder Pattern...
        ViewHolder holder;

        //Si es la primera vez que se carga...
        if(convertView==null){
            LayoutInflater layoutInflater= LayoutInflater.from(this.context);
            convertView = layoutInflater.inflate(this.layout, null);

            holder = new ViewHolder();

            holder.nombreJugador = (TextView) convertView.findViewById(R.id.textViewNombreJugador);

            convertView.setTag(holder);
        }else{
            holder = (ViewHolder) convertView.getTag(); //Si no recuperamos los datos recogidos anteriormente.
        }

        this.nombreJugador = jugadores.get(position).getNombreCompleto();

        holder.nombreJugador.setText(this.nombreJugador);

        return convertView;
    }

    //Getter y setter
    public ArrayList<Jugador> getJugadores(){
        return this.jugadores;
    }

    public void setJugadores(ArrayList<Jugador> jugadores) {
        this.jugadores = jugadores;
    }

    //Clase estatica ViewHolder para almacenar los elementos del item jugador.
    static class ViewHolder{
        private TextView nombreJugador;
    }


}

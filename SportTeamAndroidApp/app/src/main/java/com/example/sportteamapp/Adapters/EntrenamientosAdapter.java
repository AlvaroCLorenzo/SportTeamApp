package com.example.sportteamapp.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.TextView;

import com.example.sportteamapp.Models.Entrenamiento;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class EntrenamientosAdapter extends BaseAdapter {

    //Atributos de la clase.
    private Context context;
    private int layout;
    private ArrayList<Entrenamiento> entrenamientos;
    private String idEntrenamiento, lugar,  duracion,  fecha,  hora;

    //Constructor.
    public EntrenamientosAdapter(Context context, int layout, ArrayList<Entrenamiento> entrenamientos) {
        this.context = context;
        this.layout = layout;
        this.entrenamientos = entrenamientos;
    }

    @Override
    public int getCount() {
        return entrenamientos.size();
    }

    @Override
    public Object getItem(int position) {
        return entrenamientos.get(position);
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

            holder.idEntrenamiento = (TextView) convertView.findViewById(R.id.textViewIDEntrenamiento);
            holder.lugar = (TextView) convertView.findViewById(R.id.textViewLugarEntrenamiento);
            holder.duracion = (TextView) convertView.findViewById(R.id.textViewDuracionEntrenamiento);
            holder.fecha = (TextView) convertView.findViewById(R.id.textViewFechaEntrenamiento);
            holder.hora = (TextView) convertView.findViewById(R.id.textViewHoraEntrenamiento);

            convertView.setTag(holder);
        }else{
            holder = (ViewHolder) convertView.getTag(); //Si no recuperamos los datos recogidos anteriormente.
        }

        this.idEntrenamiento = entrenamientos.get(position).getId();
        this.lugar = entrenamientos.get(position).getLugar();
        this.duracion = entrenamientos.get(position).getDuracion();
        this.fecha = entrenamientos.get(position).getFecha();
        this.hora = entrenamientos.get(position).getHora();

        holder.idEntrenamiento.setText(this.idEntrenamiento);
        holder.lugar.setText(this.lugar);
        holder.duracion.setText(this.duracion);
        holder.fecha.setText(this.fecha);
        holder.hora.setText(this.hora);

        return convertView;
    }

    //Getters y setters
    public ArrayList<Entrenamiento> getEntrenamientos(){
        return this.entrenamientos;
    }

    public void setEntrenamientos(ArrayList<Entrenamiento> entrenamientos){
        this.entrenamientos = entrenamientos;
    }

    //Clase estatica ViewHolder para almacenar los elementos del item entrenamiento.
    static class ViewHolder{
        private TextView idEntrenamiento;
        private TextView lugar;
        private TextView duracion;
        private TextView fecha;
        private TextView hora;
    }
}

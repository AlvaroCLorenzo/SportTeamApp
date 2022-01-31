package com.example.sportteamapp.Adapters;

import android.content.Context;
import android.graphics.Bitmap;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.ImageView;
import android.widget.TextView;

import com.example.sportteamapp.Models.Partido;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class PartidosAdapter extends BaseAdapter {

    //Atributos de la clase.
    private Context context;
    private int layout;
    private ArrayList<Partido> partidos;
    private String nombreClub1, nombreClub2,resultado1, resultado2, competicion, fecha, hora;
    private Bitmap imagenLocal, imagenVisitante;

    //Constructor.
    public PartidosAdapter(Context context, int layout, ArrayList<Partido> partidos) {
        this.context = context;
        this.layout = layout;
        this.partidos = partidos;
    }

    @Override
    public int getCount() {
        return partidos.size();
    }

    @Override
    public Object getItem(int position) {
        return partidos.get(position);
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

            holder.nombreClub1 = (TextView) convertView.findViewById(R.id.textViewNombreClub1);
            holder.nombreClub2 = (TextView) convertView.findViewById(R.id.textViewNombreClub2);
            holder.resultado1 = (TextView) convertView.findViewById(R.id.textViewResultado1);
            holder.resultado2 = (TextView) convertView.findViewById(R.id.textViewResultado2);
            holder.escudoLocal = (ImageView) convertView.findViewById(R.id.imageViewEscudoLocal);
            holder.escudoVisitante = (ImageView) convertView.findViewById(R.id.imageViewEscudoVisitante);
            holder.competicion = (TextView) convertView.findViewById(R.id.textViewCompeticionPartido);
            holder.fecha = (TextView) convertView.findViewById(R.id.textViewFechaPartido);
            holder.hora = (TextView) convertView.findViewById(R.id.textViewHoraPartido);

            convertView.setTag(holder);
        }else{
            holder = (ViewHolder) convertView.getTag(); //Si no recuperamos los datos recogidos anteriormente.
        }

        this.nombreClub1 = partidos.get(position).getLocal();
        this.nombreClub2 = partidos.get(position).getVisitante();
        this.resultado1 = partidos.get(position).getResultado1();
        this.resultado2 = partidos.get(position).getResultado2();
        this.competicion = partidos.get(position).getCompeticion();
        this.imagenLocal = partidos.get(position).getImagenLocalBitmap();
        this.imagenVisitante = partidos.get(position).getImagenVisitanteBitmap();
        this.fecha = partidos.get(position).getFecha();
        this.hora = partidos.get(position).getHora();

        holder.nombreClub1.setText(this.nombreClub1);
        holder.nombreClub2.setText(this.nombreClub2);
        holder.resultado1.setText(this.resultado1);
        holder.resultado2.setText(this.resultado2);
        holder.escudoLocal.setImageBitmap(imagenLocal);
        holder.escudoVisitante.setImageBitmap(imagenVisitante);
        holder.competicion.setText(this.competicion);
        holder.fecha.setText(this.fecha);
        holder.hora.setText(this.hora);

        return convertView;
    }

    //Getter y setter
    public ArrayList<Partido> getPartidos() {
        return this.partidos;
    }

    public void setPartidos(ArrayList<Partido> partidos) {
        this.partidos = partidos;
    }

    //Clase estatica ViewHolder para almacenar los elementos del item partido.
    static class ViewHolder{
        private TextView nombreClub1;
        private TextView nombreClub2;
        private TextView resultado1;
        private TextView resultado2;
        private ImageView escudoLocal;
        private ImageView escudoVisitante;
        private TextView competicion;
        private TextView fecha;
        private TextView hora;
    }
}

package com.example.sportteamapp.Adapters;

import android.content.Context;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.BaseAdapter;
import android.widget.CheckBox;
import android.widget.TextView;

import com.example.sportteamapp.Activities.ConvocatoriaActivity;
import com.example.sportteamapp.Models.Convocado;
import com.example.sportteamapp.Models.ViewHolderConvocatoria;
import com.example.sportteamapp.R;

import java.util.ArrayList;

public class ConvocatoriaAdapter extends BaseAdapter {

    //Atributos de la clase.
    private Context context;
    private int layout;
    private ArrayList<Convocado> jugadoresConvocados;
    private String nombreJugador;
    private String apellidoJugador;
    private String asistido;
    private String justificado;
    private ConvocatoriaActivity convocatoriaActivity;
    public ArrayList<CheckBox> arrayCheckbox;

    //Constructor.
    public ConvocatoriaAdapter(Context context, int layout, ArrayList<Convocado> jugadoresConvocados) {
        this.context = context;
        this.layout = layout;
        this.jugadoresConvocados = jugadoresConvocados;
        this.convocatoriaActivity = (ConvocatoriaActivity) this.context;
    }

    @Override
    public int getCount() {
        return jugadoresConvocados.size();
    }

    @Override
    public Object getItem(int position) {
        return jugadoresConvocados.get(position);
    }

    @Override
    public long getItemId(int position) {
        return position;
    }

    @Override
    public View getView(int position, View convertView, ViewGroup parent) {
        //ViewHolder Pattern...
        ViewHolderConvocatoria holder;

        //Si es la primera vez que se carga...
        if(convertView==null){
            LayoutInflater layoutInflater= LayoutInflater.from(this.context);
            convertView = layoutInflater.inflate(this.layout, null);

            holder = new ViewHolderConvocatoria();
            holder.posicion = position;
            holder.nombreJugador = (TextView) convertView.findViewById(R.id.textViewNombreRealJugadorConvocado);
            holder.apellidoJugador = (TextView) convertView.findViewById(R.id.textViewApellidoConvocatoriaJugador);
            holder.checkBoxAsistido = (CheckBox) convertView.findViewById(R.id.checkBoxAsistido);
            holder.checkBoxJustificado = (CheckBox) convertView.findViewById(R.id.checkBoxJustificado);
            arrayCheckbox = new ArrayList<CheckBox>();
            convertView.setTag(holder);
        }else{
            holder = (ViewHolderConvocatoria) convertView.getTag(); //Si no recuperamos los datos recogidos anteriormente.
        }

        this.nombreJugador = jugadoresConvocados.get(position).getJugador_nombre();
        this.apellidoJugador = jugadoresConvocados.get(position).getJugador_apellidos();
        this.asistido = jugadoresConvocados.get(position).getAsistido();
        this.justificado = jugadoresConvocados.get(position).getJustificado();

        holder.nombreJugador.setText(this.nombreJugador);
        holder.apellidoJugador.setText(this.apellidoJugador);
        if(asistido.equals("false")){
            holder.checkBoxAsistido.setChecked(false);
        }else{
            holder.checkBoxAsistido.setChecked(true);
        }
        if(justificado.equals("false")){
            holder.checkBoxJustificado.setChecked(false);
        }else{
            holder.checkBoxJustificado.setChecked(true);
        }

        holder.checkBoxAsistido.setOnClickListener(convocatoriaActivity.getController());
        holder.checkBoxJustificado.setOnClickListener(convocatoriaActivity.getController());

        return convertView;
    }

    //Getter y setter de jugadores convocados.
    public ArrayList<Convocado> getJugadoresConvocados() {
        return jugadoresConvocados;
    }

    public void setJugadores(ArrayList<Convocado> jugadoresConvocados){
        this.jugadoresConvocados = jugadoresConvocados;
    }

}

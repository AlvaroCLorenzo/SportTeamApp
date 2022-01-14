<?php

namespace App\Models;

use App\Http\Controllers\ModelControllers\ConsultaController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia_partido extends Model
{
    use HasFactory;

    protected $appends = [
        'jugador_nombre',
        'jugador_apellidos'
    ];

    protected $hidden = [
        'updated_at',
        'created_at',
        'jugador_id'
    ];

    public function getJugadorNombreAttribute(){

        return ConsultaController::buscarJugador($this->attributes['jugador_id'])[0]->nombre;

    }

    public function getJugadorApellidosAttribute(){

        return ConsultaController::buscarJugador($this->attributes['jugador_id'])[0]->apellidos;

    }

    public function jugadore(){
        return $this->belongsTo(Jugadore::class);
    }

    public function partido(){
        return $this->belongsTo(Partido::class);
    }
}

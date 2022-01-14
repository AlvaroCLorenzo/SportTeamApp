<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jugadore extends Model
{
    use HasFactory;

    protected $hidden = [
        'updated_at',
        'created_at',
        'club_id'
    ];

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function asistencia_entrenamiento(){
        return $this->hasMany(Asistencia_entrenamiento::class, 'jugador_id');
    }

    public function asistencia_partido(){
        return $this->hasMany(Asistencia_partido::class, 'jugador_id');
    }

}

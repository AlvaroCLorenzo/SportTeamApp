<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia_entrenamiento extends Model
{
    use HasFactory;

    public function jugadore(){
        return $this->belongsTo(Jugadore::class);
    }

    public function entrenamiento(){
        return $this->belongsTo(Entrenamiento::class);
    }
}

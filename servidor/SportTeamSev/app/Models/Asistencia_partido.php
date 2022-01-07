<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia_partido extends Model
{
    use HasFactory;

    public function jugadore(){
        return $this->belongsTo(Jugadore::class);
    }

    public function partido(){
        return $this->belongsTo(Partido::class);
    }
}

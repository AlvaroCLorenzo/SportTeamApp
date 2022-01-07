<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entrenamiento extends Model
{
    use HasFactory;


    

    public function club(){
        return $this->belongsTo(Club::class);
    } 

    public function asistencia_entrenamiento(){
        return $this->hasMany(Asistencia_entrenamiento::class);
    }
}

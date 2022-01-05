<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Categoria;

class Club extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'deporte',
        'temporada',
        'categoria_id'
    ];

    protected $hidden = [
        'password'
    ];

    public function categoria(){
        return $this->belongsTo(Categoria::class);
    } 

    public function entrenamientos(){
        return $this->hasMany(Entrenamiento::class);
    }



}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Club;

class Categoria extends Model
{
    use HasFactory;


    protected $fillable = [
        'nombreCategoria'
    ];

    public function clubs(){
        return $this->hasMany(Club::class);
    }
}

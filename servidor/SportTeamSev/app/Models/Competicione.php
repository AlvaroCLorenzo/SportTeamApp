<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competicione extends Model
{
    use HasFactory;

    public function partidos(){
        return $this->hasMany(Partido::class, 'competicion_id');
    }
}

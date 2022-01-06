<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partido extends Model
{
    use HasFactory;

    public function club(){
        return $this->belongsTo(Club::class);
    }

    public function competicione(){
        return $this->belongsTo(Competicione::class);
    }
}

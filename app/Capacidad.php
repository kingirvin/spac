<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Capacidad extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','competencias_id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desempeno extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','grados_id','competencias_id'
    ];
}

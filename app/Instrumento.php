<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Instrumento extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','areasPlanAnuals_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Evidencia extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','areasPlanAnuals_id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Criterio extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','desempenos_id','areasPlanAnuals_id','evidencia','estado',
    ];
}

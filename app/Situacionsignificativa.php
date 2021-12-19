<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Situacionsignificativa extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','unidadesPlans_id','criterio_id','area_id',
    ];
}

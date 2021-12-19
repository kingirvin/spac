<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfoquesplan extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','enfoques_id','unidadesPlans_id','estado'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Materialsesion extends Model
{
    //nombreactitudplans_id
    protected $fillable = [
        'nombre','sesionaprendizajes_id',
    ];
}

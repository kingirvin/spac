<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Desarrollo extends Model
{
    //nombremomentosesionaprendizajes_id
    protected $fillable = [
        'nombre','momento','sesionaprendizajes_id',
    ];
}

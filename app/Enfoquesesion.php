<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Enfoquesesion extends Model
{
    //
    protected $fillable = [
        'enfoque','actitud','sesionaprendizajes_id','enfoquePlan_id',
    ];
}

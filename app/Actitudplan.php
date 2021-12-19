<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actitudplan extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','enfoquesPlans_id',
    ];
}

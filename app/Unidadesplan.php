<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Unidadesplan extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','unidads_id','planAnual_id',
    ];
}

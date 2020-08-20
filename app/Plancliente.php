<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plancliente extends Model
{
    //
    protected $fillable = [
        'pagos_id','nombre','descripcion','inicio','fin','estado',
    ];
}

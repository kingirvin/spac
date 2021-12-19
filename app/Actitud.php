<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Actitud extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','enfoques_id'
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Competenciasareasplananual extends Model
{
    //
    protected $fillable = [
        'nombre','areasPlanAnual_id','competencias_id',
    ];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PlanDesempeno extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','desempenos_id','areasPlanAnuals_id',
    ];
}

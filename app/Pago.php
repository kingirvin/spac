<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pago extends Model
{
    //       
    protected $fillable = [
        'fecha','nrobaucher','monto','descripcion','personas_id','plans_id',
    ];
    public function plan()
    {
        return $this->belongsTo('App\Plan', 'plans_id');
    }
}

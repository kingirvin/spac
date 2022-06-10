<?php

namespace App;
use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = [
        'nombre', 'apellidos', 'telefono','correo',
    ];
    public function pago()
    {
        return $this->hasMany('App\Pago', 'personas_id');
    } 
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','link',
    ];
    public function submodulo()
    {
        return $this->hasMany('App\Submodulo', 'modulos_id');
    } 
}

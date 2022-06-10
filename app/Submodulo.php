<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submodulo extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion','link','modulos_id',
    ];
    public function modulo()
    {
        return $this->belongsTo('App\Models\Modulo', 'modulos_id');
    }
}

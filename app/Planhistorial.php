<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Planhistorial extends Model
{
    //
    protected $fillable = [
        'personas_id','pagos_id','fecha','incio','find','etalle','estado',
    ];
}

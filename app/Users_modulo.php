<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;
use Auth;
use DB;

class Users_modulo extends Model
{
    //
    protected $fillable = [
        'users_personas_id','modulos_id',
    ];

   public  static function listarModulos(){
        $user = Auth::user();

       $modulos= DB::table('users_modulos')
       ->select('modulos.nombre','modulos.id')
       ->join('modulos','modulos.id','users_modulos.modulos_id')
       ->where('users_personas_id',$user->id)
        ->get();
       foreach($modulos as $modulo){
            $resul = DB::table('submodulos')         
            ->select('submodulos.id','submodulos.nombre','submodulos.link')
            ->where('submodulos.modulos_id',$user->id)
           ->get();
            $modulo->subModulo=$resul;
        }
        return $modulos;
   }
}

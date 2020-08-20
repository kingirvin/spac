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
        'id','users_personas_id','modulos_id',
    ];

   public  static function listarModulos($vars){
        $user = Auth::user();

       $modulos= DB::table('users_modulos')
       ->select('modulos.nombre','modulos.id')
       ->join('modulos','modulos.id','users_modulos.modulos_id')
       ->where('users_modulos.id',$user->id)
       ->where('users_modulos.users_personas_id',$user->personas_id)
        ->get();
       foreach($modulos as $modulo){
            $modulo->estado="0";
            $resuls = DB::table('submodulos')         
            ->select('submodulos.id','submodulos.nombre','submodulos.link')
            ->where('submodulos.modulos_id',$modulo->id)
           ->get();
           foreach($resuls as $resul){
               $resul->estado="0";
               if($resul->link==$vars){
                    $resul->estado=1;
                    $modulo->estado=1;
                }
           }
            $modulo->subModulo=$resuls;
        }
        return $modulos;
   }
}

<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Users_modulo;
use App\Modulo;

class Users_moduloController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function rol(Request $request)
     {  
        $modulo=Modulo::get();
        foreach($modulo as $rol){
            $roles=Users_modulo::where('users_personas_id',$request->id)->where('modulos_id',$rol->id)->get(); 
            if(count($roles)>0)
                $rol->estado="checked";
            else
                $rol->estado="";
        }
        //return $roles;
        return $modulo;     
    }
    public function actualizar(Request $request)
    {  
        $request;   
        $modulo=Users_modulo::where('users_personas_id',$request->id)->where('modulos_id',$request->rol)->get();
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        if(count($modulo)>0)
            Users_modulo::destroy($request->idDesempeno);
        else
            Users_modulo::create([
                'modulos_id' => $request->rol,
                'users_personas_id' =>$request->id
            ]);   
    } 
    
}

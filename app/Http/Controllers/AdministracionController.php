<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modulo;
use App\Persona;
use Auth;

class AdministracionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     // pagina de Perfil
    public function usuario()
    {
        $user=Auth::user();
        $modulos= Modulo::with('submodulo')
        ->join('users_modulos','users_modulos.modulos_id','modulos.id')
        ->where('users_modulos.users_personas_id',$user->personas_id)->get();
        $activo="Usuario";
        $personas= Persona::with('pago','pago.plan')->get(); 
        $persona= Persona::find($user->personas_id); 
        return view('administrador/usuario', compact('persona','personas','modulos','activo'));
        
    } 
}

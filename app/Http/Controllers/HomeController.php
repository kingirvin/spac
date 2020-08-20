<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Pago;
use App\PlanCliente;
use App\Users_modulo;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('miPerfil');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        //return $persona[0];
        return \View::make('index')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos); 
    }    
    public function listarUsuario()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('listarUsuario');
        $persona= Persona::listarPersonas(); 
        //return $persona[0];
        return \View::make('listarUsuario')
        ->with('personas',$persona)
        ->with('modulos',$modulos); 
    } 
    public function nuevoUsuario()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('nuevoUsuario');
        $persona= Persona::listarPersonas(); 
        //return $persona[0];
        return \View::make('nuevoUsuario')
        ->with('personas',$persona)
        ->with('modulos',$modulos); 
    } 





    
    public function registroUsuario()
    {
        $persona=Persona::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->email,
        ]);
        $user=User::create([
            'name' => $request->nombre,
            'email' =>$request->email,
            'personas_id' => $persona->id,
            'password' => Hash::make($request->password),
        ]);
        Users_modulo::create([
            'id' => $user->id,
            'users_personas_id' =>$persona->id,
            'modulos_id' =>'2',
        ]);
        //definimos el area geografica del cual deseamos la fecha
        date_default_timezone_set("America/Lima");
        //extraemos la fecha usando la funcion date 
        // d: dia
        // m: mes
        // Y: ańo en cuatro dígitos
        $plan=Plan::where("id",$request->plan)->get();
            $pago=Pago::create([
            'fecha' =>  date("d/m/Y"),
            'nrocomprobante' =>$request->comprobante,
            'plans_id' =>$request->plan,
            'monto' =>$plan[0]->costo,
            'personas_id' => $persona->id,
        ]);
        $estado="Vigente";
        if($pago[0]->plans_id==1)
            $mes=date("d")."/".(date("m")+1)."/".date("Y");
        if($pago[0]->plans_id==2)
            $mes=date("d")."/".(date("m")+3)."/".date("Y");
        if($pago[0]->plans_id==3)
            $mes=date("d")."/".date("m")."/".(date("Y")+1);
            if($mes<10){
                $mes="0".$mes;
            }
        PlanCliente::create([
            'pagos_id' => $pago->id,
            'incio' =>date("d/m/Y"),
            'fin' =>$mes,
            'estado' =>$estado,
        ]);
        return redirect()->intended('nuevoUsuario');  
    } 
    
    public function activarPlan(Request $request)
    {
        //definimos el area geografica del cual deseamos la fecha
        date_default_timezone_set("America/Lima");
        //extraemos la fecha usando la funcion date 
        // d: dia
        // m: mes
        // Y: ańo en cuatro dígitos
        $mes=date("d");
        $pago=Pago::where('id',$request->cuenta)->get();
        if($pago[0]->plans_id==1)
            $mes=date("d")."/".(date("m")+1)."/".date("y");
        if($pago[0]->plans_id==2)
            $mes=date("d")."/".(date("m")+3)."/".date("y");
        if($pago[0]->plans_id==3)
            $mes=date("d")."/".date("m")."/".(date("y")+1);
        PlanCliente::where('pagos_id',$request->cuenta)
                    ->update(['inicio'=>date("d/m/Y"),
                    'fin'=>$mes,
                    'estado'=>"Activo"]);
        return redirect()->intended('listarUsuario');  
    } 

}

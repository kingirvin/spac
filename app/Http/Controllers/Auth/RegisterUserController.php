<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\Persona;
use App\Pago;
use App\PlanCliente;
use App\Users_modulo;
use Auth;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class RegisterUserController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
  protected function validator(Request $request)
    {
        return Validator::make($request, [
            'nombre' => ['required', 'string', 'max:255'],
            'telefono' => ['required', 'string', 'max:255'],
            'apellidos' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(Request $request)
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
            'modulos_id' =>'1',
        ]);
        if($request->comprobante!=""|| $request->comprobante!=null){
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
            $estado="Pendiente de activación";
            if($request->plan=="4")
                $estado="Cuenta prueba";
            PlanCliente::create([
                'pagos_id' => $pago->id,
                'incio' =>date("d/m/Y"),
                'fin' =>"",
                'estado' =>$estado,
            ]);

        }
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect()->intended('miPerfil');        
        }
    }
}
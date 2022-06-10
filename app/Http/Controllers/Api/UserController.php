<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DataTables;
use App\Persona;
use App\User;
use App\Modulo;

use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function listar()
    {        
        //3:ADMIN, 2:INSTITUCIONAL, 1:EMPRESA, 0:PUBLICO
        $lista=Persona::with('pago','pago.plan')->get(); 
        return DataTables::of($lista)->ToJson();    
    } 
    public function reestablecer(Request $request)
    { 
        $validator=Validator::make($request->all(), [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);     
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()], 500);
        }   
        $usuario=User::find($request->id);  
        if($usuario==null)
            return response()->json(['message'=>'Usuario no existe'], 500);
        try {
            $usuario->password= Hash::make($request->password);
            if($usuario->save())
                return response()->json(['message'=>'Se actualizo correctamente'], 200);
            else
                return response()->json(['message'=>'Error, no se guardaron los datos'], 500);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 500);
        }

    }
    public function buscar(Request $request)
    {    
         return User::with('persona')->find($request->id);        
    }
    public function actualizar(Request $request)
     {    
        //'nombre','apaterno','amaterno','email','telefono','direccion','nacimiento','tipo_id','empresa_id','entidad_id','password',
        //'estado','dni',
        $validator=Validator::make($request->all(), [ 
            'nombre' => ['required', 'string', 'max:191'],
            'apellidos' => ['required', 'string', 'max:191'],
            'telefono' => ['required', 'string', 'max:191'],
            'email' => ['required'],
        ]);    
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()], 500);
        } 
        $usuario=User::find($request->id);
        $persona=Persona::find($usuario->persona_id);
        if($usuario==null)
            return response()->json(['message'=>'Usuario no existe'], 500);
        try {
            $usuario->email=$request->email;
            $persona->nombre=$request->nombre;
            $persona->apellidos=$request->apellidos;
            $persona->telefono=$request->telefono;
            $persona->correo=$request->email;
            if($usuario->save()){
                $persona->save();
                return response()->json(['message'=>'Se actualizo correctamente'], 200);
                }
            else
                return response()->json(['message'=>'Error, no se guardaron los datos'], 500);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 500);
        }
        
    }
    public function nuevo(Request $request)
    {
        //return $request;
        //'nombre','apaterno','amaterno','email','telefono','direccion','nacimiento','tipo_id','empresa_id','entidad_id','password',
        //'estado','dni',
        $validator=Validator::make($request->all(), [ 
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'nombre' => ['required', 'string', 'max:191'],
            'apellidos' => ['required', 'string', 'max:191'],
            'telefono' => ['required', 'string', 'max:191'],
            'email' => ['required'],
        ]);    
        if ($validator->fails()) {
            return response()->json(['message'=>$validator->errors()], 500);
        } 
        try {
        # code...
            $persona=new Persona;
            $persona->nombre=$request->nombre;
            $persona->apellidos=$request->apellidos;
            $persona->telefono=$request->telefono;
            $persona->correo=$request->email;
            if($persona->save()){
                $usuario=new User;
                $usuario->name=$request->nombre;
                $usuario->email=$request->email;
                $usuario->personas_id=$persona->id;
                $usuario->tipo=$request->tipo;
                $usuario->password=Hash::make($request->password);
                $usuario->save();
                return response()->json(['message'=>'Se registró correctamente'], 200);
                }
            else
                return response()->json(['message'=>'Error, no se guardaron los datos'], 500);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage()], 500);
        }
    }
}

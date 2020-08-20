<?php

namespace App;
use Auth;
use DB;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    //
    protected $fillable = [
        'nombre', 'apellidos', 'telefono','correo',
    ];
   public  static function listarPersonas(){
        $user = Auth::user();

       $personas= DB::table('personas')
       ->select('personas.nombre','personas.id','personas.telefono','personas.correo')
        ->get();
       foreach($personas as $persona){
           $persona->comprobante="---";
           $persona->idPlanCliente="";
           $persona->monto="---";
           $persona->inicio="---";
           $persona->fin="---";
           $persona->plan="---";
           $persona->estado="pendiente de pago";            
           $resul = DB::table('pagos')         
            ->select('pagos.monto','pagos.fecha','pagos.id as pago','pagos.nrobaucher','planClientes.estado','planClientes.inicio','planClientes.fin','planClientes.id as idPlanCliente','plans.nombre as plan')
            ->join('planClientes','planClientes.pagos_id','pagos.id')
            ->join('plans','plans.id','pagos.plans_id')
            ->where('pagos.personas_id',$persona->id)
           ->get();
           if(count($resul)>0){
                $persona->comprobante=$resul[0]->nrobaucher;
                $persona->idPlanCliente=$resul[0]->pago;
                $persona->monto=$resul[0]->monto;
                $persona->inicio=$resul[0]->inicio;
                $persona->fin=$resul[0]->fin;
                $persona->plan=$resul[0]->plan;
                $persona->fecha=$resul[0]->fecha;
                $persona->estado=$resul[0]->estado;
            }
        }
        return $personas;
   }
}

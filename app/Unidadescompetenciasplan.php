<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Unidadescompetenciasplan extends Model
{
    //
    protected $fillable = [
        'estado','areasPlanAnuals_id','unidadesPlans_id',
    ];
    public static function unidadesCompeteciaCapacidadPlan($id){
        $unidades=DB::table("unidadescompetenciasplans")
        ->select('areasplananuals.nombreCompetencia as competencia','unidadesplans.id as unidadesPlanId',
        'areasplananuals.instrumento','areasplananuals.id as areasPlanAnualId','unidadescompetenciasplans.id as unidadEstadoId','areasplananuals.competencias_id','unidadescompetenciasplans.areasPlanAnuals_id','areasplananuals.id as areasPlanAnualsId')
        ->join('areasplananuals','areasplananuals.id','unidadescompetenciasplans.areasPlanAnuals_id')
        ->join('unidadesplans','unidadesplans.id','unidadescompetenciasplans.unidadesPlans_id')
        ->where('unidadescompetenciasplans.estado','1')
        ->where('unidadesplans.id',$id)
        ->get();
        foreach($unidades as $unidad){
            $capacidades=DB::table("capacidads")
            ->select('capacidads.nombre', 'capacidads.id', 'capacidads.descripcion')
            ->where('capacidads.competencias_id',$unidad->competencias_id)
            ->get();
            $unidad->competencias=$capacidades;
            $unidad->cantidad=count($capacidades);
        }
        foreach($unidades as $unidad){
            $desempenos=DB::table("criterios")
            ->select('*')
            ->where('criterios.areasPlanAnuals_id',$unidad->areasPlanAnuals_id)
            ->get();
            $unidad->desempenos=$desempenos;
        }
        $enfoques=DB::table("enfoquesplans")
        ->select('*')
        ->where('enfoquesplans.unidadesPlans_id',$id)
        ->where('enfoquesplans.estado',"1")
        ->get();
        foreach ($enfoques as $value) {
            $actudides=DB::table("actitudplans")
            ->select('*')
            ->where('actitudplans.enfoquesPlans_id',$value->id)
            ->get();
            $value->actitudes=$actudides;
        }
        $situacion=DB::table("situacionsignificativas")
        ->select('*')
        ->where('unidadesPlans_id',$id)
        ->get();
        $sesion=DB::table("sesionaprendizajes")
        ->select('*')
        ->where('unidadesPlans_id',$id)
        ->get();
            $array=array('0' =>$unidades ,'1' =>$enfoques,'2'=>$situacion,'3'=>$sesion);
        return $array;
    }
}

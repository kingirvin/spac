<?php

namespace App;
use DB;

use Illuminate\Database\Eloquent\Model;

class Plananual extends Model
{
    //
    protected $fillable = [
        'nombre','docente','nombre_ie','descripcion','nivels_id','users_id','users_personas_id','grados_id','seccions_id','periodos_id','fecha'
    ];
    public static function buscarPlanAnual($id){
        $plan=DB::table("plananuals")
        ->select('*')
        ->where('id',$id)
        ->get();
        $areas=DB::table("areasplananuals")
        ->select('*')
        ->where('areasplananuals.planAnuals_id',$id)
        ->get();
        $enfoques=DB::table("enfoques")
        ->select('*')        
        ->get();
        foreach($enfoques as $enfoque){
            $temp=DB::table("enfoquesplans")
            ->select('enfoquesplans.id','enfoquesplans.nombre','enfoquesplans.estado')
            ->join("unidadesplans","unidadesplans.id","enfoquesplans.unidadesPlans_id")
            ->where('unidadesplans.planAnual_id',$id)
            ->where('enfoquesplans.enfoques_id',$enfoque->id)
            ->get();
            $enfoque->estados=$temp;
        }

        $i=1;
        $areaid="";
        foreach($areas as $areaunidades){  
            $estadoUnidades=DB::table("unidadescompetenciasplans")
            ->select('*')
            ->where('unidadescompetenciasplans.areasPlanAnuals_id',$areaunidades->id)
            ->get();
            $areaunidades->unidades=$estadoUnidades;            
        }

        $unidades=DB::table("unidadesplans")
        ->select('*')
        ->where('unidadesplans.planAnual_id',$id)
        ->get();        
        $plan[0]->areas=$areas;
        $plan[0]->unidades=$unidades;
        $plan[0]->enfoques=$enfoques;
        return $plan;
    }
    //busca la tabla plan anual por el id
    public static function buscarGradoSeccionPeriodoPlan($id){
        $plan=DB::table("plananuals")
        ->select('plananuals.docente','grados.nombre as grado','periodos.nombre as periodo','grados.id as grado_id','seccions.nombre as seccion')
        ->join('grados','grados.id','plananuals.grados_id')
        ->join('seccions','seccions.id','plananuals.seccions_id')
        ->join('periodos','periodos.id','plananuals.periodos_id')
        ->where('plananuals.id',$id)
        ->get();
          
        $unidades=DB::table("unidadesplans")
        ->select('*')
        ->where('unidadesplans.planAnual_id',$id)
        ->get();   
        $plan[0]->unidades=$unidades;  
        return $plan;

    }
    //busca la tabla plan anual por el id de la unidad del plan
    public static function buscarPlanAnualspoUnidadad($id){
        $plan=DB::table("plananuals")
        ->select('plananuals.docente','plananuals.nombre_ie','unidadesplans.nombre as unidad','grados.nombre as grado','periodos.nombre as periodo','seccions.nombre as seccion','unidadesplans.unidads_id')
        ->join("unidadesplans","unidadesplans.planAnual_id","plananuals.id")
        ->join('grados','grados.id','plananuals.grados_id')
        ->join('seccions','seccions.id','plananuals.seccions_id')
        ->join('periodos','periodos.id','plananuals.periodos_id')
        ->where('unidadesplans.id',$id)
        ->get();
        return $plan;
    }
}

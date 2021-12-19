<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class Sesionaprendizaje extends Model
{
    //
    protected $fillable = [
       'sesion','nombre','area','criterio','evidencia','unidadesPlans_id','antesde','tiempo','fecha','saberes',
                            'problema' ,
                            'proposito',
                            'cierre',
                            'evaluacion',
                            'tiempoInicio',
                            'tiempoProceso',
                            'tiempoCierre',
   ];
    public static function buscarCompetenciasCapacidadesUnidadesPlan($id){
        $sesion=DB::table("sesionaprendizajes")
        ->select('competencias.id as competencia_id',
        'competencias.id as competencia_id',
        'competencias.nombre as competencia',
        'sesionaprendizajes.unidadesPlans_id',
        'sesionaprendizajes.antesde',
        'sesionaprendizajes.area_id',
        'sesionaprendizajes.nombre',
        'sesionaprendizajes.fecha',
        'sesionaprendizajes.area',
        'sesionaprendizajes.tiempo',
        'sesionaprendizajes.criterio',
        'sesionaprendizajes.evidencia',
        'sesionaprendizajes.saberes',
        'sesionaprendizajes.problema',
        'sesionaprendizajes.proposito',
        'sesionaprendizajes.cierre',
        'sesionaprendizajes.evaluacion',
        'sesionaprendizajes.tiempoInicio',
        'sesionaprendizajes.tiempoProceso',
        'sesionaprendizajes.tiempoCierre',
        'sesionaprendizajes.id')
        ->join('criterios','criterios.id','sesionaprendizajes.criterio_id')
        ->join('desempenos','desempenos.id','criterios.desempenos_id')
        ->join('competencias','competencias.id','desempenos.competencias_id')
        ->where('sesionaprendizajes.id',$id)
        ->get();
        $enfoques=DB::table("enfoquesPlans")
        ->select('*')
        ->where('enfoquesPlans.estado',"1")
        ->where('enfoquesPlans.unidadesPlans_id',$sesion[0]->unidadesPlans_id)
        ->get();
        foreach($enfoques as $enfoque){
            $actitudes=DB::table("actitudplans")
            ->select('*')
            ->where('actitudplans.enfoquesPlans_id',$enfoque->id)
            ->get();
            $enfoque->actitudes=$actitudes;
        }
        $enfoquesSesion=DB::table("enfoquesesions")
        ->select('*')
        ->where('enfoquesesions.sesionaprendizajes_id',$id)
        ->get();

        $capacidades=DB::table("capacidads")
        ->select('*')
        ->where('competencias_id',$sesion[0]->competencia_id)
        ->get();
        
        $desarrollo=Desarrollo::where('sesionaprendizajes_id',$id)
        ->get();
    
        $sesion[0]->capacidades=$capacidades;
        $sesion[0]->enfoques=$enfoques;
        $sesion[0]->enfoquesSesion=$enfoquesSesion;
        $sesion[0]->momentos=$desarrollo;
        return $sesion;
    }
}

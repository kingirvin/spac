<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Areasplananual extends Model
{
    //
    protected $fillable = [
        'nombreArea','nombreCompetencia','planAnuals_id','areas_id','competencias_id','cantidad','instrumento',
    ];
    public static function listarCriteriosCurso($unidad,$curso){
        $criterios=DB::table("areasplananuals")
        ->select('criterios.nombre','criterios.id','criterios.evidencia')
        ->join('unidadescompetenciasplans','unidadescompetenciasplans.areasPlanAnuals_id','areasplananuals.id')
        ->join('unidadesplans','unidadesplans.id','unidadescompetenciasplans.unidadesPlans_id')
        ->join('criterios','criterios.areasPlanAnuals_id','areasplananuals.id')
        ->where('unidadescompetenciasplans.estado','1')
        ->where('criterios.estado','0')
        ->where('unidadesplans.id',$unidad)
        ->where('areasplananuals.areas_id',$curso)
        ->get();
        return $criterios;
    }
}

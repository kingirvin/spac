<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    //
    protected $fillable = [
        'nombre','cantidad'
    ];
    public static function listaAreasComptencias(){
        $areas=DB::table("areas")
        ->select('areas.nombre','areas.id')
        ->get();
        foreach($areas as $area){
            $competencias=DB::table("competencias")
            ->select('competencias.nombre', 'competencias.id', 'competencias.descripcion')
            ->join('competencias_areas','competencias.id','competencias_areas.competencias_id')
            ->where('competencias_areas.areas_id',$area->id)
            ->get();
            $area->competencias=$competencias;
            $area->cantidad=count($competencias);
        }
        return $areas;
    }
}

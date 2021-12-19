<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Momento extends Model
{
    //
    protected $fillable = [
        'nombre','competencias_id','areas_id',
    ];
    public static function listarMomentosAreaCompetencia(){
        return $momento=DB::table("momentos")
            ->select('momentos.nombre as momento', 'momentos.id','areas.nombre as area','competencias.nombre as competencia')
            ->join('competencias','competencias.id','momentos.competencias_id')
            ->join('areas','areas.id','momentos.areas_id')
            ->get();
    }
    public static function listaMomentoCompetencia($competencia){
        return $momento=DB::table("momentos")
            ->select('momentos.nombre as momento')
            ->join('competencias','competencias.id','momentos.competencias_id')
            ->join('desempenos','desempenos.competencias_id','competencias.id')
            ->where('desempenos.id',$competencia)
            ->get();
    }
}

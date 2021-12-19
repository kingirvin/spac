<?php

namespace App;
use DB;
use Illuminate\Database\Eloquent\Model;

class Competencia extends Model
{
    //
    protected $fillable = [
        'nombre','descripcion',
    ];
    public static function listaCompenciasArea($id){
        return $competencias=DB::table("competencias")
            ->select('competencias.nombre', 'competencias.id', 'competencias.descripcion')
            ->join('competencias_areas','competencias.id','competencias_areas.competencias_id')
            ->where('competencias_areas.areas_id',$id)
            ->get();
    }
}

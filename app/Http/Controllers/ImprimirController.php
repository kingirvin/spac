<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Materialunidad;
use App\Unidadescompetenciasplan;
use App\Plananual;

class ImprimirController extends Controller
{
    //
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
     // pagina de Perfil
    function vistaPreviaUnidad($id)
    {
        $materiales=Materialunidad::where('unidadesPlans_id',$id)->get();    
        $unidades=Unidadescompetenciasplan::unidadesCompeteciaCapacidadPlan($id);       
        $plan=Plananual::buscarPlanAnualspoUnidadad($id);
               
        $pdf = \PDF::loadView('imprimirUnidad', compact('materiales','unidades','plan'))->setPaper('a4');
        //return $pdf->download('imprimirUnidad.pdf');        
        return $pdf->stream('imprimirUnidad.pdf');  
    } 
    public function descargarUnidad($id){
        $materiales=Materialunidad::where('unidadesPlans_id',$id)->get();    
        $unidades=Unidadescompetenciasplan::unidadesCompeteciaCapacidadPlan($id);       
        $plan=Plananual::buscarPlanAnualspoUnidadad($id);
               
        $pdf = \PDF::loadView('imprimirUnidad', compact('materiales','unidades','plan'))->setPaper('a4');
        return $pdf->download('imprimirUnidad.pdf');        
        //return $pdf->stream('imprimirUnidad.pdf');        
      
    }
}

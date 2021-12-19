<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\User;
use App\Persona;
use App\Pago;
use App\Grado;
use App\Plan;
use App\Area;
use App\Seccion;
use App\Enfoque;
use App\Competencia;
use App\Unidadesplan;
use App\Periodo;
use App\Plananual;
use App\Competenciasareasplananual;
use App\Areasplananual;
use App\Unidadescompetenciasplan;
use App\Enfoquesplan;
use App\Capacidad;
use App\Desempeno;
use App\Criterio;
use App\Evidencia;
use App\Instrumento;
use App\Actitudplan;
use App\Actitud;
use App\Situacionsignificativa;
use App\Sesionaprendizaje;
use App\Material;
use App\Materialunidad;
use App\Enfoquesesion;
use App\Materialsesion;
use App\Momento;
use App\Plancliente;
use App\Users_modulo;
use App\Desarrollo;
use Auth;

class HomeController extends Controller
{
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
    public function index()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('miPerfil');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        //return $persona[0];
        return \View::make('index')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos); 
    } 
    //pagina para editar el perfil o datos del usuario  
    public function editarPerfil()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('miPerfil');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        //return $persona[0];
        return \View::make('editarPerfil')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos); 
    } 
    // metodo para guardar los cambien en los datos del perfil del usuario
    public function guardarPerfil(Request $request)
    {       
        $user=Auth::user();
         Persona::where('id',$user->personas_id)
                ->update(['nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'nombre_ie' => $request->nombre_ie,
            'correo' => $request->email,]); 
            return redirect('/editarPerfil');           
    }
    public function listarUsuario()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('listarUsuario');
        $persona= Persona::listarPersonas(); 
        //return $persona[0];
        return \View::make('listarUsuario')
        ->with('personas',$persona)
        ->with('modulos',$modulos); 
    } 
    //pagina para ver formulario de regitro de nuevo usuario (get)
    public function nuevoUsuario()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('nuevoUsuario');
        $persona= Persona::listarPersonas(); 
        //return $persona[0];
        return \View::make('nuevoUsuario')
        ->with('personas',$persona)
        ->with('modulos',$modulos); 
    } 
    //accion del formulario de la pagina nuevoUsuario, para registrar al nuevo usuario (post) 
    public function registroUsuario(Request $request)
    {
        $persona=Persona::create([
            'nombre' => $request->nombre,
            'apellidos' => $request->apellidos,
            'telefono' => $request->telefono,
            'correo' => $request->email,
        ]);
        $user=User::create([
            'name' => $request->nombre,
            'email' =>$request->email,
            'personas_id' => $persona->id,
            'password' => Hash::make($request->password),
        ]);
        Users_modulo::create([
            'id' => $user->id,
            'users_personas_id' =>$persona->id,
            'modulos_id' =>'3',
        ]);
        Users_modulo::create([
            'id' => $user->id,
            'users_personas_id' =>$persona->id,
            'modulos_id' =>'1',
        ]);
        //definimos el area geografica del cual deseamos la fecha
        date_default_timezone_set("America/Lima");
        //extraemos la fecha usando la funcion date 
        // d: dia
        // m: mes
        // Y: ańo en cuatro dígitos
         $plan=Plan::where("id",$request->plan)->get();
        $pago=Pago::create([
            'fecha' =>  date("d/m/Y"),
            'nrocomprobante' =>$request->comprobante,
            'plans_id' =>$request->plan,
            'monto' =>$plan[0]->costo,
            'personas_id' => $persona->id,
        ]);
        $mes="";
        $estado="Vigente";
        if($pago[0]["plans_id"]==1)
            $mes=date("d")."/".(date("m")+1)."/".date("Y");
        if($pago[0]["plans_id"]==2)
            $mes=date("d")."/".(date("m")+3)."/".date("Y");
        if($pago[0]["plans_id"]==3)
            $mes=date("d")."/".date("m")."/".(date("Y")+1);
        if($mes<10){
            $mes="0".$mes;
        }
        Plancliente::create([
            'pagos_id' => $pago->id,
            'incio' =>date("d/m/Y"),
            'fin' =>$mes,
            'estado' =>$estado,
        ]);
        return redirect()->intended('nuevoUsuario');  
    } 
    
    public function activarPlan(Request $request)
    {
        //definimos el area geografica del cual deseamos la fecha
        date_default_timezone_set("America/Lima");
        //extraemos la fecha usando la funcion date 
        // d: dia
        // m: mes
        // Y: ańo en cuatro dígitos
        $mes=date("d");
        $pago=Pago::where('id',$request->cuenta)->get();
        if($pago[0]->plans_id==1)
            $mes=date("d")."/".(date("m")+1)."/".date("y");
        if($pago[0]->plans_id==2)
            $mes=date("d")."/".(date("m")+3)."/".date("y");
        if($pago[0]->plans_id==3)
            $mes=date("d")."/".date("m")."/".(date("y")+1);
        Plancliente::where('pagos_id',$request->cuenta)
                    ->update(['inicio'=>date("d/m/Y"),
                    'fin'=>$mes,
                    'estado'=>"Activo"]);
        return redirect()->intended('listarUsuario');  
    } 

//================================================================================ metodos de vista plan anual ==========================================
   
    //pagina para hacel el plan curricular anual  
    public function planAnual()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('programacionAnual');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $planAnual=Plananual::where('users_personas_id',$user->personas_id)->get();
        $grados=Grado::get();
        $seccion=Seccion::get();
        $enfoques=Enfoque::get();
        $enfoques=Enfoque::get();
        $periodos=Periodo::get();
        $areas=Area::listaAreasComptencias();
        //return $persona[0];
        return \View::make('planAnual')
        ->with('persona',$persona[0])
        ->with('grados',$grados)
        ->with('periodos',$periodos)
        ->with('planAnuals',$planAnual)
        ->with('enfoques',$enfoques)
        ->with('areas',$areas)
        ->with('seccions',$seccion)
        ->with('modulos',$modulos); 
    }  
     //Metodo par crear un plan anual en blanco de nivel primario 
    public function creaPlanAnual(Request $request)
    {
        $request->input();
        $user=Auth::user();
        //$modulos= Users_modulo::listarModulos('miPerfil');
        $persona= Persona::where('id', $user->personas_id)->get(); 

        //definimos el area geografica del cual deseamos la fecha
        date_default_timezone_set("America/Lima");
        //extraemos la fecha usando la funcion date 
        // d: dia
        // m: mes
        // Y: ańo en cuatro dígitos


        //$grados=Grado::get();
        //$seccion=Seccion::get();
        //$enfoques=Enfoque::get();
        //$areas=Area::listaAreasComptencias();
        //return $persona[0];

        $planAnual=Plananual::create([
            'nombre' => $request->nombrePlan,
            'docente' => $request->nombre,
            'nombre_ie' => $request->nombreIe,
            'descripcion' =>' ' ,
            'nivels_id' => "1",
            'users_id' =>  $user->id,
            'users_personas_id' => $user->personas_id,
            'grados_id' => $request->grado,
            'seccions_id' => $request->seccion,
            'periodos_id' => $request->periodo,
            'periodos_id' => $request->periodo,
            'fecha' =>  date("d/m/Y"),
        ]);
        $unidadesPlan;
        $unidadesPlan[1]=Unidadesplan::create([
            'nombre' => $request->unidad1,
            'descripcion' => " ",
            'unidads_id' => "1",
            'planAnual_id' => $planAnual->id,
        ]);
        $unidadesPlan[2]=Unidadesplan::create([
            'nombre' => $request->unidad2,
            'descripcion' => ' ' ,
            'unidads_id' => "2",
            'planAnual_id' => $planAnual->id,
        ]);   
        $unidadesPlan[3]=Unidadesplan::create([
            'nombre' => $request->unidad3,
            'descripcion' => ' ' ,
            'unidads_id' => "3",
            'planAnual_id' => $planAnual->id,
        ]);   
        $unidadesPlan[4]=Unidadesplan::create([
            'nombre' => $request->unidad4,
            'descripcion' => ' ' ,
            'unidads_id' => "4",
            'planAnual_id' => $planAnual->id,
        ]); 
        $unidadesPlan[5]=Unidadesplan::create([
            'nombre' => $request->unidad5,
            'descripcion' => ' ' ,
            'unidads_id' => "5",
            'planAnual_id' => $planAnual->id,
        ]); 
        $unidadesPlan[6]=Unidadesplan::create([
            'nombre' => $request->unidad6,
            'descripcion' => ' ' ,
            'unidads_id' => "6",
            'planAnual_id' => $planAnual->id,
        ]);
        $unidadesPlan[7]=Unidadesplan::create([
            'nombre' => $request->unidad7,
            'descripcion' => ' ' ,
            'unidads_id' => "7",
            'planAnual_id' => $planAnual->id,
        ]);   
        $unidadesPlan[8]=Unidadesplan::create([
            'nombre' => $request->unidad8,
            'descripcion' => ' ' ,
            'unidads_id' =>"8",
            'planAnual_id' => $planAnual->id,
        ]); 
        if($request->periodo==2){
                $unidadesPlan[9]=Unidadesplan::create([
                    'nombre' => $request->unidad9,
                    'descripcion' => ' ' ,
                    'unidads_id' => "9",
                    'planAnual_id' => $planAnual->id,
                ]);   
        }
        $unidades=Unidadesplan::where("planAnual_id",$planAnual->id)->get();
        $areas=Area::listaAreasComptencias();
        $areasPlan=null;
        $i=0;
       foreach($areas as $area){
                foreach($area->competencias as $competencia){
                    $unidadesCuso=null;
                    $areasPlanAnuals=Areasplananual::create([
                        'nombreArea' =>$area->nombre,
                        'nombreCompetencia' => $competencia->nombre,
                        'planAnuals_id' => $planAnual->id,
                        'descripcionCompetencia' => $competencia->descripcion,
                        'areas_id' => $area->id,
                        'competencias_id' => $competencia->id,
                        'cantidad' => $area->cantidad,
                    ]);
                    $j=0;
                    foreach($unidades as $unidad){
                        $unidadesCompetenciasPlans=Unidadescompetenciasplan::create([
                            'estado' => "0",
                            'areasPlanAnuals_id' => $areasPlanAnuals->id,
                            'unidadesPlans_id' => $unidad->id,
                        ]);
                        $unidadesCuso[$j]=$unidadesCompetenciasPlans;
                        $j++;
                    }
                    $areasPlanAnuals["unidades"]=$unidadesCuso;
                    $areasPlan[$i]=$areasPlanAnuals;
                    $i=$i+1;
                }
        }
        $enfoques=Enfoque::get();
        $enfoquePlan=null;
        $temp=0;
        foreach($enfoques as $enfoque){
            foreach($unidades as $unidad){
                $nuevoEfoque=Enfoquesplan::create([
                    'nombre'=> $enfoque->nombre,
                    'enfoques_id'=>$enfoque->id,
                    'estado'=>'0',
                    'unidadesPlans_id'=>$unidad->id,
                ]);
                $enfoquePlan[$temp]=$nuevoEfoque;
                $temp++;
            }
            $enfoque['enfoquePlans']=$enfoquePlan;
        }


        $planAnual->areas=$areasPlan;
        $planAnual->enfoques=$enfoques;
        $planAnual->unidades=$unidadesPlan;
        return $planAnual;
    }
    // Cambia el estado de cada competencia en una unidad( activo o desactivado)
    public function agragarUnidadCompetencia(Request $request){        
         return Unidadescompetenciasplan::where('id',$request->id)
        ->update(['estado'=>$request->estado]);
    }
    public function agragarUnidadEnfoque(Request $request){        
         return Enfoquesplan::where('id',$request->id)
        ->update(['estado'=>$request->estado]);
        return $request;
    }
    public function ActualizarUnidades(Request $request){  
        $unidades= $request->unidades;
        $nombre=$request->nombre;
        $grado=$request->grado;
        $id=$request->id;
        $seccion=$request->seccion;

        Plananual::where('id',$id)
        ->update(['nombre'=>$nombre,
                'grados_id'=>$grado,
                'seccions_id'=>$seccion]);
        //return $unidades["1"]["nombre"];
        foreach($unidades as $unidad){
             Unidadesplan::where('id',$unidad["id"])
            ->update(['nombre'=>$unidad["nombre"]]);
        } 
        return $request;
    }
    //actualiza el estado de la casilla de la unidad y los enfoques me diante el id
    public function actualizarEstadoUnidad(Request $request){ 
        $estado= Unidadescompetenciasplan::where("id",$request->id)->get();
        $valor=0;
        if($estado[0]->estado==0)
            $valor=1;   
         return Unidadescompetenciasplan::where('id',$request->id)
        ->update(['estado'=>$valor]);
    }
    public function actualizarUnidadEnfoque(Request $request){ 
        $estado= Enfoquesplan::where("id",$request->id)->get();
        $valor=0;
        if($estado[0]->estado==0)
            $valor=1;          
         return Enfoquesplan::where('id',$request->id)
        ->update(['estado'=>$valor]);
        return $request;
    }
    //vista de Actualizar planAnualpublic 
    function acutalizarPlanAnual($id)
    {
        //return $id;        
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('programacionAnual');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $planAnual=Plananual::where('users_personas_id',$user->personas_id)->get();
        $plan=Plananual::buscarPlanAnual($id);
        $grados=Grado::get();
        $seccion=Seccion::get();
        $enfoques=Enfoque::get();
        $enfoques=Enfoque::get();
        $periodos=Periodo::get();
        $areas=Area::listaAreasComptencias();
        //return $persona[0];
        return \View::make('actualizarPlanAnual')
        ->with('persona',$persona[0])
        ->with('grados',$grados)
        ->with('periodos',$periodos)
        ->with('plan',$plan)
        ->with('planAnuals',$planAnual)
        ->with('enfoques',$enfoques)
        ->with('areas',$areas)
        ->with('seccions',$seccion)
        ->with('modulos',$modulos);

    }  
//=================================================================metodos de muevo Momento=======================================================
//vsita principal
    public function nuevoMomento()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('nuevoMomento');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $areas=Area::get();
        $momentos=Momento::listarMomentosAreaCompetencia();
//return $persona[0];
        return \View::make('nuevoMomento')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos)
        ->with('momentos',$momentos)
        ->with('areas',$areas); 
    }  
    //agrega la nueva competecia a la db
    public function buscarCompetenciaCurso(Request $request){        
         return Competencia::listaCompenciasArea($request->id);
    }
    //agrega la nueva competecia a la db
    public function nuevoMomentoDatos(Request $request){   
        //return $request;     
         return Momento::create([
            'nombre' => $request->momento,
            'areas_id' => $request->area,
            'competencias_id' =>$request->competencia
        ]);
    }
//=================================================================metodos de mueva competecia=======================================================
//vsita principal
    public function nuevaCompetencia()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('nuevaConpetencia');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $competencias=Competencia::get();            
        $grados=Grado::get();
//return $persona[0];
        return \View::make('nuevaCompetencia')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos)
        ->with('grados',$grados)
        ->with('competencias',$competencias); 
    }  
    //agrega la nueva competecia a la db
    public function agregarCompetencia(Request $request){        
         return Competencia::create([
            'nombre' => $request->competencia,
            'descripcion' =>$request->descripcion
        ]);
        return $request;
    }
    // ====================================================metodos de capacidad========================================
    //Lista las capacidades de la competecia a la db
    public function listaCapacidad(Request $request){   
         return Capacidad::where("competencias_id",$request->id)->get();
    }
    //agrega la nueva capacidad a la competencia a la db
    public function nuevaCapacidad(Request $request){    
         return Capacidad::create([
            'nombre' => $request->capacidad,
            'descripcion' =>$request->descripcion,
            'competencias_id' =>$request->id
       ]);
        return $request;
    }
    //busca la capacidad seugun su idate
    public function buscarCapacidad(Request $request){   
         return Capacidad::where("id",$request->id)->get();
    }
    //Actualiza la nueva capacidad a la competencia a la db
    public function actualizarCapacidad(Request $request){    
           Capacidad::where('id',$request->idCapacidad)
            ->update(['nombre'=>$request->nombre,
                'descripcion'=>$request->descripcion]);
        return Capacidad::where("competencias_id",$request->id)->get();

    }
    //Actualiza la nueva capacidad a la competencia a la db
    public function eliminarCapacidad(Request $request){    
         Capacidad::destroy($request->idCapacidad);
         return  Capacidad::where("competencias_id",$request->id)->get();

    }
    // ====================================================metodos de desempeño========================================
    //Lista las capacidades de la competecia a la db
    public function listaDesempeno(Request $request){   
         return Desempeno::where("competencias_id",$request->id)
         ->where('grados_id',$request->grado)->get();
    }
    //agrega la nueva capacidad a la competencia a la db
    public function nuevoDesempeno(Request $request){   
         return Desempeno::create([
            'nombre' => $request->nombre,
            'grados_id' =>$request->grado,
            'competencias_id' =>$request->id
       ]);
        return $request;
    }
    //busca la capacidad seugun su idate
    public function buscarDesempeno(Request $request){   
         return Desempeno::where("id",$request->id)->get();
    }
    //Actualiza la nueva capacidad a la competencia a la db
    public function actualizarDesempeno(Request $request){    
           ;


    }
    //Actualiza la nueva capacidad a la competencia a la db
    public function eliminarDesempeno(Request $request){    
         Desempeno::destroy($request->idDesempeno);
         return  Desempeno::where("competencias_id",$request->id)->where('grados_id',$request->grado)->get();;

    }
//=================================================================metodos de muevo Enfoques Tranversales=======================================================
//vsita principal
    public function nuevEnfoque()
    {
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('nuevoEnfoque');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $enfoques=Enfoque::get();            
//return $persona[0];
        return \View::make('nuevoEnfoque')
        ->with('persona',$persona[0])
        ->with('modulos',$modulos)
        ->with('enfoques',$enfoques); 
    }  
    //agrega la nueva competecia a la db
    public function agregarEnfoque(Request $request){       
         return Enfoque::create([
            'nombre' => $request->descripcion,
            'descripcion' =>$request->descripcion
        ]);
        return $request;
    }
    // ====================================================metodos de Actitudes
    //Lista las Actitud de la competecia a la db
    public function listaActitud(Request $request){   
         return Actitud::where("enfoques_id",$request->id)->get();
    }
    //agrega la nueva Actitud a la competencia a la db
    public function nuevoActitud(Request $request){  
         return Actitud::create([
            'nombre' => $request->descripcion,
            'descripcion' =>$request->descripcion,
            'enfoques_id' =>$request->id
       ]);
        return $request;
    }
    //busca la Actitud seugun su idate
    public function buscarActitud(Request $request){   
         return Actitud::where("id",$request->id)->get();
    }
    //Actualiza la nueva Actitud a la competencia a la db
    public function actualizarActitud(Request $request){    
           Actitud::where('id',$request->idActitud)
            ->update(['nombre'=>$request->descripcion,
                'descripcion'=>$request->descripcion]);
        return Actitud::where("enfoques_id",$request->id)->get();

    }
    //Actualiza la nueva Actitud a la competencia a la db
    public function eliminarActitud(Request $request){    
         Actitud::destroy($request->idActitud);
         return  Actitud::where("enfoques_id",$request->id)->get();

    }
    //=========================================================================programación de unidades ===================================================
    //vista de principal de progración de ActualizarUnidades
    function programacionUnidad()
    {
        //return $id;        
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('programacionUnidad');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $cursos= Area::get(); 
        $materiales= Material::get(); 
        $planAnual=Plananual::where('users_personas_id',$user->personas_id)->get();
        //return $persona[0];
        return \View::make('PlanUnidades')
        ->with('persona',$persona[0])
        ->with('planes',$planAnual)
        ->with('materiales',$materiales)
        ->with('cursos',$cursos)
        ->with('modulos',$modulos);
    } 
    // busca las unidades del creaPlanAnual
    function buscarUnidadesPlan(Request $request)
    {
        $plan=Plananual::buscarGradoSeccionPeriodoPlan($request->id);        
        return $plan;
    } 
    //busca las competencias activas de una unddad
    function buscarCompetenciasnidadesPlan(Request $request)
    {
        $capacidades=Unidadescompetenciasplan::unidadesCompeteciaCapacidadPlan($request->id);        
        return $capacidades;
    } 
    //================================metodos de criterios de aprendizaje
    function nuevoDesempenoPlan(Request $request)
    {  
       $criterio= Criterio::create([
                            'nombre' =>$request->nombre,
                            'desempenos_id' => $request->desempeno,
                            'evidencia' => "",
                            'estado' => '0',
                            'areasPlanAnuals_id' => $request->areaPlan,]);        
        return $criterio;    
    } 
    //busca las criterio de la competencia
    function buscarCriterioPlan(Request $request)
    {
        $criterio=Criterio::where("id",$request->id)->get();        
        return $criterio[0];
    } 
    //actualiza las criterio de la competencia
    function actualizaCriterioPlan(Request $request)
    {
        Criterio::where('id',$request->id)
            ->update(['nombre'=>$request->nombre]);
    } 
    //actualiza las criterio de la competencia
    function eliminarCriterioPlan(Request $request)
    {  
        Criterio::destroy($request->id);
        $criterio=Criterio::where("areasPlanAnuals_id",$request->areaPlan)->get();        
        return $criterio;
    } 
    //===================================== metodos de Evidencias de apredizaje
    //actualiza las evidencia de la competencia
    function actualizaEvidencia(Request $request)
    {
        //return $request;
        Criterio::where('id',$request->id)
            ->update(['evidencia'=>$request->nombre]);
    } 
    //===================================== metodos de instrumentos de apredizaje
    //actualiza las instrumento de la competencia
    function actualizaInstrumento(Request $request)
    {
        //return $request;
        return Areasplananual::where('id',$request->id)
            ->update(['instrumento'=>$request->nombre]);
    } 
    function buscarInstrumento(Request $request)
    {
        //return $request;
        $instumento= Instrumento::where("id",$request->id)->get();
        return $instumento[0];
    } 
    function listaInstrumento(Request $request)
    {
        //return $request;
        return Instrumento::get();
    } 
    //================================metodos de criterios de aprendizaje
    function nuevoActitudPlan(Request $request)
    {  
       // return $request;
      return  Actitudplan::create([
                            'nombre' =>"",
                            'descripcion' =>"",
                            'enfoquesPlans_id' => $request->id,]);
    } 
    //busca las criterio de la competencia
    function buscarActitudPlan(Request $request)
    {
        $actitud=Actitudplan::where("id",$request->id)->get();        
        return $actitud[0];
    } 
    //actualiza las criterio de la competencia
    function actualizaActitudPlan(Request $request)
    {
        return Actitudplan::where('id',$request->id)
            ->update(['nombre'=>$request->nombre,
                    'descripcion'=>$request->nombre]);
        
    } 
    //actualiza las criterio de la competencia
    function eliminarActitudPlan(Request $request)
    {  
        return Actitudplan::destroy($request->id);
    } 
    // crea una nueva situacion
    function nuevaSituacion(Request $request)
    {  
       // return $request;
      return  Situacionsignificativa::create([
                            'nombre' =>$request->nombre,
                            'descripcion' =>$request->nombre,
                            'unidadesPlans_id' => $request->id,]);
    } 
    //actualiza situacion
    function actualizarSituacion(Request $request)
    {
        return Situacionsignificativa::where('id',$request->id)
            ->update(['nombre'=>$request->nombre,
                    'descripcion'=>$request->nombre]);        
    } 
    //nueva  sesionde aprendizaje
    function nuevaSesionAprendizaje(Request $request)
    {
        $sesion= Sesionaprendizaje::create([
                            'sesion' =>"",
                            'nombre' =>"Sin nombre",
                            'area' =>"",
                            'criterio' =>"",
                            'evidencia' =>"",
                            'area_id' =>"0",
                            'unidadesPlans_id' => $request->id,]);
         return $sesion;      
    } 
    //nueva  sesionde aprendizaje
    function listarSesionesUnidad(Request $request)
    {
        return Sesionaprendizaje::where('unidadesPlans_id',$request->id)->get();
    } 
    //nueva  sesionde aprendizaje
    function buscarCurso(Request $request)
    {
        $area=Area::where('id',$request->id)->get();
        return $area[0];
    } 
    //nueva  sesionde aprendizaje
    function listarCriteriosCurso(Request $request)
    {
        //return $request;
        $criterios=Areasplananual::listarCriteriosCurso($request->unidad,$request->curso);
        return $criterios;
    }
    //busca  sesionde aprendizaje
    function buscarCriterio(Request $request)
    {
        $criterio=Criterio::where('id',$request->id)->get();
        Criterio::where('id',$request->id)
            ->update(['estado'=>"1"]);  
        return $criterio[0];
    } 
    //actualiza  sesionde aprendizaje
    function actualizarSesion(Request $request)
    {    $request;  
        $sesion=Sesionaprendizaje::where('id',$request->id)->get();

        if($request->criterio_id!=null){
            Criterio::where('id',$sesion[0]->criterio_id)
                ->update(['estado'=>"0"]);
           $desarrollos=Desarrollo::where('sesionaprendizajes_id',$request->id)->get();
            foreach($desarrollos as $desarrollo){
                Desarrollo::destroy($desarrollo->id);
            }
            $sesion=Sesionaprendizaje::where('id',$request->id)
                    ->update([ 'sesion' =>"",
                                'nombre' =>$request->nombre,
                                'area' =>$request->area,
                                'area_id' =>$request->area_id,
                                'criterio' =>$request->criterio,
                                'criterio_id' =>$request->criterio_id,
                                'evidencia' =>$request->evidencia,]);

            $criterio=Criterio::where('id',$request->criterio_id)->get();
             $momento=Momento::listaMomentoCompetencia($criterio[0]->desempenos_id);
            foreach($momento as $item){
                Desarrollo::create([
                                'nombre' =>"",
                                'momento' =>$item->momento,
                                'sesionaprendizajes_id' => $request->id,]);
            }
            return $sesion;
        }
        else{
            Criterio::where('id',$sesion[0]->criterio_id)
                ->update(['estado'=>"0"]);          
            $sesion=Sesionaprendizaje::where('id',$request->id)
                    ->update([ 'sesion' =>"",
                                'nombre' =>$request->nombre,
                                'area' =>$request->area,
                                'area_id' =>$request->area_id,
                                'criterio' =>$request->criterio,
                                'criterio_id' =>$request->criterio_id,
                                'evidencia' =>$request->evidencia,]);
            return $sesion;
        }
    } 
    //actualiza  sesionde aprendizaje
    function actualizarNombreSesion(Request $request)
    {
        $sesion=Sesionaprendizaje::where('id',$request->id)
                 ->update(['nombre' =>$request->nombre,]);    
        return $sesion;
    } 
    //====================================metodos de Materiales de unidad 
    //actualiza  sesionde aprendizaje    
    function agregarMaterial(Request $request)
    {
        //return $request;
        $sesion=Materialunidad::create([
                'nombre' =>$request->nombre,
                'unidadesPlans_id' =>$request->id]);    
        return $sesion;
    } 
    //lista los l materialesd e la unidad
    function listarMaterialUnidad(Request $request)
    {
        $materiales=Materialunidad::where('unidadesPlans_id',$request->id)->get();    
        return $materiales;
    }  
    //lista los l materialesd e la unidad
    function eliminarMaterial(Request $request)
    {
        return Materialunidad::destroy($request->id);
    } 

//=============================================================================================metodos de Nueva nuevaSesionAprendizaje ==================================================

//vsita principal
    public function nuevaSesion()
    {
        //return $id;        
        $user=Auth::user();
        $modulos= Users_modulo::listarModulos('programacionSesion');
        $persona= Persona::where('id', $user->personas_id)->get(); 
        $cursos= Area::get(); 
        $materiales= Material::get(); 
        $planAnual=Plananual::where('users_personas_id',$user->personas_id)->get();
        //return $persona[0];
        return \View::make('PlanSesiones')
        ->with('persona',$persona[0])
        ->with('planes',$planAnual)
        ->with('materiales',$materiales)
        ->with('cursos',$cursos)
        ->with('modulos',$modulos);
    } 
    function buscarsesionesPlan(Request $request)
    {
        $sesiones=Sesionaprendizaje::where('unidadesPlans_id',$request->id)->get();    
        return $sesiones;
    }  
    function buscarsesionePlan(Request $request)
    {
        return $sesiones=Sesionaprendizaje::buscarCompetenciasCapacidadesUnidadesPlan($request->id);    
        return $sesiones;
    } 
    //crea  actitud para la sesion de aprendizaje    
    function nuevoEnfoqueSesion(Request $request)
    {    //return $request->enfoquePlan_id;
        $sesion=Enfoquesesion::create([
                'enfoquePlan_id' =>$request->enfoquePlan_id,
                'enfoque' =>$request->enfoque,
                'actitud' =>$request->actitud,
                'sesionaprendizajes_id' =>$request->id]);    
        return $sesion;
    } 
    //actualiza la actitud para la sesion de aprendizaje    
    function actualizarActitudEnfoqueSesion(Request $request)
    {
        //return $request;use App\Enfoquesesion;
        $sesion=Enfoquesesion::where('id',$request->id)
                 ->update(['actitud' =>$request->actitud,]);    
        return $sesion;
    } 
    
    //actualiza  sesionde aprendizaje    
    function listarActitudSesion(Request $request)
    {
        //return $request;use App\Enfoquesesion;

        $actitud=Actitudplan::where("enfoquesPlans_id",$request->id)->get();    
        return $actitud;
    }  
    //lista los l materialesd e la unidad
    function eliminarEnfoqueSesion(Request $request)
    {
        Enfoquesesion::destroy($request->id);
        return $enfoque=Enfoquesesion::where('sesionaprendizajes_id',$request->enfoquePlan_id)->get();  
    } //agregarMaterialSesion
    //actualiza  materia de la sision de aprendizaje    
    function agregarMaterialSesion(Request $request)
    {
        //return $request;
        $sesion=Materialsesion::create([
                'nombre' =>$request->nombre,
                'sesionaprendizajes_id' =>$request->id]);    
        return $sesion;
    } 
    //actualiza  materia de la sision de aprendizaje    
    function agregarAntesde(Request $request)
    {
        //return $request;use App\Enfoquesesion;
        $sesion=Sesionaprendizaje::where('id',$request->id)
                 ->update(['antesde' =>$request->antesde,]);    
        return $sesion;
    } 
    //actualiza  tiempor de la sesion de aprendizaje    
    function actualizarTiempoSesion(Request $request)
    {
        //return $request;use App\Enfoquesesion;
        $sesion=Sesionaprendizaje::where('id',$request->id)
                 ->update(['tiempo' =>$request->antesde,]);    
        return $sesion;
    } 
    //actualiza  la fecha de la sesion de aprendizaje    
    function actualizarFechaSesion(Request $request)
    {
        //return $request;use App\Enfoquesesion;
        $sesion=Sesionaprendizaje::where('id',$request->id)
                 ->update(['fecha' =>$request->antesde,]);    
        return $sesion;
    } 
    //lista los l materialesd e la unidad
    function eliminarSesion(Request $request)
    {
        $desarrollos=Desarrollo::where('sesionaprendizajes_id',$request->id)->get();
        foreach($desarrollos as $desarrollo){
            Desarrollo::destroy($desarrollo->id);            
        }
        $enfoques=Enfoquesesion::where('sesionaprendizajes_id',$request->id)->get();
        foreach($enfoques as $enfoque){
            Enfoquesesion::destroy($enfoque->id);            
        }
        $materiales=Materialsesion::where('sesionaprendizajes_id',$request->id)->get();
        foreach($materiales as $material){
            Materialsesion::destroy($material->id);            
        }
        $sesion=Sesionaprendizaje::where('id',$request->id)->get();
        Criterio::where('id',$sesion[0]->criterio_id)
                 ->update(['estado' =>'0',]);
        return Sesionaprendizaje::destroy($request->id);
    } 
    //actualiza  sesionde aprendizaje
    function actualizarSesionMomento(Request $request)
    {           
        return Sesionaprendizaje::where('id',$request->id)
                ->update([  'saberes' =>$request->saberes,
                            'problema' =>$request->problema,
                            'proposito' =>$request->proposito,
                            'cierre' =>$request->cierre,
                            'evaluacion' =>$request->evaluacion,
                            'tiempoInicio' =>$request->tiempoInicio,
                            'tiempoProceso' =>$request->tiempoProceso,
                            'tiempoCierre' =>$request->tiempoCierre,]);            
   }   
    //actualiza  sesionde aprendizaje sus momentos
    function actualizarSesionProceso(Request $request)
    {           
        return Desarrollo::where('id',$request->id)
                ->update([  'nombre' =>$request->texto,]);            
   }    
}

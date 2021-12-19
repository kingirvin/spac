@extends('layouts.layout')
@section('css')
		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		<link rel="stylesheet" href="css/base.css" />
@stop
@section('content')
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Administración</a>
            </li>
            <li class="active">Programación Unidades</li>
        </ul><!-- /.breadcrumb -->
    </div> 

    <div class="page-content">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h1>Programacion de Unidades</h1> 
                </div><!-- /.page-header -->  
                <div class="clearfix">         
                    <div class="col-xs-12 col-sm-4">
                        <div class="widget-box"  id="unidadesBimentrales" >
                            <div class="widget-header">
                                <h4 class="widget-title">Datos Generales</h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">                                 
                                    <div class="form-horizontal">  
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="form-field-1"> Selecione Plan </label>
                                            <div class="col-xs-12 col-sm-8">
                                                <select class="control-label col-xs-12 chosen-select" id="plan" data-placeholder="Selecione un Plan ">
                                                    <option value="">  </option>
                                                    @foreach($planes as $plan)
                                                        <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                                                    @endforeach
                                                </select>
                                            </div>                             
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="form-field-1"> Selecione Unidad </label>
                                            <div class="col-xs-12 col-sm-8">
                                                <select class="control-label col-xs-12 chosen-select" id="unidades" data-placeholder="Selecione un Plan ">
                                                    <option value="">  </option>
                                                </select>
                                            </div>                             
                                        </div>    
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-12 " style="text-align: left;" id="tipo" for="form-field-1"> Bimestre / Trimestre  : 3ro</label>                          
                                        </div>    
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-12 " style="text-align: left;" id="duracion" for="form-field-1"> Duración : </label>                          
                                        </div>    
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-12 " style="text-align: left;" id="grado" for="form-field-1"> Grado  :</label>                        
                                        </div>    
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-12 " style="text-align: left;" id="seccion" for="form-field-1"> Sección :</label>                        
                                        </div>    
                                        <div class="form-group" id="crearPdf">
                                            
                                        </div>                                       
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                    </div><!-- /.span -->
                </div><!-- /.span -->
                <div class="clearfix">
                    <div>
                        <div class="col-xs-12" style="top: 10px;" >
                            <h3 class="header smaller lighter purple">1.-PROPÓSITOS Y EVIDENCIA DE APRENDIZAJE  <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
											</h3>
                            <table id="unidad-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" colspan="4">PROPÓSITOS DE APRENDIZAJE</th>
                                    </tr>
                                    <tr>
                                        <th class="center" style="width: 15%;">Capacidades</th>
                                        <th class="detail-col">Desempeños</th>
                                        <th class="detail-col" style="width: 25%;">Evidencias de aprendizaje</th>
                                        <th class="detail-col" style="width: 10%;">Instrumentos de valoración</th>
                                    </tr>
                                </thead>                           
                                <tbody id="tbodyid"></tbody>
                            </table>
                            <table id="enfoques-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" colspan="2">ENFOQUES TRANSVERSALES</th>
                                    </tr>
                                    <tr>
                                        <th class="detail-col" style="width: 15%;">Capacidades</th>                                       
                                        <th class="detail-col">Actividades o actitudes observables</th>                                       
                                    </tr>
                                </thead>                           
                                <tbody id="tbodyEnfoques">     

                                </tbody>
                            </table>
                        </div><!-- /.span -->
                        <div class="col-xs-12" style="top: 10px;" >
                            <h3 class="header smaller lighter purple">2 .-SITUACIÓN SIGNIFICATIVA  <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
                            <div id="divSituacion">
                                <textarea disabled id="texareaSituacion1" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;"></textarea>
                                <span class="pink" id="btnEditarSituacion1" ><i class="ace-icon fa fa-pencil green"></i><a href="#situacionSignificativa1" role="button" class="blue" onclick="editarCriterio(5,1)"> Editar </a></span>
                                <span class="pink"  id="btnGuardarSituacion1"  style="display:none"><i class="ace-icon fa fa-floppy-o green"></i><a href="#situacionSignificativa1" role="button" class="blue" onclick="crearSituacion()"> Guardar </a></span>
                            </div>
                        </div><!-- /.span -->
                        <div class="col-xs-12" style="top: 10px;" id="sesionesAprendizaje">
                            <h3 class="header smaller lighter purple">3 .-SECUENCIA DE SESIONES DE APRENDIZAJE   <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
                            <h5><span class="pink"><i class="ace-icon fa fa-pencil green"></i><a href="#sesionesAprendizaje" role="button" class="blue" onclick="nuevaSesionAprendizaje()"> Nueva sesión de aprendizaje</a></span></h5>
                            <table id="sesion-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" colspan="6">PROPÓSITOS DE APRENDIZAJE</th>
                                    </tr>
                                    <tr>
                                        <th class="detail-col">SESIÓN</th>
                                        <th class="detail-col">NOMBRE</th>
                                        <th class="detail-col">ÁREA</th>
                                        <th class="detail-col">DESEMPEÑO</th>
                                        <th class="detail-col">EVIDENCIA</th>
                                        <th class="detail-col">OPCIONES</th>
                                    </tr>
                                </thead>  
                                <tbody id="tbodySesiones">   
                                         
                                </tbody>
                            </table>
                        </div><!-- /.span -->
                        <div class="col-xs-12" style="top: 10px;" id="sesionesAprendizaje">
                            <h3 class="header smaller lighter purple">4 .-MATERIALES BASICOS O RECURSOS A UTILIZAR  <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
                            <div class="col-xs-12 col-sm-4">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" id="textMaterial" placeholder="Ingrese material" class="col-xs-10 col-sm-12">
                                        <span class="pink">
                                            <i class="ace-icon fa fa-pencil green"></i>
                                            <a href="#listaMateriales" role="button" class="blue" onclick="agregarMaterial()"> Guardar  </a>
                                        </span>   
                                        <span class="pink" style="float: right;">
                                            <i class="ace-icon fa fa-pencil green"></i>
                                            <a href="#modal-Materiales" role="button" class="blue" data-toggle="modal">  Ver lista de materiales </a>
                                        </span>                                             
                                    </div>
                                    <div  class="col-sm-12"> 
                                        <h5>Materiales elegidos</h5>                            
                                        <ul id="listaMateriales">
                                        </ul>
                                    </div>  
                                </div> 
                            </div>
                        </div><!-- /.span -->
                        <div class="col-xs-12" style="top: 10px;margin-bottom: 100px" id="sesionesAprendizaje">
                            <h3 class="header smaller lighter purple">5 .-REFLEXIONES SOBRE LOS APRENDIZAJES <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
                            <div class="col-xs-12">
                                <table id="reflexiones-table" class="table  table-bordered table-hover">                                     
                                    <thead>
                                        <tr>
                                            <th class="detail-col">QUE LOGRARON LOS ESTUDIENTES EN ESTA UNIDAD</th>
                                            <th class="detail-col">QUE DIFICULTADES SE OBSERVARON DURANTE EL APRENDIZAJE Y LA ENSEÑANZA</th>
                                        </tr>
                                    </thead>  
                                    <tbody id="tbodyRefelxiones">   
                                        <tr>
                                            <td class="detail-col">¿Qué avances tuvieron mis estudiantes?</td>
                                            <th class="detail-col"></th>
                                        </tr>
                                        <tr>
                                            <td class="detail-col">¿Qué dificultades tuvieron mis estudiantes?</td>
                                            <td class="detail-col"></td>
                                        </tr>
                                        <tr>
                                            <td class="detail-col">¿Qué actividades, estrategias y materiales funcionaron y cuáles no?</td>
                                            <td class="detail-col"></td>
                                        </tr>                                            
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- /.span -->
                    
                    </div>
                </div>	
                <div class="clearfix">
                    <div>
                        <div class="col-xs-6" style="top: 10px;top: 10px;text-align: center;" >
                            <div class="col-xs-6">
                                <h3 class="header smaller lighter purple"></h3>
                                <label for="">Docente</label>
                            </div>
                        </div><!-- /.span -->
                        <div class="col-xs-6" style="top: 10px;top: 10px;text-align: center;" >
                            <div class="col-xs-6">
                                <h3 class="header smaller lighter purple"></h3>
                                <label for="">Director</label>
                            </div>
                        </div><!-- /.span -->
                    
                    </div>
                </div>					
                @csrf
                <div class="row">  
                </div>
                <!-- PAGE CONTENT ENDS -->
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.page-content -->
</div>
    
<!-- Modal===================================================================================================================================-->
<div id="modal-form" class="modal bd-example-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Lista de Desempeños de Competencia ""</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <div class="form-group">
                            <label for="form-field-select-3">Desempeños</label>
                            <div>
                                <select class="col-xs-12 col-sm-12 chosen-select" data-placeholder="Eliga un Desempeño" id="desempeno">
                                    <option value="">&nbsp;</option>
                                </select>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Desempeño</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <textarea class="form-control" rows="18" placeholder="Default Text" id="textdesempeno" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Criterio de Evaluación</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <textarea class="form-control" rows="18"placeholder="Default Text" id="textdesempenoEditable"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    cancelar
                </button>

                <button class="btn btn-sm btn-primary" onclick="agregarDesempeno()">
                    <i class="ace-icon fa fa-check"></i>
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>
    
<!-- Modal Editar Materiales===================================================================================================================================-->
<div id="modal-Materiales" class="modal bd-example" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Materiales</h4>
            </div>

            <div class="modal-body">
                <div class="row">                          
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Lista de materiales</h4>
                            </div>
                            <div class="widget-body">
                                <div class="widget-main">
                                    <table class="table  table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>NOMBRE</th>
                                                <th>OPCIÓN</th>
                                            </tr>
                                        </thead>
                                        <tbody id="tbodyListaMateriales">
                                            <?php
                                            $indice=1;
                                            ?>
                                            @foreach($materiales as $material)
                                            <tr>
                                                <td> <label for="">{{$indice}}</label</td>
                                                <td> <label for="" id="lblMateriales{{$material->id}}">{{$material->nombre}}</label</td>
                                                <td> <span class="pink"><i class="ace-icon fa fa-check-square-o"></i><a href="#" role="button" class="blue" onclick="elegirMaterial({{$material->id}})"> Elegir</a></span></td>
                                            </tr> 
                                            
                                            <?php
                                            $indice++;
                                            ?>     
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    cancelar
                </button>
            </div>
        </div>
    </div>
</div>
    
<!-- Modal Editar/nuevo Evidencia===================================================================================================================================-->
<div id="modal-Evidencia" class="modal bd-example-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Evidencias de aprendizaje</h4>
            </div>

            <div class="modal-body">
                <div class="row">                       
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Evidencia</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <textarea class="form-control" rows="18"placeholder="Ingrese evidencia de aprendizaje" id="textEvidencia"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->
                </div>
            </div>

            <div class="modal-footer">
                <div id="btnNuevaEnivencia">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        cancelar
                    </button>

                    <button class="btn btn-sm btn-primary" id="btnNuevaEnivencia" onclick="nuevaEvidencia()">
                        <i class="ace-icon fa fa-check"></i>
                        Agregar
                    </button>
                </div>
                <div id="btnActualizarEvidencia" style="display:none">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        cancelar
                    </button>
                    <button class="btn btn-sm btn-primary"  onclick="actualizarEvidencia()">
                        <i class="ace-icon fa fa-check"></i>
                        Guardar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal Editar/nuevo Instrumento===================================================================================================================================-->
<div id="modal-Lista" class="modal bd-example-modal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Instrumentos de aprendizaje</h4>
            </div>

            <div class="modal-body">
                <div class="row">                       
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-body">
                            <div class="widget-main">
                                <table id="lista-table" class="table  table-bordered table-hover">                                     
                                    <thead>
                                        <tr>
                                            <th class="detail-col" colspan="6">PROPÓSITOS DE APRENDIZAJE</th>
                                        </tr>
                                        <tr>
                                            <th class="detail-col">SESIÓN</th>
                                            <th class="detail-col">NOMBRE</th>
                                            <th class="detail-col">ÁREA</th>
                                            <th class="detail-col">DESEMPEÑO</th>
                                            <th class="detail-col">EVIDENCIA</th>
                                            <th class="detail-col">OPCIONES</th>
                                        </tr>
                                    </thead>  
                                    <tr id="tbodyInstrumentos">
                                    </tr>
                                    <tbody>        
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div><!-- /.span -->
                </div>
            </div>

            <div class="modal-footer">
                <div id="btnNuevaInstrumento">
                    <button class="btn btn-sm" data-dismiss="modal">
                        <i class="ace-icon fa fa-times"></i>
                        Cancelar
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>    
<!-- Modal===================================================================================================================================-->
<div id="modal-Enfoque" class="modal bd-example-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Lista de Acciones o actitudes</h4>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-xs-12 col-sm-7">
                        <div class="form-group">
                            <label for="form-field-select-3">Acciones o Actitudes</label>
                            <div>
                                 <select class="col-xs-12 col-sm-12 chosen-select" data-placeholder="Eliga un Desempeño" id="actitudes">
                                    <option value="">&nbsp;</option>
                                </select>
                            </div>
                        </div>
                    </div>                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Accion o Actitud</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <textarea class="form-control" rows="18" placeholder="Default Text" id="textActitud" disabled></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->                    
                    <div class="col-xs-12 col-sm-6">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Accion o Actitud</h4>
                            </div>

                            <div class="widget-body">
                                <div class="widget-main">
                                    <div>
                                        <textarea class="form-control" rows="18"placeholder="Default Text" id="textActitudEditable"></textarea>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div><!-- /.span -->
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    cancelar
                </button>

                <button class="btn btn-sm btn-primary" onclick="agregarActitud()">
                    <i class="ace-icon fa fa-check"></i>
                    Agregar
                </button>
            </div>
        </div>
    </div>
</div>
    
<!-- Modal lita los Cursos===================================================================================================================================-->
<div id="modal-Cusos" class="modal bd-example-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Cursos</h4>
            </div>

            <div class="modal-body">
                <div class="row">       
                    <div class="widget-main">
                        <table id="table-Cursos"  class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>OPCIÓN</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $count=1;
                                ?> 
                                @foreach($cursos as $curso)
                                    <tr>
                                        <td> <label for="">{{$count}}</label></td>
                                        <td> <label for="">{{$curso->nombre}}</label></td>
                                        <td>
                                            <span class="pink"><i class="ace-icon fa fa-check-square-o"></i><a href="#role="button" class="blue" onclick="elegirCurso({{$curso->id}})"> Elegir</a></span>
                                        </td>
                                    </tr>                                                
                                <?php
                                    $count++
                                ?> 
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    cancelar
                </button>
            </div>
        </div>
    </div>
</div>    
<!-- Modal Criterios de cada curso===================================================================================================================================-->
<div id="modal-ListaCriterios" class="modal bd-example-modal-lg" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Criterios/Desempeños</h4>
            </div>

            <div class="modal-body">
                <div class="row">       
                    <div class="widget-main">
                        <table class="table  table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>NOMBRE</th>
                                    <th>OPCIÓN</th>
                                </tr>
                            </thead>
                            <tbody id="tbodyListaCriterios">
                                <tr>
                                    <td> <label for="">{{$count}}</label</td>
                                    <td> <label for="">{{$curso->nombre}}</label></td>
                                    <td>
                                        <span class="pink"><i class="ace-icon fa fa-check-square-o"></i><a href="#role=" button" class="blue" onclick="elegirCurso({{$curso->id}})"> Elegir</a></span>
                                    </td>
                                </tr>      

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button class="btn btn-sm" data-dismiss="modal">
                    <i class="ace-icon fa fa-times"></i>
                    cancelar
                </button>
            </div>
        </div>
    </div>
</div>
@stop
@section('jss')
		<script src="js/planUnidad.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>

		
		<script type="text/javascript">
			jQuery(function($) {			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize			
					
				}										
			});
            /////////
            $('#modal-form input[type=file]').ace_file_input({
                style:'well',
                btn_choose:'Drop files here or click to choose',
                btn_change:null,
                no_icon:'ace-icon fa fa-cloud-upload',
                droppable:true,
                thumbnail:'large'
            })
            
            //chosen plugin inside a modal will have a zero width because the select element is originally hidden
            //and its width cannot be determined.
            //so we set the width after modal is show
            $('#modal-Enfoque').on('shown.bs.modal', function () {
                if(!ace.vars['touch']) {
                    $(this).find('.chosen-container').each(function(){
                        $(this).find('a:first-child').css('width' , '810px');
                        $(this).find('.chosen-drop').css('width' , '810px');
                        $(this).find('.chosen-search input').css('width' , '800px');
                    });
                }
            })
            
            //chosen plugin inside a modal will have a zero width because the select element is originally hidden
            //and its width cannot be determined.
            //so we set the width after modal is show
            $('#modal-form').on('shown.bs.modal', function () {
                if(!ace.vars['touch']) {
                    $(this).find('.chosen-container').each(function(){
                        $(this).find('a:first-child').css('width' , '810px');
                        $(this).find('.chosen-drop').css('width' , '810px');
                        $(this).find('.chosen-search input').css('width' , '800px');
                    });
                }
            })
			
		</script>
@stop

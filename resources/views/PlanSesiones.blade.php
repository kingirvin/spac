@extends('layouts.layout')
@section('css')
		<link rel="stylesheet" href="assets/css/chosen.min.css" />
		<link rel="stylesheet" href="css/base.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-datepicker3.min.css" />
		<link rel="stylesheet" href="assets/css/bootstrap-timepicker.min.css" />
        <style type="text/css">
            /*tr:nth-of-type(5) td:nth-of-type(1) {
                visibility: hidden;
            }*/
            .rotate {                
                writing-mode: vertical-lr;
                transform: rotate(180deg);
                text-align: center;
            }
    </style>
@stop
@section('content')
<div class="main-content-inner">
    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
        <ul class="breadcrumb">
            <li>
                <i class="ace-icon fa fa-home home-icon"></i>
                <a href="#">Administración</a>
            </li>
            <li class="active">Programación Sesiones</li>
        </ul><!-- /.breadcrumb -->
    </div> 

    <div class="page-content">

        <div class="row">
            <div class="col-xs-12">
                <div class="page-header">
                    <h1>Programacion de Sesión</h1> 
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
                                                <select class="control-label col-xs-12 chosen-select" id="unidades" data-placeholder="Selecione un Unidad ">
                                                    <option value="">  </option>
                                                </select>
                                            </div>                             
                                        </div> 
                                        <div class="form-group">
                                            <label class="control-label col-xs-12 col-sm-4 no-padding-right" for="form-field-1"> Selecione Sesión </label>
                                            <div class="col-xs-12 col-sm-8">
                                                <select class="control-label col-xs-12 chosen-select" id="sesiones" data-placeholder="Selecione un Sesion ">
                                                    <option value="">  </option>
                                                </select>
                                            </div>                             
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
                            <h3 class="header smaller lighter purple">1.-DATOS INFORMATIVOS <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
											</h3>
                            <table id="datos-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" style="width: 20%;">DOCENTE</th>
                                        <td class="detail-col" style="background: white;width: 30%;" colspan="3"><p id="pDocente"></p></td>
                                        <th class="detail-col" style="width: 15%;">ÁREA</th>
                                        <td class="detail-col" style="background: white;width: 20%;" colspan="5"><p id="pArea"></p></td>
                                    </tr>
                                    <tr>
                                        <th class="center" style="background: white;width: 20%;">GRADO</th>
                                        <td class="detail-col" style="background: white;width: 10%;"><p id="pGrado"></p></td>
                                        <th class="detail-col" style="width: 15%;">SESSIÓN</th>
                                        <td class="detail-col" style="background: white;"><p id="pSession"></p></td>
                                        <th class="detail-col" style="width: 20%;">DURACIÓN</th>
                                        <td class="detail-col" style="background: white;width: 10%;">
                                            <input type="text" style="width: 50px;" id="textDuracion" placeholder="0" class="col-xs-10 col-sm-5" onchange="cambiarTiempoSesion()"> <span><h5> Min</h5></span>
                                        </td>
                                        <th class="detail-col" style="width: 10%;">FECHA</th>
                                        <td class="detail-col" style="background: white;">        
                                            <div class="input-group">
                                                <input class="form-control date-picker" id="fecha" type="text" data-date-format="dd-mm-yyyy" onchange="cambiarFechaSesion()" placeholder="dd-mm-yyyy">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar bigger-110"></i>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </thead>                           
                                <tbody></tbody>
                            </table>
                        </div><!-- /.span -->                    
                    </div>
                </div>
                <div class="clearfix">
                    <div>
                        <div class="col-xs-12" style="top: 10px;" >
                            <h3 class="header smaller lighter purple">2.-APRENDIZAJES ESPERADOS <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
											</h3>
                            <table id="datos-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" colspan="3">PROPÓSITOS DE APRENDIZAJE</th>
                                    </tr>
                                    <tr>
                                        <th class="center">COMPETENCIAS Y CAPACIDADES</th>
                                        <td class="detail-col">DESEMPEÑO</p></td>
                                        <th class="detail-col">EVIDENCIA DE APRENDIZAJE</th> 
                                    </tr>
                                </thead>                           
                                <tbody id="tbodyCompetencias">
                                    <td><div id="divCompetencia"></div></td>
                                    <td><p id="pDesempeno"></p></td>
                                    <td style="width: 20%;"><p id="pEvidencia"></p></td>
                                </tbody>
                            </table>
                            <h5><span class="pink"><i class="ace-icon fa fa-pencil green"></i><a href="#modal-Enfoque"  data-toggle="modal" role="button" class="blue"> Nuevo enfoque sesión</a></span></h5>
                            <table class="table  table-bordered table-hover" id="enfoque-tabla">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" style="width: 30%;">ENFOQUES TRANSVERSALES</th>
                                        <th class="detail-col">ACTITUDES Y/O ACCIONES OBSERVABLES</th>
                                    </tr>
                                </thead>                           
                                <tbody id="tbodyEnfoqueSesion">   

                                </tbody>
                            </table>
                        </div><!-- /.span -->                    
                    </div>
                </div>	
                <div class="clearfix">
                    <div>
                        <div class="col-xs-12" style="top: 10px;" >
                            <h3 class="header smaller lighter purple">3.-PREPARACION DE LA SESION DE APRENDIZAJE <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
											</h3>
                            <table id="datos-table" class="table  table-bordered table-hover">                                     
                                <thead>
                                    <tr>
                                        <th class="detail-col" colspan="2">ANTES DE LA SESIÓN</th>
                                    </tr>
                                    <tr>
                                        <th class="center"style="width: 70%;">¿qué necesitamos hacer antes de la sesión?  </th>
                                        <td class="detail-col">¿Qué recursos o materiales se necesitara?</p></td>
                                    </tr>
                                </thead>                           
                                <tbody id="tbodyRecursos">
                                    <td> <textarea  id="textHacerAntes" onchange="cambiarAntesde()" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;" ></textarea>                                   
                                    <td>
                                        <div class="form-group">
                                            <div class="col-sm-12">
                                                <input type="text" id="textMaterial" placeholder="Ingrese material" class="col-xs-10 col-sm-12">
                                                <span class="pink">
                                                    <i class="ace-icon fa fa-floppy-o green"></i>
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
                                    </td>
                                </tbody>
                            </table>
                        </div><!-- /.span -->                    
                    </div>
                </div>	
                <div class="clearfix">
                    <div>
                        <div class="col-xs-12" style="top: 10px;" >
                            <h3 class="header smaller lighter purple">4.-MOMENTOS EN LA SESSIÓN <small> <span class="pink"><i class="ace-icon fa fa-comment"></i><a href="#sesionesAprendizaje" role="button" class="blue"> Guia</a></span></small></h3>
											</h3>
                            <div id="momentos">
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
 
<!-- Modal Editar Materiales===================================================================================================================================-->
<div id="modal-Enfoque" class="modal bd-example" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Enfoques de la Unidad</h4>
            </div>

            <div class="modal-body">
                <div class="row">                          
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Lista de enfoques</h4>
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
                                        <tbody id="tbodyListaEnfoques">
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
<!-- Modal Editar Materiales===================================================================================================================================-->
<div id="modal-Actitud" class="modal bd-example" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="blue bigger">Actitudes o acciones observables</h4>
            </div>

            <div class="modal-body">
                <div class="row">                          
                    <div class="col-xs-12 col-sm-12">
                        <div class="widget-box">
                            <div class="widget-header">
                                <h4 class="widget-title">Lista de Actitudes o acciones observables</h4>
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
                                        <tbody id="tbodyListaActitud">
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
@stop
@section('jss')
		<script src="js/planSesion.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>
		<script src="assets/js/bootstrap-datepicker.min.js"></script>
		<script src="assets/js/bootstrap-timepicker.min.js"></script>


		
		<script type="text/javascript">
			jQuery(function($) {			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize			
					
				}
                
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				}) 
                
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				              
				
						
			});           
			
		</script>
@stop

@extends('layouts.layout')
@section('content')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Administración</a>
                </li>
                <li class="active">Mis Datos</li>
            </ul><!-- /.breadcrumb -->
        </div> 
 
        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Plan Curricular Anual</h1>
                    </div><!-- /.page-header -->
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>					
                    @csrf
                    <div class="row">                    
                        <div class="col-xs-12 col-sm-4" id="datosPlan">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title">Datos Generales</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <input type="hidden" id="idPlan" name ="idPlan">
                                        <div >
                                            <label class="form-field-8" for="form-field-1"> Nombre del Plan </label>
                                            <input type="text" id="nombrePlan" name="nombrePlan" placeholder="Nombre Plan" class="form-control" />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1"> Institucion Educativa </label>
                                            <input type="text" id="nombre_ie" name="nombre_ie" value="{{$persona->nombre_ie}}" placeholder="Username" class="form-control" readonly=»readonly />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1"> Docente </label>
                                            <input type="text" id="nombreDocente" name="nombreDocente" value="{{$persona->nombre}} {{$persona->apellidos}}" placeholder="Username" class="form-control" readonly=»readonly/>
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1"> Grado </label>
                                            <select class="form-control" id="grado" name="grado">
                                            @foreach($grados as $grado)
                                                <option value="{{$grado->id}}">{{$grado->nombre}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1"> Seccion </label>
                                            <select class="form-control" id="seccion" name="seccion">
                                            @foreach($seccions as $seccion)
                                                <option value="{{$seccion->id}}">{{$seccion->nombre}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                        <div>
                                            <label for="form-field-8">Seleccione</label>
                                            <select class="form-control" id="periodo" name="periodo">
                                            @foreach($periodos as $periodo)
                                                <option value="{{$periodo->id}}">{{$periodo->nombre}}</option>
                                            @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.span -->
           
                        <div class="col-xs-12 col-sm-4">
                            <div class="widget-box"  id="unidadesBimentrales" >
                                <div class="widget-header">
                                    <h4 class="widget-title">Nombre de unidades</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">
                                        <div >
                                            <label class="form-field-8" for="form-field-1" id="bimentre1">1° Bimentre </label>
                                            <label class="form-field-8" for="form-field-1" id="trimestre1" style="display:none">1° Trimestre</label>
                                           <input type="text" id="unidad1" name="unidad1" placeholder="Unidad 1" class="form-control" />
                                        </div>
                                        <div >
                                            <input type="text" id="unidad2" name="unidad2" placeholder="Unidad 2" class="form-control" style="margin-top: 5px;" />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1" id="bimentre2"> 2° Bimenstre </label>
                                            <input type="text" id="unidad3" name="unidad3" placeholder="Unidad 3" class="form-control" style="margin-top: 5px;" />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1" id="trimestre2" style="display:none">2° Trimestre</label>
                                            <input type="text" id="unidad4" name="unidad4" placeholder="Unidad 4" class="form-control" style="margin-top: 5px;" />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1" id="bimentre3"> 3° Bimentre </label>
                                            <input type="text" id="unidad5" name="unidad5" placeholder="Unidad 5" class="form-control"  style="margin-top: 5px;"/>
                                        </div>
                                        <div >
                                            <input type="text" id="unidad6" name="unidad6" placeholder="Unidad 6" class="form-control" style="margin-top: 5px;" />
                                        </div>
                                        <div >
                                            <label class="form-field-8" for="form-field-1" id="bimentre4"> 4° Bimestre  </label>
                                            <label class="form-field-8" for="form-field-1" id="trimestre3" style="display:none">3° Trimestre</label>

                                            <input type="text" id="unidad7" name="unidad7" placeholder="Unidad 7" class="form-control" style="margin-top: 5px;"/>
                                        </div>
                                        <div >
                                            <input type="text" id="unidad8" name="unidad8" placeholder="Unidad 8" class="form-control" style="margin-top: 5px;"/>
                                        </div>
                                        <div id="divUnidad9" style="display:none" >
                                            <input type="text" id="unidad9" name="unidad9" placeholder="Unidad 9" class="form-control" style="margin-top: 5px;" />
                                        </div>                                        
                                        <div  id="divGuardarUnidad">
                                            <span class="btn btn-success btn-sm tooltip-success" data-rel="tooltip" data-placement="right" title="Right Success" id="btnGuardarUnidad" style="margin-top: 5px; ">Gerenar Plan Anual</span>
                                        </div>                                    
                                        <div  id="divActualizarUnidad"style="display:none">
                                            <span  class="btn btn-success btn-sm tooltip-success" data-rel="tooltip" data-placement="right" title="Right Success" id="btnActualizarUnidad" style="margin-top: 5px; ">Actualizar Unidades</span>
                                            <span  class="btn btn-success btn-sm tooltip-success" data-rel="tooltip" data-placement="right" title="Right Success" id="btnNuevoPlan" style="margin-top: 5px; ">Nuevo Plan </span>
                                        </div>
                                         
                                   </div>
                                </div>
                            </div>
                        </div><!-- /.span -->
           
                        <div class="col-xs-12 col-sm-4">
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title">Historial</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">                                       
										<div>
											<table id="historal-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>Nombre</th>
														<th>
															<i class="ace-icon fa fa-clock-o bigger-110 hidden-480"></i>
															Fecha
														</th>
														<th class="hidden-480">Estado</th>
														<th></th>
													</tr>
												</thead>

												<tbody>
                                                 @foreach($planAnuals as $planAnual)
													<tr>
														<td>
															<a href="#">{{$planAnual->nombre}}</a>
														</td>
                                                        <td>{{$planAnual->fecha}}</td>

														<td class="hidden-480">
															<span class="label label-sm label-warning">Incompleto</span>
														</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<a class="green" href="acutalizarPlanAnual{{$planAnual->id}}">
																	<i class="ace-icon fa fa-pencil bigger-130"></i>
																</a>
																<a class="red" href="#" onclcik="eliminarPlan({{$planAnual->id}}">
																	<i class="ace-icon fa fa-trash-o bigger-130"></i>
																</a>
															</div>
															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<a href="#" class="tooltip-info" data-rel="tooltip" title="View">
																				<span class="blue">
																					<i class="ace-icon fa fa-search-plus bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
																				<span class="green">
																					<i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
																				</span>
																			</a>
																		</li>

																		<li>
																			<a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
																				<span class="red">
																					<i class="ace-icon fa fa-trash-o bigger-120"></i>
																				</span>
																			</a>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
													</tr>
                                                    @endforeach
												</tbody>
											</table>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- /.span -->
                        
                        <div class="clearfix">
                            <div class="pull-right tableTools-container"></div>
                        </div>
                        <div id="tablasPlan" style="display:none">
                            <div id="tablaBimestral">
                                <div class="col-xs-12" style="top: 10px;" >
                                    <table id="tablaPlanBimestre" class="table  table-bordered table-hover">                                     
                                        <thead>
                                            <tr>
                                                <th class="detail-col" rowspan="5">Areas</th>
                                                <th class="detail-col" rowspan="5">N°</th>
                                                <th class="detail-col" rowspan="5">PROPÓSITOS DE APRENDIZAJE: COMPETENCIAS Y ENFOQUES TRANSVERSALES</th>
                                                <th class="detail-col" colspan="8">Organizacion y distribucion de tiempo</th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col" colspan="2">1° Bimenstre</th>
                                                <th class="detail-col" colspan="2">2° Bimenstre</th>
                                                <th class="detail-col" colspan="2">3° Bimenstre</th>
                                                <th class="detail-col" colspan="2">4° Bimenstre</th>
                                            </tr>
                                            <tr>

                                                <th id="unidad1" class="detail-col">Unidad 1</th>
                                                <th id="unidad2" class="detail-col">Unidad 2</th>
                                                <th id="unidad3" class="detail-col">Unidad 3</th>
                                                <th id="unidad4" class="detail-col">Unidad 4</th>
                                                <th id="unidad5" class="detail-col">Unidad 5</th>
                                                <th id="unidad6" class="detail-col">Unidad 6</th>
                                                <th id="unidad7" class="detail-col">Unidad 7</th>
                                                <th id="unidad8" class="detail-col">Unidad 8</th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB1">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB2">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB3">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB4">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB5">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB6">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB7">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadB8">Nombre de la unidad</label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                            </tr>
                                        </thead>                           
                                        <tbody>                                
                                        <?php
                                            $contador=1;
                                        ?>  
                                        @foreach($areas as $area)
                                            <?php
                                                $i=$area->cantidad
                                            ?>       
                                                @foreach($area->competencias as $competencias)
                                                    @if($i==$area->cantidad)                                                                     
                                                        <tr>  
                                                            <td class="center" rowspan="{{$area->cantidad}}">{{$area->nombre}}</td>
                                                            <td>{{$contador}}</td>
                                                            <td>{{$competencias->nombre}}</td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},0)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},1)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},2)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},3)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},4)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},5)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},6)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},7)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <?php
                                                                $i--;
                                                                $contador=$contador+1;
                                                            ?>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{$contador}}</td>
                                                            <td>{{$competencias->nombre}}</td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},0)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},1)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},2)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},3)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},4)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},5)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},6)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},7)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <?php
                                                            $contador=$contador+1;
                                                            ?>
                                                        </tr>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <thead> 
                                            <tr>
                                                <th class="detail-col" colspan="3">ENFOQUES TRANSVERSALES</th>
                                                <th class="detail-col">Unidad 1</th>
                                                <th class="detail-col">Unidad 2</th>
                                                <th class="detail-col">Unidad 3</th>
                                                <th class="detail-col">Unidad 4</th>
                                                <th class="detail-col">Unidad 5</th>
                                                <th class="detail-col">Unidad 6</th>
                                                <th class="detail-col">Unidad 7</th>
                                                <th class="detail-col">Unidad 8</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                                                    
                                        <?php
                                            $tempEnfoque=0;
                                        ?>                           
                                            @foreach($enfoques as $enfoque)
                                                <tr>
                                                    <td colspan="3">{{$enfoque->nombre}}</td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},0)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},1)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},2)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},3)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},4)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},5)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},6)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},7)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                </tr>
                                                                    
                                            <?php
                                                $tempEnfoque=$tempEnfoque+1;
                                            ?> 
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div><!-- /.span -->

                            </div>
                            <div id="tablaTimestral" style="display:none">
                                <div class="col-xs-12" style="top: 10px;" >
                                    <table id="tablaPlanTrimestre" class="table  table-bordered table-hover">                                     
                                        <thead>
                                            <tr>
                                                <th class="detail-col" rowspan="5">Areas</th>
                                                <th class="detail-col" rowspan="5">N°</th>
                                                <th class="detail-col" rowspan="5">PROPÓSITOS DE APRENDIZAJE: COMPETENCIAS Y ENFOQUES TRANSVERSALES</th>
                                                <th class="detail-col" colspan="8">Organizacion y distribucion de tiempo</th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col" colspan="3">1° Trimestre</th>
                                                <th class="detail-col" colspan="3">2° Trimestre</th>
                                                <th class="detail-col" colspan="3">3° Trimestre</th>
                                            </tr>
                                            <tr>

                                                <th class="detail-col">Unidad 1</th>
                                                <th class="detail-col">Unidad 2</th>
                                                <th class="detail-col">Unidad 3</th>
                                                <th class="detail-col">Unidad 4</th>
                                                <th class="detail-col">Unidad 5</th>
                                                <th class="detail-col">Unidad 6</th>
                                                <th class="detail-col">Unidad 7</th>
                                                <th class="detail-col">Unidad 8</th>
                                                <th class="detail-col">Unidad 9</th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT1">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT2">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT3">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT4">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT5">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT6">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT7">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT8">Nombre de la unidad</label>
                                                </th>
                                                <th class="detail-col">
                                                    <label for=""id="unidadT9">Nombre de la unidad</label>
                                                </th>
                                            </tr>
                                            <tr>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanas</th>
                                                <th class="detail-col">4 Semanasss</th>
                                            </tr>
                                        </thead>                           
                                        <tbody>                                
                                        <?php
                                            $contador=1;
                                        ?>  
                                        @foreach($areas as $area)
                                            <?php
                                                $i=$area->cantidad
                                            ?>       
                                                @foreach($area->competencias as $competencias)                                                                       
                                                    <?php
                                                        $temp=0;
                                                    ?> 
                                                    @if($i==$area->cantidad)                                                                     
                                                        <tr>  
                                                            <td class="center" rowspan="{{$area->cantidad}}">{{$area->nombre}}</td>
                                                            <td>{{$contador}}</td>
                                                            <td>{{$competencias->nombre}}</td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},0)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},1)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},2)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},3)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},4)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},5)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},6)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},7)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},8)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <?php
                                                                $i--;
                                                                $contador=$contador+1;
                                                            ?>
                                                        </tr>
                                                    @else
                                                        <tr>
                                                            <td>{{$contador}}</td>
                                                            <td>{{$competencias->nombre}}</td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},0)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},1)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},2)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},3)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},4)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},5)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},6)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},7)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <td class="center">
                                                                <label class="pos-rel">
                                                                    <input type="checkbox" onclick="activarCasilla({{$contador-1}},8)" class="ace" />
                                                                    <span class="lbl"></span>
                                                                </label>
                                                            </td>
                                                            <?php
                                                            $contador=$contador+1;
                                                            ?>
                                                        </tr>
                                                    @endif
                                                                                                            
                                                    <?php
                                                        $temp=$temp+1;
                                                    ?> 
                                                @endforeach
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <thead> 
                                            <tr>
                                                <th class="detail-col" colspan="3">ENFOQUES TRANSVERSALES</th>
                                                <th class="detail-col">Unidad 1</th>
                                                <th class="detail-col">Unidad 2</th>
                                                <th class="detail-col">Unidad 3</th>
                                                <th class="detail-col">Unidad 4</th>
                                                <th class="detail-col">Unidad 5</th>
                                                <th class="detail-col">Unidad 6</th>
                                                <th class="detail-col">Unidad 7</th>
                                                <th class="detail-col">Unidad 8</th>
                                            </tr>
                                        </thead>
                                        <tbody>                                                          
                                        <?php
                                            $tempEnfoque=0;
                                        ?>                           
                                            @foreach($enfoques as $enfoque)
                                                <tr>
                                                    <td colspan="3">{{$enfoque->nombre}}</td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},0)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},1)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},2)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},3)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},4)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},5)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},6)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},7)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                    <td class="center">
                                                        <label class="pos-rel">
                                                            <input type="checkbox" onclick="activarCasillaEnfoque({{$tempEnfoque}},8)" class="ace" />
                                                            <span class="lbl"></span>
                                                        </label>
                                                    </td>
                                                </tr>                                                                    
                                                <?php
                                                    $tempEnfoque=$tempEnfoque+1;
                                                ?> 
                                            @endforeach 
                                        </tbody>
                                    </table>
                                </div><!-- /.span -->
                            
                            </div>
                            <div class="col-xs-12" style="top: 10px;" >
                            </div><!-- /.span -->
                        </div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
@stop
@section('jss')
		<script src="js/planAnual.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>

		
		<script type="text/javascript">
            $('#historal-table').DataTable( {
                language: {
                    //"decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ Entradas",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
            });
		</script>
@stop

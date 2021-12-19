@extends('layouts.layout')
@section('content')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Administración</a>
                </li>
                <li class="active">Nueva Competencia</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Nueva Competencia</h1>
                    </div><!-- /.page-header -->
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
							<div class="widget-body">
								<div class="widget-main">
									<div>
										<label for="form-field-8">Competencia</label>
										<input type="text" id="competencia" placeholder="Competencia" class="form-control">
									</div>
									<div>
										<label for="form-field-8">Descripción</label>
										<textarea class="form-control" id="descripcion" placeholder="Ingrese su Descripción"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarCompetencia">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
                        </div>
                        
                        <div class="col-xs-12" style="top: 10px;" >
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title">Competencias</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">                                       
										<div>
											<table id="competencia-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>N°</th>
														<th>Nombre</th>
														<th>Capacidades</th>
														<th>Desempeños</th>
													</tr>
												</thead>
                                                <?php
                                                $count=1;
                                                ?>
												<tbody>
                                                @foreach($competencias as $competencia)
													<tr>
                                                        <td>{{$count}}</td>
                                                        <?php
                                                        $count++;
                                                        ?>
                                                        <td style="width: 1200px">{{$competencia->nombre}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalListaCapacidades" data-whatever="@Capacidades de la competencia  {{$competencia->nombre}}" onclick="listaCapacidad({{$competencia->id}},'{{$competencia->nombre}}')">
																	<i class="ace-icon fa fa-pencil bigger-120"></i>
																</button>
															</div>
															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalNuevaCapacidades"  onclick="listaCapacidad({{$competencia->id}})">
																				<i class="ace-icon fa fa-pencil bigger-120"></i>
																			</button>
																		</li>
																	</ul>
																</div>
															</div>
														</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalListaDesempeno" onclick="listaDesempeno({{$competencia->id}},'{{$competencia->nombre}}',1)">
																	<i class="ace-icon fa fa-pencil bigger-120"></i>
																</button>
															</div>
															<div class="hidden-md hidden-lg">
																<div class="inline pos-rel">
																	<button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto">
																		<i class="ace-icon fa fa-caret-down icon-only bigger-120"></i>
																	</button>

																	<ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
																		<li>
																			<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalListaDesempeno" onclick="listaDesempeno({{$competencia->id}},'{{$competencia->nombre}}',1)">
																				<i class="ace-icon fa fa-pencil bigger-120"></i>
																			</button>
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
                        </div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
</div>

<!-- Modal===================================================================================================================================-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalListaCapacidades">
  	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="ModalCompetencia">Lista de</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
			<div class="modal-body">	  
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-body">
							<div class="widget-main">
								<div>
									<label for="form-field-8">Capacidad</label>
									<input type="text" id="capacidad" placeholder="nombre de Capacidad" class="form-control">
								</div>
								<div>
									<label for="form-field-8">Descripción</label>
									<textarea class="form-control" id="descripcionCapacidad" placeholder="Ingrese su Descripción"></textarea>
								</div>
							</div>
							<div id="divNuevoCapacidad" class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarCapacidad">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
						
							<div id="divActualizarCapacidad" class="col-md-offset col-md-9" style="display:none">
								<button class="btn btn-info" type="button" id="btnactualizarCapacidad">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Actualizar
								</button>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12">
						<div class="widget-main">                                       
							<div>
								<table id="listaCapacidad-table" class="table table-striped table-bordered table-hover" style="width: 100%;">
									<thead>
										<tr>
											<th>N°</th>
											<th>Nombre</th>
											<th>Descripcion</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>
<!-- Modal===================================================================================================================================-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalListaDesempeno">
  	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="Modaldesempeno">Lista de</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
			<div class="modal-body">	  
				<div class="row">
					<div class="col-xs-12">
						<div class="widget-body">
							<div class="widget-main">
								<div >
									<label class="form-field-8" for="form-field-1"> Grado </label>
									<select class="form-control" id="grado" name="grado">
									@foreach($grados as $grado)
										<option value="{{$grado->id}}">{{$grado->nombre}}</option>
									@endforeach
									</select>
								</div>
								<div>
									<label for="form-field-8">Desempeño</label>
									<textarea class="form-control" id="desempeno" placeholder="Ingrese su Descripción"></textarea>
								</div>
							</div>
							<div id="divNuevoDesempeno" class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarDesempeno">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
						
							<div id="divActualizarDesempeno" class="col-md-offset col-md-9" style="display:none">
								<button class="btn btn-info" type="button" id="btnactualizarDesempeno">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Actualizar
								</button>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12">
						<div class="widget-main">                                       
							<div>
								<table id="listaDesempeno-table" class="table table-striped table-bordered table-hover" style="width: 100%;">
									<thead>
										<tr>
											<th>N°</th>
											<th>Descripcion</th>
											<th>Opciones</th>
										</tr>
									</thead>
									<tbody>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
			</div>
		</div>
	</div>
</div>

@stop
@section('jss')
		<script src="js/nuevaCompetencia.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script type="text/javascript">
            $(document).ready(function(){
            });

            $('#competencia-table').DataTable( {
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
            $('#listaCapacidad-table').DataTable( {
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
            $('#listaDesempeno-table').DataTable( {
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

@extends('layouts.layout')
@section('content')
    <div class="main-content-inner">
        <div class="breadcrumbs ace-save-state" id="breadcrumbs">
            <ul class="breadcrumb">
                <li>
                    <i class="ace-icon fa fa-home home-icon"></i>
                    <a href="#">Administración</a>
                </li>
                <li class="active">Nueva Enfoque</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Nuevo Enfoque Tranversal</h1>
                    </div><!-- /.page-header -->
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
							<div class="widget-body">
								<div class="widget-main">
									<div>
										<label for="form-field-8">Enfoque</label>
										<input type="text" id="enfoque" placeholder="enfoque" class="form-control">
									</div>
									<div>
										<label for="form-field-8">Descripción</label>
										<textarea class="form-control" id="enfoque" placeholder="Ingrese su Descripción"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarEnfoque">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
                        </div>
                        
                        <div class="col-xs-12" style="top: 10px;" >
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title">Enfoques Transvesales</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">                                       
										<div>
											<table id="competencia-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>N°</th>
														<th>Nombre</th>
														<th>Actividad o actitud observable</th>
													</tr>
												</thead>
                                                <?php
                                                $count=1;
                                                ?>
												<tbody>
                                                @foreach($enfoques as $enfoque)
													<tr>
                                                        <td>{{$count}}</td>
                                                        <?php
                                                        $count++;
                                                        ?>
                                                        <td style="width: 1200px">{{$enfoque->nombre}}</td>
														<td>
															<div class="hidden-sm hidden-xs action-buttons">
																<button type="button" class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalListaActitudes" data-whatever="@Capacidades de la competencia  {{$enfoque->nombre}}" onclick="listaActitud({{$enfoque->id}},'{{$enfoque->nombre}}')">
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
																			<button class="btn btn-xs btn-info" data-toggle="modal" data-target="#modalListaActitudes"  onclick="listaActitud({{$enfoque->id}})">
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
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="modalListaActitudes">
  	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="ModalActitud">Lista de</h5>
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
									<label for="form-field-8">Acciones o Actitudes observables </label>
									<textarea class="form-control" id="descripcionActitud" placeholder="Ingrese su Descripción"></textarea>
								</div>
							</div>
							<div id="divNuevoActitud" class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarActitud">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
						
							<div id="divActualizarActitud" class="col-md-offset col-md-9" style="display:none">
								<button class="btn btn-info" type="button" id="btnactualizarActitud">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Actualizar
								</button>
							</div>
						</div>
					</div>
					
					<div class="col-xs-12">
						<div class="widget-main">                                       
							<div>
								<table id="listaActitud-table" class="table table-striped table-bordered table-hover" style="width: 100%;">
									<thead>
										<tr>
											<th>N°</th>
											<th>Nombre</th>
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
		<script src="js/nuevaActitud.js"></script>
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

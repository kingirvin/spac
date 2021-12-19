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
                <li class="active">Nuevo Momento</li>
            </ul><!-- /.breadcrumb -->
        </div>

        <div class="page-content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="page-header">
                        <h1>Nuevo Momento</h1>
                    </div><!-- /.page-header -->
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6">
							<div class="widget-body">
								<div class="widget-main">
                                    <div >
                                        <label class="form-field-8" for="form-field-1"> Areas </label>
                                        <select class="form-control" id="area" name="area">
                                        @foreach($areas as $area)
                                            <option value="{{$area->id}}">{{$area->nombre}}</option>
                                        @endforeach
                                        </select>
                                    </div>
                                    <div >
                                        <label class="form-field-8" for="form-field-1"> competencias </label>
                                        <select class="form-control" id="competencia" name="competencia">
                                        </select>
                                    </div>
									<div>
										<label for="form-field-8">Momento</label>
										<textarea class="form-control" id="momento" placeholder="Ingrese su Descripción"></textarea>
									</div>
								</div>
							</div>
							<div class="col-md-offset col-md-9">
								<button class="btn btn-info" type="button" id="btnAgregarMomento">
									<i class="ace-icon fa fa-check bigger-110"></i>
									Agregar
								</button>
							</div>
                        </div>
                        
                        <div class="col-xs-12" style="top: 10px;" >
                            <div class="widget-box">
                                <div class="widget-header">
                                    <h4 class="widget-title">Momentos</h4>
                                </div>
                                <div class="widget-body">
                                    <div class="widget-main">                                       
										<div>
											<table id="momento-table" class="table table-striped table-bordered table-hover">
												<thead>
													<tr>
														<th>N°</th>
														<th>Momento</th>
														<th>competencia</th>
														<th>Area</th>
													</tr>
												</thead>
                                                <?php
                                                $count=1;
                                                ?>
												<tbody>
                                                @foreach($momentos as $momento)
													<tr>
                                                        <td>{{$count}}</td>
                                                        <?php
                                                        $count++;
                                                        ?>
                                                        <td>{{$momento->momento}}</td>
                                                        <td>{{$momento->competencia}}</td>
                                                        <td>{{$momento->area}}</td>
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
@stop
@section('jss')
		<script src="js/nuevoMomento.js"></script>
		<script src="assets/js/dataTables.buttons.min.js"></script>
		<script src="assets/js/dataTables.select.min.js"></script>
		<script src="assets/js/jquery.dataTables.min.js"></script>
		<script src="assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<script src="assets/js/bootstrap-multiselect.min.js"></script>
		<script src="assets/js/ace-elements.min.js"></script>
		<script src="assets/js/chosen.jquery.min.js"></script>

@stop

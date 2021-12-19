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
                        <h1>Mis Datos</h1>
                    </div><!-- /.page-header -->
                    <div class="clearfix">
                        <div class="pull-right tableTools-container"></div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-3 center">
                            <span class="profile-picture">
                                <img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="assets/images/avatars/profile-pic.jpg" />
                            </span>

                            <div class="space space-4"></div>
                        </div><!-- /.col -->
                        <div class="col-xs-12 col-sm-4">
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('editarPerfil') }}">
                                @csrf
                                <fieldset>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nombre</label>
										<div class="col-sm-9">
											<input type="text" name="nombre" id="nombre" class="form-control" placeholder="Nombre" value="{{$persona->nombre}}"/>
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Apellidos</label>
										<div class="col-sm-9">
											<input type="text" name="apellidos" id="apellidos" class="form-control" placeholder="Apellidos" value="{{$persona->apellidos}}" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Telefono</label>
										<div class="col-sm-9">
											<input type="text" name="telefono" id="telefono" class="form-control" placeholder="Telefono" value="{{$persona->telefono}}" />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Correo</label>
										<div class="col-sm-9">
											<input id="email" type="email" class="form-control" name="email"  value="{{$persona->correo}}"  placeholder="Correo"  />
										</div>
									</div>
                                    <div class="form-group">
										<label class="col-sm-3 control-label no-padding-right" for="form-field-1">Nombre I.E.</label>
										<div class="col-sm-9">
											<input id="nombre_ie" type="text" class="form-control" name="nombre_ie"  value="{{$persona->nombre_ie}}" placeholder="Nombre I.E."  />
										</div>
									</div>                         
                                   
                                    <div class="space-24"></div>

                                    <div class="clearfix">
                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                            <i class="ace-icon fa fa-refresh"></i>
                                            <span class="bigger-110">Cancelar</span>
                                        </button>

                                        <button type="submit" class="width-65 pull-right btn btn-sm btn-success">
                                            <span class="bigger-110" >Guardar</span>
                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                        </button>
                                    </div>
                                </fieldset>
                            </form>
                        </div>
                    </div>
                    <!-- PAGE CONTENT ENDS -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.page-content -->
    </div>
@stop
@section('jss')
		<script src="js/nuevoUsuario.js"></script>

@stop

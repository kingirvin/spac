@extends('layouts.layout')
@section('content')
				<div class="main-content-inner">
					<div class="breadcrumbs ace-save-state" id="breadcrumbs">
						<ul class="breadcrumb">
							<li>
								<i class="ace-icon fa fa-home home-icon"></i>
								<a href="#">Inicio</a>
							</li>
							<li class="active">Perfil</li>
						</ul><!-- /.breadcrumb -->

						<div class="nav-search" id="nav-search">
							<form class="form-search">
								<span class="input-icon">
									<input type="text" placeholder="Search ..." class="nav-search-input" id="nav-search-input" autocomplete="off" />
									<i class="ace-icon fa fa-search nav-search-icon"></i>
								</span>
							</form>
						</div><!-- /.nav-search -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Tu perfil
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<!-- PAGE CONTENT BEGINS -->
								<div class="alert alert-block alert-success">
									<button type="button" class="close" data-dismiss="alert">
										<i class="ace-icon fa fa-times"></i>
									</button>

									<i class="ace-icon fa fa-check green"></i>

									Ultimo ingreso...
									<strong class="green">
										fecha
									</strong>
								</div>
								<div class="hr hr32 hr-dotted"></div>

								<div class="row">
								
									<div class="row">
										<div class="col-xs-12 col-sm-3 center">
											<span class="profile-picture">
												<img class="editable img-responsive" alt="Alex's Avatar" id="avatar2" src="assets/images/avatars/profile-pic.jpg" />
											</span>

											<div class="space space-4"></div>
										</div><!-- /.col -->
										<div class="col-xs-12 col-sm-9">
											<h4 class="blue">
												<span class="middle">{{ Auth::user()->name }}</span>

												<span class="label label-purple arrowed-in-right">
													<i class="ace-icon fa fa-circle smaller-80 align-middle"></i>
													online
												</span>
											</h4>

											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name"> Nombre </div>

													<div class="profile-info-value">
														<span>{{$persona->nombre}}</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Apellidos </div>

													<div class="profile-info-value">
														<span>{{$persona->apellidos}}</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Correo </div>

													<div class="profile-info-value">
														<span>{{$persona->correo}}</span>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name"> Telefono </div>

													<div class="profile-info-value">
														<span>{{$persona->telefono}}</span>
													</div>
												</div>
												<div class="profile-info-row">
													<div class="profile-info-name"> Nombre I.E. </div>

													<div class="profile-info-value">
														<span>{{$persona->nombre_ie}}</span>
													</div>
												</div>
											</div>

											<div class="hr hr-8 dotted"></div>

											<div class="profile-user-info">
												<div class="profile-info-row">
													<div class="profile-info-name"> Sitio Web </div>

													<div class="profile-info-value">
														<a href="#" target="_blank">www.alexdoe.com</a>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">
														<i class="middle ace-icon fa fa-facebook-square bigger-150 blue"></i>
													</div>

													<div class="profile-info-value">
														<a href="#">Facebook</a>
													</div>
												</div>

												<div class="profile-info-row">
													<div class="profile-info-name">
														<i class="middle ace-icon fa fa-twitter-square bigger-150 light-blue"></i>
													</div>

													<div class="profile-info-value">
														<a href="#">Twitter</a>
													</div>
												</div>
											</div>
										</div><!-- /.col -->
									</div><!-- /.row -->






								</div><!-- /.row -->

								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			@stop
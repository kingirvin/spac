@extends('layouts.admin') @section('content')

@section('css')
@endsection

@section('js')
<script src="{{ asset('js/administracion/usuario.js') }}"></script>

@endsection

@section('rama') Inicio/ Usuarios @section('titulo') Usuarios @endsection @endsection 
<div class="page-body">
    <div class="container-xl">
        <!-- Page title -->
        <div class="page-header d-print-none">
            <div class="row align-items-center">
                <div class="col">
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none mb-3">
                    <div class="btn-list">  
                        <a href="#" onclick="limpiar_competencia_id()" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal" data-bs-target="#nuevo">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <line x1="12" y1="5" x2="12" y2="19" />
                                <line x1="5" y1="12" x2="19" y2="12" />
                            </svg>
                            Nuevo Usuario
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container-xl">
        <div class="row row-cards">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Lista de usuarios</h3>
                    </div>
                    <table id="t_usuario" class="table card-table table-vcenter text-nowrap datatable" width="100%">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Correo</th>
                                <th>Telefono</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td colspan="7">Cargando...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
</div>
<div id="datos" class="modal modal-blur fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar datos</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="form_datos" class="modal-body">       
                <div class="form-group mb-3">
                    <label class="form-label">Nombre <span class="form-required">*</span></label>
                    <input id="usuario_id" type="hidden">
                    <input id="nombre" type="text" class="form-control" >
                </div> 
                <div class="form-group mb-3">
                    <label class="form-label">Apellidos<span class="form-required">*</span></label>
                    <input id="apellidos" type="text" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Teléfono <span class="form-required">*</span></label>
                    <input id="telefono" type="text" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Correo <span class="form-required">*</span></label>
                    <input id="email" type="email" class="form-control validar_correo" >
                </div> 
            </div>   
            <div class="modal-footer">                
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="actualizar()">Guardar</button>
            </div>       
        </div>
    </div>
</div>
<div id="roles" class="modal modal-blur fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Administrar roles</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="form_password" class="modal-body">     
                <div class="form-group mb-3">
                    <div class="mb-3" id="div_roles">
                    </div>
                </div> 
            </div>   
            <div class="modal-footer">                
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="cambiar_contrasena()">Guardar</button>
            </div>       
        </div>
    </div>
</div>
<div id="cambiar_password" class="modal modal-blur fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cambiar contraseña</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="form_password" class="modal-body">       
                <div class="form-group mb-3">
                    <label class="form-label">Contraseña <span class="form-required">*</span></label>
                    <input id="usuario_id" type="hidden">
                    <input id="password" type="password" class="form-control validar_minimo:8" >
                </div> 
                <div class="form-group mb-3">
                    <label class="form-label">Confirmar Contraseña <span class="form-required">*</span></label>
                    <input id="password_confirmed" type="password" class="form-control validar_minimo:8 validar_igual:password" >
                </div> 
            </div>   
            <div class="modal-footer">                
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="cambiar_contrasena()">Guardar</button>
            </div>       
        </div>
    </div>
</div>
<div id="nuevo" class="modal modal-blur fade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Nuevo usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="form_nuevo" class="modal-body">       
                <div class="form-group mb-3">
                    <label class="form-label">Nombre <span class="form-required">*</span></label>
                    <input id="usuario_id" type="hidden">
                    <input id="n_nombre" type="text" class="form-control" >
                </div> 
                <div class="form-group mb-3">
                    <label class="form-label">Apellidos<span class="form-required">*</span></label>
                    <input id="n_apellidos" type="text" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Teléfono <span class="form-required">*</span></label>
                    <input id="n_telefono" type="text" class="form-control" >
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Correo <span class="form-required">*</span></label>
                    <input id="n_email" type="email" class="form-control validar_correo" >
                </div> 
                <div class="form-group mb-3">
                    <label class="form-label">Tipo <span class="form-required">*</span></label>
                    <select name="tipo" id="tipo" class="form-control">
                        <option value="1">Administrador</option>
                        <option value="2">Docente</option>
                        <option value="3">Estudiante</option>
                    </select>
                </div>
                <div class="form-group mb-3">
                    <label class="form-label">Contraseña <span class="form-required">*</span></label>
                    <input id="n_password" type="password" class="form-control validar_minimo:8" >
                </div> 
                <div class="form-group mb-3">
                    <label class="form-label">Repite contraseña <span class="form-required">*</span></label>
                    <input id="n_password_confirmed" type="password" class="form-control validar_minimo:8 validar_igual:n_password" >
                </div> 
            </div>   
            <div class="modal-footer">                
                <button type="button" class="btn btn-link link-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" onclick="nuevo()">Guardar</button>
            </div>       
        </div>
    </div>
</div>
@endsection
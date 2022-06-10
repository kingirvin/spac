
$( document ).ready(function() {
    tabla = $("#t_usuario").DataTable({
        "processing": true,
        "serverSide": true,
        "pageLength": 50,
        "order": [],
        "ajax": {
            "url":  "/json/administracion/usuario/listar",
            "type": "POST",
            "data": function ( d ) { },
            //"error": default_error_handler        
        },
        "columns": [
            { "data": "nombre", "orderable": false, "searchable": true,
                render: function ( data, type, full ) {  
                    return full.nombre+ " " + full.apellidos;
                }        
            },               
            { "data": "correo",
                render: function ( data, type, full ) {  
                    return full.correo;
                }        
            },
            { "data": "telefono",
                render: function ( data, type, full ) {  
                    return full.telefono;
                }        
            },
            { 
                "data": null,
                "searchable": false, "orderable": false, className: "w-1",
                    render: function ( data, type, full ) {   
                    var res = '<div class="btn-list flex-nowrap">'+
                                '<button class="btn btn-white btn-icon" onclick="abrir_modal_roles('+full.id+');" title="Asignar roles">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-briefcase" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><desc>Download more icon variants from https://tabler-icons.io/i/briefcase</desc> <path stroke="none" d="M0 0h24v24H0z" fill="none"></path> <rect x="3" y="7" width="18" height="13" rx="2"></rect><path d="M8 7v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2"></path><line x1="12" y1="12" x2="12" y2="12.01"></line><path d="M3 13a20 20 0 0 0 18 0"></path></svg>'+
                                '</button>'+
                                '<button class="btn btn-white btn-icon" onclick="abrir_modal_datos('+full.id+');" title="ACTUALIZAR DATOS">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" /><path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" /><line x1="16" y1="5" x2="19" y2="8" /></svg>'+
                                '</button>'+                                
                                '<button class="btn btn-white btn-icon" onclick="abrir_modal_password('+full.id+');" title="CAMBIAR CONTRASEÑA">'+
                                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><rect x="5" y="11" width="14" height="10" rx="2" /><circle cx="12" cy="16" r="1" /><path d="M8 11v-4a4 4 0 0 1 8 0v4" /></svg>'+
                                '</button>'+                                
                            '</div>';
                    return res;
                }
            }
        ],
        "dom": default_datatable_dom,
        "language": default_datatable_language,
        "initComplete" : default_datatable_buttons
    }); 
});
function abrir_modal_password(id) {
    limpiar("#form_password");
    vaciar("#form_password");
    document.getElementById("usuario_id").value=id;
    $('#cambiar_password').modal('show');     

}
function abrir_modal_roles(id) {  
    $( "#cargando_pagina").show();
    document.getElementById("usuario_id").value=id;
        var datastring = {
            id: document.getElementById('usuario_id').value
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/usuario/rol";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) { 
                html='<div class="form-label">Roles</div>';   
                res.forEach(element => {
                    html+='<label class="form-check form-switch">';
                    html+='<input class="form-check-input" type="checkbox" '+element.estado+' onclick="asignar_rol('+element.id+')">';
                    html+='<span class="form-check-label">'+element.descripcion+'</span>';
                    html+='</label>';
                });
                div=$('#div_roles'); 
                div.empty();
                div.append(html);          
                $('#cargando_pagina').hide();     
                $('#roles').modal('show');   
            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });   
}
function abrir_modal_datos(id) {
    limpiar("#form_datos");
    vaciar("#form_datos");
    document.getElementById("usuario_id").value=id;
        var datastring = {
            id: document.getElementById('usuario_id').value
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/usuario/buscar";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) { 
                persona=res['persona'];
                console.log(res);
                document.getElementById("nombre").value=persona.nombre;         
                document.getElementById("telefono").value=persona.telefono;
                document.getElementById("apellidos").value=persona.apellidos;     
                document.getElementById("email").value=res['email'];                
                $('#datos').modal('show');   

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });  

}
function cambiar_contrasena() {
    if( validar("#form_password")){        
        $('#cambiar_password').modal('hide');
        $( "#cargando_pagina" ).show();
        var datastring = {
            id: document.getElementById('usuario_id').value,
            password: document.getElementById('password').value,
            password_confirmation: document.getElementById('password_confirmed').value
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/usuario/reestablecer";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {                
                vaciar("#form_password");
                document.getElementById("usuario_id").value="";
                tabla.ajax.reload();                 
                tabla.ajax.reload();                 
                alerta(res.message,true);
                $('#cargando_pagina').hide();     

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
}
function actualizar() {
    if( validar("#form_datos")){        
        $('#datos').modal('hide');
        $( "#cargando_pagina" ).show();
        var datastring = {
            id: document.getElementById('usuario_id').value,
            nombre: document.getElementById('nombre').value,
            apellidos: document.getElementById('apellidos').value,
            telefono: document.getElementById('telefono').value,
            email: document.getElementById('email').value
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/usuario/actualizar";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {                
                vaciar("#form_datos");
                document.getElementById("usuario_id").value="";
                tabla.ajax.reload();                 
                alerta(res.message,true);                
                $('#cargando_pagina').hide();     

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
}
function asignar_rol(id) {       
        $('#nuevo').modal('hide');
        var datastring = {
            id: document.getElementById('usuario_id').value,
            rol: id,
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/rol/nuevo";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {                
                vaciar("#form_datos");
                document.getElementById("usuario_id").value="";
                tabla.ajax.reload();                 
                alerta(res.message,true);                
                $('#cargando_pagina').hide();     

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
}
function nuevo() {
    if( validar("#form_nuevo")){        
        $('#nuevo').modal('hide');
        $( "#cargando_pagina" ).show();
        var datastring = {
            id: document.getElementById('usuario_id').value,
            nombre: document.getElementById('n_nombre').value,
            apellidos: document.getElementById('n_apellidos').value,
            telefono: document.getElementById('n_telefono').value,
            email: document.getElementById('n_email').value,
            password: document.getElementById('n_password').value,
            tipo: document.getElementById('tipo').value,
            password_confirmation: document.getElementById('n_password_confirmed').value,
        };
        var token = $("[name=_token]").val();
        var route = "/json/administracion/usuario/nuevo";
        $.ajax({
            url: route,
            headers: { 'x-CSRF-TOKEN': token },
            type: 'POST',
            datatype: 'json',
            data: datastring,
            success: function (res) {                
                vaciar("#form_datos");
                document.getElementById("usuario_id").value="";
                tabla.ajax.reload();                 
                alerta(res.message,true);                
                $('#cargando_pagina').hide();     

            },
            error: function (error) {
                alerta(response_helper(error),false);
                $('#cargando_pagina').hide();
            }
        });
    }
}
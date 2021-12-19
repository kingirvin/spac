var idEnfoque;
var idActitud;
var count=0;
$("#btnAgregarActitud").click(function(){
    var datastring={descripcion:document.getElementById("descripcionActitud").value,
                    id:idEnfoque};
        var token=$("[name=_token]").val();
        var route="/nuevoActitud";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaActitud-table").DataTable();
                datos.row.add( [
                    count++,
                    res["descripcion"],    
                    '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarActitud('+res["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarActitud('+res["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                    ] ).draw( false );                 
            }
        });

})
function listaActitud(id,nombre){
    document.getElementById("descripcionActitud").value="";
    count=0;
    document.getElementById("ModalActitud").innerHTML="Lista de Acciones o Actitudes observables "+nombre;
    idEnfoque=id;
    var datastring={id:idEnfoque};
        var token=$("[name=_token]").val();
        var route="/listaActitud";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaActitud-table").DataTable();                      
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["descripcion"], 
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                
            }
        });
}
//actualiza la capacidad selecionada
$("#btnactualizarActitud").click(function(){
    count=0;
    var datastring={descripcion:document.getElementById("descripcionActitud").value,
                    idActitud:idActitud,
                    id:idEnfoque};
        var token=$("[name=_token]").val();
        var route="/actualizarActitud";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaActitud-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["descripcion"],  
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                 
                document.getElementById("divActualizarActitud").style.display="none";
                document.getElementById("divNuevoActitud").style.display="block";                     
            }
        });

})
function editarActitud(id){
    document.getElementById("divActualizarActitud").style.display="block";
    document.getElementById("divNuevoActitud").style.display="none";     
    var datastring={id:id};
        var token=$("[name=_token]").val();
        var route="/buscarActitud";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){                    
                document.getElementById("descripcionActitud").value  =res[0]["descripcion"] ;  
                idActitud=id      
            }
        });  
}
function eliminarActitud(id){
    count=0;
    var datastring={idActitud:id,
                    id:idEnfoque};
        var token=$("[name=_token]").val();
        var route="/eliminarActitud";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaActitud-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["descripcion"],  
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarActitud('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                                     
            }
        });    
}
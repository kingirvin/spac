var idCompetencia;
var idCapacidad;
var idDesempeno;
var count=0;
$("#btnAgregarCompetencia").click(function(){
    var datastring={competencia:document.getElementById("competencia").value,
                    descripcion:document.getElementById("descripcion").value};
        var token=$("[name=_token]").val();
        var route="/nuevaCompetencia";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#competencia-table").DataTable();
                datos.row.add( [
                    res["id"],
                    res["nombre"],
                    res["descripcion"],  
                    '<div class="hidden-sm hidden-xs action-buttons"><a class="red" onclcik="listarCapacidades(res["id"]"><i class="ace-icon fa fa-check bigger-120"></i></a><a class="green" onclcik="verCapacidadesres["id"]"> <i class="ace-icon fa fa-pencil bigger-130"></i></a><a class="red"  onclcik="agregarCapacidades(res["id"]"><i class="ace-icon fa fa-trash-o bigger-130"></i></a> </div>',
                    '<div class="hidden-sm hidden-xs action-buttons"> <a class="red"  onclcik="listarDesempenos(res["id"]"> <i class="ace-icon fa fa-check bigger-120"></i></a><a class="green" onclcik="verDesempenosres["id"]"> <i class="ace-icon fa fa-pencil bigger-130"></i> </a><a class="red"  onclcik="agregarDesempenos(res["id"]"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></div>',
                    ] ).draw( false );                 
            }
        });

})
$("#btnAgregarCapacidad").click(function(){
    var datastring={capacidad:document.getElementById("capacidad").value,
                    descripcion:document.getElementById("descripcionCapacidad").value,
                    id:idCompetencia};
        var token=$("[name=_token]").val();
        var route="/nuevaCapacidad";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                count++;
                var datos=$("#listaCapacidad-table").DataTable();
                datos.row.add( [
                    count,
                    res["nombre"],
                    res["descripcion"],  
                    '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarCapacidad('+res["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarCapacidad('+res["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                    ] ).draw( false );                 
            }
        });

})
function listaCapacidad(id,nombre){
    document.getElementById("capacidad").value="";
    document.getElementById("descripcionCapacidad").value="";
    count=0;
    document.getElementById("ModalCompetencia").innerHTML="Lista de Competencias de la capacidad "+nombre;
    idCompetencia=id;
    var datastring={id:idCompetencia};
        var token=$("[name=_token]").val();
        var route="/listaCapacidad";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaCapacidad-table").DataTable();                      
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        res[k]["descripcion"],  
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                
            }
        });
}
//actualiza la capacidad selecionada
$("#btnactualizarCapacidad").click(function(){
    count=0;
    var datastring={nombre:document.getElementById("capacidad").value,
                    descripcion:document.getElementById("descripcionCapacidad").value,
                    idCapacidad:idCapacidad,
                    id:idCompetencia};
        var token=$("[name=_token]").val();
        var route="/actualizarCapacidad";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaCapacidad-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        res[k]["descripcion"],  
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                 
                document.getElementById("divActualizarCapacidad").style.display="none";
                document.getElementById("divNuevoCapacidad").style.display="block";                     
            }
        });

})
function editarCapacidad(id){
    document.getElementById("divActualizarCapacidad").style.display="block";
    document.getElementById("divNuevoCapacidad").style.display="none";     
    var datastring={id:id};
        var token=$("[name=_token]").val();
        var route="/buscarCapacidad";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){                    
                document.getElementById("capacidad").value=res[0]["nombre"];
                descripcion:document.getElementById("descripcionCapacidad").value  =res[0]["descripcion"] ;  
                idCapacidad=id      
            }
        });  
}
function eliminarCapacidad(id){
    count=0;
    var datastring={idCapacidad:id,
                    id:idCompetencia};
        var token=$("[name=_token]").val();
        var route="/eliminarCapacidad";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaCapacidad-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        res[k]["descripcion"],  
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarCapacidad('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                                     
            }
        });    
}
//=================================================================actualiza la desempeños selecionada==================================================================================================

$("#btnAgregarDesempeno").click(function(){
    var datastring={grado:document.getElementById("grado").value,
                    nombre:document.getElementById("desempeno").value,
                    id:idCompetencia};
        var token=$("[name=_token]").val();
        var route="/nuevoDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                count++;
                var datos=$("#listaDesempeno-table").DataTable();
                datos.row.add( [
                    count,
                    res["nombre"],
                    '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarDesempeno('+res["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarDesempeno('+res["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                    ] ).draw( false ); 
                document.getElementById("desempeno").value="";
                
            }
        });

})
$("#btnactualizarDesempeno").click(function(){
    count=0;
    var datastring={grado:document.getElementById("grado").value,
                    nombre:document.getElementById("desempeno").value,
                    id:idCompetencia,
                    idDesempeno:idDesempeno};
        var token=$("[name=_token]").val();
        var route="/actualizarDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaDesempeno-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                 
                document.getElementById("desempeno").value="";
                document.getElementById("divActualizarDesempeno").style.display="none";
                document.getElementById("divNuevoDesempeno").style.display="block";                     
            }
        });

})
function editarDesempeno(id){
    document.getElementById("divActualizarDesempeno").style.display="block";
    document.getElementById("divNuevoDesempeno").style.display="none";     
    var datastring={id:id};
        var token=$("[name=_token]").val();
        var route="/buscarDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){                    
                descripcion:document.getElementById("desempeno").value  =res[0]["nombre"] ;  
                idDesempeno=id      
            }
        });  
}
function eliminarDesempeno(id){
    count=0;
    var datastring={idDesempeno:id,
                    id:idCompetencia,
                grado:document.getElementById("grado").value};
        var token=$("[name=_token]").val();
        var route="/eliminarDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaDesempeno-table").DataTable();                
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                                     
            }
        });    
}
function listaDesempeno(id,nombre,grado){
    count=0;
    document.getElementById("desempeno").value="";
    document.getElementById("Modaldesempeno").innerHTML="Lista de Desempeños de la capacidad "+ nombre;
    idCompetencia=id;
    var datastring={id:idCompetencia,
                    grado:grado};
        var token=$("[name=_token]").val();
        var route="/listaDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaDesempeno-table").DataTable();                      
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                
            }
        });
}
$( "#grado" ).change(function() { 
    count=0;
    document.getElementById("desempeno").value="";
    var datastring={id:idCompetencia,
                    grado:document.getElementById("grado").value};
        var token=$("[name=_token]").val();
        var route="/listaDesempeno";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var datos=$("#listaDesempeno-table").DataTable();                      
                datos
                    .clear()
                    .draw();
                for(var k in res) {
                    count++;
                    datos.row.add( [
                        count,
                        res[k]["nombre"],
                        '<div class="hidden-sm hidden-xs btn-group"><button class="btn btn-xs btn-info"onclick="editarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-pencil bigger-130"></i></button><button class="btn btn-xs btn-danger"onclick="eliminarDesempeno('+res[k]["id"]+')"><i class="ace-icon fa fa-trash bigger-130"></i></button></div>',
                        ] ).draw( false );    
                }                
            }
        });
});
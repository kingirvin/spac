var arrayCompetencias=new Array();
var grado;
var desempeno_id;// almacena el id de la tabla desempeño;
var areaPlan_id;// almacena el id de la tabla areaPlanAnuals;
var criterio_id;//almacena el id de la tabla criterio
var evidencia_id;// almacena el id de la tabla evidencias
var instrumento_id;// alamcena el id de la tabla instrumento
var actitud_id;// alamcena el id de la tabla actitud
var actitud;// alamcena el id de la tabla actitudPlans
var enfoquePlans_id;// alamcena el id de la tabla EnfoquesPlans
var unidad_id;
var elemeto="";
var botonGuardar="";
var botonListar="";
var botonEditar="";
var contenidoTemp=""//guarda temporalmente la descripcion de un registro para agregarlos a la tabla de lista
var contenidoEvidenvia=""//guarda temporalmente la descripcion de un registro para agregarlos a la tabla de lista
var contenidoArea=""//guarda temporalmente la descripcion de un registro para agregarlos a la tabla de lista
var contenidoCriterio=""//guarda temporalmente la descripcion de un registro para agregarlos a la tabla de lista
var sesion_id="";
$(document).ready(function(){
    $("#plan").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            obtenerUnidades($(this).val());
        });
    });
    $("#unidades").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            obtenerCompetenciasUnidad($(this).val());
            //<small> <span class="pink"><i class="ace-icon fa fa-print bigger-160"></i><a href="/imprimir" role="button" class="blue"> Vista previa</a></span></small>
        });
    });
    $("#desempeno").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            $("#textdesempenoEditable").val($(this).text());
            $("#textdesempeno").val($(this).text());
            desempeno_id=$(this).val();
//            document.getElementById("textdesempeno").innerHTML=$(this).text();            
        });
    });
    $("#actitudes").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            $("#textActitudEditable").val($(this).text());
            $("#textActitud").val($(this).text());
            actitud_id=$(this).val();
//            document.getElementById("textdesempeno").innerHTML=$(this).text();            
        });
    });
});
function obtenerUnidades(id){
    var datastring={id:id}; 
    var token=$("[name=_token]").val();
    var route="/buscarUnidadesPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            unidades=res[0]["unidades"];
            grado=res[0]["grado_id"];
            $('#unidades').empty(); //remove all child nodes  
            document.getElementById("grado").innerHTML="Grado : "+res[0]["grado"];
            document.getElementById("seccion").innerHTML="Seccion : "+res[0]["seccion"];
            document.getElementById("tipo").innerHTML="Periodo : "+res[0]["periodo"];         
            document.getElementById("duracion").innerHTML="Periodo : 4 semanas";        
            unidades.forEach(function(element) {
                var newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#unidades').append(newOption);
                $('#unidades').trigger("chosen:updated");
            }, this);   
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
            obtenerCompetenciasUnidad(res[0]["unidades"][0]["id"])
        }
    });
}
function obtenerCompetenciasUnidad(id){
    var div=document.getElementById("crearPdf");
    tempTexto='<h5 style="float: left;margin-right: 10px;margin-left: 13px;"><span class="pink"><i class="ace-icon fa fa-print"></i><a href="/vistaPreviaUnidad'+id+'" role="button" class="blue"> Vista previa</a></span></h5>';
    tempTexto+='<h5><span class="pink"><i class="ace-icon fa fa-download"></i><a href="/descargarUnidad'+id+'" role="button" class="blue"> Descargar</a></span></h5>';
    
    div.innerHTML=tempTexto;
    unidad_id=id;
    $("#tbodyid").empty(); 
    $("#tbodySesiones").empty(); 
    $("#tbodyEnfoques").empty(); 

    var Tbl = document.getElementById("tbodyid");
    var tableEnfoques = document.getElementById("tbodyEnfoques");
    var tablesesiones = document.getElementById("tbodySesiones");
   
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/buscarCompetenciasnidadesPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            elemeto="";
            countRows=2;
            $arrayCompetencias=res[0];
            $arrayEnfoques=res[1];                  
            $arraySituacion=res[2]; 
            $arraySesionAprendizaje=res[3]; 
            if($arraySituacion.length){
                //$("#divSituacion").html("")
                document.getElementById('divSituacion').innerHTML='';
                html='<textarea onchange="actualizarCriterio('+desempeno.id+')"  id="texareaSituacion'+$arraySituacion[0]["id"]+'" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+$arraySituacion[0]["nombre"]+'</textarea>';
                $("#divSituacion").append(html);
            }
            $arrayCompetencias.forEach(function(element){ 
                    td="<td>";
                    competencias=element.competencias;  
                    capacidades='<h5 class="center header">'+element.competencia+'</h5></br> <ul>';
                    competencias.forEach(function(capacidad) {
                        capacidades=capacidades +' <li>'+capacidad.nombre+'</li>';
                    }, this);
                    desempenos=element.desempenos; 
                    //'<div class="hidden-sm hidden-xs action-buttons"style="text-align: right;"><button class="btn  btn-yellow dropdown-toggle" data-toggle="modal" data-target="#modalListaDesempenos"  onclick="listarDesempeno('+element.competencias_id+')" style="border: 0;" ><i class="ace-icon fa glyphicon-plus bigger-130"></i></button></div>'; 
                    //<h5 class="pink"><i class="ace-icon fa glyphicon-plus green"></i><a href="#modal-form" role="button" class="blue" data-toggle="modal"> Form Inside a Modal Box </a></h5>
                    i=0;
                    if(desempenos.length){
                        countRows=countRows+desempenos.length;
                        temDesempeno='<h5 class="pink"><i class="ace-icon fa glyphicon-plus green"></i><a href="#modal-form" role="button" class="blue" data-toggle="modal" onclick="listarDesempeno('+element.competencias_id+','+element.areasPlanAnualsId+','+(countRows+1)+','+(desempenos.length+1)+')"> Agregar Desempeño</a></h5>';
                        td='<td id="tdCompetencia-'+element.areasPlanAnualsId+'" rowspan="'+(desempenos.length+1)+'">'+capacidades+'</td><td>'+temDesempeno+'</td><td></td><td></td>'; 
                        Tbl.insertRow(-1).innerHTML = td;     
                        desempenos.forEach(function(desempeno) {
                            if(i==0){
                                td='<td><textarea onchange="actualizarCriterio('+desempeno.id+')" id="texareaCriterio'+desempeno.id+'" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 90px;">'+desempeno.nombre+'</textarea><span class="pink"> <i class="ace-icon fa fa-trash-o green"></i><a href="#texareaCriterio'+desempeno.id+'" role="button" class="blue" onclick="EliminarCriterio('+desempeno.id+','+desempeno.areasPlanAnuals_id+')"> Eliminar</a></span></td>';                            
                                td+='<td><textarea  id="texareaEvidencia'+desempeno.id+'" onchange="actualizarEvidencia('+desempeno.id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 90px;">'+desempeno.evidencia+'</textarea></td>';
                                td+='<td id="tdInstumento'+element.areasPlanAnualsId+'"  onchange="actualizarInstrumento('+element.areasPlanAnualsId+')"  rowspan="'+(desempenos.length)+'"><textarea  id="texareaInstrumento'+element.areasPlanAnualsId+'" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+element.instrumento+'</textarea><span class="pink" id="btnGuardarlistarInstrumento'+element.areasPlanAnualsId+'" style="float: left;"><i class="ace-icon glyphicon glyphicon-list"></i><a href="#modal-Lista" role="button" class="blue" data-toggle="modal" onclick="listaInstrumento('+element.areasPlanAnualsId+')">  Ver Instumentos </a></span></td>';
                                i++;
                                
                            }else{
                                td='<td><textarea  onchange="actualizarCriterio('+desempeno.id+')"  id="texareaCriterio'+desempeno.id+'" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 90px;">'+desempeno.nombre+'</textarea><span class="pink"> <i class="ace-icon fa fa-trash-o green"></i><a href="#StexareaCriterio'+desempeno.id+'" role="button" class="blue" onclick="EliminarCriterio('+desempeno.id+','+desempeno.areasPlanAnuals_id+')"> Eliminar</a></span></td>';        
                                td+='<td><textarea  id="texareaEvidencia'+desempeno.id+'" onchange="actualizarEvidencia('+desempeno.id+')" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 90px;">'+desempeno.evidencia+'</textarea><span class="pink" id="btnGuardarEvidenvia'+desempeno.id+'"  style="display:none"><i class="ace-icon fa fa-floppy-o green"></i><a href="#texareaCriterio'+desempeno.id+'" role="button" class="blue" onclick="actualizarEvidencia('+desempeno.id+')"> Guardar </a></span></td>';

                            }
                            //temDesempeno=temDesempeno +' <li class="listaDesempeno">'+desempeno.nombre+'<span class="pink"><i class="ace-icon fa fa-pencil green"></i><a href="#modal-Criterio" role="button" class="blue" data-toggle="modal" onclick="editarCriterio('+desempeno.id+')"> Editar </a></span><span class="pink"> <i class="ace-icon fa fa-trash-o green"></i><a href="#listaDesempeno'+element.areasPlanAnualsId+'" role="button" class="blue" onclick="EliminarCriterio('+desempeno.id+','+desempeno.areasPlanAnuals_id+')"> Eliminar</a></span></li>';          
                            Tbl.insertRow(-1).innerHTML = td;
                        }, this);
                            
                    }  
                    else{//header 
                        countRows=countRows+1;
                        temDesempeno='<h5 class="pink"><i class="ace-icon fa glyphicon-plus green"></i><a href="#modal-form" role="button" class="blue" data-toggle="modal" onclick="listarDesempeno('+element.competencias_id+','+element.areasPlanAnualsId+','+(countRows+1)+','+(desempenos.length+1)+')"> Agregar Desempeño</a></h5>';
                        td='<td id="tdCompetencia-'+element.areasPlanAnualsId+'">'+capacidades+'</td><td>'+temDesempeno+'</td><td></td><td id="tdInstumento'+element.areasPlanAnualsId+'"></td>';   
                        Tbl.insertRow(-1).innerHTML = td;

                    }               

                
            }, this);
            
            // tabla encoques actitudes
            $arrayEnfoques.forEach(function(element) {
                    //actitudes
                    actitudes=element.actitudes; 
                    i=0;
                    temActitudes='<h5 class="pink"><i class="ace-icon fa glyphicon-plus green"></i><a href="#tdEnfoque-'+element.id+'" role="button" class="blue" onclick="nuevaActitud('+element.id+')"> Agregar actitudes</a></h5>';
                    if(actitudes.length){       
                        td='<td id="tdEnfoque-'+element.id+'" rowspan="'+(actitudes.length+1)+'">'+element.nombre+'</td><td>'+temActitudes+'</td>'; 
                        tableEnfoques.insertRow(-1).innerHTML = td;     
                        actitudes.forEach(function(actitudes) {                        
                        //ssarrayCompetencias[element.areasPlanAnualsId][desempeno.id]=desempeno.nombre;
                            td='<td><textarea  id="texareaEnfoque'+actitudes.id+'" onchange="actualizarActitud('+actitudes.id+')" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 70px;">'+actitudes.nombre+'</textarea><span class="pink" id="btnEliminarActitud'+actitudes.id+'"> <i class="ace-icon fa fa-trash-o green"></i><a href="#texareaEnfoque'+actitudes.id+'" role="button" class="blue" onclick="EliminarActitud('+actitudes.id+')"> Eliminar</a></span></td>';
                            tableEnfoques.insertRow(-1).innerHTML = td;     
                        }, this);
                    }
                    else{
                        td='<td id="tdEnfoque-'+element.id+'" rowspan="'+(actitudes.length+1)+'">'+element.nombre+'</td><td>'+temActitudes+'</td>'; 
                        tableEnfoques.insertRow(-1).innerHTML = td;     
                   }
                
            }, this);
           countTemp=1;
            $arraySesionAprendizaje.forEach(function(element) {
                td='<td style="width: 10%;"> SESIÓN '+countTemp+'</td>';
                td+='<td style="width: 15%;"><div class="col-sm-12"><input type="text" onblur="guardarNombreSesion('+element.id+')" id="textSesion'+element.id+'" value="'+element.nombre+'" placeholder="Text Field" class="form-control" ><span class="pink" id="spanTextSesion'+element.id+'" ><i class="ace-icon fa fa-floppy-o green"></i><a href="#textSesion'+element.id+'" role="button" class="blue" onclick="activartextSesion('+element.id+')"> Cambiar </a></span></div></td>';
                td+='<td style="width: 10%;"><div><a href="#modal-Cusos" role="button" class="blue" data-toggle="modal" onclick="listaCurso('+element.id+')">Lista de cursos</a><p id="textAreaCurso'+element.id+'" >'+element.area+'</p></div></td>';                   
                td+='<td ><div><a href="#modal-ListaCriterios" role="button" class="blue" data-toggle="modal" onclick="listaCriteriosCurso('+element.id+')">Lista de Criterios / Desempeños</a><p id="textCriterioCurso'+element.id+'" >'+element.criterio+'</p></div></td>';
                td+='<td style="width: 20%;"><p id="textEvidenicaCurso'+element.id+'" >'+element.criterio+'</p></td>';
                td+='<td style="width: 5%;"><input type="hidden" id="area_id'+element.id+'" value="'+element.area_id+'"><input type="hidden" id="criterio_id'+element.id+'"><span class="pink"> <i class="ace-icon fa fa-trash-o green"></i><a href="#textSesion'+element.id+'" role="button" class="blue" onclick="eliminarSesion(this,'+element.id+')"> Eliminar</a></span></td>';                         
                countTemp++;        
                   tablesesiones.insertRow(-1).innerHTML=td;            
            }, this);
            listarMaterialesUnidad(unidad_id);
        }
    });
}
//=============================================================== metodos de Acciones y actitudes de Enfoques===========================================================================

function listarActitud(id){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/listaActitud";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            enfoquePlans_id=EnfoquesPlans;
           $('#actitudes').empty(); //remove all child nodes 
            var newOption = $('<option value="">Eliga un Accion  o actitud</option>');
            $('#actitudes').append(newOption);
            $('#actitudes').trigger("chosen:updated");         
            res.forEach(function(element) {
                if($("#textActitudEditable").val()!=""){
                    $("#textActitudEditable").val(element.nombre);
                    $("#textActitud").val(element.nombre);
                }
                 newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#actitudes').append(newOption);
                $('#actitudes').trigger("chosen:updated");
            }, this);           
        }
    });
}
function nuevaActitud(id){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/nuevoActitudPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){   
            if(elemeto!=""){
                document.getElementById(elemeto).disabled= true ;
                document.getElementById(botonGuardar).style.display= "none" ;
                document.getElementById(botonEditar).style.display= "inline" ;
            }         
            obtenerCompetenciasUnidad(unidad_id);
            document.getElementById("texareaEnfoque"+res["id"]).disabled= false ;

        }
    });
}
// elimina el criterio de la listaDesempeno
function EliminarActitud(id){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/eliminarActitudPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            obtenerCompetenciasUnidad(unidad_id);           
        }
    });
}
// guarda los cambios relizadosen ese critrerio
function actualizarActitud(id){
    var datastring={id:id, nombre:document.getElementById("texareaEnfoque"+id).value};
    var token=$("[name=_token]").val();
    var route="/actualizaActitudPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("texareaEnfoque"+criterio_id).disabled= true ;
            document.getElementById("btnGuardarActitud"+criterio_id).style.display= "none" ;
            document.getElementById("btnEditarActitud"+criterio_id).style.display= "inline" ;
            elemeto=""; 
        }
    });

}
//$("#form_field").chosen().change("ghfh");desempeno;modal-Criterio//
//=============================================================== metodos de criterios de aprendizaje===========================================================================
function listarDesempeno(id,areaPlan,count,filas){
    var datastring={id:id,grado:grado};
    var token=$("[name=_token]").val();
    var route="/listaDesempeno";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            post_fila=count;
            areaPlan_id=areaPlan;
            filasUnir=filas;
           $('#desempeno').empty(); //remove all child nodes 
            var newOption = $('<option value="">Eliga un Desempeño</option>');
            $('#desempeno').append(newOption);
            $('#desempeno').trigger("chosen:updated");         
            res.forEach(function(element) {
                if($("#textdesempenoEditable").val()!=""){
                    $("#textdesempenoEditable").val(element.nombre);
                    $("#textdesempeno").val(element.nombre);
                }
                 newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#desempeno').append(newOption);
                $('#desempeno').trigger("chosen:updated");
            }, this); 
        }
    });
}
// Llama a addRow() con el ID de la tabla
function agregarDesempeno(){
    var datastring={desempeno:desempeno_id,areaPlan:areaPlan_id, nombre:$("#textdesempenoEditable").val()};
    var token=$("[name=_token]").val();
    var route="/nuevoDesempenoPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            obtenerCompetenciasUnidad(unidad_id);
            $('#modal-form').modal('hide');

        }
    });
}
// abre el modal modal-Criterio para ver y actualizar el Criterio
function editarCriterio(texarea,id){

    if(elemeto!=="")
    {        
        if(confirm("No se guardaron los cambios, Desea Continuar sin guardar?"))
        {
            criterio_id=id;
            document.getElementById(elemeto).disabled= true ;
            document.getElementById(botonGuardar).style.display= "none" ;
            document.getElementById(botonEditar).style.display= "inline" ;
            if(botonListar!="")
                document.getElementById(botonListar).style.display= "none" ;

            document.getElementById(elemeto).value=contenidoTemp;
            switch (texarea) {
                case 1:
                    document.getElementById("texareaCriterio"+id).disabled= false ;
                    document.getElementById("btnGuardarCriterio"+id).style.display= "inline" ;
                    document.getElementById("btnEditarCriterio"+id).style.display= "none" ;
                    elemeto="texareaCriterio"+id;
                    botonGuardar="btnGuardarCriterio"+id;
                    botonEditar="btnEditarCriterio"+id;                    
                    break;
                case 2:
                    document.getElementById("texareaEvidencia"+id).disabled= false ;
                    document.getElementById("btnGuardarEvidenvia"+id).style.display= "inline" ;
                    document.getElementById("btnEditarEvidenvia"+id).style.display= "none" ;
                    elemeto="texareaEvidencia"+id;
                    botonGuardar="btnGuardarEvidenvia"+id;
                    botonEditar="btnEditarEvidenvia"+id;
                        
                    break;
                case 3:
                    document.getElementById("texareaInstrumento"+id).disabled= false ;
                    document.getElementById("btnGuardarInstrumento"+id).style.display= "inline" ;
                    document.getElementById("btnEditarInstrumento"+id).style.display= "none" ;
                    document.getElementById("btnGuardarlistarInstrumento"+id).style.display= "block" ;
                    botonListar="btnGuardarlistarInstrumento"+id;
                    elemeto="texareaInstrumento"+id;
                    botonGuardar="btnGuardarInstrumento"+id;
                    botonEditar="btnEditarInstrumento"+id;
                    
                    break;
                case 4:    
                    document.getElementById("texareaEnfoque"+id).disabled= false ;
                    document.getElementById("btnGuardarActitud"+id).style.display= "inline" ;
                    document.getElementById("btnEditarActitud"+id).style.display= "none" ;
                    elemeto="texareaEnfoque"+id;
                    botonGuardar="btnGuardarActitud"+id;
                    botonEditar="btnEditarActitud"+id;
                    contenidoTemp=document.getElementById("texareaEnfoque"+id).value;                    
                    break;
                case 5:    
                    document.getElementById("texareaSituacion"+id).disabled= false ;
                    document.getElementById("btnGuardarSituacion"+id).style.display= "inline" ;
                    document.getElementById("btnEditarSituacion"+id).style.display= "none" ;
                    elemeto="texareaSituacion"+id;
                    botonGuardar="btnGuardarSituacion"+id;
                    botonEditar="btnEditarSituacion"+id;
                    contenidoTemp=document.getElementById("texareaSituacion"+id).value;                    
                    break;
            
                default:
                    break;
            }
        } 
        else {
            document.getElementById(elemeto).disabled= false ;
        }
    }
    else{
        criterio_id=id;
            switch (texarea) {
                case 1:
                    document.getElementById("texareaCriterio"+id).disabled= false ;
                    document.getElementById("btnGuardarCriterio"+id).style.display= "inline" ;
                    document.getElementById("btnEditarCriterio"+id).style.display= "none" ;
                    elemeto="texareaCriterio"+id;
                    botonGuardar="btnGuardarCriterio"+id;
                    botonEditar="btnEditarCriterio"+id;
                    contenidoTemp=document.getElementById("texareaCriterio"+id).value;
                    
                    break;
                case 2:
                    document.getElementById("texareaEvidencia"+id).disabled= false ;
                    document.getElementById("btnGuardarEvidenvia"+id).style.display= "inline" ;
                    document.getElementById("btnEditarEvidenvia"+id).style.display= "none" ;
                    elemeto="texareaEvidencia"+id;
                    botonGuardar="btnGuardarEvidenvia"+id;
                    botonEditar="btnEditarEvidenvia"+id;
                    contenidoTemp=document.getElementById("texareaEvidencia"+id).value;
                        
                    break;
                case 3:
                    document.getElementById("texareaInstrumento"+id).disabled= false ;
                    document.getElementById("btnGuardarInstrumento"+id).style.display= "inline" ;
                    document.getElementById("btnEditarInstrumento"+id).style.display= "none" ;
                    document.getElementById("btnGuardarlistarInstrumento"+id).style.display= "block" ;

                    botonListar="btnGuardarlistarInstrumento"+id;
                    elemeto="texareaInstrumento"+id;
                    botonGuardar="btnGuardarInstrumento"+id;
                    botonEditar="btnEditarInstrumento"+id;
                    contenidoTemp=document.getElementById("texareaInstrumento"+id).value;
                    
                    break;
                case 4:    
                    document.getElementById("texareaEnfoque"+id).disabled= false ;
                    document.getElementById("btnGuardarActitud"+id).style.display= "inline" ;
                    document.getElementById("btnEditarActitud"+id).style.display= "none" ;
                    elemeto="texareaEnfoque"+id;
                    botonGuardar="btnGuardarActitud"+id;
                    botonEditar="btnEditarActitud"+id;
                    contenidoTemp=document.getElementById("texareaEnfoque"+id).value;                    
                    break;
                case 5:    
                    document.getElementById("texareaSituacion"+id).disabled= false ;
                    document.getElementById("btnGuardarSituacion"+id).style.display= "inline" ;
                    document.getElementById("btnEditarSituacion"+id).style.display= "none" ;
                    elemeto="texareaSituacion"+id;
                    botonGuardar="btnGuardarSituacion"+id;
                    botonEditar="btnEditarSituacion"+id;
                    contenidoTemp=document.getElementById("texareaSituacion"+id).value;                    
                    break;
            
                default:
                    break;
            }        
    }
}
// elimina el criterio de la listaDesempeno
function EliminarCriterio(id,areaPlan){
    var datastring={id:id,
        areaPlan:areaPlan};
    var token=$("[name=_token]").val();
    var route="/eliminarCriterioPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            obtenerCompetenciasUnidad(unidad_id);             
        }
    });
}
// guarda los cambios relizadosen ese critrerio
function actualizarCriterio(id){
    var datastring={id:id, nombre:$("#texareaCriterio"+id).val()};
    var token=$("[name=_token]").val();
    var route="/actualizaCriterioPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){  
            document.getElementById("texareaCriterio"+criterio_id).disabled=true;
            document.getElementById("btnGuardarCriterio"+criterio_id).style.display= "none" ;
            document.getElementById("btnEditarCriterio"+criterio_id).style.display= "inline" ;
            elemeto="";
            //obtenerCompetenciasUnidad(unidad_id);
        }
    });

}
//$("#form_field").chosen().change("ghfh");desempeno;modal-Criterio//
//==============================================================metodos de evidencia de aprendizaje============================================================================

function actualizarEvidencia(id){
    var datastring={id:id, nombre:$("#texareaEvidencia"+id).val()};
    var token=$("[name=_token]").val();
    var route="/actualizaEvidencia";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("texareaEvidencia"+criterio_id).disabled= true ;
            document.getElementById("btnGuardarEvidenvia"+criterio_id).style.display= "none" ;
            document.getElementById("btnEditarEvidenvia"+criterio_id).style.display= "inline" ;
            elemeto=""; 
          
        }
    });

}

//$("#form_field").chosen().change("ghfh");desempeno;modal-Criterio//
//==============================================================metodos de Instrumentos de aprendizaje============================================================================
function actualizarInstrumento(id){
    var datastring={id:id, nombre:$("#texareaInstrumento"+id).val(),areaPlan:areaPlan_id};
    var token=$("[name=_token]").val();
    var route="/actualizaInstrumento";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("texareaInstrumento"+criterio_id).disabled= true ;
            document.getElementById("btnGuardarInstrumento"+criterio_id).style.display= "none" ;
            document.getElementById("btnEditarInstrumento"+criterio_id).style.display= "inline" ;
            elemeto="";  
        }
    });

}
function listaInstrumento(id){
    //editarCriterio("3",id)
    var datastring={tabla:"instrumento"};
    var token=$("[name=_token]").val();
    var route="/listaInstrumento";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            $("#lista-table").empty();
            var temTable = document.getElementById("lista-table");
            res.forEach(function(element) {
                td='<td>'+element.nombre+'</td><td><span class="pink"><i class="ace-icon fa fa-floppy-o green"></i><a href="#" role="button" class="blue" onclick="elegirInstrumento('+element.id+','+id+')"> Elegir Instrumento </a></span></td>'
                temTable.insertRow(-1).innerHTML = td;     
           }, this);
            
        }
    });
}
function elegirInstrumento(id,items){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/buscarInstrumento";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("texareaInstrumento"+items).value=res["descripcion"];
            document.getElementById("texareaInstrumento"+items).disabled= false ;
            $('#modal-Lista').modal('hide');
        }
    });

}
function crearSituacion(){
    var datastring={id:unidad_id,
                    nombre:document.getElementById("texareaSituacion1").value};
    var token=$("[name=_token]").val();
    var route="/nuevaSituacion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            obtenerCompetenciasUnidad(unidad_id);
        }
    });
}
function actualizarSituacion(id){
    var datastring={id:id,
                    nombre:document.getElementById("texareaSituacion"+id).value};
    var token=$("[name=_token]").val();
    var route="/actualizarSituacion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("texareaSituacion"+criterio_id).disabled= true ;
            document.getElementById("btnGuardarSituacion"+criterio_id).style.display= "none" ;
            document.getElementById("btnEditarSituacion"+criterio_id).style.display= "inline" ;
            elemeto="";  
        }
    });
}
function listarSesionesUnidad(){
    $("#tbodySesiones").empty(); 
    tablesesiones=document.getElementById("tbodySesiones");
    var datastring={id:unidad_id};
    var token=$("[name=_token]").val();
    var route="/listarSesionesUnidad";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
           countTemp=1;
            res.forEach(function(element) {
                td='<td style="width: 10%;"> SESIÓN '+countTemp+'</td>';
                td+='<td style="width: 15%;"><div class="col-sm-12"><input type="text" onblur="guardarNombreSesion('+element.id+')" id="textSesion'+element.id+'" value="'+element.nombre+'" placeholder="Text Field" class="form-control" disabled><span class="pink" id="spanTextSesion'+element.id+'" ><i class="ace-icon fa fa-floppy-o green"></i><a href="#textSesion'+element.id+'" role="button" class="blue" onclick="activartextSesion('+element.id+')"> Cambiar </a></span></div></td>';
                td+='<td style="width: 10%;"><div><a href="#modal-Cusos" role="button" class="blue" data-toggle="modal" onclick="listaCurso('+element.id+')">Lista de cursos</a><p id="textAreaCurso'+element.id+'" >'+element.area+'</p></div></td>';                   
                td+='<td ><div><a href="#modal-ListaCriterios" role="button" class="blue" data-toggle="modal" onclick="listaCriteriosCurso('+element.id+')">Lista de Criterios / Desempeños</a><p id="textCriterioCurso'+element.id+'" >'+element.criterio+'</p></div></td>';
                td+='<td style="width: 20%;"><p id="textEvidenicaCurso'+element.id+'" >'+element.criterio+'</p></td>';
                td+='<td style="width: 5%;"><input type="hidden" id="area_id'+element.id+'" value="'+element.area_id+'"><input type="hidden" id="criterio_id'+element.id+'"><span class="pink"> <i class="ace-icon fa fa-trash-o green"></i><a href="#textSesion'+element.id+'" role="button" class="blue" onclick="eliminarSesion(this,'+element.id+')"> Eliminar</a></span></td>';                         
                countTemp++;                      
                tablesesiones.insertRow(-1).innerHTML=td;      
            })
        }
    });

}
function nuevaSesionAprendizaje(){
        $("#tbodySesiones").empty(); 

    var datastring={id:unidad_id};
    var token=$("[name=_token]").val();
    var route="/nuevaSesionAprendizaje";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
           listarSesionesUnidad();     
        }
    });
}
function listaCurso(id){
    sesion_id=id;
    contenidoTemp="textAreaCurso"+id;
    contenidoArea="area_id"+id;
    contenidoCriterio="criterio_id"+id;
}
function listaCriteriosCurso(id){
    sesion_id=id;
    contenidoTemp="textCriterioCurso"+id;
    contenidoEvidenvia="textEvidenicaCurso"+id;
    area_id=document.getElementById("area_id"+id).value;
    listarCriteriosCurso(area_id);    
}
function elegirCurso(id){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/buscarCurso";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){        
           document.getElementById(contenidoArea).value=id;  
           $('#'+contenidoTemp).html(value=res["nombre"]);
            $('#modal-Cusos').modal('hide');
            guardarSesion(sesion_id);
        }
    });
}
function listarCriteriosCurso(id){
    var datastring={curso:id,unidad:unidad_id};
    var token=$("[name=_token]").val();
    var route="/listarCriteriosCurso";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){  
           countTemp=1;
           $("#tbodyListaCriterios").empty();
           tablesesiones=document.getElementById("tbodyListaCriterios");
            res.forEach(function(element) {
                td='<td> '+countTemp+'</td>';
                td+='<td><label for="">'+element.nombre+'</label></td>';
                td+='<td><span class="pink"><i class="ace-icon fa fa-check-square-o"></i><a href="#role="button" class="blue" onclick="elegirCriterio('+element.id+')"> Elegir</a></span></td>';                        
                countTemp++;
                tablesesiones.insertRow(-1).innerHTML=td;          
            }, this);


        }
    });

}
function elegirCriterio(id){
    var datastring={id:id};
    var token=$("[name=_token]").val();
    var route="/buscarCriterio";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            document.getElementById("textCriterioCurso"+sesion_id).value=id;
            document.getElementById("criterio_id"+sesion_id).value=id;
            $('#'+contenidoTemp).html(value=res["nombre"]);
            $('#'+contenidoEvidenvia).html(value=res["evidencia"]);
            $('#modal-ListaCriterios').modal('hide');
            guardarSesion(sesion_id);

        }
    });
} 
// actualiza o guarda la session_id
function guardarSesion(id)
{   
        var datastring={id:id,
        criterio_id:document.getElementById("criterio_id"+id).value,
        nombre:document.getElementById("textSesion"+id).value,
        area:document.getElementById("textAreaCurso"+id).innerHTML,
        area_id:document.getElementById("area_id"+id).value,
        criterio:document.getElementById("textCriterioCurso"+id).innerHTML,
        evidencia:document.getElementById("textEvidenicaCurso"+id).innerHTML,
    };
    var token=$("[name=_token]").val();
    var route="/actualizarSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
        }
    });
}
function activartextSesion(id){
    document.getElementById("spanTextSesion"+id).style.display="none";
    document.getElementById("textSesion"+id).disabled=false;
    document.getElementById("textSesion"+id).focus();
}
function guardarNombreSesion(id)
{
        var datastring={id:id,
        nombre:document.getElementById("textSesion"+id).value,
    };
    var token=$("[name=_token]").val();
    var route="/actualizarNombreSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            document.getElementById("spanTextSesion"+id).style.display="block";
            document.getElementById("textSesion"+id).disabled=true;
        }
    });

}
function listarMaterialesUnidad(id){
    var datastring={id:unidad_id};
    var token=$("[name=_token]").val();
    var route="/listarMaterialUnidad";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            $("#listaMateriales").empty();
            res.forEach(function(element) {
                var li=document.createElement('li');
                li.id="listMaterial"+element.id;
                li.innerHTML=element.nombre+'<span class="pink" style="padding-left: 11px;" onclick="eliminarMaterial(this,'+element.id+')" ><i class="ace-icon fa fa-trash-o"></i><a href="#listaMateriales" role="button" class="blue"> Eliminar</a></span>';
                document.getElementById("listaMateriales").appendChild(li);               
            }, this);
        }
    });    
}
function elegirMaterial(id){
    if(!unidad_id)
        alert("Seleccione un plan y una unidad");
    else{
        var datastring={id:unidad_id,
                nombre:document.getElementById("lblMateriales"+id).innerHTML,};
        var token=$("[name=_token]").val();
        var route="/agregarMaterial";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var li=document.createElement('li');
                li.id="listMaterial"+res["id"];
                li.innerHTML=res["nombre"]+'<span class="pink" style="padding-left: 11px;" onclick="eliminarMaterial(this,'+res["id"]+')" ><i class="ace-icon fa fa-trash-o"></i><a href="#listaMateriales" role="button" class="blue"> Eliminar</a></span>';
                document.getElementById("listaMateriales").appendChild(li);   
                $('#modal-Materiales').modal('hide');

            }
        });    
    }
}
function agregarMaterial(id){
    if(!unidad_id)
        alert("Seleccione un plan y una unidad");
    else{
        var datastring={id:unidad_id,
                nombre:document.getElementById("textMaterial").value,};
        var token=$("[name=_token]").val();
        var route="/agregarMaterial";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                var li=document.createElement('li');
                li.id="listMaterial"+res["id"];
                li.innerHTML=res["nombre"]+'<span class="pink" style="padding-left: 11px;" onclick="eliminarMaterial(this,'+res["id"]+')" ><i class="ace-icon fa fa-trash-o"></i><a href="#listaMateriales" role="button" class="blue"> Eliminar</a></span>';
                document.getElementById("listaMateriales").appendChild(li);   
                $('#modal-Materiales').modal('hide');

            }
        }); 
    }   
}
function eliminarMaterial(elemento,id){
    var datastring={id:id,};
    var token=$("[name=_token]").val();
    var route="/eliminarMaterial";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){    
            lista=document.getElementById("listaMateriales"); 
            lista.removeChild(document.getElementById('listMaterial'+id) ); 
        	//elemento.parentNode.remove();
        }
    });    
}
function eliminarSesion(row,elemento){
    var datastring={id:elemento,};
    var token=$("[name=_token]").val();
    var route="/eliminarSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){   
            listarSesionesUnidad();
        	//elemento.parentNode.remove();
        }
    });    
}
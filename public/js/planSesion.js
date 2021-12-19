var sesion_id;//almacena el id de la sesin en trabajo
$(document).ready(function(){
    $("#plan").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
              obtenerUnidades($(this).val());
      });
    });
    $("#unidades").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            //<small> <span class="pink"><i class="ace-icon fa fa-print bigger-160"></i><a href="/imprimir" role="button" class="blue"> Vista previa</a></span></small>
            obtenerSesiones($(this).val())
        });
    });
    $("#sesiones").chosen().change(function(){         
        $(this).find('option:selected').each(function(){
            //<small> <span class="pink"><i class="ace-icon fa fa-print bigger-160"></i><a href="/imprimir" role="button" class="blue"> Vista previa</a></span></small>
            sesion_id=$(this).val();
            muestraDatosSesion($(this).val())
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
            $('#unidades').empty(); //remove all child nodes            
            var newOption = $('<option value="0">Seleccione una Unidad</option>');
            $('#unidades').append(newOption);
            $('#unidades').trigger("chosen:updated");
            unidades=res[0]["unidades"];
            document.getElementById("pDocente").innerHTML=res[0]["docente"];
            document.getElementById("pGrado").innerHTML=res[0]["grado"];
            document.getElementById("pSession").innerHTML=res[0]["seccion"];
            unidades.forEach(function(element) {
                var newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#unidades').append(newOption);
                $('#unidades').trigger("chosen:updated");
            }, this);    
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
        }
    });
}
function obtenerSesiones(id){
    var datastring={id:id}; 
    var token=$("[name=_token]").val();
    var route="/buscarsesionesPlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            $('#sesiones').empty(); //remove all child nodes 
                var newOption = $('<option value="0">Selecione una Sesion</option>');
                $('#sesiones').append(newOption);
                $('#sesiones').trigger("chosen:updated");
            res.forEach(function(element) {
                var newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#sesiones').append(newOption);
                $('#sesiones').trigger("chosen:updated");
            }, this);   
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
        }
    });
}
function muestraDatosSesion(id){
    var datastring={id:id}; 
    var token=$("[name=_token]").val();
    var route="/buscarsesionePlan";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            document.getElementById("textHacerAntes").value=res[0]["antesde"];
            $enfoques=res[0]["enfoques"];
            $enfoquesSesion=res[0]["enfoquesSesion"];
            document.getElementById("pArea").innerHTML=res[0]["area"];
            document.getElementById("pDesempeno").innerHTML=res[0]["criterio"];
            document.getElementById("pEvidencia").innerHTML=res[0]["evidencia"];
            document.getElementById("textDuracion").value=res[0]["tiempo"];
            document.getElementById("fecha").value=res[0]["fecha"];
           $capacidades=res[0]["capacidades"];
            html='<h5 class="center header">'+res[0]["competencia"]+'</h5></br> <ul>';
            $capacidades.forEach(function(element) {
                html+='<li>'+element.nombre+'</li>';
            }, this);
            html+="</ul>";
            document.getElementById("divCompetencia").innerHTML=html;
            var Tbl = document.getElementById("tbodyListaEnfoques");
            $("#tbodyListaEnfoques").empty();
            $enfoques.forEach(function(element) {
                td='<td>#</td>';
                td+='<td><label id="enfoque'+element.id+'">'+element.nombre+'</label></td>';
                td+='<td><span class="pink"><i class="ace-icon fa fa-floppy-o green"></i><a href="#" role="button" class="blue" onclick="elegirEnfoque('+element.id+')"> Elegir</a></span></td>';
                Tbl.insertRow(-1).innerHTML = td;    
            }, this);  
            var Tbl = document.getElementById("tbodyEnfoqueSesion");
            $("#tbodyEnfoqueSesion").empty();
            $enfoquesSesion.forEach(function(element) {
                td='<td><label id="enfoqueSesion'+element.id+'">'+element.enfoque +' <span class="pink"><i class="ace-icon fa fa-trash-o"></i><a href="#enfoque-tabla" role="button" class="blue" onclick="eliminarEnfoque('+element.sesionaprendizajes_id+','+element.id+')"> Eliminar </a></span></label></label></td>';
                if(!element.actitud)
                    td+='<td><label id="actitudSesion'+element.id+'"> <span class="pink"><i class="ace-icon glyphicon glyphicon-list"></i><a href="#modal-Actitud" role="button" class="blue"   data-toggle="modal" onclick="listarActitud('+element.enfoquePlan_id+','+element.id+')"> Elegir Actitud </a></span></label></td>';
                else
                    td+='<td><label id="actitudSesion'+element.id+'">'+element.actitud+'<span class="pink"><i class="fa-pencil-square-o"></i><a href="#modal-Actitud" role="button" class="blue"   data-toggle="modal" onclick="listarActitud('+element.enfoquePlan_id+','+element.id+')"> Cambiar </a></span></label></td>';
                Tbl.insertRow(-1).innerHTML = td;    
            }, this); 


            divMomento=$("#momentos");
            $("#momentos").empty();
            td='<table id="momento-table" class="table  table-bordered table-hover">';
             td+='<thead>'
                    td+='<tr>';
                        td+='<th class="detail-col" colspan="2">MOMENTO</th>';
                        td+='<th class="detail-col" style="width: 80%;">SECUENCIA DE A SESIÓN</th>';
                        td+='<th class="detail-col" style="width: 10%;">TIEMPO</th>';
                    td+='</tr>';
                td+='</thead> ';
                td+='<tbody id="tbodyRecursos">';
                    td+='<tr>';
                        td+='<td class="rotate" rowspan="4"> Motivación </br>Inicio</td>';
                        td+='<td class="rotate" >Saberes previos</td>';
                        td+='<td>';
                            td+='<textarea   id="textareaSaberes"  onchange="actualizarSesionMomento('+sesion_id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+res[0]["saberes"]+'</textarea>';
                        td+='</td>';
                        td+='<td  rowspan="4">';
                            td+='<input  type="text" id="textTiempoInicio" value="'+res[0]["tiempoInicio"]+'"  onchange="actualizarSesionMomento('+sesion_id+')"  >';
                        td+='</td>';
                    td+='</tr>';
                    td+='<tr>'
                        td+='<td class="rotate" >Problematización </td>';
                        td+='<td> ';
                            td+='<textarea   id="textareaProblema"  onblur="actualizarSesionMomento('+sesion_id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+res[0]["problema"]+'</textarea>';
                        td+='</td>';
                    td+='</tr>';
                    td+=' <tr>';
                        td+='<td class="rotate"> Propósito y organización </td>'
                        td+='<td> ';
                            td+='<textarea   id="textareaPropocito" onblur="actualizarSesionMomento('+sesion_id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+res[0]["proposito"]+'</textarea>';
                        td+='</td>';
                    td+='</tr>';
                    td+='<tr>';
                        td+='<td class="rotate" >Criterios de evaluación </td>';
                        td+='<td> ';
                            td+='<textarea   id="textareaEvaluacion" onblur="actualizarSesionMomento('+sesion_id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+res[0]["evaluacion"]+'</textarea>';
                        td+='</td>';
                    td+='</tr>';
                    $momentos=res[0]['momentos'];
                    i=0;
                    
                        $momentos.forEach(function(element) {
                            if(i==0){
                                i=i+1;
                                td+='<tr>';
                                td+='<td class="rotate"  rowspan="'+$momentos.length+'">Motivación </br>  Proceso</td>';
                                td+='<td  class="rotate" rowspan="'+$momentos.length+'">Gestión y acompañamiento</td>';
                                td+='<td>'    ;
                                    td+='<h5><span class="black" style="float: lefth;">';
                                        td+='<p>'+i+'.- '+element.momento+'</p>';
                                    td+='</span> </h5>';
                                    td+='<textarea   id="momento'+element.id+'" onblur="actualizarMomento('+element.id+')"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+element.nombre+'</textarea>';
                                td+='</td>';
                                td+='<td  rowspan="'+$momentos.lenth+'"> ';
                                    td+='<input  onblur="actualizarSesionMomento('+sesion_id+')"  value="'+res[0]["tiempoProceso"]+'"   type="text" id="textTiempoProceso" >';
                                td+='</td>';
                                td+='</tr>';
                             }  
                             else{
                                td+='<tr>';
                                    td+='<td>' ;
                                        td+='<h5><span class="black" style="float: lefth;">';
                                        td+='<p>'+i+'.- '+element.momento+'</p>';
                                        td+='</span> </h5>';
                                        td+='<textarea   id="momento'+element.id+'" onblur="actualizarMomento('+element.id+')" class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+element.nombre+'</textarea>';
                                    td+='</td>';
                                td+='</tr>';
                                i++;
                             }                          
                        }, this);
                        td+='<tr>';
                                        td+='<td class="rotate"  colspan="2">Motivación</br>  Cierre</td>';
                                        td+='<td>' ;
                                            td+='<textarea onblur="actualizarSesionMomento('+sesion_id+')"  id="textareaCierre"  class="autosize-transition form-control" style="overflow: hidden; overflow-wrap: break-word; resize: horizontal; height: 152px;">'+res[0]["cierre"]+'</textarea>';
                                        td+='</td>';
                                        td+='<td> ';
                                            td+='<input  type="text"  value="'+res[0]["tiempoCierre"]+'"  onblur="actualizarSesionMomento('+sesion_id+')" id="textTiempoCierre" >';
                                        td+='</td>';
                                    td+='</tr>';
                    td+= ' </tbody>';
                    td+=' </table>';
                    divMomento.append(td);
        }
    });
    
}
function elegirEnfoque(id){
    var datastring={id:sesion_id,enfoquePlan_id:id,enfoque:document.getElementById("enfoque"+id).innerHTML,actitud:""}; 
    var token=$("[name=_token]").val();
    var route="/nuevoEnfoqueSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            var Tbl = document.getElementById("tbodyEnfoqueSesion"); 
            td='<td><label id="enfoqueSesion'+res["id"]+'">'+res["enfoque"]+ ' <span class="pink"><i class="ace-icon fa fa-trash-o"></i><a href="#enfoque-tabla" role="button" class="blue" onclick="eliminarEnfoque('+res["sesionaprendizajes_id"]+','+res["id"]+')"> Eliminar </a></span></label></label></td>';
            td+='<td><label id="actitudSesion'+res["id"]+'"> <span class="pink"><i class="ace-icon glyphicon glyphicon-list"></i><a href="#modal-Actitud" role="button" class="blue"   data-toggle="modal" onclick="listarActitud('+res["enfoquePlan_id"]+','+res["id"]+')"> Elegir Actitud </a></span></label></td>';
            Tbl.insertRow(-1).innerHTML = td;    
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
            $('#modal-Enfoque').modal('hide');            
        }
    });
}
function actualizarEvidencia(actitudesSesion,id){
    var datastring={id:actitudesSesion,actitud:document.getElementById("actitud"+id).innerHTML}; 
    var token=$("[name=_token]").val();
    var route="/actualizarActitudEnfoqueSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            document.getElementById("actitudSesion"+actitudesSesion).innerHTML=document.getElementById("actitud"+id).innerHTML+'<span class="pink" ><i class="ace-icon fa fa-floppy-o green"></i><a href="#modal-Actitud" role="button" class="blue" onclick="listarActitud('+res["enfoquePlan_id"]+','+res["id"]+')"> Cambiar </a></span>';
            $('#modal-Actitud').modal('hide');
        }
    });
}
function listarActitud(enfoquePlan_id,id){
    var datastring={id:enfoquePlan_id}; 
    var token=$("[name=_token]").val();
    var route="/listarActitudSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){ 
            $("#tbodyListaActitud").empty();
            i=1;
            var Tbl = document.getElementById("tbodyListaActitud"); 
            res.forEach(function(element) {
                td='<td>'+i+'</td>';
                td+='<td><label id="actitud'+element.id+'">'+element.nombre+'</label></td>';
                td+='<td><label><span class="pink"><i class="ace-icon fa fa-floppy-o green"></i><a href="#modal-Actitud" role="button" class="blue"  onclick="actualizarEvidencia('+id+','+element.id+')"> Elegir Actitud </a></span></label></td>';
                Tbl.insertRow(-1).innerHTML = td;    
                i++;
            }, this);  
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
        }
    });
}
function eliminarEnfoque(enfoquePlan_id,id){
    var datastring={id:id,enfoquePlan_id:enfoquePlan_id};
    var token=$("[name=_token]").val();
    var route="/eliminarEnfoqueSesion";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(enfoquesSesion){           
            var Tbl = document.getElementById("tbodyEnfoqueSesion");
            $("#tbodyEnfoqueSesion").empty();
            enfoquesSesion.forEach(function(element) {
                td='<td><label id="enfoqueSesion'+element.id+'">'+element.enfoque +' <span class="pink"><i class="ace-icon fa fa-trash-o"></i><a href="#enfoque-tabla" role="button" class="blue" onclick="eliminarEnfoque('+element.sesionaprendizajes_id+','+element.id+')"> Eliminar </a></span></label></label></td>';
                if(!element.actitud)
                    td+='<td><label id="actitudSesion'+element.id+'"> <span class="pink"><i class="ace-icon glyphicon glyphicon-list"></i><a href="#modal-Actitud" role="button" class="blue"   data-toggle="modal" onclick="listarActitud('+element.enfoquePlan_id+','+element.id+')"> Elegir Actitud </a></span></label></td>';
                else
                    td+='<td><label id="actitudSesion'+element.id+'">'+element.actitud+'<span class="pink"><i class="fa-pencil-square-o"></i><a href="#modal-Actitud" role="button" class="blue"   data-toggle="modal" onclick="listarActitud('+element.enfoquePlan_id+','+element.id+')"> Cambiar </a></span></label></td>';
                Tbl.insertRow(-1).innerHTML = td;    
            }, this);   
        }
    });    
}
function agregarMaterial(id){
    if(!sesion_id)
        alert("Seleccione un plan y una unidad");
    else{
        var datastring={id:sesion_id,
                nombre:document.getElementById("textMaterial").value,};
        var token=$("[name=_token]").val();
        var route="/agregarMaterialSesion";
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
function elegirMaterial(id){
    if(!sesion_id)
        alert("Seleccione un plan y una unidad");
    else{
        var datastring={id:sesion_id,
                nombre:document.getElementById("lblMateriales"+id).innerHTML,};
        var token=$("[name=_token]").val();
        var route="/agregarMaterialSesion";
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
function cambiarAntesde(){
    if(!sesion_id)
        alert("Seleccione un plan y una unidad");
    else{
        var datastring={id:sesion_id,
                antesde:document.getElementById("textHacerAntes").value,};
        var token=$("[name=_token]").val();
        var route="/agregarAntesde";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){ 
                document.getElementById("textHacerAntes").disabled=true;
                document.getElementById("activarAntesde").style.display="inline";
                document.getElementById("btnActivartext").style.display="none";
            }
        });    
    }
}
function cambiarTiempoSesion(){
    if(!sesion_id){
        alert("Seleccione un plan y una unidad");
        document.getElementById("textDuracion").value="0";
    }
    else{
        var datastring={id:sesion_id,
                antesde:document.getElementById("textDuracion").value,};
        var token=$("[name=_token]").val();
        var route="/actualizarTiempoSesion";
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

}
function cambiarFechaSesion(){
    if(!sesion_id){
        //alert("Seleccione un plan y una unidad");
    }
    else{
        var datastring={id:sesion_id,
                antesde:document.getElementById("fecha").value,};
        var token=$("[name=_token]").val();
        var route="/actualizarFechaSesion";
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

}
function activarAntesde(){
     document.getElementById("textHacerAntes").disabled=false;
     document.getElementById("btnActivartext").style.display="none";
     document.getElementById("btnGuardartext").style.display="inline";
     document.getElementById("textHacerAntes").focus();

}
function actualizarSesionMomento(){
    var datastring={id:sesion_id,
            saberes:document.getElementById("textareaSaberes").value,
            problema:document.getElementById("textareaProblema").value,
            proposito:document.getElementById("textareaPropocito").value,
            evaluacion:document.getElementById("textareaEvaluacion").value,
            tiempoInicio:document.getElementById("textTiempoInicio").value,
            cierre:document.getElementById("textareaCierre").value,
            tiempoProceso:document.getElementById("textTiempoProceso").value,
            tiempoCierre:document.getElementById("textTiempoCierre").value,};
    var token=$("[name=_token]").val();
    var route="/actualizarSesionMomento";
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
function actualizarMomento(id){
    var datastring={id:id,
            texto:document.getElementById("momento"+id).value,};
    var token=$("[name=_token]").val();
    var route="/actualizarSesionProceso";
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
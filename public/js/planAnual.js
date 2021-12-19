var planAnual; 
$("#btnActualizarUnidad").click(function(){
    planAnualUnidades[1]["nombre"]=document.getElementById("unidad1").value;
    planAnualUnidades[2]["nombre"]=document.getElementById("unidad2").value;
    planAnualUnidades[3]["nombre"]=document.getElementById("unidad3").value;
    planAnualUnidades[4]["nombre"]=document.getElementById("unidad4").value;
    planAnualUnidades[5]["nombre"]=document.getElementById("unidad5").value;
    planAnualUnidades[6]["nombre"]=document.getElementById("unidad6").value;
    planAnualUnidades[7]["nombre"]=document.getElementById("unidad7").value;
    planAnualUnidades[8]["nombre"]=document.getElementById("unidad8").value;
    var estado = $("#periodo").val(); 
    if(estado==2)
            planAnualUnidades[9]["nombre"]=document.getElementById("unidad9").value;

    var datos=$("#tablaPlan");
    var html="";
    var datastring={unidades:planAnualUnidades,
                };
        var token=$("[name=_token]").val();
        var route="/ActualizarUnidades";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){
                planAnual=res["areas"];
                planAnualEnfoques=res["enfoques"];
                var estado = $("#periodo").val(); 
                if(estado==1){
                    document.getElementById("unidadB1").innerHTML =planAnualUnidades[1]["nombre"];                    
                    document.getElementById("unidadB2").innerHTML =planAnualUnidades[2]["nombre"];
                    document.getElementById("unidadB3").innerHTML =planAnualUnidades[3]["nombre"];
                    document.getElementById("unidadB4").innerHTML =planAnualUnidades[4]["nombre"];
                    document.getElementById("unidadB5").innerHTML =planAnualUnidades[5]["nombre"];
                    document.getElementById("unidadB6").innerHTML =planAnualUnidades[6]["nombre"];
                    document.getElementById("unidadB7").innerHTML =planAnualUnidades[7]["nombre"];
                    document.getElementById("unidadB8").innerHTML =planAnualUnidades[8]["nombre"];
                } 
                if(estado==2){
                    document.getElementById("unidadT1").innerHTML =planAnualUnidades[1]["nombre"];
                    document.getElementById("unidadT2").innerHTML =planAnualUnidades[2]["nombre"];
                    document.getElementById("unidadT3").innerHTML =planAnualUnidades[3]["nombre"];
                    document.getElementById("unidadT4").innerHTML =planAnualUnidades[4]["nombre"];
                    document.getElementById("unidadT5").innerHTML =planAnualUnidades[5]["nombre"];
                    document.getElementById("unidadT6").innerHTML =planAnualUnidades[6]["nombre"];
                    document.getElementById("unidadT7").innerHTML =planAnualUnidades[7]["nombre"];
                    document.getElementById("unidadT8").innerHTML =planAnualUnidades[8]["nombre"];                   
                    document.getElementById("unidadT9").innerHTML =planAnualUnidades[9]["nombre"];
                } 

            }
        });
})
$("#btnNuevoPlan").click(function(){
    location.reload();
    document.getElementById("divGuardarUnidad").style.display="block";
    document.getElementById("divActualizarUnidad").style.display="none";

})
//Guarda las unidades del plan Anual
$( "#btnGuardarUnidad" ).click(function() {
    var datos=$("#tablaPlan");
    var html="";
    var datastring={nombre:document.getElementById("nombreDocente").value,
                    nombrePlan:document.getElementById("nombrePlan").value,
                    nombreIe:document.getElementById("nombre_ie").value,
                    grado:document.getElementById("grado").value,
                    seccion:document.getElementById("seccion").value,
                    periodo:document.getElementById("periodo").value,
                    unidad1:document.getElementById("unidad1").value,
                    unidad2:document.getElementById("unidad2").value,
                    unidad3:document.getElementById("unidad3").value,
                    unidad4:document.getElementById("unidad4").value,
                    unidad5:document.getElementById("unidad5").value,
                    unidad6:document.getElementById("unidad6").value,
                    unidad7:document.getElementById("unidad7").value,
                    unidad8:document.getElementById("unidad8").value,
                    unidad9:document.getElementById("unidad9").value,
                };
        var token=$("[name=_token]").val();
        var route="/creaPlanAnual";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){
                planAnual=res["areas"];
                planAnualUnidades=res["unidades"];
                planAnualEnfoques=res["enfoques"];
                var estado = $("#periodo").val(); 
                if(estado==1){              
                    document.getElementById("unidadB2").innerHTML =planAnualUnidades["1"]["nombre"];
                    document.getElementById("unidadB3").innerHTML =planAnualUnidades["2"]["nombre"];
                    document.getElementById("unidadB4").innerHTML =planAnualUnidades["3"]["nombre"];
                    document.getElementById("unidadB5").innerHTML =planAnualUnidades["4"]["nombre"];
                    document.getElementById("unidadB6").innerHTML =planAnualUnidades["5"]["nombre"];
                    document.getElementById("unidadB7").innerHTML =planAnualUnidades["6"]["nombre"];
                    document.getElementById("unidadB8").innerHTML =planAnualUnidades["7"]["nombre"];
                    document.getElementById("unidadB1").innerHTML =planAnualUnidades["8"]["nombre"];
             } 
                if(estado==2){
                    document.getElementById("unidadT1").innerHTML =planAnualUnidades["1"]["nombre"];
                    document.getElementById("unidadT2").innerHTML =planAnualUnidades["2"]["nombre"];
                    document.getElementById("unidadT3").innerHTML =planAnualUnidades["3"]["nombre"];
                    document.getElementById("unidadT4").innerHTML =planAnualUnidades["4"]["nombre"];
                    document.getElementById("unidadT5").innerHTML =planAnualUnidades["5"]["nombre"];
                    document.getElementById("unidadT6").innerHTML =planAnualUnidades["6"]["nombre"];
                    document.getElementById("unidadT7").innerHTML =planAnualUnidades["7"]["nombre"];
                    document.getElementById("unidadT8").innerHTML =planAnualUnidades["8"]["nombre"];                 
                    document.getElementById("unidadT9").innerHTML =planAnualUnidades["9"]["nombre"];
                } 
                var datos=$("#historal-table").DataTable();
                datos.row.add( [
                    res["nombre"],
                    res["fecha"],                   
                   'incompleto',
                   '<div class="hidden-sm hidden-xs action-buttons"><a class="green" href="#"><i class="ace-icon fa fa-pencil bigger-130"></i></a><a class="red" href="#"><i class="ace-icon fa fa-trash-o bigger-130"></i></a></div><div class="hidden-md hidden-lg"><div class="inline pos-rel"><button class="btn btn-minier btn-yellow dropdown-toggle" data-toggle="dropdown" data-position="auto"><i class="ace-icon fa fa-caret-down icon-only bigger-120"></i></button><ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close"><li><a href="#" class="tooltip-info" data-rel="tooltip" title="View"><span class="blue"><i class="ace-icon fa fa-search-plus bigger-120"></i></span></a></li><li><a href="#" class="tooltip-success" data-rel="tooltip" title="Edit"><span class="green"><i class="ace-icon fa fa-pencil-square-o bigger-120"></i></span></a></li><li><a href="#" class="tooltip-error" data-rel="tooltip" title="Delete"><span class="red"><i class="ace-icon fa fa-trash-o bigger-120"></i></span></a></li></ul></div></div>'
                ] ).draw( false );   

                document.getElementById("tablasPlan").style.display="block";            
                document.getElementById("divGuardarUnidad").style.display="none";
                document.getElementById("divActualizarUnidad").style.display="block";

            }
        });
});
$( "#periodo" ).change(function() {    
      var estado = $("#periodo").val();
      
    if(estado==1){
        document.getElementById("divUnidad9").style.display="none";
        document.getElementById("trimestre1").style.display="none";
        document.getElementById("trimestre2").style.display="none";
        document.getElementById("trimestre3").style.display="none";
        document.getElementById("bimentre1").style.display="block";
        document.getElementById("bimentre2").style.display="block";
        document.getElementById("bimentre3").style.display="block";
        document.getElementById("bimentre4").style.display="block";
        document.getElementById("tablaBimestral").style.display="block";
        document.getElementById("tablaTimestral").style.display="none";
   }
    else{
        document.getElementById("divUnidad9").style.display="block";
        document.getElementById("trimestre1").style.display="block";
        document.getElementById("trimestre2").style.display="block";
        document.getElementById("trimestre3").style.display="block";
        document.getElementById("bimentre1").style.display="none";
        document.getElementById("bimentre2").style.display="none";
        document.getElementById("bimentre3").style.display="none";
        document.getElementById("bimentre4").style.display="none";
        document.getElementById("tablaBimestral").style.display="none";
        document.getElementById("tablaTimestral").style.display="block";
    }
});
function activarCasilla(i,j)
{
    var estado=planAnual[i]["unidades"][j]["estado"];
    if(estado==0){
        planAnual[i]["unidades"][j]["estado"]=1;
    }
    else{
        planAnual[i]["unidades"][j]["estado"]=0;
    }
    var datastring={id:planAnual[i]["unidades"][j]["id"],
                    estado:planAnual[i]["unidades"][j]["estado"]                    
                };
        var token=$("[name=_token]").val();
        var route="/agragarUnidadCompetencia";
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

function activarCasillaEnfoque(i,j)
{
    var estado=planAnualEnfoques[i]["enfoquePlans"][j]["estado"];
    if(estado==0){
        planAnualEnfoques[i]["enfoquePlans"][j]["estado"]=1;
    }
    else{
        planAnualEnfoques[i]["enfoquePlans"][j]["estado"]=0;
    }
    var datastring={id:planAnualEnfoques[i]["enfoquePlans"][j]["id"],
                    estado:planAnualEnfoques[i]["enfoquePlans"][j]["estado"]                    
                };
        var token=$("[name=_token]").val();
        var route="/agragarUnidadEnfoque";
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
var planAnual; 
$(document).ready(function(){
});
function actualizarUnidades(unidades,id){
    nombre=document.getElementById("nombrePlan").value;
    grado=document.getElementById("grado").value;
    seccion=document.getElementById("seccion").value;
    unidades[0]["nombre"]=document.getElementById("unidad1").value;
    unidades[1]["nombre"]=document.getElementById("unidad2").value;
    unidades[2]["nombre"]=document.getElementById("unidad3").value;
    unidades[3]["nombre"]=document.getElementById("unidad4").value;
    unidades[4]["nombre"]=document.getElementById("unidad5").value;
    unidades[5]["nombre"]=document.getElementById("unidad6").value;
    unidades[6]["nombre"]=document.getElementById("unidad7").value;
    unidades[7]["nombre"]=document.getElementById("unidad8").value;
    var estado = $("#periodo").val(); 
    if(estado==2)
            unidades[8]["nombre"]=document.getElementById("unidad9").value;
        var datastring={unidades:unidades,nombre:nombre,grado:grado,seccion:seccion,id:id};
        var token=$("[name=_token]").val();
        var route="/ActualizarUnidades";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){
                if(estado==1){
                    document.getElementById("unidadB1").innerHTML =unidades[0]["nombre"];
                    document.getElementById("unidadB2").innerHTML =unidades[1]["nombre"];                    
                    document.getElementById("unidadB3").innerHTML =unidades[2]["nombre"];
                    document.getElementById("unidadB4").innerHTML =unidades[3]["nombre"];
                    document.getElementById("unidadB5").innerHTML =unidades[4]["nombre"];
                    document.getElementById("unidadB6").innerHTML =unidades[5]["nombre"];
                    document.getElementById("unidadB7").innerHTML =unidades[6]["nombre"];
                    document.getElementById("unidadB8").innerHTML =unidades[7]["nombre"];
                } 
                if(estado==2){
                    document.getElementById("unidadT1").innerHTML =unidades[0]["nombre"];                   
                    document.getElementById("unidadT2").innerHTML =unidades[1]["nombre"];
                    document.getElementById("unidadT3").innerHTML =unidades[2]["nombre"];
                    document.getElementById("unidadT4").innerHTML =unidades[3]["nombre"];
                    document.getElementById("unidadT5").innerHTML =unidades[4]["nombre"];
                    document.getElementById("unidadT6").innerHTML =unidades[5]["nombre"];
                    document.getElementById("unidadT7").innerHTML =unidades[6]["nombre"];
                    document.getElementById("unidadT8").innerHTML =unidades[7]["nombre"];
                    document.getElementById("unidadT9").innerHTML =unidades[8]["nombre"];                   
                } 

            }
        });
}
$("#btnNuevoPlan").click(function(){
    window.location="/programacionAnual";
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
function activarCasilla(id)
{
    var datastring={id:id};
        var token=$("[name=_token]").val();
        var route="/actualizarEstadoUnidad";
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

function activarCasillaEnfoque(id)
{
    var datastring={id:id};
        var token=$("[name=_token]").val();
        var route="/actualizarUnidadEnfoque";
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
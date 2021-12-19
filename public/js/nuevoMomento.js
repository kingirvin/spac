$(document).ready(function(){
    $("#area").change(function(){         
        $(this).find('option:selected').each(function(){
            obtenerCompetencias($(this).val());
        });
    });    
    $("#btnAgregarMomento").click(function(){         
            nuevoMomento();
    });
});
function obtenerCompetencias(id){
    var datastring={id:id}; 
    var token=$("[name=_token]").val();
    var route="/buscarCompetenciaCurso";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            $('#competencia').empty(); //remove all child nodes        
            res.forEach(function(element) {
                var newOption = $('<option value="'+element.id+'">'+element.nombre+'</option>');
                $('#competencia').append(newOption);
                $('#competencia').trigger("chosen:updated");
            }, this);   
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
        }
    });
}
function nuevoMomento(){
    var datastring={area:document.getElementById("area").value,competencia:document.getElementById("competencia").value,momento:document.getElementById("momento").value}; 
    var token=$("[name=_token]").val();
    var route="/nuevoMomento";
    $.ajax({
        url:route,
        headers:{'x-CSRF-TOKEN':token},
        type:'POST',
        datatype:'json',
        data:datastring,
        success:function(res){
            Tbl=document.getElementById("momento-table")      
            td='<td>#</td>';
            td+='<td>'+res["nombre"]+'</td><td>'+res["competencia"]+'</td><td>'+res["area"]+'</td>'; 
            Tbl.insertRow(-1).innerHTML = td;  
            //obtenerCompetenciasUnidad2(res[0]["unidades"][0]["id"])
        }
    });
}
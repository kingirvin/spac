$("#btnActivar").onClick(function(){
    var datastring={id:document.getElementById("nuevamarca").value};
        var token=$("[name=_token]").val();
        var route="/activarPlan";
        $.ajax({
            url:route,
            headers:{'x-CSRF-TOKEN':token},
            type:'POST',
            datatype:'json',
            data:datastring,
            success:function(res){
                html+="<option value='"+res["id"]+"'>"+res["nombre"]+"</option>";
                document.getElementById("nuevamarca").value="";
                datos.append(html);
                $('#modal-marca').modal('hide');                              
            }
        });

});
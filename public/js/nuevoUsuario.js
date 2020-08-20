$("#plan").change(function(){
    if( $(this).val()!=4)
    document.getElementById("comprobante").style.display="block";
    else
        document.getElementById("comprobante").style.display="none";

});
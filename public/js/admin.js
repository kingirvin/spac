var decimal_places=2;
var default_server = "";
var default_contanier = "#mensaje_container";

var default_datatable_dom=
"<'card-body border-bottom py-3'<'d-flex'<'text-muted'l><'ms-auto text-muted'f>>>" +
"<'table-responsive'tr>" +
"<'card-footer d-flex align-items-center'<'m-0 text-muted'i><'m-0 ms-auto'p>>";

var default_datatable_language={
    "lengthMenu": "_MENU_",
    "zeroRecords": "Nothing found - sorry",
    "info": "_START_ a _END_ de _TOTAL_",
    "infoEmpty": "Sin registros",
    "infoFiltered": "(Filtrado de _MAX_ registros)",
    "loadingRecords": "Cargando...",
    "processing": '<div class="loading_aux"><div class="spinner-border text-blue" role="status"></div> <b>Cargando...</b></div>',
    "search":         "",
    "searchPlaceholder": "Buscar",
    "zeroRecords":    "No se encontraron registros",
    "paginate": {
        "first":      "Primero",
        "last":       "Ultimo",
        "next":       ">",
        "previous":   "<"
    }
};

function default_error_handler(jqXHR, ajaxOptions, thrownError) {

    alerta(response_helper(jqXHR), false);     
    //console.log(thrownError + "\r\n" + jqXHR.statusText + "\r\n" + jqXHR.responseText + "\r\n" + ajaxOptions.responseText);
    return true;
}


function default_datatable_buttons() {
    var input = $('.dataTables_filter input').unbind(),
    self = this.api(),
    $searchButton = $('<button>')
                .html('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><circle cx="10" cy="10" r="7" /><line x1="21" y1="21" x2="15" y2="15" /></svg>')
                .addClass('btn btn-primary align-top btn-icon ms-1')
                .click(function() {
                    self.search(input.val()).draw();
                }),
    $clearButton = $('<button>')
                .html('<svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M19 19h-11l-4 -4a1 1 0 0 1 0 -1.41l10 -10a1 1 0 0 1 1.41 0l5 5a1 1 0 0 1 0 1.41l-9 9" /><line x1="18" y1="12.3" x2="11.7" y2="6" /></svg>')
                .addClass('btn btn-white align-top btn-icon ms-1 escritorio')
                .click(function() {
                    input.val('');
                    $searchButton.click(); 
                });

    input.removeClass('form-control-sm');
    input.keypress(function (e) {
        if (e.which == 13) {
            $searchButton.click(); 
            return false;
        }
    });

    $('.dataTables_filter').append($searchButton, $clearButton);

    var select = $('.dataTables_length select').unbind();
    select.removeClass('form-control-sm').removeClass('form-control');
    select.addClass('form-select'); 
    //custom-select custom-select-sm form-control form-control-sm
} 



//validar formulario (boostrap 4)
function validar(ident_form) //validar_fecha, validar_entero, validar_decimal
{    
    var resultado = true;
    limpiar(ident_form);
    //recorremos los items del formulario
    $( ident_form+" .form-group").each(function() {
        var grupo = this;

        if($(grupo).has(".form-required").length)//es obligatorio
        {
            var textbox = $(this).find('input[type=text],input[type=password],input[type=email]')//es un textbox
            if(textbox.length)
            {
                if(textbox.val().trim()=="")//esta vacio
                {
                    resultado=false;
                    $(textbox).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Este campo es obligatorio</div>');                   
                }
            }           

            var textarea = $(this).find('textarea')//es una textarea
            if(textarea.length)
            {
                if(textarea.val().trim()=="")//esta vacio
                {
                    resultado=false;
                    $(textarea).addClass('is-invalid')
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Este campo es obligatorio</div>');
                }
            }

            var file = $(this).find('input[type=file]')//es un file
            if(file.length)
            {
                if(file[0].files.length == 0)//esta vacio
                {
                    resultado=false;
                    $(file).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Este campo es obligatorio</div>');                   
                }
            }  
        }

        //debe ser fecha
        var fecha = $(this).find('.validar_fecha')
        if(fecha.length)
        {
            if(fecha.val().length>0)
            {
                if(!esFecha(fecha.val()))
                {
                    resultado=false;
                    $(fecha).addClass('is-invalid')
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese una fecha válida</div>');
                }
            }
        }

        //debe ser fecha hora
        var fecha_hora = $(this).find('.validar_fecha_hora')
        if(fecha_hora.length)
        {
            if(fecha_hora.val().length>0)
            {
                if(!esFechaHora(fecha_hora.val()))
                {
                    resultado=false;
                    $(fecha_hora).addClass('is-invalid')
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese una fecha válida</div>');
                }
            }
        }

        //debe ser numero
        var numero = $(this).find('.validar_numero')
        if(numero.length)
        {
            if(numero.val().length>0)
            {
                var numero_temp = numero.val();
                if(!esNumero(numero_temp))
                {
                    resultado=false;
                    $(numero).addClass('is-invalid')
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese un número válido</div>');
                }
            }
        }

        //debe ser entero
        var entero = $(this).find('.validar_entero')
        if(entero.length)
        {
            if(entero.val().length>0)
            {
                var entero_temp = entero.val();
                if(!esNumero(entero_temp))
                {
                    resultado=false;
                    $(entero).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese un número entero válido</div>');
                }
                else
                {
                    entero.val(parseInt(entero_temp));
                }
            }
        }

        //debe ser entero > 0
        var entero_cero = $(this).find('.validar_entero_cero')
        if(entero_cero.length)
        {
            if(entero_cero.val().length > 0)
            {
                var entero_temp_cero = entero_cero.val();
                if(!esNumero(entero_temp_cero))
                {
                    resultado=false;
                    $(entero_cero).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese un número entero válido</div>');
                }
                else
                {
                    var numero_cero = parseInt(entero_temp_cero);

                    if(numero_cero == 0)
                    {
                        resultado=false;
                        $(entero_cero).addClass('is-invalid');
                        $(grupo).find('.invalid-feedback').remove();
                        $(grupo).append('<div class="invalid-feedback">El número debe ser mayor que 0</div>');
                    }
                    else
                        entero_cero.val(parseInt(entero_temp_cero));
                }
            }
        }


        //debe ser decimal
        var decimal = $(this).find('.validar_decimal')
        if(decimal.length)
        {
            if(decimal.val().length>0)
            {
                var decimal_temp = decimal.val();
                if(!esNumero(decimal_temp))
                {
                    resultado=false;
                    $(decimal).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese un número decimal válido</div>');
                }
                else
                {
                    decimal.val(parseFloat(decimal_temp).toFixed(decimal_places));
                }
            }
        }

        //debe ser correo
        var correo = $(this).find('.validar_correo')
        if(correo.length)
        {
            if(correo.val().length>0)
            {                
                if(!esCorreo(correo.val()))
                {
                    resultado=false;
                    $(correo).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Ingrese un correo válido</div>');
                } 
            }
        }

        //debe ser igual
        var igual = $(this).find('[class*=validar_igual]')
        if(igual.length)
        {
            if(igual.val().length>0)
            {
                var className = igual.attr('class');
                var dos_index_mas = className.indexOf("validar_igual:");

                if(dos_index_mas!=-1)
                {
                    var dos_index = dos_index_mas + 13;
                    var space_index = className.indexOf(" ", dos_index);

                    if(space_index!=-1)
                        var id_otro = className.substring(dos_index + 1, space_index);
                    else
                        var id_otro = className.substring(dos_index + 1);

                    if(igual.val()!=$("#"+id_otro).val())
                    {
                        resultado=false;
                        $(igual).addClass('is-invalid');
                        $(grupo).find('.invalid-feedback').remove();
                        $(grupo).append('<div class="invalid-feedback">Los valores deben ser iguales</div>');
                    }
                }                
            }
        }

        //debe ser minimo
        var minimo = $(this).find('[class*=validar_minimo]')
        if(minimo.length)
        {
            if(minimo.val().length>0)
            {
                var className = minimo.attr('class');
                var dos_index_mas = className.indexOf("validar_minimo:");

                if(dos_index_mas!=-1)
                {
                    var dos_index = dos_index_mas + 14;
                    var space_index = className.indexOf(" ", dos_index);

                    if(space_index!=-1)
                        var tamaño = className.substring(dos_index + 1, space_index);
                    else
                        var tamaño = className.substring(dos_index + 1);

                    if(minimo.val().length < parseInt(tamaño))
                    {
                        resultado=false;
                        $(minimo).addClass('is-invalid');
                        $(grupo).find('.invalid-feedback').remove();
                        $(grupo).append('<div class="invalid-feedback">Debe contener al menos '+tamaño+' caracteres</div>');
                    }
                }                
            }
        }

        //debe ser maximo
        var maximo = $(this).find('[class*=validar_maximo]')
        if(maximo.length)
        {
            if(maximo.val().length>0)
            {
                var className = maximo.attr('class');
                var dos_index_mas = className.indexOf("validar_maximo:");

                if(dos_index_mas!=-1)
                {
                    var dos_index = dos_index_mas + 14;
                    var space_index = className.indexOf(" ", dos_index);

                    if(space_index!=-1)
                        var tamaño = className.substring(dos_index + 1, space_index);
                    else
                        var tamaño = className.substring(dos_index + 1);

                    if(maximo.val().length > parseInt(tamaño))
                    {
                        resultado=false;
                        $(maximo).addClass('is-invalid');
                        $(grupo).find('.invalid-feedback').remove();
                        $(grupo).append('<div class="invalid-feedback">El tamaño del texto no debe ser mayor a '+tamaño+' caracteres</div>');
                    }
                }                
            }
        }


        //debe ser diferente de 0
        var select  = $(this).find('.validar_select')
        if(select.length)
        {
            if(select.val().length>0)//esta vacio ignorar
            {
                var select_val = select.val(); 
                if(select_val=="0")
                {
                    resultado=false;
                    $(select).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">Seleccione una opción</div>');
                }
            }
        }

        //no debe contener caracteres  especiales
        var no_especial = $(this).find('.validar_no_especial')
        if(no_especial.length)
        {
            if(no_especial.val().length>0)
            { 
                if(esEspecial(no_especial.val()))
                {
                    resultado=false;
                    $(no_especial).addClass('is-invalid');
                    $(grupo).find('.invalid-feedback').remove();
                    $(grupo).append('<div class="invalid-feedback">No debe contener carácteres especiales</div>');
                } 
            }
        }

        //debe ser tamaño exacto
        var exacto = $(this).find('[class*=validar_exacto]')
        if(exacto.length)
        {
            if(exacto.val().length>0)
            {
                var className = exacto.attr('class');
                var dos_index_mas = className.indexOf("validar_exacto:");

                if(dos_index_mas!=-1)
                {
                    var dos_index = dos_index_mas + 14;
                    var space_index = className.indexOf(" ", dos_index);

                    if(space_index!=-1)
                        var tamaño = className.substring(dos_index + 1, space_index);
                    else
                        var tamaño = className.substring(dos_index + 1);

                    if(exacto.val().length != parseInt(tamaño))
                    {
                        resultado=false;
                        $(exacto).addClass('is-invalid');
                        $(grupo).find('.invalid-feedback').remove();
                        $(grupo).append('<div class="invalid-feedback">Debe contener '+tamaño+' caracteres</div>');
                    }
                }                
            }
        }

        

    });

    return resultado;
}

//limpiar validaciones de formulario
function limpiar(ident_form) {
    $(ident_form+" .form-group").each(function() {
        var l_textbox = $(this).find('input[type=text], input[type=email], input[type=password], input[type=file]');//es un textbox
        l_textbox.removeClass('is-invalid');

        var l_textarea = $(this).find('textarea');//es una textarea
        l_textarea.removeClass('is-invalid');

        var l_select = $(this).find('select')//es un select
        l_select.removeClass('is-invalid'); 

        $(this).find('.invalid-feedback').remove();
    });
}

//vaciar valores de formulario
function vaciar(ident_form) {
    $(ident_form+" .form-group").each(function() {        
        var textbox = $(this).find('input[type=text], input[type=email], input[type=password]')//es un textbox
        if(textbox.length)
            textbox.val('');

        var textarea = $(this).find('textarea')//es una textarea
        if(textarea.length)
            textarea.val('');
    });
}

//Verificar si es fecha válida
function esFecha(dateString)
{
    // First check for the pattern
    if(!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(dateString))
        return false;      
    // Parse the date parts to integers
    var parts = dateString.split("/");
    var day = parseInt(parts[0], 10);
    var month  = parseInt(parts[1], 10);    
    var year = parseInt(parts[2], 10);

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};

function esFechaAlt(dateString)
{
    // First check for the pattern
    if(!/^\d{4}[-]\d{1,2}[-]\d{1,2}$/.test(dateString))
        return false;      
    
    // Parse the date parts to integers
    var parts = dateString.split("-");
    var year = parseInt(parts[0], 10);
    var month  = parseInt(parts[1], 10);    
    var day = parseInt(parts[2], 10); 

    // Check the ranges of month and year
    if(year < 1000 || year > 3000 || month == 0 || month > 12)
        return false;

    var monthLength = [ 31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31 ];

    // Adjust for leap years
    if(year % 400 == 0 || (year % 100 != 0 && year % 4 == 0))
        monthLength[1] = 29;

    // Check the range of the day
    return day > 0 && day <= monthLength[month - 1];
};


//Verificar si es fecha y hora válida
function esFechaHora(dateString)
{    
    var pattern = new RegExp("^(3[01]|[12][0-9]|0[1-9])/(1[0-2]|0[1-9])/[0-9]{4} (2[0-3]|[01]?[0-9]):([0-5]?[0-9])$");

    if (dateString.search(pattern)===0) 
        return true;
    else 
        return false;
};

function esEspecial(texto) {
    var resultado = false;
    var splChars = "*|,\":<>[]{}`\';()@&$#%/\\";
    for (var i = 0; i < texto.length; i++) 
    {
        if(splChars.indexOf(texto.charAt(i)) != -1)
        {
            resultado = true;
            break;
        }
    }
    return resultado;
}

//convertir de dd/mm/yyy a yyyy-mm-dd
function db_fecha(dateString) {
    var fecha = dateString+"";    
    if(dateString!= null && fecha!=""){
        var parts = dateString.split("/");
        return parts[2]+'-'+parts[1]+'-'+parts[0];
    }
    else
        return "";    
}

function db_fecha_hora(dateString) {
    var fecha = dateString+"";    
    if(dateString!= null && fecha!=""){
        var s_fecha = dateString.substring(0,10);
        var s_hora = dateString.substring(11);
        var parts = s_fecha.split("/");
        return parts[2]+'-'+parts[1]+'-'+parts[0]+' '+s_hora+':00';
    }
    else
        return "";    
}

//convertir de yyyy-mm-dd hh:mm:ss a dd/mm/yyy
function dis_fecha(dateString) {
    var fecha = dateString+"";  
    if(dateString!= null && fecha!=""){
        var ofecha = new Date(fecha);
        return ('0' + ofecha.getDate()).slice(-2)+'/'+('0' + (ofecha.getMonth()+1)).slice(-2)+'/'+ofecha.getFullYear();
    }
    else
        return "";    
}

function dis_fecha_hora(dateString) {
    var fecha = dateString+"";  
    if(dateString!= null && fecha!=""){
        var ofecha = new Date(fecha);
        return ('0' + ofecha.getDate()).slice(-2)+'/'+('0' + (ofecha.getMonth()+1)).slice(-2)+'/'+ofecha.getFullYear()+' '+('0' + ofecha.getHours()).slice(-2)+':'+('0' + ofecha.getMinutes()).slice(-2);
    }
    else
        return "";            
}

function dis_solo_hora(dateString) {
    var fecha = dateString+"";  
    if(dateString!= null && fecha!=""){
        var ofecha = new Date(fecha);
        return ('0' + ofecha.getHours()).slice(-2)+':'+('0' + ofecha.getMinutes()).slice(-2);
    }
    else
        return "";            
}

function dis_hora(timeString) {
    var hora = timeString+"";  
    if(timeString!= null && hora!=""){
        var parts = hora.split(":");
        return parts[0]+':'+parts[1];
    }
    else
        return "";    
}

function obj_fecha(obj) {    
    if(typeof obj.getMonth === 'function')
        return ('0' + obj.getDate()).slice(-2)+'/'+('0' + (obj.getMonth()+1)).slice(-2)+'/'+obj.getFullYear();
    else
        return "";    
}

function obj_fecha_hora(obj) {    
    if(typeof obj.getMonth === 'function')
        return ('0' + obj.getDate()).slice(-2)+'/'+('0' + (obj.getMonth()+1)).slice(-2)+'/'+obj.getFullYear()+' '+('0' + +obj.getHours()).slice(-2)+':'+('0' + obj.getMinutes()).slice(-2);
    else
        return ""; 
}

function safeDecimal(texto) {
    if(isNaN(texto) | texto == null)    
        return 0
    else 
        return parseFloat(texto)
}

function safeMoney(texto) {
    if(isNaN(texto) | texto == null)    
        return (0).toFixed(decimal_places); 
    else 
    {
        if(texto!="")
        {
            var n_decimal = parseFloat(texto);
            return n_decimal.toFixed(decimal_places).replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");       
        }
        else
            return (0).toFixed(decimal_places); 
    }
}

//prevenir mostrar texto null
function safeText(texto) {
    if(texto!=null)
    {
        var aux = texto+"";
        return aux.replace("&#039;", "'");   
    }    
    else
        return "";
}

function safeHTML(texto) {
    if(texto!=null)    
        return sds = $("<div/>").html(texto).text();      
    else
        return "";
}

function safeListCount(lista) {
    if(lista != null)   
        return lista.length;    
    else
        return 0;
}

//comprobar si es numero
function esNumero(numberString) 
{
    return !isNaN(numberString)    
}

function esCorreo(dateEmail)
{
    var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(dateEmail);
};

function textoMax(texto, max) 
{
    if(texto != null)
    {
        if(texto.length > max)
            return texto.substring(0, max)+"...";   
        else
            return texto;  
    }
    else
        return "";
}

function ceros(num, zero) {
    var str = "" + num;
    var pad = "0".repeat(zero);
    return pad.substring(0, pad.length - str.length) + str;
}

//obtener el elemento de una lista por su id
function elementId(idb, datos) {
    var res = null;
    for (let i = 0; i < datos.length; i++) {
        if(datos[i].id==idb)
        {
            res = datos[i];
            break;
        }        
    }
    return res;
}



/**
 * ssss
 */

 function alerta(mensaje, estado) 
 {
    if(estado)
    {
        $('<div class="notificacion alert alert-important alert-success alert-dismissible shadow" role="alert">'+
            '<div class="d-flex">'+
                '<div>'+
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>'+
                '</div>'+
                '<div>'+mensaje+'</div>'+
            '</div>'+
            '<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close" onclick="alerta_cerrar(this);"></a>'+
        '</div>').appendTo(default_contanier).delay(5000).queue(function() { $(this).remove(); });
    }
    else
    {
        $('<div class="notificacion alert alert-important alert-danger alert-dismissible shadow" role="alert">'+
            '<div class="d-flex">'+
                '<div>'+
                    '<svg xmlns="http://www.w3.org/2000/svg" class="icon alert-icon" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><circle cx="12" cy="12" r="9"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12.01" y2="16"></line></svg>'+
                '</div>'+
                '<div>'+mensaje+'</div>'+
            '</div>'+
            '<a class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="close" onclick="alerta_cerrar(this);"></a>'+
        '</div>').appendTo(default_contanier).delay(5000).queue(function() { $(this).remove(); });
    }
}

function alerta_cerrar(notif) 
{
    //e.preventDefault();
    var parent = $(notif).parent('.notificacion');
    parent.remove();
    //parent.fadeOut("slow", function() { $(this).remove(); } );
}
 

function response_helper(response) {    
    
    var res_text = JSON.stringify(response);
    if(res_text.indexOf("CSRF token mismatch.") !== -1) {
        setTimeout(function () { location.reload(); }, 3000);
        return "La sesión ha expirado"; 
    }        
    
    if(response.hasOwnProperty('responseJSON'))   
    {
        console.log('Tiene responseJSON');
        return JSON.stringify(response.responseJSON.message); 
    } 
        
    
    else if(response.hasOwnProperty('responseText'))        
    {
        console.log('Tiene responseText');
        var converted = JSON.parse(response.responseText);
        if(converted.hasOwnProperty('message'))
        {
            console.log('Tiene responseText message');
            return converted.message;
        }
        else
        {
            console.log('Tiene responseText sin message');
            return textoMax(JSON.stringify(converted), 150);
        }
    }
        
    var converted = JSON.parse(response);
    if(converted.hasOwnProperty('message'))
    {
        console.log('Tiene  message');
        return JSON.stringify(converted.message); 
    }   
    
    console.log('No tiene nada ');
    return textoMax(JSON.stringify(response), 150);          
    
}

function url_time(url) {
    var d = new Date();
    return url+'?t='+d.getTime();
}


/*----- */


$( document ).ready(function() {

    //forzar mayuscula
    $('.mayuscula').keyup(function(event){
        var start = this.selectionStart;
        var end = this.selectionEnd;
        this.value = this.value.toUpperCase();
        this.setSelectionRange(start, end);
    });


});
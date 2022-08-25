$(document).ready(function() {
    $(".wrapper").show('fast');
    //funciones que se ejecutan automaticamente
    //-------------------------------------------------------------------------------------------------
    //codigo 
    
});
//funciones que se ejecutan por medio de eventos
/*-----------------------------------------------------------------------------------------------*/
$("#guardarGrupo").on('click', function() {
    var url = 'grupo.edit';
    guardarRegistro(url);
});
$('#estados').change(function() {
    var tipo;
    var id;
    var campo;
    tipo = 108;
    campo = '#municipios';
    id = $('#estados').val();
    cargarCombo(tipo, id, campo);
});
$("#estados1").change(function() {
    var tipo;
    var id;
    var campo;
    tipo = 108;
    campo = '#municipios1';
    id = $("#estados1").val();
    cargarCombo(tipo, id, campo);
});

$(".forml").on('submit', function(e) {
    e.preventDefault();
    var url = $(this).attr("action");
    var forml = $(this);
    datosUsuario(url, forml);
});

//Funciones
//-----------------------------------------------------------------------------------------------------
function mostrarAlert(){
    $('#alerts').delay(1000).show('swing');
    $('#alerts').delay(10000).hide('swing');
}
 
/**
 * [status description]
 * @return {[type]} [description]
 */
 function status() {
    var valor = $('#status').value();
    alert(valor);
}
/**
 * [CargarCombo]
 * [recibe 3 parametros desde un select para activar un combo dependiente]
 * @param  {[integer]} tipo  [tipo de nomeclador]
 * @param  {[integer]} id    [id de nomenclador]
 * @param  {[string]} campo  [id del campo dependiente]
 * @return {[function]}      [data]
 */
 function cargarCombo(tipo, id, campo) {
    var url = "create/combosBox/"+tipo+"/"+id;
    alert(url);
    $.get(url, function(data) {
        $(campo).empty();
        $(campo).append('<option value="">Seleccione</option>');
        $(campo).append(data);
    });
}

function cargarCombo1(tipo, id, campo) {
    var url = "integrantes/" + tipo + "/" + id;
    // alert(url);
    $.get(url, function(data) {
        $(campo).empty();
        $(campo).append('<option value="">Seleccione</option>');
        $(campo).append(data);
    });
}

 function datosUsuario(url, forml) {
    var token = $("#token").val();
   
    $.ajax({
        beforeSend: function() {
            $('#alerta').removeClass();
            $('#alerta').html('<span class="text-info"><img src="http://localhost/bandas/public/template/assets/images/ajax-loader.gif" alt="carg" height="20px"/> Buscando datos...</span>');
            $('#alerta').show("fast");
        },
        headers: {
            'X-CSRF-Token': token
        },
        url: url,
        type: 'POST',
        data: forml.serialize(),
        cache: false,
        success: function(data) {
            $('#alerta').hide();
            var pa =  data.PERSONA.PAPELLIDO;
            let sa =  data.PERSONA.SAPELLIDO;
            var pn =  data.PERSONA.PNOMBRE;
            let sn =  data.PERSONA.SNOMBRE;
            var cedula =  data.PERSONA.CEDULA;
            let pasub= pa.substr(0,1);
            let pnsub = pn.substr(0,1);
            let cedsub = cedula.substr(-5);

            if(sa == null && sn != null){
                var snsub = sn.substr(0,1);
                var result = `${pasub}${pnsub}${snsub}${cedsub}`
                console.log('segundo nombre sin datos')
            }else if(sa == null && sn == null){
                var cero = '0'
                var result = `${pasub}${pnsub}${cero}${cedsub}`
                console.log('segundo nombre y apellido sin datos')
            }else {                            
                var sasub = sa.substr(0,1);
                var result = `${pasub}${sasub}${pnsub}${cedsub}`
                console.log('segundo nombre con datos')
            }

            
            console.log(result)
            if (data != 'null') {
                console.log(data);
                $('#LETRACED').empty();
                $('#LETRACED').html("<option value='" + data.PERSONA.LETRACED + "'>" + data.PERSONA.LETRACED + "</option>");
                $('#CEDULA').empty();
                $('#CEDULA').val(data.PERSONA.CEDULA);
                $('#pNombre').empty();
                $('#pNombre').val(data.PERSONA.PNOMBRE)
                $('#sNombre').empty();
                $('#sNombre').val(data.PERSONA.SNOMBRE)
                $('#pApellido').empty();
                $('#pApellido').val(data.PERSONA.PAPELLIDO);
                $('#sApellido').empty();
                $('#sApellido').val(data.PERSONA.SAPELLIDO);
                $('#fecha_nacimiento').empty();
                $('#fecha_nacimiento').val(data.PERSONA.FECHANAC);
                $('#sexo').empty();
                $('#sexo').html("<option value='" + data.PERSONA.IDSEXO + "'>" + data.PERSONA.SEXO + "</option>")

                $('#credencial').empty();
                $('#credencial').val(data.FUNCIONARIO.CREDENCIAL);
                $('#organismos').html("<option value='9865879'>CICPC</option>");
                $('#rangos').empty();
                $('#rangos').html("<option value='" + data.FUNCIONARIO.IDRANGO + "'>" + data.FUNCIONARIO.RANGO + "</option>");
                $('#ESTATUSL').empty();
                $('#ESTATUSL').html("<option value='" + data.FUNCIONARIO.IDESTATUSLABORAL + "'>" + data.FUNCIONARIO.ESTATUSLABORAL + "</option>");

                $('#nameuser').empty();
                $('#nameuser').val(result)
                $('#password').empty();
                $('#password').val(data.PERSONA.CEDULA);
                $('#password_confirmation').empty();
                $('#password_confirmation').val(data.PERSONA.CEDULA);
                
            } else{
                $('#alerta').removeClass();
                $('#alerta').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span asira-hidden="true">&times;</span></button><p><strong><i class="glyphicon glyphicon-warning-sign"></i> ATENCION: </strong> No se encontraron datos de funcionario</p></div>');
                $('#alerta').show("fast");
            }
        },
        error: function(msj) {
            $('#alerta').hide();
            // console.log(msj);
            var status = msj.statusText;
            if (status != "Internal Server Error") {
                var errors = $.parseJSON(msj.responseText);
                $.each(errors, function(key, value) {
                    $("#" + key + "_group").addClass("has-error");
                    $("#" + key + "_span").text(value);
                });
                // alert(data.PERSONA.CEDULA+'.jpg');   
                // $("#avatar").attr('src', 'http://localhost/SIGEPOL/public/img/avatar/' + data.PERSONA.CEDULA + '.jpg');
            } else {
                Command: toastr["warning"]( "¡No se encontraron datos del funcionario!","¡Alerta!")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-full-width",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                  }
            }
        },
        timeout: 15000
    });
}

function dastosPersona(url2, form2) {
   var token = $("#token").val();
  
   $.ajax({
       beforeSend: function() {
           $('#alerta').removeClass();
           $('#alerta').html('<span class="text-info"><img src="http://localhost/bandas/public/template/assets/images/ajax-loader.gif" alt="carg" height="20px"/> Buscando datos...</span>');
           $('#alerta').show("fast");
       },
       headers: {
           'X-CSRF-Token': token
       },
       url: url2,
       type: 'POST',
       data: form2.serialize(),
       cache: false,
       success: function(data) {
            $('#alerta').hide();
            if (data != 'null') {
                if (data.ESTATUS.MENSAJE.PERSONA.ESTADO == 1) {
                    toastr.error('¡STATUS SIIPOL: SOLICITADO!', '¡Atención!')
                    toastr.options = {
                        "closeButton": true,
                        "debug": false,
                        "newestOnTop": true,
                        "progressBar": true,
                        "positionClass": "toast-top-right",
                        "preventDuplicates": false,
                        "onclick": null,
                        "showDuration": "100000",
                        "hideDuration": "100000",
                        "timeOut": "100000",
                        "extendedTimeOut": "100000",
                        "showEasing": "swing",
                        "hideEasing": "linear",
                        "showMethod": "fadeIn",
                        "hideMethod": "fadeOut"
                      }
                    $('#estatus_victimario').html('<option value="9865750">Solicitado</option>');
                }
                $('#LETRACED').empty();
                $('#LETRACED').html("<option value='" + data.DATOSPERSONALES.MENSAJE.PERSONA.LETRACED + "'>" + data.DATOSPERSONALES.MENSAJE.PERSONA.LETRACED + "</option>");
                $('#CEDULA').empty();
                $('#CEDULA').val(data.DATOSPERSONALES.MENSAJE.PERSONA.CEDULA);
                $('#pNombre').empty();
                $('#pNombre').val(data.DATOSPERSONALES.MENSAJE.PERSONA.PNOMBRE)
                $('#sNombre').empty();
                $('#sNombre').val(data.DATOSPERSONALES.MENSAJE.PERSONA.SNOMBRE)
                $('#pApellido').empty();
                $('#pApellido').val(data.DATOSPERSONALES.MENSAJE.PERSONA.PAPELLIDO);
                $('#sApellido').empty();
                $('#sApellido').val(data.DATOSPERSONALES.MENSAJE.PERSONA.SAPELLIDO);
                $('#fecha_nacimiento').empty();
                $('#fecha_nacimiento').val(data.DATOSPERSONALES.MENSAJE.PERSONA.FECHANAC);
                $('#sexo').empty();

                if (data.DATOSPERSONALES.MENSAJE.PERSONA.SEXO == 'M') {
                    $('#sexo').html("<option value='4820000'>" + data.DATOSPERSONALES.MENSAJE.PERSONA.SEXO + "</option>")  
                }
                if (data.DATOSPERSONALES.MENSAJE.PERSONA.SEXO == 'F') {
                    $('#sexo').html("<option value='4820001'>" + data.DATOSPERSONALES.MENSAJE.PERSONA.SEXO + "</option>")
                }
                             
               console.log(data);
       
           } else{
               $('#alerta').removeClass();
               $('#alerta').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span asira-hidden="true">&times;</span></button><p><strong><i class="glyphicon glyphicon-warning-sign"></i> ATENCION: </strong> No se encontraron datos de funcionario</p></div>');
               $('#alerta').show("fast");
           }
       },
       error: function(msj) {
           $('#alerta').hide();
           // console.log(msj);
           var status = msj.statusText;
           if (status != "Internal Server Error") {
               var errors = $.parseJSON(msj.responseText);
               $.each(errors, function(key, value) {
                   $("#" + key + "_group").addClass("has-error");
                   $("#" + key + "_span").text(value);
               });
               // alert(data.PERSONA.CEDULA+'.jpg');   
               // $("#avatar").attr('src', 'http://localhost/SIGEPOL/public/img/avatar/' + data.PERSONA.CEDULA + '.jpg');
           } else {
               Command: toastr["warning"]( "¡No se encontraron datos!","¡Alerta!")
               toastr.options = {
                   "closeButton": true,
                   "debug": false,
                   "newestOnTop": false,
                   "progressBar": false,
                   "positionClass": "toast-bottom-full-width",
                   "preventDuplicates": false,
                   "onclick": null,
                   "showDuration": "300",
                   "hideDuration": "1000",
                   "timeOut": "5000",
                   "extendedTimeOut": "1000",
                   "showEasing": "swing",
                   "hideEasing": "linear",
                   "showMethod": "fadeIn",
                   "hideMethod": "fadeOut"
                 }
           }
       },
       timeout: 15000
   });
}

function datosVehiculos(url3, form3) {
    var token = $("#token").val();
   
    $.ajax({
        beforeSend: function() {
            $('#alerta').removeClass();
            $('#alerta').html('<span class="text-info"><img src="http://localhost/bandas/public/template/assets/images/ajax-loader.gif" alt="carg" height="20px"/> Buscando datos...</span>');
            $('#alerta').show("fast");
        },
        headers: {
            'X-CSRF-Token': token
        },
        url: url3,
        type: 'POST',
        data: form3.serialize(),
        cache: false,
        success: function(data) {
            $('#alerta').hide();
            //ñconsole.log(data.vehiculo.placa);
            if(data == 'false'){
                var mensaje = 'No se pudo establecer conexión con el servicio INTT, por favor intente mas tarde.';
                $('#alertaVehiculo').removeClass();
                $('#alertaVehiculo').empty();
                $('#alertaVehiculo').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"></button><p><strong><i class="glyphicon glyphicon-remove-sign"></i> </strong>'+mensaje+'</p></div>');
                $('#placaN').val('');
                $('#serialC').val('');
                $('#serialM').val('');
                $('#modeloVeh').val('');
                // $('#marca').html("<option value=''>--Seleccione--</option>");
                //$('#modelo').html("<option value=''>--Seleccione--</option>");
                // $('#tipo').html("<option value=''>--Seleccione--</option>");
                // $('#uso').html("<option value=''>--Seleccione--</option>");
                $('#serialM').val('');
                $('#colorAInttt').val('');
                // $('#colorAb').val('');
                $('#anio').val('');
            }

            if (data.vehiculo.placa != undefined) {
                $('#placaN').val(data.vehiculo.placa);
                $('#serialC').val(data.vehiculo.serialcarroceria);
                $('#serialM').val(data.vehiculo.serialmotor);
                $('#modeloVeh').val(data.vehiculo.modelo);
                $('#serialM').val(data.vehiculo.serialmotor);
                $('#anio').val(data.vehiculo.anno);

                if(data.vehiculo.origen == 'INTT'){
                    var mensaje = 'Marca: '+data.vehiculo.marca+'. Tipo: '+data.vehiculo.tipovehiculo+'. Uso: '+data.vehiculo.usoplaca+'. Color de arriba: '+data.vehiculo.colorsuperior+'. Color de abajo: '+data.vehiculo.colorinferior+'';
                    //var mensaje = 'El color del vehiculo es '+result.vehiculo.colorsuperior+'';
                    $('#alertaVehiculo').removeClass();
                    $('#alertaVehiculo').empty();
                    $('#alertaVehiculo').html('<div class="alert alert-info" role="alert">'+mensaje+'</div>');
                    $('#alertaVehiculo').show("fast");
                    $('#origen').val(result.vehiculo.origen);
                    $('#modelo').val(result.vehiculo.modelo);
                    $('#colorAbIntt').val(result.vehiculo.colorinferior);
                }

                if (data.vehiculo.status == 'SOLICITADO') {
                    var mensaje = 'El vehículo placas N°:'+data.vehiculo.placa+' tiene un estatus <strong>Solicitado</strong> en SIIPOL';
                    var info = 'Marca: '+data.vehiculo.marca+'. Tipo: '+data.vehiculo.tipovehiculo+'. Uso: '+data.vehiculo.usoplaca+'. Color de arriba: '+data.vehiculo.colorsuperior+'. Color de abajo: '+data.vehiculo.colorinferior+'';
                    $('#alertaVehiculo').removeClass();
                    $('#alertaVehiculo').empty();
                    $('#alertaVehiculo').html('<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong><i class="fas fa-exclamation"></i> Atención: '+mensaje+'</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'+'<div class="alert alert-info" role="alert">'+info+'</div>');
                    $('#alertaVehiculo').show("fast");
                }    
            }
        
             else{
                $('#alerta').removeClass();
                $('#alerta').html('<div class="alert alert-warning alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span asira-hidden="true">&times;</span></button><p><strong><i class="glyphicon glyphicon-warning-sign"></i> ATENCION: </strong> No se encontraron datos de funcionario</p></div>');
                $('#alerta').show("fast");
            }
        },
        error: function(msj) {
            $('#alerta').hide();
            // console.log(msj);
            var status = msj.statusText;
            if (status != "Internal Server Error") {
                var errors = $.parseJSON(msj.responseText);
                $.each(errors, function(key, value) {
                    $("#" + key + "_group").addClass("has-error");
                    $("#" + key + "_span").text(value);
                });
                // alert(data.PERSONA.CEDULA+'.jpg');   
                // $("#avatar").attr('src', 'http://localhost/SIGEPOL/public/img/avatar/' + data.PERSONA.CEDULA + '.jpg');
            } else {
                Command: toastr["warning"]( "¡No se encontraron datos!","¡Alerta!")
                toastr.options = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": "toast-bottom-full-width",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                  }
            }
        },
        timeout: 15000
    });
 }

function redirect(e) {
    window.location = e.value;
}
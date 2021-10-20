$(document).ready(function() {
   
    $('#registro').validetta({
        
        realTime: true,
        display : 'inline',
        errorTemplateClass : 'validetta-inline',
        
        onValid: function(e) {
            
            e.preventDefault();
            
            $.ajax({
            url: "ajax/usuarios.ajax.php",
            method: "POST",
            data: $("#registro").serialize(),
            dataType: "text",
           
            success: function(respuesta) {


                if(respuesta == "ok"){

                    swal({
                      title: "¡REGISTRO EXITOSO!",
                      text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico, para validar la cuenta!",
                      type:"success",
                      confirmButtonText: "Cerrar",
                      closeOnConfirm: false
                    },function () {
                        window.location = "login";
                    })

                }

            }
          }); 

        }
    });


})

/*=============================================
VALIDAR USUARIO 
=============================================*/
$(document).on("blur", "#usuario", function() {

    if($(this).val()!=""){

        var datos = new FormData();
            datos.append("validarUsuario", $(this).val());
            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                      
                   if(respuesta){
                        $("#usuario").val("")
                        $.notify("Este usuario ya se registro en la base de datos!", { type: "danger", placement: { from: "top", align: "center" } })
        
                   }
        
                }
        
            })

    }

     
 })

 /*=============================================
VALIDAR CORREO 
=============================================*/
$(document).on("blur", "#correo", function() {

    if($(this).val()!=""){

        var datos = new FormData();
            datos.append("validarCorreo", $(this).val());
            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
                      
                   if(respuesta){
                        $("#correo").val("")
                        $.notify("Este correo ya se registro en la base de datos!", { type: "danger", placement: { from: "top", align: "center" } })
        
                   }
        
                }
        
            })
    }

     
 })

  /*=============================================
VALIDAR DOCUMENTO
=============================================*/
$(document).on("blur", "#documento", function() {

    if($(this).val()!=""){


        var datos = new FormData();
            datos.append("validarDocumento", $(this).val());
            $.ajax({
                url: "ajax/usuarios.ajax.php",
                method: "POST",
                data: datos,
                cache: false,
                contentType: false,
                processData: false,
                dataType: "json",
                success: function(respuesta) {
    
                   if(respuesta){
                        $("#documento").val("")
                        $.notify("Este documento ya se registro en la base de datos!", { type: "danger", placement: { from: "top", align: "center" } })
                        
                   }
        
                }
        
            })

    }

     
 })
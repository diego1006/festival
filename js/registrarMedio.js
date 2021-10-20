$(document).ready(function(){
  
    cargarTipoMedio();
    mostrarById(0);
    registroMedio();

})

function mostrarById(id){

    var datos = new FormData();
    datos.append("id", id);
    
    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            if(respuesta == false){
                mostrarSinTipo()
            }else{
                $("#tipoMedio").attr("readonly", true)
                $("#nombreMedio").val(respuesta["nombre"])
                $("#responsableMedio").val(respuesta["representante"])
                $("#documentoMedio").val(respuesta["documento"])
                $("#documento").html(respuesta["documento"])
                $("#telefonoMedio").val(respuesta["telefono"])
                $("#ciudadMedio").val(respuesta["ciudad"])
                $("#direccionMedio").val(respuesta["direccion"])
                $("#correoMedio").val(respuesta["correo"])
                $("#tipoMedio").val(respuesta["idTipo"])
                $("#oculto").val(respuesta["tipo"])
                $("#oculto").removeAttr("hidden", true)
                $("#tipoMedio").attr("hidden", true)
                $("#estadoMedio").val(respuesta["estado"])
                $(".previsualizar").attr("src", respuesta["foto"]);
                $("#fotoActual").val(respuesta["foto"]);

            }           

        }

    })
}

function mostrarSinTipo(){

    var datos = new FormData();
    datos.append("sinTipo", 0);
    
    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#correoMedio").val(respuesta["usuco"]) 
            $("#documentoMedio").val(respuesta["usudoc"])
            $("#tipoMedio").removeAttr("hidden", true)
            $("#estadoMedio").val(respuesta["estado"])

        }

    })
}

function cargarTipoMedio() {
    var datos = new FormData();
    datos.append("tipo", 0);

    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            $("#tipoMedio").append('<option value="">Seleccione el medio a inscribir</option>')

            respuesta.forEach(function (element, index) {

                $("#tipoMedio").append('<option value="' + element.id + '">' + element.nombre + '</option>')

            })

        }

    })

}

function registroMedio(){

    $('#crearMedio').validetta({
        realTime: true,
        showErrorMessages: true, // If you dont want to display error messages set this option false
        /** You can display errors as inline or bubble */
        display: 'bubble', // bubble or inline
        /**
         * Error template class
         * This is the class which will be added to the error message window template.
         * If you want special style, you can change class name as you like with this option.
         * Error message window template : <span class="errorTemplateClass">Error messages will be here !</span>
         */
        errorTemplateClass: 'validetta-bubble',
        /** Class that would be added on every failing validation field */
        errorClass: 'validetta-error',
        /** Same for valid validation */
        onValid: function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: 'ajax/registrarMedio.ajax.php',
                data: new FormData($('#crearMedio')[0]),
                dataType: 'text',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#guardar').attr("disabled", "disabled");
                    $('#crearMEdio').css("opacity", ".5");
                },
                success: function (respuesta) {

                    if (respuesta == "ok") {
             
                        swal({
                            title: "¡DATOS GUARDADOS!",
                            text: "El medio ha sido guardado con éxito",
                            type:"success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        },function () {

                            window.location = "registrarMedio";
                        })
                    }
                 
                    $('#crearMedio').css("opacity", "");
                    $("#guardar").removeAttr("disabled");
                }
            }).fail(function (jqXHR, textStatus, errorThrown) {
                if (jqXHR.status === 0) {
                    alert('Not connect: Verify Network.');
                } else if (jqXHR.status == 404) {
                    alert('Requested page not found [404]');
                } else if (jqXHR.status == 500) {
                    alert('Internal Server Error [500].');
                } else if (textStatus === 'parsererror') {
                    console.log(jqXHR);
                    alert('Requested JSON parse failed.');
                } else if (textStatus === 'timeout') {
                    alert('Time out error.');
                } else if (textStatus === 'abort') {
                    alert('Ajax request aborted.');
                } else {
                    alert('Uncaught Error: ' + jqXHR.responseText);
                }
            });
        }, onError: function (event) {
            $.notify("Hay unos problemas en el formulario", { type: "danger", placement: { from: "top", align: "center" } });
        }
    });
}

    // =============================================================================
// Subir foto 
// =============================================================================
$(".nuevaFoto").on("change",function (e) {

    imagen = this.files[0];

    if (imagen["type"] != 'image/jpeg' && imagen["type"] != 'image/png' && imagen["type"] != 'image/gif') {
        $(".nuevaFoto").val("");
      
        $.notify("Las imágen debe estar en formato JPEG-PNG-GIF", {
            type: "danger",
            placement: {
                from: "top",
                align: "center"
            }
        });

    } else if (imagen["size"] > 2000000) {
        $(".nuevaFoto").val("");

        // $(".file-path").css('border-color', '#ff0000');
        // $(".vistaPrevia").html('<div class="marco w-18"><img class="w-100" src="img/usuarios/default/anonymous.png" width="250" height="150" style="margin-bottom: 15px;"></div>');

        $.notify("El peso de la imágen debe ser menor de 2 MB", {
            type: "danger",
            placement: {
                from: "top",
                align: "center"
            }
        });

    } else {

        var datosImagen = new FileReader;
        datosImagen.readAsDataURL(imagen);
        $(datosImagen).on("load", function (event) {
            var rutaImagen = event.target.result;
           
            $(".previsualizar").attr("src", rutaImagen);
 
        })

    }
})
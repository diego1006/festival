var x = 0;
$(document).ready(function () {
    cargar();
    $('#completarDatos').validetta({
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
                url: 'ajax/logistica.ajax.php',
                data: new FormData($('#completarDatos')[0]),
                dataType: 'json',
                contentType: false,
                cache: false,
                processData: false,
                beforeSend: function () {
                    $('#guardar').attr("disabled", "disabled");
                    $('#completarDatos').css("opacity", ".5");
                },
                success: function (respuesta) {
                    if (respuesta == "ok") {
                        $('#completarDatos')[0].reset();
                        cargar();
                        swal({
                            title: "¡DATOS GUARDADOS!",
                            text: "Tus datos se han guardado con éxito, seras notificado por correo si eres aprobado para participar en la logística del festival vallenato",
                            type:"success",
                            confirmButtonText: "Cerrar",
                            closeOnConfirm: false
                        }
                        )
                    }
                    $('#completarDatos').css("opacity", "");
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
});

function getFiles() {
    var idFiles = document.getElementById("logArchivo");
    // Obtenemos el listado de archivos en un array
    var archivos = idFiles.files;
    // Creamos un objeto FormData, que nos permitira enviar un formulario
    // Este objeto, ya tiene la propiedad multipart/form-data
    var data = new FormData();
    // Recorremos todo el array de archivos y lo vamos añadiendo all
    // objeto data
    for (var i = 0; i < archivos.length; i++) {
        // Al objeto data, le pasamos clave,valor
        data.append("archivo" + i, archivos[i]);
    }
    return data;
}
// $('#completarDatos').submit(function (e) {
//     e.preventDefault();
// });

function cargar() {
    var datos = new FormData();
    datos.append("id", null);

    $.ajax({
        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            $("#logId").val(respuesta.id);
            $("#logNombre").val(respuesta.nombre);
            $("#logEstado").val(respuesta.estado);
            $("#logUsuario").val(respuesta.usuario);
            $("#logApellido").val(respuesta.apellido);
            $("#logFechaNacimiento").val(respuesta.fechaNacimiento);
            $("#logCedula").val(respuesta.documento);
            $("#logCorreo").val(respuesta.correoUsuario);
            $("#logTelefono").val(respuesta.telefono);
            $("#logCelular").val(respuesta.celular);
            $("#logCiudad").val(respuesta.ciudad);
            $("#logDireccion").val(respuesta.direccion);
            $("#logEdad").val(respuesta.edad);
            $("#logEstatura").val(respuesta.estatura);
            $("#logGrupoSanguineo").val(respuesta.grupoSanguineo);
            $("#logOcupacion").val(respuesta.ocupacion);
            var radios = $('input:radio[name=logGenero]');
            $.each(radios, function (indexInArray, valueOfElement) {
                if(respuesta.genero.split(",")[0] == "Otro"){
                    $("#generoOtro").attr("checked", true);
                    $("#logGeneroOtro").val(respuesta.genero.substring(5, respuesta.genero.length));
                    $("#logGeneroOtro").attr("data-validetta", "required");
                    $("#logGeneroOtro").show();
                }else{
                    if (valueOfElement.value == respuesta.genero) {
                        valueOfElement.checked = true;
                    }
                }
            });

            var radios = $('input:radio[name=logFormacionAcademica]');
            $.each(radios, function (indexInArray, valueOfElement) {
                
                if(respuesta.formacionAcademica.split(",")[0] == "Otro"){
                    $("#formacionOtro").attr("checked", true);
                    $("#logFormacionAcademicaOtro").val(respuesta.formacionAcademica.substring(5, respuesta.formacionAcademica.length));
                    $("#logFormacionAcademicaOtro").attr("data-validetta", "required");
                    $("#logFormacionAcademicaOtro").show();
                }else{
                    if (valueOfElement.value == respuesta.formacionAcademica) {
                        valueOfElement.checked = true;
                    }
                }
            });

            var radios = $('input:radio[name=logTrabajoAntes]');
            $.each(radios, function (indexInArray, valueOfElement) {
                if (valueOfElement.value == respuesta.trabajoAnterior) {
                    valueOfElement.checked = true;
                }
            });

            inputFile(respuesta.usuario);
        }
    }).fail(function (jqXHR, textStatus, errorThrown) {
        if (jqXHR.status === 0) {
            alert('Not connect: Verify Network.');
        } else if (jqXHR.status == 404) {
            alert('Requested page not found [404]');
        } else if (jqXHR.status == 500) {
            alert('Internal Server Error [500].');
        } else if (textStatus === 'parsererror') {
            alert('Requested JSON parse failed.');
        } else if (textStatus === 'timeout') {
            alert('Time out error.');
        } else if (textStatus === 'abort') {
            alert('Ajax request aborted.');
        } else {
            alert('Uncaught Error: ' + jqXHR.responseText);
        }
    });
}

$("#logFechaNacimiento").change(function () {
    $("#logEdad").val(calcularEdad($(this).val()));
});

$('input:radio[name=logGenero]').change(function () {
    if ($(this).is(':checked') && $(this).val() == 'Otro') {
        $("#logGeneroOtro").show();
        $("#logGeneroOtro").attr("data-validetta", "required");
    } else {
        $("#logGeneroOtro").hide();
        $("#logGeneroOtro").removeAttr("data-validetta");
    }
});

$('input:radio[name=logFormacionAcademica]').change(function () {
    if ($(this).is(':checked') && $(this).val() == 'Otro') {
        $("#logFormacionAcademicaOtro").show();
        $("#logFormacionAcademicaOtro").attr("data-validetta", "required");
    } else {
        $("#logFormacionAcademicaOtro").hide();
        $("#logFormacionAcademicaOtro").removeAttr("data-validetta");
    }
});

function calcularEdad(fecha) {
    var hoy = new Date();
    var cumpleanos = new Date(fecha);
    var edad = hoy.getFullYear() - cumpleanos.getFullYear();
    var m = hoy.getMonth() - cumpleanos.getMonth();

    if (m < 0 || (m === 0 && hoy.getDate() < cumpleanos.getDate())) {
        edad--;
    }

    return edad;
}

function inputFile(usuario) {
    var datos = new FormData();
    datos.append("direcUsuario", usuario);

    $.ajax({
        type: 'POST',
        url: 'ajax/logistica.ajax.php',
        data: datos,
        dataType: 'json',
        contentType: false,
        cache: false,
        processData: false,
        success: function (respuesta) {
            
            var rutas = [];
            var nombres = [];
            var preview = [];
            if(respuesta){
    
                $.each(respuesta, function (indexInArray, valueOfElement) { 
                    rutas.push(respuesta[indexInArray].Ruta.substring(3, (respuesta[indexInArray].Ruta).length));
                    nombres.push(respuesta[indexInArray].Nombre);
                    if(getFileExtension(respuesta[indexInArray].Nombre) == "pdf"){
                        preview.push(
                            { type: "pdf", size: 8000, caption: respuesta[indexInArray].Nombre, key: indexInArray },
                        )
                    }else{
                        preview.push(
                            { caption: respuesta[indexInArray].Nombre, size: 632762, width: "120px", key: indexInArray }
                        )
                    }
                });
            }

            $('#logArchivo').fileinput('destroy');
            $('#logArchivo').fileinput({
                theme: 'fa',
                language: 'es',
                uploadUrl: 'ajax/archivos.ajax.php',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'jpeg'],
                uploadAsync: false,
                initialPreviewAsData: true,
                initialPreview: rutas,
                initialPreviewConfig: preview,
                initialPreviewShowDelete: false
            });
            // for (let i = 0; i < respuesta.length; i++) {
                
                
            // }
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
}

function getFileExtension(filename) {
    return filename.split('.').pop();
}

// Tipos de archivos admitidos por su extensión
var tipos = ['gif', 'jpg', 'png', 'pdf'];
// Contadores de archivos subidos por tipo
var contadores = [0, 0, 0, 0];
// Reinicia los contadores de tipos subidos
var reset_contadores = function () {
    for (var i = 0; i < tipos.length; i++) {
        contadores[i] = 0;
    }
};
// Incrementa el contador de tipo según la extensión del archivo subido	
var contadores_tipos = function (archivo) {
    for (var i = 0; i < tipos.length; i++) {
        if (archivo.indexOf(tipos[i]) != -1) {
            contadores[i] += 1;
            break;
        }
    }
};

// Evento filecleared del plugin que se ejecuta cuando pulsamos el botón 'Quitar'
//    Vaciamos y ocultamos el div de alerta
$('#logArchivo').on('filecleared', function (event) {
    $('div.alert').empty();
    $('div.alert').hide();
});
// Evento filebatchuploadsuccess del plugin que se ejecuta cuando se han enviado todos los archivos al servidor
//    Mostramos un resumen del proceso realizado
//    Carpeta donde se han almacenado y total de archivos movidos
//    Nombre y tamaño de cada archivo procesado
//    Totales de archivos por tipo
$('#logArchivo').on('filebatchuploadsuccess', function (event, data, previewId, index) {

    var ficheros = data.files;
    var respuesta = data.response;
    var total = data.filescount;
    var mensaje;
    var archivo;
    var total_tipos = '';

    reset_contadores(); // Resetamos los contadores de tipo de archivo
    // Comenzamos a crear el mensaje que se mostrará en el DIV de alerta
    mensaje = '<p>' + total + ' ficheros almacenados en la carpeta: ' + respuesta.dirupload + '<br><br>';
    mensaje += 'Ficheros procesados:</p><ul>';
    // Procesamos la lista de ficheros para crear las líneas con sus nombres y tamaños
    for (var i = 0; i < ficheros.length; i++) {
        if (ficheros[i] != undefined) {
            archivo = ficheros[i];
            tam = archivo.size / 1024;
            mensaje += '<li>' + archivo.name + ' (' + Math.ceil(tam) + 'Kb)' + '</li>';
            contadores_tipos(archivo.name);  // Incrementamos el contador para el tipo de archivo subido
        }
    };

    mensaje += '</ul><br/>';
    // Línea que muestra el total de ficheros por tipo que se han subido
    for (var i = 0; i < contadores.length; i++)  total_tipos += '(' + contadores[i] + ') ' + tipos[i] + ', ';
    // Apaño para eliminar la coma y el espacio (, ) que se queda en el último procesado
    total_tipos = total_tipos.substr(0, total_tipos.length - 2);
    mensaje += '<p>' + total_tipos + '</p>';
    // Si el total de archivos indicados por el plugin coincide con el total que hemos recibido en la respuesta del script PHP
    // mostramos mensaje de proceso correcto
    if (respuesta.total == total) mensaje += '<p>Coinciden con el total de archivos procesados en el servidor.</p>';
    else mensaje += '<p>No coinciden los archivos enviados con el total de archivos procesados en el servidor.</p>';
    // Una vez creado todo el mensaje lo cargamos en el DIV de alerta y lo mostramos
    $('div.alert').html(mensaje);
    $('div.alert').show();
});
// Ocultamos el div de alerta donde se muestra un resumen del proceso
$('div.alert').hide();
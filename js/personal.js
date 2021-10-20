var tabla = $("#tablaPersonal").DataTable({
    "language": {
        "sProcessing": "Procesando...",
        "sLengthMenu": "Mostrar _MENU_ registros",
        "sZeroRecords": "No se encontraron resultados",
        "sEmptyTable": "Ningún dato disponible en esta tabla",
        "sInfo": "Mostrando registros del _START_ al _END_ de un total de _TOTAL_",
        "sInfoEmpty": "Mostrando registros del 0 al 0 de un total de 0",
        "sInfoFiltered": "(filtrado de un total de _MAX_ registros)",
        "sInfoPostFix": "",
        "sSearch": "Buscar:",
        "sUrl": "",
        "sInfoThousands": ",",
        "sLoadingRecords": "Cargando...",
        "oPaginate": {
            "sFirst": "Primero",
            "sLast": "Último",
            "sNext": "Siguiente",
            "sPrevious": "Anterior"
        },
        "oAria": {
            "sSortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sSortDescending": ": Activar para ordenar la columna de manera descendente"
        }
    }
});

$(document).ready(function () {
    mostrarById($("#idMedio").val());
});

function mostrarById(id) {
    var datos = new FormData();
    datos.append("personal", id);
    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

            $(".tile-body").children().remove()

            respuesta.forEach(function(element, index){
                $(".tile-body").append(
                    '<form name="crear" method="POST" id="crear'+index+'" enctype="multipart/form-data">'+
                        '<div class="bs-component">'+
                            '<div class="card">'+
                                '<h4 class="card-header">'+
                                    '<i class="fa fa-address-card" style="color:#999"></i> Inscripción de personal </h4>'+
                                '<div class="card-body">'+
                                    '<p class="card-text">'+
                                        '<div class="row">'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Nombre</strong></label>'+
                                                    '<input type="hidden" name="idPersonal" value="'+ element.id +'">'+
                                                    '<input name="nombre" id="nombre" class="form-control" data-validetta="required" value="' + element.nombre  + '">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Documento</strong></label>'+
                                                    '<input name="documento" id="documento" class="form-control" data-validetta="required" value="' + element.documento +'">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Cargo</strong></label>'+
                                                    '<input name="cargo" id="cargo" class="form-control" data-validetta="required" value="' + element.cargo  + '">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Teléfono</strong></label>'+
                                                    '<input name="telefono" id="telefono" class="form-control" data-validetta="required" value="' + element.telefono + '">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Correo</strong></label>'+
                                                    '<input name="correo" id="correo" class="form-control" data-validetta="required"  value="'+ element.correo  + '">'+
                                                '</div>'+
                                            '</div>'+
                                            '<div class="col-md-6">'+
                                            '</div>'+
                                            '<div class="col-md-12">'+
                                                '<div class="form-group">'+
                                                    '<label><strong>Foto</strong></label><br>'+
                                                    '<input class="inputFile" name="archivo[]" id="archivo'+index+'" type="file" multiple>'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</p>'+
                                '</div>'+
                            '</div>'+
                        '</div>'+
                        '<div style="margin-top: 2%;text-align: center;">'+
                            '<button class="btn btn-primary" type="submit" id="guardar" style="width:420px;font-size: 20px"><strong>Registrar</strong></button>'+
                        '</div>'+
                    '</form>'
                )
                 inputFile(element.correo, '#archivo'+index);

                $('#crear'+ index).validetta({
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
                            url: 'ajax/personal.ajax.php',
                            data: new FormData($('#crear'+index)[0]),
                            dataType: 'json',
                            contentType: false,
                            cache: false,
                            processData: false,
                            beforeSend: function () {
                                $('#guardar').attr("disabled", "disabled");
                                $('#crear').css("opacity", ".5");
                            },
                            success: function (respuesta) {
                                if (respuesta == "ok") {
                                        mostrarById($("#idMedio").val());
                                        swal({
                                            title: "¡DATOS GUARDADOS!",
                                            text: "El personal ha sido guardado con éxito",
                                            type:"success",
                                            confirmButtonText: "Cerrar",
                                            closeOnConfirm: false
                                        }
                                    )
                                }
                                $('#crear').css("opacity", "");
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
            })            
        }
    })
}

function inputFile(usuario, inputId) {
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
                            { caption: respuesta[indexInArray].Nombre, size: 632762, width: "90px", key: indexInArray }
                        )
                    }
                });
            }

            $(inputId).fileinput('destroy');
            $(inputId).fileinput({
                theme: 'fa',
                language: 'es',
                maxFileCount: 3,
                uploadUrl: 'ajax/archivosPersonal.ajax.php',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'jpeg'],
                uploadAsync: false,
                initialPreviewAsData: true,
                initialPreview: rutas,
                initialPreviewConfig: preview,
                initialPreviewShowDelete: false,
                uploadExtraData: {usuario: usuario} 
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
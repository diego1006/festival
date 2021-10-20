var tabla = $("#tablaMedios").DataTable({ 
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



tabla.columns.adjust().draw();

$(document).ready(function(){
  
    var pathname = window.location.pathname;

    var url = pathname.split("/");  

    var estado = '';
    if (url["2"] == "medios"){
        estado = 0;
    }else if(url["2"] == "mediosAprobados"){
        estado = 1;

    }else if(url["2"] == "mediosRechazados"){
        estado = 2;
    }

    cargar(estado);
    mostrarById(0);

})

// CARGAR MEDIOS

function cargar(estado) {
    var datos = new FormData();
    datos.append("medios", estado);
   
    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {
                        
            respuesta.forEach(function(element, index) {

                if(element.estado == 0){     
                    var botones = "<div class='form-group'><button title='Registrado' data-toggle='modal' data-target='#modalVerMedio'  class='btn btn-sm btn-primary' onclick='mostrarById(" + element.id + ")' style='color:white;border-radius:20px;width:90%' >Registrado</button></div>"
                }else  if(element.estado == 1){
                    var botones = "<div class='form-group'><button title='Aprobado' data-toggle='modal' data-target='#modalVerMedio'  class='btn btn-sm btn-success' onclick='mostrarById(" + element.id + ")' style='color:white;border-radius:20px;width:90%' >Aprobado</button></div>"

                }else if(element.estado == 2){
                    var botones = "<div class='form-group'><button title='Rechazado' data-toggle='modal' data-target='#modalVerMedio'  class='btn btn-sm btn-secondary'  onclick='mostrarById(" + element.id + ")' style='color:white;border-radius:20px;width:90%' >Rechazado</button></div>"
                }

                var fechaI=element.fechaRegistro.split(" ");

                tabla.row.add([
                    ++index,
                    element.documento,
                    element.nombre,
                    element.representante,
                    element.tipo,
                    element.telefono,
                    element.direccion,
                    element.correo,
                    botones
                ]).draw(false);

            })

        }

    })

}

function mostrarById(id){

    console.log(id)

    var datos = new FormData();
    datos.append("idMedio", id);
    
    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function(respuesta) {

            console.log(respuesta)

           $("#medioTipo").html(respuesta["tipo"])
           $("#nombreMedio").html(respuesta["nombre"])
           $("#representante").html(respuesta["representante"])
           $("#documento").html(respuesta["documento"])
           $("#ciudad").html(respuesta["ciudad"])
           $("#telefono").html(respuesta["telefono"])
           $("#correo").html(respuesta["correo"])
           $("#direccion").html(respuesta["direccion"])
           $("#aprobado").attr("dataId", respuesta["id"]);
           $("#rechazado").attr("dataId", respuesta["id"]);

            mostrarPersonal(respuesta["id"])

        }

    })
}

function mostrarPersonal(id){

    $(".personal").children().remove()
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
        success: function(respuesta) {

            respuesta.forEach(function(element, index){         

                $(".personal").append('<div class="col-lg-12 t-log-head">'+
                    '<p style="color: white; margin: 0.4em 0em;text-align: center">Personal para acreditación</p>' +
                    '</div>' +
                    '<div class="col-lg-5 t-item">'+
                    '<p>Nombre</p>'+
                    '<p>' + element.nombre + '</p>' +
                    '</div>'+
                    '<div class="col-lg-4 t-item">'+
                    '<p>Documento</p>'+
                    '<p>' + element.documento + '</p>' +
                    '</div>'+
                    '<div class="col-lg-3 t-item">'+
                    '<p>Cargo</p>'+
                    '<p>' + element.cargo + '</p>' +
                    '</div>'+
                    '<div class="col-lg-4 t-item">'+
                    '<p>Celular</p>'+
                    '<p>' + element.telefono + '</p>'+
                    '</div>' +
                    '<div class="col-lg-8 t-item">' +
                    '<p>Correo</p>'+
                    ' <p>' + element.correo+ '</p>' +
                    '</div>'+
                    '<div class="col-md-12">'+
                    '<<input name="archivo[]" id="archivo'+index+'" type="file" multiple>>'+
                    '</div>'
                )

                inputFile(element.correo, '#archivo'+index);
            })                  
        }
    })
}


$("#aprobado, #rechazado").click(function () { 
  
    if($(this).attr("id") == "aprobado"){
        var val = 1
        var n = "aprobado"

    }else if($(this).attr("id") == "rechazado"){
        var val = 2
        var n = "rechazado"
    }
    
    var datos = new FormData();
    datos.append("aprobar", $(this).attr("dataId"));
    datos.append("cambio", val);

    $.ajax({
        url: "ajax/medios.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "text",
        success: function (respuesta) {

            if(respuesta == "ok"){
                $.notify("El medio ha sido " + n + " con éxito!",{type: "success", placement: {from: "top", align: "center"}});
                
                tabla.clear().draw()
                var pathname = window.location.pathname;
                var url = pathname.split("/");  
                var estado = '';
                if (url["2"] == "medios"){
                    estado = 0;
                }else if(url["2"] == "mediosAprobados"){
                    estado = 1;

                }else if(url["2"] == "mediosRechazados"){
                    estado = 2;
                }
                cargar(estado);
            }
        }
    })
});

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
                            { caption: respuesta[indexInArray].Nombre, size: 632762, width: "70px", key: indexInArray }
                        )
                    }
                });
            }

            $(inputId).fileinput('destroy');
            $(inputId).fileinput({
                theme: 'fa',
                language: 'es',
                uploadUrl: 'ajax/archivosPersonal.ajax.php',
                allowedFileExtensions: ['jpg', 'png', 'gif', 'pdf', 'jpeg'],
                uploadAsync: false,
                initialPreviewAsData: true,
                initialPreview: rutas,
                initialPreviewConfig: preview,
                initialPreviewShowDelete: false,
                uploadExtraData: {usuario: usuario} 
            });

            $('.file-caption-main').remove();
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
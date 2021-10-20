var tabla = $("#tablaLogistica").DataTable({
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

$(document).ready(function () {
    cargar();
});

function cargar(){
    var datos = new FormData();
    datos.append("listarAprobados", true);

    $.ajax({
        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            respuesta.forEach(function(element, index) {
                var usuario = "'"+element.usuario+"'"; 
                tabla.row.add([
                    ++index,
                    element.nombre,
                    element.apellido,
                    element.documento,
                    element.correoUsuario,
                    element.celular,
                    element.direccion,
                    '<div class="form-group"><button class="btn btn-sm btn-info" style="color:white;border-radius:20px;width:90%" data-toggle="modal" title="Archivos" data-target="#modalArchivos" onclick="mostrarArchivos(' + usuario + ')"><i class="fa fa-file-image-o"></i></button></div>',
                    '<div class="form-group"><button class="btn btn-sm btn-success" style="color:white;border-radius:20px;width:90%" data-toggle="modal" title="Aprobado" data-target="#modalVer" onclick="mostrarById(' + element.id + ')">Aprobado</button></div>'
                ]).draw(false);
            })
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

$("#btnAprobar").click(function () { 
    var datos = new FormData();
    datos.append("aprobar", $(this).attr("dataId"));

    $.ajax({
        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if(respuesta == "ok"){
                $.notify("La persona ha sido aprobada con éxito!",{type: "success", placement: {from: "top", align: "center"}});
                tabla.clear().draw()
                cargar();
            }
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
});

$("#btnRechazar").click(function () { 
    var datos = new FormData();
    datos.append("rechazar", $(this).attr("dataId"));

    $.ajax({
        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            if(respuesta == "ok"){
                $.notify("La persona ha sido rechazada con éxito!",{type: "success", placement: {from: "top", align: "center"}});
                tabla.clear().draw()
                cargar();
            }
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
});

function convertDateFormat(string) {
    var info = string.split('-');
    return info[2] + '/' + info[1] + '/' + info[0];
}

function mostrarById(id){
    var datos = new FormData();
    datos.append("idLogistica", id);

    $.ajax({
        url: "ajax/logistica.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
            console.log
            $("#nombre").html(respuesta.nombre);
            $("#apellido").html(respuesta.apellido);
            $("#fechaNacimiento").html(respuesta.fechaNacimiento);
            $("#ciudad").html(respuesta.ciudad);
            $("#documento").html(respuesta.documento);
            $("#edad").html(respuesta.edad);
            $("#estatura").html(respuesta.estatura);
            $("#genero").html(respuesta.genero);
            $("#grupoSanguineo").html(respuesta.grupoSanguineo);
            $("#formacionAcademica").html(respuesta.formacionAcademica);
            $("#ocupacion").html(respuesta.ocupacion);
            $("#direccion").html(respuesta.direccion);
            $("#telefono").html(respuesta.telefono);
            $("#celular").html(respuesta.celular);
            $("#correo").html(respuesta.correoUsuario);
            $("#btnRechazar").attr("dataId", respuesta.id);
            $("#btnAprobar").attr("dataId", respuesta.id);
            if(respuesta.trabajoAnterior == 0){
                $("#trabajadoAntes").html("(No)")
            }else{
                $("#trabajadoAntes").html("(Si)")
            }
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

function mostrarArchivos(usuario) {
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
            $('.file-caption-main').remove();
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
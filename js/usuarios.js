var usuario="";
var correo="";

function convertDateFormat(string) {
  var info = string.split('-');
  return info[2] + '/' + info[1] + '/' + info[0];
}

$(document).ready(function() {
  cargar();

  $("#crear").validetta({
    realTime: true,

    onValid: function(e) {
      e.preventDefault();

      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: $("#crear").serialize(),

        dataType: "text",
        beforeSend: function() {
          $("#guardar").html("Guardando...");
          $("#guardar").attr("disabled", true);
        },
        success: function(respuesta) {

          if (respuesta == "ok") {
            $("#guardar").html("Guardar");
            $("#guardar").removeAttr("disabled");

            $("#crear")[0].reset();

            $("#tablaMarcas tbody")
              .children()
              .remove();
            $("#alerta")
              .children()
              .remove();
            $("#alerta").append(
              '<div class="alert alert-dismissible alert-success"><button class="close" type="button" data-dismiss="alert">×</button>El usuario ha sido guardado exitosamente!</div>'
            );

            cargar();
          }
        }
      });
    }
  });

  $("#editar").validetta({
    realTime: true,

    onValid: function(e) {
      e.preventDefault();

      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: $("#editar").serialize(),

        dataType: "text",
        beforeSend: function() {
          $("#guardarE").html("Guardando...");
          $("#guardarE").attr("disabled", true);
        },
        success: function(respuesta) {

          if (respuesta == "ok") {
            $("#guardarE").html("Guardar");
            $("#guardarE").removeAttr("disabled");

            $("#crear")[0].reset();

            $("#tablaMarcasE tbody")
              .children()
              .remove();
            $("#alertaE")
              .children()
              .remove();
            $("#alertaE").append(
              '<div class="alert alert-dismissible alert-success"><button class="close" type="button" data-dismiss="alert">×</button>El usuario ha sido guardado exitosamente!</div>'
            );
            cargar();
          }
        }
      });
    }
  });
});

function cargar() {

  $("#contenedor").children().remove()

  var datos = new FormData();
  datos.append("todos", 0);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {
      respuesta.forEach(function(element, index) {
        var estado = "";

        if (element.estado != 0) {
          if (element.perfil == "Administrador") {
            estado =
              '<button class="btn btn-success btn-xs" readonly > Activado</button>';
          } else {
            estado =
              '<button class="btn btn-success btn-xs btnActivar" onclick="estado(' +
              element.id +
              ".2" +
              ')"> Activado</button>';
          }
        } else {
          estado =
            '<button class="btn btn-danger btn-xs" onclick="estado(' +
            element.id +
            ".1" +
            ')">Desactivado</button>';
        }

        var fechaU=element.ultimo_login.split(" ");
        var fechaI=element.fechaIngreso.split(" ")

        $("#contenedor").append('<div class="col-md-6">' +
        '<div class="tile">' +
        '<div class="row">' +
        '<div class="col-md-8 row">' +
        '<div class="col-3">' +
        '<img src="img/plantilla/anonymous.png" class="foto" alt="">' +
        '</div>' +
        '<span class="col-9" style="padding:0px;padding-top:3%"><span class="nombre">'+element.nombre+'</span><br>' +
        '<span class="perfil">'+element.perfil+'</span>' +
        '</span>' +
        '</div>' +
        '<div class="col-md-4" style="padding-top:2% ">' +
        '<div style="display:flex">' +
        '<i style="color: #1dc9b7;margin-right:7px;display:inline-block;padding-top:2%" class="fa fa-envelope"></i>' +
        '<div style="display: inline-block">'+element.correoUsuario+'</div>' +
        '</div>' +
        '<div style="display:flex">' +
        '<i style="color: #00aff0;margin-right:7px;display:inline-block;padding-top:2%" class="fa fa-user"></i>' +
        '<div style="display: inline-block">'+element.usuario+'</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="tile-body col-md-12 " style="margin-top:5%">' +
        '<div class="row">' +
        '<div class="col-md-6">' +
        '<i style="color: #840AD9;margin-right:7px" class="fa fa-sign-in"></i>' +
        '<span class="perfil">'+convertDateFormat(fechaU[0])+" "+fechaU[1]+'</span>' +
        '<br>' +
        '<br>' +
        '</div>' +
        '<div class="col-md-6" >' +
        '<span class="ingreso">'+convertDateFormat(fechaI[0])+'</span><span class="perfil">Fecha ingreso</span>' +
        '<br><br>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '<div class="tile-footer col-md-12">' +
        '<div class="row">' +
        '<div class="col-6">' + estado +
        '</div>' +
        '<div class="col-6 text-right">' +
        '<button class="btn btn-warning" style="margin-right:1%" data-toggle="modal" data-target="#modalEditarUsuarios" onclick="mostrarById(' +
        element.id +
        ')"><i style="color: white;" class="fa fa-pencil"></i></button>' +
        '<button class="btn btn-danger" onclick="eliminar(' +
        element.id +
        ')"><i style="color: white;" class="fa fa-trash"></i></button>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</div>')

    });

       
    }
  });
}

function mostrarById(id) {
  var datos = new FormData();
  datos.append("mostrarById", id);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function(respuesta) {

        $("#editarId").val(respuesta["id"]);
        $("#nombre").val(respuesta["nombre"]);
        $("#usuarioE").val(respuesta["usuario"]);
        $("#correoE").val(respuesta["correoUsuario"]);
        $("#perfilE").val(respuesta["perfil"]);

        if(respuesta["perfil"]=="Caja"){
          $(".correo").attr("readonly",true)
          $(".correo").val("")
          $(".correo").removeAttr("data-validetta")
        }else{
          $(".correo").removeAttr("readonly")
          $(".correo").attr("data-validetta","required")
        }

        $("#usuarioActual").val(respuesta["usuario"]);
        $("#correoActual").val(respuesta["correoUsuario"]);
  
    
    }
  });
}

function eliminar(id) {

  swal({
      title: '¿Está seguro de eliminar el usuario?',
      text: "¡Si no lo está puede cancelar la accíón!",
      type: 'warning',
      showCancelButton: true,
      cancelButtonText: 'Cancelar',
      confirmButtonText: 'Si, Eliminar!'
  }, function() {

      var datos = new FormData();
      datos.append("eliminar", id);
      datos.append("tabla", "usuarios");

      $.ajax({
          url: "ajax/asesores.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          dataType: "text",
          success: function(respuesta) {

              if (respuesta == "ok") {

                  cargar();
              }

          }

      })
  })

}

function estado(id) {
  var cadena = String(id);
  var estadoUsuario = 1;
  var divisiones = cadena.split(".");
  var idUsuario = divisiones[0];

  if (divisiones[1] == 2) {
    estadoUsuario = 0;
  }

  var datos = new FormData();
  datos.append("activarId", idUsuario);
  datos.append("activarUsuario", estadoUsuario);

  $.ajax({
    url: "ajax/usuarios.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    success: function(respuesta) {
      if (respuesta == "ok") {
        $.notify("Estado del usuario modificado correctamente!", {
          type: "success",
          placement: { from: "top", align: "center" }
        });
       
        cargar();
      }
    }
  });
}

/*=============================================
VALIDAR EL TIPO DE PERFIL
=============================================*/
$(".form-group").on("change", ".perfil", function() {

   if($(this).val()=="Caja" || $(this).val()==""){
    $(".correo").attr("readonly",true)
    $(".correo").val("")
    $(".correo").removeAttr("data-validetta")
   }else{
    $(".correo").removeAttr("readonly")
    $(".correo").attr("data-validetta","required")
   }
    
})

/*=============================================
VALIDAR USUARIO AL CREAR
=============================================*/
$(".form-group").on("blur", "#usuarioC", function() {

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
                    $("#usuarioC").val("")
                    $("#alerta").children().remove()
                    $("#alerta").append('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>Este usuario ya se registro en la base de datos!</div>')
    
               }
    
            }
    
        })
     
 })

 /*=============================================
VALIDAR CORREO AL CREAR
=============================================*/
$(".form-group").on("blur", "#correoC", function() {

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
                    $("#correoC").val("")
                    $("#alerta").children().remove()
                    $("#alerta").append('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>Este correo ya se registro en la base de datos!</div>')
    
               }
    
            }
    
        })
     
 })

 /*=============================================
VALIDAR USUARIO AL CREAR
=============================================*/
$(".form-group").on("blur", "#usuarioE", function() {

  if($(this).val()!=$("#usuarioActual").val()){

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
                $("#usuarioE").val($("#usuarioActual").val())
                $("#alertaE").children().remove()
                $("#alertaE").append('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>Este usuario ya se registro en la base de datos!</div>')
  
            }
  
        }
  
    })

  }
   
})

/*=============================================
VALIDAR CORREO AL CREAR
=============================================*/
$(".form-group").on("blur", "#correoE", function() {

  if($(this).val()!=$("#correoActual").val()){

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
                $("#correoE").val($("#correoActual").val())
                $("#alertaE").children().remove()
                $("#alertaE").append('<div class="alert alert-dismissible alert-danger"><button class="close" type="button" data-dismiss="alert">×</button>Este correo ya se registro en la base de datos!</div>')
  
            }
  
        }
  
    })

  }
   
})

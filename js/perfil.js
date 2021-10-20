
$(document).ready(function() {

  $("#cambiar").validetta({
    realTime: true,

    onValid: function(e) {
      e.preventDefault();

      $.ajax({
        url: "ajax/usuarios.ajax.php",
        method: "POST",
        data: $("#cambiar").serialize(),

        dataType: "text",
        beforeSend: function() {
          $("#guardar").html("Guardando...");
          $("#guardar").attr("disabled", true);
        },
        success: function(respuesta) {
           
          if (respuesta == "ok") {
            $("#guardar").html("Guardar");
            $("#guardar").removeAttr("disabled");

            $("#antiguaPassword").val("")
            $("#editarPassword").val("")
            $("#confirPassword").val("")

            $.notify("Contraseña modificada correctamente!",{type: "success", placement: {from: "top", align: "center"}})
           
          }else if(respuesta=="diferente"){
            $.notify("La contraseña anterior no es correcta!",{type: "danger", placement: {from: "top", align: "center"}})
            $("#guardar").html("Guardar");
            $("#guardar").removeAttr("disabled");
          }
        }
      });
    }
  });

 
});






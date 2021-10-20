<?php
session_start();
require_once "../models/usuarios.modelo.php";

class AjaxUsuarios
{   
    // =====================================================================
    // CREAR USUARIO
    // =====================================================================
    public function ajaxCrearUsuario()
    {
        $tabla = "usuarios";
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valorF = $fecha.' '.$hora;

        $encriptar = crypt($_POST["password"], '$2a$07$usesomesillystringforsalt$');

        $encriptarEmail = crypt($_POST["correo"], '$2a$07$usesomesillystringforsalt$');

        $datos = array("documento"=> $_POST["documento"],
                        "usuario" => strtolower($_POST["correo"]),
                        "correoUsuario" => strtolower($_POST["correo"]),
                        "password" => $encriptar,
                        "perfil" => $_POST["tipoRegistro"],
                        "estado" => 0,
                        "emailEncriptado" => $encriptarEmail,
                        "fechaIngreso"=>$valorF);

        $respuesta = ModeloUsuarios::mdlRegistroUsuario($tabla, $datos);

        if ($respuesta) {

            if($_POST["tipoRegistro"]!="Medio"){
                ModeloUsuarios::mdlIngresarLogistica($respuesta);
            }else{
                ModeloUsuarios::mdlIngresarMedios($respuesta); 
            }
            
            require_once "../extensiones/PHPMailer/PHPMailerAutoload.php";
            require_once "../extensiones/vendor/autoload.php";
            
            $mail = new PHPMailer;
        
            $mail->CharSet = 'UTF-8';

            $mail->isMail();

            $mail->setFrom('bykroft1@bykroft.com', 'Validar cuenta');

            $mail->addReplyTo('bykroft1@bykroft.com', 'Validar cuenta');

            $mail->Subject = "Validar cuenta";

            $mail->setFrom('nobsus','Validacion cuenta');

            $mail->Subject = "Validacion de cuenta";

            $mail->addAddress($_POST["correo"]);

            $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">

            <center>
        
              <img style="width: 50%;" src="http://ejemplo.bykroft.com/img/plantilla/LogoNegro.png">
                        
            </center>
        
            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
        
                <center>
        
                    <h3 style="font-weight:100; color:#999">Validación de cuenta</h3>

                    <hr style="border:1px solid #ccc; width:80%">

                    <h3 style="font-weight:100; color:#999">Datos del registro</h3>
        
                
                    <table style="font-weight:100; color:#999">
                       
                        <tr><td><strong>Documento:</strong></td><td>'.$_POST["documento"].'</td><td><strong>Usuario:</strong></td><td>'.$_POST["usuario"].'</td></tr>
                        <tr><td><strong>Tipo registro:</strong></td><td>'.$_POST["tipoRegistro"].'</td><td><strong>Correo:</strong> </td><td>'.$_POST["correo"].'</td></tr>
                    
                    </table>
                    
                 
                    <br><br>
              
                      <a href="http://ejemplo.bykroft.com/validacion?'.$encriptarEmail.'"><button style="line-height:60px; background:#ce2127; width:60%; color:white">Clic para validar cuenta</button></a>  
        
                    <br>
        
                    <hr style="border:1px solid #ccc; width:80%">
        
                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>
        
                    </center>
            
                </div>
            
            </div>');

            $envio = $mail->Send();

            if ($envio) {
                

                echo "ok";
                
            }else{
                echo $envio->ErrorInfo;
            }
        }
    }

     // =====================================================================
    // Mostrar USUARIOS
    // =====================================================================
    static public function ajaxMostrarUsuarios($item,$valor)
    {

        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item,$valor);

        echo json_encode($respuesta);
    }


    // =====================================================================
    // Editar Usuario
    // =====================================================================

    public function ajaxEditarUsuario()
    {
        $datos = array("id" =>$_POST["editarId"],
                        "nombre" => strtoupper($_POST["nombreE"]),
                        "usuario" => $_POST["usuarioE"],
                        "correoUsuario" => strtoupper($_POST["correoE"]),
                        "perfil" => $_POST["perfilE"]);

        $respuesta = ModeloUsuarios::mdlEditarUsuario("usuarios", $datos);
        echo $respuesta;
    }

    // =====================================================================
    // Activar Usuario
    // =====================================================================

    public function ajaxActivarUsuario($valor1,$valor2)
    {

        $tabla = "usuarios";

        $item1 = "estado";
        $item2 = "id";
       

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
        echo $respuesta;
    }


    /*=============================================
    VALIDAR NO REPETIR USUARIO
    =============================================*/

    public function ajaxValidarUsuario($valor)
    {
      
        $item = "usuario";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

        /*=============================================
    VALIDAR NO REPETIR CORREO
    =============================================*/

    public function ajaxValidarCorreo($valor)
    {
      
        $item = "correoUsuario";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

          /*=============================================
    VALIDAR NO documento
    =============================================*/

    public function ajaxValidarDocumento($valor)
    {
      
        $item = "documento";
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios($item, $valor);
        echo json_encode($respuesta);
    }

    /*=============================================
    CAMBIAR CONTRASEÑA
    =============================================*/

    public function ajaxCambiarPass()
    {
        
        $respuesta = ModeloUsuarios::mdlMostrarUsuarios("id",$_SESSION["id"]);
        $encriptar = crypt($_POST["antiguaPassword"], '$2a$07$usesomesillystringforsalt$');                                                                                              

        if($encriptar==$respuesta["password"]){
            $encriptar2 = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
            $respuesta = ModeloUsuarios::mdlCambiarPass($_SESSION["id"],$encriptar2);
            echo $respuesta;
        }else{
            echo "diferente";
        }
    }

}

// =============================================================================
// CREAR USUARIO
// =============================================================================
if (isset($_POST["documento"])) {

    $mostrar = new AjaxUsuarios();
    $mostrar->ajaxCrearUsuario();
} 

// =============================================================================
// EDITAR USUARIO
// =============================================================================
if (isset($_POST["nombreE"])) {

    $mostrar = new AjaxUsuarios();
    $mostrar->ajaxEditarUsuario();
}

// =============================================================================
// MOSTRAR USUARIOS
// =============================================================================
if (isset($_POST["todos"])) {

    $mostrar = new AjaxUsuarios();
    $mostrar->ajaxMostrarUsuarios(null,null);
}

// =============================================================================
// MOSTRAR USUARIOS
// =============================================================================
if (isset($_POST["mostrarById"])) {

    $mostrar = new AjaxUsuarios();
    $mostrar->ajaxMostrarUsuarios("id",$_POST["mostrarById"]);
}

// =============================================================================
// Activar usuario
// =============================================================================}
if (isset($_POST["activarUsuario"])) {
    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->ajaxActivarUsuario($_POST["activarUsuario"],$_POST["activarId"]);
}

/*=============================================
VALIDAR NO REPETIR USUARIO
=============================================*/

if (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->ajaxValidarUsuario($_POST["validarUsuario"]);
}

/*=============================================
VALIDAR NO REPETIR CORREO
=============================================*/

if (isset($_POST["validarCorreo"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->ajaxValidarCorreo($_POST["validarCorreo"]);
}

/*=============================================
VALIDAR NO REPETIR documento
=============================================*/

if (isset($_POST["validarDocumento"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->ajaxValidarDocumento($_POST["validarDocumento"]);
}


/*=============================================
CAMBIAR LA CONTRASEÑA
=============================================*/

if (isset($_POST["editarPassword"])) {

    $cambiarPass = new AjaxUsuarios();
    $cambiarPass->ajaxCambiarPass();
}
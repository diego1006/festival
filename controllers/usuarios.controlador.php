<?php
class ControladorUsuarios 
{
    // =====================================================================
    // Ingreso de usuarios
    // =====================================================================
    static public function ctrIngresoUsuario()
    {
        if (isset($_POST["ingUsuario"])) {

            $encriptar = crypt($_POST["ingPassword"], '$2a$07$usesomesillystringforsalt$');

            $usuario = $_POST["ingUsuario"];

            $respuesta = ModeloUsuarios::MdlMostrarUsuarios('usuario', $usuario);

            if ($respuesta["usuario"] == $usuario && $respuesta["password"] == $encriptar) {

                if ($respuesta["estado"] == 1) {

                    $_SESSION["iniciarSesion"] = "ok";
                    $_SESSION["id"] = $respuesta["id"];
                    $_SESSION["documento"] = $respuesta["documento"];
                    $_SESSION["usuario"] = $respuesta["usuario"];
                    $_SESSION["perfil"] = $respuesta["perfil"];


                    $documento = $_SESSION["id"];

                    $respuestaEstado = ModeloMedios::mdlValidarEstadoMedio('usuarios.id', $documento);

                    $_SESSION["estadoMedio"] = $respuestaEstado["estado"];
                    $_SESSION["medio"] = $respuestaEstado["medio"];

                    /*=============================================
						REGISTRAR FECHA PARA SABER EL ÚLTIMO LOGIN
						=============================================*/

                    date_default_timezone_set('America/Bogota');

                    $fecha = date('Y-m-d');
                    $hora = date('H:i:s');

                    $fechaActual = $fecha . ' ' . $hora;

                    $item1 = "ultimo_login";
                    $valor1 = $fechaActual;

                    $item2 = "id";
                    $valor2 = $respuesta["id"];

                    $ultimoLogin = ModeloUsuarios::mdlActualizarUsuario('usuarios', $item1, $valor1, $item2, $valor2);

                    if ($ultimoLogin == "ok") {
                        
                        echo '<script>

                                    window.location = "inicio";

                                </script>';
                    }
                } else {
                    echo '<script>$.notify("El usuario aun no está activado!",{type: "danger", placement: {from: "top", align: "center"}});</script>';
                }
            } else {

                echo '<script>$.notify("Usuario ó contraseña incorrectos!",{type: "danger", placement: {from: "top", align: "center"}});</script>';
            }
        }
    }

    // =====================================================================
    // Mostrar usuario
    // =====================================================================
    static public function ctrMostrarUsuarios($item, $valor)
    {
        $tabla = "usuarios";
        $respuesta = ModeloUsuarios::MdlMostrarUsuarios($tabla, $item, $valor);
        return $respuesta;
    }

    // =====================================================================
    // Editar Perfil
    // =====================================================================
    static public function ctrEditarPerfil()
    {
        if (isset($_POST["antiguaPassword"])) {

            // $passAn = ModeloUsuarios::mdlDevolverPass();

            $passAntigua = crypt($_POST["antiguaPassword"], '$2a$07$usesomesillystringforsalt$');

            if ($passAn["password"] == $passAntigua) {

                if ($_POST["editarPassword"] != "") {

                    $pass = $passAntigua = crypt($_POST["editarPassword"], '$2a$07$usesomesillystringforsalt$');
                } else {

                    $pass = $passAn["password"];
                }

                $datos = array(
                    "id" => $_SESSION["id"],
                    "telefono" => $_POST["editarTelefono"],
                    "direccion" => $_POST["editarDireccion"],
                    "password" => $pass
                );

                $tabla = "lideres";

                $respuesta = ModeloUsuarios::mdlEditarUsuario($tabla, $datos);

                if ($respuesta) {

                    echo '<script>

                        swal({
                            type: "success",
                            title: "Sus datos han sido modificado correctamente!",
                            showConfirmButton: true,
                            confirmButtonText: "Cerrar"
                        },function(){
                            window.location = "perfil";
                        })

                    </script>';
                }
            } else {

                echo '<script>

                        $.notify("Contraseña actual incorrecta!",{type: "danger", placement: {from: "top", align: "center"}});

                    </script>';

                return;
            }
        }
    }

    /*=============================================
    OLVIDO DE CONTRASEÑA
    =============================================*/

    public function ctrOlvidoPassword()
    {

        if (isset($_POST["passEmail"])) {

            if (preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["passEmail"])) {

                $tabla = "usuarios";

                $item1 = "usuario";
                $valor1 = $_POST["passEmail"];

                $respuesta1 = ModeloUsuarios::mdlMostrarUsuarios($item1, $valor1);

                if ($respuesta1) {

                    /*=============================================
                    GENERAR CONTRASEÑA ALEATORIA
                    =============================================*/

                    function generarPassword($longitud)
                    {

                        $key = "";
                        $pattern = "1234567890abcdefghijklmnopqrstuvwxyz";

                        $max = strlen($pattern) - 1;

                        for ($i = 0; $i < $longitud; $i++) {

                            $key .= $pattern{
                                mt_rand(0, $max)};
                        }

                        return $key;
                    }

                    $nuevaPassword = generarPassword(11);

                    $encriptar = crypt($nuevaPassword, '$2a$07$usesomesillystringforsalt$');

                    $item1 = "password";
                    $valor1 = $encriptar;
                    $item2 = "id";
                    $valor2 = $respuesta1["id"];


                    $respuesta2 = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);

                    if ($respuesta2  == "ok") {

                        /*=============================================
                        CAMBIO DE CONTRASEÑA
                        =============================================*/

                        date_default_timezone_set("America/Bogota");

                        $mail = new PHPMailer;

                        $mail->CharSet = 'UTF-8';

                        $mail->isMail();

                        $mail->setFrom('bykroft1@bykroft.com', 'Festival ® Soporte Técnico');

                        $mail->addReplyTo('bykroft1@bykroft.com', 'Festival ® Soporte Técnico');

                        $mail->Subject = "Solicitud de nueva contraseña";

                        $mail->addAddress($_POST["passEmail"]);

                        $mail->msgHTML('<div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
    
                                <center>
                                    
                                    <img style="width: 50%;" src="http://ejemplo.bykroft.com/img/plantilla/LogoNegro.png">

                                </center>

                                <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                                
                                    <center>
                                    
                                    <img style="padding:20px; width:15%" src="https://softphie.com/vistas/img/plantilla/icon-pass.png">

                                    <h3 style="font-weight:100; color:#999">SOLICITUD DE NUEVA CONTRASEÑA</h3>

                                    <hr style="border:1px solid #ccc; width:80%">

                                    <h4 style="font-weight:100; color:#999; padding:0 20px"><strong>Su nueva contraseña: </strong>' . $nuevaPassword . '</h4>

                                    <a href="http://ejemplo.bykroft.com" target="_blank" style="text-decoration:none">

                                    <div style="line-height:60px; background:#3c8dbc; width:60%; color:white">Ingrese nuevamente al sitio</div>

                                    </a>

                                    <br>

                                    <hr style="border:1px solid #ccc; width:80%">

                                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico y la cuenta se eliminará.</h5>

                                    </center>

                                </div>

                            </div>');

                        $envio = $mail->Send();

                        if (!$envio) {

                            echo '<script> 

                                swal({
                                      title: "¡ERROR!",
                                      text: "¡Ha ocurrido un problema enviando cambio de contraseña a ' . $_POST["passEmail"] . $mail->ErrorInfo . '!",
                                      type:"error",
                                      confirmButtonText: "Cerrar",
                                      closeOnConfirm: false
                                    });

                            </script>';
                        } else {

                            echo '<script> 

                                swal({
                                      title: "¡OK!",
                                      text: "¡Por favor revise la bandeja de entrada o la carpeta de SPAM de su correo electrónico ' . $_POST["passEmail"] . ' para su cambio de contraseña!",
                                      type:"success",
                                      confirmButtonText: "Cerrar",
                                      closeOnConfirm: false
                                    });

                            </script>';
                        }
                    }
                } else {

                    echo '<script> 

                        swal({
                              title: "¡ERROR!",
                              text: "¡El correo electrónico no existe en el sistema!",
                              type:"error",
                              confirmButtonText: "Cerrar",
                              closeOnConfirm: false
                            });

                    </script>';
                }
            } else {

                echo '<script> 

                        swal({
                              title: "¡ERROR!",
                              text: "¡Error al enviar el correo electrónico, está mal escrito!",
                              type:"error",
                              confirmButtonText: "Cerrar",
                              closeOnConfirm: false
                            });

                </script>';
            }
        }
    }
}

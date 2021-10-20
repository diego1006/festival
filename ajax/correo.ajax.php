<?php
require_once "../extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "../extensiones/vendor/autoload.php";

class AjaxCorreo{
    public function enviarCorreo($correo){
        $mail = new PHPMailer;
        $mail->CharSet = 'UTF-8';
        $mail->isMail();    
        $mail->setFrom('bykroft1@bykroft.com', 'Aprobación de solicitud');
        $mail->addReplyTo('bykroft1@bykroft.com', 'Aprobación de solicitud');
        $mail->Subject = "Aprobación de solicitud";
        $mail->setFrom('bykroft1@bykroft.com','Aprobación de solicitud');
        $mail->Subject = "Aprobación de solicitud";
        $mail->addAddress($correo);
        $mail->msgHTML('
        <div style="width:100%; background:#eee; position:relative; font-family:sans-serif; padding-bottom:40px">
            <center>
                <img style="width: 50%;" src="http://ejemplo.bykroft.com/img/plantilla/LogoNegro.png">
            </center>
            <div style="position:relative; margin:auto; width:600px; background:white; padding:20px">
                <center>
                    <h3 style="font-weight:100; color:#999">Aprobación de solicitud</h3>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h3 style="font-weight:100; color:#999">Has sido seleccionado para partipar en la logistica del festival vallenato</h3>
                    <br><br>
                    <a href="http://ejemplo.bykroft.com/"><button style="line-height:60px; background:#ce2127; width:60%; color:white">Verifica que tu información es correcta</button></a>
                    <br>
                    <hr style="border:1px solid #ccc; width:80%">
                    <h5 style="font-weight:100; color:#999">Si no se inscribió en esta cuenta, puede ignorar este correo electrónico.</h5>
                </center>
            </div>
        </div>
        ');
        
        $envio = $mail->Send();
        if ($envio) {
            echo json_encode("ok");
        }else{
            echo $envio->ErrorInfo;
        }
    }
}

if(isset($_POST["correo"])){
    $envioCorreo = new AjaxCorreo();
    $envioCorreo->enviarCorreo($_POST["correo"]);
}
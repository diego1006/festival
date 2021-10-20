<?php
require_once "controllers/plantilla.controlador.php";
require_once "controllers/usuarios.controlador.php";

require_once "models/usuarios.modelo.php";
require_once "models/medios.modelo.php";
require_once "models/personal.modelo.php";
require_once "models/registro.modelo.php";

require_once "extensiones/PHPMailer/PHPMailerAutoload.php";
require_once "extensiones/vendor/autoload.php";

$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
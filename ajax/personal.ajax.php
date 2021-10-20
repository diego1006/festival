<?php
session_start();
require_once "../models/personal.modelo.php";

class AjaxPersonal
{
    public function guardarPersonal($datos, $archivos, $i)
    {


        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valorF = $fecha.' '.$hora;

        $tabla = "personal";

        $datos = array(
            "id" => $datos["idPersonal"],
            "nombre" => $datos["nombre"],
            "documento" => $datos["documento"],
            "cargo" => $datos["cargo"],
            "telefono" => $datos["telefono"],
            "correo" => $datos["correo"],
            "archivos" => 0,
            "fechaRegistro" => $valorF
        );

        $respuesta = ModeloPersonal::mdlGuardarPersonal($tabla, $datos);

        echo json_encode($respuesta);

    }
}

if (isset($_POST["nombre"])) {
    $guardar = new AjaxPersonal();
    $guardar->guardarPersonal($_POST, $_FILES, 0);
}


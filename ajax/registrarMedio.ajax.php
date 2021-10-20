<?php
session_start();
require_once "../models/medios.modelo.php";

class AjaxRegistrarMedios{

	 // =====================================================================
    // CREAR MEDIO
    // =====================================================================
    public function ajaxCrearMedio(){

        $ruta=$_POST["fotoActual"];

        if (isset($_FILES["archivo"]["tmp_name"]) && $_FILES["archivo"]["tmp_name"] != "") {

            $directorio = "../img/usuarios/" . $_SESSION["usuario"];
            $ruta = "img/usuarios/" . $_SESSION["usuario"];
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }

            list($ancho, $alto) = getimagesize($_FILES["archivo"]["tmp_name"]);
            $nuevoAncho = 500;
            $nuevoAlto = 500;
            
            if ($_FILES["archivo"]["type"] == "image/jpeg") {

                $aleatorio = $_SESSION["usuario"];

                $directorio = $directorio.'/' . $aleatorio . ".jpeg";
                $ruta=$ruta.'/' . $aleatorio . ".jpeg";
                $origen = imagecreatefromjpeg($_FILES["archivo"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagejpeg($destino, $directorio);
            } else if ($_FILES["archivo"]["type"] == "image/png") {

                $aleatorio = $_SESSION["usuario"];

                $directorio = $directorio.'/' . $aleatorio . ".png";
                $ruta=$ruta.'/' . $aleatorio . ".jpeg";
                $origen = imagecreatefrompng($_FILES["archivo"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagepng($destino, $directorio);
            } else if ($_FILES["archivo"]["type"] == "image/gif") {

                $aleatorio = $_SESSION["usuario"];

                $directorio = $directorio.'/' . $aleatorio . ".gif";
                $ruta=$ruta.'/' . $aleatorio . ".jpeg";
                $origen = imagecreatefromgif($_FILES["archivo"]["tmp_name"]);
                $destino = imagecreatetruecolor($nuevoAncho, $nuevoAlto);

                imagecopyresized($destino, $origen, 0, 0, 0, 0, $nuevoAncho, $nuevoAlto, $ancho, $alto);
                imagegif($destino, $directorio);
            }
        }

        $tabla = "medios";
        date_default_timezone_set('America/Bogota');
        $fecha = date('Y-m-d');
        $hora = date('H:i:s');
        $valorF = $fecha.' '.$hora;

        $validarEstado = $_SESSION["estadoMedio"];
        if($validarEstado == null){
            $validarEstado = 1;
            $_SESSION["estadoMedio"] = 1;

            if(isset($_POST["tipoMedio"])){
                $respuestaMedio = ModeloMedios::mdlMostrarTipoMediosById($_POST["tipoMedio"]);

            }else{

                $respuestaMedio = ModeloMedios::mdlMostrarMedios("id",$_SESSION["medio"],null);
            }

            for ($i=0; $i < intval( $respuestaMedio["cupo"]) ; $i++) { 
              ModeloMedios::mdlInsertaPersonal($_SESSION["medio"]);
            }
        }


        $datos = array("idUsuario"=> $_SESSION["id"],
                        "nombre" => $_POST["nombreMedio"],
                        "representante" => $_POST["responsableMedio"],
                        "documento" => $_POST["documentoMedio"],
                        "telefono" => $_POST["telefonoMedio"],
                        "direccion" => $_POST["direccionMedio"],
                        "ciudad" =>  $_POST["ciudadMedio"],
                        "correo" =>  $_POST["correoMedio"],
                        "tipoMedio" =>  $_POST["tipoMedio"],
                        "estado" =>$validarEstado,
                        "foto"=>$ruta,
                        "fechaRegistro"=>$valorF);

        $respuesta = ModeloMedios::mdlCrearMedio($tabla, $datos);

        echo ($respuesta);
        
    }

}


// =============================================================================
// REGISTRAR MEDIO
// =============================================================================
if (isset($_POST["nombreMedio"])) {
    $registrar = new AjaxRegistrarMedios();
    $registrar->ajaxCrearMedio();
}
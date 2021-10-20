<?php
session_start();
require_once "../models/logistica.modelo.php";

class AjaxLogistica
{
    // =========================================================================
    // Guardar datos
    // =========================================================================
    static public function crearLogistica($datos, $archivos)
    {
        if (isset($datos["logNombre"])) {
            if (
                preg_match('/^[0-9 ]+$/', $datos["logCelular"]) &&
                preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["logCiudad"]) &&
                preg_match('/^[0-9 ]+$/', $datos["logTelefono"])
            ) {
                $directorio = "../img/usuarios/" . $_SESSION["usuario"];
                $ruta = "img/usuarios/" . $_SESSION["usuario"];
                if (!is_dir($directorio)) {
                    mkdir($directorio, 0777, true);
                }

                $tabla = "logistica";
                $tAnterior = 0;
                $estaAnterio = $datos["logEstado"];
                if ($estaAnterio == null) {
                    $estaAnterio = 0;
                }

                if($datos["logGenero"] == "Otro"){
                    $genero = $datos["logGenero"] .','. $datos["logGeneroOtro"];
                }else{
                    $genero = $datos["logGenero"];
                }

                if($datos["logFormacionAcademica"] == "Otro"){
                    $forAcademica = $datos["logFormacionAcademica"] .','. $datos["logFormacionAcademicaOtro"];
                }else{
                    $forAcademica = $datos["logFormacionAcademica"];
                }

                $datos = array(
                    "idUsuario" => $datos["logId"],
                    "nombre" => $datos["logNombre"],
                    "apellido" => $datos["logApellido"],
                    "fechaNacimiento" => $datos["logFechaNacimiento"],
                    "ciudad" => $datos["logCiudad"],
                    "edad" => $datos["logEdad"],
                    "estatura" => $datos["logEstatura"],
                    "grupoSanguineo" => $datos["logGrupoSanguineo"],
                    "genero" => $genero,
                    "formacionAcademica" => $forAcademica,
                    "ocupacion" => $datos["logOcupacion"],
                    "trabajoAnterior" => $datos["logTrabajoAntes"],
                    "direccion" => $datos["logDireccion"],
                    "telefono" => $datos["logTelefono"],
                    "celular" => $datos["logCelular"],
                    "archivos" => $ruta,
                    "estado" => $estaAnterio
                );

                $respuesta = ModeloLogistica::mdlGuardarLogistica($tabla, $datos);

                if ($respuesta == "ok") {
                    echo json_encode($respuesta);
                }
            } else {
                if (preg_match('/^[0-9]+$/', $datos["logCelular"])) {
                    if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $datos["logCiudad"])) {
                        if (preg_match('/^[0-9]+$/', $datos["logTelefono"])) {
                            echo "ninguno";
                        } else {
                            echo "El tercero" . $datos["logTelefono"];
                        }
                    } else {
                        echo "El segundo" . $datos["logCiudad"];
                    }
                } else {
                    echo "El primero" . $datos["logCelular"];
                }
            }
        }
    }

    // =====================================================================
    // Mostrar logistica pendientes
    // =====================================================================
    static public function mostrarLogistica($item, $valor, $estado)
    {
        $respuesta = ModeloLogistica::mdlMostrarLogistica($item, $valor, $estado);
        echo json_encode($respuesta);
    }

    // =========================================================================
    // Aceptar logistica
    // =========================================================================
    static public function aprobarUsuario($id)
    {
        $respuesta = ModeloLogistica::mdlAprobarUsuario($id);
        echo json_encode($respuesta);
    }

    // =========================================================================
    // Rechazar logistica
    // =========================================================================
    static public function rechazarUsuario($id)
    {
        $respuesta = ModeloLogistica::mdlRechazarUsuario($id);
        echo json_encode($respuesta);
    }
}
// =============================================================================
// Guardar datos
// =============================================================================
if (isset($_POST["logTelefono"])) {
    $guardar = new AjaxLogistica();
    $guardar->crearLogistica($_POST, $_FILES);
}

// =============================================================================
// MOSTRAR USUARIOS DE LOGISTICA
// =============================================================================
if (isset($_POST["listar"])) {
    if ($_POST["listar"] == true) {
        $logistica = new ajaxLogistica();
        $logistica->mostrarLogistica(null, null, 0);
    }
}

// =============================================================================
// MOSTRAR USUARIOS DE LOGISTICA APROBADOS
// =============================================================================
if (isset($_POST["listarAprobados"])) {
    if ($_POST["listarAprobados"] == true) {
        $logistica = new ajaxLogistica();
        $logistica->mostrarLogistica(null, null, 1);
    }
}

// =============================================================================
// MOSTRAR USUARIOS DE LOGISTICA RECHAZADOS
// =============================================================================
if (isset($_POST["listarRechazados"])) {
    if ($_POST["listarRechazados"] == true) {
        $logistica = new ajaxLogistica();
        $logistica->mostrarLogistica(null, null, 2);
    }
}

// =============================================================================
// Mostrar usuario
// =============================================================================
if (isset($_POST["idLogistica"])) {
    $logistica = new ajaxLogistica();
    $logistica->mostrarLogistica("id", $_POST["idLogistica"], null);
}

// =============================================================================
// Mostrar usuario sesión
// =============================================================================
if (isset($_POST["id"])) {
    $logistica = new ajaxLogistica();
    $logistica->mostrarLogistica("id", $_SESSION["id"], null);
}

// =============================================================================
// Aceptar personal logistica
// =============================================================================
if (isset($_POST["aprobar"])) {
    $aprovar = new ajaxLogistica();
    $aprovar->aprobarUsuario($_POST["aprobar"]);
}

// =============================================================================
// Rechazar personal logistica
// =============================================================================
if (isset($_POST["rechazar"])) {
    $aprovar = new ajaxLogistica();
    $aprovar->rechazarUsuario($_POST["rechazar"]);
}

if (isset($_POST["direcUsuario"])) {
    // $files = array();
    $directorio = "../img/usuarios/" . $_POST["direcUsuario"] . '/';

    if (!file_exists($directorio)) @mkdir($directorio);

    // Array en el que obtendremos los resultados
    $res = array();

    // Agregamos la barra invertida al final en caso de que no exista
    if (substr($directorio, -1) != "/") $directorio .= "/";

    // Creamos un puntero al directorio y obtenemos el listado de archivos
    $dir = @dir($directorio) or die("getFileList: Error abriendo el directorio $directorio para leerlo");
    while (($archivo = $dir->read()) !== false) {
        // Obviamos los archivos ocultos
        if ($archivo[0] == ".") continue;
        if (is_dir($directorio . $archivo)) {
            $res[] = array(
                "Ruta" => $directorio . $archivo . "/",
                "Nombre" => $archivo,
                "Tamaño" => 0,
                "Modificado" => filemtime($directorio . $archivo)
            );
        } else if (is_readable($directorio . $archivo)) {
            $res[] = array(
                "Ruta" => $directorio . $archivo,
                "Nombre" => $archivo,
                "Tamaño" => filesize($directorio . $archivo),
                "Modificado" => filemtime($directorio . $archivo)
            );
        }
    }
    $dir->close();

    echo json_encode($res);
}

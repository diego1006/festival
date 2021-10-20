<?php
session_start();
require_once "../models/medios.modelo.php";

class AjaxMedios{ 

    // =====================================================================
    // Mostrar MEDIOS
    // =====================================================================
    static public function ajaxMostrarMedios($item,$valor,$estado)
    {
    	
        $respuesta = ModeloMedios::mdlMostrarMedios($item,$valor,$estado);

        echo json_encode($respuesta);
    }
    // =====================================================================
    // Mostrar MEDIOS SIN TIPO
    // =====================================================================
    static public function ajaxMostrarMediosSinTipo($item,$valor,$estado)
    {
        

        $respuesta = ModeloMedios::mdlMostrarMediosSinTipo($item,$valor,$estado);

        echo json_encode($respuesta);
    }

    // =====================================================================
    // Mostrar TIPO MEDIOS
    // =====================================================================
    static public function ajaxMostrarTipoMedios($item,$valor)
    {
        
        $respuesta = ModeloMedios::mdlMostrarTipoMedios($item,$valor);

        echo json_encode($respuesta);
    }

    // =====================================================================
    // RECHAZAR O APROBAR MEDIOS
    // =====================================================================
    static public function ajaxCambiosMedios($item,$valor)
    {
        $respuesta = ModeloMedios::mdlCambiosMedios($item,$valor);

        echo ($respuesta);

    }
    // =====================================================================
    // Mostrar PERSONAL
    // =====================================================================
    static public function ajaxMostrarPersonal($item)
    {
        
        $respuesta = ModeloMedios::mdlMostrarPersonal($item);

        echo json_encode($respuesta);
    }

}

// =============================================================================
// MOSTRAR MEDIOS
// =============================================================================
if (isset($_POST["medios"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarMedios(null, null, $_POST["medios"]);
}

// =============================================================================
// MOSTRAR MEDIOS POR ID MEDIO
// =============================================================================
if (isset($_POST["idMedio"])) { 
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarMedios('id',$_POST["idMedio"], null);
}

// =============================================================================
// MOSTRAR MEDIOS POR ID
// =============================================================================
if (isset($_POST["id"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarMedios('id',$_SESSION["medio"], null); 
}

// =============================================================================
// MOSTRAR MEDIOS SIN EL TIPO MEDIO
// =============================================================================
if (isset($_POST["sinTipo"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarMediosSinTipo('id',$_SESSION["medio"], $_SESSION["id"]);
}

// =============================================================================
// MOSTRAR TIPO MEDIOS
// =============================================================================
if (isset($_POST["tipo"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarTipoMedios(null, null);
}

// =============================================================================
// RECHAZAR O APROBAR MEDIOS
// =============================================================================
if (isset($_POST["aprobar"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxCambiosMedios($_POST["aprobar"], $_POST["cambio"]);
}


// =============================================================================
// MOSTRAR PERSONAL
// =============================================================================
if (isset($_POST["personal"])) {
    $mostrar = new AjaxMedios();
    $mostrar->ajaxMostrarPersonal($_POST["personal"]);
}


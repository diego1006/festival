<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Festival Vallenato – Fundación Festival de la Leyenda Vallenata</title>
    <link rel="shortcut icon" href="img/plantilla/icono.ico" />
    <!-- Icono -->

    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/fakeLoader.css">
    <link rel="stylesheet" href="css/validetta.css">
    <link rel="stylesheet" href="css/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/fullcalendar.min.css">
    <link rel="stylesheet" href="css/mdtimepicker.min.css">
    <link rel="stylesheet" href="css/daterangepicker.css">
    <link rel="stylesheet" href="css/jquery-ui.css">
    <link href="css/plugins-fi/explorer-fas/theme.min.css" media="all" rel="stylesheet" type="text/css" />
    <link href="css/fileinput.min.css" media="all" rel="stylesheet" type="text/css" />

    <!-- DataTables -->
    <link rel="stylesheet" href="components/datatables.net-bs/css/responsive.bootstrap.min.css">

    <script src="js/plugins/jquery-3.3.1.min.js"></script>
    <script src="js/plugins/sweetalert.min.js"></script>
    <script src="js/plugins/fakeLoader.js"></script>

</head>
<!-- <body> -->

<?php
if (isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok") {

    if (isset($_GET["ruta"])) {

        if (
            $_GET["ruta"] == "inicio" ||
            $_GET["ruta"] == "medios" ||
            $_GET["ruta"] == "mediosAprobados" ||
            $_GET["ruta"] == "mediosRechazados" ||
            $_GET["ruta"] == "logistica" ||
            $_GET["ruta"] == "logisticaAprobados" ||
            $_GET["ruta"] == "logisticaRechazados" ||
            $_GET["ruta"] == "salir" || 
            $_GET["ruta"] == "registrarMedio" ||
            $_GET["ruta"] == "completarDatos" ||
            $_GET["ruta"] == "personal" ||
            $_GET["ruta"] == "perfil"
        ) {
?>

            <body class="app sidebar-mini rtl ">
                <div id="fakeLoader"></div>
                <script type="text/javascript">
                    $("#fakeLoader").fakeLoader({
                        timeToHide: 1000,
                        zIndex: 2,
                        spinner: "spinner7",
                        bgColor: "#F0F0F0",
                    });
                </script>

                <?php
                // =========================================================================
                // Cabecera
                // =========================================================================
                include "plantillas/cabecera.php";

                // =========================================================================
                // Menú
                // =========================================================================
                include "plantillas/menu.php";
                // =============================================================
                // Contenido
                // =============================================================
                include "views/" . $_GET["ruta"] . ".php"; ?>

            </body>
        <?php
        } else {
        ?>
            <body class="app sidebar-mini rtl sidenav-toggled">
                <div id="fakeLoader"></div>
                <script type="text/javascript">
                    $("#fakeLoader").fakeLoader({
                        timeToHide: 1000,
                        zIndex: 2,
                        spinner: "spinner7",
                        bgColor: "#F0F0F0",
                    });
                </script>
                <?php
                include "plantillas/cabecera.php";
                include "plantillas/menu.php";
                include "views/404.php"; ?>
            </body>
    <?php
        }
    } else {
        echo ' <div id="fakeLoader"></div>
                    <script type="text/javascript">
                        $("#fakeLoader").fakeLoader({
                            timeToHide:1000,
                            zIndex:1999,
                            spinner:"spinner7", 
                            bgColor:"#F0F0F0",      
                        }); 
                    </script>';
        include "views/login.php";
    }
} else{
    if(isset($_GET["ruta"])){

        if ($_GET["ruta"] == "login") {
            echo ' <div id="fakeLoader"></div>
            <script type="text/javascript">
                $("#fakeLoader").fakeLoader({
                    timeToHide:1000,
                    zIndex:1999,
                    spinner:"spinner7", 
                    bgColor:"#F0F0F0",      
                }); 
            </script>';
            include "views/login.php";
    
        } else if($_GET["ruta"] == "registro") {
            echo ' <div id="fakeLoader"></div>
            <script type="text/javascript">
                $("#fakeLoader").fakeLoader({
                    timeToHide:1000,
                    zIndex:1999,
                    spinner:"spinner7", 
                    bgColor:"#F0F0F0",      
                }); 
            </script>';
            include "views/registro.php";
    
        }else if($_GET["ruta"] == "validacion") {
            echo ' <div id="fakeLoader"></div>
            <script type="text/javascript">
                $("#fakeLoader").fakeLoader({
                    timeToHide:1000,
                    zIndex:1999,
                    spinner:"spinner7", 
                    bgColor:"#F0F0F0",      
                }); 
            </script>';
            include "views/validacion.php";
    
        }else{
    
            echo ' <div id="fakeLoader"></div>
            <script type="text/javascript">
                $("#fakeLoader").fakeLoader({
                    timeToHide:1000,
                    zIndex:1999,
                    spinner:"spinner7", 
                    bgColor:"#F0F0F0",      
                }); 
            </script>';
            include "views/login.php";
    
        }
    }else{

        echo ' <div id="fakeLoader"></div>
        <script type="text/javascript">
            $("#fakeLoader").fakeLoader({
                timeToHide:1000,
                zIndex:1999,
                spinner:"spinner7", 
                bgColor:"#F0F0F0",      
            }); 
        </script>';
        include "views/login.php";

    }
}
?>


</html>
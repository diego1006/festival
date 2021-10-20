<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "inicio"; 

  </script>';

  return;

}

?>
<main class="app-content d-print-none">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-video-camera"></i> Medios Aprobados</h1>
           
        </div>
        
    </div>
    <div class="row">

        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    
                    <div class="table-responsive">

                        <table class="table table-hover table-bordered w-100 dt-responsive" id="tablaMedios">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Documento</th>
                                    <th>Nombre</th>
                                    <th>Representante</th>
                                    <th>Medio</th>
                                    <th>Teléfono</th>
                                    <th>Dirección</th>       
                                    <th>Correo</th>
                                    <th style="text-align:center">Estado</th>
                                </tr>
                            </thead>
                            <tbody>
    
                            </tbody> 
                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" id="modalVerMedio" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">
                    <img src="img/plantilla/LogoNegro.png" alt="Logo Festival vallenato" style="height: 40px">
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-p="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 0em 1em;">
                <div class="row">
                    <div class="col-lg-12 text-center t-logistica">
                        <h3 style="color: white; margin: 0.4em 0em;">Inscripción ‌de‌ ‌Medios</h3>
                    </div>
                    <div class="col-lg-12 t-item">
                        <p>Medio</p>
                        <p id="medioTipo"></p>
                    </div>
                    <div class="col-lg-12 t-log-head">
                        <p id="nombreMedio" style="color: white; margin: 0.4em 0em;text-align: center"></p>
                    </div>
                    <div class="col-lg-6 t-item">
                        <p>Representante legal</p>
                        <p id="representante"></p>
                    </div>
                    <div class="col-lg-6 t-item">
                        <p>Documento</p>
                        <p id="documento"></p>
                    </div>
                    <div class="col-lg-4 t-item">
                        <p>Ciudad</p>
                        <p id="ciudad"></p>
                    </div>
                    <div class="col-lg-4 t-item">
                        <p>Teléfono</p>
                        <p id="telefono"></p>
                    </div>
                    <div class="col-lg-4 t-item">
                        <p>Correo</p>
                        <p id="correo"></p>
                    </div>
                    <div class="col-lg-12 t-item">
                        <p>Direccion</p>
                        <p id="direccion"></p>
                    </div>                 
            
                </div>
                <div class="row personal">
                       
                </div>
                <div class="modal-footer">
                    <button type="button" id="rechazado" dataId="" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>Rechazar</button>
                   <!--  <button class="btn btn-primary" id="aprobado" dataId="" type="submit" data-dismiss="modal" id="guardar"><i class="fa fa-check"></i>Aprobar</button> -->
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "plantillas/plugin.php";
?>

<script src="js/medios.js"></script>
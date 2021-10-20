<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-bullhorn"></i> Logística pendientes</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="menu">
                <div class="tile-body">
                    <div class="table-responsive">
                        <table class="table table-hover table-bordered w-100 dt-responsive" id="tablaLogistica">
                            <thead>
                                <tr>
                                    <th style="width:10px">#</th>
                                    <th>Nombre</th>
                                    <th>Apellido</th>
                                    <th>Documento</th>
                                    <th>Correo</th>
                                    <th>Celular</th>
                                    <th>Dirección</th>
                                    <th>Archivos</th>
                                    <th>Acciones</th>
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
<div class="modal fade" id="modalVer" tabindex="-1" role="dialog" aria-hidden="true">
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
                        <h3 style="color: white; margin: 0.4em 0em;">Inscripciones‌ ‌de‌ ‌logística‌</h3>
                    </div>
                    <div class="col-lg-6 t-log-head">
                        <p id="nombre" style="color: white; margin: 0.4em 0em;">Nombre</p>
                    </div>
                    <div class="col-lg-6 t-log-head">
                        <p id="apellido" style="color: white; margin: 0.4em 0em;">Apellido</p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Fecha de nacimiento</p>
                        <p id="fechaNacimiento"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Ciudad</p>
                        <p id="ciudad"></p>
                    </div>
                    <div class="col-lg-6 t-item">
                        <p>Documento</p>
                        <p id="documento"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Edad</p>
                        <p id="edad"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Estatura</p>
                        <p id="estatura"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Género</p>
                        <p id="genero"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Grupo Sanguíneo</p>
                        <p id="grupoSanguineo"></p>
                    </div>
                    <div class="col-lg-6 t-item">
                        <p>Formación académica</p>
                        <p id="formacionAcademica"></p>
                    </div>
                    <div class="col-lg-6 t-item">
                        <p>Ocupación</p>
                        <p id="ocupacion"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Dirección</p>
                        <p id="direccion"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Teléfono</p>
                        <p id="telefono"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Celular</p>
                        <p id="celular"></p>
                    </div>
                    <div class="col-lg-3 t-item">
                        <p>Correo electrónico</p>
                        <p id="correo"></p>
                    </div>
                    <div class="col-lg-12 text-center">
                        <p style="display: inline-block">¿Ha trabajado anteriormente en la logística del Festival de la Leyenda Vallenata?</p>
                        <p id="trabajadoAntes" style="display: inline-block; font-weight: bold;">(No)</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnRechazar" dataId="" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>Rechazar</button>
                    <button class="btn btn-primary" id="btnAprobar" dataId="" type="submit" data-dismiss="modal" id="guardar"><i class="fa fa-check"></i>Aprobar</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalArchivos" tabindex="-1" role="dialog" aria-hidden="true">
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
                    <input type="file" name="logArchivo[]" id="logArchivo" multiple>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-close"></i>Cerrar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
include "plantillas/plugin.php";
?>
<script src="js/logistica.js"></script>
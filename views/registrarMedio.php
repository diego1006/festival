<main class="app-content d-print-none">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-address-card"></i> Registrarse</h1>

        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form name="crearMedio" id="crearMedio" enctype="multipart/form-data">

                        <div class="bs-component">
                            <div class="card">
                                <h4 class="card-header">
                                    <i class="fa fa-address-card" style="color:#999"></i> Inscripción de medios</h4>
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Nombre medio de comunicación</strong></label>
                                                    <input name="nombreMedio" id="nombreMedio" class="form-control" data-validetta="required"></input>
                                                    <input name="estadoMedio" type="hidden" id="estadoMedio" class="form-control"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Responsable</strong></label>
                                                    <input name="responsableMedio" id="responsableMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>documento identidad</strong></label>
                                                    <input name="documentoMedio" readonly id="documentoMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label><strong>Teléfono</strong></label>
                                                    <input name="telefonoMedio" id="telefonoMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><strong>Ciudad</strong></label>
                                                    <input name="ciudadMedio" id="ciudadMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><strong>Dirección</strong></label>
                                                    <input name="direccionMedio" id="direccionMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label><strong>Correo</strong></label>
                                                    <input name="correoMedio" readonly id="correoMedio" class="form-control" data-validetta="required"></input>
                                                </div>
                                            </div>
                                        </div>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <div class="bs-component">

                            <div class="card">
                                <h4 class="card-header">
                                    <i class="fa fa-video-camera" style="color:#999"></i> Selección de medios </h4>
                                <div class="card-body">
                                    <p class="card-text">
                                        <div class="form-group">
                                            <select name="tipoMedio" class="tipo form-control" id="tipoMedio" data-validetta="required"></select>
                                            <input name="oculto" readonly hidden id="oculto" class="form-control"></input>
                                        </div>
                                    </p>
                                </div>

                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="card">
                                <h4 class="card-header">
                                    <i class="fa fa-file-image-o" style="color:#999"></i> Archivos con los formularios</h4>
                                <div class="card-body">
                                    <!-- ENTRADA PARA SUBIR FOTO -->
                                    <div class="col-md-8">

                                        <div class="form-group">

                                            <div class="panel">SUBIR FOTO</div>

                                            <input type="file" class="nuevaFoto" name="archivo">
                                            <input type="hidden" name="fotoActual" id="fotoActual">
                                            <p class="help-block">Peso máximo de la foto 2MB</p>

                                        </div>

                                    </div>

                                    <div class="col-md-4">
                                        <div class="vistaPrevia">
                                            <img  class="img-thumbnail previsualizar" width="200px">

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                        <div style="margin-top: 2%;text-align: center;">
                            <button class="btn btn-primary" type="submit" id="guardar" style="width:420px;font-size: 20px"><strong>Registrar</strong></button>
                        </div>

                    </form>

                </div>

            </div>

        </div>

</main>

<?php
include "plantillas/plugin.php";
?>


<script src="js/registrarMedio.js"></script>
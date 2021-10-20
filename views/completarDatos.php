<main class="app-content d-print-none">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-address-card"></i> Completar datos</h1>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <div class="tile-body">
                    <form name="completarDatos" id="completarDatos" enctype="multipart/form-data">
                        <div class="bs-component">
                            <div class="card">
                                <h4 class="card-header">
                                    <i class="fa fa-address-card" style="color:#999"></i> Inscripción de logística </h4>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Número de cédula</strong></label>
                                                <input name="logCedula" id="logCedula" class="form-control" required readonly placeholder="Número de cédula"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Correo electrónico</strong></label>
                                                <input name="logCorreo" id="logCorreo" class="form-control" required readonly placeholder="Correo electrónico"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Nombre</strong></label>
                                                <input type="hidden" name="logId" id="logId">
                                                <input type="hidden" name="logUsuario" id="logUsuario">
                                                <input type="hidden" name="logEstado" id="logEstado">
                                                <input name="logNombre" id="logNombre" class="form-control" data-validetta="required" placeholder="Nombre" autofocus></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Apellido</strong></label>
                                                <input name="logApellido" id="logApellido" class="form-control" data-validetta="required" placeholder="Apellido"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Teléfono</strong></label>
                                                <input name="logTelefono" id="logTelefono" class="form-control" data-inputmask="'mask':'999 9999'" data-mask placeholder="Número de teléfono"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Celular</strong></label>
                                                <input name="logCelular" id="logCelular" class="form-control" data-inputmask="'mask':'999 999 9999'" data-mask placeholder="Número de celular" data-validetta="required, number"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Ciudad</strong></label>
                                                <select name="logCiudad" id="logCiudad" class="form-control" data-validetta="required">
                                                    <option value="">Seleccione una ciudad</option>
                                                    <option value="Valledupar">Valledupar</option>
                                                    <option value="Aguachica">Aguachica</option>
                                                    <option value="Agustín Codazzi">Agustín Codazzi</option>
                                                    <option value="Bosconia">Bosconia</option>
                                                    <option value="Chimichagua">Chimichagua</option>
                                                    <option value="El Copey">El Copey</option>
                                                    <option value="San Alberto">San Alberto</option>
                                                    <option value="Curumaní">Curumaní</option>
                                                    <option value="El Paso">El Paso</option>
                                                    <option value="La Paz">La Paz</option>
                                                    <option value="Pueblo Bello">Pueblo Bello</option>
                                                    <option value="La Jagua de Ibirico">La Jagua de Ibirico</option>
                                                    <option value="Chiriguaná">Chiriguaná</option>
                                                    <option value="Astrea">Astrea</option>
                                                    <option value="San Martín">San Martín</option>
                                                    <option value="Pelaya">Pelaya</option>
                                                    <option value="Pailitas">Pailitas</option>
                                                    <option value="Gamarra">Gamarra</option>
                                                    <option value="Manaure Balcón del Cesar">Manaure Balcón del Cesar</option>
                                                    <option value="Río de Oro">Río de Oro</option>
                                                    <option value="Tamalameque">Tamalameque</option>
                                                    <option value="Becerril">Becerril</option>
                                                    <option value="San Diego">San Diego</option>
                                                    <option value="La Gloria">La Gloria</option>
                                                    <option value="González">González</option>
                                                    <option value="Otro">Otro</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Dirección</strong></label>
                                                <input name="logDireccion" id="logDireccion" data-validetta="required" class="form-control" placeholder="Dirección"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Fecha de nacimiento</strong></label>
                                                <input name="logFechaNacimiento" id="logFechaNacimiento" data-validetta="required" class="form-control" type="date" placeholder="Fecha de nacimiento"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label><strong>Edad</strong></label>
                                                <input name="logEdad" id="logEdad" class="form-control" readonly placeholder="Edad" value=""></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Estatura (Metros)</strong></label>
                                                <input name="logEstatura" type="number" placeholder="1.4" step="0.01" min="1.4" max="2.5" id="logEstatura" class="form-control" data-validetta="required" placeholder="Estatura" data-validetta="required"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Grupo sanguíneo</strong></label>
                                                <select name="logGrupoSanguineo" id="logGrupoSanguineo" class="form-control">
                                                    <option value="">Seleccione un Grupo sanguíneo</option>
                                                    <option value="O+">O+</option>
                                                    <option value="O-">O-</option>
                                                    <option value="A+">A+</option>
                                                    <option value="A-">A-</option>
                                                    <option value="B+">B+</option>
                                                    <option value="B-">B-</option>
                                                    <option value="AB+">AB+</option>
                                                    <option value="AB-">AB-</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Ocupación</strong></label>
                                                <input name="logOcupacion" id="logOcupacion" class="form-control" data-validetta="required" placeholder="Ocupación"></input>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <div>
                                                    <label><strong>Género</strong></label>
                                                    <div class="animated-radio-button">
                                                        <label>
                                                            <input type="radio" name="logGenero" value="Mujer" data-validetta="required"><span class="label-text">Mujer</span>
                                                        </label>
                                                    </div>
                                                    <div class="animated-radio-button">
                                                        <label>
                                                            <input type="radio" name="logGenero" value="Hombre" data-validetta="required"><span class="label-text">Hombre</span>
                                                        </label>
                                                    </div>
                                                    <div class="animated-radio-button">
                                                        <label>
                                                            <input type="radio" name="logGenero" value="Otro" id="generoOtro" data-validetta="required"><span class="label-text">Otro</span>
                                                        </label>
                                                        <input type="text" class="form-control" name="logGeneroOtro" id="logGeneroOtro" style="display: none" placeholder="Especifique" data-validetta="required">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div>
                                                    <label><strong>¿Ha trabajado anteriormente en la logística del Festival de la Leyenda Vallenata? </strong></label>
                                                    <div class="animated-radio-button">
                                                        <label>
                                                            <input type="radio" name="logTrabajoAntes" data-validetta="required" value="1"><span class="label-text">Si</span>
                                                        </label>
                                                    </div>
                                                    <div class="animated-radio-button">
                                                        <label>
                                                            <input type="radio" name="logTrabajoAntes" data-validetta="required" value="0"><span class="label-text">No</span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label><strong>Formación académica</strong></label>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Primaria"><span class="label-text">Primaria</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Básica secundaria"><span class="label-text">Básica secundaria</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Bachiller"><span class="label-text">Bachiller</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Técnico"><span class="label-text">Técnico</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Tecnólogo"><span class="label-text">Tecnólogo</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Profesional"><span class="label-text">Profesional</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" name="logFormacionAcademica" data-validetta="required" value="Postgrado"><span class="label-text">Postgrado</span>
                                                    </label>
                                                </div>
                                                <div class="animated-radio-button">
                                                    <label>
                                                        <input type="radio" id="formacionOtro" name="logFormacionAcademica" data-validetta="required" value="Otro"><span class="label-text">Otro:</span>
                                                    </label>
                                                    <input type="text" class="form-control" name="logFormacionAcademicaOtro" id="logFormacionAcademicaOtro" style="display: none;" placeholder="Especifique" data-validetta="required">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bs-component">
                            <div class="card">
                                <h4 class="card-header">
                                    <i class="fa fa-file-image-o" style="color:#999"></i> Archivos con los formularios</h4>
                                <div class="card-body">
                                    <input type="file" name="logArchivo[]" id="logArchivo" multiple>
                                </div>
                            </div>
                        </div>
                        <div style="margin-top: 2%;text-align: center;">
                            <button class="btn btn-primary" type="submit" id="guardar" style="width:420px;font-size: 20px"><strong>Guardar</strong></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
include "plantillas/plugin.php";
?>
<script src="js/completarDatos.js"></script>
<body>

    <script src="js/plugins/bootstrap-notify.min.js"></script>
    <section style="background: white">
        <div></div>
    </section>

    <div class="row" style="margin: 0px">

        <div class="col-lg-8" style="background-image: url(img/plantilla/login.jpg);background-size:100% 100%;background-repeat: no-repeat;">
        </div>

        <div class="col-lg-4 text-center">
            <section class="login-content">
                <div class="login-box">
                    <form class="login-form text-center" id="registro" name="registro" style="position: relative;">
                        <img src="img/plantilla/LogoNegro.png" alt="Logo Festival vallenato" class="w-100" style="margin-bottom: 20px;">
                        <div class="form-group">
                            <input class="form-control form-control" name="documento" id="documento" type="text" placeholder="Documento o nit" data-validetta="number" data-vd-message-required="Este campo es obligatorio. Por favor, asegúrese de comprobarlo.">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="tipoRegistro" id="" data-validetta="required" data-vd-message-required="Este campo es obligatorio. Por favor, asegúrese de comprobarlo.">
                                <option value="">Tipo de registro</option>
                                <!-- <option value="Logística">Logística</option> -->
                                <option value="Medio">Medios</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control" name="correo" id="correo" type="email" placeholder="Correo" data-validetta="email" data-vd-message-required="Este campo es obligatorio. Por favor, asegúrese de comprobarlo.">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control" type="password" name="password"placeholder="Contraseña" data-validetta="required" data-vd-message-required="Este campo es obligatorio. Por favor, asegúrese de comprobarlo.">
                        </div>
                        <div class="form-group">
                            <input class="form-control form-control" type="password" name="confirmarPassword" placeholder="Confirmar contraseña" data-validetta="equalTo[password]" data-vd-message-required="Este campo es obligatorio. Por favor, asegúrese de comprobarlo.">
                        </div>
                       
                        <div class="form-group btn-container">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw" id="registrarse"></i>REGISTRARSE</button>
                            
                        </div>
                        <div class="form-group btn-container" style="margin-top: 15px">
                            <p class="semibold-text mb-2" style="display: inline-block">Ya estas registrado</p>
                            <a class="btn ml-auto btn-secondary" href="login"><i class="fa fa-sign-in fa-lg fa-fw"></i>Clic aquí</a>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>

</body>

<?php 
    include "plantillas/plugin.php";
 ?>
<script src="js/registro.js"></script>

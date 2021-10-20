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
                    <form class="login-form text-center" method="POST">
                        <img src="img/plantilla/LogoNegro.png" alt="Logo Festival vallenato" class="w-100" style="margin-bottom: 20px;">
                        <div class="form-group">

                            <input class="form-control form-control-lg" name="ingUsuario" type="text" placeholder="Correo" autofocus>
                        </div>
                        <div class="form-group">

                            <input class="form-control form-control-lg" name="ingPassword" type="password" placeholder="Contraseña">
                        </div>
                        <div class="form-group btn-container">
                            <button class="btn btn-primary btn-block" type="submit"><i class="fa fa-sign-in fa-lg fa-fw"></i>INGRESAR</button>
                            <?php
                            $login = new ControladorUsuarios();
                            $login->ctrIngresoUsuario();
                            ?>
                        </div>

                        <div class="utility ">
                            <p class="semibold-text mb-2 "><a href="#" data-toggle="flip">¿Olvidaste tu contraseña?</a></p>
                        </div>

                        <div class="form-group btn-container">
                            <p class="semibold-text mb-2" style="display: inline-block">Para registrarse</p>
                            <a class="btn ml-auto btn-secondary" href="registro"><i class="fa fa-sign-in fa-lg fa-fw"></i>Clic aquí</a>
                        </div>

                    </form>
                    <form class="forget-form" method="post">
                        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-lock"></i>Cambiar contraseña</h3>
                        <div class="form-group">
                            <label class="control-label">EMAIL</label>
                            <input class="form-control" type="text" name="passEmail" placeholder="Email" required="">
                        </div>
                        <div class="form-group btn-container">
                            <button class="btn btn-primary btn-block"><i class="fa fa-unlock fa-lg fa-fw"></i>ENVIAR</button>
                            <?php
                            $login = new ControladorUsuarios();
                            $login->ctrOlvidoPassword();
                            ?>
                        </div>
                        <div class="form-group mt-3">
                            <p class="semibold-text mb-0"><a href="#" data-toggle="flip"><i class="fa fa-angle-left fa-fw"></i> Regresar al Login</a></p>
                        </div>
                    </form>
                </div>
            </section>
        </div>

    </div>


    <script type="text/javascript">
        // Login Page Flipbox control
        $('.login-content [data-toggle="flip"]').click(function() {
            $('.login-box').toggleClass('flipped');
            return false;
        });
    </script>
</body>
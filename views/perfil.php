<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> Perfil</h1>
            <p>Configura tu perfil</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="perfil">Perfil</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="tile" id="perfil">
                <div class="tile-body">
                    <form class="text-center" role="form" method="post" id="cambiar" enctype="multipart/form-data" autocomplete="off">
                         <!-- ENTRADA NOMBRE -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-user" style="color:#15304e"></i></span>
                                </div>
                                 <input placeholder="Nombre" type="text" class="form-control" value="<?php echo $_SESSION['correo'] ?>"  readonly>
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA CONTRASEÑA ANTERIOR-->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock" style="color:#15304e"></i></span>
                                </div>
                                <input placeholder="Escribe tu contraseña" type="password" class="form-control" id="antiguaPassword" name="antiguaPassword" autocomplete="off"  data-validetta="required,minLength[5]">
                            </div>
                        </div>

                        <!-- ENTRADA PARA LA CONTRASEÑA -->
                        <div class="form-group">
                            <div class="input-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-lock" style="color:#15304e"></i></span>
                                    </div>
                                    <input placeholder="Nueva contraseña" type="password" class="form-control" id="editarPassword" name="editarPassword" autocomplete="off" data-validetta="required,minLength[5],different[antiguaPassword]" data-vd-message-different="Debe ser diferente a la anterior!">
                                    
                                </div>
                            </div>
                        </div>

                        <!-- ENTRADA PARA CONFIRMAR LA CONTRASEÑA -->
                        <div class="form-group">
                            
                            <div class="input-group">
                          
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-lock" style="color:#15304e"></i></span>
                                    </div>
                                    <input placeholder="Confirme la contraseña" type="password" class="form-control" id="confirPassword" name="confirPassword" autocomplete="off" data-validetta="required,minLength[5],equalTo[editarPassword]">
                                </div>

                            </div>
                        </div>

                        <div class=" text-right">
                            <button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
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
<script src="js/perfil.js"></script>
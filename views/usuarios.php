<?php

if($_SESSION["perfil"] != "Administrador"){

  echo '<script>

    window.location = "ordenes";

  </script>';

  return;

}

?>
<main class="app-content d-print-none">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-user"></i> Usuarios</h1>
            
        </div>

    </div>

    <div class="form-group">

        <button class="btn" data-toggle="modal" data-target="#modalAgregarUsuarios" style="width: 50px;height: 50px;border-radius: 50%;background: white" title="Nuevo">
    
           <i class="fa fa-lg fa-user-plus" style="color:#F2884B;margin-left: 5%;font-size: 19px"></i>
    
        </button>
    </div>
    <div class="row" id="contenedor">
        
        
    </div>

</main>

<div class="modal fade" id="modalAgregarUsuarios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crear" name="crear">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Digite el nombre" name="nombre" data-validetta="required">
                    </div>
                    <div class="form-group">
                        <input type="text" id="usuarioC" class="form-control" placeholder="Digite el usuario (min:5 carcteres)" name="usuario" data-validetta="required,minLength[5]">
                    </div>
                    <div class="form-group">
                        <select name="perfil" id="perfil" class="form-control perfil">
                            <option value="">Seleccione el perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Caja">Caja</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="email" id="correoC" class="form-control correo" placeholder="Digite el correo" name="correo" data-validetta="required" readonly>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="12345" name="pass" readonly>
                        <p class="text-success">Contraseña provisional</p>
                    </div>


                    <div id="alerta"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="submit" id="guardar">Guardar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>
<div class="modal fade" id="modalEditarUsuarios" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Editar Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="editar" name="editar">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="Digite el nombre" name="nombreE" id="nombre" data-validetta="required">
                    </div>
                    <div class="form-group">
                        <input type="text" id="usuarioE" class="form-control" placeholder="Digite el usuario (min:5 carcteres)" name="usuarioE" data-validetta="required,minLength[5]">
                    </div>
                    <div class="form-group">
                        <select name="perfilE" id="perfilE" class="form-control perfil">
                            <option value="">Seleccione el perfil</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Caja">Caja</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="emailE" id="correoE" class="form-control correo" placeholder="Digite el correo" name="correoE" data-validetta="required">
                    </div>

                    <input type="hidden" name="editarId" id="editarId">
                    <input type="hidden" id="usuarioActual">
                    <input type="hidden" id="correoActual">



                    <div id="alertaE"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button class="btn btn-primary" type="submit" id="guardarE">Guardar</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
</div>

<?php
include "plantillas/plugin.php";
?>

<script src="js/usuarios.js"></script>
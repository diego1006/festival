<style>
    body {
        background: #eee
    }
</style>
<header>
    <nav class="navbar navbar-dark navbar-expand-md fixed-top" style="background:#ce2127;">
        <div class="container">
            <a class="" href="indice">
                <!-- <img src="img/plantilla/logoT.png" alt="Alianza" height="35" width="104"> -->
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item active dropdown">
                        <a class="nav-link " target="_blank" href="login" style="font-size:1.2em"><i class="fa fa-sign-in"></i> Iniciar sesión</a>
                </ul>
            </div>
        </div>
    </nav>
</header>

<!-- style="background: #f7f7f7"  Color de fondo-->
<button type="button" class="btn btn-primary btn-busqueda ml-auto"><i class="fa fa-search" id="buscar"></i></button>
<div class="busqueda ml-auto toggle-busqueda" style="position: fixed; z-index:100">
    <h4 class="" style="padding: 10px;border-bottom: 1px solid #eee">
        <font style="vertical-align: inherit;">
            <center>
                <font style="vertical-align: inherit;"><i class="fa fa-search"></i> Búsqueda</font>
            </center>
        </font>
    </h4>

    <div class="form-group">
        <label>
            <font style="vertical-align: inherit;"><strong>Departamento</strong></font>
        </label>
        <select name="dpto" class="form-control" id="dpto">
            <option value="">Seleccione un departamento</option>
        </select>
    </div>

    <div class="form-group">
        <label>
            <font style="vertical-align: inherit;"><strong>Municipio</strong></font>
        </label>
        <select name="municipio" class="form-control" id="municipio">
            <option value="">Seleccione un municipio</option>
        </select>
    </div>

    <div class="form-group">
        <label>
            <font style="vertical-align: inherit;"><strong>Iglesia</strong></font>
        </label>
        <select name="iglesia" class="form-control" id="iglesia">
            <option value="">Seleccione una iglesia</option>
        </select>
    </div>
    <div class="form-group">
        <button class="btn btn-primary" id="buscarIglesia"><i class="fa fa-search"></i>Buscar</button>
    </div>

</div>

<div class="fondo">

</div>
<main class="container indice">
    <div class="row" id="contenido" style="margin-bottom: 10px">
        <!--Imagen de la iglesia -->
        <!-- <div class="col-md-12">
            <div class="card">
                <img src="https://limareps.com/wp-content/uploads/2017/06/Paquete-India-Templos-1-1920x960.jpg" height="300" alt="" class="card-img-top">
                <div class="card-body">
                    <div class="card-title">
                        Prueba de diseño para la página alianza
                    </div>
                </div>
            </div>
        </div> -->

        <!--Enseñanza -->
        <div class="col-md-6 text-justify" id="reflexion">

        </div>

        <div class="col-md-6">
            <div class="row">

                <!--Evento -->
                <div class="col-md-12" id="evento">

                </div>

                <!--Cronograma-->
                <div class="col-md-12" id="cronograma">

                </div>

                <!--Celulas-->
                <div class="col-md-12" id="celulas">


                </div>
            </div>
        </div>
    </div>
</main>

<div class="mt-5 pt-5 pb-5 footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-xs-12 about-company">
                <h2>Nuestras redes sociales</h2>
                <p class="pr-5 text-white-50">En este espacio puedes encontrar los enlaces a nuestra redes sociales </p>
                <p id="redes">

                </p>
            </div>
   
            <div class="col-lg-6 col-xs-12 location">
                <h4 class="mt-lg-0 mt-sm-4">Contacto</h4>
                <p class="mb-0" id="direccion"></p>
                <p class="mb-0" id="telefono"></p>
                <p id="email"></p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col copyright">
                <p class=""><small class="text-white-50">© 2019. Todos los derechos reservados.</small></p>
            </div>
        </div>
    </div>
</div>
<?php
include "plantillas/plugin.php";
?>
<script src="js/plugins/jquery.cookie.js"></script>

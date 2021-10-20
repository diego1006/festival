

<main class="app-content">

    <div class="app-title">
	    <h1> CUBRIMIENTO 53º FESTIVAL DE LA LEYENDA VALLENATA
		<?php if($_SESSION["perfil"]=="Medio"){
			echo '<a class="btn " href="registrarMedio">Registrase</a>';
		}else{
			echo '<a class="btn " href="completarDatos">Completar datos</a>';
		} ?>
		
		</h1>
    </div>



    	<div style="margin:0px;padding: 0px">
				
				<img src="img/plantilla/pro.jpg" alt="" class="w-100">
        </div>


    </div>
</main>

<?php
include "plantillas/plugin.php";
?>

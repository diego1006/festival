<!DOCTYPE html>
<html>

<head><meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Main CSS-->
  <link rel="stylesheet" type="text/css" href="css/main.css">
  <link rel="stylesheet" type="text/css" href="css/estilos.css">

</head>

<body style="background-color: #F7F7F7;padding-top:0px">
  <script src="js/plugins/bootstrap-notify.min.js"></script>

  <div class="row">
    <div class="col-md-3"></div>
    <div class="col-lg-6" style="padding:5% 5% 5% 5%">
      <div class="logo text-center">

        <br>
      </div>
      <div class="tile" style="padding-left: 18%;padding-right:18%;border:1px solid #ededed">
          <img src="img/plantilla/LogoNegro.png" class="" alt="Logo Festival vallenato" style="height: 90px">
          <br><br><br>
     
        <h5 style="color:gray;text-align:center">Has terminado el proceso de pre inscripción, inicia sesión para completar tus datos</h5>
        <br>
        <div class="tile-title text-center">
          <h1 style="color:#384DA6">Validacion</h1>
        </div>
        <div class="tile-body">
        <?php 

            $correo=explode("?",$_SERVER["REQUEST_URI"])[1];    


          if($correo!=NULL){

            $validar = ModeloRegistro::mdlValidarCorreo($correo);
            

            if($validar){
                
              if($validar["estado"]==0){
                  
                $cambiarEstado= ModeloRegistro::mdlCambiarValorValidado($validar["id"]);
               
                
  
              }else{
                echo '<script> window.location = "login"; </script>'; 
              }

            }else{
              echo '<script> window.location = "login"; </script>'; 
            }
            
          }else{
            echo '<script> window.location = "login"; </script>'; 
          }
          
        ?>
                      
        <div class="form-group btn-container">
                
        <a  class="btn btn-primary btn-block" href="login"> Cuenta validada correctamente!  </a>

             
            </div>

        </div>
      </div>

    </div>

  </div>

</body>

</html>
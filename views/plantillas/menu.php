  <!-- Sidebar menu-->
  <div class="app-sidebar__overlay" data-toggle="sidebar"></div>
  <aside class="app-sidebar">
    <div class="app-sidebar__user">
      <a href="perfil">


        <?php

        if ($_SESSION["perfil"] == "Administrador") {
        ?>

          <img class="app-sidebar__user-avatar" src="img/plantilla/avatar5.png" height="48" width="48" alt="User Image">

        <?php

        } elseif ($_SESSION["perfil"] == "Tecnico") {
        ?>

          <img class="app-sidebar__user-avatar" src="img/plantilla/avatar.png" height="48" width="48" alt="User Image">

        <?php

        } elseif ($_SESSION["perfil"] == "Caja") {
        ?>
          <img class="app-sidebar__user-avatar" src="img/plantilla/avatar2.png" height="48" width="48" alt="User Image">
        <?php
        }
        ?>

      </a>
      <div>
        <p class="app-sidebar__user-name"><?php echo $_SESSION["usuario"] ?></p>
      </div>
    </div>

    <ul class="app-menu">

      <?php

      if ($_SESSION["perfil"] == "Administrador") {
      ?>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-video-camera"></i><span class="app-menu__label">Medios</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="medios"><i class="icon fa fa-circle-o"></i>Pendientes</a></li>
            <li><a class="treeview-item" href="mediosAprobados"><i class="icon fa fa-circle-o"></i>Aprobados</a></li>
            <li><a class="treeview-item" href="mediosRechazados"><i class="icon fa fa-circle-o"></i>Rechazados</a></li>
          </ul>
        </li>
        <li class="treeview"><a class="app-menu__item" href="#" data-toggle="treeview"><i class="app-menu__icon fa fa-bullhorn"></i><span class="app-menu__label">Logística</span><i class="treeview-indicator fa fa-angle-right"></i></a>
          <ul class="treeview-menu">
            <li><a class="treeview-item" href="logistica"><i class="icon fa fa-circle-o"></i>Pendientes</a></li>
            <li><a class="treeview-item" href="logisticaAprobados"><i class="icon fa fa-circle-o"></i>Aprobados</a></li>
            <li><a class="treeview-item" href="logisticaRechazados"><i class="icon fa fa-circle-o"></i>Rechazados</a></li>
          </ul>
        </li>
        
      <?php
      }
      ?>

      <?php
      if ($_SESSION["perfil"] == "Logística") {
      ?>
        <li><a class="app-menu__item" href="completarDatos"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Completar datos</span></a></li>
      <?php
      }
      ?>
      <?php

      if ($_SESSION["perfil"] == "Medio") {
      ?>
        
        <li><a class="app-menu__item" href="registrarMedio"><i class="app-menu__icon fa fa-address-card"></i><span class="app-menu__label">Registrarse</span></a></li>
        
      <?php
      }
      ?>

      <?php

      if ($_SESSION["perfil"] == "Medio" && $_SESSION["estadoMedio"] == 1) {
      ?>
        
        <li><a class="app-menu__item" href="personal"><i class="app-menu__icon fa fa-users"></i><span class="app-menu__label">Personal acreditado</span></a></li>
      <?php
      }
      ?>

      
    </ul>
  </aside>
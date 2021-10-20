<!-- Navbar-->
<header class="app-header"><a class="app-header__logo" style="display: flex;justify-content: center;align-items: center;" href="inicio">
        <img src="img/plantilla/LogoBlanco.png" class="" alt="Logo Festival vallenato" style="height: 45px">
    </a>
    <!-- Sidebar toggle button--><a class="app-sidebar__toggle" href="#" data-toggle="sidebar" aria-label="Hide Sidebar"></a>

    <!-- Navbar Right Menu-->
    <ul class="app-nav">
        <li style="cursor: pointer;margin-top: 15px" data-container="body" data-toggle="popover" data-placement="top" data-content="<ul><li><a class='dropdown-item' href='perfil'><i class='fa fa-user fa-lg'></i> Contraseña</a></li><li><a class='dropdown-item' href='salir'><i class='fa fa-sign-out'></i> Salir</a></li></ul>"><i class="fa fa-sort-desc
        " style="color:white;font-size:20px"></i></li>
    </ul>
</header>
<script>
    $(document).ready(function() {
        $('[data-toggle="popover"]').popover({
            html: true
        });
    });
</script>
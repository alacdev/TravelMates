<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>                           
        <?php if (isset($_SESSION['user'])) { ?>
            <?php if ($_SESSION['user']['username'] == "admin") { ?>
                <li class="nav-item">
                    <a href="/gestion-usuarios" class="nav-link">
                        <i class="nav-icon fa fa-user-cog"></i>
                        <p>
                            Gestión usuarios
                        </p>
                    </a>
                </li>
            <?php } ?>  

            <li class="nav-item">
                <a href="/buscar-usuario" class="nav-link">
                    <i class="nav-icon fa fa-search"></i>
                    <p>
                        Buscar
                    </p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="/mapa" class="nav-link">
                    <i class="nav-icon fa fa-map"></i>
                    <p>
                        Mapa
                    </p>
                </a>
            </li>    
            <li class="nav-item">
                <a href="/chat" class="nav-link">
                    <i class="nav-icon fa fa-comment-dots"></i>
                    <p>
                        Mensajes
                    </p>
                </a>
            </li>             
        <?php } ?>
        
        <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="text-danger fa fa-arrow-alt-circle-right nav-icon"></i>
                    <p class="text-danger">Cerrar sesión</p>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->
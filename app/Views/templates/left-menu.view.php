<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/') ? 'active' : ''; ?>">
                <i class="nav-icon fa fa-home"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>                           
        <?php if (isset($_SESSION['user'])) { ?>
            <?php if ($_SESSION['user']['username'] == "admin") { ?>
                <li class="nav-item">
                    <a href="/gestion-usuarios" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/gestion-usuarios' || strpos($_SERVER['REQUEST_URI'], '/editar-usuario/') === 0) ? 'active' : ''; ?>">
                        <i class="nav-icon fa fa-user-cog"></i>
                        <p>
                            Gestión usuarios
                        </p>
                    </a>
                </li>
            <?php } ?>  

            <li class="nav-item">
                <a href="/buscar-usuario" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/buscar-usuario') ? 'active' : ''; ?>">
                    <i class="nav-icon fa fa-search"></i>
                    <p>
                        Buscar
                    </p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="/solicitudes-recibidas" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/solicitudes-recibidas') ? 'active' : ''; ?>">
                    <i class="nav-icon fa fa-handshake"></i>
                    <p>
                        Solicitudes recibidas
                    </p>
                </a>
            </li> 
            <li class="nav-item">
                <a href="/mapa" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/mapa') ? 'active' : ''; ?>">
                    <i class="nav-icon fa fa-map"></i>
                    <p>
                        Mapa
                    </p>
                </a>
            </li>    
            <li class="nav-item">
                <a href="/chat" class="nav-link <?php echo ($_SERVER['REQUEST_URI'] == '/chat') ? 'active' : ''; ?>">
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
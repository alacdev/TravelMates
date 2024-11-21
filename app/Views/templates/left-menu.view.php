<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon bi bi-house"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>         
        <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
                <a href="/mapa" class="nav-link">
                    <i class="nav-icon bi bi-map"></i>
                    <p>
                        Mapa
                    </p>
                </a>
            </li>    
            <li class="nav-item">
                <a href="/chat" class="nav-link">
                    <i class="nav-icon bi bi-chat-dots"></i>
                    <p>
                        Mensajes
                    </p>
                </a>
            </li> 
        <?php } ?>
        
        <?php if (isset($_SESSION['user'])) { ?>
            <li class="nav-item">
                <a href="/logout" class="nav-link">
                    <i class="text-danger bi bi-box-arrow-right nav-icon"></i>
                    <p class="text-danger">Cerrar sesión</p>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
<!-- /.sidebar-menu -->
<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <li class="nav-item">
            <a href="/" class="nav-link">
                <i class="nav-icon fas fa-th"></i>
                <p>
                    Inicio
                </p>
            </a>
        </li>         
        
        <li class="nav-item">
            <a href="/mapa" class="nav-link">
                <i class="nav-icon fas fa-map"></i>
                <p>
                    Mapa
                </p>
            </a>
        </li>    
        
            
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-database"></i>
                    <p>
                        Demos
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/demos/usuarios-sistema" class="nav-link <?php echo isset($seccion) && $seccion === '/demos/usuarios-sistema' ? 'active' : ''; ?>">
                                <i class="fas fa-users nav-icon"></i>
                                <p>Usuarios del Sistema</p>
                            </a>
                        </li>
     
                        <li class="nav-item">
                            <a href="/demos/usuarios-sistema/add" class="nav-link <?php echo isset($seccion) && $seccion === '/demos/usuarios-sistema/edit' ? 'active' : ''; ?>">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Alta usuario</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/demos/login" class="nav-link <?php echo isset($seccion) && $seccion === '/demos/login' ? 'active' : ''; ?>">
                                <i class="fas fa-user-lock nav-icon"></i>
                                <p>Login</p>
                            </a>
                        </li>                                                                       
                </ul>
            </li>
       
    </ul>
</nav>
<!-- /.sidebar-menu -->
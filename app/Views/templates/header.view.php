<!DOCTYPE html>
<html lang="en">
    <head>
        <base href="/">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>TravelMates</title>
        <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">

        <!-- Google Font: JetBrains Mono -->
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
        <!-- Font Awesome -->
        <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
        <!-- Bootstrap Icons -->
        <link rel="stylesheet" href="plugins/bootstrap-icons/font/bootstrap-icons.css">
        <!-- Ionicons -->
        <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <!-- Tempusdominus Bootstrap 4 -->
        <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
        <!-- iCheck -->
        <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
        <!-- JQVMap -->
        <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
        <!-- Theme style -->
        <link rel="stylesheet" href="assets/css/adminlte.min.css">
        <!-- overlayScrollbars -->
        <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
        <!-- Daterange picker -->
        <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
        <!-- summernote -->
        <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
        <!-- Select 2 -->
        <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
        <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
    </head>
    <body class="hold-transition sidebar-mini layout-fixed <?php echo isset($_COOKIE['dark']) ? 'dark-mode' : ''; ?>">
        <div class="wrapper"> 
            <!-- Navbar -->
            <nav class="main-header navbar navbar-expand navbar-white navbar-light">
                <!-- Left navbar links -->
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="bi bi-list-nested"></i></a>
                    </li>      
                </ul>

                <!-- Right navbar links -->
                <ul class="navbar-nav ml-auto">
                    <!-- Navbar Search -->
                    <li class="nav-item">
                        <?php
                        echo isset($_COOKIE['dark']) ?
                                '<a class="nav-link" href="/light" role="button">
          <i class="bi bi-sun-fill"></i>
        </a>      
      </li>' :
                                '   <a class="nav-link" href="/dark" role="button">
          <i class="bi bi-moon-fill"></i>
        </a>      
      </li>';
                        ?>
                    <li class="nav-item">
                        <a class="nav-link" href="#" role="button">
                            <i class="bi bi-bell-fill"></i>
                        </a>
                    </li>   
                    <li class="nav-item">
                        <a class="nav-link" href="<?php echo isset($_SESSION['user']['id_usuario']) ? '/logout' : '/login'; ?>" role="button">
                            <?php if (isset($_SESSION['user']['id_usuario'])) { ?>
                                <i class="text-danger bi bi-sign-out"></i> 
                                <?php
                            } else {
                                ?>
                                <i class="text-danger fas fa-sign-in-alt"></i> 

                                <?php
                            }
                            ?>
                        </a>        
                    </li>         
                </ul>
            </nav>
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">
                <!-- Brand Logo -->
                <a href="/" class="brand-link">
                    <img src="assets/img/TravelMates.png" alt="TravelMates Logo" class="brand-image" style="opacity: .8">
                    <span class="brand-text font-weight-light">TravelMates</span>
                </a>

                <!-- Sidebar -->
                <div class="sidebar">
                    <!-- Sidebar user panel (optional) -->
                    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                        <div class="image">
                            <img                                
                                src="<?php echo isset($_SESSION['user']['foto']) ? $_SESSION['user']['foto'] : 'assets/img/user2-160x160.jpg' ?> " 
                                class="img-circle elevation-2" alt="User Image">
                        </div>
                        <div class="info">
                            <?php if (isset($_SESSION['user']['nombre_completo']) && !empty($_SESSION['user']['nombre_completo'])): ?>
                                <a href="#" class="d-block">
                                    <i><?php echo htmlspecialchars($_SESSION['user']['nombre_completo']); ?></i>
                                </a>
                            <?php else: ?>
                                <a href="/login">Iniciar sesión</a>
                            <?php endif; ?>
                        </div>

                    </div>

                    <?php
                    include $_ENV['folder.views'] . '/templates/left-menu.view.php';
                    ?>
                </div>
                <!-- /.sidebar -->
            </aside>

            <!-- Content Wrapper. Contains page content -->
            <div class="content-wrapper">
                <!-- Content Header (Page header) -->
                <div class="content-header">
                    <div class="container-fluid">
                    </div><!-- /.container-fluid -->
                </div>
                <!-- /.content-header -->

                <section class="content">
                    <div class="container-fluid"><!--Fin header -->
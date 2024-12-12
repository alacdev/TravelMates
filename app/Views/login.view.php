<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Iniciar sesión</title>
        <link rel="icon" type="image/svg+xml" href="assets/img/favicon.svg">
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">        
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
        <link rel="stylesheet" href="assets/css/loginregister.css">
    </head>
    <body id="login" class="hold-transition login-page">
        <div class="login-box">
            <div class="logo">
                <img src="assets/img/TravelMatesLogin.png" alt="Logo TravelMates"/>                
            </div>
            <!-- /.login-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <form action="/login" method="post">
                        <div class="input-group mb-3">
                            <input type="text" name="username" class="form-control" placeholder="Nombre de usuario" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-at"></span>
                                </div>
                            </div>
                        </div>
                        <div class="input-group mb-3">
                            <input type="password" name="pass" class="form-control" placeholder="Contraseña" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-lock"></span>
                                </div>
                            </div>
                        </div>
                        <p class="login-box-msg text-danger"><?php echo isset($_SESSION['error_login']) ? $_SESSION['error_login'] : '' ?></p>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="col-5">
                                    <button type="submit" class="btn btn-primary btn-block">Iniciar sesión</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">
                            <a href="/register" class="text-center">¿Todavía no estás registrado?</a>
                        </p>
                    </div>
                </div>
                <!-- /.login-card-body -->
            </div>
        </div>
        <!-- /.login-box -->

        <!-- AdminLTE JS -->
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

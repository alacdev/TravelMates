<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Registro</title>
        <!-- AdminLTE CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    </head>
    <body id="register" class="hold-transition register-page">
        <div class="register-box">
            <div class="register-logo">
                <a href="#"><b>Travel</b>Mates</a>
            </div>
            <!-- /.register-logo -->
            <div class="card">
                <div class="card-body login-card-body">
                    <p class="login-box-msg">¿Quieres formar parte de esta gran familia?</p>

                    <form action="/register" method="post">
                        <div class="input-group mb-3">
                            <input type="email" name="email" class="form-control" placeholder="Correo@dominio.com" required>
                            <div class="input-group-append">
                                <div class="input-group-text">
                                    <span class="fas fa-envelope"></span>
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
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="col-5">
                                    <button type="submit" class="btn btn-primary btn-block">Registrarse</button>
                                </div>
                            </div>
                        </div>
                    </form>

                    <div class="text-center mt-3">
                        <p class="mb-0">
                            <a href="/login" class="text-center">¿Ya tienes una cuenta?</a>
                        </p>
                    </div>
                </div>
                <!-- /.register-card-body -->
            </div>
        </div>
        <!-- /.register-box -->

        <!-- AdminLTE JS -->
        <script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
        <!-- jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Bootstrap 4 -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>

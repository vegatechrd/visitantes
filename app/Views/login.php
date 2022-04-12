<?php
    $sesionU = session();
    $app = $sesionU->aplicacion;
    $Url= base_url();
    $limpiarCadenaUrl = str_replace('_', ' ', $Url);
    $nombreAplicacion = ucfirst(substr(strrchr($limpiarCadenaUrl, "/"), 1));
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Inespre Apps</title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/dist/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,600,700" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?= media(); ?>/css/login/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>/dist/css/login/style.css">
</head>

<body class="fondo-login">
    <div class="main-wrapper">
        <div class="account-page">
            <div class="container">
                <h3 class="account-title"></h3>
                <div class="account-logo">
                    <a href=""><img class="imagen-login" src="<?php echo base_url() . '/dist/img/logo_original.svg'; ?>" alt="Inespre Apps"></a>
                </div>
                <div class="account-box borde">
                    <div class="account-wrapper">
                        <div class="account-logo">
                            <h3 class="color-letra-secundario"><i class="fab fa-windows color-letra-primario"></i>&nbsp;&nbsp;<?= $nombreAplicacion ?></h3>
                            <hr>
                        </div>
                        <form method="POST" action="<?php echo base_url(); ?>/Login/autorizar_login">
                            <div class="form-group ">
                                <input class="form-control borde" type="text" autocomplete="off" id="txtUsuario" name="txtUsuario" placeholder="Usuario" value="<?php if (isset($_POST['txtUsuario'])) {
                                                                                                                                                        echo $_POST['txtUsuario'];
                                                                                                                                                    } ?>" required>
                            </div>
                            <div class="form-group ">
                                <input class="form-control  borde" type="password" autocomplete="off" id="txtContrasena" name="txtContrasena" placeholder="Contraseña" required>
                            </div>
                            <div class="form-group text-center">
                                <button class="btn color-primario btn-block borde" type="submit" id="btnIniciar" id="btnIniciar"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</button>
                            </div>
                            <div class="text-center">
                                <?php if (isset($validation)) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $validation->listErrors(); ?>
                                    </div>
                                <?php } ?>
                                <?php if (isset($error)) { ?>
                                    <div class="alert alert-danger">
                                        <?php echo $error; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>/dist/css/login/app.js"></script>
</body>

</html>
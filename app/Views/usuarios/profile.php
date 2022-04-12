<?php 
    $sesionU = session();
    $icono = 'fas fa-user';
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row p-2">
                <div class="col-sm-6">
                    <h1 class="text-dark text-bold"><i class="<?= $icono ?>"></i> <?php echo $titulo; ?></h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="<?php echo base_url();?>/dashboard">Inicio</a></li>
                        <li class="breadcrumb-item active">Perfil Usuario</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle"
                                src="<?php echo base_url();?>/dist/img/user_headset.png"
                                alt="User profile picture">
                            </div>
                            <input type="hidden" name="txtToken" id="txtToken" value="<?php echo $sesionU->token;?>">
                            <input type="hidden" name="txtID" id="txtID" value="<?php echo $sesionU->idUsuario;?>">
                        
                            <h3 class="profile-username text-center"><?php echo $datos['nombres'];?></h3>

                            <p class="text-muted text-center"><?php if ($datos['activo'] = 1) { echo "Activo";} else { echo "Inactivo";} ?></p>

                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Usuario</b> <a class="float-right"><?php echo $sesionU->idUsuario;?></a>
                                </li>
                                <li class="list-group-item">
                                    <b>Perfil/Módulo</b> <a class="float-right"><?php echo $descripcion_rol_usuario;?></a>
                                </li>                                
                            </ul>
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Cambiar Contraseña</a></li>                
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="settings">                    
                                    <?php if (isset($validation)) { ?>
                                        <div class="alert alert-danger">
                                            <?php echo $validation->listErrors();?>
                                        </div> 
                                    <?php } ?>
                                    <?php if (isset($error)) { ?>
                                        <div class="alert alert-danger">
                                        <?php echo $error;?>
                                        </div> 
                                    <?php } ?>
                                    <form method="POST" action="<?php echo base_url();?>/Login/update_password">
                                        <div class="form-group row">
                                            <label for="inputName" class="col-sm-3 col-form-label">Contraseña Actual</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="txtContrasenaActual" name="txtContrasenaActual" value="<?php if(isset($_POST['txtContrasenaActual'])) { echo $_POST['txtContrasenaActual'];}?>">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="inputEmail" class="col-sm-3 col-form-label">Contraseña Nueva</label>
                                                <div class="col-sm-9">
                                                <input type="password" class="form-control" id="txtContrasenaNueva" name="txtContrasenaNueva" value="<?php if(isset($_POST['txtContrasenaNueva'])) { echo $_POST['txtContrasenaNueva'];}?>">
                                                </div>
                                        </div>
                                        <div class="form-group row">
                                                <label for="inputName2" class="col-sm-3 col-form-label">Confirme Contraseña Nueva</label>
                                                <div class="col-sm-9">
                                                <input type="password" class="form-control" id="txtConfirmeContrasena" name="txtConfirmeContrasena" value="<?php if(isset($_POST['txtConfirmeContrasena'])) { echo $_POST['txtConfirmeContrasena'];}?>">
                                                </div>
                                        </div>                    
                                        <div class="form-group row">
                                                <div class="offset-sm-3 col-sm-9">
                                                <button class="btn btn-primary" id="btnActualizarContrasena" name="btnActualizarContrasena">
                                                <i class="fa fa-sync"></i>&nbsp;&nbsp;&nbsp;  Actualizar</button>
                                        </div>
                                        <br>
                                    </form>
                                </div> <!-- /.tab-pane -->
                            </div>  <!-- /.tab-content -->
                        </div> <!-- /.card-body -->
                    </div> <!-- /.card -->
                </div> <!-- /.col -->
            </div> <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section> <!-- /.content -->
</div> <!-- /.content-wrapper -->
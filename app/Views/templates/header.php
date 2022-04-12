<?php
$sesionU = session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="theme-color" content="#165b30">
	<meta name="author" content="Manuel Echavarria">
	<title>Inespre - <?php echo $sesionU->aplicacion . ' v.' . $sesionU->version ?></title>
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url(); ?>/dist/img/favicon.png">
	<!-- Google Font: Source Sans Pro -->
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/all.min.css">
		<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/fontawesome-free/css/solid.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	<!-- Tempusdominus Bootstrap 4 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
	<!-- Theme style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/adminlte.min.css">
	<!-- Daterange picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.css">
	<!-- Select2 -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/select2/css/select2.min.css">

	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
	<!-- DataTables -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
	<!-- Jquery UI -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/bootstrap-select-1.13.14/dist/css/bootstrap-select.min.css">
	<!-- Select picker -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.css">
	<!-- custom style -->
	<link rel="stylesheet" href="<?php echo base_url(); ?>/dist/css/dashboard.css">
	<!-- custom css Echa -->
	<link rel="stylesheet" href="<?= media(); ?>/css/style.css">
	
	<link rel="stylesheet" href="<?= media(); ?>/css/styleDataTableBoostrapResponsive.css">
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>/plugins/jquery/jquery.min.js"></script>
	<!-- jQuery UI 1.11.4 -->
	<script src="<?php echo base_url(); ?>/plugins/jquery-ui/jquery-ui.min.js"></script>

	<script src="<?php echo base_url(); ?>/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
	<!-- DataTables  & Plugins -->
	<script src="<?php echo base_url(); ?>/plugins/datatables/jquery.dataTables.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
	<!-- ChartJS -->
	<script src="<?php echo base_url(); ?>/plugins/chart.js/Chart.min.js"></script>
	<!-- Daterangepicker -->
	<script src="<?php echo base_url(); ?>/plugins/moment/moment.min.js"></script>
	<script src="<?php echo base_url(); ?>/plugins/daterangepicker/daterangepicker.js"></script>
	<!-- Select2 -->
	<script src="<?php echo base_url(); ?>/plugins/select2/js/select2.full.min.js"></script>
	<!-- Tempusdominus Bootstrap 4 -->
	<script src="<?php echo base_url(); ?>/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
	<!-- Sweetalert2 -->
	<script src="<?php echo base_url(); ?>/plugins/sweetalert2/sweetalert2.all.min.js"></script>
	<!-- AdminLTE App -->
	<script src="<?php echo base_url(); ?>/dist/js/adminlte.js"></script>
	<!-- bs-custom-file-input -->
	<script src="<?php echo base_url(); ?>/plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
	<!-- scripts select picker -->
	<script src="<?php echo base_url(); ?>/plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js"></script>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
	<!-- Site wrapper -->
	<div class="wrapper">
		<!-- Navbar -->
		<nav class="color-primario main-header navbar navbar-expand navbar-dark">
			<!-- <nav class="main-header navbar navbar-expand navbar-white navbar-light"> -->
			<!-- Left navbar links -->
			<ul class="navbar-nav">
				<li class="nav-item">
					<a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
				</li>
			</ul>

			<!--  Right navbar links -->
			<ul class="navbar-nav ml-auto">
				<!-- Navbar Search -->
				<!--   <li class="nav-item">
        <a class="nav-link" data-widget="navbar-search" href="#" role="button">
          <i class="fas fa-search"></i>
        </a>
        <div class="navbar-search-block">
          <form class="form-inline">
            <div class="input-group input-group-sm">
              <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
              <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                  <i class="fas fa-search"></i>
                </button>
                <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
          </form>
        </div>
      </li>  -->

				<!-- Messages Dropdown Menu -->

				<!-- Notifications Dropdown Menu -->
				<li class="nav-item dropdown">
				<li class="nav-item">
					<a class="nav-link" data-widget="fullscreen" href="#" role="button">
						<i class="fas fa-expand-arrows-alt"></i>
					</a>
				</li>
				<a class="nav-link" data-toggle="dropdown" href="#">
					<i class="far fa-user"></i>
					<!--    <span>&nbsp;<?php echo $sesionU->nombres; ?></span>
         &nbsp;<i class="fas fa-caret-down"></i> -->
				</a>
				<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
					<!-- <span class="dropdown-item dropdown-header">15 Notifications</span>
          <div class="dropdown-divider"></div> -->

					<a href="<?php echo base_url() . '/Login/profile/' . $sesionU->idUsuario; ?>" class="dropdown-item">
						<i class="fas fa-exchange-alt"></i> Ver Perfil
					</a>
					<div class="dropdown-divider"></div>
					<a href="<?php echo base_url(); ?>/Login/logout" class="dropdown-item">
						<i class="fas fa-sign-out-alt"></i> Salir del Sistema
					</a>
					</li>
					<!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
          <i class="fas fa-th-large"></i>
        </a>
      </li> -->
			</ul>
		</nav>
		<!-- /.navbar -->
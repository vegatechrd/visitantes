<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
           <h1 class="m-0 text-dark"><?php echo $titulo; ?></h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="<?php echo base_url();?>/dashboard">Inicio</a></li>
              <li class="breadcrumb-item active">Reportes</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

          <div class="card">
              <div class="card-header">
                <h3 class="card-title">Lista De Reportes</h3>
              </div>
              <div class="card-body">
               
                <a class="btn btn-app" href="<?php echo base_url().'/visitas/verReporteFechas'?>" style="font-size:16px;">
                <i class="fas fa-file-contract"></i> Reporte Rango de Fechas
                </a>
                <a class="btn btn-app" href="<?php echo base_url().'/visitas/verReporteInstituciones'?>" style="font-size:16px;">
                <i class="fas fa-home"></i> Reporte Personas Visitadas
                </a>
                <a class="btn btn-app" href="<?php echo base_url().'/visitas/verReporteDepartamentos'?>" style="font-size:16px;">
                <i class="fas fa-building"></i> Reporte Departamentos Visitados
                </a>
              </div>
              <!-- /.card-body -->
            </div>
              

     </section>
    <!-- /.content -->
  </div>   

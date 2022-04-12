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


<div class="card card-light">
              <div class="card-header">
                <h3 class="card-title">Reporte Visitas por Rango de Fechas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                    <div class="col-sm-3">
                   <!-- Date -->
              
                       <div class="form-group">
                           
                          <label>Fecha Inicio</label>
                   <div class="input-group date" data-target-input="nearest">
                        <input type="text" class="form-control" id="txtFechaInicio" name="txtFechaInicio" value="<?php echo date("d/m/Y");?>" required="">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="col-sm-3">
                   <div class="form-group">
                           
                          <label>Fecha Final</label>
                   <div class="input-group date" data-target-input="nearest">
                        <input type="text" class="form-control" id="txtFechaFinal" name="txtFechaFinal" value="<?php echo date("d/m/Y");?>" required="">
                        <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                        </div>
                    </div>
                </div>
                    </div>
                    <div class="col-sm-2 col-xs-6">
                          <div class="form-group">
                  <label style="color: white">Botón</label>
                  <button class="btn color-secundario btn-block" id="btnGenerarReporte" name="btnGenerarReporte"><i class="fas fa-file-pdf"></i> &nbsp;&nbsp;Generar Reporte</button>
                </div>
                 </div>
                    
                  </div>
               
        
              </div><!-- /.card-body -->
              <div class="card-footer">
         
                </div>
                
            </div>
              

     </section>
    <!-- /.content -->
  </div>   
<script>

$(document).ready(function(){  


   // Iniciando los Datetimepicker del formulario
   $('#txtFechaInicio').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    autoApply: true,
     locale: {
    format: 'DD/MM/YYYY'
  }
 });  // Fin datetimepicker

    $('#txtFechaFinal').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 1901,
    maxYear: parseInt(moment().format('YYYY'),10),
    autoApply: true,
     locale: {
    format: 'DD/MM/YYYY'
  }
 });  // Fin datetimepicker


$(document).on('click', '#btnGenerarReporte', function() { 

if($('#txtFechaInicio').val() == "") {

 Swal.fire({
      icon: 'error',
      html: 'Debe seleccionar una Fecha de Inicio.',
      showConfirmButton: true
      })
      $('#txtFechaInicio').focus();
    
}   
             
else if($('#txtFechaFinal').val() == "") {

 Swal.fire({
      icon: 'error',
      html: 'Debe seleccionar una Fecha Final',
      showConfirmButton: true
      })
      $('#txtFechaFinal').focus();
    
}

  else {

 var fecha1 = $('#txtFechaInicio').val();
 var fecha2 = $('#txtFechaFinal').val();

fechai = fecha1.split("/").join("-");
fechaf = fecha2.split("/").join("-");

window.open("<?php echo base_url();?>/visitas/DatesReport/"+fechai+"/"+fechaf,'_blank');

}


  });  //btn Generar Reporte    

 });
</script>
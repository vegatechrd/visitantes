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
                <h3 class="card-title">Reporte Personas Visitadas</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
              <div class="row">
                    <div class="col-sm-3">
                   <!-- Date -->
              
                      <div class="form-group">
                  <label>Persona Visitada</label>
                    <select class="form-control selectpicker" name="selectPersonaVisitada" id="selectPersonaVisitada" data-style="color-select">
                    <option value="">-- Seleccione Institución --</option>
                                <?php foreach ($personas as $persona) { ?>
                              <option value="<?php echo $persona['codigo']?>"><?php echo $persona['nombre']?></option>
                                   <?php } ?>                                         
                  </select>
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

$(document).on('click', '#btnGenerarReporte', function() { 

if($('#selectPersonaVisitada').val() == "") {

 Swal.fire({
      icon: 'error',
      html: 'Debe seleccionar una persona de la lista.',
      showConfirmButton: true
      })
      $('#selectPersonaVisitada').focus();
    
}   
             
else {

 var persona = $('#selectPersonaVisitada').val();
 window.open("<?php echo base_url();?>/visitas/PersonasVisitadasReport/"+persona,'_blank');

}


  });  //btn Generar Reporte    


</script>
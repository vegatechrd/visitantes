<?php
    $sesionU = session();
   ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-4 col-md-8">
                        <h1 class="m-0 text-dark text-bold"><i class="fas fa-chart-line"></i> <?php echo $titulo . ' ' . $sesionU->aplicacion . ' v' . $sesionU->version ?></h1>
                    </div>
                </div>
                <!-- /.row (main row) -->
         <br>

  <div class="row">
          <div class="col-12 col-xl-3 col-sm-6 col-md-6">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fa-solid fa-building-columns"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Visitas Activas</span>
                <span class="info-box-number">
                 <?php if($visitas_activas['id_visita'] == '') { echo "0"; } else {echo $visitas_activas['id_visita'];}?>
                </span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-xl-3 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-success elevation-1"><i class="fas fa-building"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Visitas Concluidas</span>
                <span class="info-box-number"><?php if($visitas_concluidas['id_visita'] == '') { echo "0"; } else {echo $visitas_concluidas['id_visita'];}?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->

          <!-- fix for small devices only -->
          <div class="clearfix hidden-md-up"></div>

          <div class="col-12 col-sm-6 col-xl-3 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-primary elevation-1"><i class="fas fa-users"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Visitantes Registrados</span>
                <span class="info-box-number"><?php if($visitantes['id_visitante'] == '') { echo "0"; } else {echo $visitantes['id_visitante'];}?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
          <div class="col-12 col-sm-6 col-xl-3 col-md-6">
            <div class="info-box mb-3">
              <span class="info-box-icon bg-warning elevation-1"><i class="fa-solid fa-user-group"></i></span>

              <div class="info-box-content">
                <span class="info-box-text">Personal Visitado</span>
                <span class="info-box-number"><?php if($personal_visitado['codigo'] == '') { echo "0"; } else {echo $personal_visitado['codigo'];}?></span>
              </div>
              <!-- /.info-box-content -->
            </div>
            <!-- /.info-box -->
          </div>
          <!-- /.col -->
        </div>





        <div class="row">
  <div class="col-sm-6 col-md-12 col-xl-6">
<div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-table"></i>
                 Visitas Registradas Año <b><?php echo date("Y");?></b>
                </h3>
               
              </div><!-- /.card-header -->
              <div class="card-body">
              <div id="contenedor_tabla"></div>
              </div><!-- /.card-body -->
            </div>
            </div>
             <div class="col-sm-6 col-md-12 col-xl-6">
              <div class="card card-success card-outline">
              <div class="card-header">
                <h3 class="card-title">
                  <i class="fas fa-chart-pie mr-1"></i>
                  Gráfico Visitas Registradas Año <b><?php echo date("Y");?></b>
                </h3>
               
              </div><!-- /.card-header -->
              <div class="card-body">
                 <canvas id="grafico1"></canvas>
              </div><!-- /.card-body -->
            </div>
            </div>
            </div>

            </div>
            <!-- /.container-wrapper -->
        </div>
        <!-- /.container-fluid -->
    </section>
</div>
<!-- /.content -->
<script>
$(document).ready(function(){

$.ajax({
 type: "POST",
 url: '<?php echo base_url();?>/Dashboard/getVisitasxMes',
 success: function(data) { 
var datos = JSON.parse(data);
var jsonfile = {datos};
var etiquetas = jsonfile.datos.map(function(e) {
  return e.mes_espanol;
});
var data_salidas = jsonfile.datos.map(function(e) {
  return e.total;
  });

var htmlRows ='<br>';
     htmlRows +='<table class="table table-bordered table-striped">';
     htmlRows += '<thead>';   
     htmlRows += '<tr class="bg-olive">';
     htmlRows += '<th>Mes</th> ';   
     htmlRows += '<th width="30%">Total Visitas</th>';    
     htmlRows += '</tr>';
     htmlRows += '</thead>';
     htmlRows += '<tbody>';
     $.each(datos, function(){
     htmlRows += '<tr>';
     htmlRows += '<td>'+this.mes_espanol+'</td>';
     htmlRows += '<td>'+this.total+'</td>';
     htmlRows += '</tr>';
     });   
     htmlRows += '</tbody>';
     htmlRows += '</table>';
     $('#contenedor_tabla').append(htmlRows); 

  
const $grafica = document.querySelector("#grafico1");
// Las etiquetas son las que van en el eje X. 
// Podemos tener varios conjuntos de datos
const datosSalidas = {
   label: "Visitas",
   data: data_salidas, // La data es un arreglo que debe tener la misma cantidad de valores que la cantidad de etiquetas
  backgroundColor: 'rgba(0,123,255,0.7)',// Color de fondo
  
};

new Chart($grafica, {
   type: 'bar',// Tipo de gráfica

   data: {
       labels: etiquetas,
       datasets: [
           datosSalidas,
         
          
       ]
   },
   options: {
         title: {
           display: true,
           text: '',
           fontSize: 18,
           padding: 35
           },
     plugins: {
     datalabels: {
       anchor: 'end',
       align: 'top',
       formatter: Math.round,
       font: {
         weight: 'bold'
       }
     }
   },
           responsive: true,
           legend: {
               position: 'bottom'
             },
       scales: {
           yAxes: [{
               ticks: {
                   beginAtZero: true
               }
           }],
       },
   }
});


} // success function data
});  // ajax end



}); // End Document Ready

</script>
<?php
    $sesionU = session();
   ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark text-bold"><i class="fas fa-user-plus"></i> <?= $titulo; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="content container-fluid">
            <!-- Default box -->
            <div class="card card-primary card-outline">
               
             
<div class="card-body">

<input class="limpiar" type="hidden" name="idVisitante" id="idVisitante" value="<?php echo $datos_visitante['id_visitante'];?>">

<div class="row">
<div class="col-md-7">
<fieldset class="border p-2">
    <legend class="w-auto p-2"><i class="fas fa-user"></i> Datos Visitante</legend>
<div class="row">
    <div class="col-md-12">

    <table class="table table-striped">
        <tr>
    <th>Tipo Documento:</th>
    <td><?php echo $datos_visitante['tipo_identidad']; ?></td>
 </tr>
  <tr>
    <th>Número Documento:</th>
    <td><?php echo $datos_visitante['identidad']; ?></td>
 </tr>
  <tr>
    <th>Nombres:</th>
    <td><?php echo $datos_visitante['nombres']; ?></td>
 </tr>
 <tr>
    <th>Apellidos:</th>
    <td><?php echo $datos_visitante['apellidos']; ?></td>
 </tr>
 
</table>
</div>

</div>
  </fieldset>
</div>


</div>

<br>
<div class="row">
<div class="col-md-12">

<fieldset class="border p-2">
    <legend class="w-auto p-2"><i class="fas fa-building"></i> Visitas Registradas</legend>
    <table class="table table-striped">
    <thead>
        <tr>
    <th>Fecha</th>
    <th>Hora Entrada</th>
    <th>Hora Salida</th>
    <th>Persona Visitada</th>
    <th>Departamento</th>
    <th>Motivo Visita</th>
    <th>Foto</th>
    <th>Opciones</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($datos_visita as $visitas): ?>
  <tr>
   <td><?php echo date("d/m/Y", strtotime($visitas['fecha']));?></td>
   <td><?php date_default_timezone_set('America/Santo_Domingo'); echo date("h:i:s A", strtotime($visitas['hora_entrada']));?></td>  
   <td><?php date_default_timezone_set('America/Santo_Domingo'); echo date("h:i:s A", strtotime($visitas['hora_salida']));?></td>  
    <td><?php echo $visitas['empleado']; ?></td>  
     <td><?php echo $visitas['departamento']; ?></td>  
  <td><?php echo $visitas['motivo_visita']; ?></td> 
  <td><img id="imgFrente" width="100px" height="100px" src="<?php if($visitas['foto']) { echo base_url().'/'.$visitas['foto'];} else { echo base_url().'/dist/img/silueta.png';}?>">
</div></td>
<td>
<?php  if ($privs['U'] <> "S") {
                    
                }else{  ?>
                      <a href="<?php echo base_url().'/visitas/view_history/'.$visitas['id_visita'];?>" title="Ver Detalles Visita" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
           
       <?php } ?>
</td>    
  </tr>
  <?php endforeach ?>
  </tbody>
</table>

</fieldset>
</div>
</div>

<div class="card-footer">
 <a href="<?php echo base_url();?>/visitantes/consulta_visitantes" class="btn btn-danger" type="button">
<i class="fa fa-fw  fa-times-circle"> </i> Cerrar
                </a>
</div>


<!-------------------------------------------------------------------------->

</div> <!--  card-body -->
</div> <!--  card -->
</div> <!--  content container-fluid -->
</section>
</div> <!--  content-wrapper -->
<script>

$(document).on('click', '#imgFrente', function(){
    
img = document.getElementById('imgFrente')
img.style.transform = 'scale(1.9)'

});

</script>
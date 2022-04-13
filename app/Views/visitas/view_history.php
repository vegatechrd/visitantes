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

<input type="hidden" name="idVisita" id="idVisita" value="<?php echo $datos['id_visita'];?>"> 
<input class="limpiar" type="hidden" name="idVisitante" id="idVisitante" value="<?php echo $datos['visitante_id'];?>">

<div class="row">
<div class="col-md-7">
<fieldset class="border p-2">
    <legend class="w-auto p-2"><i class="fas fa-user"></i> Datos Visitante</legend>
<div class="row">
    <div class="col-md-9">

    <table class="table table-striped">
        <tr>
    <th>Tipo Documento:</th>
    <td><?php echo $datos['tipo_identidad']; ?></td>
 </tr>
  <tr>
    <th>Número Documento:</th>
    <td><?php echo $datos['identidad']; ?></td>
 </tr>
  <tr>
    <th>Nombres:</th>
    <td><?php echo $datos['nombres']; ?></td>
 </tr>
 <tr>
    <th>Apellidos:</th>
    <td><?php echo $datos['apellidos']; ?></td>
 </tr>
 <tr>
    <th>Institución:</th>
    <td><?php echo $datos['nombre_institucion']; ?></td>
 </tr>
<tr>
    <th>Equipos / Pertenencias:</th>
    <td><?php echo $datos['equipos']; ?></td>
 </tr>
</table>
</div>
<div class="col-md-3">
    <img id="imgFrente" width="200px" height="200px" style="border: 2px solid #555;" src="<?php if($datos['foto'] != '') { echo base_url().'/'.$datos['foto']; } 
    else { echo base_url().'/dist/img/silueta.png';}?>">
</div>
</div>
  </fieldset>
</div>

<div class="col-md-5">
<fieldset class="border p-2">
    <legend class="w-auto p-2"><i class="fas fa-building"></i> Datos Persona Visitada</legend>
    <table class="table table-striped">
        <tr>
    <th>Persona Visitada:</th>
    <td><?php echo $datos['empleado']; ?></td>
 </tr>
  <tr>
    <th>Departamento:</th>
    <td><?php echo $datos['departamento']; ?></td>
 </tr>
  <tr>
    <th>Puesto:</th>
    <td><?php echo $datos['puesto']; ?></td>
 </tr>
 <tr>
    <th>Extensión:</th>
    <td><?php echo $datos['extension']; ?></td>
 </tr>
  <tr>
    <th>Email:</th>
    <td><?php echo $datos['email']; ?></td>

 </tr>

</table>

<hr>
</i><h5>Status Visita: <?php if(empty($datos['hora_salida'])) { echo '<span class="badge bg-success">ACTIVA</span>';} else { echo '<span class="badge bg-warning">CONCLUIDA</span>';}?></h5>

</fieldset>
</div>
</div>

<br>
<div class="row">
<div class="col-md-12">
<fieldset class="border p-2">
    <legend class="w-auto p-2"><i class="fas fa-home"></i> Datos Visita</legend>
 <div class="row">
<div class="col-2">
<label>Fecha Visita</label>    
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-calendar"></i></span>
</div>
<input type="text" style="font-size: 20px;" class="form-control" value="<?php echo date("d/m/Y", strtotime($datos['fecha']));?>" disabled>
</div>
</div>
<div class="col-2">
<label>Hora Entrada</label>    
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-clock"></i></span>
</div>
<input type="text" class="form-control" style="font-size: 20px;" value="<?php date_default_timezone_set('America/Santo_Domingo'); echo date("h:i:s A", strtotime($datos['hora_entrada']));?>" disabled>
</div>
</div>
<div class="col-2">
<label>Hora Salida</label>    
<div class="input-group mb-3">
<div class="input-group-prepend">
<span class="input-group-text"><i class="fas fa-clock"></i></span>
</div>
<input type="text" class="form-control" style="font-size: 20px;" value="<?php date_default_timezone_set('America/Santo_Domingo'); if(!empty($datos['hora_salida'])) {echo date("h:i:s A", strtotime($datos['hora_salida']));}?>" disabled>
</div>
</div>
<div class="col-4">
<label>Motivo Visita</label>
<input type="text" class="form-control"  value="<?php echo $datos['motivo_visita']; ?>" disabled>
</div>
<div class="col-1">
<label>Número Gafete</label>
<input type="text" class="form-control"  value="<?php echo $datos['no_gafete']; ?>" disabled>
</div>
<div class="col-1">
<label>Total Visitantes</label>
<input type="text" class="form-control"  value="<?php echo $datos['total_visitantes']; ?>" disabled>
</div>
</div>

  </fieldset>
</div>

</div>



<div class="card-footer">
<a href="<?php echo base_url().'/visitas/printVisita/'.$datos['id_visita'];?>" target= "_blank" class="btn btn-success" id="btnImprimir" name="btnImprimir"><i class="fa fa-fw  fa-print"></i> Imprimir</a>    
<a href="<?php echo base_url();?>/visitas/historico" class="btn btn-danger" id="btnCerrar" name="btnCerrar"><i class="fa fa-fw  fa-times-circle"></i> Cerrar</a>
</div>


<!-------------------------------------------------------------------------->

</div> <!--  card-body -->
</div> <!--  card -->
</div> <!--  content container-fluid -->
</section>
</div> <!--  content-wrapper -->

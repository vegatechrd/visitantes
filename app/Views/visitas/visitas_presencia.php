<?php
    $sesionU = session();
    include_once('modalSalida.php');
?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="d-flex col-sm-6">
                      
                        <h1 class="m-0 text-dark text-bold"><i class="fas fa-users"></i> <?= $titulo; ?></h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="content container-fluid">
            <!-- Default box -->
            <div class="card">
                <!-- Validation Messages -->
                <?php if (isset($validation)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $validation->listErrors(); ?>
                    </div>
                <?php } ?>
                <div class="card-header color-primario">
                    <div class="d-flex flex-row justify-content-around align-items-center">
                        <div class="flex-grow-1 mr-1">
                            <input type="text" class="form-control text-gray" placeholder="Buscar..." id="txtBuscar" name="txtBuscar">
                        </div>
                        <div class="form-inline">
                            <select class="form-control custom-select mx-1 text-gray" id="selectEntries">
                                <option value="10" class="text-gray">10</option>
                                <option value="25" class="text-gray">25</option>
                                <option value="50" class="text-gray">50</option>
                                <option value="100" class="text-gray">100</option>
                            </select>
                        </div>
                        <?php if ($privs['C'] <> "S") {  ?>

                        <?php } else { ?>
                            <a href="visitas/create" class="btn color-secundario">
                            <i class="fas fa-plus"></i> <span class="hidden-letters"> Agregar</span>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table style="width: 100%;" class="display nowrap no-footer data-table table table-striped table-sm" cellspacing="0" id="tabla_visitas_presencia">
                        <thead>
                            <tr class="color-primario text-bold">
                                <th style="width: 10%;" >Fecha</th>
                                <th style="width: 22%;">Visitante</th>
                                <th style="width: 10%;">Identidad</th>
                                <th style="width: 10%;">No. Gafete</th>
                                <th style="width: 22%;">Persona Visita</th>
                                <th style="width: 22%;">Departamento</th>
                                <th style="width: 10%;">Hora Entrada</th>
                                <th style="width: 10%;">Hora Salida</th>
                                <th style="width: 15%;">Opciones</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                              <?php foreach ($datos as $visita) {  ?>
     <tr>
                                            <td><?php echo date('d-m-Y', strtotime($visita['fecha']));?></td>  
                                            <td><?php echo $visita['nombres'].' '.$visita['apellidos'];?></td>
                                            <td><?php echo $visita['identidad'];?></td>
                                            <td><?php echo $visita['no_gafete'];?></td>
                                            <td><?php echo $visita['empleado'];?></td>
                                             <td><?php echo $visita['departamento'];?></td>
                                             <td><?php echo date('h:i A', strtotime($visita['hora_entrada']));?></td>  
                                            
                                             
                                              <td> <button onclick="MarcarSalida('<?php echo $visita['id_visita'];?>')" title="Marcar Salida" class="btn btn-sm btn-outline-success"><i class="fas fa-clock"></i> Marcar Salida</button></td>
                                                   <td>
         <?php  if ($privs['U'] <> "S") {
                    
                }else{  ?>
                      <a href="<?php echo base_url().'/visitas/view/'.$visita['id_visita'];?>" title="Ver Detalles Visita" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
           <a href="<?php echo base_url().'/visitas/edit/'.$visita['id_visita'];?>" title="Editar Visita" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></a>
           <a href="<?php echo base_url().'/visitas/printGafete/'.$visita['id_visita'];?>" target="_blank" title="Imprimir Gafete Visita" class="btn btn-sm btn-warning"><i class="fas fa-print"></i></a>
       <?php } ?>
      <?php  if ($privs['D'] <> "S") {
                    
                }else{ ?>
           <button onclick="EliminarVisita('<?php echo $visita['id_visita'];?>')" title="Eliminar Visita" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
 <?php } ?>
        </td>        
     </tr>
 <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="m-3 border-top text-sm">
                    <div class="float-left mt-2">
                        <p class="text-muted" id="numbers_numbers"></p>
                    </div>
                    <div class="float-right mt-2">
                        <p class="text-muted" id="pagination_pagination"></p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script>
 
$(document).ready (function() {


}); // End document Ready


function MarcarSalida(id) {

  $('#idVisita').val(id);
  $('#modalSalida').modal('show');

}

  function EliminarVisita(id) {

Swal.fire({
  title: 'Eliminar?',
  text: "Estás seguro de eliminar esta Visita ?",
  icon: 'error',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'Si, Eliminar.',
  cancelButtonText: 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {

$.ajax({
         type: "POST", 
         url: "<?php echo base_url();?>/visitas/delete",
         data: {id: id},
                 success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Eliminada!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
window.location.href = "<?php echo base_url();?>/visitas";
});
}

else {

Swal.fire({
   icon: 'danger',
   title: 'Error!',
   text: datos.msg,
   showConfirmButton: true});


        }
          
        } //Success Function Data
        
      });




} // if result.isconfirmed

}) //then result





 }  // end function Eliminar




</script>
<?php
    $sesionU = session();
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
                        
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table style="width: 100%;" class="display nowrap no-footer data-table table table-striped table-sm" cellspacing="0" id="tabla_visitas_presencia">
                        <thead>
                            <tr class="color-primario text-bold">
                                <th style="width: 10%;" >Nombres</th>
                                <th style="width: 22%;">Apellidos</th>
                                <th style="width: 10%;">Tipo Identidad</th>
                                <th style="width: 10%;">Identidad</th>
                                <th style="width: 15%;">Opciones</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                              <?php foreach ($datos as $visitante) {  ?>
     <tr>
                                            <td><?php echo $visitante['nombres'];?></td>
                                            <td><?php echo $visitante['apellidos'];?></td>
                                            <td><?php echo $visitante['tipo_identidad'];?></td>
                                            <td><?php echo $visitante['identidad'];?></td>
                                                                                         
                                              
                                                   <td>
         <?php  if ($privs['U'] <> "S") {
                    
                }else{  ?>
                      <a href="<?php echo base_url().'/visitantes/view/'.$visitante['id_visitante'];?>" title="Ver Detalles Visitante" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
         
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


$(document).on('click', '#btnEliminar', function(){

var idLabel = $(this).parents('tr').find('td').eq(0).text();

Swal.fire({
  title: 'Eliminar?',
  text: "Estás seguro de eliminar esta Etiqueta ?",
  icon: 'error',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'Si, Eliminar.',
  cancelButtonText: 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {
$(this).parents('tr').remove();
Swal.fire({
  icon: 'success',
  title: 'Eliminado!',
  text: 'La Etiqueta fue eliminada correctamente!',
  showConfirmButton: false,
  timer: 2000
})
$.ajax({
         type: "POST", 
         url: "<?php echo base_url();?>/labels/delete",
         data: {idLabel: idLabel},
         success:function(data) {

          }
        
      });


}

})
        
}); // End btnEliminar



</script>
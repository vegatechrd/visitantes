<?php
    $sesionU = session();
    include_once("modalVisitantes.php");
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
                                <th>ID</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Tipo Identidad</th>
                                <th>Identidad</th>
                                <th>Teléfono</th>
                                <th>Status</th>
                                <th style="width: 10%;">Opciones</th>
                                
                            </tr>
                        </thead>
                         <tbody>
                              <?php foreach ($datos as $visitante) {  ?>
     <tr>
                                            <td><?php echo $visitante['id_visitante'];?></td>
                                            <td><?php echo $visitante['nombres'];?></td>
                                            <td><?php echo $visitante['apellidos'];?></td>
                                            <td><?php echo $visitante['tipo_identidad'];?></td>
                                            <td><?php echo $visitante['identidad'];?></td>
                                            <td><?php echo $visitante['telefono'];?></td>
                                            <td>
          <?php if($visitante['status']==1) { ?>
            <span class="badge bg-primary">Activo</span>
            <?php } else {
          ?><span class="badge bg-danger">Inactivo</span>    
          <?php 
          };?>
          </td>  
                                                                                         
                                              
                                                   <td>
         <?php  if ($privs['U'] <> "S") {
               }else{  ?>
                      <a href="<?php echo base_url().'/visitantes/view/'.$visitante['id_visitante'];?>" title="Ver Detalles Visitante" class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                      <button id="btnEditarVisitante" name="btnEditarVisitante" title="Editar Visitante" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></button>   
                        
       <?php } ?>
       <?php  if ($privs['D'] <> "S") {
                    
                }else{ ?>
           <button id="btnEliminarVisitante" name="btnEliminarVisitante" title="Inactivar Visitante" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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
 
$(document).on('click', '#btnEliminarVisitante', function(){

var idVisitante = $(this).parents('tr').find('td').eq(0).text();

Swal.fire({
  title: 'Inactivar?',
  text: "Estás seguro de Inactivar este Visitante ?",
  icon: 'error',
  showCancelButton: true,
  confirmButtonColor: '#d33',
  cancelButtonColor: '#3085d6',
  confirmButtonText: 'Si, Inactivar.',
  cancelButtonText: 'Cancelar'
}).then((result) => {
if (result.isConfirmed) {

$.ajax({
         type: "POST", 
         url: "<?php echo base_url();?>/visitantes/delete",
         data: {id_visitante: idVisitante},
                 success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Inactivado!',
   text: datos.msg,
   showConfirmButton: false,
  timer: 2000
}).then(function () {
window.location.href = "<?php echo base_url();?>/visitantes/consulta_visitantes";
});
}

else {

Swal.fire({
   icon: 'error',
   title: 'Error!',
   text: datos.msg,
   showConfirmButton: true});


        }
          
        } //Success Function Data
        
      });




} // if result.isconfirmed

}) //then result




        
}); // End btnEliminar


$(document).on('click', '#btnEditarVisitante', function(){

//$status = $(this).parents('tr').find('td').eq(6).text(); 

$('#idVisitante').val($(this).parents('tr').find('td').eq(0).text());
$('#listTipoDocumentoVisitante').selectpicker('val', $(this).parents('tr').find('td').eq(3).text()); 

var $selected = $('#listTipoDocumentoVisitante').find('option:selected');
    if ($selected.val() === 'Pasaporte') {
    $("#txtDocumentoVisitante").inputmask("AA9999999");
    }
    else {
    $("#txtDocumentoVisitante").inputmask("999-9999999-9");

    }

$('#txtDocumentoVisitante').val($(this).parents('tr').find('td').eq(4).text());
$('#txtNombresVisitante').val($(this).parents('tr').find('td').eq(1).text());
$('#txtApellidosVisitante').val($(this).parents('tr').find('td').eq(2).text());
$('#txtTelefonoVisitante').val($(this).parents('tr').find('td').eq(5).text());


$('#listStatus').selectpicker('text', $(this).parents('tr').find('td').eq(6).text()); 
document.querySelector('#btnTextVisitante').innerHTML = "Actualizar";
document.querySelector('#tituloModalVisitante').innerHTML = "Editar Visitante";
$('#modalVisitantes').modal('show');

});

function GuardarVisitante() {

    var idVisitante = document.querySelector('#idVisitante').value;
    var strTipoDocumento = document.querySelector('#listTipoDocumentoVisitante').value;   
    var strDocumento = document.querySelector('#txtDocumentoVisitante').value; 
    var strNombres = document.querySelector('#txtNombresVisitante').value;
    var strApellidos = document.querySelector('#txtApellidosVisitante').value;
    var strTelefono = document.querySelector('#txtTelefonoVisitante').value; 
    var status = document.querySelector('#listStatus').value;   
              
     if (strNombres == '') {
         
         Swal.fire({
             icon: 'error',
             title: 'Error',
             text: 'El Nombre del Visitante es obligatorio.',
             confirmButtonText: 'Ok',
             confirmButtonColor: '#aea322'
         });
         
         return false;
     }

      if (strApellidos == '') {
         
         Swal.fire({
             icon: 'error',
             title: 'Error',
             text: 'El Apellido del Visitante es obligatorio.',
             confirmButtonText: 'Ok',
             confirmButtonColor: '#aea322'
         });
         
         return false;
     }

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/visitantes/update",
data: { id_visitante: idVisitante, tipo_documento: strTipoDocumento, documento: strDocumento, nombres : strNombres, apellidos: strApellidos, 
    telefono: strTelefono, status: status },
     success: function(data) {
   let datos = JSON.parse(data);
   if (datos.status === true) {
Swal.fire({
icon: 'success',
title: 'Actualizado!',
text: datos.msg,
showConfirmButton: true,
}).then(function () {
   
$('#modalVisitantes').modal('hide');
window.location.href = "<?php echo base_url();?>/visitantes/consulta_visitantes";
});
}

else {

Swal.fire({
icon: 'error',
title: 'Error!',
text: datos.msg,
showConfirmButton: true});


     }
       
     } //Success Function Data

   }); //Ajax


}

</script>
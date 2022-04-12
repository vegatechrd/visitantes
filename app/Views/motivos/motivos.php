<?php
    $sesionU = session();
    require_once('modalMotivos.php');
   ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="d-flex col-sm-6">
                      
                        <h1 class="m-0 text-dark text-bold"><i class="fas fa-list"></i> <?= $titulo; ?></h1>
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
                            <button type="button" class="btn color-secundario" id="btnAgregarMotivo" name="btnAgregarMotivo">
                                <i class="fas fa-plus"></i> <span class="hidden-letters"> Agregar</span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table style="width: 100%;" class="display nowrap no-footer data-table table table-striped table-sm" cellspacing="0" id="tabla_motivos">
                        <thead>
                            <tr class="color-primario text-bold">
                                <th style="width: 50%;">Descripci&oacute;n Motivo</th>
                                <th style="width: 14%;">Estado</th>
                                <th style="width: 11%;">Opciones</th>
                            </tr>
                        </thead>
                               <tbody>
                        
                        <?php foreach ($datos as $dato): ?>
                        <tr>
                       
                        <td><?php echo $dato['descripcion'];?></td>   
                        
                          <td>
          <?php if($dato['status']==1) { ?>
            <span class="badge bg-primary">Activo</span>
            <?php } else {
          ?><span class="badge bg-danger">Inactivo</span>    
          <?php 
          };?>
          </td>  
                        <td>
         <?php  if ($privs['U'] <> "S") {
                    
                }else{  ?>
                    <button onclick="EditarMotivo('<?php echo $dato['id_motivo'];?>')" title="Editar Motivo" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></button>
          
       <?php } ?>
      <?php  if ($privs['D'] <> "S") {
                    
                }else{ ?>
           <button onclick="EliminarMotivo('<?php echo $dato['id_motivo'];?>')" title="Eliminar Motivo" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
 <?php } ?>
        </td>        
                        </tr>

                        <?php endforeach ?>
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
 $(document).ready(function(){

   }); // document Ready Function   

 $(document).on('click', '#btnAgregarMotivo', function() { 

  $('#txtDescripcionMotivo').val('');
  $('#divEstadoMotivo').hide(); 
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#titleModalMotivos').innerHTML = "Agregar Nuevo Motivo";
  $('#modalMotivos').modal('show');



      }); //btnAgregarInstitucion



  function GuardarMotivo() {

         var id = document.querySelector('#idMotivo').value;
        var strDescripcion = document.querySelector('#txtDescripcionMotivo').value;
        var intStatus = document.querySelector('#listStatus').value;

        if (strDescripcion == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El Campo Descripción es obligatorio.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

        if (id == '') {

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/motivos/insert",
data: { descripcion : strDescripcion },
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Guardado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
$('#modalMotivos').modal('hide');
window.location.href = "<?php echo base_url();?>/motivos";

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

        else 

{

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/motivos/update",
data: { id: id, descripcion : strDescripcion, status: intStatus },
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Actualizado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
$('#modalMotivos').modal('hide');
window.location.href = "<?php echo base_url();?>/motivos"; 
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


      } 


 function EditarMotivo(id) {

 $.ajax({
type: "POST",
url: "<?php echo base_url();?>/motivos/edit",
data: { id: id },
        success: function(data) {
            
      let arrDatos = JSON.parse(data);
     
      if (arrDatos.status === true) {

          $('#txtDescripcionMotivo').val('');
          $('#divEstadoMotivo').show(); 
         document.querySelector('#idMotivo').value = arrDatos.data.id_motivo;
         document.querySelector('#txtDescripcionMotivo').value = arrDatos.data.descripcion;
         document.querySelector('#listStatus').value = arrDatos.data.status;   
         $('#listStatus').selectpicker('render');
         
        document.querySelector('#btnText').innerHTML = "Actualizar";
        document.querySelector('#titleModalMotivos').innerHTML = "Actualizar Motivo";
        $('#modalMotivos').modal('show');

 }
          
        } //Success Function Data

      }); //Ajax   



 }

  function EliminarMotivo(id) {

Swal.fire({
  title: 'Eliminar?',
  text: "Estás seguro de eliminar esta Institución ?",
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
         url: "<?php echo base_url();?>/motivos/delete",
         data: {id: id},
                 success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Eliminado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
window.location.href = "<?php echo base_url();?>/motivos";
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
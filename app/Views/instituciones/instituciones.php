<?php
    $sesionU = session();
    require_once('modalInstituciones.php');
   ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="d-flex col-sm-6">
                      
                        <h1 class="m-0 text-dark text-bold"><i class="fas fa-building"></i> <?= $titulo;?></h1>
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
                            <button type="button" class="btn color-secundario" id="btnAgregarInstitucion" name="btnAgregarInstitucion">
                                <i class="fas fa-plus"></i> <span class="hidden-letters"> Agregar</span>
                            </button>
                        <?php } ?>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table style="width: 100%;" class="display nowrap no-footer data-table table table-striped table-sm" cellspacing="0" id="tabla_instituciones">
                        <thead>
                            <tr class="color-primario text-bold">
                                <th style="width: 50%;">Nombre Instituci&oacute;n</th>
                                <th style="width: 20%;">Tel&eacute;fono</th>
                                <th style="width: 14%;">Estado</th>
                                <th style="width: 11%;">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        
                        <?php foreach ($datos as $dato): ?>
                        <tr>
                       
                        <td><?php echo $dato['nombre_institucion'];?></td>   
                        <td><?php echo $dato['telefono_institucion'];?></td>
                          <td>
          <?php if($dato['status_institucion']==1) { ?>
            <span class="badge bg-primary">Activo</span>
            <?php } else {
          ?><span class="badge bg-danger">Inactivo</span>    
          <?php 
          };?>
          </td>  
                        <td>
         <?php  if ($privs['U'] <> "S") {
                    
                }else{  ?>
                    <button onclick="EditarInstitucion('<?php echo $dato['id_institucion'];?>')" title="Editar Institución" class="btn btn-sm btn-success"><i class="fas fa-pencil-alt"></i></button>
          
       <?php } ?>
      <?php  if ($privs['D'] <> "S") {
                    
                }else{ ?>
           <button onclick="EliminarInstitucion('<?php echo $dato['id_institucion'];?>')" title="Eliminar Institución" class="btn btn-sm btn-danger"><i class="fas fa-trash-alt"></i></button>
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

 $(document).on('click', '#btnAgregarInstitucion', function() { 

  $('.limpiar').val('');
  $('#divEstado').hide(); 
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#tituloModal').innerHTML = "Agregar Nueva Institución";
  $('#modalInstituciones').modal('show');



      }); //btnAgregarInstitucion



  function GuardarInstitucion() {

        var id = document.querySelector('#idInstitucion').value;
        var strNombre = document.querySelector('#txtNombreInstitucion').value;
        var strTelefono = document.querySelector('#txtTelefono').value;
        var intStatus = document.querySelector('#listStatus').value;

        if (strNombre == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El Campo Nombre Institución es obligatorio.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

        if (id == '') {

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/instituciones/insert",
data: { nombre : strNombre, telefono: strTelefono },
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Guardado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
$('#modalInstituciones').modal('hide');
window.location.href = "<?php echo base_url();?>/instituciones";
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
url: "<?php echo base_url();?>/instituciones/update",
data: { idInstitucion: id, nombre : strNombre, telefono: strTelefono, status: intStatus },
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Actualizado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
$('#modalInstituciones').modal('hide');
window.location.href = "<?php echo base_url();?>/instituciones";
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


      } //función Agregar Institución




 function EditarInstitucion(id) {

 $.ajax({
type: "POST",
url: "<?php echo base_url();?>/instituciones/edit",
data: { id: id },
        success: function(data) {
            
      let arrDatos = JSON.parse(data);
     
      if (arrDatos.status === true) {

         $('.limpiar').val('');   
         $('#divEstado').show();
         document.querySelector('#idInstitucion').value = arrDatos.data.id_institucion;
         document.querySelector('#txtNombreInstitucion').value = arrDatos.data.nombre_institucion;
         document.querySelector('#txtTelefono').value = arrDatos.data.telefono_institucion;
         document.querySelector('#listStatus').value = arrDatos.data.status_institucion;   
         $('#listStatus').selectpicker('render');
         
        document.querySelector('#btnText').innerHTML = "Actualizar";
        document.querySelector('#tituloModal').innerHTML = "Actualizar Institución";
        $('#modalInstituciones').modal('show');

 }
          
        } //Success Function Data

      }); //Ajax   



 }

  function EliminarInstitucion(id) {

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
         url: "<?php echo base_url();?>/instituciones/delete",
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
window.location.href = "<?php echo base_url();?>/instituciones";
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
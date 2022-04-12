<!-- Modal -->
<div class="modal fade" id="modalSalida" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content modal-style">
            <div class="modal-header header-modal">
                <h5 class="modal-title font-weight-bold" id="tituloModal">Confirma La Salida?</h5>
                
            </div>
            <div class="modal-body">

                <form id="formSalida" name="formSalida" class="form-horizontal">
                    <input type="hidden" name="idVisita" id="idVisita">
  <div class="form-group" align="center">
 <div class="input-group date" data-target-input="nearest">
    <input type="text" style="font-size:24px;" class="form-control datetimepicker-input" name="txtHoraSalida" id="txtHoraSalida" data-target="#txtHoraSalida" data-toggle="datetimepicker" 
     value="<?php date_default_timezone_set('America/Santo_Domingo'); echo date("h:i:s A");?>">
                    <div class="input-group-append" >
                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                    </div>
            </div>
</div>
                   
                 </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardarSalida" class="btn color-secundario" onclick="GuardarSalida();">
                <i class="fa fa-fw  fa-check-circle">&nbsp;</i><span id="btnText">Guardar</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw  fa-times-circle"> </i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    
$(document).ready(function(){

$('#txtHoraSalida').datetimepicker({
     format: 'LT'

 });  // 

 });

function GuardarSalida() {

       var idVisita = document.querySelector('#idVisita').value; 
       var horaSalida = document.querySelector('#txtHoraSalida').value;
     
  if (idVisita == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Hubo un error al intentar Guardar. Contacte al Administrador por favor.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }



        if (horaSalida == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El Campo Hora Salida es obligatorio.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

   

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/visitas/update_salida",
data: { id_visita : idVisita, hora_salida: horaSalida },
        success: function(data) {
        let datos = JSON.parse(data);
        if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Hora Salida!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
$('#modalSalida').modal('hide');
window.location.href = "<?php echo base_url();?>/visitas"; 
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
$(document).ready(function(){

   $('#txtFecha').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2020,
    maxYear: 2028,
    autoApply: true,
     locale: {
    format: 'DD/MM/YYYY'
  }
 });  // Fin datetimepicker

$('#txtHoraEntrada').datetimepicker({
     format: 'LT'

 });  // Fin datetimepicker   

});

$(document).on('change', '#SelectTipoDocumento', function(){

 var strTipoDocumento = document.querySelector('#SelectTipoDocumento').value;

if (strTipoDocumento == 4) {

 $('#txtNoDocumento').val('');
 $('#txtNoDocumento').attr('readonly',true);


} 

else {

$('#txtNoDocumento').attr('readonly',false);

}

 });  

 $(document).on('click', '#btnActualizarVisita', function(){

  var form = document.querySelector('#formEditVisita');

    form.onsubmit = function(e){

        e.preventDefault();
        var strNombre = document.querySelector('#txtNombre').value;
        var intMotivoVisita = document.querySelector('#listMotivoVisita').value;
        var dateFecha = document.querySelector('#txtFecha').value;
        var dateHora = document.querySelector('#txtHoraEntrada').value;
        var intDepartamentos = document.querySelector('#listDepartamentos').value;
        var intEmpleados = document.querySelector('#listEmpleados').value;
        var strTipoDocumento = document.querySelector('#SelectTipoDocumento').value;
        var strNoDocumento = document.querySelector('#txtNoDocumento').value;

        if (strNombre == '' || intMotivoVisita == 'defecto' || dateFecha == '' || dateHora == '' || intDepartamentos == 'defecto' || intEmpleados == 'defecto') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos con * son obligatorios',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

        if (strNoDocumento == '' && strTipoDocumento != 4) {

             Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Debe digitar un número de documento',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;



        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/visitas/insert';
        var formData = new FormData(form);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                               
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Registro Visitas',
                        text: objData.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#aea322'
                    }).then(function() {
                    window.location.href = base_url+'/visitas';  
                    });
                 
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: objData.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#aea322'
                    });
                }

                 
            }
        }


    } 

});


$(document).on('click', '#btnCerrarEdicionVisita', function(){

 window.location.href = base_url+'/visitas';

});

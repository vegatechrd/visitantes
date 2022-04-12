$(document).ready(function(){

  

   

});  //End Document Ready


$(document).on('click', '#btnGuardarVisita', function(){

  var form = document.querySelector('#formNuevaVisita');

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


        if (strNombre == '' || intMotivoVisita == '' || dateFecha == '' || dateHora == '' || intDepartamentos == '' || intEmpleados == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'Todos los campos marcados con * son obligatorios',
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
        var ajaxUrl = base_url+'/visitas/store';
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




$(document).on('click', '#btnAddMotivo', function(){

     var form = document.querySelector('#formMotivos');

    form.onsubmit = function(e){

        e.preventDefault();
        var strNombre = document.querySelector('#txtDescripcionMotivo').value;

        if (strNombre == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El nombre del motivo es obligatorio.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/Motivos/insert';
        var formData = new FormData(form);
        request.open("POST", ajaxUrl, true);
        request.send(formData);

        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                     fntReloadSelectMotivos();
                    $('#modalMotivos').modal("hide");
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Motivos',
                        text: objData.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#aea322'
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
 document.querySelector('#StatusMotivos').style.display = 'none';
 document.querySelector('#idMotivo').value ="";//Limpiamos el input id **Muy importante
 document.querySelector('#btnText').innerHTML = "Guardar";
 document.querySelector('#titleModalMotivos').innerHTML = "Nuevo Motivo";
 document.querySelector("#formMotivos").reset();//Limpiamos Todos los campos    
$('#modalMotivos').modal('show');

});

function fntReloadSelectMotivos(){

    var ajaxUrl = base_url+'/Motivos/getSelectMotivos';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        document.querySelector('#listMotivoVisita').innerHTML = request.responseText;
        document.querySelector("#listMotivoVisita").selectedIndex = document.querySelector("#listMotivoVisita").length - 1;

        }
    }
}

$(document).on('click', '#btnAddInstitucion', function(){

 // Validations and information manangement of the form
    var form = document.querySelector('#formInstituciones');

    form.onsubmit = function(e){

        e.preventDefault();
        var strNombre = document.querySelector('#txtNombreInstitucion').value;
        var strTelefono = document.querySelector('#txtTelefonoInstitucion').value;
        var strStatus = document.querySelector('#listStatus').value;
        if (strNombre == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El nombre de la institución es obligatoria.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/instituciones/insert';
        var formData = new FormData(form);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                
                    $('#modalInstituciones').modal("hide");
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Instituciones',
                        text: objData.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#aea322'
                    });
                 fntReloadSelectInstituciones();
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

    document.querySelector('#StatusInstituciones').style.display = 'none';
    document.querySelector('#idInstitucion').value ="";//Limpiamos el input id **Muy importante
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModalInstituciones').innerHTML = "Nueva Institución";
    document.querySelector("#formInstituciones").reset();//Limpiamos Todos los campos
    $('#modalInstituciones').modal('show');

});

function fntReloadSelectInstituciones(){

    var ajaxUrl = base_url+'/Instituciones/getSelectInstituciones';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        document.querySelector('#listInstitucion').innerHTML = request.responseText;
        document.querySelector("#listInstitucion").selectedIndex = document.querySelector("#listInstitucion").length - 1;

        }
    }
}

$(document).on('click', '#btnAddEmpleado', function(){
 // Validations and information manangement of the form
    var form = document.querySelector('#formEmpleados');

    form.onsubmit = function(e){

        e.preventDefault();
        var strCodigo = document.querySelector('#txtCodigoEmpleado').value;
        var strNombre = document.querySelector('#txtNombreEmpleado').value;
        var strStatus = document.querySelector('#listStatus').value;
        if (strNombre == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'El nombre del empleado es obligatorio.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

        var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
        var ajaxUrl = base_url+'/empleados/insert';
        var formData = new FormData(form);
        request.open("POST", ajaxUrl, true);
        request.send(formData);
        request.onreadystatechange = function(){
            if (request.readyState == 4 && request.status == 200) {
                var objData = JSON.parse(request.responseText);
                if (objData.status) {
                
                    $('#modalEmpleados').modal("hide");
                    form.reset();
                    Swal.fire({
                        icon: 'success',
                        title: 'Empleados',
                        text: objData.msg,
                        confirmButtonText: 'Ok',
                        confirmButtonColor: '#aea322'
                    });
                 fntReloadSelectEmpleados();
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

 
   
    document.querySelector('#StatusEmpleados').style.display = 'none';
    document.querySelector('#idEmpleado').value ="";//Limpiamos el input id **Muy importante
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModalEmpleados').innerHTML = "Nuevo Empleado";
    document.querySelector("#formEmpleados").reset();//Limpiamos Todos los campos
    $('#modalEmpleados').modal('show');


});

   function fntReloadSelectEmpleados(){

    var ajaxUrl = base_url+'/Empleados/getSelectEmpleados';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        document.querySelector('#listEmpleados').innerHTML = request.responseText;
        document.querySelector("#listEmpleados").selectedIndex = document.querySelector("#listEmpleados").length - 1;

        }
    }
}




$(document).on('click', '#btnCerrarVisita', function(){

 window.location.href = base_url+'/visitas';

});

window.addEventListener('load', function(){
    fntMotivos();
    fntInstituciones();
    fntDepartamentos();
    fntEmpleados();

}, false);

function fntMotivos(){

    var ajaxUrl = base_url+'/Motivos/getSelectMotivos';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
        document.querySelector('#listMotivoVisita').innerHTML = request.responseText;
        document.querySelector('#listMotivoVisita').value = "defecto";
      // $('#listMotivoVisita').selectpicker('render');
       
        }
    }
}

function fntInstituciones(){

    var ajaxUrl = base_url+'/Instituciones/getSelectInstituciones';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listInstitucion').innerHTML = request.responseText;
            //Limpiar el select para que se muestren los registros
            document.querySelector('#listInstitucion').value = "defecto";
           // $('#listInstitucion').selectpicker('render');
        }
    }
}

function fntDepartamentos(){

    var ajaxUrl = base_url+'/Visitas/getSelectDepartamentos';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listDepartamentos').innerHTML = request.responseText;
            //Limpiar el select para que se muestren los registros
             document.querySelector('#listDepartamentos').value = "defecto";
            $('#listDepartamentos').selectpicker('render');
        }
    }
}

function fntEmpleados(){

    var ajaxUrl = base_url+'/Empleados/getSelectEmpleados';
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    request.open("GET",ajaxUrl,true);
    request.send();

    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
            document.querySelector('#listEmpleados').innerHTML = request.responseText;
            //Limpiar el select para que se muestren los registros
           document.querySelector('#listEmpleados').value = "defecto";
           // $('#listEmpleados').selectpicker('render');
        }
    }
}


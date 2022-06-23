<?php
    $sesionU = session();
    require_once('app/Views/instituciones/modalInstituciones.php');
    require_once('app/Views/motivos/modalMotivos.php');
    require_once('app/Views/visitantes/modalVisitantes.php');
   
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
<div id="div_alerts">
    
</div>
<form enctype="multipart/form-data" name="form_nueva_visita" id="form_nueva_visita">
<div class="row">
<div class="col-xl-4 col-md-6 col-sm-6">
<input type="hidden" name="txtNombreEmpleado" id="txtNombreEmpleado">
<input type="hidden" name="txtExtensionEmpleado" id="txtExtensionEmpleado">
<input type="hidden" name="txtDeptoEmpleado" id="txtDeptoEmpleado">
<input type="hidden" name="txtPuestoEmpleado" id="txtPuestoEmpleado">
<input type="hidden" name="txtEmail" id="txtEmail">

 <div class="form-row">
   <div class="form-group col-xl-10 col-md-11">
     <label for="listVisitante">Visitante<span class="text-danger"> *</span></label>
        <select class="form-control selectpicker" id="listVisitante" name="listVisitante" data-style="color-select" data-live-search="true" required>
 <option value="">Seleccione el Visitante</option>
    <?php foreach ($visitantes as $visitante):?>

  <option value="<?php echo $visitante['id_visitante'];?>"><?php echo $visitante['identidad'].'  -  '.$visitante['nombres'].' '.$visitante['apellidos'];?></option>      
        
    <?php endforeach ?>
</select>
    </div>
   
   <div class="form-group col-md-2 col-xl-2 align-self-end">
  <button type="button" id="btnAddVisitante" name="btnAddVisitante" class="btn btn-success btn-block" title="Crear Nuevo Visitante"><i class="fas fa-user-plus"></i></button>
</div>
   
  </div>

<div class="form-group">
<label for="SelectTipoDocumento">Datos Visitante</label>
<textarea id="infoVisitante" name="infoVisitante" class="form-control bg-light" rows="4" cols="4" disabled></textarea> 
</div>
<div class="form-row">
   <div class="form-group col-xl-10 col-md-10 col-10">
     <label for="listMotivos">Motivo Visita<span class="text-danger"> *</span></label>
        <select class="form-control selectpicker" id="listMotivos" name="listMotivos" data-style="color-select" data-live-search="true" required>
 <option value="">Seleccione el Motivo de la Visita</option>
    <?php foreach ($motivos as $motivo):?>

  <option value="<?php echo $motivo['id_motivo'];?>"><?php echo $motivo['descripcion']; ?></option>      
        
    <?php endforeach ?>
</select>
    </div>
   
   <div class="form-group col-md-2 col-xl-2 col-2 align-self-end">
  <button type="button" id="btnAddMotivo" name="btnAddMotivo" class="btn btn-success" title="Crear Nuevo Motivo Visita"><i class="fas fa-plus"></i></button>
</div>
   
  </div>
  <div class="form-row">
   <div class="form-group col-xl-10 col-md-10 col-10">
     <label for="listInstitucion">Empresa / Instituci&oacute;n</label>
        <select class="form-control selectpicker" id="listInstitucion" name="listInstitucion" data-style="color-select" data-live-search="true">
 <option value="">Seleccione Empresa o Instituci&oacute;n</option>
    <?php foreach ($instituciones as $instituc):?>

  <option value="<?php echo $instituc['id_institucion'];?>"><?php echo $instituc['nombre_institucion']; ?></option>      
        
    <?php endforeach ?>
</select>
    </div>
   
  <div class="form-group col-md-2 col-xl-2 col-2 align-self-end">
  <button type="button" id="btnAddInstitucion" name="btnAddInstitucion" class="btn btn-success" title="Crear Nueva Institución"><i class="fas fa-plus"></i></button>
</div>
   
  </div>
<div class="form-row">
<div class="form-group col-md-6">
<label for="txtFecha" class="form-label">Fecha<span class="text-danger"> *</span></label>
    <div class="input-group date" data-target-input="nearest">
<input type="text" class="form-control" id="txtFecha" name="txtFecha" value="<?php echo date("d/m/Y");?>" required>
<div class="input-group-append">
<div class="input-group-text"><i class="fa fa-calendar"></i></div>
</div>
</div>
</div>
  <div class="form-group col-md-6">
<label for="txtHoraEntrada" class="form-label">Hora Entrada<span class="text-danger"> *</span></label>
 <div class="input-group date" data-target-input="nearest">
    <input type="text" class="form-control datetimepicker-input" name="txtHoraEntrada" id="txtHoraEntrada" data-target="#txtHoraEntrada" data-toggle="datetimepicker" 
     value="<?php date_default_timezone_set('America/Santo_Domingo'); echo date("h:i:s A");?>" required>
                    <div class="input-group-append" >
                        <div class="input-group-text"><i class="fas fa-clock"></i></div>
                    </div>
            </div>
</div>
</div>

</div> <!--  col-md4 --> 

<div class="col-xl-4 col-md-6 col-sm-6">

    <div class="form-group">
     <label for="listEmpleados" class="form-label">A Quien Visita<span class="text-danger"> *</span></label>
   <select class="form-control" id="listEmpleados" name="listEmpleados" data-style="color-select" data-live-search="true" required>
    <option value="">Seleccione Persona Va a Visitar</option>
   
</select>
    </div>
  
  <div class="form-group">
<label for="SelectTipoDocumento">Datos A Quien Visita</label>
<textarea id="infoVisitado" name="infoVisitado" class="form-control bg-light" rows="4" cols="4" disabled></textarea> 
</div>


<div class="form-row">
<div class="form-group col-xl-6 col-md-5">
<label for="txtTotalVisitantes" class="form-label">Total Visitantes</label>
<input type="number" class="form-control" id="txtTotalVisitantes" name="txtTotalVisitantes" placeholder="Total de Visitantes">
</div>
<div class="form-group col-xl-6 col-md-5">
<label for="txtNoGafete" class="form-label">N&uacute;mero de Gafete</label>
<input type="number" class="form-control" id="txtNoGafete" name="txtNoGafete" placeholder="Número De Gafete Asignado">
</div>
</div>
<div class="form-group">
<label for="txtEquipos" class="form-label">Equipos / Pertenencias</label>
<textarea id="txtEquipos" name="txtEquipos" class="form-control" rows="4" cols="4" placeholder="Equipos y Pertenencias del Visitante. Ejemplo: Laptop, Tableta."></textarea> 

</div>

</div> <!--  col-md4 --> 

<div class="col-xl-4 col-md-6 col-sm-4 col-4">
<div class="form-group" align="center">
    <label class="form-label">Foto</label>
     <div class="image-upload">
            
               <div class="div_foto">
                <img id="imgFoto" class="imgFotowh" src="<?php echo base_url();?>/dist/img/silueta.png">
                <video id="video" width="320" height="240" class="none"></video>
                <canvas id="canvas" width="320" height="240" class="none"></canvas>
                </div><br>
                <button class="btn btn-app bg-secondary" id="btnAbrirCamara" name="btnAbrirCamara" title="Abrir Cámara Conectada Para Tomar Foto">
                <span class="badge bg-success"></span><i class="fas fa-video"></i> Webcam</button>
                <button class="btn btn-app bg-secondary"  id="btnCargarFotoPC" name="btnCargarFotoPC" title="Cargar Foto Desde La PC"><span class="badge bg-success"></span>
                <i class="fas fa-upload"></i> Cargar Foto</button>
                <button class="btn btn-app bg-danger" id="btnEliminarFoto" name="btnEliminarFoto" title="Eliminar Foto"><span class="badge bg-success"></span>
                <i class="fas fa-trash-alt"></i> Eliminar Foto</button><br>

                <button type="button" class="btn btn-warning none" id="btnTomarFoto" name="btnTomarFoto"><i class="fas fa-camera"></i>&nbsp;&nbsp;Tomar Foto</button>
                 <br>
           <input id="foto_cargada" name="foto_cargada" type="file" accept="image/png,image/jpeg,image/jpg,image/bmp"/>
           </div>

</div>
       
   <input type="hidden" name="txtImagenBase64" id="txtImagenBase64">   
        
</div>


</div> <!--  col-md4 -->     

</div> <!--  row -->
                 <br>

<div class="card-footer">
<button type="button" class="btn color-secundario" id="btnGuardarVisita" name="btnGuardarVisita"><i class="fa fa-fw  fa-check-circle"></i>&nbsp;&nbsp;Guardar</button>&nbsp;&nbsp;&nbsp;
<button type="button" class="btn btn-danger" id="btnCerrarVisita" name="btnCerrarVisita"><i class="fa fa-fw  fa-times-circle"></i>&nbsp;&nbsp;Cerrar</button>
</div>
</form>

<!-------------------------------------------------------------------------->

</div> <!--  card-body -->
</div> <!--  card -->
</div> <!--  content container-fluid -->
</section>
</div> <!--  content-wrapper -->
<script>
    
$(document).ready(function(){

$('#txtFecha').daterangepicker({
    singleDatePicker: true,
    showDropdowns: true,
    minYear: 2020,
    maxYear: 2028,
    autoApply: true,
     locale: {
    format: 'DD/MM/YYYY'} 
});  

$('#txtHoraEntrada').datetimepicker({
     format: 'LT'
 });  

 $.ajax({
        type: 'GET',
        url: 'http://172.16.0.208/api/v1/empleados', 
        headers: { 
            'Accept': 'application/json',
            'Authorization': 'Bearer 1|VZnMyEsFI111jqi9S5o96aseHSPcAUpUTTjpOoa8' 
        },success: function(data) { 
        $.each(data, function(i, item) {
            
        if (item.segundo_nombre === null) { item.segundo_nombre = '';}
        if (item.segundo_apellido === null) { item.segundo_apellido = '';}
        if (item.extension === null) { item.extension = '';}
        if (item.puesto === null) { item.puesto = '';}
        if (item.puesto === null) { item.puesto = '';}
        if (item.email === null) { item.email = '';}

    $("#listEmpleados").append('<option value="' + item.codigo + '" data-value2="'+ item.departamento_id + '" data-value3="'+ item.extension +'" data-value4="'+ item.puesto + '" data-value5="'+ item.email+ '">' + item.primer_nombre + ' ' + item.segundo_nombre + ' ' + item.primer_apellido + ' ' + item.segundo_apellido + '</option>');

             }); // close each()
             $("#listEmpleados").selectpicker('render'); 
        }
    })

  
});  // End Document Ready  

$('#listEmpleados').change(function() {

$("#infoVisitado").empty();

idDepto = $(this).find("option:selected").attr('data-value2');
extension = $(this).find("option:selected").attr('data-value3');
email = $(this).find("option:selected").attr('data-value5');
puesto = $(this).find("option:selected").attr('data-value4');
empleado = $(this).find("option:selected").text();

if (extension === null) { extension2 = '';} else { extension2 = extension;} 

$.ajax({
        type: 'GET',
        url: 'http://172.16.0.208/api/v1/departamentos', 
        headers: { 
            'Accept': 'application/json',
            'Authorization': 'Bearer 1|VZnMyEsFI111jqi9S5o96aseHSPcAUpUTTjpOoa8' 
        },success: function(data) { 

            result = data.filter(item => item.id == idDepto);
            var departamento = result[0]['nombre']; 

       $("#infoVisitado").append('Departamento:  ', departamento+'\n');
       $("#infoVisitado").append('Puesto:  ', puesto+'\n');
       $("#infoVisitado").append('Email:  ', email+'\n');
       $("#infoVisitado").append('Extensión:  ', extension);

         $("#txtNombreEmpleado").val(empleado); 
         $("#txtExtensionEmpleado").val(extension); 
         $("#txtDeptoEmpleado").val(departamento); 
         $("#txtPuestoEmpleado").val(puesto); 
         $("#txtEmail").val(email); 
             
        }
    })  

}); 


    $("#foto_cargada").change(function () {
    
        if (this.files && this.files[0]) {

            var filePath = this.value;
            var allowedExtensions = /(.jpg|.jpeg|.png|.gif)$/i;
            if(!allowedExtensions.exec(filePath)){
               
                Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: 'Formato de Imagen no permitido. Utiliza: .jpeg/.jpg/.png/.gif.',
                showConfirmButton: true});
                this.value = '';
                return false;
            }else{
                var reader = new FileReader();

            reader.onload = function (e) {
                $('#imgFoto').attr('src', e.target.result);
                $('#txtImagenBase64').val(e.target.result); 
            }
           reader.readAsDataURL(this.files[0]);
            }    

        }    
        });

$(document).on('click', '#btnCargarFotoPC', (function(e) {
    e.preventDefault();

    //Deshabilito todas las funciones de AbrirCamara
    $("#video").addClass("none");
    $("#btnTomarFoto").addClass("none");
    if ( video != null) { apagarCam(); }
  
   //Habilito todas las funciones para cargar foto desde la pc.
    $("#imgFoto").removeClass("none");
    $('#foto_cargada').click();
}));

$(document).on('click', '#btnAbrirCamara', (function(e) {
    e.preventDefault();
   
    //Deshabilito todas las funciones de CargarFotoPC
     $("#imgFoto").addClass("none");
     $('#txtImagenBase64').val('');
     $('#imgFoto').attr('src', "<?php echo base_url();?>/dist/img/silueta.png"); 
    
        //Habilito todas las funciones de AbrirCamara 
    $("#video").removeClass("none");
    encenderCam();
    $("#btnTomarFoto").removeClass("none");
}));


$(document).on('click', '#btnTomarFoto', function() {  

var video = document.getElementById('video');
var canvas = document.getElementById('canvas');
canvas.getContext('2d').drawImage(video, 0, 0, canvas.width, canvas.height);
var data = canvas.toDataURL('image/jpeg');
$('#txtImagenBase64').val(data);
$('#imgFoto').attr('src', data);
$("#imgFoto").removeClass("none");
$("#video").addClass("none");
$("#btnTomarFoto").addClass("none"); 
});      


$(document).on('click', '#btnEliminarFoto', (function(e) {
    e.preventDefault();
    $("#imgFoto").removeClass("none");
    $("#video").addClass("none");
    $("#btnTomarFoto").addClass("none"); 
    $('#imgFoto').attr('src', "<?php echo base_url();?>/dist/img/silueta.png");
    $('#txtImagenBase64').val('');
}));


var video;

function encenderCam() {
  video = document.getElementById("video");

    if(!navigator.getUserMedia)
        navigator.getUserMedia = navigator.webkitGetUserMedia || navigator.mozGetUserMedia || 
    navigator.msGetUserMedia;
    if(!window.URL)
        window.URL = window.webkitURL;

    if (navigator.getUserMedia) {
        navigator.getUserMedia({"video" : true, "audio": false
        }, function(stream) {
            try {
                localstream = stream;
                video.srcObject = stream;
                video.play();
            } catch (error) {
                video.srcObject = null;
            }
        }, function(err){
            $("#btnTomarFoto").addClass("none");
            $("#video").addClass("none");
            Swal.fire("Error", "No hay cámaras conectadas en el equipo. Conecte una cámara.", "error");
          

        });
    } else {
        Swal.fire("Mensaje", "User Media No Disponible" , "error");
        return;
    }
}

function apagarCam() {
    video.pause();
    video.srcObject = null;
    //localstream.getTracks()[0].stop();
}


$(document).on('click', '#btnGuardarVisita', function() {  

$('#div_alerts').empty();    

if($('#listVisitante').val() == "") {

$('#div_alerts').append('<div class="alert color-alerta-errores alert-dismissible fade show col-md-6" role="alert">El <strong>Visitante</strong> no puede estar vacío.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
$('#listVisitante').focus();
return false;
}

else if($('#listMotivos').val() == "") {

$('#div_alerts').append('<div class="alert color-alerta-errores alert-dismissible fade show col-md-6" role="alert">El <strong>Motivo de la visita</strong> no puede estar vacío.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
$('#listMotivos').focus();
return false;
}    

else if($('#listEmpleados').val() == "") {

$('#div_alerts').append('<div class="alert color-alerta-errores alert-dismissible fade show col-md-6" role="alert"><strong>A Quien Visita</strong> no puede estar vacío.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
$('#listEmpleados').focus();
return false;
}    

else if($('#txtHoraEntrada').val() == "") {

$('#div_alerts').append('<div class="alert color-alerta-errores alert-dismissible fade show col-md-6" role="alert">La <strong>Hora de Entrada</strong> no puede estar vacío.<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
$('#txtHoraEntrada').focus();
return false;
}

else {

 var formData = new FormData();   

 formData.append('id_visitante', $('#listVisitante').val());
 formData.append('motivo_visita', $('#listMotivos').val());
 formData.append('institucion', $('#listInstitucion').val());
 formData.append('empleado_codigo', $('#listEmpleados').val());
 formData.append('fecha', $('#txtFecha').val());
 formData.append('hora', $('#txtHoraEntrada').val());
 formData.append('total_visitantes', $('#txtTotalVisitantes').val());
 formData.append('no_gafete', $('#txtNoGafete').val());
 formData.append('equipos',  $('#txtEquipos').val());
 formData.append('foto', $('#txtImagenBase64').val());
 formData.append('nombre_empleado', $('#txtNombreEmpleado').val());
 formData.append('puesto', $('#txtPuestoEmpleado').val());
 formData.append('email', $('#txtEmail').val());
 formData.append('extension', $('#txtExtensionEmpleado').val());
 formData.append('departamento', $('#txtDeptoEmpleado').val());

      $.ajax({
        url: "<?php echo base_url();?>/visitas/insert",
        data: formData,
        enctype: 'multipart/form-data',
        type: 'POST',
        contentType: false,
        processData: false,
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Guardado!',
   text: datos.msg,
   showConfirmButton: true,
   footer: '<a href="<?php echo base_url();?>/visitas/printGafete/'+datos.id_visita+'" target="_blank">Imprimir Gafete</a>'
}).then(function () {
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
   

 } //End Else

}); // End Function

   

  $(document).on('click', '#btnAddInstitucion', function() {  

  $('#txtNombreInstitucion').val('');
  $('#txtTelefono').val('');
  $('#divEstado').hide(); 
  document.querySelector('#btnTextVisitante').innerHTML = "Guardar";
  document.querySelector('#tituloModal').innerHTML = "Agregar Nueva Institución";
  $('#modalInstituciones').modal('show');

  }); 


$(document).on('click', '#btnAddMotivo', function() {  

 $('#txtDescripcionMotivo').val('');
  $('#divEstadoMotivo').hide(); 
  document.querySelector('#btnText').innerHTML = "Guardar";
  document.querySelector('#titleModalMotivos').innerHTML = "Agregar Nuevo Motivo";
  $('#modalMotivos').modal('show');

  });

 function GuardarMotivo() {

       var strDescripcion = document.querySelector('#txtDescripcionMotivo').value;
     
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
$('#listMotivos').append('<option value="'+ datos.ultimo_id+'"selected="selected">'+strDescripcion+'</option>');
$('#listMotivos').selectpicker('refresh');
$('#listMotivos').selectpicker('val', [datos.ultimo_id]); 
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

 function GuardarInstitucion() {

        var strNombre = document.querySelector('#txtNombreInstitucion').value;
        var strTelefono = document.querySelector('#txtTelefono').value;
      
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
$('#listInstitucion').append('<option value="'+ datos.ultima_institucion+'"selected="selected">'+strNombre+'</option>');
$('#listInstitucion').selectpicker('refresh');
$('#listInstitucion').selectpicker('val', [datos.ultima_institucion]); 
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

  $(document).on('click', '#btnAddVisitante', function() {  

  $('#listTipoDocumentoVisitante').val('Cedula');
  $('#txtDocumentoVisitante').val('');
  $('#txtNombresVisitante').val('');
  $('#txtApellidosVisitante').val('');
  $('#txtTelefonoVisitante').val('');
  $('#divEstadoVisitante').hide(); 
  document.querySelector('#btnTextVisitante').innerHTML = "Guardar";
  document.querySelector('#tituloModalVisitante').innerHTML = "Agregar Nuevo Visitante";
  $('#modalVisitantes').modal('show');

  });  

 function GuardarVisitante() {

   var strTipoDocumento = document.querySelector('#listTipoDocumentoVisitante').value;   
   var strDocumento = document.querySelector('#txtDocumentoVisitante').value; 
   var strNombres = document.querySelector('#txtNombresVisitante').value;
   var strApellidos = document.querySelector('#txtApellidosVisitante').value;
   var strTelefono = document.querySelector('#txtTelefonoVisitante').value;    
                 
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
url: "<?php echo base_url();?>/visitantes/insert",
data: { tipo_documento: strTipoDocumento, documento: strDocumento, nombres : strNombres, apellidos: strApellidos, telefono: strTelefono },
        success: function(data) {
      let datos = JSON.parse(data);
      if (datos.status === true) {
   Swal.fire({
   icon: 'success',
   title: 'Guardado!',
   text: datos.msg,
   showConfirmButton: true,
}).then(function () {
       $("#infoVisitante").empty(); 
       $("#infoVisitante").append('Nombres:  ', strNombres+'\n');
       $("#infoVisitante").append('Apellidos:  ',strApellidos+'\n');
       $("#infoVisitante").append(strTipoDocumento+':  '+strDocumento+'\n');
       $("#infoVisitante").append('Teléfono:  ', strTelefono);

$('#modalVisitantes').modal('hide');
$('#listVisitante').append('<option value="'+ datos.id_ultimo_visitante+'"selected="selected">'+strDocumento+' - '+strNombres+' '+strApellidos+'</option>');
$('#listVisitante').selectpicker('refresh');
$('#listVisitante').selectpicker('val', [datos.id_ultimo_visitante]); 
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

$('#listVisitante').change(function() {

$("#infoVisitante").empty();

idVisitante = $(this).find("option:selected").val();

$.ajax({
       type: "POST",
       url: "<?php echo base_url();?>/visitantes/GetVisitanteByID",
       data: { id_visitante: idVisitante },
       success: function(data) { 
       let datos = JSON.parse(data);
       $("#infoVisitante").append('Nombres:  ', datos.nombres+'\n');
       $("#infoVisitante").append('Apellidos:  ',datos.apellidos+'\n');
       $("#infoVisitante").append(datos.tipo_identidad+':  '+datos.identidad+'\n');
       $("#infoVisitante").append('Teléfono:  ', datos.telefono);
       
       }
    })  

}); 

$(document).on('click', '#btnCerrarVisita', function() {  

window.location.href = "<?php echo base_url();?>/visitas";


  });


</script>
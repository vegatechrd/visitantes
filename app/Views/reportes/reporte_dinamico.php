<?php
    $sesionU = session();
 ?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="content container-fluid">
            <div class="container-fluid">
                <div class="row">
                    <div class="d-flex col-sm-6">
                      
                        <h1 class="m-0 text-dark text-bold"><i class="fa-solid fa-file-lines"></i> <?= $titulo; ?></h1>
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
              <div class="card-header">
                <h3 class="card-title">Filtros</h3>
              </div>
              <div class="card-body">
                  <div class="row">
                        <div class="form-group col-sm-2">
                            <label>Desde</label>
                            <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm" id="txtFechaDesde" name="txtFechaDesde" value="<?php echo date("01/m/Y");?>">
                            <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                        </div>
               
                        <div class="form-group col-sm-2">
                            <label>Hasta</label>
                            <div class="input-group date" data-target-input="nearest">
                            <input type="text" class="form-control form-control-sm" id="txtFechaHasta" name="txtFechaHasta" value="<?php echo date("d/m/Y");?>">
                            <div class="input-group-append">
                            <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                            </div>
                            </div>
                        </div>

                        <div class="form-group col-sm-3">
                            <label>Visitante</label>
                            <select class="form-control form-control-sm selectpicker" id="listVisitante" name="listVisitante" data-style="color-select" data-live-search="true">
                            <option value="TODOS">TODOS</option>
                            <?php foreach ($visitantes as $visitante):?>

                            <option value="<?php echo $visitante['id_visitante'];?>"><?php echo $visitante['nombres'].' '.$visitante['apellidos'];?></option> 
                            <?php endforeach ?>
                            </select>
                        </div>

                        <div class="form-group col-sm-3">
                            <label>Departamento</label>
                            <select class="form-control form-control-sm selectpicker" id="listDepartamento" name="listDepartamento" data-style="color-select" data-live-search="true">
                            <option value="TODOS">TODOS</option>
                            <?php foreach ($departamentos_visitados as $departamento):?>
                            <option value="<?php echo $departamento['departamento'];?>"><?php echo $departamento['departamento'];?></option> 
                            <?php endforeach ?>
                            </select>
                        </div>
                        <div class="form-group col-sm-1 align-self-end">
                            <button class="btn btn-outline-success btn-block btn-sm" id="btnFiltrarReporte" name="btnFiltrarReporte">
                            <i class="fa-solid fa-magnifying-glass"></i> &nbsp;&nbsp;Buscar</button>
                        </div>
                        <div class="form-group col-sm-1 align-self-end">
                            <button class="btn btn-outline-primary btn-sm" id="btnLimpiarCampos" name="btnLimpiarCampos"><i class="fas fa-sync"></i></button>
                        </div>        
                    </div> <!-- row -->

                    <div class="row">  
                      <div class="form-group col-sm-3"> 
                          <label>Persona Visitada</label>
                          <select class="form-control form-control-sm" id="listEmpleados" name="listEmpleados" data-style="color-select" data-live-search="true">
                          <option value="TODOS">TODOS</option>
                          </select>
                        </div>   
                        <div class="form-group col-sm-3">        
                            <label>Motivo</label>
                            <select class="form-control form-control-sm selectpicker" id="listMotivos" name="listMotivos" data-style="color-select" 
                            data-live-search="true">
                            <option value="TODOS">TODOS</option>
                            <?php foreach ($motivos as $motivo):?>
                            <option value="<?php echo $motivo['id_motivo'];?>"><?php echo $motivo['descripcion'];?></option> 
                            <?php endforeach ?>
                            </select>             
                        </div>  
                        <div class="form-group col-sm-2">
                            <label class="form-label">Ordenar por</label>
                            <select class="form-control form-control-sm selectpicker" id="listOrdenarPor" name="listOrdenarPor" data-style="color-select">
                            <option value="v.fecha">Fecha</option>
                            <option value="vt.nombres">Visitante</option>
                            <option value="ev.nombre">Persona Visitada</option>
                            <option value="ev.departamento">Departamento</option>
                            <option value="m.descripcion">Motivo</option>
                            </select>     
                        </div>
                        <div class="form-group col-sm-2">  
                            <label class="form-label">Orden</label>
                            <select class="form-control form-control-sm selectpicker" id="listAscDesc" name="listAscDesc" data-style="color-select">
                            <option value="ASC">Ascendente</option>
                            <option value="DESC" selected>Descendente</option>
                            </select>   
                        </div> 
                                   
                    </div> <!-- row -->  
                                
                                <div id="div_alerts"></div>

           <br>
                  <div class="row" id="div_botones">
                  <div class="form-group col-sm-1 align-self-end">
                            <button class="btn btn-outline-success btn-block btn-sm" id="btnImprimirPDF" name="btnImprimirPDF">
                            <i class="fa-solid fa-file-pdf"></i> &nbsp;&nbsp;Generar PDF</button>
                        </div>
                       
                        </div>            
                    <div class="row"> 
                      
                            <table id="tabla_resultados" name="tabla_resultados" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                <th>Fecha</th>
                                <th>Visitante</th>
                                <th>Identidad</th>
                                <th>Persona Visitada</th>
                                <th>Departamento</th>
                                <th>Motivo</th>
                                <th>Entrada</th>
                                <th>Salida</th>
                                <th>Status</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($datos as $dato): ?>  
                                <tr>
                                <td><?php echo $dato['fecha'];?></td>
                                <td><?php echo $dato['nombres'].' '.$dato['apellidos'];?></td>
                                <td><?php echo $dato['identidad'];?></td>
                                <td><?php echo $dato['empleado'];?></td>
                                <td><?php echo $dato['departamento'];?></td>
                                <td><?php echo $dato['motivo_visita'];?></td>
                                <td><?php echo $dato['hora_entrada'];?></td>
                                <td><?php if($dato['hora_salida'] != null) {echo $dato['hora_salida'];}?></td>
                                <td>
                                    <?php if($dato['status']== 1) { ?>
                                        <span class="badge bg-success">Activa</span>
                                        <?php } else {
                                    ?><span class="badge bg-warning">Concluida</span>    
                                    <?php 
                                    };?>
                                    </td>  
                                </tr>
                                <?php endforeach ?>
                                </tbody>
                                </table> 
                               
                    </div> <!-- row -->  
                </div>               
        </div>     
    </section>

</div> <!-- wrapper -->
<script>
$(document).ready(function(){

$('#txtFechaDesde').daterangepicker({
singleDatePicker: true,
showDropdowns: true,
minYear: 2020,
maxYear: 2028,
autoApply: true,
locale: {
format: 'DD/MM/YYYY'} 
}); 


$('#txtFechaHasta').daterangepicker({
singleDatePicker: true,
showDropdowns: true,
minYear: 2020,
maxYear: 2028,
autoApply: true,
locale: {
format: 'DD/MM/YYYY'} 
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

$("#listEmpleados").append('<option value="' + item.codigo + '">' + item.primer_nombre + ' ' + item.segundo_nombre + ' ' + item.primer_apellido + ' ' + item.segundo_apellido + '</option>');

}); // close each()
$("#listEmpleados").selectpicker('render'); 
}
})

}); // End Document Ready 



$(document).on('click', '#btnLimpiarCampos', function() {  

window.location.href = "<?php echo base_url();?>/visitas/reportes";

}); 

$(document).on('click', '#btnFiltrarReporte', function() { 
    $('#div_alerts').empty();
    var fecha_desde = document.querySelector('#txtFechaDesde').value;  
    var fecha_hasta = document.querySelector('#txtFechaHasta').value;  
    var visitante = document.querySelector('#listVisitante').value; 
    var departamento = document.querySelector('#listDepartamento').value;
    var empleado = document.querySelector('#listEmpleados').value;
    var motivos = document.querySelector('#listMotivos').value; 
    var ordenar_por = document.querySelector('#listOrdenarPor').value;
    var asc_desc = document.querySelector('#listAscDesc').value;    
                 
        if (fecha_desde == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La Fecha Desde es obligatoria.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

         if (fecha_hasta == '') {
            
            Swal.fire({
                icon: 'error',
                title: 'Error',
                text: 'La Fecha Hasta es obligatoria.',
                confirmButtonText: 'Ok',
                confirmButtonColor: '#aea322'
            });
            
            return false;
        }

$.ajax({
type: "POST",
url: "<?php echo base_url();?>/visitas/consulta_dinamica_visitas",
data: { fecha_desde: fecha_desde, fecha_hasta: fecha_hasta, visitante: visitante, departamento: departamento, empleado: empleado, 
        motivos: motivos, ordenar_por: ordenar_por, asc_desc: asc_desc },
       success: function(data) {
       let datos = JSON.parse(data);
       if (datos != 0) {
       $('#tabla_resultados tbody tr').empty();
        var htmlRows = '';
        $.each(datos, function(){
        htmlRows += '<tr>';
        htmlRows += '<td>'+this.fecha+'</td>';
        htmlRows += '<td>'+this.nombres+' '+this.apellidos+'</td>';
        htmlRows +='<td>'+this.identidad+'</td>';
        htmlRows +='<td>'+this.empleado+'</td>';
        htmlRows +='<td>'+this.departamento+'</td>';
        htmlRows +='<td>'+this.motivo_visita+'</td>';
        htmlRows +='<td>'+this.hora_entrada+'</td>';
        var estado_hora_salida;
        if (this.hora_salida === null) { estado_hora_salida = '';} else { estado_hora_salida = this.hora_salida;} 
        htmlRows +='<td>'+estado_hora_salida+'</td>';
        if (this.status == 1) {
        htmlRows +='<td><span class="badge bg-success">Activa</span></td>';} else {
        htmlRows +='<td><span class="badge bg-warning">Concluida</span></td>';     
        }
        htmlRows += '</tr>';
        });   
        $('#tabla_resultados').append(htmlRows);
    
        }

        else {
            $('#tabla_resultados tbody tr').empty();
            $('#div_alerts').append('<div class="alert color-alerta-errores alert-dismissible fade show col-md-6" role="alert"><strong>No existen datos que mostrar para esta consulta.</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>');
            
            }
          
        } //Success Function Data

      }); //Ajax 


}); 

$(document).on('click', '#btnImprimirPDF', function() { 

var cntFilasTabla = $('#tabla_resultados').find('td').length;

if (cntFilasTabla > 0) {
    


fecha_desde = $('#txtFechaDesde').val();
fecha_hasta = $('#txtFechaHasta').val();

 var pdf = new jsPDF('l');
 pdf.setProperties({
 title: "Reporte General de Visitas"
});
 pdf.addImage(logo_pdf_base64, 'JPEG', 10, 5, 40, 25); //addImage(image, format, x-coordinate, y-coordinate, width, height)
 pdf.setFontSize(16);
 pdf.setFont("helvetica", "bold");
 pdf.text(100, 13, 'INSTITUTO DE ESTABILIZACIÓN DE PRECIOS');
 pdf.setFontSize(14);
 pdf.text(130, 19, 'DIRECCIÓN EJECUTIVA');
 pdf.setFontSize(13);
 pdf.text(110, 25, 'Reporte Visitas De '+fecha_desde+' A '+fecha_hasta);
 pdf.setLineWidth(0.7);
 pdf.setDrawColor(13, 90, 46);
 pdf.line(10, 32, 287, 32); 
 pdf.setLineWidth(0.7);
 pdf.setDrawColor(218,206,67);
 pdf.line(10, 34, 287, 34);
 pdf.autoTable({ html:'#tabla_resultados', 
    theme: 'striped', 
    startY: 39,  
    margin: { left: 10, right:10, },
    headStyles: {
      fillColor: [22, 91, 48],
      fontSize: 10,
      valign: 'middle', 
    },
    bodyStyles: {
      fontSize: 9,
      },
});
 //pdf.autoTable({ html:'#tabla_resultados'});
 pdf.save('Reporte_Visitas');
}
else {

    Swal.fire("Error", "No existen datos para generar el PDF." , "error");

}
}); 
</script>
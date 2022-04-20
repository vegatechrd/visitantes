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
                            <button class="btn btn-outline-info btn-block btn-sm" id="btnImprimirPDF" name="btnImprimirPDF">
                            <i class="fa-solid fa-file-pdf"></i> &nbsp;&nbsp;Generar PDF</button>
                        </div>
                        <div class="form-group col-sm-1 align-self-end">
                            <button class="btn btn-outline-info btn-block btn-sm" id="btnImprimirXLS" name="btnImprimirXLS">
                            <i class="fa-solid fa-file-excel"></i> &nbsp;&nbsp;Generar XLS</button>
                        </div> 
                        </div>            
                    <div class="row">  
                            <table id="tabla_resultados" class="table table-striped table-sm">
                                <thead>
                                    <tr>
                                <th>Fecha</th>
                                <th>Visitante</th>
                                <th>Identidad</th>
                                <th>Persona Visitada</th>
                                <th>Departamento</th>
                                <th>Motivo Visita</th>
                                <th>Hora Entrada</th>
                                <th>Hora Salida</th>
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

//   $('#txtFechaDesde').val("<?php echo date("01/m/Y");?>");
//   $('#txtFechaHasta').val("<?php echo date("d/m/Y");?>");
//   $('#listVisitante').val('TODOS');
//   $("#listVisitante").selectpicker('render'); 
//   $('#listDepartamento').val('TODOS'); 
//   $("#listDepartamento").selectpicker('render');    
//   $('#listEmpleados').val('TODOS');
//   $("#listEmpleados").selectpicker('render'); 
//   $('#listMotivos').val('TODOS'); 
//   $("#listMotivos").selectpicker('render'); 
//   $('#listOrdenarPor').val('v.fecha'); 
//   $("#listOrdenarPor").selectpicker('render'); 
//   $('#listAscDesc').val('DESC');    
//   $("#listAscDesc").selectpicker('render');
  
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

 var arreglo_visitas = [];
 var fechas = [];

fecha_desde = 
fecha_hasta = 

var arrFechas = { fecha_desde, fecha_hasta};
fechas.push(arrFechas);
 $('#tabla_resultados tbody tr').each(function() {

 fecha = $(this).find('td').eq(5).find('input').val();   
 visitante = $(this).find('td').eq(4).find('select').val();
 identidad = $(this).find('td').eq(7).find('select').val();
 empleado = $(this).find('td').eq(6).find('input').val();
 departamento = $(this).find('td').eq(1).find('input').val();
 motivo = $(this).find('td').eq(8).find('input').val();
 hora_entrada = $(this).find('td').eq(9).find('select').val();
 hora_salida = $(this).find('td').eq(9).find('select').val();
 status  = $(this).find('td').eq(9).find('select').val();

var fila = { fecha, visitante, identidad, empleado, departamento, motivo, hora_entrada, hora_salida, status };
arreglo_visitas.push(fila);
});
$.ajax({
   type: "POST",
   url: "<?php echo base_url();?>/entradas/guardar_entrada_productos",
   data: {productos: JSON.stringify(arreglo_producto)},
 success: function(data) {
  
  Swal.fire({
  icon: 'success',
  title: 'Abastecidos!',
  text: 'Sus productos fueron abastecidos satisfactoriamente!',
  showConfirmButton: false,
  timer: 1500
}).then(function () {
window.location.href = "<?php echo base_url();?>/entradas/historial_entrada_productos";
});

    } 
  }); 

}); 
</script>
$(document).ready(function(){

var tablaNombreControlador = "#tabla_"+controlador;
var DataTableAc;
var permisosc = permisosC;
var permisosu = permisosU;
var permisosd = permisosD;
var ocultarColumna = -1; 

    if (permisosu === 'N' && permisosd === 'N') {
        
        var propiedad = false;
    }else{
        var propiedad = true;
    }
    
    DataTableAc = $(tablaNombreControlador).dataTable({
        "language": {
            "infoEmpty": "Mostrando del 0 al 0 de un total de 0 registros",
            "info": "Mostrando del _START_ al _END_ de _TOTAL_ registros", 
            "infoFiltered": "",
            "processing": "Cargando",
            "loadingRecords": "Cargando datos ...",
            "emptyTable": "No hay datos registrados para mostrar en la tabla.",
            "paginate": {
                "first":      "Primero",
                "last":       "Último",
                "next":       "Siguiente",
                "previous":   "Anterior"
            }
        },
        //"processing":true,
        //"bServerSide":true,
        "responsive": true,
        "paging": true,
        "ajax":{
            "url": " "+base_url+"/"+controlador+"/getHistoricos",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_visita"},
            {"data":"nombre"},
            {"data":"fecha"},
            {"data":"hora_entrada"},
            {"data":"hora_salida"},
            {"data":"identidad"},
            {"data":"no_gafete"},
            {"data":"status"},
            {"data":"options"}
        ],
        "columnDefs": [
            {
                "targets": [ ocultarColumna ],
                "visible": propiedad,
                "searchable": false
            }
        ]
    });
    var oTable = $(tablaNombreControlador).DataTable();
    
    $("#txtBuscar").keyup(function() {
        $(tablaNombreControlador).dataTable().fnFilter(this.value);
    }); 
    
    $('#selectEntries').val(oTable.page.len());
    $('#selectEntries').change( function() { 
        oTable.page.len($(this).val() ).draw();
    });

    jQuery(".dataTables_info").appendTo(jQuery("#numbers_numbers"));
    jQuery(".dataTables_paginate").appendTo(jQuery("#pagination_pagination"));
});

function fntEdit(id_visita){
window.location.href = base_url+"/Visitas/edit/"+id_visita;
   
}
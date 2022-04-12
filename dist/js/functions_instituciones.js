var modalNombreControlador = "#"+controlador;
var tablaNombreControlador = "#tabla_"+controlador;
var DataTableAc;
var permisosc = permisosC;
var permisosu = permisosU;
var permisosd = permisosD;
var ocultarColumna = -1; 

$(document).ready(function(){

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
            "url": " "+base_url+"/"+controlador+"/getRecordSet",
            "dataSrc":""
        },
        "columns":[
            {"data":"id_institucion"},
            {"data":"nombre_institucion"},
            {"data":"telefono_institucion"},
            {"data":"status_institucion"},
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
                    DataTableAc.api().ajax.reload();
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

function fntEdit(id_institucion){
    
    //Apariencia del modal
    document.querySelector('#StatusInstituciones').style.display = 'contents';
    document.querySelector('#titleModalInstituciones').innerHTML = "Actualizar Institución";
    document.querySelector('#btnActionForm').classList.replace("btn-primary","btn-info");
    document.querySelector('#btnText').innerHTML = "Actualizar";

    var id = id_institucion;
    var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
    var ajaxUrl = base_url+'/instituciones/edit/'+id;
    request.open("GET",ajaxUrl,true);
    request.send();
    request.onreadystatechange = function(){
        if (request.readyState == 4 && request.status == 200) {
    
            var objData = JSON.parse(request.responseText);
            if (objData.status) {
                
                //Si el status es verdadero entonces se van a colocar los datos en el fomrulario
                document.querySelector("#idInstitucion").value = objData.data.id_institucion;
                document.querySelector("#txtNombreInstitucion").value = objData.data.nombre_institucion;
                document.querySelector("#txtTelefonoInstitucion").value = objData.data.telefono_institucion;
                document.querySelector("#listStatus").value = objData.data.status_institucion;
                 
               $('#listStatus').selectpicker('render');
            }
        }
        $('#modalInstituciones').modal('show');
    }
}

function fntDelete(id_institucion){
   
    var id = id_institucion;

    //Configuracion de la alerta
    Swal.fire({
        icon: 'warning',
        title: "Eliminar Institución",
        text: "¿Realmente quieres eliminar esta Institución?",
        showCancelButton: true,
        confirmButtonText: "Si, eliminar",
        confirmButtonColor: '#aea322',
        cancelButtonColor: '#165b30',
        cancelButtonText: "No, cancelar",
       

    }).then((result) => {
        //Script para eliminar un rol
        if (result.isConfirmed) {
            
            var request = (window.XMLHttpRequest) ? new XMLHttpRequest() : new ActiveXObject('Microsoft.XMLHTTP');
            var ajaxUrl = base_url+'/instituciones/delete';
            var strData = "idRegistro="+id;
            request.open("POST",ajaxUrl,true);
            request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");//Forma en la que se enviaran los datos
            request.send(strData);
            request.onreadystatechange = function(){
                if (request.readyState == 4 && request.status == 200) 
                {
                    var objData = JSON.parse(request.responseText);
                    if (objData.status) 
                    {
                        Swal.fire({
                            icon: 'success',
                            title: 'Instituciones',
                            text: objData.msg,
                            confirmButtonText: 'Ok',
                            confirmButtonColor: '#aea322'
                        });
                        DataTableAc.api().ajax.reload();
                    }
                    else
                    {
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
}

function openModal(){
    
    document.querySelector('#StatusInstituciones').style.display = 'none';
    document.querySelector('#idInstitucion').value ="";//Limpiamos el input id **Muy importante
    document.querySelector('#btnText').innerHTML = "Guardar";
    document.querySelector('#titleModalInstituciones').innerHTML = "Nueva Institución";
    document.querySelector("#formInstituciones").reset();//Limpiamos Todos los campos

    $('#listStatus').selectpicker('render');

    $('#modalInstituciones').modal('show');
}
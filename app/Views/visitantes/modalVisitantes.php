<!-- Modal -->
<div class="modal fade" id="modalVisitantes" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content modal-style">
            <div class="modal-header header-modal">
                <h5 class="modal-title font-weight-bold" id="tituloModalVisitante"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formVisitantes" name="formVisitantes" class="form-horizontal">

                    <input type="hidden" id="idVisitante" name="idVisitante" value="" class="limpiar">
                     <div class="form-group">
                        <label for="listTipoDocumentoVisitante">Tipo Documento<span class="text-danger">*</span></label>
                        <select class="form-control selectpicker limpiar" id="listTipoDocumentoVisitante" name="listTipoDocumentoVisitante" data-style="color-select" required>
                            <option value="Cedula">Cédula</option>
                            <option value="Pasaporte">Pasaporte</option>
                            <option value="Licencia">Licencia</option>
                            </select>
                    </div>
                    <div class="form-group">
                        <label class="control-label">N&uacute;mero De Documento<span class="text-danger">*</span></label>
                        <input class="form-control limpiar" id="txtDocumentoVisitante" name="txtDocumentoVisitante" type="text" required placeholder="Número De Documento Del Visitante">
                    </div>
                    <div class="form-group">
                    <label for="txtNombresVisitante">Nombres<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control limpiar" id="txtNombresVisitante" name="txtNombresVisitante" required placeholder="Nombres Del Visitante">
                    </div>

                    <div class="form-group">
                    <label for="txtApellidosVisitante">Apellidos<span class="text-danger"> *</span></label>
                    <input type="text" class="form-control limpiar" id="txtApellidosVisitante" name="txtApellidosVisitante" required placeholder="Apellidos Del Visitante">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tel&eacute;fono</label>
                        <input class="form-control limpiar" id="txtTelefonoVisitante" name="txtTelefonoVisitante" type="text" placeholder="Teléfono del Visitante">
                    </div>
                    <div id="divEstadoVisitante">
                        <div class="form-group">
                        <label for="listStatus">Estado <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker limpiar" id="listStatus" name="listStatus" data-style="color-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardarVisitante" class="btn color-secundario" onclick="GuardarVisitante()">
                <i class="fa fa-fw  fa-check-circle">&nbsp;</i><span id="btnTextVisitante">Guardar</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw  fa-times-circle"> </i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

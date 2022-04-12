<!-- Modal -->
<div class="modal fade" id="modalMotivos" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content modal-style">
            <div class="modal-header header-modal">
                <h5 class="modal-title font-weight-bold" id="titleModalMotivos"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formMotivos" name="formMotivos" class="form-horizontal">
                    <input type="hidden" id="idMotivo" name="idMotivo" value="">
                   
                    <div class="form-group">
                        <label class="control-label">Descripci&oacute;n Motivo<span class="text-danger">*</span></label>
                        <input class="form-control" id="txtDescripcionMotivo" name="txtDescripcionMotivo" type="text" placeholder="Descripci&oacute;n Motivo" required="">
                    </div>
                   
                     <div class="form-group" id="divEstadoMotivo">
                        <label for="listStatus">Estado <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker" id="listStatus" name="listStatus" data-style="color-select">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                   
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardarMotivo" name="btnGuardarMotivo" class="btn color-secundario" onclick="GuardarMotivo()">
                    <i class="fa fa-fw  fa-check-circle">&nbsp;</i><span id="btnText">Guardar</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw  fa-times-circle"> </i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

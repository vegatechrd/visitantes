<!-- Modal -->
<div class="modal fade" id="modalInstituciones" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered ">
        <div class="modal-content modal-style">
            <div class="modal-header header-modal">
                <h5 class="modal-title font-weight-bold" id="tituloModal"></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <form id="formInstituciones" name="formInstituciones" class="form-horizontal">

                    <input type="hidden" id="idInstitucion" name="idInstitucion" value="" class="limpiar">
                    <div class="form-group">
                        <label class="control-label">Nombre Instituci&oacute;n <span class="text-danger">*</span></label>
                        <input class="form-control limpiar" id="txtNombreInstitucion" name="txtNombreInstitucion" type="text" placeholder="Nombre de la Institución">
                    </div>
                    <div class="form-group">
                        <label class="control-label">Tel&eacute;fono<span class="text-danger">*</span></label>
                        <input class="form-control limpiar" id="txtTelefono" name="txtTelefono" type="text" placeholder="Teléfono de la Institución">
                    </div>
                    <div id="divEstado">
                        <div class="form-group">
                        <label for="listStatus">Estado <span class="text-danger">*</span></label>
                        <select class="form-control selectpicker limpiar" id="listStatus" name="listStatus" data-style="color-select" required="">
                            <option value="1">Activo</option>
                            <option value="0">Inactivo</option>
                        </select>
                    </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button id="btnGuardarInstitucion" class="btn color-secundario" onclick="GuardarInstitucion()">
                <i class="fa fa-fw  fa-check-circle">&nbsp;</i><span id="btnText">Guardar</span>
                </button>&nbsp;&nbsp;&nbsp;
                <button class="btn btn-danger" type="button" data-dismiss="modal">
                    <i class="fa fa-fw  fa-times-circle"> </i> Cerrar
                </button>
            </div>
        </div>
    </div>
</div>

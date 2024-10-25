<div id="ModalAsignar" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="modal-close" data-dismiss="modal" aria-label="Close">
                    <i class="font-icon-close-2"></i>
                </button>
                <h4 class="modal-title" id="labelTitulo"></h4>
            </div>
            <form action="post" id="usuario-form">
                <div class="modal-body">
                    <input type="hidden" id="incidencia_id" name="incidencia_id">    
                    <div class="form-group">
                    <label class="form-label" for="usuario_asignar">Soporte</label>
                        <select class="form-control" name="usuario_asignar" id="usuario_asignar">
                        </select>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-rounded btn-default" data-dismiss="modal">Cerrar</button>
                    <button type="submit" name="action" value="add" class="btn btn-rounded btn-primary">Guardar</button>
                </div>
            </form>    
        </div>
    </div>
</div>












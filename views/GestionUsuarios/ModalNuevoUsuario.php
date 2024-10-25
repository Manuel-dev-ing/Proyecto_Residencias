    <div id="ModalNuevoUsuario" class="modal fade bd-example-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                    <input type="hidden" id="usuario_id" name="usuario_id">    

                    <div class="form-group">
                        <label class="form-label" for="usuario_nombre">Nombre</label>
                        <input type="text" class="form-control" id="usuario_nombre" name="usuario_nombre" placeholder="Ingrese el Nombre" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuario_apellidos">Apellidos</label>
                        <input type="text" class="form-control" id="usuario_apellidos" name="usuario_apellidos" placeholder="Ingrese los Apellidos" maxlength="50" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuario_password">Contraseña</label>
                        <input type="password" class="form-control" id="usuario_password" name="usuario_password" placeholder="Ingrese la Contraseña" maxlength="15" required>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="usuario_correo">Correo Electronico</label>
                        <input type="text" class="form-control" id="usuario_correo" name="usuario_correo" placeholder="Ingrese el Correo Electronico" maxlength="50" required>
                    </div>
                    
                    <div class="form-group">
                        <label class="form-label" for="roles">Tipo de Usuario</label>
                        <select class="form-control" name="roles" id="roles" required>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="sucursal">Sucursal</label>
                        <select class="form-control" name="sucursal" id="sucursal" required>
                            
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












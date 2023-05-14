<!-- Modal registra Usuario-->
<div class="modal fade" id="model-addUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Registrar usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-usuarioNombre" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" name="input-usuarioNombre" id="input-usuarioNombre" placeholder="Nombre" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" required>
                                </div>
                            </div>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-tipoUsuario" class="form-label">Tipo usuario</label>
                                    <select class="form-select" name="input-tipoUsuario" id="input-tipoUsuario" required>
                                        <option value="" disabled="" selected >Seleccione una opción</option>
                                        <option value="1">Administrador</option>
                                        <option value="2">Recepcionista</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-correoUsuario" class="form-label">Correo</label>
                                    <input type="text" class="form-control" name="input-correoUsuario" id="input-correoUsuario" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-user" class="form-label">Nombre Usuario</label>
                                    <input type="text" class="form-control" name="input-user" id="input-user" placeholder="Nombre usuario" maxlength="45" pattern="[a-zA-Z0-9]{4,35}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-usuarioPassword" class="form-label" required>Contraseña</label>
                                    <input type="password" class="form-control" name="input-usuarioPassword" id="input-usuarioPassword" placeholder="Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-usuarioPassword2" class="form-label" required>Repetir Contraseña</label>
                                    <input type="password" class="form-control" name="input-usuarioPassword2" id="input-usuarioPassword2" placeholder="Repetir Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>
                                </div>
                            </div>
                            <div class="mb-3 row">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Guardar</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
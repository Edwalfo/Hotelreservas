<!-- Modal actualizar Usuario-->


<div class="modal fade" id="model-updateUsuario" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Actualizar usuario </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" data-form="update" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="hidden" name="input-Upid" id="input-Upid">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-UpusuarioNombre" class="form-label">Nombre completo</label>
                                    <input type="text" class="form-control" name="input-UpusuarioNombre" id="input-UpusuarioNombre"  placeholder="Nombre" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{1,45}" required>
                                </div>
                            </div>
                            
                            <?php if ($_SESSION['tipo_SHotel'] == 1) { ?>
                                

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="input-tipoUsuario" class="form-label">Tipo usuario</label>
                                        <select class="form-select" id="input-UptipoUsuario" name="input-UptipoUsuario" required>
                                            <option value="" disabled="">Seleccione una opción</option>
                                            <option value="1">Administrador</option>
                                            <option value="2">Recepcionista</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="mb-3">
                                        <label for="input-UpEstado" class="form-label">Estado usuario</label>
                                        <select class="form-select" id="input-UpEstado" name="input-UpEstado" required>
                                            <option value="" disabled="">Seleccione una opción</option>
                                            <option value="activo">Activo</option>
                                            <option value="inactivo">Inactivo</option>
                                        </select>
                                    </div>

                                </div>
                            <?php } ?>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-UpcorreoUsuario" class="form-label">Correo</label>
                                    <input type="text" class="form-control" name="input-UpcorreoUsuario" id="input-UpcorreoUsuario" placeholder="Email">
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-Upuser" class="form-label">Usuario nombre</label>
                                    <input type="text" class="form-control" name="input-upUser" id="input-upUser" placeholder="Nombre usuario" maxlength="45" pattern="[a-zA-Z0-9]{4,35}" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-usuarioPassword" class="form-label" required>Contraseña</label>
                                    <input type="password" class="form-control" name="input-UpusuarioPassword" id="input-UpusuarioPassword" placeholder="Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-usuarioPassword2" class="form-label" required>Repetir Contraseña</label>
                                    <input type="password" class="form-control" name="input-UpusuarioPassword2" id="input-UpusuarioPassword2" placeholder="Repetir Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>
                                </div>
                            </div>

                            <p class="text-center">Para poder guardar los cambios en esta cuenta debe ingresar Usuario y contraseña</p>


                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-adminNombre" class="form-label">Usuario</label>
                                    <input type="text" class="form-control" name="input-adminNombre" id="input-adminNombre" value="" placeholder="Nombre" maxlength="35" pattern="[a-zA-Z0-9]{1,35}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-adminPassword" class="form-label" required>Contraseña</label>
                                    <input type="password" class="form-control" name="input-adminPassword" id="input-adminPassword" placeholder="Admin Contraseña" maxlength="60" pattern="[A-Za-z\d$@$!%*?&]{5,60}" required>
                                </div>
                            </div>


                            <?php
                            ?>
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
<!-- Modal actualizar habitaciones-->
<div class="modal fade" id="model-upHabitacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Actualizar habitacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/habitacionAjax.php" data-form="update" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="hidden" name="input-Upid" id="input-Upid">
                                </div>
                            </div>
                           
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-uptipoHabitacion" class="form-label">Tipo habitación</label>
                                    <select class="form-select" name="input-uptipoHabitacion" id="input-uptipoHabitacion">
                                        <?php
                                        require_once "./controladores/tipoHabitacionControlador.php";
                                        $ins_oHabitacion = new tipoHabitacionControlador;

                                        echo $ins_oHabitacion->generar_tiposhabitacion_controlador('up')
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-upestadoactual" class="form-label">Estado habitación</label>
                                    <select class="form-select" name="input-upestadoactual" id="input-upestadoactual">
                                        <option value="0">Seleccione una opción</option>
                                        <option value="1">Disponible</option>
                                        <option value="2">Ocupada</option>
                                        <option value="3">Reparacion</option>
                                        <option value="4">Sucia</option>
                                        <option value="5">Reservada</option>
                                    </select>
                                </div>
                            </div>

                           
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-upnumero" class="form-label" required>Numero</label>
                                    <input type="number" class="form-control" name="input-upnumero" id="input-upnumero" min="0" placeholder="Numero" pattern="[0-9]+" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-upEstado" class="form-label">Estado</label>
                                    <select class="form-select" id="input-upEstado" name="input-upEstado" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
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
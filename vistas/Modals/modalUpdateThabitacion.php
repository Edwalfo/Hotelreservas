<!-- Modal actualizar tipos de habitaciones-->
<div class="modal fade" id="model-upCategoria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Actualizar tipos de habitacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/tipohabitacionAjax.php" data-form="update" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="hidden" name="input-Upid" id="input-Upid">
                                </div>
                            </div>
                            

                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-tipoNombreH" class="form-label" required>Nombre tipo habitacion</label>
                                    <input type="text" class="form-control" name="input-tipoNombreH" id="input-tipoNombreH" placeholder="Nombre del tipo" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-upcostoTipo" class="form-label" required>Costo</label>
                                    <input type="number" min="0" class="form-control" name="input-upcostoTipo" id="input-upcostoTipo" placeholder="Costo" pattern="[0-9]+" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-upEstadoHtipo" class="form-label">Estado</label>
                                    <select class="form-select" id="input-upEstadoHtipo" name="input-upEstadoHtipo" required>
                                        <option value="activo">Activo</option>
                                        <option value="inactivo">Inactivo</option>
                                    </select>
                                </div>

                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-updescripcion" class="form-label">Descripción</label>
                                    <textarea class="form-control" name="input-updescripcion" id="input-updescripcion" placeholder="Descripción" maxlength="100" rows="3"></textarea>
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
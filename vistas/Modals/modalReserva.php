<!-- Modal registra Huespedes-->
<div class="modal fade" id="model-addreserva" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Registrar Huésped</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/reservaAjax.php" data-form="save" autocomplete="off">
                        <div class="row">

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-fechaentrada" class="form-label" required>Fecha entrada</label>
                                    <input type="text" class="form-control" name="input-fechaentrada" id="input-fechaentrada"  placeholder="Entrada" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-fechasalida" class="form-label" required>Fecha salida</label>
                                    <input type="text" class="form-control" name="input-fechasalida" id="input-fechasalida" placeholder="Salida" onfocus="(this.type='date')" onblur="(this.type='text')" required>
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
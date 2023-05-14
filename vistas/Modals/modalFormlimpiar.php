<!-- Modal -->
<div class="modal fade" id="modal-limpiar" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content text-center">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Limpieza</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/habitacionAjax.php" data-form="update" autocomplete="off">
                        <h5>¿La habitacion esta limpia?</h5>
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">

                                    <input type="hidden" class="form-control" name="input-idhabitacion" id="input-idhabitacion">
                                </div>
                            </div>

                            <div class="mb-3 row mx-1">
                                <div class="col-12">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aún no</button>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Ya está limpia</button>
                                </div>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>



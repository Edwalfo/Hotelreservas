<!-- Modal registra tipos de documentos-->
<div class="modal fade" id="model-tipoDocumento" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Agregar tipo documento</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/tipoDocumentoAjax.php"  data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-tipoDocNombre" class="form-label" required>Tipo nombre</label>
                                    <input type="text" class="form-control" name="input-tipoDocNombre" id="input-tipoDocNombre" placeholder="Nombre del tipo" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{1,45}" required>
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
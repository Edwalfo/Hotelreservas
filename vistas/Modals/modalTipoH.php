<!-- Modal registra tipos de documento-->
<div class="modal fade" id="model-Categoria" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Agregar tipos de habitacion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/tipohabitacionAjax.php" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-TipoNombre" class="form-label" required>Nombre tipo habitacion</label>
                                    <input type="text" class="form-control" name="input-tipoNombre" id="input-tipoNombre" placeholder="Nombre del tipo" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{4,45}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-costoTipo" class="form-label" required>Costo</label>
                                    <input type="number" min="0" class="form-control" name="input-costoTipo" id="input-costoTipo" placeholder="Costo" pattern="[0-9]+" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-descripcion" class="form-label">Descripción</label>
                                    <textarea  class="form-control" name="input-descripcion" id="input-descripcion" placeholder="Descripción" maxlength="100" rows="3"></textarea>
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
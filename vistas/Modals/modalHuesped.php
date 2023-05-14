<!-- Modal registra Huespedes-->
<div class="modal fade" id="model-addHuesped" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Registrar Huésped</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/huespedAjax.php" data-form="save" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-huespedNombre" class="form-label" required>Nombre completo</label>
                                    <input type="text" class="form-control" name="input-huespedNombre" id="input-huespedNombre" placeholder="Nombre" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-tipoDocumento" class="form-label js-example-placeholder-single">Tipo Documento</label>
                                    <select class="form-select" name="input-tipoDocumento" id="input-tipoDocumento" title="select" required>
                                        <?php
                                        require_once "./controladores/tipodocumentoControlador.php";
                                        $ins_tipodocumento = new tipodocumentoControlador;

                                        echo $ins_tipodocumento->generar_tiposdocumento_controlador('add')
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-nDocumento" class="form-label" required>Nº Documento</label>
                                    <input type="text" class="form-control" name="input-nDocumento" id="input-nDocumento" placeholder="Numero" maxlength="15" pattern="[0-9+]{1,15}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-fNacimiento" class="form-label" required>Fecha nacimiento</label>
                                    <input type="text" class="form-control" name="input-fNacimiento" id="input-fNacimiento" placeholder="Fecha nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-Direccion" class="form-label" required>Dirección(Opcional)</label>
                                    <input type="text" class="form-control" name="input-Direccion" id="input-Direccion" placeholder="Dirección" maxlength="60" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,60}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-Telefono" class="form-label" required>Teléfono(Opcional)</label>
                                    <input type="text" class="form-control" name="input-Telefono" id="input-Telefono" placeholder="Teléfono" maxlength="45" pattern="[0-9()+]{8,20}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-correo" class="form-label" required>Correo(Opcional)</label>
                                    <input type="email" class="form-control" name="input-correo" id="input-correo" placeholder="Correo" maxlength="45">
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
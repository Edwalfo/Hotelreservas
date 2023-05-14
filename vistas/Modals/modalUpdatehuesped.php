<!-- Modal actualizar Huespedes-->
<div class="modal fade" id="model-upHuesped" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Actualizar Huésped</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/huespedAjax.php" data-form="update" autocomplete="off">
                        <div class="row">
                            <div class="col-12">
                                <div class="mb-3">
                                    <input type="hidden" name="input-Upid" id="input-Upid">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-3">
                                    <label for="input-uphuespedNombre" class="form-label" required>Nombre completo</label>
                                    <input type="text" class="form-control" name="input-uphuespedNombre" id="input-uphuespedNombre" placeholder="Nombre" minlength="5" maxlength="45" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{5,45}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-uptipoDocumento" class="form-label">Tipo Documento</label>
                                    <select class="form-select" name="input-uptipoDocumento" id="input-uptipoDocumento" required>
                                        <?php
                                        require_once "./controladores/tipodocumentoControlador.php";
                                        $ins_tipodocumento = new tipodocumentoControlador;

                                        echo $ins_tipodocumento->generar_tiposdocumento_controlador('up');
                    
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-upnDocumento" class="form-label" required>Nº Documento</label>
                                    <input type="text" class="form-control" name="input-upnDocumento" id="input-upnDocumento" placeholder="Numero" maxlength="15" pattern="[0-9+]{1,15}" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-upfNacimiento" class="form-label" required>Fecha nacimiento</label>
                                    <input type="text" class="form-control" name="input-upfNacimiento" id="input-upfNacimiento" placeholder="Fecha nacimiento" onfocus="(this.type='date')" onblur="(this.type='text')" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-upDireccion" class="form-label" required>Dirección(Opcional)</label>
                                    <input type="text" class="form-control" name="input-upDireccion" id="input-upDireccion" placeholder="Dirección" maxlength="60" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,60}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-upTelefono" class="form-label" required>Teléfono(Opcional)</label>
                                    <input type="text" class="form-control" name="input-upTelefono" id="input-upTelefono" placeholder="Teléfono" maxlength="45" pattern="[0-9()+]{8,20}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="input-upcorreo" class="form-label" required>Correo(Opcional)</label>
                                    <input type="email" class="form-control" name="input-upcorreo" id="input-upcorreo" placeholder="Correo" maxlength="45">
                                </div>
                            </div>

                            <div class="col-6">
                                <div class="mb-3">
                                    <label for="input-upestadohuesped" class="form-label">Estado</label>
                                    <select class="form-select" id="input-upestadohuesped" name="input-upestadohuesped" required>
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
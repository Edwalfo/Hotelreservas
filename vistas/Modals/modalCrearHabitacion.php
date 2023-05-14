<!-- Modal crear habitaciones-->
<div class="modal fade" id="model-addHabitacion" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-info">
                <h5 class="modal-title">Crear Habitación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/habitacionAjax.php" data-form="save" autocomplete="off">
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input-tipoHabitacion" class="form-label">Tipo habitación</label>
                                <select class="form-select" name="input-tipoHabitacion" id="input-tipoHabitacion">
                                    <?php
                                    require_once "./controladores/tipoHabitacionControlador.php";
                                    $ins_tipoHabitacion = new tipoHabitacionControlador;

                                    echo $ins_tipoHabitacion->generar_tiposhabitacion_controlador('add')
                                    ?>
                                </select>
                            </div>
                        </div>
                        <!--
                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input-estadoactual'" class="form-label">Estado habitación</label>
                                <select class="form-select" name="input-estadoactual" id="input-estadoactual'">
                                    <option value="0" selected="">Seleccione una opción</option>
                                    <option value="1">Disponible</option>
                                    <option value="2" disabled>Ocupada</option>
                                    <option value="3">Reparacion</option>
                                    <option value="4">Sucia</option>
                                    <option value="5" disabled>Reservada</option>
                                </select>
                            </div>
                        </div>-->

                        <div class="col-12">
                            <div class="mb-3">
                                <label for="input-numero" class="form-label" required>Numero</label>
                                <input type="number" class="form-control" name="input-numero" id="input-numero" min="0" placeholder="Numero" pattern="[0-9]+" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-12">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                &nbsp;
                                <button type="submit" class="btn btn-primary">Guardar</button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
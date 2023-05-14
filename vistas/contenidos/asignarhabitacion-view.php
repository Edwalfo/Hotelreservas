<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="m-0">Registro entrada</h4>

        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-md-end">
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>recepcion">Recepcion</a></li>
                <li class="breadcrumb-item active">Registro entrada</li>

            </ol>
        </div>
    </div>

</div>

<?php
require_once "./controladores/habitacionControlador.php";
require_once "./vistas/Modals/modalHuesped.php";
$ins_habitacion = new habitacionControlador;
$datos_habitacion = $ins_habitacion->datos_habitacion_controlador("unico", $pagina[1]);
$campos = $datos_habitacion->fetch();
if ($datos_habitacion->rowCount() == 1 && ($campos['estado'] == 1 || $campos['estado'] == 5)) {
    if ($campos['estado'] == '1') {
        $campos['estado'] = '<span class="badge bg-success">Disponible</span>';
    } elseif ($campos['estado'] == '2') {
        $campos['estado'] = '<span class="badge bg-primary">Ocupada</span>';
    } elseif ($campos['estado'] == '3') {
        $campos['estado'] = '<span class="badge bg-danger">Reparacion</span>';
    } elseif ($campos['estado'] == '4') {
        $campos['estado'] = '<span class="badge bg-secondary">Sucia</span>';
    } elseif ($campos['estado'] == '5') {
        $campos['estado'] = '<span class="badge bg-info text-dark">Limpieza</span>';
    } else {
        $campos['estado'] = '<span class="badge bg-warning text-dark">Reservada</span>';
    }


?>
    <div class="row p-0 m-0">
        <div class="col-md-12 ">
            <div class="card border-success card-outline shadow mb-2">
                <div class="card-header ">
                    <h5 class="card-title"><i class="bi bi-list-ul"></i>Datos habitacion</h5>
                </div>
                <div class="card-body  table-responsive">

                    <div class="row p-3">
                        <div class="col-md-4">
                            <div class="d-flex">
                                <h6 class="text-primary fw-bold">Nº Habitación:</h6>
                                &nbsp;&nbsp;
                                <h6><?php echo $campos['numeroHabitacion'] ?></h6>
                            </div>
                            <div class="d-flex">
                                <h6 class="text-primary fw-bold">Tipo:</h6>
                                &nbsp;&nbsp;
                                <h6><?php echo $campos['nombreTipoHabitacion'] ?></h6>
                            </div>

                        </div>
                        <div class="col-md-4">
                            <div class="d-flex">
                                <h6 class="text-primary fw-bold">Precio:</h6>
                                &nbsp;&nbsp;
                                <h6>$</h6>
                                <h6 id="precio"><?php echo $campos['valorTipoHabitacion'] ?></h6>
                            </div>
                            <div class="d-flex">

                                <h6 class="text-primary fw-bold">Descripción:</h6>
                                &nbsp;&nbsp;
                                <h6><?php echo $campos['descripcion'] ?></h6>

                            </div>

                        </div>
                        <div class="col-md-4">

                            <div class="d-flex">
                                <h6 class="text-primary fw-bold">Estado:</h6>
                                &nbsp;&nbsp;
                                <h6><?php echo $campos['estado'] ?></h6>
                            </div>

                        </div>

                    </div>


                </div>

            </div>

        </div>



        <div class="col-md-12 ">
            <div class="card border-success card-outline shadow ">
                <div class="card-body">
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/hospedajeAjax.php" data-form="save" autocomplete="off" id="form-checkin" >
                        <div class="row p-3">
                            <div class="col-md-6">

                                <div class="row g-3">

                                    <h5><i class="bi bi-list-ul"></i>Cliente</h5>
                                    <hr>
                                    <div class="col-12">
                                        <label for="select-huespedes" class="form-label">Nombre</label>
                                        <div class="input-group">


                                            <select class="form-control" style="width: 90%" name="select-huespedes" id="select-huespedes" required>
                                                <option></option>
                                                <?php
                                                require_once "./controladores/huespedControlador.php";
                                                $ins_huesped = new huespedControlador;

                                                echo $ins_huesped->generar_huesped_controlador()
                                                ?>

                                            </select>


                                            <button class="btn btn-success" type="button" id="btn-buscar-cliente" style="width:10%" data-bs-toggle="modal" data-bs-target="#model-addHuesped">
                                                <i class="bi bi-person-plus"></i></button>

                                        </div>
                                    </div>
                                    <h5><i class="bi bi-list-ul"></i>Alojamiento</h5>
                                    <hr>

                                    <div class="col-sm-6">
                                        <label for="fechaEntrada" class="form-label">Fecha entrada</label>
                                        <input type="text" class="form-control" min="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>" name="fechaEntrada" id="fechaEntrada" readonly required onfocus="(this.type='date')" onblur="(this.type='text')">

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="fechaSalida" class="form-label">Fecha salida</label>
                                        <input type="text" class="form-control" min="<?php echo date('Y-m-d') ?>" value="<?php echo date('Y-m-d') ?>" name="fechaSalida" id="fechaSalida" required onfocus="(this.type='date')" onblur="(this.type='text')">

                                    </div>

                                    <div class="col-sm-6 mb-3">
                                        <label for="input-total-alojamiento" class="form-label">Total costo alojamiento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                            <input type="number" min="0" class="form-control" name="input-total-alojamiento" id="input-total-alojamiento" value="<?php echo $campos['valorTipoHabitacion'] ?>" readonly>
                                        </div>

                                    </div>

                                </div>



                            </div>

                            <div class="col-md-6">


                                <div class="row g-3">


                                    <h5><i class="bi bi-list-ul"></i>Cobro</h5>
                                    <hr>
                                    <div class="col-sm-6">
                                        <label for="inputDescuento" value="0" class="form-label">Descuento</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="number" min="0" id="input-descuento" name="input-descuento" value="0" class="form-control" pattern="[0-9]+">
                                        </div>

                                    </div>

                                    <div class="col-sm-6">
                                        <label for="inputTotal" class="form-label">Total</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-cash-stack"></i></span>
                                            <input type="number" min="0" class="form-control" value="<?php echo $campos['valorTipoHabitacion'] ?>" name="inputTotal" id="inputTotal" readonly >
                                        </div>

                                    </div>

                                    <div class="col-sm-6">

                                        <label for="select-metodo-pag" class="form-label">Metodo de pago</label>
                                        <div class="input-group has-validation">
                                            <span class="input-group-text"> <i class="bi bi-cash-coin"></i></span>
                                            <select class="form-select" id="select-metodo-pago" required>
                                                <option value="0">Seleccione</option>
                                                <option value="1">Efectivo</option>
                                                <option value="2">Tarjeta</option>
                                                <option value="3">Transferencia</option>
                                                <option value="4">Otros</option>
                                            </select>

                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="input-totalpagado" value="0" class="form-label">Total pagado</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-currency-dollar"></i></span>
                                            <input type="number" min="0" id="input-totalpagado" name="input-totalpagado" value="0" class="form-control" pattern="[0-9]+" readonly>
                                        </div>


                                    </div>

                                    <div class="col-12">
                                        <div class="efectivo">

                                            <div class="input-group input-group-sm mb-2">
                                                <span class="input-group-text w-25 ">Efectivo</span>
                                                <input type="number" min="0" class="form-control" name="input-efectivo" value="0" id="input-efectivo" pattern="[0-9]+">
                                                <button type="button" class="btn btn-danger btn-sm" id="eliminar-efectivo"><i class="bi bi-x-circle"></i></button>
                                            </div>
                                        </div>
                                        <div class="tarjeta">
                                            <div class="input-group input-group-sm mb-2">
                                                <span class="input-group-text w-25">Tarjeta</span>
                                                <input type="number" min="0" class="form-control" name="input-tarjeta" value="0" id="input-tarjeta" pattern="[0-9]+">
                                                <button type="button" class="btn btn-danger btn-sm" id="eliminar-tarjeta"><i class="bi bi-x-circle"></i></button>
                                            </div>

                                        </div>
                                        <div class="transferencia">
                                            <div class="input-group input-group-sm mb-2">
                                                <span class="input-group-text w-25">Transferencia</i></span>
                                                <input type="number" min="0" class="form-control" name="input-transferencia" value="0" id="input-transferencia" pattern="[0-9]+">
                                                <button type="button" class="btn btn-danger btn-sm" id="eliminar-transferencia"><i class="bi bi-x-circle"></i></button>
                                            </div>

                                        </div>

                                        <div class="otros">
                                            <div class="input-group input-group-sm mb-2">
                                                <span class="input-group-text w-25">Otros</i></span>
                                                <input type="number" min="0" class="form-control" name="input-otros" value="0" id="input-otros" pattern="[0-9]+">
                                                <button type="button" class="btn btn-danger btn-sm" id="eliminar-otros"><i class="bi bi-x-circle"></i></button>
                                            </div>

                                        </div>

                                    </div>

                                    <hr class="my-4">

                                
                                        <input type="hidden" name="inputid-Habitacion" value="<?php echo $campos['idHabitacion'] ?>">
                                        <input type="hidden" name="inputprecio-Habitacion" id="inputprecio-Habitacion" value="<?php echo $campos['valorTipoHabitacion'] ?>">
                               

                                    <div class="row">
                                        <div class="col-sm-8 d-flex">
                                            <a type="button" href="<?php echo SERVERURL; ?>recepcion/" class="btn btn-secondary">Cancelar</a>
                                            &nbsp;
                                            <button type="submit" class="btn btn-primary">Registrar</button>

                                        </div>
                                    </div>


                                </div>


                            </div>
                        </div>
                    </form>


                </div>



            </div>


        </div>




    </div>

<?php } else { ?>
    <div class="alert alert-danger text-center" role="alert">
        <h4 class="alert-heading">¡Ocurrio un error inesperado!</h4>
        <hr>
        <p class="mb-0">Lo sentimos, no podemos mostrar la informacion solicitada debibo
            a un error
        </p>
    </div>
<?php }

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="m-0">Registro de salida</h4>

        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-md-end">
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>checkout">Verificación salida</a></li>
                <li class="breadcrumb-item active">Registro salida</li>

            </ol>
        </div>
    </div>

</div>


<?php
require_once "./controladores/habitacionControlador.php";
require_once "./modelos/mainModel.php";
$ins_habitacion = new habitacionControlador;
$ins = new mainModel;
$datos_habitacion = $ins_habitacion->datos_habitacion_controlador("salida", $pagina[1]);
$campos = $datos_habitacion->fetch();

if ($datos_habitacion->rowCount() == 1 && ($campos['estado'] == 2 || $campos['estadoReservacion'] == 2)) {
?>

    <div class="row  p-0 m-0">
        <div class="col-md-4">
            <div class="card text-start border-success card-outline shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Datos Habitación</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Nº Habitación:</h6>

                        <h6><?php echo $campos['numeroHabitacion'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Tipo:</h6>

                        <h6><?php echo $campos['nombreTipoHabitacion'] ?></h6>
                    </div>


                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Precio $:</h6>

                        <h6 id="precio"><?php echo $campos['valorTipoHabitacion'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">

                        <h6 class="text-primary fw-bold">Descuento:</h6>

                        <h6><?php echo $campos['descuento'] ?></h6>

                    </div>

                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-start border-success card-outline shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Datos cliente</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Nombre:</h6>

                        <h6><?php echo $campos['nombreHuesped'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Documento:</h6>

                        <h6><?php echo $campos['nombreTipoDocumento'] ?> <?php echo $campos['documentoHuesped'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Telefono:</h6>

                        <h6><?php echo $campos['telefonoHuesped'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Correo:</h6>

                        <h6><?php echo $campos['correoHuesped'] ?></h6>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-start border-success card-outline shadow mb-3">
                <div class="card-body">
                    <h5 class="card-title">Datos hospedaje</h5>
                    <hr>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Fecha entrada:</h6>

                        <h6><?php echo $campos['fecha_ingreso'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Fecha salida:</h6>

                        <h6><?php echo $campos['fecha_salida'] ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Tiempo estimado:</h6>



                        <h6><?php
                            $estimado = $ins->calcular_diferencia_fechas($campos['fecha_ingreso'], $campos['fecha_salida']);
                            if ($estimado == 0) {
                                $estimado = 1;
                            }
                            echo $estimado . " dias"; ?></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="text-primary fw-bold">Tiempo rebasado:</h6>

                        <h6><?php $rebasado = $ins->calcular_diferencia_fechas($campos['fecha_salida'], date("Y-m-d"));
                            if ($rebasado > 0) {
                                echo ('<h6 class="text-danger">' . $rebasado . ' dias</h6>');
                            } else {
                                echo ('<h6 class="text-success">Sin tiempo rebasado</h6>');
                                $rebasado = 0;
                            }

                            ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row p-0 m-0">
        <div class="col-12">
            <div class="card text-start border-success card-outline shadow mb-3">
                <div class="card-body ">
                    <h5 class="card-title">Detalles alojamiento</h5>
                    <hr>
                    <form class="FormularioAjax" method="POST" action="<?php echo SERVERURL; ?>ajax/salidaAjax.php" data-form="exit" autocomplete="off">
                        <div class="row">
                            <div class="col-12 table-responsive">

                                <table class="table text-center display nowrap  w-100 shadow rounded table-hover">
                                    <thead class="thead-inverse bg-info">
                                        <tr>
                                            <th>Costo alojamiento</th>
                                            <th>Descuento</th>
                                            <th>Adelanto</th>
                                            <th>Mora/Penalidad</th>
                                            <th>Por pagar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td scope="row"><?php echo $alojamiento = $campos['valorTipoHabitacion'] * $estimado ?></td>
                                            <td><?php echo $campos['descuento'] ?></td>
                                            <td><?php echo $adelanto = $campos['valor_efectivo'] + $campos['valor_tarjeta'] + $campos['valor_transferencia'] + $campos['valor_otros'] ?></td>
                                            <td>
                                                <div class="col-auto">

                                                    <input type="number" min="0" class="" value="<?php echo $mora = $campos['valorTipoHabitacion'] * $rebasado ?>" name="input-penalidad" id="input-penalidad" pattern="[0-9]+" readonly>


                                                </div>
                                            </td>
                                            <td>
                                                <div class="col-auto">

                                                    <input type="number" min="0" class="text-danger" value="<?php echo $total = $alojamiento + $mora - $adelanto - $campos['descuento'] ?>" name="input-saldo" id="input-saldo" pattern="[0-9]+" readonly>

                                                </div>

                                            </td>

                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-md-5">


                                    <div class="input-group mb-3 ">
                                        <span class="input-group-text bg-info fw-bold">Total a pagar $/</span>
                                        <input type="text" value="<?php echo $total + $adelanto ?>" name="input-t-pagar" id="input-t-pagar" class="form-control" placeholder="" readonly>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="input-group mb-3">
                                        <span class="input-group-text"> <i class="bi bi-cash-coin"></i></span>
                                        <select class="form-select" id="select-metodo-pago" required>
                                            <option value="0">Metodo de pago</option>
                                            <option value="1">Efectivo</option>
                                            <option value="2">Tarjeta</option>
                                            <option value="3">Transferencia</option>
                                            <option value="4">Otros</option>
                                        </select>

                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-5">
                                    <div class="efectivo">

                                        <div class="input-group input-group-md mb-2">
                                            <span class="input-group-text w-25 ">Efectivo</span>
                                            <input type="number" min="0" class="form-control" name="input-efectivo" value="0" id="input-efectivo" pattern="[0-9]+">
                                            <button type="button" class="btn btn-danger btn-sm" id="eliminar-efectivo"><i class="bi bi-x-circle"></i></button>
                                        </div>
                                    </div>
                                    <div class="tarjeta">
                                        <div class="input-group input-group-md mb-2">
                                            <span class="input-group-text w-25">Tarjeta</span>
                                            <input type="number" min="0" class="form-control" name="input-tarjeta" value="0" id="input-tarjeta" pattern="[0-9]+">
                                            <button type="button" class="btn btn-danger btn-sm" id="eliminar-tarjeta"><i class="bi bi-x-circle"></i></button>
                                        </div>

                                    </div>
                                    <div class="transferencia">
                                        <div class="input-group input-group-md mb-2">
                                            <span class="input-group-text w-25">Transferencia</i></span>
                                            <input type="number" min="0" class="form-control" name="input-transferencia" value="0" id="input-transferencia" pattern="[0-9]+">
                                            <button type="button" class="btn btn-danger btn-sm" id="eliminar-transferencia"><i class="bi bi-x-circle"></i></button>
                                        </div>

                                    </div>

                                    <div class="otros">
                                        <div class="input-group input-group-md mb-2">
                                            <span class="input-group-text w-25">Otros</i></span>
                                            <input type="number" min="0" class="form-control" name="input-otros" value="0" id="input-otros" pattern="[0-9]+">
                                            <button type="button" class="btn btn-danger btn-sm" id="eliminar-otros"><i class="bi bi-x-circle"></i></button>
                                        </div>

                                    </div>

                                </div>
                            </div>

                            <input type="hidden" min="0" class="form-control" name="input-totalpagado" value="" id="input-totalpagado">
                            <input type="hidden" name="input-idhabitacion" value="<?php echo $campos['idHabitacion'] ?>">
                            <input type="hidden" name="input-idreserva" value="<?php echo $campos['idReserva'] ?>">
                            <input type="hidden" name="input-idfactura" value="<?php echo $campos['idFactura'] ?>">


                            <hr class="my-4">
                            <div class="row">
                                <div class="">
                                    <a type="button" href="<?php echo SERVERURL; ?>checkout/" class="btn btn-secondary">Cancelar</a>
                                    &nbsp;
                                    <button type="submit" class="btn btn-primary">Terminar y limpiar habitación</button>

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
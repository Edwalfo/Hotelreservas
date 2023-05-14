<div class="row">
    <div class="col-md-12">
        <h4>Dashboard</h4>
    </div>
</div>
<?php
require_once "./controladores/habitacionControlador.php";
$ins_habitacion = new habitacionControlador();
$total_habitaciones = $ins_habitacion->datos_habitacion_controlador("conteo", 0);
?>
<div class="row">
    <div class="col-md-3 mb-3">
        <div class="card bg-primary text-white h-100">
            <div class="card-body py-5">
                <h3 class="text-center"> Habitaciones</h3>
                <p class="text-center"><?php echo $total_habitaciones->rowCount(); ?> Registradas</p>

            </div>
            <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-warning text-dark h-100">
            <div class="card-body py-5">Warning Card</div>
            <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-success text-white h-100">
            <div class="card-body py-5">Success Card</div>
            <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-3 mb-3">
        <div class="card bg-danger text-white h-100">
            <div class="card-body py-5">Danger Card</div>
            <div class="card-footer d-flex">
                View Details
                <span class="ms-auto">
                    <i class="bi bi-chevron-right"></i>
                </span>
            </div>
        </div>
    </div>
</div>
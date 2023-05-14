<?php
if ($_SESSION['tipo_SHotel'] != 1) {
    echo $loginC->forzar_cierre_sesion_controlador();
    exit();
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="m-0">Habitaciones</h4>

        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-md-end">
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
                <li class="breadcrumb-item active">Habitaciones</li>


            </ol>
        </div>
    </div>
</div>


<div class="row p-0 m-0">
    <div class="col-md-12">
        <div class="card border-success card-outline shadow">
            <div class="card-header ">
                <h5 class="card-title"><i class="bi bi-list-ul"></i> Listado habitaciónes</h5>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success mb-4 " data-bs-toggle="modal" data-bs-target="#model-addHabitacion">
                            <i class="bi bi-plus-lg"></i>&nbsp;Agregar &nbsp;
                        </button>

                    </div>
                </div>


                <div class="row">
                    <div class="col-md-10 table-responsive">
                        <?php

                        require_once "./controladores/habitacionControlador.php";
                        $ins_habitacion = new habitacionControlador();



                        echo $ins_habitacion->paginador_habitacion_controlador(
                            $pagina[1],
                            15,
                            $_SESSION['tipo_SHotel'],
                            $_SESSION['id_SHotel'],
                            $pagina[0],
                            ""
                        );




                        ?>




                    </div>


                </div>

            </div>

        </div>

    </div>

</div>


<?php require_once "./vistas/Modals/modalCrearHabitacion.php"; ?>
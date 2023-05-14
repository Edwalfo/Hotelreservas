<?php
if ($_SESSION['tipo_SHotel']!= 1) {
    echo $loginC->forzar_cierre_sesion_controlador();
    exit();
}

?>

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <h4 class="m-0">Estado Reservas</h4>

        </div>
        <div class="col-md-6">
            <ol class="breadcrumb float-md-end">
                <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
                <li class="breadcrumb-item active">Estado Reservas</li>

            </ol>
        </div>
    </div>
</div>
<div class="row p-0 m-0">
    <div class="col-md-12">
        <div class="card border-success card-outline shadow">
            <div class="card-header ">
                <h5 class="card-title"><i class="bi bi-list-ul"></i> Listado de estados reserva</h5>
            </div>
            <div class="card-body ">
                <div class="row">
                    <div class="col-md-4">
                        <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#model-estadoReserva">
                            <i class="bi bi-plus-lg"></i>&nbsp;Agregar &nbsp;
                        </button>

                    </div>
                </div>
                <div class="row">
                    <div class="col-md-8 table-responsive">
                        <table id="lstCategorias" class="table display nowrap table-striped w-100 shadow rounded table-bordered border-dark">
                            <thead class="thead-inverse bg-info">
                                <th>Id</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th>Opciones</th>
                            </thead>
                            <tbody class="small text left">
                                <tr>
                                    <td scope="row">3</td>
                                    <td>Cancelada</td>
                                    <td>activo</td>
                                    <td>
                                        <button class="btn btn-danger btn-sm" name="opciones"><i class="bi bi-x-circle"></i></button>
                                        <button class="btn btn-primary btn-sm" name="opciones"><i class="bi bi-pencil"></i></button>

                                    </td>
                                </tr>


                            </tbody>
                        </table>

                    </div>


                </div>


            </div>

        </div>

    </div>

</div>

<?php require_once "./vistas/Modals/modalEstadoR.php"; ?>
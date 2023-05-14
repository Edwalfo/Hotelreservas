<div class="container-fluid">
  <div class="row">
    <div class="col-md-6">
      <h4 class="m-0">Reservas</h4>
    </div>
    <div class="col-md-6">
      <ol class="breadcrumb float-md-end">
        <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
        <li class="breadcrumb-item active">Reservas</li>

      </ol>
    </div>
  </div>
</div>

<div class="row p-0 m-0">
  <div class="col-md-12">
    <div class="card border-success card-outline shadow">
      <div class="card-header ">
        <h5 class="card-title"><i class="bi bi-list-ul"></i> Listado reservas</h5>
      </div>
      <div class="card-body ">
        <div class="row">
          <div class="col-md-4">
            <button type="button" class="btn btn-success mb-4" data-bs-toggle="modal" data-bs-target="#model-addreserva">
              <i class="bi bi-plus-lg"></i>&nbsp;Agregar &nbsp;
            </button>

          </div>
        </div>

        <div class="row">
          <div class="col-md-12 table-responsive">
            <?php
            require_once "./controladores/reservaControlador.php";
            $ins_reserva = new reservaControlador();
            echo $ins_reserva->paginador_reserva_controlador(
              $pagina[1],
              15,
              $_SESSION['tipo_SHotel'],
              $_SESSION['id_SHotel'],
              $pagina[0],
              ""
            ); ?>

            <?php

            $entrada = new DateTime("2022-07-12");
            $salida = new DateTime("2022-07-20");

            $dias = $salida->diff($entrada);

            $dias = $dias->d;
            echo $dias;
            ?>

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php require_once "./vistas/Modals/modalreserva.php"; ?>
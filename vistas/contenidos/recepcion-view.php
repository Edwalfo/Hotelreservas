<div class="d-flex justify-content-between">
    <div class="col-md-6">
        <h4 class="m-0">Recepción</h4>

    </div>
    <div class="col-md-6 ">
        <ol class="breadcrumb float-md-end ">
            <li class="breadcrumb-item"><a href="<?php echo SERVERURL; ?>home">Inicio</a></li>
            <li class="breadcrumb-item">Recepcion</li>    

        </ol>
    </div>
</div>


<ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="nav-link active" id="General-tab" data-bs-toggle="tab" data-bs-target="#General-tab-pane" type="button" role="tab" aria-controls="General-tab-pane" aria-selected="true">
            General
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="nav-link" id="Piso1-tab" data-bs-toggle="tab" data-bs-target="#Piso1-tab-pane" type="button" role="tab" aria-controls="Piso1-tab-pane" aria-selected="false">
            Piso 1
        </button>
    </li>

</ul>
<div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="General-tab-pane" role="tabpanel" aria-labelledby="General-tab" tabindex="0">

        <div class="row g-2  p-0 m-0">

            <?php
            require_once "./controladores/habitacionControlador.php";
            $ins_Habitaciones = new habitacionControlador;

            echo $ins_Habitaciones->mostrar_habitacion_controlador();
            ?>

        </div>
    </div>
    <div class="tab-pane fade" id="Piso1-tab-pane" role="tabpanel" aria-labelledby="Piso1-tab" tabindex="0">
        
    </div>
</div>
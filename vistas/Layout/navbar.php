<!--navbar-->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">
        <!--Offcanvas boton-->

        <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
            <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
        </button>



        <!--Offcanvas boton-->

       
            <a class="navbar-brand fw-bold me-auto" href="<?php echo SERVERURL ?>pagina">Hotel Mark-1</a>

   

        <div class="dropdown ">

            <a class="navbar-brand  dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-person-fill">&nbsp;<?php echo $_SESSION['nombre_SHotel']; ?></i>
            </a>
            <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#">Configuración</a></li>
                <!-- <li><a class="dropdown-item" href="#">Another action</a></li>-->
                <li>
                    <hr class="dropdown-divider">
                </li>
                <li><a class="dropdown-item link-salir" href="<?php echo $url; ?>/logout.php">Salir</a></li>
            </ul>
        </div>



        <!--<div class="collapse navbar-collapse" id="navbarSupportedContent">
            <form class="d-flex ms-auto">
                <div class="input-group my-2">
                    <input type="text" class="form-control" placeholder="Buscar" aria-label="Recipient's username" aria-describedby="button-addon2">
                    <button class="btn btn-success" type="button" id="button-addon2"><i class="bi bi-search"></i></button>
                </div>

            </form>
        </div>-->


    </div>
</nav>
<!--navbar-->
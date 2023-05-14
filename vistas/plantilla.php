<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo COMPANY ?></title>
    <?php include "./vistas/Layout/link.php" ?>

</head>


<body>
    <?php

    $peticionesAjax = false;
    require_once "./controladores/vistasControlador.php";
    $IV = new vistasControlador();

    $vistas = $IV->obtener_vistar_controlador();
    if ($vistas == "login" || $vistas == "404" || $vistas == "pagina" || $vistas == "paginareserva"|| $vistas == "datosreserva"){
        require_once "./vistas/contenidos/" . $vistas . "-view.php";
        
    } else {

        
        session_start(['name' => 'SHotel']);
       

        $pagina=explode("/", $_GET['views']);

       
        require_once "./controladores/loginControlador.php";
        $loginC = new loginControlador();
        if (
            !isset($_SESSION['token_SHotel']) || !isset($_SESSION['tipo_SHotel'])
            || !isset($_SESSION['correo_SHotel']) || !isset($_SESSION['nombre_SHotel'])
            || !isset($_SESSION['id_SHotel'])
        ) {
            echo $loginC->forzar_cierre_sesion_controlador();
        }


    ?>

        <!--navbar-->
        <?php include "./vistas/Layout/navbar.php" ?>
        <!--sidebar-->
        <?php include "./vistas/Layout/sidebar.php" ?>


        <!--Contenedor principal-->
        <div class="container-fluid">

            <div class="main-prueba mt-5 pt-4 ">
                <?php include $vistas  ?>

                <div>

                </div>
            <?php
            include "./vistas/Layout/logOut.php";
        }
        include "./vistas/Layout/script.php"
            ?>


</body>

</html>
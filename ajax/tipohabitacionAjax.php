<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-tipoNombre']) || isset($_POST['input-del']) || isset($_POST['input-Upid'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/tipoHabitacionControlador.php";
    $ins_tipohabitacion = new tipoHabitacionControlador;
    /*--agregar un usuario*/
    if (isset($_POST['input-tipoNombre']) && isset($_POST['input-costoTipo'])) {
        // echo "<script>console.log('mensajes prueba')</script>";
        echo ($ins_tipohabitacion->agregar_tipohabitacion_controlador());
    }

    /*--Eliminar tipo habitacion*/
    if (isset($_POST['input-del'])) {

        echo ($ins_tipohabitacion->eliminar_tipohabitacion_controlador());
    }

    /*--Actualizar tipo habitacion*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_tipohabitacion->actualizar_tipohabitacion_controlador());
    }
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}

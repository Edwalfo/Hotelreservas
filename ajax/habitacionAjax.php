<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-tipoHabitacion']) || isset($_POST['input-del']) || isset($_POST['input-Upid']) || isset($_POST['input-idhabitacion'] )
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/habitacionControlador.php";
    $ins_habitacion = new habitacionControlador;
    /*--agregar habitacion*/
    if (isset($_POST['input-tipoHabitacion']) && isset($_POST['input-numero'])) {
     
        echo ($ins_habitacion->agregar_habitacion_controlador());
    }

    /*--Eliminar habitacion*/
    if (isset($_POST['input-del'])) {

        echo ($ins_habitacion->eliminar_habitacion_controlador());
    }

    /*--Actualizar habitacion*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_habitacion->actualizar_habitacion_controlador());
    }
     /*--Actualizar estado a disponible*/
     if (isset($_POST['input-idhabitacion'])) {
        echo ($ins_habitacion->limpiar_habitacion_controlador());
    }
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
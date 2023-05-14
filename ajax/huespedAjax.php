<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-huespedNombre']) || isset($_POST['input-del']) || isset($_POST['input-Upid'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/huespedControlador.php";
    $ins_huesped = new huespedControlador;
    /*--agregar huesped*/
    if (isset($_POST['input-huespedNombre']) && isset($_POST['input-nDocumento'])) {
     
        echo ($ins_huesped->agregar_huesped_controlador());
    }

    /*--Eliminar huesped*/
    if (isset($_POST['input-del'])) {

        echo ($ins_huesped->eliminar_huesped_controlador());
    }

    /*--Actualizar huesped*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_huesped->actualizar_huesped_controlador());
    }
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
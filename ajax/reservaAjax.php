<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-fechaentrada']) || isset($_POST['input-del']) || isset($_POST['input-Upid'])|| isset($_POST['inputcheckout2'])
    || isset($_POST['id_tipo'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/reservaControlador.php";
    $ins_reserva = new reservaControlador;
    /*--agregar reserva*/
    if (isset($_POST['input-fechaentrada']) && isset($_POST['input-fechasalida'])) {
     
        echo ($ins_reserva->agregar_reserva_controlador());
    }

    /*--Eliminar reserva*/
    if (isset($_POST['input-del'])) {

        echo ($ins_reserva->eliminar_reserva_controlador());
    }

    /*--Actualizar reserva*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_reserva->actualizar_reserva_controlador());
    }

    if (isset($_POST['inputcheckout2'])&& isset($_POST['input-nDocumento2'])) {
       echo ($ins_reserva->agregar_reserva_huesped_controlador());
    }

    if (isset($_POST['id_tipo'])) {
        echo ($ins_reserva->consultar_reserva_controlador());
    }


    
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
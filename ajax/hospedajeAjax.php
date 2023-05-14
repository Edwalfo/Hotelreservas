<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['select-huespedes'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/hospedajeControlador.php";
    $ins_hospedaje = new hospedajeControlador;
    /*--agregar hospedaje*/
    if (isset($_POST['select-huespedes']) && isset($_POST['fechaSalida'])) {
     
        echo ($ins_hospedaje->agregar_hospedaje_controlador());
    }

    
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
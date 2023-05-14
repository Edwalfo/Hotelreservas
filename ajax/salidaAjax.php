<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-t-pagar'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/salidaControlador.php";
    $ins_salida = new salidaControlador;
    /*--agregar salida*/
    if (isset($_POST['input-t-pagar']) && isset($_POST['input-saldo'])) {
     
        echo ($ins_salida->registrar_salida_controlador());
    }

    
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
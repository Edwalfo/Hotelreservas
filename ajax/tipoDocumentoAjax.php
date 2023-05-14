
<?php

$peticionesAjax = true;

require_once "../config/APP.php";

if (
    isset($_POST['input-tipoDocNombre']) || isset($_POST['input-del']) || isset($_POST['input-Upid'])
) {

    /*------Instacia al controlador----------*/
    require_once "../controladores/tipodocumentoControlador.php";
    $ins_tipodocumento = new tipodocumentoControlador;
    /*--agregar tipodocumento*/
    if (isset($_POST['input-tipoDocNombre'])) {
     
        echo ($ins_tipodocumento->agregar_tipodocumento_controlador());
    }

    /*--Eliminar tipodocumento*/
    if (isset($_POST['input-del'])) {

        echo ($ins_tipodocumento->eliminar_tipodocumento_controlador());
    }

    /*--Actualizar tipodocumento*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_tipodocumento->actualizar_tipodocumento_controlador());
    }
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}
<?php

$peticionesAjax = true;

require_once "../config/APP.php";



if (isset($_POST['input-usuarioNombre']) || isset($_POST['input-del'])
    || isset($_POST['input-Upid'])) 
    {
    

    /*------Instacia al controlador----------*/
    require_once "../controladores/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();

    /*--agregar un usuario*/
    if (isset($_POST['input-usuarioNombre']) && isset($_POST['input-tipoUsuario'])) {
       // echo "<script>console.log('mensajes prueba')</script>";
        echo ($ins_usuario->agregar_usuario_controlador());
    }

    /*--Eliminar un usuario*/
    if (isset($_POST['input-del'])) {
        
        echo ($ins_usuario->eliminar_usuario_controlador());
    }
    /*--Actualizar usuario*/
    if (isset($_POST['input-Upid'])) {
        echo ($ins_usuario->actualizar_usuario_controlador());
    }
} else {
    session_start(['name' => 'SHotel']);
    session_unset();
    session_destroy();
    header("Location:" . SERVERURL . "login/");
    exit();
}

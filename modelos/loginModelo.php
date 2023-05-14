<?php
require_once "mainModel.php";

class loginModelo extends mainModel
{
    /*Modelo para iniciar sesion */

    protected static function iniciar_sesion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM usuario 
        WHERE usuario=:nUsuario AND contrasena=:pass AND estadoUsuario='activo'");



        $sql->bindParam(":nUsuario", $datos['usuario']);
        $sql->bindParam(":pass", $datos['contrasena']);
        $sql->execute();
        return $sql;
    }
}

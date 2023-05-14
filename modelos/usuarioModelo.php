<?php
require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    /*--Modelo agregar usuario--*/

    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO usuario(nombreUsuario, tipoUsuario, correoUsuario, usuario, contrasena, estadoUsuario) VALUES(:nombre, :tipo, :email, :user, :clave, :est)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":tipo", $datos['tipo']);
        $sql->bindParam(":email", $datos['email']);
        $sql->bindParam(":user", $datos['usuario']);
        $sql->bindParam(":clave", $datos['clave']);
        $sql->bindParam(":est", $datos['estado']);


        $sql->execute();


        return $sql;
    } //fin

    /*Modelo eliminar usuario */


    protected static function eliminar_usuario_modelo($id)
    {

        $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE idUsuario=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }//FIN

    /*Modelo para actualizar tipo de habitacion*/
    protected static function actualizar_usuario_modelo($datos)
    {

        $sql = mainModel::conectar()->prepare("UPDATE usuario SET 
        nombreusuario=:nombre, tipoUsuario=:tipo, correoUsuario=:email, usuario=:user, 
        contrasena=:pass ,estadoUsuario=:est WHERE idusuario=:ID");

        $sql->bindParam(":nombre", $datos['nombreUsuario']);
        $sql->bindParam(":tipo", $datos['tipoUsuario']);
        $sql->bindParam(":email", $datos['correo']);
        $sql->bindParam(":user", $datos['usuario']);
        $sql->bindParam(":pass", $datos['contrasena']);
        $sql->bindParam(":est", $datos['estado']);
        $sql->bindParam(":ID", $datos['id']);
        $sql->execute();

        return $sql;
    }//FIN

        
   
}

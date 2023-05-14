<?php
require_once "mainModel.php";


class tipoHabitacionModelo extends mainModel
{
    /* modelo agregar tipos de habitacion*/

    protected static function agregar_tipohabitacion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tipoHabitacion(nombreTipoHabitacion, valorTipoHabitacion, descripcion, estadoTipoHabitacion) 
        VALUES(:nombre, :precio, :descr, :est)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":descr", $datos['descripcion']);
        $sql->bindParam(":est", $datos['estado']);


        $sql->execute();


        return $sql;
    }


    protected static function eliminar_tipohabitacion_modelo($id)
    {

        $sql = mainModel::conectar()->prepare("DELETE FROM tipohabitacion WHERE idTipoHabitacion=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }


    /*Modelo para actualizar tipo habitacion*/
    protected static function actualizar_tipohabitacion_modelo($datos)
    {

        $sql = mainModel::conectar()->prepare("UPDATE tipohabitacion SET 
         nombreTipoHabitacion=:nombre, valorTipoHabitacion=:precio, descripcion=:descr,  
         estadoTipoHabitacion=:est WHERE idTipoHabitacion=:ID");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":precio", $datos['precio']);
        $sql->bindParam(":descr", $datos['descripcion']);
        $sql->bindParam(":est", $datos['estado']);
        $sql->bindParam(":ID", $datos['id']);
        
        $sql->execute();

        return $sql;
    } //FIN
}

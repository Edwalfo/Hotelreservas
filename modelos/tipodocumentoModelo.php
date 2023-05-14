<?php
require_once "mainModel.php";

class tipodocumentoModelo extends mainModel
{
    /* modelo agregar tipodocumento*/


    protected static function agregar_tipodocumento_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO tipodocumento(nombreTipoDocumento, estadoTipoDocumento) 
        VALUES(:nombre, :est)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":est", $datos['estado']);

        $sql->execute();


        return $sql;
    }

    /*modelo para eliminar tipodocumento*/

    protected static function eliminar_tipodocumento_modelo($id)
    {

        $sql = mainModel::conectar()->prepare("DELETE FROM tipodocumento WHERE idTipodocumento=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }


    /*Modelo para actualizar tipodocumento*/
    protected static function actualizar_tipodocumento_modelo($datos)
    {
        //var_dump($datos);
        $sql = mainModel::conectar()->prepare("UPDATE tipodocumento SET nombreTipoDocumento =:nombre, estadoTipoDocumento =:est WHERE idTipodocumento = :ID");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":est", $datos['estado']);
        $sql->bindParam(":ID", $datos['id']);

        $sql->execute();

        return $sql;
    } //FIN



}

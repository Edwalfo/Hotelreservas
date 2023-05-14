<?php
require_once "mainModel.php";

class huespedModelo extends mainModel
{

    /*--Modelo agregar huesped--*/

    protected static function agregar_huesped_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO  huesped  (nombreHuesped ,  documentoHuesped ,  fecha_nacimiento ,  
        direccionHuesped ,  telefonoHuesped ,  correoHuesped ,  estadoHuesped ,  tipodocumento_id ) 
        VALUES (:nombre, :doc, :fecha, :direc, :tel, :email, :est, :tipoDid)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":doc", $datos['ndocumento']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":direc", $datos['direccion']);
        $sql->bindParam(":tel", $datos['telefono']);
        $sql->bindParam(":email", $datos['correo']);
        $sql->bindParam(":est", $datos['estado']);
        $sql->bindParam(":tipoDid", $datos['tipoid']);


        $sql->execute();


        return $sql;
    } //fin

    /*Modelo eliminar huesped */


    protected static function eliminar_huesped_modelo($id)
    {

        $sql = mainModel::conectar()->prepare("DELETE FROM huesped WHERE idHuesped=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    } //FIN

    /*Modelo para actualizar tipo de habitacion*/
    protected static function actualizar_huesped_modelo($datos)
    {

        $sql = mainModel::conectar()->prepare("UPDATE  huesped  SET nombreHuesped= :nombre,  documentoHuesped= :doc,  
        fecha_nacimiento =:fecha,  direccionHuesped=:direc,  telefonoHuesped=:tel,  correoHuesped=:email,  
        estadoHuesped=:est,  tipodocumento_id=:tipoDid WHERE idHuesped=:ID");



        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":doc", $datos['ndocumento']);
        $sql->bindParam(":fecha", $datos['fecha']);
        $sql->bindParam(":direc", $datos['direccion']);
        $sql->bindParam(":tel", $datos['telefono']);
        $sql->bindParam(":email", $datos['correo']);
        $sql->bindParam(":est", $datos['estado']);
        $sql->bindParam(":tipoDid", $datos['tipoid']);
        $sql->bindParam(":ID", $datos['id']);
        $sql->execute();

        return $sql;
    } //FIN



}

<?php
require_once "mainModel.php";

class habitacionModelo extends mainModel
{
    /* modelo agregar habitacion*/


    protected static function agregar_habitacion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO habitacion(numeroHabitacion, estado , estadoHabitacion, tipohabitacion_id) 
        VALUES(:num, :estA, :estH, :tipoID)");

        $sql->bindParam(":num", $datos['numero']);
        $sql->bindParam(":estA", $datos['estadoA']);
        $sql->bindParam(":estH", $datos['estadoH']);
        $sql->bindParam(":tipoID", $datos['tipoid']);

        $sql->execute();


        return $sql;
    }

    /*modelo para eliminar habitacion*/

    protected static function eliminar_habitacion_modelo($id)
    {

        $sql = mainModel::conectar()->prepare("DELETE FROM habitacion WHERE idHabitacion=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();

        return $sql;
    }


    /*Modelo para actualizar habitacion*/
    protected static function actualizar_habitacion_modelo($datos)
    {


        $sql = mainModel::conectar()->prepare("UPDATE habitacion SET numeroHabitacion =:num, estado = :estA, 
        estadoHabitacion = :estH, tipohabitacion_id =:tipoID WHERE idHabitacion = :ID");

        $sql->bindParam(":num", $datos['numero']);
        $sql->bindParam(":estA", $datos['estadoA']);
        $sql->bindParam(":estH", $datos['estadoH']);
        $sql->bindParam(":tipoID", $datos['tipoid']);
        $sql->bindParam(":ID", $datos['id']);

        $sql->execute();

        return $sql;
    } //FIN

    protected static function datos_habitacion_modelo($tipo, $id)
    {
        if ($tipo == "unico") {
            $sql = mainModel::conectar()->prepare("SELECT idHabitacion,numeroHabitacion,estado,nombreTipoHabitacion,valorTipoHabitacion,descripcion
            FROM habitacion,tipohabitacion WHERE  idTipoHabitacion=tipohabitacion_id AND idHabitacion=:ID");
            $sql->bindParam(":ID", $id);
        } elseif ($tipo == "conteo") {
            $sql = mainModel::conectar()->prepare("SELECT idHabitacion FROM habitacion");
        } elseif ($tipo == "salida") {
            $sql = mainModel::conectar()->prepare("SELECT 
            idHabitacion,numeroHabitacion,estado,nombreTipoHabitacion,valorTipoHabitacion,
            idReserva,fecha_ingreso,fecha_salida,estadoReservacion,
            huesped_id,nombreHuesped,documentoHuesped,telefonoHuesped,correoHuesped,
            nombreTipoDocumento,
            idFactura, valor_efectivo, valor_tarjeta,valor_transferencia,valor_otros,descuento,valortotal
            FROM habitacion,tipohabitacion,reserva,huesped,tipodocumento,factura WHERE 
            idReserva= reserva_id AND
            tipodocumento_id=idTipodocumento AND
             huesped_id=idHuesped AND 
             habitacion_id=idHabitacion AND 
             idTipoHabitacion=tipohabitacion_id AND 
             estado=2 AND estadoReservacion=2 AND
             idHabitacion=:ID");
            $sql->bindParam(":ID", $id);
        }


        $sql->execute();
        return $sql;
    }



    protected static function limpiar_habitacion_modelo($datos)
    {

        $sql = mainModel::conectar()->prepare("UPDATE habitacion SET estado = :estA WHERE idHabitacion = :ID_Hab");


        $sql->bindParam(":estA", $datos['estadoA']);
        $sql->bindParam(":ID_Hab", $datos['habitacion_id']);
        $sql->execute();



        return $sql;
    }
}

<?php
require_once "mainModel.php";

class hospedajeModelo extends mainModel
{

    /*--Modelo agregar huesped--*/

    protected static function agregar_hospedaje_modelo($datos)
    {
        $conn = mainModel::conectar();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        try {
            //tabla reserva
            $sql = $conn->prepare("INSERT INTO reserva (fecha_reserva, fecha_ingreso, fecha_salida, numeroReserva, estadoReservacion, 
            huesped_id, habitacion_id, estadoReserva) 
            VALUES (:FECHAR, :FECHAI,:FECHAS,:NUM,:ESTR,:HuesID ,:HabID,:EST)");

            $sql->bindParam(":FECHAR", $datos['fecha_reserva']);
            $sql->bindParam(":FECHAI", $datos['fecha_ingreso']);
            $sql->bindParam(":FECHAS", $datos['fecha_salida']);
            $sql->bindParam(":NUM", $datos['numero']);
            $sql->bindParam(":ESTR", $datos['estado_reservacion']);
            $sql->bindParam(":HuesID", $datos['huesped_id']);
            $sql->bindParam(":HabID", $datos['habitacion_id']);
            $sql->bindParam(":EST", $datos['estado']);
            $sql->execute();
            $lastid = $conn->lastInsertId();


            //tabla factura
            $sql = $conn->prepare("INSERT INTO factura(numeroFactura, fecha, valor_efectivo, valor_tarjeta, valor_transferencia, valor_otros, descuento,
            valortotal, impuesto, estadoFactura, reserva_id) 
            VALUES(:NUM,:FECHA, :EFECTIVO, :TARJETA, :TRANSF, :OTROS, :DESCU, :TOTAL, :IMP, :EST, :R_ID)");

            $sql->bindParam(":NUM", $datos['numeroFactura']);
            $sql->bindParam(":FECHA", $datos['fecha']);
            $sql->bindParam(":EFECTIVO", $datos['valor_efectivo']);
            $sql->bindParam(":TARJETA", $datos['valor_tarjeta']);
            $sql->bindParam(":TRANSF", $datos['valor_transferencia']);
            $sql->bindParam(":OTROS", $datos['valor_otros']);
            $sql->bindParam(":DESCU", $datos['descuento']);
            $sql->bindParam(":TOTAL", $datos['valortotal']);
            $sql->bindParam(":IMP", $datos['impuesto']);
            $sql->bindParam(":EST", $datos['estadoFactura']);
            $sql->bindParam(":R_ID", $lastid);
            $sql->execute();

            //actualizar estado habitacion
            $sql = $conn->prepare("UPDATE habitacion SET estado = :estA WHERE idHabitacion = :ID_Hab");

            $sql->bindParam(":estA", $datos['estadoA']);
            $sql->bindParam(":ID_Hab", $datos['habitacion_id']);


            $sql->execute();

            $conn->commit();
            return $sql;
        } catch (PDOException $e) {
            $conn->rollback();
            return $sql;
        }
    }
}

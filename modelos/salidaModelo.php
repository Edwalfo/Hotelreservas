<?php
require_once "mainModel.php";

class salidaModelo extends mainModel
{

    /*--Modelo agregar huesped--*/

    protected static function registrar_salida_modelo($datos)
    {
        $conn = mainModel::conectar();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        try {

            //actualizar estado habitacion
            $sql = $conn->prepare("UPDATE habitacion SET estado = :estA WHERE idHabitacion = :ID_Hab");
            $sql->bindParam(":estA", $datos['estadoA']);
            $sql->bindParam(":ID_Hab", $datos['habitacion_id']);
            $sql->execute();

            $sql = $conn->prepare("UPDATE reserva SET estadoReservacion = :estR WHERE idReserva = :ID_Res");
            $sql->bindParam(":estR", $datos['estadoReservacion']);
            $sql->bindParam(":ID_Res", $datos['idReserva']);
            $sql->execute();

            $sql = $conn->prepare("UPDATE factura SET valor_efectivo =:vefec, valor_tarjeta=:vtarj, valor_transferencia=:vtran, valor_otros=:votro, valortotal=:vtotal 
            WHERE idFactura = :ID_Fac");
            $sql->bindParam(":vefec", $datos['valor_efectivo']);
            $sql->bindParam(":vtarj", $datos['valor_tarjeta']);
            $sql->bindParam(":vtran", $datos['valor_transferencia']);
            $sql->bindParam(":votro", $datos['valor_otro']);
            $sql->bindParam(":vtotal", $datos['valortotal']);
            $sql->bindParam(":ID_Fac", $datos['idFactura']);
            $sql->execute();



            $conn->commit();
            return $sql;
        } catch (PDOException $e) {
            $conn->rollback();
            return $sql;
        }
    }
}

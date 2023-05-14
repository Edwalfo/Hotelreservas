<?php
require_once "mainModel.php";

class reservaModelo extends mainModel
{

    /*--Modelo agregar reserva--*/

    protected static function agregar_reserva_modelo($datos)
    {


        $sql = mainModel::conectar()->prepare("INSERT INTO reserva (fecha_reserva, fecha_ingreso, fecha_salida, numeroReserva, estadoReservacion, huesped_id, habitacion_id, estadoReserva) 
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


        return $sql;
    } //fin

    protected static function agregar_reserva_huesped_modelo($datos)
    {
        $conn = mainModel::conectar();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->beginTransaction();

        try {

            $sql = $conn->prepare("INSERT INTO  huesped  (nombreHuesped ,  documentoHuesped ,  fecha_nacimiento ,  
        direccionHuesped ,  telefonoHuesped ,  correoHuesped ,  estadoHuesped ,  tipodocumento_id ) 
        VALUES (:nombre, :doc, :fecha, :direc, :tel, :email, :estH, :tipoDid)");

            $sql->bindParam(":nombre", $datos['nombre']);
            $sql->bindParam(":doc", $datos['ndocumento']);
            $sql->bindParam(":fecha", $datos['fecha']);
            $sql->bindParam(":direc", $datos['direccion']);
            $sql->bindParam(":tel", $datos['telefono']);
            $sql->bindParam(":email", $datos['correo']);
            $sql->bindParam(":estH", $datos['estado']);
            $sql->bindParam(":tipoDid", $datos['tipoid']);
            $sql->execute();
            $lastidhuesped = $conn->lastInsertId();

            //registrar reserva
            $sql = $conn->prepare("INSERT INTO reserva (fecha_reserva, fecha_ingreso, fecha_salida, numeroReserva, 
            estadoReservacion, huesped_id, habitacion_id, estadoReserva) 
            VALUES (:FECHAR, :FECHAI,:FECHAS,:NUM,:ESTR,:HuesID ,:HabID,:EST)");
            $sql->bindParam(":FECHAR", $datos['fecha_reserva']);
            $sql->bindParam(":FECHAI", $datos['fecha_ingreso']);
            $sql->bindParam(":FECHAS", $datos['fecha_salida']);
            $sql->bindParam(":NUM", $datos['numero']);
            $sql->bindParam(":ESTR", $datos['estado_reservacion']);
            $sql->bindParam(":HuesID", $lastidhuesped);
            $sql->bindParam(":HabID", $datos['habitacion_id']);
            $sql->bindParam(":EST", $datos['estado']);
            $sql->execute();
            $lastidreserva = $conn->lastInsertId();

            $sql = $conn->prepare("UPDATE habitacion SET estado = :estA WHERE idHabitacion = :ID_Hab");
            $sql->bindParam(":estA", $datos['estadoA']);
            $sql->bindParam(":ID_Hab", $datos['habitacion_id']);
            $sql->execute();

            $sql = $conn->prepare("INSERT INTO factura(numeroFactura, fecha, valor_efectivo, valor_tarjeta, valor_transferencia, valor_otros, descuento,
            valortotal, impuesto, estadoFactura, reserva_id) 
            VALUES(:NUM,:FECHA, :EFECTIVO, :TARJETA, :TRANSF, :OTROS, :DESCU, :TOTAL, :IMP, :ESTf, :R_ID)");

            $sql->bindParam(":NUM", $datos['numeroFactura']);
            $sql->bindParam(":FECHA", $datos['fecha_reserva']);
            $sql->bindParam(":EFECTIVO", $datos['valor_efectivo']);
            $sql->bindParam(":TARJETA", $datos['valor_tarjeta']);
            $sql->bindParam(":TRANSF", $datos['valor_transferencia']);
            $sql->bindParam(":OTROS", $datos['valor_otros']);
            $sql->bindParam(":DESCU", $datos['descuento']);
            $sql->bindParam(":TOTAL", $datos['valortotal']);
            $sql->bindParam(":IMP", $datos['impuesto']);
            $sql->bindParam(":ESTf", $datos['estado']);
            $sql->bindParam(":R_ID", $lastidreserva);
            $sql->execute();

            $conn->commit();
            return $sql;
        } catch (PDOException $e) {
            $conn->rollback();
            return $sql;
        }
    }

    protected static function datos_reserva_modelo($tipo, $id)
    {
        if ($tipo == "unico") {
            $sql = mainModel::conectar()->prepare("SELECT 
            numeroHabitacion,nombreTipoHabitacion,
            fecha_ingreso,fecha_salida,numeroReserva,
            nombreHuesped,documentoHuesped,correoHuesped,
            nombreTipoDocumento
            FROM habitacion,tipohabitacion,reserva,huesped,tipodocumento WHERE 
            tipodocumento_id=idTipodocumento AND
             huesped_id=idHuesped AND 
             habitacion_id=idHabitacion AND 
             idTipoHabitacion=tipohabitacion_id AND 
             numeroReserva=:ID");
            $sql->bindParam(":ID", $id);
        }

        $sql->execute();
        return $sql;
    }
}

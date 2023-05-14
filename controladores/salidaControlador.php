<?php

if ($peticionesAjax) {
    require_once "../modelos/salidaModelo.php";
} else {
    require_once "./modelos/salidaModelo.php";
}

class salidaControlador extends salidaModelo
{
    /*controlador agregar salida*/

    public function registrar_salida_controlador()
    {

        $idhabitacion = mainModel::limpiar_cadena($_POST['input-idhabitacion']);
        $idreserva = mainModel::limpiar_cadena($_POST['input-idreserva']);
        $idfactura = mainModel::limpiar_cadena($_POST['input-idfactura']);
        $total = mainModel::limpiar_cadena($_POST['input-t-pagar']);
        $penalida = mainModel::limpiar_cadena($_POST['input-penalidad']);

        //traer datos de la BD
        $check_factura = mainModel::ejecutar_consulta_simples("SELECT * FROM factura WHERE idFactura ='$idfactura'");
        if ($check_factura->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro registro del factura en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $camposfactura = $check_factura->fetch();
        }

        if ($_POST['input-efectivo']) {
            $efectivo = mainModel::limpiar_cadena($_POST['input-efectivo']);
            if (mainModel::verificar_datos("[0-9]+", $efectivo)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor efectivo agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $efectivo = $efectivo + $camposfactura['valor_efectivo'];
            }
        } else {
            $efectivo =  $camposfactura['valor_efectivo'];
        }

        if ($_POST['input-tarjeta']) {
            $tarjeta = mainModel::limpiar_cadena($_POST['input-tarjeta']);
            if (mainModel::verificar_datos("[0-9]+", $tarjeta)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor tarjeta agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $tarjeta = $tarjeta + $camposfactura['valor_tarjeta'];
            }
        } else {
            $tarjeta = $camposfactura['valor_tarjeta'];
        }

        if ($_POST['input-transferencia']) {
            $transferencia = mainModel::limpiar_cadena($_POST['input-transferencia']);
            if (mainModel::verificar_datos("[0-9]+", $transferencia)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor transferencia agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $transferencia = $transferencia + $camposfactura['valor_transferencia'];
            }
        } else {
            $transferencia = $camposfactura['valor_transferencia'];
        }
        if ($_POST['input-otros']) {
            $otros = mainModel::limpiar_cadena($_POST['input-otros']);

            if (mainModel::verificar_datos("[0-9]+", $otros)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor otros agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                $otros = $otros + $camposfactura['valor_otros'];
            }
        } else {
            $otros = $camposfactura['valor_otros'];
        }
        if ($penalida < 0 || $total < 0 || $efectivo < 0 || $tarjeta < 0 || $transferencia < 0 || $otros < 0) {


            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El valor agregado no cumple con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $valorpagado = $efectivo + $tarjeta + $transferencia + $otros;
        $total = $penalida + $camposfactura['valortotal'];

        if ($valorpagado < $total) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede realizar este proceso porque aun no se paga completamente el costo de la factura",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } elseif ($valorpagado > $total) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede realizar este proceso porque ha sobrepasado el costo de la factura",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        $datos_salida_reg = [
            "estadoA" => "4",
            "habitacion_id" => $idhabitacion,
            "estadoReservacion" => "3",
            "idReserva" => $idreserva,
            "valor_efectivo" => $efectivo,
            "valor_tarjeta" => $tarjeta,
            "valor_transferencia" => $transferencia,
            "valoe_otro" => $otros,
            "valortotal" => $total,
            "idFactura" => $idfactura

        ];


        $agregar_salida = salidaModelo::registrar_salida_modelo($datos_salida_reg);


        if ($agregar_salida->rowCount() == 1) {

            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "checkout/"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar la salida",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}

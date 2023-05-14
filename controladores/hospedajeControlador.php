<?php

if ($peticionesAjax) {
    require_once "../modelos/hospedajeModelo.php";
} else {
    require_once "./modelos/hospedajeModelo.php";
}

class hospedajeControlador extends hospedajeModelo
{
    /*controlador agregar hospedaje*/

    public function agregar_hospedaje_controlador()

    {
        //traer datos huesped de la BD


        $idhuesped = $_POST['select-huespedes'];
        $check_huesped = mainModel::ejecutar_consulta_simples("SELECT * FROM huesped WHERE idHuesped ='$idhuesped'");
        if ($check_huesped->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro registro del huesped en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //traer datos habitacion de la BD
        $idhabitacion = $_POST['inputid-Habitacion'];
        $idhabitacion = mainModel::limpiar_cadena($idhabitacion);
        $check_habitacion = mainModel::ejecutar_consulta_simples("SELECT * FROM habitacion WHERE idHabitacion ='$idhabitacion'");
        if ($check_habitacion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro la habitacion en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_habitacion->fetch();
        }

        if ($campos['estado'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No puede realizar este proceso a una habitacion no disponible",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        //Verificar fechas entradas y salidas

        $fecha_entrada = $_POST['fechaEntrada'];
        $fecha_salida = $_POST['fechaSalida'];


        /*--Comprobar campos vacios--*/



        if ($fecha_entrada == "" || $fecha_salida == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }


        if (mainModel::verificar_fechas($fecha_entrada)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La fecha de entrada no cumple con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_fechas($fecha_salida)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La fecha de salida no cumple con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $codigoReserva = mainModel::generar_cadena_aleatoria();
        do {

            $checkNumero = mainModel::ejecutar_consulta_simples("SELECT numeroReserva FROM reserva WHERE numeroReserva='$codigoReserva'");

            if ($checkNumero->rowCount() > 0) {

                $codigoReserva = mainModel::generar_cadena_aleatoria();
            }
            $valor = $codigoReserva;
        } while ($codigoReserva != $valor);

        $fecha_reserva = date("Y-m-d");

        $difFecha = mainModel::calcular_diferencia_fechas($fecha_entrada, $fecha_salida);
        if ($difFecha == 0) {
            $difFecha = 1;
        }

        //Vericar datos facturacion

        $totalAlojamiento = mainModel::limpiar_cadena($_POST['input-total-alojamiento']);
        $descuento = mainModel::limpiar_cadena($_POST['input-descuento']);
        $total = mainModel::limpiar_cadena($_POST['inputTotal']);

        if (isset($_POST['input-efectivo'])) {
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
            }
        } else {
            $efectivo = 0;
        }

        if (isset($_POST['input-tarjeta'])) {
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
            }
        } else {
            $tarjeta = 0;
        }

        if (isset($_POST['input-transferencia'])) {
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
            }
        } else {
            $transferencia = 0;
        }
        if (isset($_POST['input-tarjeta'])) {
            $otros = mainModel::limpiar_cadena($_POST['input-otros']);
            if (mainModel::verificar_datos("[0-9]+", $tarjeta)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor otros agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        } else {
            $otros = 0;
        }


        $checkNfactura = mainModel::ejecutar_consulta_simples("SELECT numeroFactura FROM factura ORDER by numeroFactura DESC LIMIT 1");

        if ($checkNfactura->rowCount() > 0) {
            $factura = $checkNfactura->fetchAll();

            foreach ($factura as $row) {
                $numeroFactura = $row['numeroFactura'] + 1;
            }
        } else {
            $numeroFactura = 1;
        }



        if ($descuento != "" || $total != "" || $efectivo != "" || $tarjeta != "" || $transferencia != "" || $otros != "") {
            if ($descuento < 0 || $total < 0 || $efectivo < 0 || $tarjeta < 0 || $transferencia < 0 || $otros < 0) {


                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El valor agregado no cumple con el formato",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($descuento == "" && $total == 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Verifique el valor de descuento y el total",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if($descuento==""){
            $descuento=0;
        }

        $precioHabitacion = mainModel::limpiar_cadena($_POST['inputprecio-Habitacion']);

        $costoAlojamieto = $difFecha * $precioHabitacion;
        if ($costoAlojamieto != $totalAlojamiento) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Verifique el costo alojamiento",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($descuento > $costoAlojamieto) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El descuento no puede ser mayor al costo alojamiento",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $total = $costoAlojamieto - $descuento;

        $totalpago = $efectivo + $tarjeta + $transferencia + $otros;

        if ($efectivo > $total || $tarjeta > $total || $transferencia > $total || $otros > $total || $totalpago > $total) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El valor de pago no puede ser mayor al costo total",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $datos_hospedaje_reg = [
            "fecha_reserva" => $fecha_reserva,
            "fecha_ingreso" => $fecha_entrada,
            "fecha_salida" => $fecha_salida,
            "numero" => $codigoReserva,
            "estado_reservacion" => 2,
            "huesped_id" => $idhuesped,
            "habitacion_id" => $idhabitacion,
            "estado" => "activo",
            "numeroFactura" => $numeroFactura,
            "fecha" => $fecha_reserva,
            "valor_efectivo" => $efectivo,
            "valor_tarjeta" => $tarjeta,
            "valor_transferencia" => $transferencia,
            "valor_otros" => $otros,
            "descuento" => $descuento,
            "valortotal" => $total,
            "impuesto" => 0,
            "estadoFactura" => "activo",
            "estadoA" => 2

        ];



        $agregar_hospedaje = hospedajeModelo::agregar_hospedaje_modelo($datos_hospedaje_reg);


        if ($agregar_hospedaje->rowCount() == 1) {

            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "recepcion/"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el hospedaje",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}

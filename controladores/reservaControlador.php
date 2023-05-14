<?php

if ($peticionesAjax) {
    require_once "../modelos/reservaModelo.php";
} else {
    require_once "./modelos/reservaModelo.php";
}


class reservaControlador extends reservaModelo
{

    public function agregar_reserva_controlador()
    {
        $fecha_entrada = mainModel::limpiar_cadena($_POST['input-fechaentrada']);
        $fecha_salida = mainModel::limpiar_cadena($_POST['input-fechasalida']);


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

        $numero = mainModel::generar_cadena_aleatoria();
        do {

            $checkNumero = mainModel::ejecutar_consulta_simples("SELECT numeroReserva FROM reserva WHERE numeroReserva='$numero'");

            if ($checkNumero->rowCount() > 0) {

                $numero = mainModel::generar_cadena_aleatoria();
            }
            $valor = $numero;
        } while ($numero != $valor);


        $fecha_reserva = date("Y-m-d");

        $datos_reserva_reg = [
            "fecha_reserva" => $fecha_reserva,
            "fecha_ingreso" => $fecha_entrada,
            "fecha_salida" => $fecha_salida,
            "numero" => $numero,
            "estado_reservacion" => 1,
            "huesped_id" => 6,
            "habitacion_id" => NULL,
            "estado" => "activo"

        ];




        $agregar_reserva = reservaModelo::agregar_reserva_modelo($datos_reserva_reg);

        if ($agregar_reserva->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "La reserva ha sido creada con exito",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo crear la reserva",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }//FIN
    public function paginador_reserva_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
    {
    }//FIN

    public function eliminar_reserva_controlador()
    {
    }//FIN

    public function actualizar_reserva_controlador()
    {
    }//FIN

    public function agregar_reserva_huesped_controlador()
    {
        /*--Limpiar datos enviados en el formulario--*/
        $nombre = mainModel::limpiar_cadena($_POST['input-huespedNombre2']);
        $documento = mainModel::limpiar_cadena($_POST['input-nDocumento2']);
        $feha_nacimiento = mainModel::limpiar_cadena($_POST['input-fNacimiento2']);
        $direccion = mainModel::limpiar_cadena($_POST['input-Direccion2']);
        $telefono = mainModel::limpiar_cadena($_POST['input-Telefono2']);
        $correo = mainModel::limpiar_cadena($_POST['input-correo2']);
        $tipo_doc = mainModel::limpiar_cadena($_POST['input-tipoDocumento2']);

        /*--Comprobar campos vacios--*/

        if ($nombre == "" || $documento == "" || $feha_nacimiento == "" || $tipo_doc == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        /*--Comprobar si los campos corresponde al formato--*/

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9+]{1,15}", $documento)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        /*----comprobar si existe ya alguien con ese numero--*/

        /*
        $checkdocumento = mainModel::ejecutar_consulta_simples("SELECT documentoHuesped,tipodocumento_id FROM huesped 
        WHERE  documentoHuesped='$documento' AND tipodocumento_id='$tipo_doc'");
        if ($checkdocumento->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Ya existe este huesped en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }*/




        if (mainModel::verificar_fechas($feha_nacimiento)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "La fecha no cumple con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $checkedad = mainModel::calcular_edad($feha_nacimiento);
        if ($checkedad < 18) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede registrar un menor de edad",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,60}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ingrese un direccion valida con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El numero de telefono np coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        if ($correo != "") {
            if (filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ingreso un formato de correo no valido",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        $checkhuesped = mainModel::ejecutar_consulta_simples("SELECT idTipodocumento FROM tipodocumento WHERE idTipodocumento ='$tipo_doc'");
        if ($checkhuesped->rowCount() == 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El tipo documento ingresado no esta disponible por favor seleccione uno valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $fecha_entrada = mainModel::limpiar_cadena($_POST['inputcheckin2']);
        $fecha_salida = mainModel::limpiar_cadena($_POST['inputcheckout2']);


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

        $numero = mainModel::generar_cadena_aleatoria();
        do {

            $checkNumero = mainModel::ejecutar_consulta_simples("SELECT numeroReserva FROM reserva WHERE numeroReserva='$numero'");

            if ($checkNumero->rowCount() > 0) {

                $numero = mainModel::generar_cadena_aleatoria();
            }
            $valor = $numero;
        } while ($numero != $valor);


        $fecha_reserva = date("Y-m-d");



        $tipohabitacion = mainModel::limpiar_cadena($_POST['input-tipoHabitacion']);
        $costo_habitacion = mainModel::ejecutar_consulta_simples("SELECT valorTipoHabitacion FROM tipohabitacion 
        WHERE  idTipoHabitacion='$tipohabitacion'");
        if ($costo_habitacion->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El tipo de habitacion no esta disponible",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $getcosto = $costo_habitacion->fetch();
            $costo = $getcosto['valorTipoHabitacion'];
        }


        $diasreserva = mainModel::calcular_diferencia_fechas($fecha_entrada, $fecha_salida);
        if ($diasreserva < 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Verifique que la fecha de salida no sea inferior a la fecha de entrada",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $dato_habitacion = mainModel::ejecutar_consulta_simples("SELECT idHabitacion FROM habitacion,tipohabitacion 
        WHERE tipohabitacion_id=idTipoHabitacion AND tipohabitacion_id='$tipohabitacion' AND estado=1 LIMIT 1");


        if ($dato_habitacion->rowCount() > 0) {


            $gethabitacion = $dato_habitacion->fetch();
            $idhabitacion = $gethabitacion['idHabitacion'];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Lo sentimos, no hay habitaciones disponibles",
                "Tipo" => "info"
            ];
            echo json_encode($alerta);
            exit();
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

        $costoreserva = $diasreserva * $costo;


        $datos_reserva_reg = [
            "nombre" => $nombre,
            "ndocumento" => $documento,
            "fecha" => $feha_nacimiento,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "correo" => $correo,
            "estado" => "activo",
            "tipoid" => $tipo_doc,
            "fecha_reserva" => $fecha_reserva,
            "fecha_ingreso" => $fecha_entrada,
            "fecha_salida" => $fecha_salida,
            "numero" => $numero,
            "estado_reservacion" => 1,
            "habitacion_id" => $idhabitacion,
            "estadoA" => 5,
            "numeroFactura" => $numeroFactura,
            "valor_efectivo" => 0,
            "valor_tarjeta" => $costoreserva,
            "valor_transferencia" => 0,
            "valor_otros" => 0,
            "descuento" => 0,
            "valortotal" => $costoreserva,
            "impuesto" => 0,
        ];





        $agregar_reserva = reservaModelo::agregar_reserva_huesped_modelo($datos_reserva_reg);

        if ($agregar_reserva->rowCount() == 1) {


            $datos = mainModel::encryption($numero);
            /*
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "La reserva ha sido creada con exito",
                "Tipo" => "success"
            ];*/
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "datosreserva/$datos"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo crear la reserva",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }//FIN

    public function consultar_reserva_controlador()
    {
        if ($_POST['id_tipo']) {

            $id = $_POST['id_tipo'];

            if ($id != 0) {
                $dato_costo = mainModel::ejecutar_consulta_simples("SELECT valorTipoHabitacion from tipohabitacion WHERE idTipoHabitacion='$id'");
                if ($dato_costo->rowCount() > 0) {


                    $getcosto = $dato_costo->fetch();
                    $costo = $getcosto['valorTipoHabitacion'];
                } else {
                    $costo = "";
                }
            }
        }
        return $costo;
    }//FIN

    public function datos_reserva_controlador($tipo, $numero)
    {
        $tipo = mainModel::limpiar_cadena($tipo);
        $numero = mainModel::decryption($numero);
        $numero = mainModel::limpiar_cadena($numero);
        return reservaModelo::datos_reserva_modelo($tipo, $numero);
    } //FIN
}

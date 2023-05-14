<?php

if ($peticionesAjax) {
    require_once "../modelos/huespedModelo.php";
} else {
    require_once "./modelos/huespedModelo.php";
}

class huespedControlador extends huespedModelo
{
    /*controlador agregar huesped*/

    public function agregar_huesped_controlador()
    {
        /*--Limpiar datos enviados en el formulario--*/
        $nombre = mainModel::limpiar_cadena($_POST['input-huespedNombre']);
        $documento = mainModel::limpiar_cadena($_POST['input-nDocumento']);
        $feha_nacimiento = mainModel::limpiar_cadena($_POST['input-fNacimiento']);
        $direccion = mainModel::limpiar_cadena($_POST['input-Direccion']);
        $telefono = mainModel::limpiar_cadena($_POST['input-Telefono']);
        $correo = mainModel::limpiar_cadena($_POST['input-correo']);
        $tipo_doc = mainModel::limpiar_cadena($_POST['input-tipoDocumento']);

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
        }




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



        $datos_huesped_reg = [
            "nombre" => $nombre,
            "ndocumento" => $documento,
            "fecha" => $feha_nacimiento,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "correo" => $correo,
            "estado" => "activo",
            "tipoid" => $tipo_doc,
        ];



        $agregar_huesped = huespedModelo::agregar_huesped_modelo($datos_huesped_reg);


        if ($agregar_huesped->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "huesped registrado",
                "Texto" => "Los datos del huesped han sido registrado con exito",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el huesped",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    public function paginador_huesped_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registro = mainModel::limpiar_cadena($registro);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);



        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);
        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registro) - $registro) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM huesped";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM huesped";
        }

        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas = ceil($total / $registro);


        $tabla .= '
        <table id="huesped" class="table display 
        nowrap table-striped w-100 shadow rounded table-bordered table-hover">
            <thead class="thead-inverse bg-info">
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Tipo documento</th>
                <th scope="col">Nº Documento</th>
                <th scope="col">Edad</th>
                <th scope="col">Dirección</th>
                <th scope="col">Telefono</th>
                <th scope="col">Correo</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody>';


        $check_tipoD = mainModel::ejecutar_consulta_simples("SELECT idTipodocumento, nombreTipoDocumento FROM tipodocumento");




        if ($check_tipoD->rowCount() > 0) {
            $datosTipo = $check_tipoD->fetchAll();
        }



        if ($total >= 1 && $pagina <= $Npaginas) {


            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;

            //$DateAndTime = $Object->format("Y-m-d");
            foreach ($datos as $rows) {

                $huesped = $rows['idHuesped'] . "-" .
                    $rows['nombreHuesped'] . "-" .
                    $rows['tipodocumento_id'] . "-" .
                    $rows['documentoHuesped'] . "-" .
                    $rows['fecha_nacimiento'] . "-" .
                    $rows['direccionHuesped'] . "-" .
                    $rows['telefonoHuesped'] . "-" .
                    $rows['correoHuesped'] . "-" .
                    $rows['estadoHuesped'];



                $rows['edad'] = mainModel::calcular_edad($rows['fecha_nacimiento']);

                //Mostrar tipos de Documento
                foreach ($datosTipo as $tipo) {


                    if ($check_tipoD->rowCount() > 0) {
                        if ($rows['tipodocumento_id'] == $tipo['idTipodocumento']) {
                            $rows['tipodocumento_id'] = '<span">' . $tipo['nombreTipoDocumento'] . '</span>';
                        }
                    }
                }

                if ($rows['estadoHuesped'] == 'activo') {
                    $rows['estadoHuesped'] = '<span class="badge bg-success">Activo</span>';
                } else {
                    $rows['estadoHuesped'] = '<span class="badge bg-danger">Inactivo</span>';
                }

                $tabla .= ' 
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['idHuesped'] . '</td>
                    <td>' . $rows['nombreHuesped'] . '</td>
                    <td>' . $rows['tipodocumento_id'] . '</td>
                    <td>' . $rows['documentoHuesped'] . '</td>
                    <td>' . $rows['edad'] . '</td>
                    <td>' . $rows['direccionHuesped'] . '</td>
                    <td>' . $rows['telefonoHuesped'] . '</td>
                    <td>' . $rows['correoHuesped'] . '</td>
                    <td>' . $rows['estadoHuesped'] . '</td>
                    <td>
                        <div class="d-flex">
                            <form class="FormularioAjax" method="POST" action="' . SERVERURL . 'ajax/huespedAjax.php" data-form="delete" autocomplete="off">
                                <input type=hidden name="input-del" value="' . mainModel::encryption($rows['idHuesped']) . '">
                                <button type="submit" class="btn btn-danger btn-sm" name="eliminar">
                                    <i class="bi bi-x-circle"></i></button>
                            </form>
                            &nbsp
                            <button type="button" class="btn btn-primary btn-sm edictarhuesped"  value="' . $huesped . '" data-bs-toggle="modal" data-bs-target="#model-upHuesped">
                                <i class="bi bi-pencil"></i></button>

                               
                        </div>
                    </td>
                </tr>
                ';

                $contador++;
                require_once "./vistas/Modals/modalUpdatehuesped.php";
            }

            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="8"><a href="' . $url . '" class="btn btn-secondary btn-primary btn-sm">Clic aqui para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="8">No existen registros</td></tr>';
            }
        }
        $tabla .= ' </tbody></table>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-end text-muted">Mostrando huesped 
            ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        } else {
            # code...
        }

        return $tabla;
    } //FIN

    /*controlador eliminar huesped*/
    public function eliminar_huesped_controlador()
    {
        //recuperando id huesped

        $id = mainModel::decryption($_POST['input-del']);
        $id = mainModel::limpiar_cadena($id);

        //Comprobar relacion con huespedes

        $check_huesped = mainModel::ejecutar_consulta_simples(
            "SELECT idReserva FROM reserva WHERE idReserva='$id' LIMIT 1"
        );

        if ($check_huesped->rowCount() > 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede eliminar esta habitación porque esta relacionada a una reserva, se recomienda 
                deshabilitarla",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        session_start(['name' => 'SHotel']);
        if ($_SESSION['tipo_SHotel'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No tiene permiso para realizar esta operacion",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        $eliminarhuesped = huespedModelo::eliminar_huesped_modelo($id);
        if ($eliminarhuesped->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "huesped eliminado",
                "Texto" => "El huesped fue eliminada del sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo eliminar el huesped, intente de nuevo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    /*controlador actualizar huesped*/

    public function actualizar_huesped_controlador()
    {
        $id = $_POST['input-Upid'];
        $id = mainModel::limpiar_cadena($id);

        //traer datos de la BD
        $check_huesped = mainModel::ejecutar_consulta_simples("SELECT * FROM huesped WHERE idHuesped ='$id'");
        if ($check_huesped->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro registro del huesped en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_huesped->fetch();
        }
       

        $nombre = mainModel::limpiar_cadena($_POST['input-uphuespedNombre']);
        $direccion = mainModel::limpiar_cadena($_POST['input-upDireccion']);
        $telefono = mainModel::limpiar_cadena($_POST['input-upTelefono']);
        $correo = mainModel::limpiar_cadena($_POST['input-upcorreo']);
        $ndocumento = mainModel::limpiar_cadena($_POST['input-upnDocumento']);
        $tipo_doc = mainModel::limpiar_cadena($_POST['input-uptipoDocumento']);
        $feha_nacimiento = mainModel::limpiar_cadena($_POST['input-upfNacimiento']);
        $estado_huesped= mainModel::limpiar_cadena($_POST['input-upestadohuesped']);

        if ($nombre == "" || $ndocumento == "" || $tipo_doc == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

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
        if (mainModel::verificar_datos("[0-9+]{1,15}", $ndocumento)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($campos['documentoHuesped'] != $ndocumento || $campos['tipodocumento_id'] != $tipo_doc) {
            $checkdocumento = mainModel::ejecutar_consulta_simples("SELECT documentoHuesped,tipodocumento_id FROM huesped 
            WHERE  documentoHuesped='$ndocumento' AND tipodocumento_id='$tipo_doc'");
            if ($checkdocumento->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ya existe este huesped en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

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

        if ($campos['fecha_nacimiento'] != $feha_nacimiento) {
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

        if ($estado_huesped != 'activo' && $estado_huesped != 'inactivo') {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_huesped_up = [
            "nombre" => $nombre,
            "ndocumento" => $ndocumento,
            "fecha" => $feha_nacimiento,
            "direccion" => $direccion,
            "telefono" => $telefono,
            "correo" => $correo,
            "estado" =>$estado_huesped,
            "tipoid" => $tipo_doc,
            "id" => $id
        ];

       

       

    if (huespedModelo::actualizar_huesped_modelo($datos_huesped_up)) {
        $alerta = [
            "Alerta" => "recargar",
            "Titulo" => "Datos actualizados",
            "Texto" => "Los datos fueron actualizados con exito",
            "Tipo" => "success"
        ];
    } else {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrio un error inesperado",
            "Texto" => "No se pudo actualizar los datos, intentelo de nuevo",
            "Tipo" => "error"
        ];
    }
    echo json_encode($alerta);
    }

    public function generar_huesped_controlador()
    {
     
        $check_usuario = mainModel::ejecutar_consulta_simples("SELECT * FROM huesped");
       

        $select = "";
        if ($check_usuario->rowCount() <= 0) {
            $select .= ' <option value="0"  disabled="" selected>Sin registros</option>';
        } else {


            $gethuespedes = $check_usuario->fetchAll();
            //$select .= ' <option value="0" >Seleccione una opción</option>';
            foreach ($gethuespedes as $row) {
                
                $select .= ' <option value="' . $row['idHuesped'] . '">'. $row['documentoHuesped'] .' - '. $row['nombreHuesped'] . '</option>';
            }
        }

        return $select;
    }
}

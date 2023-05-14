<?php

if ($peticionesAjax) {
    require_once "../modelos/tipoHabitacionModelo.php";
} else {
    require_once "./modelos/tipoHabitacionModelo.php";
}

class tipoHabitacionControlador extends tipoHabitacionModelo
{
    public function agregar_tipohabitacion_controlador()
    {
        /*limpiar datos recibidos*/

        $nombreTipo = mainModel::limpiar_cadena($_POST['input-tipoNombre']);
        $costo = mainModel::limpiar_cadena($_POST['input-costoTipo']);
        $descripcion = mainModel::limpiar_cadena($_POST['input-descripcion']);

        /*comprobar si estan vacios*/
        /*--Comprobar campos vacios--*/

        if ($nombreTipo == "" || $costo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }


        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}", $nombreTipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]+", $costo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El costo agregado no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($descripcion != "") {
            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{5,100}", $descripcion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "La descripcion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        $checkTipo = mainModel::ejecutar_consulta_simples("SELECT nombreTipoHabitacion FROM tipoHabitacion WHERE nombreTipoHabitacion ='$nombreTipo'");
        if ($checkTipo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Ya existe este usuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_tipohabitacion_reg = [
            "nombre" => $nombreTipo,
            "precio" => $costo,
            "descripcion" => $descripcion,
            "estado" => "activo"
        ];


        $agregar_tipo = tipoHabitacionModelo::agregar_tipohabitacion_modelo($datos_tipohabitacion_reg);

        if ($agregar_tipo->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "El tipo se habitación ha sido registrado con exito",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el tipo de habitacion",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } //FIN

    public function paginador_tipohabitacion_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipoHabitacion";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipoHabitacion";
        }


        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas = ceil($total / $registro);

        $tabla .= '
        <table id="tipohabitacion" class="table display 
        nowrap table-striped w-100 shadow rounded table-bordered table-hover">
            <thead class="thead-inverse bg-info">
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Costo</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody>';


        if ($total >= 1 && $pagina <= $Npaginas) {


            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {


                $tipos = $rows['idTipoHabitacion'] . "-" . $rows['nombreTipoHabitacion'] . "-" . $rows['valorTipoHabitacion'] . "-" . $rows['descripcion'] . "-" . $rows['estadoTipoHabitacion'];

                if ($rows['estadoTipoHabitacion'] == 'activo') {
                    $rows['estadoTipoHabitacion'] = '<span class="badge bg-success">Activo</span>';
                } else {
                    $rows['estadoTipoHabitacion'] = '<span class="badge bg-danger">Inactivo</span>';
                }


                $tabla .= ' 
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['idTipoHabitacion'] . '</td>
                    <td>' . $rows['nombreTipoHabitacion'] . '</td>
                    <td>' . $rows['valorTipoHabitacion'] . '</td>
                    <td>' . $rows['descripcion'] . '</td>
                    <td>' . $rows['estadoTipoHabitacion'] . '</td>
                    <td>
                        <div class="d-flex">
                            <form class="FormularioAjax" method="POST" action="' . SERVERURL . 'ajax/tipohabitacionAjax.php" data-form="delete" autocomplete="off">
                                <input type=hidden name="input-del" value="' . mainModel::encryption($rows['idTipoHabitacion']) . '">
                                <button type="submit" class="btn btn-danger btn-sm" name="eliminar">
                                    <i class="bi bi-x-circle"></i></button>
                            </form>
                            &nbsp
                            <button type="button" class="btn btn-primary btn-sm edictarTipohabitacion"  value="' . $tipos . '" data-bs-toggle="modal" data-bs-target="#model-upCategoria">
                                <i class="bi bi-pencil"></i></button>

                               
                        </div>
                    </td>
                </tr>
                ';

                $contador++;
                require_once "./vistas/Modals/modalUpdateThabitacion.php";
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
            $tabla .= '<p class="text-end text-muted">Mostrando usuario 
            ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        } else {
            # code...
        }

        return $tabla;
    } //FIN

    /*Controlador para eliminar usuario*/

    public function eliminar_tipohabitacion_controlador()
    {
        //recuperando id usuario

        $id = mainModel::decryption($_POST['input-del']);
        $id = mainModel::limpiar_cadena($id);


        //Comprobar relacion con habitaciones

        $check_habitacion = mainModel::ejecutar_consulta_simples(
            "SELECT tipoHabitacion_id FROM habitacion WHERE tipoHabitacion_id='$id' LIMIT 1"
        );

        if ($check_habitacion->rowCount() > 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede eliminar este tipo de habitación porque esta relacionado a las habitaciones, se recomienda 
                deshabilitarlo si no desea utilizarlo",
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

        $eliminarTipohabitacion = tipoHabitacionModelo::eliminar_tipohabitacion_modelo($id);
        if ($eliminarTipohabitacion->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario eliminado",
                "Texto" => "El tipo de habitacion fue eliminada del sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo eliminar el tipo de habitacion, intente de nuevo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } //FIN


    public function actualizar_tipohabitacion_controlador()
    {

        $id = $_POST['input-Upid'];
        $id = mainModel::limpiar_cadena($id);

        //traer datos de la BD
        $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT * FROM tipohabitacion WHERE idTipoHabitacion='$id'");
        if ($check_tipoH->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro el tipo de habitacion en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_tipoH->fetch();
        }

        $nombreThabitacion = mainModel::limpiar_cadena($_POST['input-tipoNombreH']);
        $costo = mainModel::limpiar_cadena($_POST['input-upcostoTipo']);
        $descripcion = mainModel::limpiar_cadena($_POST['input-updescripcion']);



        if (isset($_POST['input-upEstadoHtipo'])) {
            $estado_Thabitacion = mainModel::limpiar_cadena($_POST['input-upEstadoHtipo']);
        } else {
            $estado_Thabitacion = $campos['estado'];
        }

        if ($nombreThabitacion == "" || $costo  == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}", $nombreThabitacion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9]+", $costo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El costo agregado no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($descripcion != "") {
            if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{5,100}", $descripcion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "La descripcion no coincide con el formato solicitado",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if ($estado_Thabitacion != 'activo' && $estado_Thabitacion != 'inactivo') {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($nombreThabitacion != $campos['nombreTipoHabitacion']) {
            $check_user = mainModel::ejecutar_consulta_simples("SELECT nombreTipoHabitacion FROM tipohabitacion WHERE nombreTipoHabitacion ='$nombreThabitacion'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ya existe este tipo de habitacion en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*Prepar datos para enviarlos al modelo */
        $datos_thabitacion_up = [
            "nombre" => $nombreThabitacion,
            "precio" => $costo,
            "descripcion" => $descripcion,
            "estado" => $estado_Thabitacion,
            "id" => $id
        ];

        if (tipoHabitacionModelo::actualizar_tipohabitacion_modelo($datos_thabitacion_up)) {
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

    /*Controlador para mostrar los tipo de habitacion*/
    public function generar_tiposhabitacion_controlador($indicacion)
    {

        if ($indicacion == "add") {

            $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT * FROM tipohabitacion WHERE estadoTipoHabitacion='activo'");
        } else {

            $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT * FROM tipohabitacion");
        }

        $select = "";
        if ($check_tipoH->rowCount() <= 0) {
            $select .= ' <option value="0"  disabled="">Registre tipos de habitacion</option>';
        } else {

            $gettipos = $check_tipoH->fetchAll();
            $select .= ' <option value="0" >Seleccione el tipo</option>';
            foreach ($gettipos as $row) {

                $select .= ' <option value="' . $row['idTipoHabitacion'] . '">' . $row['nombreTipoHabitacion'] . '</option>';
            }
        }

        return $select;
    }
}

<?php


if ($peticionesAjax) {
    require_once "../modelos/tipodocumentoModelo.php";
} else {
    require_once "./modelos/tipodocumentoModelo.php";
}

class tipodocumentoControlador extends tipodocumentoModelo
{
    public function agregar_tipodocumento_controlador()
    {

        $nombreTipo = mainModel::limpiar_cadena($_POST['input-tipoDocNombre']);
        if ($nombreTipo == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }
        
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{4,45}", $nombreTipo)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        
        $checkTipo = mainModel::ejecutar_consulta_simples("SELECT nombreTipoDocumento FROM tipodocumento WHERE nombreTipoDocumento ='$nombreTipo'");
        if ($checkTipo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Ya existe este tipo documento en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $datos_tipodocumento_reg = [
            "nombre" => $nombreTipo,
            "estado" => "activo"
        ];


        $agregar_tipo = tipodocumentoModelo::agregar_tipodocumento_modelo($datos_tipodocumento_reg);


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
                "Texto" => "No se pudo registrar el tipo de documento",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    public function paginador_tipodocumento_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipodocumento";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM tipodocumento";
        }


        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas = ceil($total / $registro);

        $tabla .= '
        <table id="tipodocumento" class="table display 
        nowrap table-striped w-100 shadow rounded table-bordered table-hover">
            <thead class="thead-inverse bg-info">
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody>';


        if ($total >= 1 && $pagina <= $Npaginas) {


            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {


                $tipos = $rows['idTipodocumento'] . "-" .
                    $rows['nombreTipoDocumento'] . "-" .
                    $rows['estadoTipoDocumento'];

                if ($rows['estadoTipoDocumento'] == 'activo') {
                    $rows['estadoTipoDocumento'] = '<span class="badge bg-success">Activo</span>';
                } else {
                    $rows['estadoTipoDocumento'] = '<span class="badge bg-danger">Inactivo</span>';
                }


                $tabla .= ' 
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['idTipodocumento'] . '</td>
                    <td>' . $rows['nombreTipoDocumento'] . '</td>
                    <td>' . $rows['estadoTipoDocumento'] . '</td>
                    <td>
                        <div class="d-flex">
                            <form class="FormularioAjax" method="POST" action="' . SERVERURL . 'ajax/tipoDocumentoAjax.php" data-form="delete" autocomplete="off">
                                <input type=hidden name="input-del" value="' . mainModel::encryption($rows['idTipodocumento']) . '">
                                <button type="submit" class="btn btn-danger btn-sm" name="eliminar">
                                    <i class="bi bi-x-circle"></i></button>
                            </form>
                            &nbsp
                            <button type="button" class="btn btn-primary btn-sm edictarTipodocumento"  value="' . $tipos . '" data-bs-toggle="modal" data-bs-target="#model-uptipodocumento">
                                <i class="bi bi-pencil"></i></button>

                               
                        </div>
                    </td>
                </tr>
                ';

                $contador++;
                require_once "./vistas/Modals/modalUpdateTdocumento.php";
            }

            $reg_final = $contador - 1;
        } else {
            if ($total >= 1) {
                $tabla .= '<tr class="text-center"><td colspan="5"><a href="' . $url . '" class="btn btn-secondary btn-primary btn-sm">Clic aqui para recargar el listado</a></td></tr>';
            } else {
                $tabla .= '<tr class="text-center"><td colspan="5">No existen registros</td></tr>';
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
    public function eliminar_tipodocumento_controlador()
    {
        //recuperando id usuario

        $id = mainModel::decryption($_POST['input-del']);
        $id = mainModel::limpiar_cadena($id);


        //Comprobar relacion conodocumentoes

        $checkodocumento = mainModel::ejecutar_consulta_simples(
            "SELECT tipodocumento_id FROM huesped WHERE tipodocumento_id ='$id' LIMIT 1"
        );

        if ($checkodocumento->rowCount() > 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se puede eliminar este tipo documento porque esta relacionado con huespedes, se recomienda 
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

        $eliminarTipodocumento = tipodocumentoModelo::eliminar_tipodocumento_modelo($id);
        if ($eliminarTipodocumento->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario eliminado",
                "Texto" => "El tipo de documento fue eliminada del sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo eliminar el tipo deodocumento, intente de nuevo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } //FIN
    public function actualizar_tipodocumento_controlador()
    {
        $id = $_POST['input-Upid'];
        $id = mainModel::limpiar_cadena($id);

        //traer datos de la BD
        $check_tipoD = mainModel::ejecutar_consulta_simples("SELECT * FROM tipodocumento WHERE idTipodocumento='$id'");
        if ($check_tipoD->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro el tipo de documento en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_tipoD->fetch();
        }

        $nombreTdocumento = mainModel::limpiar_cadena($_POST['input-uptipoDocNombre']);

        if (isset($_POST['input-upestadoTdoc'])) {
            $estado_Tdocumento = mainModel::limpiar_cadena($_POST['input-upestadoTdoc']);
        } else {
            $estado_Tdocumento = $campos['estado'];
        }

        if ($nombreTdocumento == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ0-9 ]{4,45}", $nombreTdocumento)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($estado_Tdocumento != 'activo' && $estado_Tdocumento != 'inactivo') {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($nombreTdocumento != $campos['nombreTipoDocumento']) {
            $check_user = mainModel::ejecutar_consulta_simples("SELECT nombreTipoDocumento FROM tipodocumento WHERE nombreTipoDocumento ='$nombreTdocumento'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ya existe este tipo de documento en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        /*Prepar datos para enviarlos al modelo */
        $datos_tdocumento_up = [
            "nombre" => $nombreTdocumento,
            "estado" => $estado_Tdocumento,
            "id" => $id
        ];



        if (tipodocumentoModelo::actualizar_tipodocumento_modelo($datos_tdocumento_up)) {
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
    } //FIN

    /*Controlador para mostrar los tipo de document*/
    public function generar_tiposdocumento_controlador($indicacion)
    {
        if ($indicacion == "add") {
            $check_tipoD = mainModel::ejecutar_consulta_simples("SELECT * FROM tipodocumento WHERE estadoTipoDocumento='activo'");
        } else {
            $check_tipoD = mainModel::ejecutar_consulta_simples("SELECT * FROM tipodocumento");
        }


        $select = "";
        if ($check_tipoD->rowCount() <= 0) {
            $select .= ' <option value="0"  disabled="" selected>Registre tipos de documento</option>';
        } else {


            $gettipos = $check_tipoD->fetchAll();
            $select .= ' <option value="0" >Seleccione un tipo</option>';
            foreach ($gettipos as $row) {

                
                $select .= ' <option value="' . $row['idTipodocumento'] . '">' . $row['nombreTipoDocumento'] . '</option>';
            }
        }

        return $select;
    }
}

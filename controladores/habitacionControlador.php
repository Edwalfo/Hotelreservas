<?php

if ($peticionesAjax) {
    require_once "../modelos/habitacionModelo.php";
} else {
    require_once "./modelos/habitacionModelo.php";
}


class habitacionControlador extends habitacionModelo
{

    public function agregar_habitacion_controlador()
    {
        $tipoHabitacion = mainModel::limpiar_cadena($_POST['input-tipoHabitacion']);
        //$estadoA = mainModel::limpiar_cadena($_POST['input-estadoactual']);
        $estadoA = 1;
        $numero = mainModel::limpiar_cadena($_POST['input-numero']);

        /*--Comprobar campos vacios--*/

        if ($tipoHabitacion == "" || $estadoA == "" || $numero == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($tipoHabitacion <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No ha seleccionado un tipo de habitacion",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($estadoA <= 0 && $estadoA > 5) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No ha seleccionado un estado",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($estadoA == 2 || $estadoA == 5) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No puede crear una habitacion con el estado seleccionado",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($numero <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El numero de habitacion no cumple con el formato",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }



        $checkNumero = mainModel::ejecutar_consulta_simples("SELECT numeroHabitacion FROM Habitacion WHERE numeroHabitacion ='$numero'");
        if ($checkNumero->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El numero de habitacion ya esta en uso",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $checkinactivo = mainModel::ejecutar_consulta_simples("SELECT estadoTipoHabitacion FROM tipoHabitacion WHERE idTipoHabitacion=$tipoHabitacion  
        AND estadoTipoHabitacion='inactivo'");

        if ($checkinactivo->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No puede crear esta habitacion por que el tipo seleccionado esta inactivo",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $datos_habitacion_reg = [
            "numero" => $numero,
            "estadoA" => 1,
            "estadoH" => "activo",
            "tipoid" => $tipoHabitacion
        ];


        $agregar_habitacion = habitacionModelo::agregar_habitacion_modelo($datos_habitacion_reg);

        if ($agregar_habitacion->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "La habitación ha sido creada con exito",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo crear la habitacion",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }

    public function paginador_habitacion_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM habitacion ORDER BY numeroHabitacion ASC
            ";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM habitacion ORDER BY numeroHabitacion ASC";
        }


        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas = ceil($total / $registro);

        $tabla .= '
        <table id="habitacion" class="table display 
        nowrap table-striped w-100 shadow rounded table-bordered table-hover">
            <thead class="thead-inverse bg-info">
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Numero</th>
                <th scope="col">Estado habitacion</th>
                <th scope="col">Estado</th>
                <th scope="col">Tipo</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody>';


        if ($total >= 1 && $pagina <= $Npaginas) {


            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;

            $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT idTipoHabitacion, nombreTipoHabitacion FROM tipohabitacion");

            if ($check_tipoH->rowCount() > 0) {
                $datosTipo = $check_tipoH->fetchAll();
            }



            foreach ($datos as $rows) {


                $habid = $rows['idHabitacion'] . "-" . $rows['numeroHabitacion'] . "-" . $rows['estado'] . "-" . $rows['estadoHabitacion'] . "-" . $rows['tipohabitacion_id'];

                if ($rows['estadoHabitacion'] == 'activo') {
                    $rows['estadoHabitacion'] = '<span class="badge bg-success">Activo</span>';
                } else {
                    $rows['estadoHabitacion'] = '<span class="badge bg-danger">Inactivo</span>';
                }

                //Mostrar tipos de habitacion
                foreach ($datosTipo as $tipo) {

                    if ($check_tipoH->rowCount() > 0) {
                        if ($rows['tipohabitacion_id'] == $tipo['idTipoHabitacion']) {
                            $rows['tipohabitacion_id'] = '<span">' . $tipo['nombreTipoHabitacion'] . '</span>';
                        }
                    }
                }

                if ($rows['estado'] == '1') {
                    $rows['estado'] = '<span class="badge bg-success">Disponible</span>';
                } elseif ($rows['estado'] == '2') {
                    $rows['estado'] = '<span class="badge bg-primary">Ocupada</span>';
                } elseif ($rows['estado'] == '3') {
                    $rows['estado'] = '<span class="badge bg-danger">Reparacion</span>';
                } elseif ($rows['estado'] == '4') {
                    $rows['estado'] = '<span class="badge bg-secondary">Sucia</span>';
                } else {
                    $rows['estado'] = '<span class="badge bg-warning text-dark">Reservada</span>';
                }



                $tabla .= ' 
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['idHabitacion'] . '</td>
                    <td>' . $rows['numeroHabitacion'] . '</td>
                    <td>' . $rows['estado'] . '</td>
                    <td>' . $rows['estadoHabitacion'] . '</td>
                    <td>' . $rows['tipohabitacion_id'] . '</td>
                    <td>
                        <div class="d-flex">
                            <form class="FormularioAjax" method="POST" action="' . SERVERURL . 'ajax/habitacionAjax.php" data-form="delete" autocomplete="off">
                                <input type=hidden name="input-del" value="' . mainModel::encryption($rows['idHabitacion']) . '">
                                <button type="submit" class="btn btn-danger btn-sm" name="eliminar">
                                    <i class="bi bi-x-circle"></i></button>
                            </form>
                            &nbsp
                            <button type="button" class="btn btn-primary btn-sm edictarHabitacion"  value="' . $habid . '" data-bs-toggle="modal" data-bs-target="#model-upHabitacion">
                                <i class="bi bi-pencil"></i></button>     
                        </div>
                    </td>
                </tr>
                ';

                $contador++;
                require_once "./vistas/Modals/modalUpdateHabitacion.php";
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
    }

    public function eliminar_habitacion_controlador()
    {
        //recuperando id usuario

        $id = mainModel::decryption($_POST['input-del']);
        $id = mainModel::limpiar_cadena($id);


        //Comprobar relacion con habitaciones

        $check_habitacion = mainModel::ejecutar_consulta_simples(
            "SELECT idReserva FROM reserva WHERE idReserva='$id' LIMIT 1"
        );

        if ($check_habitacion->rowCount() > 0) {

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

        $eliminarhabitacion = habitacionModelo::eliminar_habitacion_modelo($id);
        if ($eliminarhabitacion->rowCount() == 1) {
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
                "Texto" => "No se pudo eliminar la habitacion, intente de nuevo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    }
    public function actualizar_habitacion_controlador()
    {
        $id = $_POST['input-Upid'];
        $id = mainModel::limpiar_cadena($id);

        //traer datos de la BD
        $check_habitacion = mainModel::ejecutar_consulta_simples("SELECT * FROM habitacion WHERE idHabitacion ='$id'");
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

        $numero = mainModel::limpiar_cadena($_POST['input-upnumero']);

        if (isset($_POST['input-upEstado'])) {
            $estado_habitacion = mainModel::limpiar_cadena($_POST['input-upEstado']);
        } else {
            $estado_habitacion = $campos['estadoHabitacion'];
        }

        if ($estado_habitacion != 'activo' && $estado_habitacion != 'inactivo') {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        if (isset($_POST['input-tipoHabitacion'])) {
            $tipoHabitacion  = mainModel::limpiar_cadena($_POST['input-tipoHabitacion']);

            if ($tipoHabitacion <= 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "No ha seleccionado un tipo de habitacion",
                    "Tipo" => "error"
                ];

                echo json_encode($alerta);
                exit();
            }
        } else {
            $tipoHabitacion  = $campos['tipohabitacion_id'];
        }




        if (isset($_POST['input-upestadoactual'])) {
            $estadoA = mainModel::limpiar_cadena($_POST['input-upestadoactual']);
            if ($estadoA <= 0 && $estadoA > 5) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "No ha seleccionado un estado",
                    "Tipo" => "error"
                ];

                echo json_encode($alerta);
                exit();
            }
        } else {
            $estadoA = $campos['estado'];
        }



        if ($numero == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No lleno todos los campos que son obligatorios",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($numero <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El numero de habitacion no cumple con el formato",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        if ($numero != $campos['numeroHabitacion']) {
            $checkNumero = mainModel::ejecutar_consulta_simples("SELECT numeroHabitacion FROM Habitacion WHERE numeroHabitacion ='$numero'");
            if ($checkNumero->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "El numero de habitacion ya esta en uso",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        $datos_habitacion_up = [
            "numero" => $numero,
            "estadoA" => $estadoA,
            "estadoH" => $estado_habitacion,
            "tipoid" => $tipoHabitacion,
            "id" => $id
        ];


        if (habitacionModelo::actualizar_habitacion_modelo($datos_habitacion_up)) {

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

    public function mostrar_habitacion_controlador()
    {

        $trae_habitaciones = mainModel::ejecutar_consulta_simples("SELECT * FROM habitacion");
        $card = "";

        if ($trae_habitaciones->rowCount() <= 0) {
            $card .= '<h4 class="text-muted text center">No se han creado habitaciones.<h4>';
        } else {

            $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT idTipoHabitacion, nombreTipoHabitacion FROM tipohabitacion");

            if ($check_tipoH->rowCount() > 0) {
                $datosTipo = $check_tipoH->fetchAll();
            }

            require_once "./vistas/Modals/modalFormlimpiar.php";

            $datos = $trae_habitaciones->fetchAll();
            foreach ($datos as $rows) {


                if ($rows['estado'] == '1') {
                    $rows['estado'] = '<a href="' . SERVERURL . 'asignarhabitacion/' . mainModel::encryption($rows['idHabitacion']) . '" class="text-dark">Disponible</a>';
                    $rows['color'] = 'success';
                } elseif ($rows['estado'] == '2') {
                    $rows['estado'] = 'Ocupada';
                    $rows['color'] = 'primary';
                    $rows['text'] = 'primary';
                } elseif ($rows['estado'] == '3') {
                    $rows['estado'] = 'Reparación';
                    $rows['color'] = 'danger';
                } elseif ($rows['estado'] == '4') {
                    $enviarLimpiar = $rows['idHabitacion'] . "-" . $rows['numeroHabitacion'];
                    $rows['estado'] = '<a type="button" class="text-dark aLimpiar" rel="' . $enviarLimpiar . '" data-bs-toggle="modal" data-bs-target="#modal-limpiar">Sucia</a>';
                    $rows['color'] = 'secondary';
                } else {
                    $rows['estado'] = 'Reservada';
                    $rows['color'] = 'warning';
                }
                //Mostrar tipos de habitacion
                foreach ($datosTipo as $tipo) {

                    if ($check_tipoH->rowCount() > 0) {
                        if ($rows['tipohabitacion_id'] == $tipo['idTipoHabitacion']) {
                            $rows['tipohabitacion_id'] = $tipo['nombreTipoHabitacion'];
                        }
                    }
                }

                if ($rows['estadoHabitacion'] == 'activo') {
                    $card .= '<div class="col-6 col-sm-4 col-lg-4 col-xl-3 col-xxl-2">
                    <div class="card  bg-' . $rows['color'] . ' habitaciones h-100">
                    <div class="card-body text-light py-4">
                      
                        <div class="row">
                            <div class="col-6">
                
                            <h1 class="fw-bold ">' . $rows['numeroHabitacion'] . '</h1>
                            ' . $rows['tipohabitacion_id'] . '
                            </div>
                            <div class="col-6">
                                <img src="' . SERVERURL . 'vistas/img/hotel-bed.png" class="img-fluid  alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center  bg-light fw-bolder">
                
                        ' . $rows['estado'] . '
                        <i class="bi bi-chevron-right"></i>
                
                    </div>
                </div>
                </div>';
                }
            }
        }

        return $card;
    } //FIN

    public function mostrar_habitacion_ocupadas_controlador()
    {

        $trae_habitaciones = mainModel::ejecutar_consulta_simples("SELECT * FROM habitacion WHERE estado=2");
        $card = "";

        if ($trae_habitaciones->rowCount() <= 0) {
            $card .= '<h4 class="text-muted text-center">No se existe habitaciones ocupadas en este momento.<h4>';
        } else {

            $check_tipoH = mainModel::ejecutar_consulta_simples("SELECT idTipoHabitacion, nombreTipoHabitacion FROM tipohabitacion");

            if ($check_tipoH->rowCount() > 0) {
                $datosTipo = $check_tipoH->fetchAll();
            }

            require_once "./vistas/Modals/modalFormlimpiar.php";

            $datos = $trae_habitaciones->fetchAll();
            foreach ($datos as $rows) {



                $rows['estado'] = '<a href="' . SERVERURL . 'verificarsalida/' . mainModel::encryption($rows['idHabitacion']) . '" class="text-dark">Ver detalles</a>';
                $rows['color'] = 'orange';


                //Mostrar tipos de habitacion
                foreach ($datosTipo as $tipo) {

                    if ($check_tipoH->rowCount() > 0) {
                        if ($rows['tipohabitacion_id'] == $tipo['idTipoHabitacion']) {
                            $rows['tipohabitacion_id'] = $tipo['nombreTipoHabitacion'];
                        }
                    }
                }

                if ($rows['estadoHabitacion'] == 'activo') {
                    $card .= '<div class="col-6 col-sm-4 col-mb-2 col-lg-4 col-xl-3 col-xxl-2">
                    <div class="card  bg-' . $rows['color'] . ' habitaciones h-100">
                    <div class="card-body text-light py-4">
                      
                        <div class="row">
                            <div class="col-6">
                
                            <h1 class="fw-bold ">' . $rows['numeroHabitacion'] . '</h1>
                            ' . $rows['tipohabitacion_id'] . '
                            </div>
                            <div class="col-6">
                                <img src="' . SERVERURL . 'vistas/img/hotel-bed.png" class="img-fluid  alt="">
                            </div>
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-center  bg-light fw-bolder">
                
                        ' . $rows['estado'] . '
                        <i class="bi bi-chevron-right"></i>
                
                    </div>
                </div>
                </div>';
                }
            }
        }

        return $card;
    } //FIN

    public function datos_habitacion_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);
        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return habitacionModelo::datos_habitacion_modelo($tipo, $id);
    } //FIN



    public function limpiar_habitacion_controlador()
    {

        $id = $_POST['input-idhabitacion'];
        $id = mainModel::limpiar_cadena($id);


        $datos_habitacion_up = [
            "estadoA" => 1,
            "habitacion_id" => $id
        ];


        if (habitacionModelo::limpiar_habitacion_modelo($datos_habitacion_up)) {

            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Datos actualizados",
                "Texto" => "La habitación esta disponible",
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
}

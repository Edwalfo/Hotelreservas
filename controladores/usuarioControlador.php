<?php

if ($peticionesAjax) {
    require_once "../modelos/usuarioModelo.php";
} else {
    require_once "./modelos/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    /*controlador agregar usuario*/

    public function agregar_usuario_controlador()
    {
        /*--Limpiar datos enviados en el formulario--*/
        $nombre = mainModel::limpiar_cadena($_POST['input-usuarioNombre']);
        $tipoUser = mainModel::limpiar_cadena($_POST['input-tipoUsuario']);
        $correoUser = mainModel::limpiar_cadena($_POST['input-correoUsuario']);
        $usuario = mainModel::limpiar_cadena($_POST['input-user']);
        $passUser1 = mainModel::limpiar_cadena($_POST['input-usuarioPassword']);
        $passUser2 = mainModel::limpiar_cadena($_POST['input-usuarioPassword2']);



        /*--Comprobar campos vacios--*/

        if ($nombre == "" || $tipoUser == "" || $usuario == ""|| $passUser1 == ""  || $passUser2 == "") {
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
        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre de usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        if (mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{5,60}", $passUser1) || mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{5,60}", $passUser2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El formato de contraseña no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /*----comprobar campos unicos --*/

        $checkUsuario = mainModel::ejecutar_consulta_simples("SELECT Usuario FROM usuario WHERE Usuario ='$usuario'");
        if ($checkUsuario->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Ya existe este usuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }



        if ($correoUser != "") {
            if (filter_var($correoUser, FILTER_VALIDATE_EMAIL)) {
                $checkCorreo = mainModel::ejecutar_consulta_simples("SELECT correoUsuario FROM usuario WHERE correoUsuario ='$correoUser'");
                if ($checkCorreo->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "Ya existe una cuenta de usuario asociada a ese correo",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
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

        if ($passUser1 != $passUser2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Las contraseñas ingresadas no coinciden",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $passUser1 = mainModel::encryption($passUser1);
        }

        /*--Comprobar privilegio---*/

        if ($tipoUser < 1 || $tipoUser > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El privilegio seleccionado no es valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        

       

        $datos_usuario_reg = [
            "nombre" => $nombre,
            "tipo" => $tipoUser,
            "email" => $correoUser,
            "usuario"=> $usuario,
            "clave" => $passUser1,
            "estado" => "activo"
        ];


        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);


        if ($agregar_usuario->rowCount() == 1) {

            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del usuario han sido registrado con exito",
                "Tipo" => "success"
            ];
        } else {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo registrar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } //Fin controladores


    /*--Controlador paginar usuario-*/

    public function paginador_usuario_controlador($pagina, $registro, $privilegio, $id, $url, $busqueda)
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
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((idusuario!='$id'
            AND idusuario!='1') AND(nombreUsuario LIKE '%$busqueda%' OR correo LIKE '%$busqueda%') ) 
            ORDER BY nombreUsuario ASC LIMIT $inicio, $registro";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE idusuario!='$id'
            AND idusuario!='1' ORDER BY idusuario ASC LIMIT $inicio, $registro";
        }


        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $Npaginas = ceil($total / $registro);

        $tabla .= '
        <table id="usuarios" class="table display 
        nowrap table-striped w-100 shadow rounded table-bordered table-hover">
            <thead class="thead-inverse bg-info">
                <th scope="col">N°</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre Completo</th>
                <th scope="col">Tipo usuario</th>
                <th scope="col">Correo</th>
                <th scope="col">Usuario</th>
                <th scope="col">Estado</th>
                <th scope="col">Opciones</th>
            </thead>
            <tbody>';


        if ($total >= 1 && $pagina <= $Npaginas) {



            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {



                $usuario = $rows['idusuario'] . "-" . $rows['nombreUsuario'] . "-" . $rows['tipoUsuario'] . "-" . $rows['correoUsuario'] . "-" . $rows['usuario']. "-" . $rows['contrasena'] . "-" . $rows['estadoUsuario'];


                if ($rows['tipoUsuario'] == 1) {
                    $rows['tipoUsuario'] = '<span class="badge bg-warning text-dark">Administrador</span>';
                } else {
                    $rows['tipoUsuario'] = '<span class="badge bg-info text-dark">Recepcionista</span>';
                }

                if ($rows['estadoUsuario'] == 'activo') {
                    $rows['estadoUsuario'] = '<span class="badge bg-success">Activo</span>';
                } else {
                    $rows['estadoUsuario'] = '<span class="badge bg-danger">Inactivo</span>';
                }


                $tabla .= ' 
                <tr>
                    <th scope="row">' . $contador . '</th>
                    <td>' . $rows['idusuario'] . '</td>
                    <td>' . $rows['nombreUsuario'] . '</td>
                    <td>' . $rows['tipoUsuario'] . '</td>
                    <td>' . $rows['correoUsuario'] . '</td>
                    <td>' . $rows['usuario'] . '</td>
                    <td>' . $rows['estadoUsuario'] . '</td>
                    <td>
                        <div class="d-flex">
                            <form class="FormularioAjax" method="POST" action="' . SERVERURL . 'ajax/usuarioAjax.php" data-form="delete" autocomplete="off">
                                <input type=hidden name="input-del" value="' . mainModel::encryption($rows['idusuario']) . '">
                                <button type="submit" class="btn btn-danger btn-sm" name="eliminar">
                                    <i class="bi bi-x-circle"></i></button>
                            </form>
                            &nbsp
                            <button type="button" class="btn btn-primary btn-sm edictarUsuario"  value="' . $usuario . '" data-bs-toggle="modal" data-bs-target="#model-updateUsuario">
                                <i class="bi bi-pencil"></i></button>

                               
                        </div>
                    </td>
                </tr>
                ';

                $contador++;
                require_once "./vistas/Modals/modalUpdateUsuario.php";
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

    public function eliminar_usuario_controlador()
    {
        //recuperando id usuario

        $id = mainModel::decryption($_POST['input-del']);
        $id = mainModel::limpiar_cadena($id);

        //comprabar el usuario
        if ($id == 1) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No puede eliminar el usuario principal del sistema",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }

        //Comprobar usuario en la BD

        $check_usuario = mainModel::ejecutar_consulta_simples(
            "SELECT idusuario FROM usuario WHERE idusuario='$id'"
        );

        if ($check_usuario->rowCount() <= 0) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El que intenta eliminar no existe",
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

        $eliminarUsuario = usuarioModelo::eliminar_usuario_modelo($id);
        if ($eliminarUsuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario eliminado",
                "Texto" => "El usuario fue eliminado del sistema",
                "Tipo" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se pudo eliminar el usuario, intente de nuevo",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
    } //FIN

    /*Controlador para actualizar usuario*/
    public function actualizar_usuario_controlador()
    {

        $id = $_POST['input-Upid'];
        $id = mainModel::limpiar_cadena($id);

        $check_user = mainModel::ejecutar_consulta_simples("SELECT * FROM usuario WHERE idusuario='$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "No se encontro el usuario en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch();
        }

        
        $nombreUser = mainModel::limpiar_cadena($_POST['input-UpusuarioNombre']);
        $correoUser = mainModel::limpiar_cadena($_POST['input-UpcorreoUsuario']);
        $usuario= mainModel::limpiar_cadena($_POST['input-upUser']);
        $admin_User = mainModel::limpiar_cadena($_POST['input-adminNombre']);
        $admin_pass = mainModel::limpiar_cadena($_POST['input-adminPassword']);


        if (isset($_POST['input-UpEstado'])) {
            $estado_user = mainModel::limpiar_cadena($_POST['input-UpEstado']);
        } else {
            $estado_user = $campos['estado'];
        }

        if (isset($_POST['input-UptipoUsuario'])) {
            $tipoUser = mainModel::limpiar_cadena($_POST['input-UptipoUsuario']);
        } else {
            $tipoUser = $campos['tipoUsuario'];
        }

        if ($nombreUser == "" ||$usuario == "" || $tipoUser == "" || $admin_pass == ""  ||  $admin_User == "") {
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
      
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,45}", $nombreUser)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{4,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $admin_User)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El nombre de usuario no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{5,60}", $admin_pass)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El formato de contraseña no coincide con el formato solicitado",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        $admin_pass = mainModel::encryption($admin_pass);

        if ($tipoUser < 1 || $tipoUser > 3) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El privilegio no corresponde a un valor valido",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($estado_user != 'activo' && $estado_user != 'inactivo') {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "El estado de la cuenta no coincide con el formato",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        if ($usuario != $campos['usuario']) {
            $check_user = mainModel::ejecutar_consulta_simples("SELECT usuario FROM usuario WHERE usuario ='$usuario'");
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Ya existe este usuario en el sistema",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        if ($correoUser != $campos['correoUsuario']) {
            if ($correoUser != "") {
                if (filter_var($correoUser, FILTER_VALIDATE_EMAIL)) {
                    $check_Correo = mainModel::ejecutar_consulta_simples("SELECT correoUsuario FROM usuario WHERE correoUsuario ='$correoUser'");
                    if ($check_Correo->rowCount() > 0) {
                        $alerta = [
                            "Alerta" => "simple",
                            "Titulo" => "Ocurrio un error inesperado",
                            "Texto" => "Ya existe una cuenta de usuario asociada a ese correo",
                            "Tipo" => "error"
                        ];
                        echo json_encode($alerta);
                        exit();
                    }
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
        }




        if ($_POST['input-UpusuarioPassword'] != "" || $_POST['input-UpusuarioPassword2'] != "") {
            if ($_POST['input-UpusuarioPassword'] != $_POST['input-UpusuarioPassword2']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "Las nuevas claves no coinciden",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                if (
                    mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{5,60}", $_POST['input-UpusuarioPassword']) ||
                    mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{5,60}", $_POST['input-UpusuarioPassword2'])
                ) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrio un error inesperado",
                        "Texto" => "Las contraseñas no coninciden con el formato",
                        "Tipo" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }

                $passUser = mainModel::limpiar_cadena($_POST['input-UpusuarioPassword']);

                if ($passUser != $campos['contrasena']) {
                    $passUser = mainModel::encryption($_POST['input-UpusuarioPassword']);
                }
            }
        } else {

            $passUser = $campos['contrasena'];
        }

        session_start(['name' => 'SHotel']);

        /*
        if ($_SESSION['id_SHotel'] != $id) {
            $tipo_cuenta = "impropia";
        } else {
            $tipo_cuenta = "propia";
        }*/




        if ($_SESSION['id_SHotel'] == $id) {
            $check_cuenta = mainModel::ejecutar_consulta_simples("SELECT idusuario FROM usuario WHERE
            usuario='$admin_User' AND contrasena='$admin_pass' AND idusuario='$id'");
        } else {
            if ($_SESSION['tipo_SHotel'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrio un error inesperado",
                    "Texto" => "No tienes los permisos para realizar esta tarea",
                    "Tipo" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_cuenta = mainModel::ejecutar_consulta_simples("SELECT idusuario FROM usuario WHERE  
            usuario='$admin_User' AND contrasena='$admin_pass'");
        }


        if ($check_cuenta->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Nombre y contraseña no son validos",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        /*Prepar datos para enviarlos al modelo */
        $datos_usuario_up = [
            "nombreUsuario" => $nombreUser,
            "tipoUsuario" => $tipoUser,
            "correo" => $correoUser,
            "usuario" => $usuario,
            "contrasena" => $passUser,
            "estado" => $estado_user,
            "id" => $id
        ];

        if (usuarioModelo::actualizar_usuario_modelo($datos_usuario_up)) {
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
    }/*Fin controlador*/


}

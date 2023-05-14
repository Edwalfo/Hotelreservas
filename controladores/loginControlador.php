<?php


if ($peticionesAjax ) {
    require_once "../modelos/loginModelo.php";
} else {
    require_once "./modelos/loginModelo.php";
}

class loginControlador extends loginModelo
{
    public function iniciar_sesion_controlador()
    {
        $usuario = mainModel::limpiar_cadena($_POST['inputUsuario']);
        $password = mainModel::limpiar_cadena($_POST['inputPassword']);

        /*--Verificar que los campos de login tengan datos---*/

        if ($usuario == "" || $password == "") {
            echo '
            <script>
                Swal.fire({
                    type: "error",
                    title: "No has llenado los campos requeridos",
                    text: "Ocurrio un error",
                    confirmButtonText: "Aceptar"
                });
            </script>';
            exit();
        }

        /*--Verificar integridad de datos--*/

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)) {
            echo '
            <script>
                Swal.fire({
                    type: "error",
                    title: "El nombre de usario no coinciden con el formato",
                    text: "Ocurrio un error",
                    confirmButtonText: "Aceptar"
                });
            </script>';
            exit();
        }

        if (mainModel::verificar_datos("[A-Za-z\d$@$!%*?&]{8,60}", $password)) {
            echo '
            <script>
                Swal.fire({
                    type: "error",
                    title: "La contraseña no coinciden con el formato",
                    text: "ocurrio un error",
                    confirmButtonText: "Aceptar"
                });
            </script>';
            exit();
        }

        
        $password = mainModel::encryption($password);

        $datos_login = [
            "usuario" => $usuario,
            "contrasena" => $password
        ];

        

        $datos_cuenta = loginModelo::iniciar_sesion_modelo($datos_login);

        if ($datos_cuenta->rowCount() == 1) {
            $row = $datos_cuenta->fetch();
            session_start(['name' => 'SHotel']);
            $_SESSION['id_SHotel'] = $row['idusuario'];
            $_SESSION['nombre_SHotel'] = $row['nombreUsuario'];
            $_SESSION['tipo_SHotel'] = $row['tipoUsuario'];
            $_SESSION['correo_SHotel'] = $row['correoUsuario'];
            $_SESSION['usuario_SHotel'] = $row['usuario'];
            $_SESSION['token_SHotel'] = md5(uniqid(mt_rand()), true);

            return header("Location:" . SERVERURL . "home/");
        } else {
            echo '
          <script>
          Swal.fire({
              type: "error",
              title: "El usuario o contraseña son incorrectos",
              text: "Ocurrio un error",
              confirmButtonText: "Aceptar"
          });
          
          </script>
    
          ';
            exit();
        }
    } //fin

    /*--forzar ciere de sesion si no se tiene permiso---*/
    public function forzar_cierre_sesion_controlador()
    {

        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "
            <script>
              window.location.href='" . SERVERURL . "login/';
            </script>
            ";
        } else {
            return header("Location:" . SERVERURL . "login/");
        }
    } //fin


    /*Controlador para cerra sesion*/
    public function cerrar_sesion_controlador()
    {
        session_start(['name' => 'SHotel']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);

        if ($token == $_SESSION['token_SHotel'] &&  $usuario == $_SESSION['usuario_SHotel']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL."login/"

            ];

            
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error inesperado",
                "Texto" => "Fallo en cerrar la sesion",
                "Tipo" => "error"
            ];

           
        }
        echo json_encode($alerta);
    } //fin

    

}

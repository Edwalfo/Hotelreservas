<?php

if ($peticionesAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}

class mainModel
{
    /*---Funcion conectar a BD--- */

    protected static function conectar()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    /*--Funcion para ejucutar consultas simples--*/
    protected static function ejecutar_consulta_simples($consulta)
    {
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }

    /*--Encriptar cadenas--*/
    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }
    /*--Desencriptar cadenas--*/
    protected static function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    /*funcion para generar codigos aleatorios*/

    protected static function generar_codigo_aleatorio($letra, $longitud, $numero)
    {
        for ($i = 1; $i <= $longitud; $i++) {
            $aleatorio = rand(0, 9);
            $letra .= $aleatorio;
        }
        return $letra . "-" . $numero;
    }

    /*--funcion para limpiar cadenas--*/
    protected static function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena);
        $cadena = stripslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src", "", $cadena);
        $cadena = str_ireplace("<script type=", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = stripslashes($cadena);
        $cadena = trim($cadena);

        return $cadena;
    }

    /*--funcione verificar datos--*/
    protected static function verificar_datos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }

    /*--verificar fechas--*/

    protected static function verificar_fechas($fecha)
    {
        $valores = explode('-', $fecha);
        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return false;
        } else {
            return true;
        }
    }

    /*Calcular edad deacuerdo a una fecha*/
    protected static function calcular_edad($fecha)
    {
        $hoy = new DateTime();
        $fecha = new DateTime($fecha);

        $fecha = $hoy->diff($fecha);

        $fecha = $fecha->y;
        return $fecha;
    }

    /*Calcular diferencia de fechas */
    public function calcular_diferencia_fechas($entrada, $salida)
    {
        $entrada = new DateTime($entrada);
        $salida = new DateTime($salida);

        $dias = $entrada->diff($salida);

        $dias = $dias->format("%r%a");
        
        return $dias;
    }

    /* Generar codigos de facturas*/


    protected static function generar_cadena_aleatoria()
    {
        $permitted_chars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';

        return substr(str_shuffle($permitted_chars), 0, 10);
    }

    /*---funcion paginado de tablas--*/

    protected static function paginador_tablas($pagina, $Npagina, $url, $botones)
    {
        $tabla = '<nav aria-label="...">
        <ul class="pagination justify-content-center">';

        if ($pagina == 1) {
            $tabla .= ' <li class="page-item disabled">
            <a class="page-link"><i class="bi bi-chevron-left"></i></a></li>';
        } else {
            $tabla .= ' 
            <li class="page-item">
            <a class="page-link" href="' . $url . '1/">
            Anterior</a></li>

            <li class="page-item">
            <a class="page-link" href="' . $url . ($pagina - 1) . '/"><i class="bi bi-chevron-double-left"></i></a></li>
            ';
        }
        $ci = 0;


        for ($i = $pagina; $i <= $Npagina; $i++) {
            if ($ci >= $botones) {
                break;
            }
            if ($pagina == $i) {
                $tabla .=  '<li class="page-item active" aria-current="page">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a>
              </li>';
            } else {
                $tabla .= '
                <li class="page-item">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>
                ';
            }
            $ci++;
        }


        if ($pagina == $Npagina) {
            $tabla .= ' <li class="page-item disabled">
            <a class="page-link"><i class="bi bi-chevron-right"></i></a></li>';
        } else {
            $tabla .= '
            
            <li class="page-item">
            <a class="page-link" href="' . $url . ($pagina + 1) . '/"><i class="bi bi-chevron-double-right"></i></a></li>

             <li class="page-item">
            <a class="page-link" href="' . $url . $Npagina . '/">
            Siguiente</a></li>

            ';
        }


        $tabla .= ' </ul></nav>';

        return $tabla;
    }
}


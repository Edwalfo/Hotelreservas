<?php

class vistasModelo
{
    /*---Modelo para obtener las vistas---*/
    protected static function obtener_vistas_modelo($vistas)
    {
        $listaBlanca = [
            "home", "reserva", "tipoHabitacion", "estadoHabitacion", "crearHabitacion",
            "estadoReserva", "facturar", "registrarHuesped", "tipoDocumento", "crearUsuario", "recepcion", "asignarhabitacion","checkout","verificarsalida"
        ];
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./vistas/contenidos/" . $vistas . "-view.php")) {
                $contenido = "./vistas/contenidos/" . $vistas . "-view.php";
            } else {
                $contenido = "404";
            }
        } elseif ($vistas === "login" || $vistas === "index") {
            $contenido = "login";
        } elseif ($vistas === "pagina") {
            $contenido = "pagina";
        } elseif ($vistas === "paginareserva") {
            $contenido = "paginareserva";
        } elseif ($vistas === "datosreserva") {
            $contenido = "datosreserva";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}

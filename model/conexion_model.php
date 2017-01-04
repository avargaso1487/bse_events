<?php

date_default_timezone_set("America/Lima");
class Conexion_Model{

    public static function getConexion() {
    
    $conexion = mysqli_connect("localhost","root","123456","bse_events");
    mysqli_set_charset($conexion, "utf8");
    return $conexion;
    }
}
?>
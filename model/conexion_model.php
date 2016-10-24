<?php

date_default_timezone_set("America/Lima");
class Conexion_Model{

    public static function getConexion() {
    
    $conexion = mysqli_connect("localhost","root","","ingresos_db");
    return $conexion;
    }

}
?>
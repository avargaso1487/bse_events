<?php
session_start();
include_once '../../model/controlservicio/servicio_model.php';

$param = array();
$param['param_opcion']='';

$param['param_servCodigo']='';
$param['param_personSucursal']='';
$param['param_servDescripcion']='';
$param['param_servPrecioBase']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];


if(isset($_POST['param_servCodigo']))
    $param['param_servCodigo'] = $_POST['param_servCodigo'];
if(isset($_POST['param_personSucursal']))
    $param['param_personSucursal'] = $_POST['param_personSucursal'];
if(isset($_POST['param_servDescripcion']))
    $param['param_servDescripcion'] = $_POST['param_servDescripcion'];
if(isset($_POST['param_servPrecioBase']))
    $param['param_servPrecioBase'] = $_POST['param_servPrecioBase'];


$Servicio = new Servicio_Model();
echo $Servicio->gestionar($param);

?>
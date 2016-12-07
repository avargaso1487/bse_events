<?php
session_start();
include_once '../../model/modelFacturacion/venta_model.php';


$param = array();
$param['param_opcion'] = '';

$param['param_serie'] =''; 
$param['param_numero'] =0; 
$param['param_tipo'] =0; 
$param['param_estado'] =0; 
$param['param_evento'] =0;
$param['param_participante'] =0; 
$param['param_monto'] =0; 
$param['param_descuento'] =0; 
$param['param_neto'] =0; 

$param['param_numeroDetalleFactura'] ='';
$param['param_precio'] =0;
$param['param_cantidad'] =0;


if (isset($_SESSION['personaID'])) {
    $param['param_personaID'] = $_SESSION['personaID'];
}

if (isset($_POST['param_opcion'])) {
    $param['param_opcion'] = $_POST['param_opcion'];
}

if (isset($_POST['param_serie'])) {
    $param['param_serie'] = $_POST['param_serie'];
}

if (isset($_POST['param_numero'])) {
    $param['param_numero'] = $_POST['param_numero'];
}

if (isset($_POST['param_tipo'])) {
    $param['param_tipo'] = $_POST['param_tipo'];
}

if (isset($_POST['param_estado'])) {
    $param['param_estado'] = $_POST['param_estado'];
}

if (isset($_POST['param_evento'])) {
    $param['param_evento'] = $_POST['param_evento'];
}

if (isset($_POST['param_participante'])) {
    $param['param_participante'] = $_POST['param_participante'];
}

if (isset($_POST['param_monto'])) {
    $param['param_monto'] = $_POST['param_monto'];
}

if (isset($_POST['param_descuento'])) {
    $param['param_descuento'] = $_POST['param_descuento'];
}

if (isset($_POST['param_neto'])) {
    $param['param_neto'] = $_POST['param_neto'];
}




if (isset($_POST["param_numeroDetalleFactura"])) {
    $param['param_numeroDetalleFactura'] = explode(",",$_POST['param_numeroDetalleFactura']);
}

if (isset($_POST['param_precio'])) {
    $param['param_precio'] = explode(",",$_POST['param_precio']);
}

if (isset($_POST['param_cantidad'])) {
    $param['param_cantidad'] = explode(",",$_POST['param_cantidad']);
}


$Ventas = new Ventas_Model();
echo $Ventas->gestionar($param);

?>

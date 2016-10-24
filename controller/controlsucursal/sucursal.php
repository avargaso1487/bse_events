<?php
session_start();
include_once '../../model/controlsucursal/sucursal_model.php';

$param = array();
$param['param_opcion']='';
$param['param_inicio']=0;
$param['param_final']=10;
$param['param_consulta']=0;
$param['param_usuId']=0;
$param['param_usuUsuario']='';
$param['param_usuClave']='';
$param['param_usuEstado'] = 1;

if (isset($_SESSION['chanchan_usuId']))
    $param['param_usuId'] = $_SESSION['chanchan_usuId'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];
if (isset($_POST['start']))
    $param['param_inicio'] = $_POST['start'];
if (isset($_POST['limit']))
    $param['param_final'] = $_POST['limit'];
if (isset($_POST['query']))
    $param['param_consulta'] = $_POST['query'];
if (isset($_POST['param_usuId']))
    $param['param_usuId'] = $_POST['param_usuId'];
if (isset($_POST['param_usuUsuario']))
    $param['param_usuUsuario'] = $_POST['param_usuUsuario'];
if (isset($_POST['param_usuClave']))
    $param['param_usuClave'] = md5($_POST['param_usuClave']);
if (isset($_POST['param_usuEstado'])) {
    if ($_POST['param_usuEstado'] == 'true')
        $param['param_usuEstado'] = '1';
    if ($_POST['param_usuEstado'] == 'false')
        $param['param_usuEstado'] = '0';
}
$Sucursal = new Sucursal_model();
echo $Sucursal->gestionar($param);

?>
<?php
session_start();
include_once '../../model/controlcliente/cliente_model.php';

$param = array();
$param['param_opcion']='';
$param['param_cliDNI']='';
$param['param_cliNombre']='';
$param['param_cliApellidoPaterno']='';
$param['param_cliApellidoMaterno']='';
$param['param_cliDireccion']='';
$param['param_cliFijo']='';
$param['param_cliCelular']='';
$param['param_cliCorreo']='';
$param['param_cliFeNacimiento']=null;
$param['param_cliFeAniversario']=null;
$param['param_cliLugarNacimiento']='';
$param['param_cliMotivoAniversario']=null;



    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_cliDNI']))
    $param['param_cliDNI'] = $_POST['param_cliDNI'];

if(isset($_POST['param_cliNombre']))
    $param['param_cliNombre'] = $_POST['param_cliNombre'];

if(isset($_POST['param_cliApellidoPaterno']))
    $param['param_cliApellidoPaterno'] = $_POST['param_cliApellidoPaterno'];

if(isset($_POST['param_cliApellidoMaterno']))
    $param['param_cliApellidoMaterno'] = $_POST['param_cliApellidoMaterno'];

if(isset($_POST['param_cliDireccion']))
    $param['param_cliDireccion'] = $_POST['param_cliDireccion'];

if(isset($_POST['param_cliFijo']))
    $param['param_cliFijo'] = $_POST['param_cliFijo'];

if(isset($_POST['param_cliCelular']))
    $param['param_cliCelular'] = $_POST['param_cliCelular'];

if(isset($_POST['param_cliCorreo']))
    $param['param_cliCorreo'] = $_POST['param_cliCorreo'];

if(isset($_POST['param_cliFeNacimiento']))
    $param['param_cliFeNacimiento'] = $_POST['param_cliFeNacimiento'];

if(isset($_POST['param_cliFeAniversario']))
    $param['param_cliFeAniversario'] = $_POST['param_cliFeAniversario'];

if(isset($_POST['param_cliLugarNacimiento']))
    $param['param_cliLugarNacimiento'] = $_POST['param_cliLugarNacimiento'];

if(isset($_POST['param_cliMotivoAniversario']))
    $param['param_cliMotivoAniversario'] = $_POST['param_cliMotivoAniversario'];


$Cliente = new Cliente_Model();
echo $Cliente->gestionar($param);

?>
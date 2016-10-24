<?php
session_start();
include_once '../../model/controlcliente/cliente_edit_model.php';

$param = array();
$param['param_opcion']='';
$param['param_codigoCliente']='';
$param['param_clienteDNI']='';
$param['param_clienteNombres']='';
$param['param_clienteApellidoPaterno']='';
$param['param_clienteApellidoMaterno']='';
$param['param_clienteDireccion']='';
$param['param_clienteTelefonoFijo']='';
$param['param_clienteTelefonoCelular']='';
$param['param_clienteCorreo']='';
$param['param_clienteNacimiento']='';
$param['param_clienteFechaAniversario']='';
$param['param_clienteMotivo']='';
$param['param_nuevoTipo']='';


    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_clienteCodigo']))
    $param['param_codigoCliente'] = $_POST['param_clienteCodigo'];
if(isset($_POST['param_clienteTipo']))
    $param['param_nuevoTipo'] = $_POST['param_clienteTipo'];





if(isset($_POST['param_clienteDNI']))
    $param['param_clienteDNI'] = $_POST['param_clienteDNI'];
if(isset($_POST['param_clienteNombres']))
    $param['param_clienteNombres'] = $_POST['param_clienteNombres'];
if(isset($_POST['param_clienteApellidoPaterno']))
    $param['param_clienteApellidoPaterno'] = $_POST['param_clienteApellidoPaterno'];
if(isset($_POST['param_clienteApellidoMaterno']))
    $param['param_clienteApellidoMaterno'] = $_POST['param_clienteApellidoMaterno'];
if(isset($_POST['param_clienteDireccion']))
    $param['param_clienteDireccion'] = $_POST['param_clienteDireccion'];
if(isset($_POST['param_clienteTelefonoFijo']))
    $param['param_clienteTelefonoFijo'] = $_POST['param_clienteTelefonoFijo'];
if(isset($_POST['param_clienteTelefonoCelular']))
    $param['param_clienteTelefonoCelular'] = $_POST['param_clienteTelefonoCelular'];
if(isset($_POST['param_clienteCorreo']))
    $param['param_clienteCorreo'] = $_POST['param_clienteCorreo'];
if(isset($_POST['param_clienteNacimiento']))
    $param['param_clienteNacimiento'] = $_POST['param_clienteNacimiento'];
if(isset($_POST['param_clienteFechaAniversario']))
    $param['param_clienteFechaAniversario'] = $_POST['param_clienteFechaAniversario'];
if(isset($_POST['param_clienteMotivo']))
    $param['param_clienteMotivo'] = $_POST['param_clienteMotivo'];




//print_r($param);
$Cliente_Edit = new Cliente_Edit_Model();
echo $Cliente_Edit->gestionar($param);

?>
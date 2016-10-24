<?php
session_start();
include_once '../../model/controlpersonal/personal_edit_model.php';

$param = array();
$param['param_opcion']='';
$param['param_codigoPersonal']='';
$param['param_nuevoEstado']='';


$param['param_personalSucursal']='';
$param['param_personalDNI']='';
$param['param_personalNombres']='';
$param['param_personalApellidoPaterno']='';
$param['param_personalApellidoMaterno']='';
$param['param_personalDireccion']='';
$param['param_personalCorreo']='';
$param['param_personalTelefonoFijo']='';
$param['param_personalTelefonoCelular']='';
$param['param_personalNacimiento']='';
$param['param_personalLugarNacimiento']='';
$param['param_personalIngreso']='';



    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_personalCodigo']))
    $param['param_codigoPersonal'] = $_POST['param_personalCodigo'];
if(isset($_POST['param_personalEstado']))
    $param['param_nuevoEstado'] = $_POST['param_personalEstado'];


if(isset($_POST['param_personSucursal']))
    $param['param_personalSucursal'] = $_POST['param_personSucursal'];
if(isset($_POST['param_personalDNI']))
    $param['param_personalDNI'] = $_POST['param_personalDNI'];
if(isset($_POST['param_personalNombres']))
    $param['param_personalNombres'] = $_POST['param_personalNombres'];
if(isset($_POST['param_personalApellidoPaterno']))
    $param['param_personalApellidoPaterno'] = $_POST['param_personalApellidoPaterno'];
if(isset($_POST['param_personalApellidoMaterno']))
    $param['param_personalApellidoMaterno'] = $_POST['param_personalApellidoMaterno'];
if(isset($_POST['param_personalDireccion']))
    $param['param_personalDireccion'] = $_POST['param_personalDireccion'];
if(isset($_POST['param_personalCorreo']))
    $param['param_personalCorreo'] = $_POST['param_personalCorreo'];
if(isset($_POST['param_personalTelefonoFijo']))
    $param['param_personalTelefonoFijo'] = $_POST['param_personalTelefonoFijo'];
if(isset($_POST['param_personalTelefonoCelular']))
    $param['param_personalTelefonoCelular'] = $_POST['param_personalTelefonoCelular'];
if(isset($_POST['param_personalNacimiento']))
    $param['param_personalNacimiento'] = $_POST['param_personalNacimiento'];
if(isset($_POST['param_personalLugarNacimiento']))
    $param['param_personalLugarNacimiento'] = $_POST['param_personalLugarNacimiento'];
if(isset($_POST['param_personalIngreso']))
    $param['param_personalIngreso'] = $_POST['param_personalIngreso'];



//print_r($param);
$Personal_Edit = new Personal_Edit_Model();
echo $Personal_Edit->gestionar($param);

?>
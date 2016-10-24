<?php
session_start();
include_once '../../model/controlpersonal/personal_model.php';

$param = array();
$param['param_opcion']='';
$param['param_personDNI']='';
$param['param_personNombre']='';
$param['param_personApellidoPaterno']='';
$param['param_personApellidoMaterno']='';
$param['param_personDireccion']='';
$param['param_personFijo']='';
$param['param_personCelular']='';
$param['param_personCorreo']='';
$param['param_personFeNacimiento']=null;
$param['param_personFeIngreso']=null;
$param['param_personLugarNacimiento']='';
$param['param_personSucursal']=null;
$param['param_personUsuario']='';
$param['param_personPassword']='';


    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_personDNI']))
    $param['param_personDNI'] = $_POST['param_personDNI'];
if(isset($_POST['param_personNombre']))
    $param['param_personNombre'] = $_POST['param_personNombre'];
if(isset($_POST['param_personApellidoPaterno']))
    $param['param_personApellidoPaterno'] = $_POST['param_personApellidoPaterno'];
if(isset($_POST['param_personApellidoMaterno']))
    $param['param_personApellidoMaterno'] = $_POST['param_personApellidoMaterno'];
if(isset($_POST['param_personDireccion']))
    $param['param_personDireccion'] = $_POST['param_personDireccion'];
if(isset($_POST['param_personFijo']))
    $param['param_personFijo'] = $_POST['param_personFijo'];
if(isset($_POST['param_personCelular']))
    $param['param_personCelular'] = $_POST['param_personCelular'];
if(isset($_POST['param_personCorreo']))
    $param['param_personCorreo'] = $_POST['param_personCorreo'];
if(isset($_POST['param_personFeNacimiento']))
    $param['param_personFeNacimiento'] = $_POST['param_personFeNacimiento'];
if(isset($_POST['param_personFeIngreso']))
    $param['param_personFeIngreso'] = $_POST['param_personFeIngreso'];
if(isset($_POST['param_personLugarNacimiento']))
    $param['param_personLugarNacimiento'] = $_POST['param_personLugarNacimiento'];
if(isset($_POST['param_personSucursal']))
    $param['param_personSucursal'] = $_POST['param_personSucursal'];
if(isset($_POST['param_personUsuario']))
    $param['param_personUsuario'] = $_POST['param_personUsuario'];
if(isset($_POST['param_personPassword']))
    $param['param_personPassword'] = md5($_POST['param_personPassword']);

//print_r($param);


$Personal = new Personal_Model();
echo $Personal->gestionar($param);

?>
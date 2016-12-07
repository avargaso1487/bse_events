<?php
session_start();
include_once '../../model/modelMantenedores/local_model.php';

$param = array();
$param['param_opcion']='';
$param['param_usuId']=0;


$param['param_local_id']=0;
$param['param_local_descripcion']='';
$param['param_local_direccion']='';


 if (isset($_SESSION['personaID']))
     $param['param_usuId'] = $_SESSION['personaID'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

// if (isset($_POST['param_usuId']))
//     $param['param_usuId'] = $_POST['param_usuId'];


if (isset($_POST['param_local_id']))
    $param['param_local_id'] = $_POST['param_local_id'];
if (isset($_POST['param_local_descripcion']))
    $param['param_local_descripcion'] = $_POST['param_local_descripcion'];
if (isset($_POST['param_local_direccion']))
    $param['param_local_direccion'] = $_POST['param_local_direccion'];
$local = new Local_Model();
echo $local->gestionar($param);

?>
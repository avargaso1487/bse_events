<?php
session_start();
include_once '../../model/modelMantenedores/ambiente_model.php';

$param = array();
$param['param_opcion']='';
$param['param_usuId']=0;


$param['param_ambiente_id']=0;
$param['param_ambiente_descripcion']='';
$param['param_ambiente_capacidad']=0;
$param['param_ambiente_tipo']=0;
$param['param_ambiente_local']=0;


 if (isset($_SESSION['personaID']))
     $param['param_usuId'] = $_SESSION['personaID'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

// if (isset($_POST['param_usuId']))
//     $param['param_usuId'] = $_POST['param_usuId'];


if (isset($_POST['param_ambiente_id']))
    $param['param_ambiente_id'] = $_POST['param_ambiente_id'];
if (isset($_POST['param_ambiente_descripcion']))
    $param['param_ambiente_descripcion'] = $_POST['param_ambiente_descripcion'];
if (isset($_POST['param_ambiente_capacidad']))
    $param['param_ambiente_capacidad'] = $_POST['param_ambiente_capacidad'];
if (isset($_POST['param_ambiente_tipo']))
    $param['param_ambiente_tipo'] = $_POST['param_ambiente_tipo'];
if (isset($_POST['param_ambiente_local']))
    $param['param_ambiente_local'] = $_POST['param_ambiente_local'];

$ambiente = new Ambiente_Model();
echo $ambiente->gestionar($param);

?>
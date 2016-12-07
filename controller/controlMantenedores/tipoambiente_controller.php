<?php
session_start();
include_once '../../model/modelMantenedores/tipoambiente_model.php';

$param = array();
$param['param_opcion']='';
$param['param_usuId']=0;


$param['param_tipoambiente_id']=0;
$param['param_tipoambiente_descripcion']='';



 if (isset($_SESSION['personaID']))
     $param['param_usuId'] = $_SESSION['personaID'];
    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

// if (isset($_POST['param_usuId']))
//     $param['param_usuId'] = $_POST['param_usuId'];


if (isset($_POST['param_tipoambiente_id']))
    $param['param_tipoambiente_id'] = $_POST['param_tipoambiente_id'];
if (isset($_POST['param_tipoambiente_descripcion']))
    $param['param_tipoambiente_descripcion'] = $_POST['param_tipoambiente_descripcion'];

$tipoambiente = new TipoAmbiente_Model();
echo $tipoambiente->gestionar($param);

?>
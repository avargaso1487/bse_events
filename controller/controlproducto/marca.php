<?php
session_start();
include_once '../../model/controlproducto/marca_model.php';

$param = array();
$param['param_opcion']='';

$param['param_marcaDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_marcaDescripcion']))
    $param['param_marcaDescripcion'] = $_POST['param_marcaDescripcion'];


$Marca = new Marca_Model();
echo $Marca->gestionar($param);

?>
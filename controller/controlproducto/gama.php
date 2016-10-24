<?php
session_start();
include_once '../../model/controlproducto/gama_model.php';

$param = array();
$param['param_opcion']='';

$param['param_gamaDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_gamaDescripcion']))
    $param['param_gamaDescripcion'] = $_POST['param_gamaDescripcion'];


$Gama = new Gama_Model();
echo $Gama->gestionar($param);

?>
<?php
session_start();
include_once '../../model/controlproducto/medidas_model.php';

$param = array();
$param['param_opcion']='';

$param['param_medidaDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_medidaDescripcion']))
    $param['param_medidaDescripcion'] = $_POST['param_medidaDescripcion'];


$Medida = new Medida_Model();
echo $Medida->gestionar($param);

?>
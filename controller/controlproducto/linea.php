<?php
session_start();
include_once '../../model/controlproducto/linea_model.php';

$param = array();
$param['param_opcion']='';

$param['param_lineaDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_lineaDescripcion']))
    $param['param_lineaDescripcion'] = $_POST['param_lineaDescripcion'];


$Linea = new Linea_Model();
echo $Linea->gestionar($param);

?>
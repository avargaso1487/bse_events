<?php
session_start();
include_once '../../model/controlproducto/presentacion_model.php';

$param = array();
$param['param_opcion']='';

$param['param_presentacionDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_presentacionDescripcion']))
    $param['param_presentacionDescripcion'] = $_POST['param_presentacionDescripcion'];


$Presentacion = new Presentacion_Model();
echo $Presentacion->gestionar($param);

?>
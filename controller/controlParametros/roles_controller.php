<?php
//session_start();
include_once '../../model/modelparametrosgenerales/roles_model.php';

$param = array();
$param['param_opcion']           ='';
$param['param_rolId']          ='';
$param['param_rol']            ='';
$param['param_rolDescripcion'] ='';

$param['param_rolEstado']      ='';


    if(isset($_POST['param_opcion']))
    $param['param_opcion']           = $_POST['param_opcion'];
    
    if(isset($_POST['param_rolId']))
    $param['param_rolId']            = $_POST['param_rolId'];
    
    if(isset($_POST['param_rol']))
    $param['param_rol']            = $_POST['param_rol'];
    
    if(isset($_POST['param_rolDescripcion']))
    $param['param_rolDescripcion'] = $_POST['param_rolDescripcion'];    
    
    if(isset($_POST['param_rolEstado']))
    $param['param_rolEstado']      = $_POST['param_rolEstado'];
        

$Rol = new Rol_Model();
echo $Rol->gestionar($param);

?>
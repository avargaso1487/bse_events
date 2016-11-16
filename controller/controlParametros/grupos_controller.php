<?php
//session_start();
include_once '../../model/modelparametrosgenerales/grupos_model.php';

$param = array();
$param['param_opcion']           ='';
$param['param_grupoId']          ='';
$param['param_grupo']            ='';
$param['param_grupoDescripcion'] ='';

$param['param_grupoOrden']       ='';

$param['param_grupoEstado']      ='';


    if(isset($_POST['param_opcion']))
    $param['param_opcion']           = $_POST['param_opcion'];
    
    if(isset($_POST['param_grupoId']))
    $param['param_grupoId']            = $_POST['param_grupoId'];
    
    if(isset($_POST['param_grupo']))
    $param['param_grupo']            = $_POST['param_grupo'];
    
    if(isset($_POST['param_grupoDescripcion']))
    $param['param_grupoDescripcion'] = $_POST['param_grupoDescripcion'];
    
    if(isset($_POST['param_grupoOrden']))
    $param['param_grupoOrden']       = $_POST['param_grupoOrden'];
    
    if(isset($_POST['param_grupoEstado']))
    $param['param_grupoEstado']      = $_POST['param_grupoEstado'];
        

$Grupo = new Grupo_Model();
echo $Grupo->gestionar($param);

?>
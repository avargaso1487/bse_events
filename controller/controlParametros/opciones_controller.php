<?php
//session_start();
include_once '../../model/modelparametrosgenerales/opciones_model.php';

$param = array();
$param['param_opcion']           ='';
$param['param_tareaId']          ='';
$param['param_opcionGrupo']          ='';
$param['param_tarea']            ='';
$param['param_tareaDescripcion'] ='';

$param['param_tareaOrden']       ='';
$param['param_tareaUrl']       ='';

$param['param_tareaEstado']      ='';


    if(isset($_POST['param_opcion']))
    $param['param_opcion']           = $_POST['param_opcion'];
    
    if(isset($_POST['param_tareaId']))
    $param['param_tareaId']            = $_POST['param_tareaId'];
    
    if(isset($_POST['param_opcionGrupo']))
    $param['param_opcionGrupo']            = $_POST['param_opcionGrupo'];
    
    if(isset($_POST['param_tarea']))
    $param['param_tarea'] = $_POST['param_tarea'];
    
    if(isset($_POST['param_tareaDescripcion']))
    $param['param_tareaDescripcion']       = $_POST['param_tareaDescripcion'];
    
    if(isset($_POST['param_tareaOrden']))
    $param['param_tareaOrden']      = $_POST['param_tareaOrden'];
        
    if(isset($_POST['param_tareaUrl']))
    $param['param_tareaUrl']      = $_POST['param_tareaUrl'];

    if(isset($_POST['param_tareaEstado']))
    $param['param_tareaEstado']      = $_POST['param_tareaEstado'];

$Opcion = new Opcion_Model();
echo $Opcion->gestionar($param);

?>
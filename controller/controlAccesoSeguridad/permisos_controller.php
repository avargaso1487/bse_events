<?php
//session_start();
include_once '../../model/modelaccesoseguridad/permisos_model.php';

$param = array();
$param['param_opcion']        ='';
$param['param_permisoId']     ='';
$param['param_usuarioRol']    ='';
$param['param_tareaId']       ='';
$param['param_permisoEstado'] ='';


    if(isset($_POST['param_opcion']))
    $param['param_opcion']        = $_POST['param_opcion'];
    
    if(isset($_POST['param_permisoId']))
    $param['param_permisoId']     = $_POST['param_permisoId'];

    if(isset($_POST['param_usuarioRol']))
    $param['param_usuarioRol']    = $_POST['param_usuarioRol'];
    
    if(isset($_POST['param_tareaId']))
    $param['param_tareaId']       = explode(",",$_POST['param_tareaId']);
    
    if(isset($_POST['param_permisoEstado']))
    $param['param_permisoEstado'] = $_POST['param_permisoEstado'];
        

$Permiso = new Permiso_Model();
echo $Permiso->gestionar($param);

?>
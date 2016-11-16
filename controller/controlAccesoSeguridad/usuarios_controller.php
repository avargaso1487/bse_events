<?php
//session_start();
include_once '../../model/modelaccesoseguridad/usuarios_model.php';

$param = array();
$param['param_opcion']             ='';
$param['param_personaId']          ='';
$param['param_usuarioColaborador'] ='';
$param['param_usuarioLogin']       ='';
$param['param_usuarioPassword']    ='';
$param['param_usuarioRol']         ='';
$param['param_usuarioEstado']      ='';


    if(isset($_POST['param_opcion']))
    $param['param_opcion']             = $_POST['param_opcion'];
    
    if(isset($_POST['param_personaId']))
    $param['param_personaId']          = $_POST['param_personaId'];
    
    if(isset($_POST['param_usuarioColaborador']))
    $param['param_usuarioColaborador'] = $_POST['param_usuarioColaborador'];
    
    if(isset($_POST['param_usuarioLogin']))
    $param['param_usuarioLogin']       = $_POST['param_usuarioLogin'];
    
    if(isset($_POST['param_usuarioPassword']))
    $param['param_usuarioPassword']    = md5($_POST['param_usuarioPassword']);    
    
    if(isset($_POST['param_usuarioRol']))
    $param['param_usuarioRol']         = $_POST['param_usuarioRol'];    
    
    if(isset($_POST['param_usuarioEstado']))
    $param['param_usuarioEstado']      = $_POST['param_usuarioEstado'];

$Usuario = new Usuario_Model();
echo $Usuario->gestionar($param);

?>
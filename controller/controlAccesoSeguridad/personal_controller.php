<?php
//session_start();
include_once '../../model/modelAccesoSeguridad/personal_model.php';

$param = array();
$param['param_opcion']                ='';
$param['param_colaboradorId']         ='';
$param['param_colaboradorCodigo']         ='';
$param['param_colaboradorEmpresa']    ='';
$param['param_colaboradorSucursal']   ='';
$param['param_colaboradorNombre']     ='';
$param['param_colaboradorApellidos']  ='';
$param['param_colaboradorDNI']        ='';
$param['param_colaboradorDireccion']  ='';
$param['param_colaboradorNacimiento'] ='';
$param['param_colaboradorFijo']       ='';
$param['param_colaboradorMovil']      ='';
$param['param_colaboradorMail']       ='';
$param['param_colaboradorIngreso']       ='';
$param['param_colaboradorEstado']     ='';

    if(isset($_POST['param_opcion']))
    $param['param_opcion']           = $_POST['param_opcion'];
    
    if(isset($_POST['param_colaboradorId']))
    $param['param_colaboradorId']            = $_POST['param_colaboradorId'];
    
    if(isset($_POST['param_colaboradorCodigo']))
    $param['param_colaboradorCodigo']            = $_POST['param_colaboradorCodigo'];
    
    if(isset($_POST['param_colaboradorEmpresa']))
    $param['param_colaboradorEmpresa']            = $_POST['param_colaboradorEmpresa'];
    
    if(isset($_POST['param_colaboradorSucursal']))
    $param['param_colaboradorSucursal'] = $_POST['param_colaboradorSucursal'];
    
    if(isset($_POST['param_colaboradorNombre']))
    $param['param_colaboradorNombre']       = $_POST['param_colaboradorNombre'];
    
    if(isset($_POST['param_colaboradorApellidos']))
    $param['param_colaboradorApellidos']      = $_POST['param_colaboradorApellidos'];
    
    if(isset($_POST['param_colaboradorDNI']))
    $param['param_colaboradorDNI']      = $_POST['param_colaboradorDNI'];
    
    if(isset($_POST['param_colaboradorDireccion']))
    $param['param_colaboradorDireccion']      = $_POST['param_colaboradorDireccion'];
    
    if(isset($_POST['param_colaboradorNacimiento']))
    $param['param_colaboradorNacimiento'] = $_POST['param_colaboradorNacimiento'];
    
    if(isset($_POST['param_colaboradorFijo']))
    $param['param_colaboradorFijo']       = $_POST['param_colaboradorFijo'];
    
    if(isset($_POST['param_colaboradorMovil']))
    $param['param_colaboradorMovil']      = $_POST['param_colaboradorMovil'];
    
    if(isset($_POST['param_colaboradorMail']))
    $param['param_colaboradorMail']      = $_POST['param_colaboradorMail'];
    
    if(isset($_POST['param_colaboradorIngreso']))
    $param['param_colaboradorIngreso']      = $_POST['param_colaboradorIngreso'];

    if(isset($_POST['param_colaboradorEstado']))
    $param['param_colaboradorEstado']      = $_POST['param_colaboradorEstado'];

$Personal = new Personal_Model();
echo $Personal->gestionar($param);

?>
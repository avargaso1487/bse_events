<?php
session_start();
include_once '../../model/controlproducto/producto_model.php';

$param = array();
$param['param_opcion']='';
$param['param_prodCodigoInterno']='';
$param['param_prodNombre']='';
$param['param_prodLinea']=null;
$param['param_prodMarca']=null;
$param['param_prodEmpaque']='';
$param['param_prodPresentacion']='';
$param['param_prodGama']='';
$param['param_prodCodigoBarras']='';
$param['param_prodSucursal']=null;
$param['param_prodTipo']='';
$param['param_prodPrecioCosto']=null;
$param['param_prodPrecioVenta']='';
$param['param_prodStockRequerido']=null;
$param['param_prodStockMin']='';
$param['param_prodStockActual']='';


    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];

if(isset($_POST['param_prodCodigoInterno']))
    $param['param_prodCodigoInterno'] = $_POST['param_prodCodigoInterno'];
if(isset($_POST['param_prodNombre']))
    $param['param_prodNombre'] = $_POST['param_prodNombre'];
if(isset($_POST['param_prodLinea']))
    $param['param_prodLinea'] = $_POST['param_prodLinea'];
if(isset($_POST['param_prodMarca']))
    $param['param_prodMarca'] = $_POST['param_prodMarca'];
if(isset($_POST['param_prodEmpaque']))
    $param['param_prodEmpaque'] = $_POST['param_prodEmpaque'];
if(isset($_POST['param_prodPresentacion']))
    $param['param_prodPresentacion'] = $_POST['param_prodPresentacion'];
if(isset($_POST['param_prodGama']))
    $param['param_prodGama'] = $_POST['param_prodGama'];
if(isset($_POST['param_prodCodigoBarras']))
    $param['param_prodCodigoBarras'] = $_POST['param_prodCodigoBarras'];
if(isset($_POST['param_prodSucursal']))
    $param['param_prodSucursal'] = $_POST['param_prodSucursal'];
if(isset($_POST['param_prodTipo']))
    $param['param_prodTipo'] = $_POST['param_prodTipo'];
if(isset($_POST['param_prodPrecioCosto']))
    $param['param_prodPrecioCosto'] = $_POST['param_prodPrecioCosto'];
if(isset($_POST['param_prodPrecioVenta']))
    $param['param_prodPrecioVenta'] = $_POST['param_prodPrecioVenta'];
if(isset($_POST['param_prodStockRequerido']))
    $param['param_prodStockRequerido'] = $_POST['param_prodStockRequerido'];
if(isset($_POST['param_prodStockMin']))
    $param['param_prodStockMin'] = $_POST['param_prodStockMin'];
if(isset($_POST['param_prodStockActual']))
    $param['param_prodStockActual'] = $_POST['param_prodStockActual'];


$Producto = new Producto_Model();
echo $Producto->gestionar($param);

?>
<?php
session_start();
include_once '../../model/controldocumento/documento_model.php';

$param = array();
$param['param_opcion']='';$param['param_sucursal']="";$param['param_docTipoDocumento']="";$param['param_docSerie']="";$param['param_docNumero']="";
$param['param_docFechaHora']="";$param['param_docDNICliente']="";$param['param_docCodigoPersonalCaja']="";$param['param_numeroDetalleProducto']="";
$param['param_productoID']="";$param['param_promotorID']="";$param['param_productoCantidad']="";$param['param_productoDescuentoPorc']="";
$param['param_productoDescuentoMonto']="";$param['param_productoMontoTotal']="";$param['param_numeroDetalleServicio']="";$param['param_servicioID']="";
$param['param_personalID']="";$param['param_servicioVariacionPorc']="";$param['param_servicioVariacionMonto']="";$param['param_servicioMontoTotal']="";

$param['param_checkEfectivo']="";$param['param_checkTarjeta']="";$param['param_checkCheque']="";$param['param_checkCredito']="";
$param['param_checkCanje']="";$param['param_checkRegalo']="";

$param['param_docdetPagoContadoMonto']="";$param['param_docdetPagoTarjetaBanco']="";$param['param_docdetPagoTarjetaOperacion']="";
$param['param_docdetPagoTarjetaMonto']="";$param['param_docdetPagoChequeBanco']="";$param['param_docdetPagoChequeNumero']="";
$param['param_docdetPagoChequeMonto']="";$param['param_docdetPagoChequeFecha']="";$param['param_docdetPagoCreditoMonto']="";
$param['param_docdetPagoCanjeMonto']="";$param['param_docdetPagoRegaloMonto']="";$param['param_montoTotal']="";

//$param['param_lineaDescripcion']='';

    
if (isset($_POST['param_opcion']))
    $param['param_opcion'] = $_POST['param_opcion'];
if (isset($_POST['param_sucursal']))
    $param['param_sucursal'] = $_POST['param_sucursal'];
if (isset($_POST['param_docTipoDocumento']))
    $param['param_docTipoDocumento'] = $_POST['param_docTipoDocumento'];
if (isset($_POST['param_docSerie']))
    $param['param_docSerie'] = $_POST['param_docSerie'];
if (isset($_POST['param_docNumero']))
    $param['param_docNumero'] = $_POST['param_docNumero'];
if (isset($_POST['param_docFechaHora']))
{
	$date = new DateTime($_POST['param_docFechaHora']);
    $param['param_docFechaHora'] = $date->format('Y-m-d H:i:s');
}
if (isset($_POST['param_docDNICliente']))
    $param['param_docDNICliente'] = $_POST['param_docDNICliente'];
if (isset($_POST['param_docCodigoPersonalCaja']))
    $param['param_docCodigoPersonalCaja'] = $_POST['param_docCodigoPersonalCaja'];


if (isset($_POST['param_numeroDetalleProducto']))
    $param['param_numeroDetalleProducto'] = explode(",",$_POST['param_numeroDetalleProducto']);
if (isset($_POST['param_productoID']))
    $param['param_productoID'] = explode(",",$_POST['param_productoID']);
if (isset($_POST['param_promotorID']))
    $param['param_promotorID'] = explode(",",$_POST['param_promotorID']);
if (isset($_POST['param_productoCantidad']))
    $param['param_productoCantidad'] = explode(",",$_POST['param_productoCantidad']);
if (isset($_POST['param_productoDescuentoPorc']))
    $param['param_productoDescuentoPorc'] = explode(",",$_POST['param_productoDescuentoPorc']);
if (isset($_POST['param_productoDescuentoMonto']))
    $param['param_productoDescuentoMonto'] = explode(",",$_POST['param_productoDescuentoMonto']);
if (isset($_POST['param_productoMontoTotal']))
    $param['param_productoMontoTotal'] = explode(",",$_POST['param_productoMontoTotal']);


if (isset($_POST['param_numeroDetalleServicio']))
    $param['param_numeroDetalleServicio'] = explode(",",$_POST['param_numeroDetalleServicio']);
if (isset($_POST['param_servicioID']))
    $param['param_servicioID'] = explode(",",$_POST['param_servicioID']);
if (isset($_POST['param_personalID']))
    $param['param_personalID'] = explode(",",$_POST['param_personalID']);
if (isset($_POST['param_servicioVariacionPorc']))
    $param['param_servicioVariacionPorc'] = explode(",",$_POST['param_servicioVariacionPorc']);
if (isset($_POST['param_servicioVariacionMonto']))
    $param['param_servicioVariacionMonto'] = explode(",",$_POST['param_servicioVariacionMonto']);
if (isset($_POST['param_servicioMontoTotal']))
    $param['param_servicioMontoTotal'] = explode(",",$_POST['param_servicioMontoTotal']);


if (isset($_POST['param_checkEfectivo']))
    $param['param_checkEfectivo'] = $_POST['param_checkEfectivo'];
if (isset($_POST['param_checkTarjeta']))
    $param['param_checkTarjeta'] = $_POST['param_checkTarjeta'];
if (isset($_POST['param_checkCheque']))
    $param['param_checkCheque'] = $_POST['param_checkCheque'];
if (isset($_POST['param_checkCredito']))
    $param['param_checkCredito'] = $_POST['param_checkCredito'];
if (isset($_POST['param_checkCanje']))
    $param['param_checkCanje'] = $_POST['param_checkCanje'];
if (isset($_POST['param_checkRegalo']))
    $param['param_checkRegalo'] = $_POST['param_checkRegalo'];

if (isset($_POST['param_docdetPagoContadoMonto']))
    $param['param_docdetPagoContadoMonto'] = $_POST['param_docdetPagoContadoMonto'];
if (isset($_POST['param_docdetPagoTarjetaBanco']))
    $param['param_docdetPagoTarjetaBanco'] = $_POST['param_docdetPagoTarjetaBanco'];
if (isset($_POST['param_docdetPagoTarjetaOperacion']))
    $param['param_docdetPagoTarjetaOperacion'] = $_POST['param_docdetPagoTarjetaOperacion'];
if (isset($_POST['param_docdetPagoTarjetaMonto']))
    $param['param_docdetPagoTarjetaMonto'] = $_POST['param_docdetPagoTarjetaMonto'];
if (isset($_POST['param_docdetPagoChequeBanco']))
    $param['param_docdetPagoChequeBanco'] = $_POST['param_docdetPagoChequeBanco'];
if (isset($_POST['param_docdetPagoChequeNumero']))
    $param['param_docdetPagoChequeNumero'] = $_POST['param_docdetPagoChequeNumero'];
if (isset($_POST['param_docdetPagoChequeMonto']))
    $param['param_docdetPagoChequeMonto'] = $_POST['param_docdetPagoChequeMonto'];
if (isset($_POST['param_docdetPagoChequeFecha']))
    $param['param_docdetPagoChequeFecha'] = $_POST['param_docdetPagoChequeFecha'];
if (isset($_POST['param_docdetPagoCreditoMonto']))
    $param['param_docdetPagoCreditoMonto'] = $_POST['param_docdetPagoCreditoMonto'];
if (isset($_POST['param_docdetPagoCanjeMonto']))
    $param['param_docdetPagoCanjeMonto'] = $_POST['param_docdetPagoCanjeMonto'];
if (isset($_POST['param_docdetPagoRegaloMonto']))
    $param['param_docdetPagoRegaloMonto'] = $_POST['param_docdetPagoRegaloMonto'];
if (isset($_POST['param_montoTotal']))
    $param['param_montoTotal'] = $_POST['param_montoTotal'];
/*if(isset($_POST['param_lineaDescripcion']))
    $param['param_lineaDescripcion'] = $_POST['param_lineaDescripcion'];*/


$Documento = new Documento_Model();
echo $Documento->gestionar($param);

?>
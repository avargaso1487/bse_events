<?php 
	session_start();
	include_once '../../model/modelEvento/inscripcion_model.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_codigo'] = '';
	$param['param_participanteID'] = '';
	$param['param_paquete'] = '';
	$param['param_tipoDocumentoPago'] = '';
	$param['param_banco'] = '';
	$param['param_nroOperacion'] = '';
	$param['param_fechaPago'] = '';
	$param['param_archivo'] = '';
	$param['param_fileArchivo'] = '';	
	$param['ruta'] = '';
	$param['codigoActividad'] = '';
	          
	if(isset($_POST['param_opcion'])){ $param['param_opcion'] = $_POST['param_opcion']; }
	if(isset($_POST['codigo'])){ $param['param_codigo'] = $_POST['codigo']; }
	if(isset($_POST['param_participanteID'])){ $param['param_participanteID'] = $_POST['param_participanteID']; }
	if(isset($_POST['param_paquete'])){ $param['param_paquete'] = $_POST['param_paquete']; }
	if(isset($_POST['param_tipoDocumentoPago'])){ $param['param_tipoDocumentoPago'] = $_POST['param_tipoDocumentoPago']; }
	if(isset($_POST['param_banco'])){ $param['param_banco'] = $_POST['param_banco']; }
	if(isset($_POST['param_nroOperacion'])){ $param['param_nroOperacion'] = $_POST['param_nroOperacion']; }
	if(isset($_POST['param_fechaPago'])){ $param['param_fechaPago'] = $_POST['param_fechaPago']; }
	if(isset($_FILES['Voucher']['name'])){ $param['param_archivo'] = $_FILES['Voucher']['name']; }
	if(isset($_FILES['Voucher']['tmp_name'])){ $param['param_fileArchivo'] = $_FILES['Voucher']['tmp_name']; }
	$param['ruta'] = '../../view/voucher/'.$param['param_archivo'];	

	if (isset($_POST['codigoActividad'])) {
	    $param['codigoActividad'] = explode(",",$_POST['codigoActividad']);
	}

	$Inscripcion = new Inscripcion_model();
	echo $Inscripcion->gestionar($param);
 ?>
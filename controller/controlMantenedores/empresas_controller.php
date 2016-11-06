<?php 
	session_start();
	include_once '../../model/modelMantenedores/empresa_model.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_razonSocial'] = '';
	$param['param_direccion'] = '';
	$param['param_ruc'] = '';
	$param['param_codigo'] = '';



	if(isset($_POST['param_opcion']))
	{
		$param['param_opcion'] = $_POST['param_opcion'];
	}

	if(isset($_POST['param_razonSocial']))
	{
		$param['param_razonSocial'] = $_POST['param_razonSocial'];	
	}

	if(isset($_POST['param_direccion']))
	{
		$param['param_direccion'] = $_POST['param_direccion'];
	}

	if(isset($_POST['param_ruc']))
	{
		$param['param_ruc'] = $_POST['param_ruc'];
	}

	if(isset($_POST['param_codigo']))
	{
		$param['param_codigo'] = $_POST['param_codigo'];
	}

	$Empresa = new Empresa_model();
	echo $Empresa->gestionar($param);
	//print_r($param);
 ?>
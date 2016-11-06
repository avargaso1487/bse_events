<?php 
	session_start();
	include_once '../../model/modelMantenedores/sucursal_model.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_nombres'] = '';
	$param['param_direccion'] = '';
	$param['param_empresa'] = '';
	$param['param_codigo'] = '';



	if(isset($_POST['param_opcion']))
	{
		$param['param_opcion'] = $_POST['param_opcion'];
	}

	if(isset($_POST['param_nombres']))
	{
		$param['param_nombres'] = $_POST['param_nombres'];	
	}

	if(isset($_POST['param_direccion']))
	{
		$param['param_direccion'] = $_POST['param_direccion'];
	}

	if(isset($_POST['param_empresa']))
	{
		$param['param_empresa'] = $_POST['param_empresa'];
	}

	if(isset($_POST['param_codigo']))
	{
		$param['param_codigo'] = $_POST['param_codigo'];
	}

	$Sucursal = new Sucursal_model();
	echo $Sucursal->gestionar($param);
	//print_r($param);
 ?>
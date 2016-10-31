<?php 
	session_start();
	include_once '../../model/modelusuario/usuario_model.php';

	$param = array();
	$param['opcion'] = '';
	$param['usuario'] = '';
	$param['password'] = '';
	$param['grupo'] = '';
	$param['tarea'] = '';

	if(isset($_POST['opcion']))
	{
		$param['opcion'] = $_POST['opcion'];
	}

	if(isset($_POST['usuario']))
	{
		$param['usuario'] = $_POST['usuario'];	
	}

	if(isset($_POST['password']))
	{
		$param['password'] = md5($_POST['password']);
	}

	if(isset($_POST['grupo']))
	{
		$param['grupo'] = $_POST['grupo'];
	}

	if(isset($_POST['tarea']))
	{
		$param['tarea'] = $_POST['tarea'];
	}

	$Usuario = new Usuario_model();
	echo $Usuario->gestionar($param);
	//print_r($param);
 ?>
<?php 
	session_start();
	include_once '../../model/modelActividad/asistencia_model.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_codigo'] = '';
	$param['param_participante'] = '';
	
	          
	if(isset($_POST['param_opcion'])){ $param['param_opcion'] = $_POST['param_opcion']; }
	if(isset($_POST['param_actividadID'])){ $param['param_codigo'] = $_POST['param_actividadID']; }

	if(isset($_POST['param_participante'])){ $param['param_participante'] = $_POST['param_participante']; }
	



	$Asistencia = new Asistencia_model();
	echo $Asistencia->gestionar($param);
 ?>

 
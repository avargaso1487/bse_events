<?php 
	session_start();
	include_once '../../model/modelMantenedores/ponente_model.php';

	$param = array();
	$param['param_opcion'] = '';
	$param['param_nombres'] = '';
	$param['param_apellidos'] = '';
	$param['param_tipoDocumento'] = '';
	$param['param_nroDocumento'] = '';
	$param['param_telefonoFijo'] = '';
	$param['param_email'] = '';
	$param['param_celular'] = '';
	$param['param_carreraProfesional'] = '';
	$param['param_fechaNacimiento'] = '';
	$param['param_nacionalidad'] = '';
	$param['param_estadoLaboral'] = '';
	$param['param_archivo'] = '';
	$param['param_resumenHojaVida'] = '';
	$param['param_centroTrabajo'] = '';
	$param['param_direccion'] = '';	
	$param['param_fileArchivo'] = '';	
	$param['ruta'] = '';	
	$param['param_codigo'] = '';

	          
	if(isset($_POST['param_opcion'])){ $param['param_opcion'] = $_POST['param_opcion']; }
	if(isset($_POST['param_nombres'])) { $param['param_nombres'] = $_POST['param_nombres'];	}
	if(isset($_POST['param_apellidos'])){ $param['param_apellidos'] = $_POST['param_apellidos']; }
	if(isset($_POST['param_tipoDocumento'])) { $param['param_tipoDocumento'] = $_POST['param_tipoDocumento']; }
	if(isset($_POST['param_nroDocumento']))	{ $param['param_nroDocumento'] = $_POST['param_nroDocumento']; }
	if(isset($_POST['param_telefonoFijo']))	{ $param['param_telefonoFijo'] = $_POST['param_telefonoFijo']; }
	if(isset($_POST['param_email'])) { $param['param_email'] = $_POST['param_email']; }
	if(isset($_POST['param_celular'])) { $param['param_celular'] = $_POST['param_celular'];	}
	if(isset($_POST['param_carreraProfesional'])) { $param['param_carreraProfesional'] = $_POST['param_carreraProfesional']; }
	if(isset($_POST['param_fechaNacimiento'])){ $param['param_fechaNacimiento'] = $_POST['param_fechaNacimiento']; }
	if(isset($_POST['param_nacionalidad'])){ $param['param_nacionalidad'] = $_POST['param_nacionalidad']; }
	if(isset($_POST['param_estadoLaboral'])){ $param['param_estadoLaboral'] = $_POST['param_estadoLaboral']; }
	if(isset($_POST['param_direccion'])){ $param['param_direccion'] = $_POST['param_direccion']; }
	if(isset($_POST['param_centroTrabajo'])){ $param['param_centroTrabajo'] = $_POST['param_centroTrabajo']; }		
	if(isset($_FILES['imagen']['name'])){ $param['param_archivo'] = $_FILES['imagen']['name']; }
	if(isset($_FILES['imagen']['tmp_name'])){ $param['param_fileArchivo'] = $_FILES['imagen']['tmp_name']; }
	if(isset($_POST['param_resumenHojaVida'])){ $param['param_resumenHojaVida'] = $_POST['param_resumenHojaVida']; }
	if(isset($_POST['param_codigo'])){ $param['param_codigo'] = $_POST['param_codigo']; }

	$param['ruta'] = '../../view/cv/'.$param['param_archivo'];		

	$Ponente = new Ponente_model();
	echo $Ponente->gestionar($param);
 ?>
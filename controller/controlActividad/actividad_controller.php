<?php 
	session_start();
	include_once '../../model/modelEvento/evento_model.php';
	include_once '../../model/modelActividad/actividad_model.php';
	include_once '../../model/modelMantenedores/tipo_actividad_model.php';
	include_once '../../model/modelMantenedores/ponente_model.php';
	include_once '../../model/modelMantenedores/ambiente_model.php';
	$evento = new Evento_model();
	$actividad = new Actividad_model();
	$tipo_actividad = new Tipo_actividad_model();
	$ponente = new Ponente_model();
	$ambiente = new Ambiente_Model();

	$param['actividadID'] = "";
	$param['eventoID'] = "";
	$param['ponenteID'] = "";
	$param['actividad'] = "";
	$param['descripcion'] = "";
	$param['precio'] = "";
	$param['ambienteID'] = "";
	$param['fecha'] = "";
	$param['horaI'] = "";
	$param['horaF'] = "";
	$param['estado'] = "";
	$param['tipoActividadID'] = "";

	if(isset($_POST['txtActividadID'])){ $param['actividadID'] = $_POST['txtActividadID'];}
	if(isset($_POST['txtEventoID'])){ $param['eventoID'] = $_POST['txtEventoID'];}
	if(isset($_POST['cboPonente'])){ $param['ponenteID'] = $_POST['cboPonente'];}
	if(isset($_POST['txtActividad'])){ $param['actividad'] = $_POST['txtActividad'];}
	if(isset($_POST['txtDescripcion'])){ $param['descripcion'] = $_POST['txtDescripcion'];}
	if(isset($_POST['txtPrecio'])){ $param['precio'] = $_POST['txtPrecio'];}
	if(isset($_POST['cboAmbiente'])){ $param['ambienteID'] = $_POST['cboAmbiente'];}
	if(isset($_POST['txtFecha'])){ $param['fecha'] = $_POST['txtFecha'];}
	if(isset($_POST['txtHoraI'])){ $param['horaI'] = $_POST['txtHoraI'];}
	if(isset($_POST['txtHoraF'])){ $param['horaF'] = $_POST['txtHoraF'];}
	if(isset($_POST['cboEstado'])){ $param['estado'] = $_POST['cboEstado'];}
	if(isset($_POST['cboTipoActividad'])){ $param['tipoActividadID'] = $_POST['cboTipoActividad'];}

	switch ($_POST['opcion']) {
	   	case 1:
	        registrar_nueva_actividad($actividad,$evento,$param);
	        break;
	   	case 2:
	        get_evento($evento,$param);
	        break;
	   	case 3:
	        listar_actividades($actividad,$param);
	        break;
	    case 4:
	        get_actividad($actividad,$param);
	        break;
	    case 5:
	        update_actividad($actividad,$param);
	        break;
	    case 6:
	        get_cbo_tipos_activ($tipo_actividad);
	        break;
	    case 7:
	        get_cbo_ponentes($ponente);
	        break;
	    case 8:
	        get_cbo_ambientes($ambiente);
	        break;
	    case 9:
	        eliminar_actividad($actividad,$param);
	        break;

	}
	function eliminar_actividad($actividad,$param){
		$rpta = $actividad->eliminar_actividad($param);
		if($rpta == 1) echo 1;
		else echo "No se pudo eliminar la actividad";
	}
	function update_actividad($actividad,$param){
		$rpta = $actividad->update_actividad($param);
		if($rpta == 1) echo 1;
		else echo 0;
	}
	function get_cbo_tipos_activ($tipo_actividad){
		$tiposActividad = $tipo_actividad->get_tipos_actividad();
		$tiposActividad = json_decode($tiposActividad);
		echo "<option value='0'>-- Seleccionar tipo actividad --</option>";
		foreach ($tiposActividad as $key => $tipoActividad){
			echo "<option value=".$tipoActividad->TipoActi_idTipoActividad.">".$tipoActividad->TipoActi_descripcion."</option>";
		}
	}
	function get_cbo_ponentes($ponente){
		$ponentes = $ponente->get_ponentes();
		$ponentes = json_decode($ponentes);
		echo "<option value='0'>-- Seleccionar ponente --</option>";
		foreach ($ponentes as $key => $ponente){
			echo "<option value=".$ponente->Pon_idPonente.">".$ponente->Pon_nombre."</option>";
		}
	}
	function get_cbo_ambientes($ambiente){
		$ambientes = $ambiente->get_ambientes();
		$ambientes = json_decode($ambientes);
		echo "<option value='0'>-- Seleccionar ponente --</option>";
		foreach ($ambientes as $key => $ambiente){
			echo "<option value=".$ambiente->Amb_idAmbiente.">".$ambiente->Amb_descripcion."</option>";
		}
	}
	function registrar_nueva_actividad($actividad,$evento, $param){
		$rpta = $actividad->registrar_nueva_actividad($param);
		if($rpta == 1){
			echo 1;
		}else{
			echo 0;
		}
	}
	function get_actividad($actividad, $param){
		$rpta = $actividad->get_actividad($param);
		echo $rpta;
	}
	function listar_actividades($actividad, $param){
		$actividades = $actividad->get_actividades($param);
		$actividades = json_decode($actividades);

		foreach ($actividades as $key => $actividad){
			$actividad_2 = new Actividad_model();
			$param['actividadID'] = $actividad->Acti_idActividad;
			$participantes = $actividad_2->get_participantes($param);
			

			$mostrarEstado = "";
			if($actividad->estado == 'A') $mostrarEstado = 'Activo';
			else $mostrarEstado = 'Inactivo';
			$fecha = $actividad->Acti_fecha;
			$mostrarFecha = explode('-', $fecha);
			$mostrarFecha = $mostrarFecha[2].'/'.$mostrarFecha[1].'/'.$mostrarFecha[0];
			$datetime1 = new DateTime(date('Y').'-'.date('m').'-'.date('d'));
			$datetime2 = new DateTime($actividad->Acti_fecha);
			$interval = $datetime1->diff($datetime2);
			$dias  = $interval->format('%R%a días');
			echo "<tr>
					<td>".$actividad->Acti_idActividad."</td>
					<td>".$actividad->Acti_nombre."</td>
					<td>".$actividad->Pon_nombre.' '.$actividad->Pon_apellidos."</td>
					<td>".$mostrarFecha."</td>
					<td>".$actividad->Acti_horaInicio.' - '.$actividad->Acti_horaFin."</td>
					<td>".$actividad->Acti_precio."</td>
					<td>".$actividad->TipoActi_descripcion."</td>
					<td>".$participantes."</td>
					<td>".$mostrarEstado."</td>
					<td >
		              <div class='inline pos-rel dropup'>
		                <button  class='btn btn-primary btn-xs btn-flat dropdown-toggle' data-toggle='dropdown' data-position='auto' >
		                    <i class='ace-icon fa fa-caret-down'></i>
		                </button>

		                <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-menu-right dropdown-caret dropdown-close '>
				                <li>
			                    	<button class='btn btn-xs btn-success btn-block' onclick='verActividad(".$actividad->Acti_idActividad.");'>
										<i class='ace-icon fa fa-search bigger-120'></i>
										Ver actividad
									</button>
		                   		</li>";
		                   	if ($dias >= 0) {
			                   	echo 
			                   		"<li>
			                   			<button class='btn btn-xs btn-info btn-block' onclick='editarActividad(".$actividad->Acti_idActividad.");'>
											<i class='ace-icon fa fa-pencil bigger-120'></i>
											Editar
										</button>
									</li>
									<li>
										<button class='btn btn-xs btn-danger btn-block' onclick='eliminarActividad(".$actividad->Even_idEvento.",".$actividad->Acti_idActividad.");'>
											<i class='ace-icon fa fa-trash-o bigger-120'></i>
											Eliminar
										</button>
									</li>";
							}
		                echo "</ul>
		              </div>
					</td>
				</tr>";
		}		
	}




	function get_evento($evento, $param){
		$rpta = $evento->get_evento($param);
		echo $rpta;
	}
	
	
	

 ?>
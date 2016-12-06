<?php 
	session_start();
	include_once '../../model/modelEvento/evento_model.php';
	include_once '../../model/modelMantenedores/sucursal_model.php';
	$evento = new Evento_model();
	$sucursal = new Sucursal_Model();

	$param['eventoID'] = "";
	$param['sucursalID'] = "";
	$param['nombre'] = "";
	$param['descripcion'] = "";
	$param['duracion'] = "";
	$param['fechaI'] = "";
	$param['fechaF'] = "";
	$param['precioT'] = "";
	$param['estado'] = "";

	if(isset($_POST['txtEventoID'])){ $param['eventoID'] = $_POST['txtEventoID'];}
	if(isset($_POST['cboSucursal'])){ $param['sucursalID'] = $_POST['cboSucursal'];}
	if(isset($_POST['txtNombre'])){ $param['nombre'] = $_POST['txtNombre'];}
	if(isset($_POST['txtDescripcion'])){ $param['descripcion'] = $_POST['txtDescripcion'];}
	if(isset($_POST['txtDuracion'])){ $param['duracion'] = $_POST['txtDuracion'];}
	if(isset($_POST['txtFechaI'])){ $param['fechaI'] = $_POST['txtFechaI'];}
	if(isset($_POST['txtFechaF'])){ $param['fechaF'] = $_POST['txtFechaF'];}
	if(isset($_POST['txtPrecioT'])){ $param['precioT'] = $_POST['txtPrecioT'];}
	if(isset($_POST['cboEstado'])){ $param['estado'] = $_POST['cboEstado'];}

	switch ($_POST['opcion']) {
	   	case 1:
	        registrar_nuevo_evento($evento,$param);
	        break;
	   	case 2:
	        get_evento($evento,$param);
	        break;
	   	case 3:
	        listar_eventos($evento);
	        break;
	    case 6:
	        get_cbo_sucursal($sucursal);
	        break;

	}
	function get_cbo_sucursal($sucursal){
		$sucursales = $sucursal->get_sucursales();
		$sucursales = json_decode($sucursales);
		echo "<option value='0'>-- Seleccionar sucursal --</option>";
		foreach ($sucursales as $key => $sucursal){
			echo "<option value=".$sucursal->Suc_idSucursal.">".$sucursal->Suc_nombre."</option>";
		}
	}
	function get_evento($evento, $param){
		$rpta = $evento->get_evento($param);
		echo $rpta;
	}
	function registrar_nuevo_evento($evento, $param){
		$rpta = $evento->registrar_nuevo_evento($param);
		echo $rpta;
	}
	function listar_eventos($evento){
		$eventos = $evento->get_eventos();
		$eventos = json_decode($eventos);
		
		foreach ($eventos as $key => $evento){
			$arrayFechaI = explode("-", $evento->Even_fechaInicio);
			$mostrarFechaI = $arrayFechaI[2].'/'.$arrayFechaI[1].'/'.$arrayFechaI[0];
			$arrayFechaF = explode("-", $evento->Even_fechaFin);
			$mostrarFechaF = $arrayFechaF[2].'/'.$arrayFechaF[1].'/'.$arrayFechaF[0];
			echo "<tr>
					<td>".$evento->Even_idEvento."</td>
					<td>".$evento->Suc_nombre."</td>
					<td>".$evento->Even_nombre."</td>
					<td>".$mostrarFechaI.' - '.$mostrarFechaF."</td>
					<td>".$evento->Even_precioTotal."</td>
					<td>0</td>
					<td >
		              <div class='inline pos-rel dropup'>
		                <button  class='btn btn-primary btn-xs btn-flat dropdown-toggle' data-toggle='dropdown' data-position='auto' >
		                    <i class='ace-icon fa fa-caret-down'></i>
		                </button>

		                <ul class='lista-flotante dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close '>				                
		                   		<li>
			                    	<form method='post' action='evento.php'>
							            <input type='hidden' id='eventoID' name='eventoID' value='$evento->Even_idEvento'>
			                        	<button type='submit' class='btn btn-block btn-primary btn-flat btn-xs'>
			                        		<span class='text-blue'>
			                            	<i class='ace-icon fa fa-search bigger-120'></i>
			                          		</span>
				                          	<span> Gestionar evento </span>
										</button>
							        </form>
		                   		</li>
		                </ul>
		              </div>
					</td>
				</tr>";
		}		
	}
	

 ?>
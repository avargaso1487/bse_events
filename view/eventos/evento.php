
<?php 
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header("Location:../../index.php");
		exit();
	}
	else
	{
		date_default_timezone_set('America/Lima');
		$grupo = "Gestión de Eventos";
		$tarea = "Listado de Eventos";
		$link_tarea = "evento.php";
		$titulo = "Evento: II full day de gestión de TI";
	}
	$eventoID = "";
	if(isset($_POST['eventoID'])){
		$eventoID = $_POST['eventoID'];
	}
?>
<!DOCTYPE html>
<html lang="en">
	<!-- head -->
	<?php  require('head.php') ?>

	<body class="no-skin">
		<?php require('../sup_layout.php'); ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<?php require('menuLateral.php') ?>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="javascript:;"><?= $grupo ?></a>
                            </li>
                            <li><a href="<?= $link_tarea; ?>"><?= $tarea ?></a></li>
                            <li>
                                <span class="invoice-info-label">Fecha:</span>
                                <span class="blue"><?= date('d-m-Y'); ?></span>
                            </li>                            
                            
                        </ul><!-- /.breadcrumb -->				
					</div>

					<div class="page-content">					
						<div class="page-header">
							<h1> <?= $titulo  ?></h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">
								<form id="frmEvento" action="evento.php" method="POST">
									<div class="Contenedor  widget-box">
										<div class="table-header">
											Datos generales del evento
							      		</div>
								      	<div class="widget-main row">
								      		<input type="text" hidden class="hidden" class="form-control input-sm" id="txtEventoID" name="txtEventoID" value="0">
								      		<div class="col-md-4 col-md-offset-1  form-group">
												<label><strong> Sucursal  </strong></label>
												<select disabled class="form-control input-sm" id="cboSucursal" name="cboSucursal">
												</select>
						      				</div>
						      				<div class="col-md-6 form-group">
												<label><strong> Nombre del evento  </strong></label>
												<input disabled type="text" class="form-control input-sm" id="txtNombre" name="txtNombre" style="text-transform: uppercase" >
						      				</div>
						      				<div class="col-md-2 col-md-offset-1 form-group">
												<label><strong> Fecha inicio </strong></label>
												<input disabled class="form-control input-sm" id="txtFechaI" name="txtFechaI" type="date" onfocus="this.oldvalue = this.value;" onchange="validarFechaI(this);this.oldvalue = this.value;">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Fecha fin </strong></label>
												<input disabled class="form-control input-sm" id="txtFechaF" name="txtFechaF" type="date" onfocus="this.oldvalue = this.value;" onchange="validarFechaF(this);this.oldvalue = this.value;">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Duración </strong>(Días)</label>
												<input disabled type="text" class="form-control input-sm" id="txtDuracion" name="txtDuracion" style="text-align: center">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Precio del evento </strong>(S/.)</label>
												<input disabled type="text" class="form-control input-sm" id="txtPrecioT" name="txtPrecioT">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Estado </strong></label>
												<select disabled class="form-control input-sm" id="cboEstadoEven" name="cboEstadoEven">
													<option value="1"> Activo </option>
													<option value="0"> Inactivo </option>
												</select>
						      				</div>
						      				<div class="col-md-6 col-md-offset-1 form-group">
												<label><strong> Descripción </strong></label>
												<textarea disabled class="form-control input-sm" id="txtDescripcionEven" name="txtDescripcionEven"></textarea>
						      				</div>
						      				<div class="col-md-5 form-group">
						      					<br>
												<span class="help-inline col-xs-12 col-sm-7">
													<label class="middle">
														<input class="ace" type="checkbox" id="rbParalelo" name="rbParalelo" value="SI">
														<span class="lbl"><strong> Permite actividades en paralelo</strong></span>
													</label>
												</span>
						      				</div>						      				
								      	</div>
								      	<div class="form-actions center" style="margin-bottom:-0px; display:none" id="accionesEvento" >
											<button disabled type="button" id="btnActualizarEvento"  name="btnActualizarEvento" class="btn btn-sm btn-success" onclick="actualizarEvento('<?= $eventoID; ?>')">
												Actualizar
											</button>
											<button disabled type="button" id="btnCancelar" class="btn btn-sm btn-grey " onclick="habilitarEditor(false);cargar_datos_generales();">
												Cancelar
											</button>
											<div class="widget-toolbar action-buttons" id="btnEditar">
												<button type="button" class="btn btn-sm btn-primary" onclick="habilitarEditor(true);">
													<a href="#" data-action="reload">
														<i class="ace-icon fa fa-pencil white"></i>
													</a>
													Editar datos generales
												</button>
											</div>
										</div>
									</div>
									<!-- Contenedor Datos generales del evento -->
								</form>
							</div>
							<div class="col-md-12">

								<div class="Contenedor widget-box">
									<div class="table-header">
										Lista de actividades
										&nbsp;&nbsp;
										<a  href="javascript:;" onclick="limpiar_form_activ();abrirModal('#modalActividad');" id="nueva_actividad" class="white">
				                            <i class='ace-icon fa fa-plus-circle bigger-150'></i>
				                        </a>
						      		</div>
							      	<div class="widget-main">
							      		<table id="tabla_actividades" class="table table-striped table-bordered">
											<thead>
									            <tr>
									                <th>Código</th>
									                <th>Actividad</th>
									                <th>Ponente</th>
									                <th>Fecha</th>
									                <th>Hora Inicio - Fin</th>
									                <th>Precio</th>
									                <th>Tipo actividad</th>
									                <th title="Número de inscritos">N° Ins.</th>
									                <th>Estado</th>
									                <th></th>
									            </tr>
											</thead>
											<tbody id="cuerpo_tabla_actividades">
												<!-- Lista de eventos -->
											</tbody>
										</table>
							      	</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<!-- Contenedor Lista de actividades -->
						</div>




					</div>
					<!-- /.page-content -->							
				<div class="footer">
					<div class="footer-inner">
						<div class="footer-content">
							<span class="bigger-120">
								<span class="blue bolder">BSE Events</span>
								&copy; 2016
							</span>						
						</div>
					</div>					
				</div>				
				<!-- footer -->
				<div class="modal fade" id="modalActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 60% !important;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title text-center" id="cabeceraRegistro"><b>Actividad</b></h4>
                        </div>
                        <div class="modal-body">
                       <form action="" method="POST" class="form-horizontal" id="form_actividad"> 
                       		<div id="mensaje"></div>
                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" method="POST">
		                        <div class="row">
		                        	<input class="hidden" hidden  id="txtActividadID" name="txtActividadID">
		                        	<div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Tipo actividad</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboTipoActividad" name="cboTipoActividad"  autofocus="" style="text-transform: uppercase">
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Actividad</label>
		                               <div class="col-md-7">
		                                   <input class="form-control" id="txtActividad" name="txtActividad" type="text" style="text-transform: uppercase">
		                               </div>		                                                  
		                            </div>	
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Descripción</label>
		                               <div class="col-md-7">
		                                   <textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Ponente</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboPonente" name="cboPonente" style="text-transform:uppercase;" >
		                                   		<option value="0">-- Seleccionar ponente--</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Local</label>
		                               	<div class="col-md-7">
		                                   	<select class="form-control input-sm" id="cboLocal" name="cboLocal" style="text-transform: uppercase" onchange="cargarCboAmbientes();">
		                                   		<option value="0">-- Seleccionar local --</option>
		                                   	</select>
		                               	</div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Ambiente</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboAmbiente" name="cboAmbiente" style="text-transform: uppercase">
		                                   		<option value="0">-- Seleccionar ambiente--</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Fecha</label>
		                               <div class="col-md-4">
		                                   <input class="form-control" id="txtFecha" name="txtFecha" type="date" onblur="validarFecha(this.value)">
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2   col-md-offset-1  control-label">Hora Inicio / Fin </label>
		                               <div class="col-md-3">
		                                   <div class="bootstrap-timepicker">
								                  <div class="input-group">
								                    <input type="text" class="form-control timepicker" id="txtHoraI" name="txtHoraI"  onchange="habilitarHoraF(); recorrerTabla();">

								                    <div class="input-group-addon">
								                      <i class="fa fa-clock-o"></i>
								                    </div>
								                  </div>
								                  <!-- /.input group -->
								            </div>
		                               	</div>
		                                <div class="col-md-3">
		                                   <div class="bootstrap-timepicker">
								                  <div class="input-group">
								                    <input type="text" class="form-control timepicker" id="txtHoraF" name="txtHoraF"  onchange="validarHoraF();" disabled>

								                    <div class="input-group-addon">
								                      <i class="fa fa-clock-o"></i>
								                    </div>
								                  </div>
								                  <!-- /.input group -->
								            </div>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Precio</label>
		                               <div class="col-md-4">
		                                   <input class="form-control" id="txtPrecio" name="txtPrecio" type="text" onkeypress="return soloNumeroDecimal(event);" maxlength="7">
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Estado</label>
		                               <div class="col-md-4">
		                                   <select class="form-control input-sm" id="cboEstado" name="cboEstado">
		                                   		<option value="A"> Activo </option>
		                                   		<option value="I"> Inactivo </option>
		                                   </select>

		                               </div>
		                            </div>
			                        <div class="modal-footer">
			                            <button type="button" class="btn btn-primary" id="btnCerrarActiv" onclick="cerrarModal('#modalActividad');">Regresar</button> 
			                            <button type="button" class="btn btn-primary" id="btnGuardarActiv" onclick="guardar_actividad();"> Registrar </button>
			                        </div>
		                    </form>
                        </form>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Modal -->
				<input type="hidden" dissabled="true" value="<?= $grupo  ?>" id="NombreGrupo">
                <input type="hidden" dissabled="true" value="<?= $tarea  ?>" id="NombreTarea">
				<!-- FIN DE CONTENIDO DE PAGINA -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	</body>
</html>

<?php require('footer.php') ?>

<script type="text/javascript">
function habilitarHoraF(){
	horarioI = $('#txtHoraI').val();
	if(horarioI == ""){
		$('#txtHoraF').attr('disabled',true);
		$('#txtHoraF').parent().removeClass('has-error');
	}else{
		$('#txtHoraF').attr('disabled',false);
	}
	horarioF = $('#txtHoraF').val();
	if(horarioF!=""){
		validarHoraF();
	}
}
function validarHoraF(){	
	horarioI = $('#txtHoraI').val();
	horaI = "";
	minI = "";
	tipoI = "";
	tempI = horarioI.split(':');
	horaI = tempI[0];
	tempI = tempI[1].split(' ');
	minI = tempI[0];
	tipoI = tempI[1];

	horarioF = $('#txtHoraF').val();
	horaF = "";
	minF = "";
	tipoF = "";
	tempF = horarioF.split(':');
	horaF = tempF[0];
	tempF = tempF[1].split(' ');
	minF = tempF[0];
	tipoF = tempF[1];
	if(tipoI == 'PM' && tipoF == 'AM' ) $('#txtHoraF').parent().addClass('has-error');
	else if(tipoI == 'AM' && tipoF == 'PM' ) $('#txtHoraF').parent().removeClass('has-error');
		 else if( tipoI == tipoF )
				if( parseInt(horaI) > parseInt(horaF) ) $('#txtHoraF').parent().addClass('has-error'); 
				else if( parseInt(horaI) < parseInt(horaF) ) $('#txtHoraF').parent().removeClass('has-error');
					else if( parseInt(horaI) == parseInt(horaF) )
						if( parseInt(minI) >= parseInt(minF) ) $('#txtHoraF').parent().addClass('has-error'); 
						else $('#txtHoraF').parent().removeClass('has-error');
	 // $(element).parent().addClass('has-error');
	// else $(element).parent().removeClass('has-error');
}
function validarFechaI (text) {	
	if($('#txtFechaI').val() == ''){
		alert("Seleccione una fecha válida");
		$('#txtFechaI').val(text.oldvalue);
		return false;
	}	
	// Fecha  inicial
	var fechaI = $('#txtFechaI').val();
	ArrayfechaI = fechaI.split("-");
	fechaI = "" + ArrayfechaI[2] +'-'+ (ArrayfechaI[1]) +'-'+ ArrayfechaI[0] + "";
	// Fecha final
	var fechaF = $('#txtFechaF').val();
	ArrayfechaF = fechaF.split("-");
	fechaF = "" + ArrayfechaF[2] +'-'+ (ArrayfechaF[1]) +'-'+ ArrayfechaF[0] + "";
	if(diferenciaFechasDMA(fechaI,fechaF) < 0){
		alert("Fecha no válida.\nSeleccione una fecha anterior a la fecha final.");
		$('#txtFechaI').val(text.oldvalue);
		return false;
	}
	if(diferenciaFechasDMA(hoyDMA,fechaI) < 0){
		alert("Fecha no válida.\nSeleccione una fecha posterior a hoy.");
		$('#txtFechaI').val(text.oldvalue);
		return false;
	}
	var Dias = GetDias(fechaI,fechaF)+1;
	$('#txtDuracion').val(Dias);
}
function validarFechaF(text){
	if($('#txtFechaF').val() == ''){
		alert("Seleccione una fecha válida");
		$('#txtFechaF').val(text.oldvalue);
		return false;
	}
	var fechaI = $('#txtFechaI').val();
	ArrayfechaI = fechaI.split("-");
	fechaI = "" + ArrayfechaI[2] +'-'+ (ArrayfechaI[1]) +'-'+ ArrayfechaI[0] + "";
	var fechaF = $('#txtFechaF').val();
	ArrayfechaF = fechaF.split("-");
	fechaF = "" + ArrayfechaF[2] +'-'+ (ArrayfechaF[1]) +'-'+ ArrayfechaF[0] + "";

	if(diferenciaFechasDMA(fechaI,fechaF) < 0){
		alert("Fecha no válida.\nSeleccione una fecha posterior a la fecha inicial.");
		$('#txtFechaF').val(text.oldvalue);
		return fale;
	}
	var Dias = GetDias(fechaI,fechaF)+1;
	$('#txtDuracion').val(Dias);
}
function actualizarEvento(eventoID){
	$('#btnActualizarEvento').prop("disabled", true);
	var opcion = 4;  
	valorNoValido('#cboSucursal',0);
	inputMinimo('#txtNombre',2);
	inputMinimo('#txtFechaI',1);
	inputMinimo('#txtFechaF',1);
	inputMinimo('#txtPrecioT',1);

    if(document.getElementsByClassName("has-error").length > 0){
      alert("Verifique los datos ingresados");
      $('#btnActualizarEvento').prop("disabled", false);
      return false;
    }
    var formData = new FormData($('#frmEvento')[0]);
    formData.append("opcion",opcion);
    $.ajax({
      	url: '../../controller/controlEvento/evento_controller.php',
      	type: "post",
      	dataType: "html",
      	data: formData,
      	cache: false,
	    contentType: false,
      	processData: false,
      	success: function(rpta){
        	if(rpta > 0 ){
        		alert("Modificación exitosa");
        		habilitarEditor(false);
        	}else{
	        	alert("No se pudo modificar el evento:" + rpta);
	        	cargar_datos_generales();
        	}
      	},
      	error: function(rpta){
        	alert("Error en la operación: \n"+rpta);
        	$('#btnActualizarEvento').prop("disabled", false);
      	}
    });
}
function editarActividad(actividadID){
	verActividad(actividadID);
	$('#btnGuardarActiv').show('fast');
	$('#btnGuardarActiv').html("Actualizar");
}
function tomarAsistencia(actividadID){
	location.href='asistencia_actividad.php?actividadID='+actividadID;    	
}


function verActividad(actividadID){
	abrirModal('#modalActividad');
	limpiar_form_activ();
	$('#btnGuardarActiv').hide();
	var opcion = 4;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion+'&txtActividadID='+actividadID,
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		var obj = JSON.parse(data);
      		$('#cboTipoActividad').val(obj.actividad[0].TipoActi_idTipoActividad);
      		$('#txtActividad').val(obj.actividad[0].Acti_nombre);
      		$('#txtDescripcion').val(obj.actividad[0].Acti_descripcion);
      		$('#cboPonente').val(obj.actividad[0].Pon_idPonente);
      		$('#cboLocal').val(obj.actividad[0].Loc_idLocal);
      		
      		$('#txtFecha').val(obj.actividad[0].Acti_fecha);
      		$('#txtHoraI').val(obj.actividad[0].Acti_horaInicio);
      		$('#txtHoraF').val(obj.actividad[0].Acti_horaFin);
      		$('#txtHoraF').attr('disabled',false);
      		$('#txtPrecio').val(obj.actividad[0].Acti_precio);
      		$('#cboEstado').val(obj.actividad[0].estado);
      		$('#txtActividadID').val(obj.actividad[0].Acti_idActividad);
			cargarCboAmbientes();
			ambienteID = obj.actividad[0].Amb_idAmbiente
			setTimeout("$('#cboAmbiente').val(ambienteID)",500);      		
      	},
      	error: function(data){
                 
      	}
  	});
}
function habilitarEditor(opc){
	$('#btnActualizarEvento').prop("disabled", !opc);
	$('#btnCancelar').prop("disabled", !opc);
	$('#cboSucursal').prop("disabled", !opc);
	$('#txtNombre').prop("disabled", !opc);
	$('#txtFechaI').prop("disabled", !opc);
	$('#txtFechaF').prop("disabled", !opc);
	$('#txtDuracion').prop("disabled", !opc);
	$('#txtDuracion').prop("readonly", opc);
	$('#txtPrecioT').prop("disabled", !opc);
	$('#cboEstadoEven').prop("disabled", !opc);
	$('#rbParalelo').prop("disabled", !opc);
	$('#txtDescripcionEven').prop("disabled", !opc);
	if(opc){
		$('#btnEditar').hide("slow");
	}else{
		$('#btnEditar').show("slow");
	}
}
function limpiar_form_activ(){
	$('#cboTipoActividad').val("0");
	$('#cboTipoActividad').parent().removeClass('has-error');
	$('#txtActividad').val("");
	$('#txtActividad').parent().removeClass('has-error');
	$('#txtDescripcion').val("");
	$('#txtDescripcion').parent().removeClass('has-error');
	$('#cboPonente').val("0");
	$('#cboPonente').parent().removeClass('has-error');
	$('#cboAmbiente').val("0");
	$('#cboAmbiente').parent().removeClass('has-error');
	$('#txtFecha').val("");
	$('#txtFecha').parent().removeClass('has-error');
	$('#txtHoraI').val("");
	$('#txtHoraI').parent().removeClass('has-error');
	$('#txtHoraF').val("");
	$('#txtHoraF').parent().removeClass('has-error');
	$('#txtHoraF').attr('disabled',true)
	$('#txtPrecio').val("");
	$('#txtPrecio').parent().removeClass('has-error');
	$('#cboEstado').val("A");
	$('#cboEstado').parent().removeClass('has-error');
	$('#btnGuardarActiv').show('slow');
	$('#btnGuardarActiv').html("Guardar");
	$('#txtActividadID').val("0");
}
function guardar_actividad(){
	if(document.getElementsByClassName("has-error").length > 0){
      	alert("Verifique los datos ingresados");
      	return false;
    }
	actividadID = $('#txtActividadID').val();
	if(actividadID > 0) var opcion = 5;
	else var opcion = 1;
	
	valorNoValido('#cboTipoActividad',0);
	valorNoValido('#cboAmbiente',0);
	inputMinimo('#txtActividad',2);
	inputMinimo('#txtFecha',1);
	inputMinimo('#txtPrecio',1);
	inputMinimo('#txtHoraI',1);
	inputMinimo('#txtHoraF',1);

    if(document.getElementsByClassName("has-error").length > 0){
      alert("Verifique los datos ingresados");
      return false;
    }
    var formData = new FormData($('#form_actividad')[0]);
    formData.append("opcion",opcion);
    formData.append("txtEventoID",'<?= $eventoID; ?>');
    $.ajax({
      url: '../../controller/controlActividad/actividad_controller.php',
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(rpta){
        if(rpta == 1){
        	cerrarModal('#modalActividad');
        	listar_actividades();
        	limpiar_form_activ();
        	if(actividadID > 0) alert("Modificación exitosa");
			else alert("Registro exitoso");        	
        }else{
        	if(actividadID > 0) alert("No se pudo modificar la actividad: \n"+rpta);
			else alert("No se pudo registrar la actividad: \n"+rpta);
        }
      },
      error: function(rpta){
        alert("Error en la operacion: \n"+rpta);
      }
    });
}
function cargardatos(){
	cargar_datos_generales();
}
function cargar_datos_generales(){ 
  	var opcion = 2;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion+'&txtEventoID='+'<?= $eventoID; ?>',
      	url: '../../controller/controlEvento/evento_controller.php',
      	success: function(data){
      		var obj = JSON.parse(data);
      		$('#txtNombre').val(obj.evento[0].Even_nombre);
      		$('#txtFechaI').val(obj.evento[0].Even_fechaInicio);
      		$('#txtFechaF').val(obj.evento[0].Even_fechaFin);
      		$('#txtDuracion').val(obj.evento[0].Even_duracion);
      		$('#txtPrecioT').val(obj.evento[0].Even_precioTotal);
      		$('#txtDescripcionEven').val(obj.evento[0].Even_descripcion);
      		$('#cboEstadoEven').val(obj.evento[0].Even_estado);
      		$('#cboSucursal').val(obj.evento[0].Suc_idSucursal);
      		$('#txtEventoID').val(<?= $eventoID; ?>);
      		if(obj.evento[0].Even_simultaneo == 'SI'){
      			document.getElementById("rbParalelo").checked = true;
      		}
      		
      		habilitarEditor(false);
      		// Verificar si la fecha es pasada la de hoy
      		var fechaFinal = obj.evento[0].Even_fechaFin;
			ArrayfechaFinal = fechaFinal.split("-");
			fechaFinal = "" + ArrayfechaFinal[2] +'-'+ (ArrayfechaFinal[1]) +'-'+ ArrayfechaFinal[0] + "";
			if(diferenciaFechasDMA(hoyDMA,fechaFinal) < 0){
				//No realizar acciones
				return true;
			}else{
				$('#accionesEvento').show();
			}
      	},
      	error: function(data){
                 
      	}
  	});
}

function cargarCboTiposActiv(){ 
  	var opcion = 6;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion,
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		$('#cboTipoActividad').html(data);
      	},
      	error: function(data){
                 
      	}
  	});
}
function cargarCboSucursales(){
	var opcion = 6;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion,
      	url: '../../controller/controlEvento/evento_controller.php',
      	success: function(data){
      		$('#cboSucursal').html(data);
      	},
      	error: function(data){
                 
      	}
  	});
}
function cargarCboPonente(){ 
  	var opcion = 7;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion,
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		$('#cboPonente').html(data);
      	},
      	error: function(data){
                 
      	}
  	});
}
function cargarCboAmbientes(){
	var localID = $('#cboLocal').val();
  	var opcion = 8;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion+'&cboLocal='+localID,
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		$('#cboAmbiente').html(data);
      	},
      	error: function(data){
                 
      	}
  	});
}
function cargarCboLocales(){ 
  	var opcion = 'combo_locales';
  	$.ajax({
      	type: 'POST',        
      	data:'param_opcion='+opcion,
      	url: '../../controller/controlMantenedores/local_controller.php',
      	success: function(data){
      		$('#cboLocal').html(data);
      	},
      	error: function(data){
                 
      	}
  	});
}
function listar_actividades(){
  	var opcion = 3;
  	$.ajax({
      	type: 'POST',
      	data:'opcion='+opcion+'&txtEventoID='+'<?= $eventoID; ?>',
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		// alert(data);
          	$('#tabla_actividades').DataTable().destroy();
          	$('#cuerpo_tabla_actividades').html(data);
          	$('#tabla_actividades').DataTable();
      	},
      	error: function(data){
                 
      	}
  	});
}
function eliminarActividad(eventoID,actividadID){
	r = confirm("¿Seguro que desea eliminar la actividad?\nRecuerde que no podrá revertir la operación.");
  	if (!r) return false;
	opcion = 9;
	$.ajax({
		type: 'POST',
		data: 'opcion='+opcion+'&txtEventoID='+eventoID+'&txtActividadID='+actividadID,
		url: '../../controller/controlActividad/actividad_controller.php',
		success: function(rpta){
			if(rpta==1){
				alert("Eliminación exitosa");
				listar_actividades();
			}else{
				alert("No se pudo eliminar la actividad:\n"+rpta);
			}
		},
		error: function(rpta){
			alert(rpta);
		}
	});
}
function validarFecha(fechita){
	var fechaI = $('#txtFechaI').val();
	var fechaF = $('#txtFechaF').val();
	//validar fecha  con la inicial
	ArrayfechaI = fechaI.split("-");
	fechaI = "" + ArrayfechaI[2] +'-'+ (ArrayfechaI[1]) +'-'+ ArrayfechaI[0] + "";
	//--
	Arrayfechita = fechita.split("-");
	fechita = "" + Arrayfechita[2] +'-'+ (Arrayfechita[1]) +'-'+ Arrayfechita[0] + "";
	//--
	ArrayfechaF = fechaF.split("-");
	fechaF = "" + ArrayfechaF[2] +'-'+ (ArrayfechaF[1]) +'-'+ ArrayfechaF[0] + "";
	if(diferenciaFechasDMA(fechaI,fechita) < 0){
		mensaje = "Fecha no válida. \nSeleccione una fecha posterior a ";
		mensaje = mensaje + "" + fechaI;
		alert(mensaje);
		$('#txtFecha').val("");
		return;
	}
	if(diferenciaFechasDMA(fechita,fechaF) < 0){
		mensaje = "Fecha no válida. \nSeleccione una fecha anterior a ";
		mensaje = mensaje + "" + fechaF;
		alert(mensaje);
		$('#txtFecha').val("");
		return;
	}
}
function recorrerTabla(){
	return;
	var horasInicio = 0;
	var horasFin = 0;
	var arrayInicio = new Array();
	var arrayFin 	= new Array();

  	$("#tabla_actividades tbody tr").each(function (index) {
        var horario = "";var temp;
        $(this).children("td").each(function (index2) {
            switch (index2) {
                case 4: horario = $(this).text();
                        break;
            }
            temp = horario.split(" - ");
            
            $(this).css("background-color", "#ECF8E0");
        })
        arrayInicio[horasInicio++] = temp[0];
        arrayFin[horasFin++] = temp[1];
    })
    alert(arrayInicio[1]);
    alert(arrayFin[1]);
}
</script>
<script type="text/javascript">
	limpiar_form_activ();
	cargarCboTiposActiv();
	cargarCboPonente();
	cargarCboLocales();
	
	listar_actividades();
	cargarCboSucursales();
	$(".timepicker").timepicker({
      showInputs: false
    });
	<?php if (isset($_POST['eventoID'])): ?>
		cargardatos();
	<?php endif ?>
</script>
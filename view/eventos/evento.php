
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
		$grupo = "Gestión de eventos";
		$tarea = "Listado de eventos";
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
								<div class="Contenedor  widget-box">
									<div class="table-header">
										Datos generales del evento
						      		</div>
							      	<div class="widget-main row">
							      		<div class="col-md-4 col-md-offset-1  form-group">
											<label><strong> Sucursal  </strong></label>
											<select disabled class="form-control input-sm" id="cboSucursal" name="cboSucursal">
											</select>
					      				</div>
					      				<div class="col-md-6 form-group">
											<label><strong> Nombre del evento  </strong></label>
											<input disabled type="text" class="form-control input-sm" id="txtNombre" name="txtNombre">
					      				</div>
					      				<div class="col-md-2 col-md-offset-1 form-group">
											<label><strong> Fecha inicio </strong></label>
											<input disabled class="form-control input-sm" id="txtFechaI" name="txtFechaI" type="date">
					      				</div>
					      				<div class="col-md-2 form-group">
											<label><strong> Fecha fin </strong></label>
											<input disabled class="form-control input-sm" id="txtFechaF" name="txtFechaF" type="date">
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
							      	</div>
							      	<div class="form-actions center" style="margin-bottom:-0px;">
										<button disabled type="button" id="btnActualizar"  class="btn btn-sm btn-success">
											Actualizar
										</button>
										<button disabled type="button" id="btnCancelar" class="btn btn-sm btn-grey " onclick="habilitarEditor(false);">
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
		                        	<div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Tipo actividad</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboTipoActividad" name="cboTipoActividad"  autofocus="">
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
		                                   <select class="form-control input-sm" id="cboPonente" name="cboPonente">
		                                   		<option value="0">-- Seleccionar --</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Ambiente</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboAmbiente" name="cboAmbiente">
		                                   		<option value="0">-- Seleccionar --</option>
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
								                    <input type="text" class="form-control timepicker" id="txtHoraI" name="txtHoraI" value="">

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
								                    <input type="text" class="form-control timepicker" id="txtHoraF" name="txtHoraF" value="">

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
function editarActividad(actividadID){
	verActividad(actividadID);
	$('#btnGuardarActiv').show();
	$('#btnGuardarActiv').html("Actualizar");
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
      		$('#cboAmbiente').val(obj.actividad[0].Amb_idAmbiente);
      		$('#txtFecha').val(obj.actividad[0].Acti_fecha);
      		$('#txtHoraI').val(obj.actividad[0].Acti_horaInicio);
      		$('#txtHoraF').val(obj.actividad[0].Acti_horaFin);
      		$('#txtPrecio').val(obj.actividad[0].Acti_precio);
      		$('#cboEstado').val(obj.actividad[0].estado);
      	},
      	error: function(data){
                 
      	}
  	});
}
function habilitarEditor(opc){
	$('#btnActualizar').prop("disabled", !opc);
	$('#btnCancelar').prop("disabled", !opc);
	$('#cboSucursal').prop("disabled", !opc);
	$('#txtNombre').prop("disabled", !opc);
	$('#txtFechaI').prop("disabled", !opc);
	$('#txtFechaF').prop("disabled", !opc);
	$('#txtPrecioT').prop("disabled", !opc);
	$('#cboEstadoEven').prop("disabled", !opc);
	$('#txtDescripcionEven').prop("disabled", !opc);
	if(opc){
		$('#btnEditar').hide("slow");
	}else{
		$('#btnEditar').show("slow");
	}
}
function limpiar_form_activ(){
	$('#cboTipoActividad').val("0");
	$('#txtActividad').val("");
	$('#txtDescripcion').val("");
	$('#cboPonente').val("0");
	$('#cboAmbiente').val("0");
	$('#txtFecha').val("");
	$('#txtHoraI').val("");
	$('#txtHoraF').val("");
	$('#txtPrecio').val("");
	$('#cboEstado').val("A");
	$('#btnGuardarActiv').show('slow');
	$('#btnGuardarActiv').html("Guardar");
}
function guardar_actividad(){
	var opcion = 1;
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
        	alert("Registro exitoso");
        }else{
        	alert("No se pudo registrar el evento");
        }
      },
      error: function(rpta){
        alert("Error en el registro del protocolo: \n"+rpta);
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
      		window.setTimeout($('#cboSucursal').val(obj.evento[0].Suc_idSucursal), 2000);      		
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
  	var opcion = 8;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion,
      	url: '../../controller/controlActividad/actividad_controller.php',
      	success: function(data){
      		$('#cboAmbiente').html(data);
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
function validarFechaI () {
	if($('#txtFechaI').val() == ''){
		alert("Seleccione una fecha válida");
		$('#txtFechaF').val("");
		$('#txtDuracion').val("");
		$('#txtFechaF').prop("disabled", true);
		return false;
	}else{		
		$('#txtFechaF').prop("disabled", false);
	}
	var fechaI = $('#txtFechaI').val();
	ArrayfechaI = fechaI.split("-");
	fechaI = "" + ArrayfechaI[2] +'-'+ (ArrayfechaI[1]) +'-'+ ArrayfechaI[0] + "";
	if(diferenciaFechasDMA(hoyDMA,fechaI) < 0){
		alert("Fecha no válida.\nSeleccione una fecha posterior a hoy.");
		$('#txtFechaI').val("");
		$('#txtFechaF').val("");
		$('#txtDuracion').val("");
		$('#txtFechaF').prop("disabled", true);
	}
}
</script>
<script type="text/javascript">
	limpiar_form_activ();
	cargarCboTiposActiv();
	cargarCboPonente();
	cargarCboAmbientes();
	listar_actividades();
	cargarCboSucursales();
	$(".timepicker").timepicker({
      showInputs: false
    });
	<?php if (isset($_POST['eventoID'])): ?>
		cargardatos();
	<?php endif ?>
</script>
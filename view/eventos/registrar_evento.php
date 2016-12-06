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
		$tarea = "Nuevo evento";
		$link_tarea = "registrar_evento.php";
		$titulo = "Registrar nuevo evento";
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
									<form id="frmEvento" action="evento.php" method="POST" onsubmit="return validarForm();">
										<div class="table-header">
											Datos generales del evento
							      		</div>
								      	<div class="widget-main row">
								      		<div class="col-md-12 form-group" hidden>
												<input type="hidden" class="form-control input-sm" id="eventoID" name="eventoID">
						      				</div>
								      		<div class="col-md-4 col-md-offset-1 form-group">
												<label><strong> Sucursal  </strong></label>
												<select class="form-control input-sm" id="cboSucursal" name="cboSucursal">
												</select>
						      				</div>
						      				<div class="col-md-6 form-group">
												<label><strong> Nombre del evento  </strong></label>
												<input style="text-transform: uppercase" type="text" class="form-control input-sm" id="txtNombre" name="txtNombre">
						      				</div>
						      				<div class="col-md-2 col-md-offset-1 form-group">
												<label><strong> Fecha inicio </strong></label>
	                                       		<input class="form-control" id="txtFechaI" name="txtFechaI" type="date"  onchange="validarFechaI();">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Fecha fin </strong></label>
	                                       		<input disabled class="form-control" id="txtFechaF" name="txtFechaF" type="date" onchange="validarFechaF();"  >
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Duración </strong>(Dias)</label>
	                                       		<input style="text-align:center;"class="form-control" id="txtDuracion" name="txtDuracion" type="text" onkeypress="return soloNumeroDecimal(event);" readonly>
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Precio del evento </strong>(S/.)</label>
	                                       		<input class="form-control" id="txtPrecioT" name="txtPrecioT" type="text" onkeypress="return soloNumeroDecimal(event);" maxlength="7" placeholder="S/.">
						      				</div>
						      				<div class="col-md-2 form-group">
												<label><strong> Estado </strong></label>
												<select class="form-control input-sm" id="cboEstado" name="cboEstado">
													<option value="1"> Activo </option>
													<option value="0"> Inactivo </option>
												</select>
						      				</div>
						      				<div class="col-md-6 col-md-offset-1 form-group">
												<label><strong> Descripción </strong></label>
												<textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
						      				</div>
								      	</div>
								      	<div class="form-actions center"style="margin-bottom:-0px;">
											<button type="button"  id="btnGuardar" class="btn btn-sm btn-success" onclick="guardarEvento();">
												Guardar
												<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
											</button>
											<button type="submit" style="display:none" id="btnActividades" class="btn btn-sm btn-primary">
												Registrar actividades al evento
												<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
											</button>
										</div>
									</form>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
						</div>
					</div><!-- /.page-content -->
				<input type="hidden" dissabled="true" value="<?= $grupo  ?>" id="NombreGrupo">
                <input type="hidden" dissabled="true" value="<?= $tarea  ?>" id="NombreTarea">
				<!-- FIN DE CONTENIDO DE PAGINA -->

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

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	</body>
</html>

<?php require('footer.php') ?>

<script type="text/javascript">
function validarForm () {
	if($('#eventoID').val() != '' ){
		return true;
	}else{
		return false;
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
function validarFechaF(){
	if($('#txtFechaF').val() == ''){
		$('#txtDuracion').val("");
		alert("Seleccione una fecha válida");
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
		$('#txtFechaF').val("");
		$('#txtDuracion').val("");
	}else{
		var Dias = GetDias(fechaI,fechaF)+1;
		$('#txtDuracion').val(Dias);
	}
	
}
function guardarEvento(){
	$('#btnGuardar').prop("disabled", true);
	var opcion = 1;
	valorNoValido('#cboSucursal',0);
	inputMinimo('#txtNombre',2);
	inputMinimo('#txtFechaI',1);
	inputMinimo('#txtFechaF',1);
	inputMinimo('#txtPrecioT',1);

    if(document.getElementsByClassName("has-error").length > 0){
      alert("Verifique los datos ingresados");
      $('#btnGuardar').prop("disabled", false);
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
        		alert("Registro exitoso");
        		rpta = $.trim(rpta);
        		$('#eventoID').val(rpta);
				$('#btnGuardar').hide('slow');
				$('#btnActividades').show('slow');

				bloquearControles(true);
        	}else{
	        	alert("No se pudo registrar el evento");
	        	$('#btnGuardar').prop("disabled", false);
        	}
      	},
      	error: function(rpta){
        	alert("Error en el registro del protocolo: \n"+rpta);
        	$('#btnGuardar').prop("disabled", false);
      	}
    });
} 
function bloquearControles(opc){
	$('#txtNombre').prop("disabled", true);
	$('#txtDuracion').prop("disabled", true);
	$('#txtDescripcion').prop("disabled", true);
	$('#txtFechaF').prop("disabled", true);
	$('#txtFechaI').prop("disabled", true);
	$('#txtPrecioT').prop("disabled", true);
	$('#cboSucursal').prop("disabled", true);
	$('#cboEstado').prop("disabled", true);
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
</script>
<script type="text/javascript">
	cargarCboSucursales();
</script>
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
									<form id="frmEvento">
										<div class="table-header">
											Datos generales del evento
							      		</div>
								      	<div class="widget-main row">
								      		<div class="col-md-offset-4 col-md-4 form-group">
												<label><strong> Sucursal  </strong></label>
												<select class="form-control input-sm" id="cboSucursal" name="cboSucursal">
													<option value="0">-- Seleccionar --</option>
												</select>
						      				</div>
						      				<div class="col-md-offset-4 col-md-4 form-group">
												<label><strong> Nombre del evento  </strong></label>
												<input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre">
						      				</div>
						      				<div class="col-md-offset-4 col-md-4 form-group">
												<label><strong> Fecha inicio </strong></label>
	                                       		<input class="form-control" id="txtFechaI" name="txtFechaI" type="date" autofocus="">
						      				</div>
						      				<div class="col-md-offset-4 col-md-4 form-group">
												<label><strong> Descripción </strong></label>
												<textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
						      				</div>
						      				<div class="col-md-offset-4 col-md-4 form-group">
												<label><strong> Estado </strong></label>
												<select class="form-control input-sm" id="cboEstado" name="cboEstado">
													<option value="1"> Activo </option>
													<option value="0"> Inactivo </option>
												</select>
						      				</div>
								      	</div>
								      	<div class="form-actions center" style="margin-bottom:-0px;">
											<button type="button" class="btn btn-sm btn-success" onclick="guardarEvento();">
												Guardar
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
function guardarEvento(url){
	var opcion = 1;
	if($.trim($('#txtNombre').val()).length==0){
		$('#txtNombre').parent().addClass('has-error');
	}else{
		$('#txtNombre').parent().removeClass('has-error');
	}
	if($.trim($('#txtFechaI').val()).length==0){
		$('#txtFechaI').parent().addClass('has-error');
	}else{
		$('#txtFechaI').parent().removeClass('has-error');
	}

    if(document.getElementsByClassName("has-error").length > 0){
      alert("Verifique los datos ingresados");
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
      	alert(rpta);
        if(rpta == 1){
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
</script>

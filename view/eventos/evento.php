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
							      		<div class="col-md-5 form-group">
											<label><strong> Sucursal  </strong></label>
											<select class="form-control input-sm" id="cboSucursal" name="cboSucursal">
												<option value="0">-- Seleccionar --</option>
											</select>
					      				</div>
					      				<div class="col-md-7 form-group">
											<label><strong> Nombre del evento  </strong></label>
											<input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Fecha inicio </strong></label>
											<input type="text" class="form-control input-sm" id="txtFechaI" name="txtFechaI">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Fecha fin </strong></label>
											<input type="text" class="form-control input-sm" id="txtFechaF" name="txtFechaF">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Duración </strong>(Días)</label>
											<input type="text" class="form-control input-sm" id="txtDuracion" name="txtDuracion">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Precio total </strong>(S/.)</label>
											<input type="text" class="form-control input-sm" id="txtPrecioT" name="txtPrecioT">
					      				</div>
					      				<div class="col-md-8 form-group">
											<label><strong> Descripción </strong></label>
											<textarea class="form-control"></textarea>
					      				</div>
					      				<div class="col-md-4 form-group">
											<label><strong> Estado </strong></label>
											<select class="form-control input-sm" id="cboEstado" name="cboEstado">
												<option value="0">-- Seleccionar --</option>
												<option value="A"> Activo </option>
												<option value="I"> Inactivo </option>
											</select>
					      				</div>
							      	</div>
							      	<div class="form-actions center" style="margin-bottom:-0px;">
										<button type="button" class="btn btn-sm btn-success">
											Submit
											<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
										</button>
									</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<div class="col-md-12">
								<div class="Contenedor widget-box">
									<div class="table-header">
										Lista de actividades
						      		</div>
							      	<div class="widget-main">
							      		<table id="tabla_eventos" class="table table-striped table-bordered">
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
									                <th>Ope</th>
									            </tr>
											</thead>
											<tbody id="cuerpo_tabla_eventos">
												<!-- Lista de eventos -->
											</tbody>
										</table>
							      	</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<!-- Contenedor Lista de actividades -->
							<div class="col-md-12">
								<div class="Contenedor widget-box">
									<div class="table-header">
										Lista de asistentes
						      		</div>
							      	<div class="widget-main">
							      		<table id="tabla_eventos" class="table table-striped table-bordered">
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
									                <th>Ope</th>
									            </tr>
											</thead>
											<tbody id="cuerpo_tabla_eventos">
												<!-- Lista de eventos -->
											</tbody>
										</table>
							      	</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<!-- Contenedor Lista de asistentes -->
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
function listarEventos(){ 
  	var param_opcion = 'mostrar_ponente'; 
  	var codigo = 0;
  	$.ajax({
      	type: 'POST',        
      	data:'param_opcion='+param_opcion,
      	url: '../../controller/controlMantenedores/ponente_controller.php',
      	success: function(data){
          	$('#tabla_eventos').DataTable().destroy();
          	$('#cuerpo_tabla_eventos').html(data);
          	$('#tabla_eventos').DataTable();
      	},
      	error: function(data){
                 
      	}
  	});    
}
</script>
<script type="text/javascript">
	listarEventos();
</script>
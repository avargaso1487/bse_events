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
		$link_tarea = "lista_eventos.php";
		$titulo = "Eventos registrados";

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
								<div id="mensaje2"></div>							
								<div class="table-header">
									LISTA DE EVENTOS &nbsp;&nbsp;
									<a  href="registrar_evento.php" id="nuevo_evento" class="white">
			                            <i class='ace-icon fa fa-plus-circle bigger-150'></i>
			                        </a>
								</div>
								<div>
									<table id="tabla_eventos" class="table table-striped table-bordered">
										<thead>
								            <tr>
								                <th>Código</th>
								                <th>Nombre de evento</th>
								                <th>Fecha Inicio - Fin</th>
								                <th>Costo total</th>
								                <th>Número de asistentes</th>
								                <th>Estado</th>
								                <th>Operaciones</th>
								            </tr>
										</thead>
										<tbody id="cuerpo_tabla_eventos">
											<!-- Lista de eventos -->
										</tbody>
									</table>
								</div>
							</div>				
							<input type="hidden" dissabled="true" value="<?= $grupo  ?>" id="NombreGrupo">
                            <input type="hidden" dissabled="true" value="<?= $tarea  ?>" id="NombreTarea">
							<!-- FIN DE CONTENIDO DE PAGINA -->										               
						</div><!-- /.col -->
					</div>

		            
				</div><!-- /.page-content -->							
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
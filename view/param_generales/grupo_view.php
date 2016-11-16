<?php 
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header("Location:../../index.php");
	}
	else
	{
		date_default_timezone_set('America/Lima');
 ?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<meta charset="utf-8" />
		<title>Parámetros Generales - Grupos</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../default/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<!-- text fonts -->
		<link rel="stylesheet" href="../default/assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="../default/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />


		<!-- ace settings handler -->
		<script src="../default/assets/js/ace-extra.min.js"></script>
		<style type="text/css">
		    .datepicker{z-index:1151 !important;}
		</style>
		
	</head>

	<body class="no-skin">
		<?php 
		require('../sup_layout.php');
		 ?>

		<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar responsive">
				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'fixed')}catch(e){}
				</script>

				<div class="sidebar-shortcuts" id="sidebar-shortcuts">
					<div class="sidebar-shortcuts-large" id="sidebar-shortcuts-large">
						<button class="btn btn-success">
							<i class="ace-icon fa fa-signal"></i>
						</button>

						<button class="btn btn-info">
							<i class="ace-icon fa fa-pencil"></i>
						</button>

						<button class="btn btn-warning">
							<i class="ace-icon fa fa-users"></i>
						</button>

						<button class="btn btn-danger">
							<i class="ace-icon fa fa-cogs"></i>
						</button>
					</div>

					<div class="sidebar-shortcuts-mini" id="sidebar-shortcuts-mini">
						<span class="btn btn-success"></span>

						<span class="btn btn-info"></span>

						<span class="btn btn-warning"></span>

						<span class="btn btn-danger"></span>
					</div>
				</div><!-- /.sidebar-shortcuts -->

				<ul class="nav nav-list" id="permisos">
				
				</ul><!-- /.nav-list -->

				<div class="sidebar-toggle sidebar-collapse" id="sidebar-collapse">
					<i class="ace-icon fa fa-angle-double-left" data-icon1="ace-icon fa fa-angle-double-left" data-icon2="ace-icon fa fa-angle-double-right"></i>
				</div>

				<script type="text/javascript">
					try{ace.settings.check('sidebar' , 'collapsed')}catch(e){}
				</script>
			</div>

			<div class="main-content">
				<div class="main-content-inner">
					<div class="breadcrumbs" id="breadcrumbs">
						<script type="text/javascript">
							try{ace.settings.check('breadcrumbs' , 'fixed')}catch(e){}
						</script>

						<ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-home home-icon"></i>
                                <a href="#">Parámetros Generales</a>
                            </li>
                            <li>Grupos de Tareas</li>
                            
                            
                        </ul><!-- /.breadcrumb -->				
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								GRUPOS REGISTRADOS
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">								
								<div class="table-header">
									Lista de Grupos &nbsp;&nbsp;
									<a  href="#modalGrupos" id="new_grupo" data-toggle='modal' onclick="nuevo();" class='white'>
			                            <i class='ace-icon fa fa-plus-circle bigger-150'></i>
			                        </a>
								</div>
								<div>
									<table id="tablaGrupos" class="table table-striped table-bordered">
										<thead>											
								            <tr>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">N°</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 20%;">GRUPO</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 40%;">DESCRIPCION</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">ORDEN</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">ESTADO</th>	
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">OPERACIONES</th>	
								            </tr>							         
										</thead>
										<tbody id="cuerpoGrupos">																	
										</tbody>
									</table>
								</div>
							</div>				
							<input type="hidden" dissabled="true" value="Parámetros" id="NombreGrupo">
                            <input type="hidden" dissabled="true" value="Grupos" id="NombreTarea">			
							<!-- FIN DE CONTENIDO DE PAGINA -->										               
						</div><!-- /.col -->
					</div>		            
				</div><!-- /.page-content -->														

				<div class="modal fade" id="modalGrupos" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								
								<h3 class="blue bigger">DATOS DEL GRUPO</h3>
							</div>
							<form  method="POST" id="form_grupo">
								<div class="modal-body">
									<div class="row">
										<div class="modal-body col-md-12">

											<div style="display:none;" class="form-group col-md-4">												
												<div class="input-group">													
													<input type="text" class='col-md-12' name="param_grupoId" id="param_grupoId">
												</div>
											</div>

											<div class="form-group col-md-12">
												<label for="param_grupo">Grupo</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text"  name="param_grupo" id="param_grupo"/>
												</div>
											</div>											

											<div class="form-group col-md-12">
												<label for="param_grupoDescripcion">Descripción</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text"  name="param_grupoDescripcion" id="param_grupoDescripcion"/>
												</div>
											</div>

											<div class="form-group col-md-3">
												<label for="param_grupoOrden">Orden</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text" name="param_grupoOrden" id="param_grupoOrden" onkeypress="return solonumeros(event)"/>
												</div>
											</div>											
										</div>																											
									</div>
									
			                        <div class="alert alert-danger text-center" style="display:none;" id="error">
			                        </div>
			                        <div class="alert alert-success text-center" style="display:none;" id="exito">
			                        </div>  
						            
								</div>								

		                        <div class="modal-footer">
									<input type="button" style="display:none;" id="cancelar" data-dismiss="modal" class="btn btn-sm" value="Cancelar">
									<input style="display:none;" type="button" id="guardarGrupo" class="btn btn-sm btn-primary" onclick="guardar();" value="Guardar"/>
									<input style="display:none;" type="button" id="editarGrupo" class="btn btn-sm btn-primary" onclick="editar();" value="Modificar"/>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>			
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
		</div>

		<script src="../default/assets/js/jquery.2.1.1.min.js"></script>
		<script src="../default/assets/js/ace-extra.min.js"></script>		
		
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../default/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='Recursos/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../default/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>		
		<script src="../default/assets/js/jquery.2.1.1.min.js"></script>
	    <script src="../default/assets/js/bootstrap.min.js"></script>
	    <script src="../default/assets/js/jquery.dataTables.min.js"></script>
	    <script src="../default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
	    <script src="../default/assets/js/jquery.maskedinput.min.js"></script>
	    <script src="../default/assets/js/jquery.autosize.min.js"></script>
	    <script src="../default/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>

		
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<script src="../default/assets/js/ace-elements.min.js"></script>
		<script src="../default/assets/js/ace.min.js"></script>
		

		<script src="../default/js/grupos.js"></script>	
		<script src="../default/js/validaciones.js"></script>
		<!-- inline scripts related to this page -->
	</body>
</html>
<?php 
	}
?>
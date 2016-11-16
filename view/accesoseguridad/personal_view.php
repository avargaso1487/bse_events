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
		<title>Acceso y Seguridad - Personal</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../default/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />

		<link rel="stylesheet" href="../default/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="../default/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="../default/assets/css/datepicker.min.css" />

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
                                <a href="#">Acceso y Seguridad</a>
                            </li>
                            <li>Personal</li>
                        </ul><!-- /.breadcrumb -->
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								PERSONAL REGISTRADO
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">								
								<div class="table-header">
									Lista de Colaboradores &nbsp;&nbsp;
									<a  href="#modalColaboradores" id="new_colaborador" data-toggle='modal' onclick="nuevo();" class='white'>
			                            <i class='ace-icon fa fa-plus-circle bigger-150'></i>
			                        </a>
								</div>
								<div>
									<table id="tablaColaboradores" class="table table-striped table-bordered">
										<thead>											
								            <tr>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">CÓDIGO</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 20%;">COLABORADOR</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 7%;">DNI</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 20%;">DIRECCIÓN</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">TELÉFONO</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">EMAIL</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 9%;">ESTADO</th>	
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">OPERACIONES</th>	
								            </tr>							         
										</thead>
										<tbody id="cuerpoColaboradores">																	
										</tbody>
									</table>
								</div>
							</div>				
							<input type="hidden" dissabled="true" value="Acceso y Seguridad" id="NombreGrupo">
                            <input type="hidden" dissabled="true" value="Personal" id="NombreTarea">			
							<!-- FIN DE CONTENIDO DE PAGINA -->										               
						</div><!-- /.col -->
					</div>		            
				</div><!-- /.page-content -->														

				<div class="modal fade" id="modalColaboradores" tabindex="-1">
					<div class="modal-dialog" style="width: 60% !important;">
						<div class="modal-content">
							<div class="modal-header">
								
								<h3 class="blue bigger">DATOS DEL COLABORADOR</h3>
							</div>
							<form  method="POST" id="form_colaborador">
								<div class="modal-body">
									<div class="row">
										<div class="modal-body col-md-12">										

											<div class="form-group col-md-12">
												<label for="param_colaboradorCodigo">Código</label>
												<div class="input-group col-md-4">													
													<input class="col-md-12" type="text" name="param_colaboradorCodigo" id="param_colaboradorCodigo"/>		
												</div>
											</div>
											

											<div class="form-group col-md-6">
												<label for="param_colaboradorEmpresa">Empresa</label>
												<div id="empresa">
													<div class="input-group col-md-12">												
														<select class="form-control" id="param_colaboradorEmpresa" name="param_colaboradorEmpresa">
															<option value="" disabled selected style="display: none;">Seleccionar Empresa</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group col-md-6">
												<label for="param_colaboradorSucursal">Sucursal</label>
												<div id="sucursal">
													<div class="input-group col-md-12">									
														<select class="form-control" id="param_colaboradorSucursal" name="param_colaboradorSucursal">
															<option value="" disabled selected style="display: none;">Seleccionar Sucursal</option>
														</select>
													</div>
												</div>
											</div>

											<div class="form-group col-md-6">
												<label for="param_colaboradorNombre">Nombres</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text"  name="param_colaboradorNombre" id="param_colaboradorNombre"/>
												</div>
											</div>											

											<div class="form-group col-md-6">
												<label for="param_colaboradorApellidos">Apellidos</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text"  name="param_colaboradorApellidos" id="param_colaboradorApellidos"/>
												</div>
											</div>

											<div class="form-group col-md-3">
												<label for="param_colaboradorDNI">DNI</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text" name="param_colaboradorDNI" id="param_colaboradorDNI" maxlength="8" onkeypress="return solonumeros(event)"/>													
												</div>
											</div>

											<div class="form-group col-md-9">
												<label for="param_colaboradorDireccion">Direccion</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text"  name="param_colaboradorDireccion" id="param_colaboradorDireccion"/>
													<span class="input-group-addon">
														<i class="fa fa-home bigger-110"></i>
													</span>
												</div>
											</div>

											<div class="form-group col-md-4">
												<label for="param_colaboradorNacimiento">Fecha Nacimiento</label>												
												<div class="input-group col-md-12">
													<input class="form-control date-picker" id="param_colaboradorNacimiento" name="param_colaboradorNacimiento" type="text" data-date-format="yyyy-mm-dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
												</div>												
											</div>

											<div class="form-group col-md-4">
												<label for="param_colaboradorFijo">Teléfono Fijo</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text" name="param_colaboradorFijo" id="param_colaboradorFijo" onkeypress="return solonumeros(event)"/>
													<span class="input-group-addon">
														<i class="fa fa-phone bigger-110"></i>
													</span>
												</div>
											</div>


											<div class="form-group col-md-4">
												<label for="param_colaboradorMovil">Teléfono Celular</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text" name="param_colaboradorMovil" id="param_colaboradorMovil" onkeypress="return solonumeros(event)"/>
													<span class="input-group-addon">
														<i class="fa fa-mobile-phone bigger-110"></i>
													</span>
												</div>
											</div>

											<div class="form-group col-md-9">
												<label for="param_colaboradorMail">Correo Electrónico</label>
												<div class="input-group col-md-12">													
													<input class="col-md-12" type="text" name="param_colaboradorMail" id="param_colaboradorMail"/>	
												</div>
											</div>

											<div class="form-group col-md-4">
												<label for="param_colaboradorIngreso">Fecha Ingreso</label>												
												<div class="input-group col-md-12">
													<input class="form-control date-picker" id="param_colaboradorIngreso" name="param_colaboradorIngreso" type="text" data-date-format="yyyy-mm-dd" />
													<span class="input-group-addon">
														<i class="fa fa-calendar bigger-110"></i>
													</span>
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
									<input style="display:none;" type="button" id="guardarPersonal" class="btn btn-sm btn-primary" onclick="guardar();" value="Guardar"/>
									<input style="display:none;" type="button" id="editarPersonal" class="btn btn-sm btn-primary" onclick="editar();" value="Modificar"/>
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
	    <script src="../default/assets/js/bootstrap-datepicker.min.js"></script>
	    <script src="../default/assets/js/jquery.dataTables.min.js"></script>
	    <script src="../default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
	    <script src="../default/assets/js/jquery.maskedinput.min.js"></script>
	    <script src="../default/assets/js/jquery.autosize.min.js"></script>
	    <script src="../default/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>

		
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<script src="../default/assets/js/ace-elements.min.js"></script>
		<script src="../default/assets/js/ace.min.js"></script>
		

		<script src="../default/js/personal.js"></script>	
		<script src="../default/js/validaciones.js"></script>

		<script type="text/javascript">
				$.mask.definitions['~']='[+-]';	
				$('.input-mask-date').mask('9999/99/99');
				$('.input-mask-phone').mask('(999) - 999999');

				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});

		</script>

		<!-- inline scripts related to this page -->
	</body>
</html>
<?php 
	}
?>
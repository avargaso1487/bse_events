<?php 
	session_start();
	if(!isset($_SESSION['usuario']))
	{
		header("Location:../index.php");
	}
	else
	{
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta charset=utf-8 />
	<title>SISTEMA VENTAS</title>
	<link rel="stylesheet" href="default/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="default/assets/css/ui.jqgrid.min.css" />
	<link rel="stylesheet" href="default/assets/fonts/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="default/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		
	</head>
	<body class="no-skin" >
		<div id="navbar" class="navbar navbar-default">

			<div class="navbar-container" id="navbar-container">
				<button type="button" class="navbar-toggle menu-toggler pull-left" id="menu-toggler" data-target="#sidebar">
					<span class="sr-only">Toggle sidebar</span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>

					<span class="icon-bar"></span>
				</button>

				<div class="navbar-header pull-left">
					<a href="index.html" class="navbar-brand">
						<small>
							<i class="fa fa-leaf"></i>
							Nombre Empresa
						</small>
					</a>
				</div>

				<div class="navbar-buttons navbar-header pull-right" role="navigation">
					<ul class="nav ace-nav">

						<li class="purple">
							<a data-toggle="dropdown" class="dropdown-toggle" href="#">
								<i class="ace-icon fa fa-bell icon-animated-bell"></i>
								<span class="badge badge-important">100</span>
							</a>

							<ul class="dropdown-menu-right dropdown-navbar navbar-blue dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-blue">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-blue fa fa-comment"></i>
														New Comments
													</span>
													<span class="pull-right badge badge-info">+12</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<i class="btn btn-xs btn-primary fa fa-user"></i>
												Bob just signed up as an editor ...
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-success fa fa-shopping-cart"></i>
														New Orders
													</span>
													<span class="pull-right badge badge-success">+8</span>
												</div>
											</a>
										</li>

										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-info fa fa-twitter"></i>
														Followers
													</span>
													<span class="pull-right badge badge-info">+11</span>
												</div>
											</a>
										</li>
									</ul>
								</li>

								<li class="dropdown-footer">
									<a href="#">
										See all notifications
										<i class="ace-icon fa fa-arrow-right"></i>
									</a>
								</li>
							</ul>
						</li>					

						<li class="light-blue">
							<a data-toggle="dropdown" href="#" class="dropdown-toggle">								
								<span class="user-info">
									<small>Bienvenido,</small><?php echo $_SESSION['usuario']?>
								</span>

								<i class="ace-icon fa fa-caret-down"></i>
							</a>

							<ul class="user-menu dropdown-menu-right dropdown-menu dropdown-yellow dropdown-caret dropdown-close">
								<li>
									<a href="#">
										<i class="ace-icon fa fa-cog"></i>
										Settings
									</a>
								</li>

								<li>
									<a href="profile.html">
										<i class="ace-icon fa fa-user"></i>
										Profile
									</a>
								</li>

								<li class="divider"></li>

								<li>
									<a href="../controller/controlusuario/cerrarsesion.php">
										<i class="ace-icon fa fa-power-off"></i>
										Logout
									</a>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div><!-- /.navbar-container -->
		</div>

	<div class="main-container" id="main-container">
			<script type="text/javascript">
				try{ace.settings.check('main-container' , 'fixed')}catch(e){}
			</script>

			<div id="sidebar" class="sidebar                  responsive">
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

				<ul class="nav nav-list">
					<li class="active open">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text">
								Ventas
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<li class="">
								<a href="empresa.php">
									<i class="menu-icon fa fa-home"></i>
									Empresa									
								</a>														
							</li>

							<li>
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-male"></i>
									Personal
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li>
										<a href="personal_new.php">
											<i class="menu-icon fa fa-plus"></i>
											Nuevo Colaborador
										</a>										
									</li>
									<li>
										<a href="personal_list.php">
											<i class="menu-icon fa fa-eye"></i>
											Listar Colaboradores
										</a>										
									</li>
								</ul>
							</li>

							<li class="active open">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-male"></i>
									Clientes
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="cliente_new.php">
											<i class="menu-icon fa fa-plus"></i>
											Nuevo Cliente
										</a>										
									</li>
									<li class="active">
										<a href="cliente_list.php">
											<i class="menu-icon fa fa-eye blue"></i>
											Listar Clientes
										</a>										
									</li>
								</ul>
							</li>
							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-qrcode"></i>
									Productos
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">									
									<li class="">
										<a href="linea_list.php">
											<i class="menu-icon fa fa-barcode "></i>
											Líneas
										</a>
										<b class="arrow"></b>
									</li>
									

									<li class="">
										<a href="marca_list.php">
											<i class="menu-icon fa fa-barcode "></i>
											Marcas
										</a>
										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="presentacion_list.php">
											<i class="menu-icon fa fa-barcode"></i>
											Presentaciones
										</a>
										<b class="arrow"></b>
									</li>


									<li class="">
										<a href="medidas_list.php">
											<i class="menu-icon fa fa-barcode"></i>
											Medidas
										</a>
										<b class="arrow"></b>
									</li>	

									<li class="">
										<a href="gama_list.php">
											<i class="menu-icon fa fa-barcode"></i>
											Gamas
										</a>
										<b class="arrow"></b>
									</li>

									<li class="">
										<a href="producto_new.php">
											<i class="menu-icon fa fa-plus"></i>
											Nuevo Producto
										</a>
										<b class="arrow"></b>
									</li>
										<li class="">
										<a href="producto_list.php">
											<i class="menu-icon fa fa-eye"></i>
											Listar Productos
										</a>
										<b class="arrow"></b>
									</li>
								</ul>
							</li>	
							<li>
								<a href="servicio.php">
									<i class="menu-icon fa fa-home"></i>
									Servicios									
								</a>														
							</li>
							<li>
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-list-alt"></i>
									Documento de Venta
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li>
										<a href="documento_new.php">
											<i class="menu-icon fa fa-plus"></i>
											Nueva Venta
										</a>										
									</li>
									<li>
										<a href="documento_list.php">
											<i class="menu-icon fa fa-eye"></i>
											Listar Venta
										</a>										
									</li>
								</ul>
							</li>																																																							
						</ul>
					</li>


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
								<a href="bienvenido.php">Home</a>
							</li>
							<li>Clientes</li>
							<li class="active">Lista de Clientes</li>
						</ul><!-- /.breadcrumb -->

					</div>
					<div class="page-content">						

						<div class="row">
							<div class="col-xs-12">							
								<!-- PAGE CONTENT BEGINS -->
								<div class="col-xs-12 ">								
								<div class="widget-box transparent">
									<div class="widget-header widget-header-large">
										<div class="widget-toolbar no-border invoice-info">
											<span class="invoice-info-label">Fecha:</span>
											<span class="blue"><?php echo date('d-m-Y'); ?></span>
										</div>
									</div>									
									<div class="space-10"></div>
									<div class="widget-body" id="info_personal">
										<div class="panel panel-primary" style="border:0">
				                            <div class="panel-heading">	
				                            	<h2>
				                            		CLIENTES REGISTRADOS
				                            	</h2>
				                            </div>
				                            
				                            <div>
				                                
			                                        <table class="table table-striped table-bordered" cellspacing="0" width="100%" id="dataTables-example">
			                                            <thead>
			                                                <tr>            
			                                                  <th style='text-align:center;' >CÓDIGO</th>                                                  
			                                                  <th style='text-align:center;' >NOMBRES</th>                                                  
			                                                  <th style='text-align:center;' >CORREO</th>
			                                                  <th style='text-align:center;' >TELEFONO</th>
			                                                  <th style='text-align:center;' >FECHA ANIVERSARIO</th>
			                                                  <th style='text-align:center;' >MOTIVO</th>
			                                                  <th style='text-align:center;' >TIPO</th>               
			                                                  <th style='text-align:center;' >OPERACIONES</th>
			                                                </tr>
			                                            </thead>           
			                                            <tbody id="cuerpoTabla">
			                                              <!-- DATOS -->                                            
			                                            </tbody>                                                  
			                                        </table>
			                                    </div> 
				                            </div>
				                        </div>
				                    </div>
								</div>
										
									

									</div>
								</div>								
								<!-- PAGE CONTENT ENDS -->
							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>

				<!-- Modal -->
				
				<div id="modal-detalle" class="modal" tabindex="-1">
					<div class="modal-dialog">
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="blue bigger">DATOS DEL CLIENTE</h3>
							</div>
							<form  method="POST" id="form_edit_cliente">													
								<div class="modal-body">
									<div class="row">
										<div class="modal-body">
											<div style="display:none;" class="form-group col-md-12">
												<label for="param_clienteCodigo">Código</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-barcode"></i>
													</span>
													<input type="text" class='col-md-4' name="param_clienteCodigo" id="param_clienteCodigo">
												</div>
											</div>												
											
											<div class="form-group col-md-5">
												<label for="param_clienteDNI">DNI</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text" name="param_clienteDNI"  id="param_clienteDNI"/>
												</div>
											</div>
											<div class="form-group col-md-7">
												<label for="param_clienteNombres">Nombres</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteNombres" id="param_clienteNombres"/>
												</div>
											</div>

											<div class="form-group col-md-5">
												<label for="param_clienteApellidoPaterno">Apellido Paterno</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteApellidoPaterno" id="param_clienteApellidoPaterno"/>
												</div>
											</div>

											<div class="form-group col-md-5">
												<label for="param_clienteApellidoMaterno">Apellido Materno</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteApellidoMaterno" id="param_clienteApellidoMaterno"/>
												</div>
											</div>

											<div class="form-group col-md-12">
												<label for="param_clienteDireccion">Direccion</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteDireccion" id="param_clienteDireccion"/>
												</div>
											</div>

											<div class="form-group col-md-4">
												<label for="param_clienteTelefonoFijo">Teléfono Fijo</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-mobile"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteTelefonoFijo" id="param_clienteTelefonoFijo"/>
												</div>
											</div>
											
											<div class="form-group col-md-4">
												<label for="param_clienteTelefonoCelular">Teléfono Celular</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-mobile"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteTelefonoCelular" id="param_clienteTelefonoCelular"/>
												</div>
											</div>

											<div class="form-group col-md-12">
												<label for="param_clienteCorreo">Correo</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-envelope"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteCorreo" id="param_clienteCorreo"/>
												</div>
											</div>

											<div class="form-group col-md-12">
												<label for="param_clienteNacimiento">Fecha Nacimiento</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
													<input class="col-md-3" type="text"  name="param_clienteNacimiento" id="param_clienteNacimiento"/>
												</div>
											</div>

											<div class="form-group col-md-4">
												<label for="param_clienteFechaAniversario">Fecha Aniversario</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-calendar"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteFechaAniversario" id="param_clienteFechaAniversario"/>
												</div>
											</div>
											<div class="form-group col-md-8">
												<label for="param_clienteMotivo">Motivo Aniversario</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-user"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteMotivo" id="param_clienteMotivo"/>
												</div>
											</div>

											<div class="form-group col-md-4">
												<label for="param_clienteTipo">Estado</label>
												<div class="input-group">
													<span class="input-group-addon">
														<i class="ace-icon fa fa-building"></i>
													</span>
													<input class="col-md-12" type="text"  name="param_clienteTipo" id="param_clienteTipo"/>
												</div>
											</div>

										</div>																											
									</div>
									<div class="form-group">
				                        <div class="alert alert-danger text-center" style="display:none;" id="error">
				                            
				                        </div>
				                        <div class="alert alert-success text-center" style="display:none;" id="exito">
							                            
				                        </div>  
						            </div>
								</div>												
								
								<div class="modal-footer">
									<input type="button" style="display:none;" id="cancelar" data-dismiss="modal" class="btn btn-sm" value="Cancelar">
									<input type="hidden" value="editar" name="param_opcion">
									<input style="display:none;" type="button" id="editarCliente" class="btn btn-sm btn-primary" value="Modificar"/>
															
								</div>
							</form>
						</div>
					</div>
				</div>


		
			</div><!-- /.main-content -->

			<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">ZENTRUM CITY</span>
							Application &copy; 2016
						</span>

						&nbsp; &nbsp;
						<span class="action-buttons">
							<a href="#">
								<i class="ace-icon fa fa-twitter-square light-blue bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
							</a>

							<a href="#">
								<i class="ace-icon fa fa-rss-square orange bigger-150"></i>
							</a>
						</span>
					</div>
				</div>
			</div>

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		<script src="default/assets/js/jquery.2.1.1.min.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->


		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		
		<script src="default/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->
		<script src="default/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="default/assets/js/jquery.jqGrid.min.js"></script>
		<script src="default/assets/js/grid.locale-en.js"></script>

		<!-- ace scripts -->
		<script src="default/assets/js/ace-elements.min.js"></script>
		<script src="default/assets/js/ace.min.js"></script>

		<!-- inline scripts related to this page -->
		<script src="default/js/cliente_list.js"></script>
		<script src="default/assets/js/jquery.maskedinput.min.js"></script>
		
		<script src="default/assets/js/jquery.dataTables.min.js"></script>
		<script src="default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		
		<script type="text/javascript">
				$.mask.definitions['~']='[+-]';	
				$('.input-mask-date').mask('99/99/9999');			
				$('.input-mask-phone').mask('(999) - 999999');				
		</script>

	</body>
</html>


	<?php } ?>
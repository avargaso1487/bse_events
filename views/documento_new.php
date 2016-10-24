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
		<meta charset="utf-8" />
		<title>SISTEMA DE VENTAS</title>

		<meta name="description" content="Common form elements and layouts" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="default/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<script src="default/assets/js/jquery.2.1.1.min.js"></script>
		<!-- page specific plugin styles -->
		<link rel="stylesheet" href="default/assets/css/jquery-ui.custom.min.css" />
		<link rel="stylesheet" href="default/assets/css/chosen.min.css" />
		<link rel="stylesheet" href="default/assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="default/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="default/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="default/assets/css/bootstrap-datetimepicker.min.css" />
		<link rel="stylesheet" href="default/assets/css/colorpicker.min.css" />
		          
		<!-- text fonts -->
		<link rel="stylesheet" href="default/assets/fonts/fonts.googleapis.com.css" />

		<!-- ace styles -->
		<link rel="stylesheet" href="default/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

		<!--[if lte IE 9]>
			<link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
		<![endif]-->

		<!--[if lte IE 9]>
		  <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
		<![endif]-->

		<!-- inline styles related to this page -->

		<!-- ace settings handler -->
		<script src="default/assets/js/ace-extra.min.js"></script>

		<!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->

		<!--[if lte IE 8]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
		<![endif]-->
		
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
							<i class="fa fa-scissors"></i>
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

							<ul class="dropdown-menu-right dropdown-navbar navbar-bluew dropdown-menu dropdown-caret dropdown-close">
								<li class="dropdown-header">
									<i class="ace-icon fa fa-exclamation-triangle"></i>
									8 Notifications
								</li>

								<li class="dropdown-content">
									<ul class="dropdown-menu dropdown-navbar navbar-bluew">
										<li>
											<a href="#">
												<div class="clearfix">
													<span class="pull-left">
														<i class="btn btn-xs no-hover btn-bluew fa fa-comment"></i>
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

							<li class="">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-male"></i>
									Personal
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="">
										<a href="personal_new.php">
											<i class="menu-icon fa fa-plus "></i>
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

							<li class="">
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
									<li class="">
										<a href="cliente_list.php">
											<i class="menu-icon fa fa-eye bluew"></i>
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
											<i class="menu-icon fa fa-eye bluew"></i>
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
							<li class="active open">
								<a href="#" class="dropdown-toggle">
									<i class="menu-icon fa fa-list-alt"></i>
									Documento de Venta
									<b class="arrow fa fa-angle-down"></b>
								</a>

								<b class="arrow"></b>

								<ul class="submenu">
									<li class="active">
										<a href="documento_new.php">
											<i class="menu-icon fa fa-plus blue"></i>
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
							<li>Venta</li>
							<li>Documento de Venta</li>
							<li>Nueva Venta</li>
						</ul><!-- /.breadcrumb -->

					</div>
					<div class="page-content">						

						<div class="row">
							<div class="col-xs-12">							
								<!-- PAGE CONTENT BEGINS -->
								<div class="col-xs-10 col-xs-offset-1">								
								<div class="widget-box transparent">
									<div class="widget-header ">
										<div class="widget-toolbar no-border invoice-info">
											<span class="invoice-info-label">Fecha:</span>
											<span class="blue"><?php echo date('d-m-Y'); ?></span>
										</div>
									</div>									
									<div class="space-10"></div>
									<div class="widget-body" id="info_personal">
										<div class="panel panel-primary" style="border:0">
											<div class="panel-heading">	
				                            	<h2>REGISTRAR NUEVA VENTA</h2>
				                            </div>
											<!--<form action="../controller/controlproducto/producto.php" method="POST">--></div>
															<div class="modal-body col-md-offset-1 col-md-10">
																<div class="row">													
																	<div class="col-xs-12">
																		<div class="form-group col-md-5">
																			<label for="param_docTipo">Tipo de Documento</label>
																			<div class="input-group">
														                        <select class="col-md-12" name="param_docTipo" id="param_docTipo">
														                            <option value=""  disabled selected style="display: none;">Seleccionar opción</option>
														                            <option value="1">Boleta de Venta</option>
														                            <option value="2">Factura</option>
														                            <option value="3">Recibo</option>
														                        </select>
														                    </div>																			
																		</div>

																		<div class="form-group col-md-5 col-md-offset-1">
																			<label for="param_docTipo">Sucursal</label>
																			<div class="input-group">
														                        <select class="" disabled="true" name="param_personSucursal" id="param_personSucursal">
														                            <option value="<?php echo $_SESSION['usuarioSucursalID'];?>"><?php echo $_SESSION['usuarioSucursal']; ?></option>
														                        </select>
														                    </div>																			
																		</div>

																		<div class="form-group col-md-2">
																			<label for="param_docSerie">Serie</label>
																			<div class="input-group">
																				<input class="form-control " type="text" name="param_docSerie" id="param_docSerie" placeholder="" />
																			</div>
																		</div>																		
																		<div class="form-group col-md-3">
																			<label for="param_docNumero">Número</label>
																			<div class="input-group">
																				<input class="form-control " type="text" name="param_docNumero" id="param_docNumero" placeholder="" />						
																			</div>
																		</div>
																		<div class="form-group col-md-offset-1 col-md-5">
																			<label for="param_docFecha">Fecha y Hora de Venta</label>
																			<div class="input-group">
																				<input id="fechaHoraDocumento" name="param_docFecha" type="text" class="form-control" />
																				<span class="input-group-addon">
																					<i class="fa fa-clock-o bigger-110"></i>
																				</span>
																			</div>
																		</div>
																									
																		<div class="form-group col-md-5">
																			<label for="param_docDNI">DNI del Cliente</label>
																			<div class="input-group col-md-12">
																				<input class="form-control col-md-12 input-mask-dni" type="text" name="param_docDNI" id="param_docDNI" placeholder="Busque al cliente" disabled/>
																				<span class="input-group-btn">
																					<a href="#modal-buscarCliente" role="button" data-toggle="modal" id="buscarCliente" class="btn btn-sm btn-default">
																						<i class="ace-icon fa fa-search bigger-110"></i>		
																					</a>																				
																				</span>
																				<span class="input-group-btn">
																					<a href="#modal-agregarCliente" role="button" data-toggle="modal" id="agregarCliente" class="btn btn-sm btn-default">
																						<i class="ace-icon fa fa-plus bigger-110"></i>		
																					</a>																				
																				</span>
																			</div>
																		</div>	
																		<div class="form-group col-md-offset-1 col-md-5">
																			<label for="param_docCliente">Cliente</label>
																			<div class="input-group">
																				<span class="input-group-addon">
																					<i class="ace-icon fa fa-user"></i>
																				</span>
																				<input class="col-md-12" type="text" id="param_docCliente" disabled placeholder="Nombre del cliente"/>
																			</div>
																		</div>

																		<div class="form-group col-md-5">
																			<label for="param_docCodigoTrabajador">Código del Trabajador</label>
																			<div class="input-group col-md-12">
																				<input class="form-control col-md-12 input-mask-dni" type="text" name="param_docCodigoTrabajador" id="param_docCodigoTrabajador" placeholder="Busque al trabajador" disabled/>
																				<span class="input-group-btn">
																					<a href="#modal-buscarTrabajador" role="button" data-toggle="modal" id="buscarTrabajadorVenta" class="btn btn-sm btn-default">
																						<i class="ace-icon fa fa-search bigger-110"></i>	
																					</a>
																				</span>
																			</div>
																		</div>

																		<div class="form-group col-md-5 col-md-offset-1">
																			<label for="param_docTrabajador">Trabajador</label>
																			<div class="input-group">
																				<span class="input-group-addon">
																					<i class="ace-icon fa fa-user"></i>
																				</span>
																				<input class="col-md-12" type="text" id="param_docTrabajador" disabled placeholder="Nombre del trabajador"/>
																			</div>
																		</div>
																		
																	</div>
																</div>																
															</div>
															<div class="row">																
																	<div class="col-sm-12">
																		<div id="accordion" class="accordion-style1 panel-group">
																			<div class="panel panel-default">
																				<div class="panel-heading">
																					<h4 class="panel-title">
																						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseOne">
																							<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
																							&nbsp;PRODUCTOS VENDIDOS
																						</a>
																					</h4>
																				</div>

																				<div class="panel-collapse collapse" id="collapseOne">
																					<div class="panel-body">
																						<div class="form-group col-md-5">
																							<label for="param_docdetcodprod">Código del Producto</label>
																							<div class="input-group col-md-12">
																								<input class="form-control col-md-12" type="text" id="param_docdetcodprod" name="param_docdetcodprod" placeholder="Busque el producto" disabled/>
																								<span class="input-group-btn">
																									<a href="#modal-buscarProducto" role="button" data-toggle="modal" id="buscarProducto" class="btn btn-sm btn-default">
																										<i class="ace-icon fa fa-search bigger-110"></i>	
																									</a>			
																								</span>
																							</div>
																						</div>	
																						<div class="form-group col-md-6 col-md-offset-1">
																							<label for="param_docdetprod">Producto</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" id="param_docdetprod" disabled placeholder="Nombre del producto"/>
																							</div>
																						</div>
																						<div class="form-group col-md-5">
																							<label for="param_docdetcodpromotor">Código del Trabajador Promotor</label>
																							<div class="input-group col-md-12">
																								<input class="form-control col-md-12" type="text" id="param_docdetcodpromotor" name="param_docdetcodpromotor" placeholder="Busque el promotor de la venta" disabled/>
																								<span class="input-group-btn">
																									<a href="#modal-buscarPromotorVenta" role="button" data-toggle="modal" id="buscarPromotorVenta" class="btn btn-sm btn-default">
																										<i class="ace-icon fa fa-search bigger-110"></i>	
																									</a>			
																								</span>
																							</div>
																						</div>	
																						<div class="form-group col-md-6 col-md-offset-1">
																							<label for="param_docdetpromotor">Trabajador Promotor</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" id="param_docdetpromotor" disabled placeholder="Nombre del promotor de la venta"/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetPrecioUnitarioProd">P. Unitario</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" disabled name="param_docdetPrecioUnitarioProd" id="param_docdetPrecioUnitarioProd" placeholder="S/."/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetCantidadProd">Cantidad</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" name="param_docdetCantidadProd" id="param_docdetCantidadProd" placeholder=""/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetDsctoPorcenajeProd">Dscto. %</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" name="param_docdetDsctoPorcenajeProd" id="param_docdetDsctoPorcenajeProd" placeholder="%"/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetDsctoMontoProd">Dscto. S/.</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetDsctoMontoProd" id="param_docdetDsctoMontoProd" placeholder="S/."/>
																							</div>
																						</div>
																						<div class="col-md-2 col-md-offset-1">
																							<br>
																							<button disabled type="button" class="btn btn-info btn-lg ace-icon fa fa-plus" id="addRow">
																								Agregar
																							</button>
																						</div>
																						<div class="col-md-12">
																							<div class="table-responsive">
																                                <table class="table table-striped table-bordered table-hover display nowrap" id="tablaDetadocProductos">
																                                    <thead>
																                                        <tr>            
																                                          <th class="col-md-1" style='text-align: center;'>N°</th>
																                                          <th class="col-md-1" style='text-align: center;'>PROMOTOR</th>
																                                          <th class="col-md-1" style='text-align: center;'>PRODUCTO</th>
																                                          <th class="col-md-1" style='text-align: center;'>P.U.</th>
																                                          <th class="col-md-1" style='text-align: center;'>CANTIDAD</th>
																                                          <th class="col-md-1" style='text-align: center;'>SUBTOTAL</th>
																                                          <th class="col-md-1" style='text-align: center;'>DESCUENTO</th>
																                                          <th class="col-md-1" style='text-align: center;'>TOTAL</th>
																                                        </tr>
																                                    </thead>           
																                                </table>
																                            </div>			
																						</div>

																						<div class="form-group col-md-2 col-md-offset-10">
																							<label for="param_docdetMontoTotalProd">Monto Total</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetMontoTotalProd" id="param_docdetMontoTotalProd" disabled placeholder="S/."/>
																							</div>
																						</div>

																				</div>
																			</div>

																			<div class="panel panel-default">
																				<div class="panel-heading">
																					<h4 class="panel-title">
																						<a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
																							<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
																							&nbsp;SERVICIOS REALIZADOS
																						</a>
																					</h4>
																				</div>

																				<div class="panel-collapse collapse" id="collapseTwo">
																					<div class="panel-body">
																						<div class="form-group col-md-5">
																							<label for="param_docdetcodserv">Código del Servicio</label>
																							<div class="input-group col-md-12">
																								<input class="form-control col-md-12" type="text" id="param_docdetcodserv" name="param_docdetcodserv" placeholder="Busque el Servicio" disabled/>
																								<span class="input-group-btn">
																									<a href="#modal-buscarServicio" role="button" data-toggle="modal" id="buscarServicio" class="btn btn-sm btn-default">
																										<i class="ace-icon fa fa-search bigger-110"></i>	
																									</a>			
																								</span>
																							</div>
																						</div>	
																						<div class="form-group col-md-6 col-md-offset-1">
																							<label for="param_docdetserv">Servicio</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" id="param_docdetserv" disabled placeholder="Nombre del Servicio"/>
																							</div>
																						</div>
																						<div class="form-group col-md-5">
																							<label for="param_docdetcodpers">Código del Trabajador Ejecutor</label>
																							<div class="input-group col-md-12">
																								<input class="form-control col-md-12" type="text" id="param_docdetcodpers" name="param_docdetcodpers" placeholder="Busque al trabajador" disabled/>
																								<span class="input-group-btn">
																									<a href="#modal-buscarTrabajadorServicio" role="button" data-toggle="modal" id="buscarPersonalServicio" class="btn btn-sm btn-default">
																										<i class="ace-icon fa fa-search bigger-110"></i>	
																									</a>			
																								</span>
																							</div>
																						</div>	
																						<div class="form-group col-md-6 col-md-offset-1">
																							<label for="param_docdetpers">Trabajador Ejecutor</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" id="param_docdetpers" disabled placeholder="Nombre del Trabajador"/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetPrecioBase">P. Base</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" disabled name="param_docdetPrecioBase" id="param_docdetPrecioBase" placeholder="S/."/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetVarPorcServicio">Variación % (+-)</label>
																							<div class="input-group col-md-12">									
																								<input class="col-md-12" type="text" name="param_docdetVarPorcServicio" id="param_docdetVarPorcServicio" placeholder="(+-) %"/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetVarMontoServicio">Variación S/. (+-)</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetVarMontoServicio" id="param_docdetVarMontoServicio" placeholder="(+-) S/."/>
																							</div>
																						</div>
																						<div class="col-md-2 col-md-offset-1">
																							<br>
																							<button disabled type="button" class="btn btn-info btn-lg ace-icon fa fa-plus" id="addRowServicio">
																								Agregar
																							</button>
																						</div>
																						<div class="col-md-12">
																							<div class="table-responsive">
																                                <table class="table table-striped table-bordered table-hover" id="tablaDetadocServicios">
																                                    <thead>
																                                        <tr>            
																                                          <th class="col-md-1" style='text-align: center;'>N°</th>                                                  
																                                          <th class="col-md-1" style='text-align: center;'>SERVICIO</th>
																                                          <th class="col-md-1" style='text-align: center;'>PERSONAL</th>
																                                          <th class="col-md-1" style='text-align: center;'>PRECIO BASE</th>
																                                          <th class="col-md-1" style='text-align: center;'>VARIACIÓN</th>
																                                          <th class="col-md-1" style='text-align: center;'>TOTAL</th>
																                                        </tr>
																                                    </thead>           
																                                </table>
																                            </div>				
																						</div>

																						<div class="form-group col-md-2 col-md-offset-10">
																							<label for="param_docdetMontoTotalServ">Monto Total</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetMontoTotalServ" id="param_docdetMontoTotalServ" disabled placeholder="S/."/>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>


																	</div><!-- /.col -->





																		<div id="accordion" class="accordion-style1 panel-group">
																			<div class="panel panel-default">
																				<div class="panel-heading">
																					<h4 class="panel-title">
																						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
																							<i class="ace-icon fa fa-angle-right bigger-110" data-icon-hide="ace-icon fa fa-angle-down" data-icon-show="ace-icon fa fa-angle-right"></i>
																							&nbsp;PAGOS
																						</a>
																					</h4>
																				</div>

																				<div class="panel-collapse collapse" id="collapseThree">
																					<div class="panel-body">
																						<div class="form-group col-md-2">
																							<label for="param_checkContado">EFECTIVO</label> 
																							<label>
																								<input name="checkEfectivo" id="checkEfectivo" class="ace ace-switch ace-switch-5" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-10">
																							<label for="param_docdetPagoContadoMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-6" type="text" disabled name="param_docdetPagoContadoMonto" id="param_docdetPagoContadoMonto" placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2">
																							<label for="param_checkTarjeta">TARJETA</label> 
																							<label>
																								<input name="checkTarjeta" id="checkTarjeta" class="ace ace-switch ace-switch-5" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-2">
																							<label for="param_docdetPagoTarjetaBanco">Banco</label>
																							<div class="input-group">
																								<input class="col-md-12" type="text" disabled name="param_docdetPagoTarjetaBanco" id="param_docdetPagoTarjetaBanco" placeholder="BCP, BBVA, etc."/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetPagoTarjetaOperacion">N° Operación</label>
																							<div class="input-group">
																								<input class="col-md-12" type="text" disabled name="param_docdetPagoTarjetaOperacion" id="param_docdetPagoTarjetaOperacion" placeholder="N°"/>
																							</div>
																						</div>
																						<div class="form-group col-md-6">
																							<label for="param_docdetPagoTarjetaMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-8" type="text" disabled name="param_docdetPagoTarjetaMonto" id="param_docdetPagoTarjetaMonto" placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2">
																							<label for="param_checkCheque">CHEQUE</label> 
																							<label>
																								<input name="checkCheque" id="checkCheque" class="ace ace-switch ace-switch-5" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-2">
																							<label for="param_docdetPagoChequeBanco">Banco</label>
																							<div class="input-group">
																								<input class="col-md-12" type="text" disabled name="param_docdetPagoChequeBanco" id="param_docdetPagoChequeBanco" placeholder="BCP, BBVA, etc."/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetPagoChequeNumero">N° Cheque</label>
																							<div class="input-group">
																								<input class="col-md-12" type="text" disabled name="param_docdetPagoChequeNumero" id="param_docdetPagoChequeNumero" placeholder="N°"/>
																							</div>
																						</div>
																						<div class="form-group col-md-2">
																							<label for="param_docdetPagoChequeMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-12" type="text" disabled name="param_docdetPagoChequeMonto" id="param_docdetPagoChequeMonto" placeholder="S/."/>
																							</div>
																						</div>
																						<div class="form-group col-md-3">
																							<label for="param_docdetPagoChequeFecha">Fecha Cobro</label>
																							<div class="row">
																								<div class="col-xs-9 col-sm-9">
																									<div class="input-group">
																										<input class="form-control date-picker" disabled name="param_docdetPagoChequeFecha" id="param_docdetPagoChequeFecha" type="text" data-date-format="yyyy-mm-dd" />
																										<span class="input-group-addon">
																											<i class="fa fa-calendar bigger-110"></i>
																										</span>
																									</div>
																								</div>
																							</div>
																						</div>

																						<div class="form-group col-md-2">
																							<label for="param_checkCredito">CRÉDITO</label> 
																							<label>
																								<input name="checkCredito" id="checkCredito" class="ace ace-switch ace-switch-5" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-10">
																							<label for="param_docdetPagoCreditoMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-6" type="text" disabled name="param_docdetPagoCreditoMonto" id="param_docdetPagoCreditoMonto" placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2">
																							<label for="param_checkCanje">CANJE&nbsp;</label> 
																							<label>
																								<input name="checkCanje" id="checkCanje" class="ace ace-switch ace-switch-5 col-md-12" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-10">
																							<label for="param_docdetPagoCanjeMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-6" type="text" disabled name="param_docdetPagoCanjeMonto" id="param_docdetPagoCanjeMonto" placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2">
																							<label for="param_checkRegalo">REGALO</label> 
																							<label>
																								<input name="checkRegalo" id="checkRegalo" class="ace ace-switch ace-switch-5" type="checkbox" />
																								<span class="lbl"></span>
																							</label>
																						</div>																						
																						<div class="form-group col-md-10">
																							<label for="param_docdetPagoRegaloMonto">Monto</label>
																							<div class="input-group">
																								<input class="col-md-6" type="text" disabled name="param_docdetPagoRegaloMonto" id="param_docdetPagoRegaloMonto" placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2 col-md-offset-8">
																							<label for="param_docdetPagoTotalDoc">Monto Pagado</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetPagoTotalDoc" id="param_docdetPagoTotalDoc" disabled placeholder="S/."/>
																							</div>
																						</div>

																						<div class="form-group col-md-2 ">
																							<label for="param_docdetMontoTotalDoc">Total a Pagar</label>
																							<div class="input-group col-md-12">
																								<input class="col-md-12" type="text" name="param_docdetMontoTotalDoc" id="param_docdetMontoTotalDoc" disabled placeholder="S/."/>
																							</div>
																						</div>


																					</div>																					
																				</div>

																			

																		</div>

																		
																	</div>




																</div>
															</div>
															<div class="panel panel-footer text-right">
																<a class="btn btn-sm" id="listar" >Listar</a>
																<input type="hidden" value="grabar" name="param_opcion">
                        										<input type="submit" id="registroDocumento" class="btn btn-sm btn-primary" value="Guardar"/>
															</div>
														<!--</form>-->
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

									
			</div><!-- /.main-content -->
					


	<div id="modal-agregarCliente" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">REGISTRAR CLIENTE</h3>
				</div>
				<form  method="POST" id="form_grabar_cliente">													
					<div class="modal-body">
						<div class="row">
							<div class="modal-body">
								<div class="form-group col-md-5">
									<label for="param_cliDNI">DNI</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-building"></i>
										</span>
										<input class="input-mask-dni col-md-12" type="text" name="param_cliDNI"  id="param_cliDNI"/>
									</div>
								</div>
								<div class="form-group col-md-7">
									<label for="param_cliNombre">Nombres</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-building"></i>
										</span>
										<input class="col-md-12" type="text"  name="param_cliNombre" id="param_cliNombre"/>
									</div>
								</div>

								<div class="form-group col-md-5">
									<label for="param_cliApellidoPaterno">Apellido Paterno</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-building"></i>
										</span>
										<input class="col-md-12" type="text"  name="param_cliApellidoPaterno" id="param_cliApellidoPaterno"/>
									</div>
								</div>

								<div class="form-group col-md-5">
									<label for="param_cliApellidoMaterno">Apellido Materno</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-building"></i>
										</span>
										<input class="col-md-12" type="text"  name="param_cliApellidoMaterno" id="param_cliApellidoMaterno"/>
									</div>
								</div>							

								<div class="form-group col-md-12">
									<label for="param_cliCorreo">Correo</label>
									<div class="input-group">
										<span class="input-group-addon">
											<i class="ace-icon fa fa-envelope"></i>
										</span>
										<input class="col-md-12" type="text"  name="param_cliCorreo" id="param_cliCorreo"/>
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
						<input type="button" id="cancelar" data-dismiss="modal" class="btn btn-sm" value="Cancelar">
						<input type="hidden" value="grabar" name="param_opcion">
						<input type="button" id="registroCliente" class="btn btn-sm btn-primary" value="Guardar"/>												
					</div>
				</form>
			</div>
		</div>
	</div>
	
	<div id="modal-buscarCliente" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">CLIENTE ENCARGADO DEL PAGO</h3>
				</div>
					<div class="modal-body">
						<div class="row">														
							
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tablaClientes">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>DNI</th>                                                  
                                          <th style='text-align: center;'>CLIENTE</th>                  
                                        </tr>
                                    </thead>           
                                    <tbody id="listaClientes">
                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			

						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">
										
					</div>
				
			</div>
		</div>
	</div>

	<div id="modal-buscarTrabajador" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">PERSONAL ENCARGADO DE CAJA</h3>
				</div>
					<div class="modal-body">
						<div class="row">														
							
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tablaPersonal">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>CÓDIGO</th>                                                  
                                          <th style='text-align: center;'>TRABAJADOR</th>                  
                                        </tr>
                                    </thead>           
                                    <tbody id="listaPersonal">                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			
						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">
						
					</div>
				
			</div>
		</div>
	</div>
	
	<div id="modal-buscarPromotorVenta" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">PROMOTOR DE LA VENTA</h3>
				</div>
					<div class="modal-body">
						<div class="row">														
							
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tablaPersonalPromotor">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>CÓDIGO</th>                                                  
                                          <th style='text-align: center;'>TRABAJADOR</th>                  
                                        </tr>
                                    </thead>           
                                    <tbody id="listaPersonalPromotor">                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			
						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">
						
					</div>
				
			</div>
		</div>
	</div>

	<div id="modal-buscarTrabajadorServicio" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">PERSONAL EJECUTOR DE SERVICIO</h3>
				</div>
					<div class="modal-body">
						<div class="row">														
							
							<div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="tablaPersonalServicio">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>CÓDIGO</th>                                                  
                                          <th style='text-align: center;'>TRABAJADOR</th>                  
                                        </tr>
                                    </thead>           
                                    <tbody id="listaPersonalServicio">                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			
						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">
						
					</div>
				
			</div>
		</div>
	</div>

	<div id="modal-buscarProducto" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">PRODUCTO VENDIDO</h3>
				</div>
					<div class="modal-body">
						<div class="row">																					
							<div class="table-responsive  ">
                                <table class="table table-striped table-bordered table-hover" id="tablaProductos">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>CÓD. INTERNO</th>                                                  
                                          <th style='text-align: center;'>PRODUCTO</th>                  
                                          <th class="col-md-1" style='text-align: center;'>STOCK</th>                  
                                          <th class="col-md-1" style='text-align: center;'>PRECIO UNITARIO</th>                  
                                        </tr>
                                    </thead>           
                                    <tbody id="listaProductos">
                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			
						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">									
					</div>				
			</div>
		</div>
	</div>

	<div id="modal-buscarServicio" class="modal" tabindex="-1">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h3 class="blue bigger">SERVICIO REALIZADO</h3>
				</div>
					<div class="modal-body">
						<div class="row">																					
							<div class="table-responsive  ">
                                <table class="table table-striped table-bordered table-hover" id="tablaServicios">
                                    <thead>
                                        <tr>            
                                          <th class="col-xs-2" style='text-align: center;'>CÓDIGO</th>
                                          <th style='text-align: center;'>SERVICIO</th>   
                                          <th class="col-md-1" style='text-align: center;'>PRECIO BASE</th>
                                        </tr>
                                    </thead>           
                                    <tbody id="listaServicios">
                                      
                                    </tbody>                                                  
                                </table>
                            </div> 			
						</div>
					</div>
					<div class="space"></div>
					<div class="modal-footer">									
					</div>				
			</div>
		</div>
	</div>


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
		<script type="text/javascript">
			window.jQuery || document.write("<script src='default/assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='default/assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="default/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="default/assets/js/jquery-ui.custom.min.js"></script>
		<script src="default/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="default/assets/js/chosen.jquery.min.js"></script>
		<script src="default/assets/js/fuelux.spinner.min.js"></script>
		<script src="default/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="default/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="default/assets/js/moment.min.js"></script>
		<script src="default/assets/js/daterangepicker.min.js"></script>
		<script src="default/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="default/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="default/assets/js/jquery.knob.min.js"></script>
		<script src="default/assets/js/jquery.autosize.min.js"></script>
		<script src="default/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="default/assets/js/jquery.maskedinput.min.js"></script>
		<script src="default/assets/js/bootstrap-tag.min.js"></script>
		
		<script src="default/js/documento_new.js"></script>

		<!-- ace scripts -->
		<script src="default/assets/js/ace-elements.min.js"></script>
		<script src="default/assets/js/ace.min.js"></script>



		<!-- inline scripts related to this page -->
		<script type="text/javascript">
			jQuery(function($) {
				$('#id-disable-check').on('click', function() {
					var inp = $('#form-input-readonly').get(0);
					if(inp.hasAttribute('disabled')) {
						inp.setAttribute('readonly' , 'true');
						inp.removeAttribute('disabled');
						inp.value="This text field is readonly!";
					}
					else {
						inp.setAttribute('disabled' , 'disabled');
						inp.removeAttribute('readonly');
						inp.value="This text field is disabled!";
					}
				});
			
			
				if(!ace.vars['touch']) {
					$('.chosen-select').chosen({allow_single_deselect:true}); 
					//resize the chosen on window resize
			
					$(window)
					.off('resize.chosen')
					.on('resize.chosen', function() {
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					}).trigger('resize.chosen');
					//resize chosen on sidebar collapse/expand
					$(document).on('settings.ace.chosen', function(e, event_name, event_val) {
						if(event_name != 'sidebar_collapsed') return;
						$('.chosen-select').each(function() {
							 var $this = $(this);
							 $this.next().css({'width': $this.parent().width()});
						})
					});
			
			
					$('#chosen-multiple-style .btn').on('click', function(e){
						var target = $(this).find('input[type=radio]');
						var which = parseInt(target.val());
						if(which == 2) $('#form-field-select-4').addClass('tag-input-style');
						 else $('#form-field-select-4').removeClass('tag-input-style');
					});
				}
			
			
				$('[data-rel=tooltip]').tooltip({container:'body'});
				$('[data-rel=popover]').popover({container:'body'});
				
				$('textarea[class*=autosize]').autosize({append: "\n"});
				$('textarea.limited').inputlimiter({
					remText: '%n character%s remaining...',
					limitText: 'max allowed : %n.'
				});									
				$( "#input-size-slider" ).css('width','200px').slider({
					value:1,
					range: "min",
					min: 1,
					max: 8,
					step: 1,
					slide: function( event, ui ) {
						var sizing = ['', 'input-sm', 'input-lg', 'input-mini', 'input-small', 'input-medium', 'input-large', 'input-xlarge', 'input-xxlarge'];
						var val = parseInt(ui.value);
						$('#form-field-4').attr('class', sizing[val]).val('.'+sizing[val]);
					}
				});
			
				$( "#input-span-slider" ).slider({
					value:1,
					range: "min",
					min: 1,
					max: 12,
					step: 1,
					slide: function( event, ui ) {
						var val = parseInt(ui.value);
						$('#form-field-5').attr('class', 'col-xs-'+val).val('.col-xs-'+val);
					}
				});
			
			
				
				//"jQuery UI Slider"
				//range slider tooltip example
				$( "#slider-range" ).css('height','200px').slider({
					orientation: "vertical",
					range: true,
					min: 0,
					max: 100,
					values: [ 17, 67 ],
					slide: function( event, ui ) {
						var val = ui.values[$(ui.handle).index()-1] + "";
			
						if( !ui.handle.firstChild ) {
							$("<div class='tooltip right in' style='display:none;left:16px;top:-6px;'><div class='tooltip-arrow'></div><div class='tooltip-inner'></div></div>")
							.prependTo(ui.handle);
						}
						$(ui.handle.firstChild).show().children().eq(1).text(val);
					}
				}).find('span.ui-slider-handle').on('blur', function(){
					$(this.firstChild).hide();
				});
				
				
				$( "#slider-range-max" ).slider({
					range: "max",
					min: 1,
					max: 10,
					value: 2
				});
				
				$( "#slider-eq > span" ).css({width:'90%', 'float':'left', margin:'15px'}).each(function() {
					// read initial values from markup and remove that
					var value = parseInt( $( this ).text(), 10 );
					$( this ).empty().slider({
						value: value,
						range: "min",
						animate: true
						
					});
				});
				
				$("#slider-eq > span.ui-slider-purple").slider('disable');//disable third item
			
				
				$('#id-input-file-1 , #id-input-file-2').ace_file_input({
					no_file:'No File ...',
					btn_choose:'Choose',
					btn_change:'Change',
					droppable:false,
					onchange:null,
					thumbnail:false //| true | large
					//whitelist:'gif|png|jpg|jpeg'
					//blacklist:'exe|php'
					//onchange:''
					//
				});
				//pre-show a file name, for example a previously selected file
				//$('#id-input-file-1').ace_file_input('show_file_list', ['myfile.txt'])
			
			
				$('#id-input-file-3').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'small'//large | fit
					//,icon_remove:null//set null, to hide remove/reset button
					/**,before_change:function(files, dropped) {
						//Check an example below
						//or examples/file-upload.html
						return true;
					}*/
					/**,before_remove : function() {
						return true;
					}*/
					,
					preview_error : function(filename, error_code) {
						//name of the file that failed
						//error_code values
						//1 = 'FILE_LOAD_FAILED',
						//2 = 'IMAGE_LOAD_FAILED',
						//3 = 'THUMBNAIL_FAILED'
						//alert(error_code);
					}
			
				}).on('change', function(){
					//console.log($(this).data('ace_input_files'));
					//console.log($(this).data('ace_input_method'));
				});
				
				
				//$('#id-input-file-3')
				//.ace_file_input('show_file_list', [
					//{type: 'image', name: 'name of image', path: 'http://path/to/image/for/preview'},
					//{type: 'file', name: 'hello.txt'}
				//]);
			
				
				
			
				//dynamically change allowed formats by changing allowExt && allowMime function
				$('#id-file-format').removeAttr('checked').on('change', function() {
					var whitelist_ext, whitelist_mime;
					var btn_choose
					var no_icon
					if(this.checked) {
						btn_choose = "Drop images here or click to choose";
						no_icon = "ace-icon fa fa-picture-o";
			
						whitelist_ext = ["jpeg", "jpg", "png", "gif" , "bmp"];
						whitelist_mime = ["image/jpg", "image/jpeg", "image/png", "image/gif", "image/bmp"];
					}
					else {
						btn_choose = "Drop files here or click to choose";
						no_icon = "ace-icon fa fa-cloud-upload";
						
						whitelist_ext = null;//all extensions are acceptable
						whitelist_mime = null;//all mimes are acceptable
					}
					var file_input = $('#id-input-file-3');
					file_input
					.ace_file_input('update_settings',
					{
						'btn_choose': btn_choose,
						'no_icon': no_icon,
						'allowExt': whitelist_ext,
						'allowMime': whitelist_mime
					})
					file_input.ace_file_input('reset_input');
					
					file_input
					.off('file.error.ace')
					.on('file.error.ace', function(e, info) {
						//console.log(info.file_count);//number of selected files
						//console.log(info.invalid_count);//number of invalid files
						//console.log(info.error_list);//a list of errors in the following format
						
						//info.error_count['ext']
						//info.error_count['mime']
						//info.error_count['size']
						
						//info.error_list['ext']  = [list of file names with invalid extension]
						//info.error_list['mime'] = [list of file names with invalid mimetype]
						//info.error_list['size'] = [list of file names with invalid size]
						
						
						/**
						if( !info.dropped ) {
							//perhapse reset file field if files have been selected, and there are invalid files among them
							//when files are dropped, only valid files will be added to our file array
							e.preventDefault();//it will rest input
						}
						*/
						
						
						//if files have been selected (not dropped), you can choose to reset input
						//because browser keeps all selected files anyway and this cannot be changed
						//we can only reset file field to become empty again
						//on any case you still should check files with your server side script
						//because any arbitrary file can be uploaded by user and it's not safe to rely on browser-side measures
					});
				
				});
			
				$('#spinner1').ace_spinner({value:0,min:0,max:200,step:10, btn_up_class:'btn-info' , btn_down_class:'btn-info'})
				.closest('.ace-spinner')
				.on('changed.fu.spinbox', function(){
					//alert($('#spinner1').val())
				}); 
				$('#spinner2').ace_spinner({value:0,min:0,max:10000,step:100, touch_spinner: true, icon_up:'ace-icon fa fa-caret-up bigger-110', icon_down:'ace-icon fa fa-caret-down bigger-110'});
				$('#spinner3').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus bigger-110', icon_down:'ace-icon fa fa-minus bigger-110', btn_up_class:'btn-success' , btn_down_class:'btn-danger'});
				$('#spinner4').ace_spinner({value:0,min:-100,max:100,step:10, on_sides: true, icon_up:'ace-icon fa fa-plus', icon_down:'ace-icon fa fa-minus', btn_up_class:'btn-purple' , btn_down_class:'btn-purple'});
			
				//$('#spinner1').ace_spinner('disable').ace_spinner('value', 11);
				//or
				//$('#spinner1').closest('.ace-spinner').spinner('disable').spinner('enable').spinner('value', 11);//disable, enable or change value
				//$('#spinner1').closest('.ace-spinner').spinner('value', 0);//reset to 0
			
			
				//datepicker plugin
				//link
				$('.date-picker').datepicker({
					autoclose: true,
					todayHighlight: true
				})
				//show datepicker when clicking on the icon
				.next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
			
				//or change it into a date range picker
				$('.input-daterange').datepicker({autoclose:true});
			
			
				//to translate the daterange picker, please copy the "examples/daterange-fr.js" contents here before initialization
				$('input[name=date-range-picker]').daterangepicker({
					'applyClass' : 'btn-sm btn-success',
					'cancelClass' : 'btn-sm btn-default',
					locale: {
						applyLabel: 'Apply',
						cancelLabel: 'Cancel',
					}
				})
				.prev().on(ace.click_event, function(){
					$(this).next().focus();
				});
			
			
				$('#timepicker1').timepicker({
					minuteStep: 1,
					showSeconds: true,
					showMeridian: false
				}).next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
				$('#fechaHoraDocumento').datetimepicker().next().on(ace.click_event, function(){
					$(this).prev().focus();
				});
				
			
				$('#colorpicker1').colorpicker();
			
				$('#simple-colorpicker-1').ace_colorpicker();
				//$('#simple-colorpicker-1').ace_colorpicker('pick', 2);//select 2nd color
				//$('#simple-colorpicker-1').ace_colorpicker('pick', '#fbe983');//select #fbe983 color
				//var picker = $('#simple-colorpicker-1').data('ace_colorpicker')
				//picker.pick('red', true);//insert the color if it doesn't exist
			
			
				$(".knob").knob();
				
				
				var tag_input = $('#form-field-tags');
				try{
					tag_input.tag(
					  {
						placeholder:tag_input.attr('placeholder'),
						//enable typeahead by specifying the source array
						source: ace.vars['US_STATES'],//defined in ace.js >> ace.enable_search_ahead
						/**
						//or fetch data from database, fetch those that match "query"
						source: function(query, process) {
						  $.ajax({url: 'remote_source.php?q='+encodeURIComponent(query)})
						  .done(function(result_items){
							process(result_items);
						  });
						}
						*/
					  }
					)
			
					//programmatically add a new
					var $tag_obj = $('#form-field-tags').data('tag');
					$tag_obj.add('Programmatically Added');
				}
				catch(e) {
					//display a textarea for old IE, because it doesn't support this plugin or another one I tried!
					tag_input.after('<textarea id="'+tag_input.attr('id')+'" name="'+tag_input.attr('name')+'" rows="3">'+tag_input.val()+'</textarea>').remove();
					//$('#form-field-tags').autosize({append: "\n"});
				}
				
				
				/////////
				$('#modal-form input[type=file]').ace_file_input({
					style:'well',
					btn_choose:'Drop files here or click to choose',
					btn_change:null,
					no_icon:'ace-icon fa fa-cloud-upload',
					droppable:true,
					thumbnail:'large'
				})
				
				//chosen plugin inside a modal will have a zero width because the select element is originally hidden
				//and its width cannot be determined.
				//so we set the width after modal is show
				$('#modal-form').on('shown.bs.modal', function () {
					if(!ace.vars['touch']) {
						$(this).find('.chosen-container').each(function(){
							$(this).find('a:first-child').css('width' , '210px');
							$(this).find('.chosen-drop').css('width' , '210px');
							$(this).find('.chosen-search input').css('width' , '200px');
						});
					}
				})
				/**
				//or you can activate the chosen plugin after modal is shown
				//this way select element becomes visible with dimensions and chosen works as expected
				$('#modal-form').on('shown', function () {
					$(this).find('.modal-chosen').chosen();
				})
				*/
			
				
				
				$(document).one('ajaxloadstart.page', function(e) {
					$('textarea[class*=autosize]').trigger('autosize.destroy');
					$('.limiterBox,.autosizejs').remove();
					$('.daterangepicker.dropdown-menu,.colorpicker.dropdown-menu,.bootstrap-datetimepicker-widget.dropdown-menu').remove();
				});

				$('#accordion-style').on('click', function(ev){
					var target = $('input', ev.target);
					var which = parseInt(target.val());
					if(which == 2) $('#accordion').addClass('accordion-style2');
					 else $('#accordion').removeClass('accordion-style2');
				});
			
			});
		</script>
		<script type="text/javascript">
				$.mask.definitions['~']='[+-]';	
				$('.input-mask-date').mask('9999-99-99');			
				$('.input-mask-phone').mask('999999999');
				$('.input-mask-dni').mask('99999999');
		</script>
        <script src="default/assets/js/jquery.dataTables.min.js"></script>
		<script src="default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
	</body>
</html>

<?php } ?>
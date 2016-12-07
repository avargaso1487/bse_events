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
		<title>Facturación-Nueva Venta</title>

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

	<body class="no-skin" style="overflow-y: scroll;">
		<?php 
		require('../sup_layout.php');
		 ?>

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
                                <a href="#">Facturación</a>
                            </li>
                            <li><a href="../spa.php">Nueva Factura</a></li>
                            <li>
                                <span class="invoice-info-label">Fecha:</span>
                                <span class="blue"><?php echo date('d-m-Y'); ?></span>
                            </li>                            
                            
                        </ul><!-- /.breadcrumb -->				
					</div>

					<div class="page-content">					
						<div class="page-header">
							<h1>
								Nueva Factura
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">
								
                            <form role="form" id="frmRegistroFacturas" class="form-horizontal">
		                        <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Serie</label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" class="form-control" name="param_serie" id="param_serie">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-3 control-label">Número</label>
                                    <div class="input-group col-sm-6">
                                        <input type="text" class="form-control" name="param_numero" id="param_numero" >
                                    </div>
                                </div>
		                    <div class="form-group">		                               
		                               	<label for="" class="col-sm-3 control-label">Evento</label>
	                                    <div class="input-group col-sm-6">
	                                        <input class="form-control" type="text" name="param_descripcionevento" id="evento"  placeholder="Busque evento" disabled/>
	                                        <span class="input-group-btn">
	                                            <a id="buscarProveedor" class="btn btn-sm btn-default" href="#verevento" data-toggle='modal' onclick="limpiar();">
	                                                <i class="ace-icon fa fa-search bigger-110"></i>    
	                                            </a>                                     
	                                        </span>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <input class="form-control"  name="param_evento" id="codigoEvento" type="hidden" />
	                                    </div>
		                    </div>

                            <div class="form-group">		                               
		                               	<label for="" class="col-sm-3 control-label">Participante</label>
	                                    <div class="input-group col-sm-6">
	                                        <input class="form-control" type="text" name="param_participanteDescrip" id="participanteDescrip"  placeholder="Busque participante" disabled/>
	                                        <span class="input-group-btn">
	                                            <a id="buscarParticipante" class="btn btn-sm btn-default" href="#verParticipante" data-toggle='modal' onclick="listarParticipantes(codigoEvento.value);">
	                                                <i class="ace-icon fa fa-search bigger-110"></i>    
	                                            </a>                                     
	                                        </span>
	                                    </div>
	                                    <div class="col-md-2">
	                                        <input class="form-control"  name="param_participante" id="participantes" type="hidden"  />
	                                    </div>
		                    </div>

                            <div class="col-md-offset-5">
									<a id="buscar" class="btn btn-sm btn-success" onclick="cargarDatos(codigoEvento.value,participantes.value);mostrarDetalle(codigoEvento.value,participantes.value);mostrarMonto(codigoEvento.value,participantes.value);">
                                        <i ></i> REALIZAR BÚSQUEDA  
                                    </a> 
								</div><br>
		                    <div class="widget-header widget-header-flat col-md-8 col-md-offset-2">                                
                                        <h4 class="widget-title" style="font-size:18px;">DETALLE</h4>
                                    </div><br><br><br>
                                    <div class="col-md-7 col-md-offset-3">	
		                            <div class="col-md-6">		                               
		                               	<label for="">Paquete</label>
		                                <div class="input-group">
	                                        <input class="form-control col-md-12 " type="text" name="param_paquete" id="paquete" disabled="disabled"  />	                                        
	                                    </div>	                                    	                              
		                            </div>
		                            <div class="col-md-6">		                               
		                               	<label for="">Condición</label>
		                                <div class="input-group">
	                                        <input class="form-control col-md-12 " type="text" name="param_condicion" id="condicion" disabled="disabled" />	                                        
	                                    </div>	                                    	                              
		                            </div>
                                	</div>
		                            
		                                  
		                     
		                            
		                            
		                            	                            
		                            <br><br><br><br>
		                            
		                            <div class="col-md-10 col-md-offset-1">
		                            	<div class="table-header">
											Detalle de actividades.
										</div>
										<div>
											<table id="tablaDetallesFactura" class="table table-striped table-bordered">
												<thead>											
										            <tr>
										                <th style="text-align: center; font-size: 11px; height: 10px; width: 30%;">Código</th>
										                <th style="text-align: center; font-size: 11px; height: 10px; width: 40%;">Descripción</th>	
										                <th style="text-align: center; font-size: 11px; height: 10px; width: 30%;">Precio</th>
			            								
										            </tr>							         
												</thead>
												<tbody id="cuerpoDetalleFactura">												
												</tbody>
											</table><br>
										</div>
		                            </div>
		                          <div class="form-group" align="center">
		                            <div class="col-md-4">		                               
		                               	<label for="">Total</label>
		                                <div class="input-group">
		                                    <input class="form-control" type="text" name="param_total" id="total"style="text-align:right;" disabled />
		                                </div>
		                            </div>			
		                            <div class="col-md-4">		                               
		                               	<label for="" >Descuento(%)</label>		                               
	                                    <div class="input-group col-md-5">
	                                        <input class="form-control col-md-12" type="text" name="param_descuento" id="descuento" style="text-align:right;" value="" disabled="" />
	                                    </div>	
		                            </div>
		                            <div class="col-md-4">		                               
		                               	<strong style="color:red">Total Neto</strong>
		                                <div class="input-group">
		                                    <input class="form-control" type="text" name="param_neto" id="neto" style="text-align:right;" disabled value="0.00" />
		                                </div>
		                            </div>
		                            </div>

		                           <br><br>
		                            <div class="row">
		                            	<div class="col-md-12" align="center">
		                            		<!--button type="button" class="btn btn-primary " id="view_articulo"><i class="ace-icon fa fa-eye bigger-110"></i>Articulo</button> 
		                            		<button type="button" class="btn btn-primary offset-1" id="edit_articulo"><i class="ace-icon fa fa-pencil bigger-110"></i>Editar Articulo</button-->
		                            		<button type="button" class="btn btn-primary" id="register_pedido"><i class="ace-icon fa fa-plus bigger-110"></i>Registrar</button>
				                            <button type="button" class="btn btn-primary" id="cancel_proveedor" onclick="cerrar();"><i class="ace-icon fa fa-close bigger-110"></i>Cancelar</button>            
		                            	</div> 
		                            	<div class="form-group">
                                
                                <div class="col-sm-1"></div>
                                
                                
                            </div>                          	
			                        </div><br><br><br><br><br><br>
		                    </form>
		                    		                                        
							</div>							
								<!-- FIN DE CONTENIDO DE PAGINA -->
							<div class="modal fade" id="verevento" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			                    <div class="modal-dialog modal-lg">
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                          <h4 class="modal-title text-center" id="cabeceraRegistro"><b>Eventos</b></h4>
			                        </div>
			                        <div class="modal-body">
			                       		<div class="row">
											<div class="col-md-12">												
				                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" >
						                        <div class="row">						                            
						                            <div class="col-md-10 col-md-offset-1">
						                            	<div class="table-header">
															Lista de eventos registrados.
														</div>
														<div>
															<table id="tablaEventos" class="table table-striped table-bordered">
																<thead>											
														            <tr>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">Código</th>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 85%;">Evento</th>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">Operaciones</th>	        
														            </tr>							         
																</thead>
																<tbody id="cuerpoEventos">																	
																</tbody>
															</table>
														</div>
						                            </div>						                       
						                    </form>
						                    		                                        
											</div>							
												<!-- FIN DE CONTENIDO DE PAGINA -->
										</div><!-- /.col -->
			                        </div>
			                      </div>
			                    </div>
			                </div>


						</div><!-- /.col -->
					</div>
					<div class="modal fade" id="verParticipante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			                    <div class="modal-dialog" style="width:90% !important">
			                      <div class="modal-content">
			                        <div class="modal-header">
			                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
			                          <h4 class="modal-title text-center" id="cabeceraRegistro"><b>Participantes</b></h4>
			                        </div>
			                        <div class="modal-body">
			                       		<div class="row">
											<div class="col-md-12">												
				                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" >
						                        <div class="row">						                            
						                            <div class="col-md-12">
						                            	<div class="table-header">
															Lista de Participantes.
														</div>
														<div>
															<table id="tablaParticipantes" class="table table-striped table-bordered">
																<thead>
														            <tr>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 20%;">Código</th>	
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">Nombre</th>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">DNI</th>
														                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">Operaciones</th>                  
														            </tr>							         
																</thead>
																<tbody id="cuerpoParticipantes">																	
																</tbody>
															</table>
														</div>
						                            </div>						                       
						                    </form>
						                    		                                        
											</div>							
												<!-- FIN DE CONTENIDO DE PAGINA -->
										<input type="hidden" dissabled="true" value="FACTURACIÓN" id="NombreGrupo">
                                <input type="hidden" dissabled="true" value="Ventas" id="NombreTarea">

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

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

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->

		<!-- basic scripts -->

		<!--[if !IE]> -->
		

		<!-- <![endif]-->

		<!--[if IE]>
<script src="Recursos/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
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
		

		<script src="../default/js/venta.js"></script>
		<script type="text/javascript">		        
	        function solonumeros(e) {
	            key = e.keyCode || e.which;
	            teclado = String.fromCharCode(key);
	            numeros = "0123456789";
	            especiales = "8-37-38-46"
	            teclado_especial=false;

	            for (var i in especiales) {
	                if (key == especiales[i]) {
	                    teclado_especial= true;
	                }
	            }

	            if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
	                return false;
	            }
	        }

	        function telefonovalidation(e) {
	            var unicode = e.charCode ? e.charCode : e.keyCode            
	            if (unicode != 45 && unicode != 32) {
	                if (unicode < 48 || unicode > 57) //if not a number
	                { return false } //disable key press                
	            }
	        }

	        function soloLetras(e){
	           key = e.keyCode || e.which;
	           tecla = String.fromCharCode(key).toLowerCase();
	           letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
	           especiales = "8-37-39-46";

	           tecla_especial = false
	           for(var i in especiales){
	                if(key == especiales[i]){
	                    tecla_especial = true;
	                    break;
	                }
	            }

	            if(letras.indexOf(tecla)==-1 && !tecla_especial){
	                return false;
	            }
	        } 

	        $('#id-input-file-1 , #id-input-file-2').ace_file_input({
                    no_file:'Ajuntar Cv...',
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
    	</script>
    	<script src="../default/assets/js/jquery.dataTables.min.js"></script>
		<script src="../default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		<!-- inline scripts related to this page -->
	</body>
</html>
<?php } ?>

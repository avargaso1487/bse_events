
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
		<title>Mantenedores - Tipo Ambiente</title>

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
                                <a href="#">Mantenedores</a>
                            </li>
                            <li><a href="local_view.php">Locales</a></li>
                            <li>
                                <span class="invoice-info-label">Fecha:</span>
                                <span class="blue"><?php echo date('d-m-Y'); ?></span>
                            </li>                            
                            
                        </ul><!-- /.breadcrumb -->				
					</div>

					<div class="page-content">					
						<div class="page-header">
							<h1>
								Locales Registrados	
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">								
								<div class="table-header">
									LOCALES REGISTRADOS &nbsp;&nbsp;
									<a href='#modal-form' data-toggle='modal' class='white' onclick="limpiar();">
					                    <i class='ace-icon fa fa-plus-circle bigger-150'></i>
					                </a>
								</div>
								<div>
									<table id="dataTables-example" class="table table-striped table-bordered">
										<thead>											
								            <tr>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">N°</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">DESCRIPCIÓN</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">DIRECCIÓN</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 15%;">ESTADO</th>
                								<th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">OPERACIONES</th>
								            </tr>							         
										</thead>
										<tbody id="cuerpoTabla">																	
										</tbody>
									</table>
								</div>


								
							<div id="modal-form" class="modal fade" tabindex="-1">
								<div class="modal-dialog">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal">&times;</button>
											<h4 class="blue bigger">Registro de Local</h4>
										</div>

										<div class="modal-body">
											<div class="row">
											<form class="form-horizontal form-bordered" method="post" action="../../controller/controlMantenedores/local_controller.php" onsubmit="return validarCampos()">
                            
                            
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Descripción</label>
                                <div class="col-sm-7">
                                    <input class="form-control" id="descripcion" name="param_local_descripcion" type="text" placeholder="Ingrese descripción " >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input class="form-control" id="direccion" name="param_local_direccion" type="text" placeholder="Ingrese dirección " >
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                
                                <div class="col-sm-1"></div>
                                <input type="hidden" value="registrar" name="param_opcion">
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                	<center><button type="button" id="btn_cancelar_participante" class="btn btn-primary mr-xs mb-sm buttonform" data-dismiss="modal">Cancelar</button>
                                    <input type="submit" value="Registrar" class="btn btn-primary mr-xs mb-sm buttonform" ></center>
                                </div>
                            </div>
                            </form>

												</div>
											</div>

											
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->







								<div id="modalEditarAmb" class="modal" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Datos de Local</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<form class="form-horizontal form-bordered" method="post" action="../../controller/controlMantenedores/local_controller.php">
                            
                            
                                    <input  id="codigo_e" name="param_local_id" type="text" style="visibility:hidden;" >
                            

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Descripción</label>
                                <div class="col-sm-7">
                                    <input class="form-control" id="descripcion_e" name="param_local_descripcion" type="text" placeholder="Ingrese nueva descripción" >
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">Dirección</label>
                                <div class="col-sm-7">
                                    <input class="form-control" id="direccion_e" name="param_local_direccion" type="text" placeholder="Ingrese nueva dirección" >
                                </div>
                            </div>
                            
                            
                            <div class="form-group">
                                
                                <div class="col-sm-1"></div>
                                <input type="hidden" value="actualizar" name="param_opcion">
                               <!--  <input type="hidden" dissabled="true" value="Mantenedores" id="NombreGrupo">
                                <input type="hidden" dissabled="true" value="ambientes" id="NombreTarea"> -->
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <center><input type="submit" id="actualizar" value="Actualizar" class="btn btn-primary mr-xs mb-sm buttonform" ></center>
                                </div>
                            </div>
                            </form>

							</div>
							</div>

											
							</div>
							</div>
							</div><!-- PAGE CONTENT ENDS -->
								


							</div>				
							<input type="hidden" dissabled="true" value="Mantenedores" id="NombreGrupo">
                            <input type="hidden" dissabled="true" value="Local" id="NombreTarea">			
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
		

		<script src="../default/js/local.js"></script>
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

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
		<title>Reportes-Texto delimitado</title>

		<meta name="description" content="" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

		<!-- bootstrap & fontawesome -->
		<link rel="stylesheet" href="../default/assets/css/bootstrap.min.css" />
		<link rel="stylesheet" href="../default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
		<link rel="stylesheet" href="../default/assets/css/datepicker.min.css" />
		<link rel="stylesheet" href="../default/assets/css/bootstrap-timepicker.min.css" />
		<link rel="stylesheet" href="../default/assets/css/daterangepicker.min.css" />
		<link rel="stylesheet" href="../default/assets/css/bootstrap-datetimepicker.min.css" />
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
	<body class="no-skin" >
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
                                <a href="#">Reportes</a>
                            </li>
                            <li><a href="ventas_view.php">Ancho Fijo</a></li>
                            <li>
                                <span class="invoice-info-label">Fecha:</span>
                                <span class="blue"><?php echo date('d-m-Y'); ?></span>
                            </li>                            
                            
                        </ul><!-- /.breadcrumb -->	
						
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								Reporte ancho fijo	
							</h1>
						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-md-12">
								
                            <form role="form" id="frmRegistroFacturas" class="form-horizontal" >
		                        <div class="form-group">
                                    <label for="" class="col-sm-5 control-label">Fecha Inicio</label>
                                    <div class="input-group col-sm-2">
                                      
                                        <input class="form-control date" value="<?php echo date('Y-m-d'); ?>" id="param_fechaInicio" name="param_fechaInicio" type="text">
                                    </div>
                                    
                                </div>
                                <div class="form-group">
                                    <label for="" class="col-sm-5 control-label">Fecha Fin</label>
                                    <div class="input-group col-sm-2">
                                        <input class="form-control date" value="<?php echo date('Y-m-d'); ?>" id="param_fechaFin" name="param_fechaFin" type="text">
                                    </div>
                                </div>
		                    
                            

                            <div class="col-md-offset-5">
									<input value="GENERAR REPORTE" class="btn btn-sm btn-success" onclick="imprimir(param_fechaInicio.value,param_fechaFin.value);">
                                         
                                    </input> 
                                    <div hidden=true id="archivo">
                                    <a href="anchofijo.txt" download="Reporte ancho fijo" onclick="ocultar();">Descargar Reporte
								</a>
								</div>
								</div><br>
		                                           
		                            <br><br><br><br>
		                           <br><br>
		                           
                                
                            </div>                          	
			                        </div><br><br><br><br><br><br>
		                    </form>
		                    		                                        
							</div>						

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
	    <script src="../default/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../default/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../default/assets/js/moment.min.js"></script>
		<script src="../default/assets/js/daterangepicker.min.js"></script>
		<script src="../default/assets/js/bootstrap-datetimepicker.min.js"></script>
		
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<script src="../default/assets/js/ace-elements.min.js"></script>
		<script src="../default/assets/js/ace.min.js"></script>
		

		<script src="../default/js/reporte.js"></script>
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

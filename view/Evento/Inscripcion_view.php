
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
		<title>Mantenedores - Ponentes</title>

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
                                <a href="#">Evento</a>
                            </li>
                            <li><a href="inscripcion_view.php">Inscripciones</a></li>
                            <li>
                                <span class="invoice-info-label">Fecha:</span>
                                <span class="blue"><?php echo date('d-m-Y'); ?></span>
                            </li>                            
                            
                        </ul><!-- /.breadcrumb -->				
					</div>

					<div class="page-content">					
						<div class="page-header">
							<h1>
								Inscripción	
							</h1>
						</div><!-- /.page-header -->
						<div class="row">
							<div class="col-md-12">	
								<div id="mensaje2"></div>							
								<form id="frmParticipantes" class="form-horizontal">
			                        <div class="row">
			                            <div class="form-group">		                               
			                               <label for="socio" class="col-md-4 control-label">Participante:</label>
			                               <div class="col-md-4 input-group">
		                                        <input class="form-control" type="text" name="param_participante" id="param_participante" placeholder="Seleccionar Participante" disabled="disabled" />
		                                        <span class="input-group-btn">
		                                            <a id="buscarParticipante" class="btn btn-sm btn-default">
		                                                <i class="ace-icon fa fa-search bigger-110"></i>    
		                                            </a>                                     
		                                        </span>
		                                    </div>   		                               
			                            </div>
			                            <input class="form-control" type="hidden" name="param_participanteID" id="param_participanteID"/>
			                            <div class="form-group">
			                               <label for="socio" class="col-md-2 control-label">Evento:</label>
			                               <div class="col-md-4" id="evento">
			                                   
			                               </div>	
			                               <label for="socio" class="col-md-1 control-label">Condición: </label>			                               
											<div class="col-md-3">
												<label class="radio-inline ace"><input type="radio" name="param_condicion" id="param_condicion" value="N" checked="checked" onclick="mostrarMonto()">Normal</label>
											<label class="radio-inline ace"><input type="radio" name="param_condicion" id="param_condicion" value="B" onclick="mostrarMonto()">Becado</label>
											<label class="radio-inline ace"><input type="radio" name="param_condicion" id="param_condicion" value="D" onclick="mostrarMonto()">Descuento</label>
											</div>											
													                               	                               
			                            </div> 
			                            <div class="form-group">
			                               <label for="socio" class="col-md-2 control-label">Paquete:</label>
			                               <div class="col-md-3" id="paquete">
			                                   
			                               </div>	
			                               <label for="socio" class="col-md-2 control-label">T. Doc. Pago: </label>
			                               <div class="col-md-3" id="tipoPago">
			                                   
			                               </div>			                               	                               
			                            </div> 		                          			                            
                                		<div class="form-group">                                       
                                   			<label for="socio" class="col-md-2 control-label" >Banco:</label>
                                   			<div class="col-md-4">
                                       			<input class="form-control" placeholder="Ingrese Banco" id="param_banco" name="param_banco" type="text" autofocus="">
                                   			</div>
                                   			<label for="socio" class="col-md-2 control-label">N° de Operación:</label>
                                   			<div class="col-md-2">
                                       			<input class="form-control" placeholder="N° de Operación" id="param_nroOperacion" name="param_nroOperacion" type="text" autofocus="" onkeypress="return solonumeros(event)">
                                   			</div>                              
                                		</div>
                                		<div class="form-group"> 
                                			<label for="socio" class="col-md-2 control-label">Adjuntar Voucher:</label>
                                   			<div class="col-md-4">
                                        		<input id="Voucher" name="Voucher" type="file">
                                   			</div>                                       
                                   			<label for="socio" class="col-md-2 control-label">Fecha de Pago:</label>
                                   			<div class="col-md-2">
                                       			<input class="form-control" id="param_fechaPago" name="param_fechaPago" type="date" autofocus="">
                                   			</div>                                    		                                                            
                                		</div>                                            			                            		    
	                            		<input  type="hidden" id="param_codigo" name="param_codigo"/>
	                            		<div class="form-group">
	                            			<label for="socio" class="col-md-2 control-label">Dcto(%): </label>                              
			                               	<div class="col-md-1">
		                                   		<input class="form-control" id="param_descuento" name="param_descuento" type="text" disabled="disabled" value="0">
		                               		</div>	
			                            	<label for="socio" class="col-md-2 control-label">Actividad: </label>                              
			                               	<div class="col-md-4" id="actividad">
		                                   		<select class="form-control">
                    								<option value="" disabled selected style="display: none;">Seleccione Actividades</option>
                    							</select>
		                               		</div>

		                              
		                                   	<div class="col-md-1">		                     		                              
				                                <div class="input-group">
			                                        <button type="button" class="btn btn-success btn-lg ace-icon fa fa-plus" id="addLinea">
		                                        	</button>		                                        	                                   
			                                    </div>	

				                            </div> 
				                            <input class="form-control" id="param_opcion" name="param_opcion" type="hidden" value="registrar_inscripcion">
				                            <input class="form-control" id="param_actividadID" name="param_actividadID" type="hidden">
				                            <input class="form-control" id="param_nombreActividad" name="param_nombreActividad" type="hidden">
				                            <input class="form-control" id="param_precio" name="param_precio" type="hidden">                           	                               
			                            </div>

			                            
		                            
		                            	<div class="col-md-8 col-md-offset-2">								
											<div class="table-header">
												Inscripción - Actividades
											</div>
											<div>
												<table id="tablaDetalleActividades" class="table table-striped table-bordered">
													<thead>											
											            <tr>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">Código</th>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Actividad</th>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Precio</th>								              
			                								<th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">Operaciones</th>
											            </tr>							         
													</thead>
													<tbody id="cuerpoActividades">																			
													</tbody>
												</table>
											</div><br>
										</div>
		                            	<div class="form-group">
			                            	<label for="socio" class="col-md-6 control-label">Total Neto: </label>                              
			                               	<div class="col-md-1">
		                                   		<input class="form-control" id="param_montoNeto" name="param_montoNeto" type="text" disabled="disabled">
		                               		</div>
			                            	<label for="socio" class="col-md-2 control-label">Monto Total: </label>                              
			                               	<div class="col-md-1">
			                               		<input class="form-control" id="param_monto" name="param_monto" type="text" disabled="disabled">	                                   		
		                               		</div>

	                              
	                                                	                              
		                            	</div>	
		                            	                           
		                        		<div class="modal-footer">		                            		
		                            		<button type="button" class="btn btn-primary" id="register_inscripcion">Registrar</button> 
		                            		<button type="button" class="btn btn-primary" id="cancel_inscripcion">Cancelar</button>            
		                        		</div>
	                    		</form>
			                        			
								
							</div>				
							<input type="hidden" dissabled="true" value="Gestion de Eventos" id="NombreGrupo">
                            <input type="hidden" dissabled="true" value="Inscripciones" id="NombreTarea">			
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
				<div class="modal fade" id="modalParticipante" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 80% !important;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title text-center" id="cabeceraRegistro"><b>..:: Participantes Registrados ::..</b></h4>
                        </div>
                        <div class="modal-body">
                       		<div class="row">
								<div class="col-md-12">												
	                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" method="POST">
			                        <div class="row">						                            
			                            <div class="col-md-10 col-md-offset-1">
			                            	<div class="table-header">
												Lista de Ponentes registrados.
											</div>
											<div>
												<table id="tablaParticipantes" class="table table-striped table-bordered">
													<thead>											
											            <tr>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">Codigo</th>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 70%;">Nombres y Apellidos</th>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">DNI</th>
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Nivel</th>	
											                <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">C. Profesional</th>											               
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
							</div><!-- /.col -->
                        </div>
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
		

		<script src="../default/js/inscripciones.js"></script>
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

	        $('#id-input-file-1 , #Voucher').ace_file_input({
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
		<!-- inline scripts related to this page -->
	</body>
</html>
<?php 
	}
?>
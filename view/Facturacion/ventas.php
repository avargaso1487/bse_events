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
	<meta charset=utf-8 />
	<title>BSE Vet</title>
	<link rel="stylesheet" href="../default/assets/css/bootstrap.min.css" />
	<link rel="stylesheet" href="../default/assets/font-awesome/4.2.0/css/font-awesome.min.css" />
	
	<link rel="stylesheet" href="../default/assets/fonts/fonts.googleapis.com.css" />
	<link rel="stylesheet" href="../default/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />

	<link rel="stylesheet" href="../default/assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
		

	<script src="../default/assets/js/ace-extra.min.js"></script>

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


				<!--Inicia la parte modificable-->

				<ul class="nav nav-list" id="permisos">
				<!--
					<li class="">
						<a href="#" class="dropdown-toggle">
							<i class="menu-icon fa fa-list-alt"></i>
							<span class="menu-text">
								Mantenedores
							</span>

							<b class="arrow fa fa-angle-down"></b>
						</a>

						<b class="arrow"></b>

						<ul class="submenu">
							<!--<li class="">
								<a href="../empresa.php">
									<i class="menu-icon fa fa-home"></i>
									Empresa									
								</a>														
							</li>

							<li class="">
								<a href="../articulo.php">
									<i class="menu-icon fa fa-caret-right blue"></i>
									Articulos
								</a>
								<b class="arrow"></b>							
							</li>
							
							<li class="">
								<a href="../cliente.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Clientes
								</a>
								<b class="arrow"></b>
							</li>

							<li class="">
								<a href="../mascota.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Mascotas									
								</a>
								<b class="arrow"></b>							
							</li>

							<li class="">
								<a href="../compras/proveedor.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Proveedores									
								</a>
								<b class="arrow"></b>							
							</li>		

							<li class="">
								<a href="../gestionarVeterinario.php">
									<i class="menu-icon fa fa-caret-right"></i>
									Veterinarios						
								</a>
								<b class="arrow"></b>
							</li>		

							<li class="">
                                <a href="../emails.php">
                                    <i class="menu-icon fa fa-envelope"></i>
                                    Emails                        
                                </a>
                                <b class="arrow"></b>
                            </li> 																				
						</ul>
					</li>
					<li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">Compras</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">                           
                            <li class="">
                                <a href="../compras/pedidos.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Pedidos
                                </a>
                                <b class="arrow"></b>
                            </li>
                            <li class="">
                                <a href="../compras/entregas.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Entregas
                                </a>
                                <b class="arrow"></b>
                            </li>   
                            <li class="">
                                <a href="../compras/facturas.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Facturas
                                </a>
                                <b class="arrow"></b>
                            </li>        
                        </ul>
                    </li>
                    <li class="">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">Ventas</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">                           
                            <li class="">
                                <a href="../facturasVentaTienda.php">
                                    <i class="menu-icon fa fa-caret-right"></i>
                                    Tienda
                                </a>
                                <b class="arrow"></b>
                            </li>
                                     
                        </ul>
                    </li>
                    <li class="active open">
                        <a href="#" class="dropdown-toggle">
                            <i class="menu-icon fa fa-user"></i>
                            <span class="menu-text">SPA</span>

                            <b class="arrow fa fa-angle-down"></b>
                        </a>

                        <b class="arrow"></b>

                        <ul class="submenu">                           
                            <li class="active">
                                <a href="../spa.php">
                                    <i class="menu-icon fa fa-caret-right blue"></i>
                                    Servicios
                                </a>
                                <b class="arrow"></b>
                            </li>
                                     
                        </ul>
                    </li>-->
				</ul>
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
								<a href="../home/home.php">Home</a>
							</li>							
							<li>SPA</li>
							<li>Servicios</li>
						</ul><!-- /.breadcrumb -->
						
					</div>

					<div class="page-content">
						<div class="page-header">
							<h1>
								<b>SERVICIOS</b>
								<small>
									<i class="ace-icon fa fa-angle-double-right"></i>
									Registro de Servicios
								</small>
							</h1>
							<div class="widget-header widget-header-large">
										<div class="widget-toolbar no-border invoice-info">
											<span class="invoice-info-label">Fecha:</span>
											<span class="blue"><?php echo date('d-m-Y'); ?></span>
										</div>
									</div>			

						</div><!-- /.page-header -->

						<div class="row">
							<div class="col-xs-12">
								<div class="col-md-offset-5">
									<a id="new_proveedor" class="btn btn-sm btn-success" href="recordatorio.php">
                                        <i ></i> RECORDATORIO  
                                    </a> 
								</div><br>						
								<!-- PAGE CONTENT BEGINS -->
								<div class="table-header">
									SERVICIOS REGISTRADOS &nbsp;&nbsp;
									<a href='nuevoServicioSpa.php'  class='white' onclick="limpiar();">
					                    <i class='ace-icon fa fa-plus-circle bigger-150'></i>
					                </a>
				                </div>
								
									<div>
										<table class="table table-striped table-bordered" id="dataTables-example">
											<thead>
												<tr>
													<th style="text-align: center; font-size: 11px; height: 10px; width:10%">Código</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:10%">Cliente</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Celular</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Mascota</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:10%">Fecha y Hora de Inicio</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:10%">Fecha y Hora de Final</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Llegada</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Entrega</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Estado</th>
													<th style="text-align: center; font-size: 11px; height: 10px; width:6%">Operaciones</th>
													

												</tr>
											</thead>

											<tbody id="cuerpoTabla">
												
												
												
											</tbody>
										</table>
									</div><!-- /.span -->
								

								
								<div id="modal-form" class="modal fade" tabindex="-1">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<button type="button" class="close" data-dismiss="modal">&times;</button>
												<h4 class="blue bigger">Registro de servicios</h4>
											</div>

											<div class="modal-body">
												<div class="row">
													<form class="form-horizontal form-bordered" method="post" action="../controller/controlspa/spa_controller.php" onsubmit="return validarCampos()">
                            
                            
                            
                            
             

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Cliente</label>
                                <div class="col-sm-6" id="cliente">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Mascota</label>
                                <div class="col-sm-6" id="mascota">
                                <select class="form-control" id="comboMascota" name="param_mascota_id" >
                                    <option value="0"> Seleccione mascota</option>	
                                </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Servicio</label>
                                <div class="col-sm-6" id="servicio">
                                    
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="col-sm-3 control-label">Observaciones</label>
                                <div class="col-sm-6">
                                    <textarea class="form-control" id="observaciones"  name="param_observacion" placeholder="Ingrese alguna observacion" rows="1"></textarea>
                                </div>
                            </div>


                            
                            <div class="form-group">
                                
                                <div class="col-sm-1"></div>
                                <input type="hidden" value="registrar" name="param_opcion">
                                
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">
                                    <center><input type="submit" value="Registrar" class="btn btn-primary mr-xs mb-sm buttonform" ></center>
                                </div>
                            </div>
                            </form>

												</div>
											</div>

											
										</div>
									</div>
								</div><!-- PAGE CONTENT ENDS -->
								<br><br>
									<div class="col-md-8 col-md-offset-2" id="detalle_servicio">
								
								<div class="table-header">
									DETALLE DE SERVICIO &nbsp;&nbsp;									
								</div>
								<div>
									<table id="tablaDetalleServicio" class="table table-striped table-bordered">
										<thead>											
								            <tr>								              
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Codigo</th>
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Descripción</th>		
								                <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">Importe</th>	
								            </tr>							         
										</thead>
										<tbody id="cuerpoDetalleServicio">																	
										</tbody>
									</table>
								</div><br><br>
							</div>

								<input type="hidden" dissabled="true" value="SPA" id="NombreGrupo">
                                <input type="hidden" dissabled="true" value="Servicios" id="NombreTarea">

							</div><!-- /.col -->
						</div><!-- /.row -->
					</div><!-- /.page-content -->
				</div>
			</div><!-- /.main-content -->

						<div class="footer">
				<div class="footer-inner">
					<div class="footer-content">
						<span class="bigger-120">
							<span class="blue bolder">BSE</span>
							&copy; All Rights Reserved
						</span>

						&nbsp;
						<span class="action-buttons">							
							<a href="../https://www.facebook.com/bse.com.pe/?fref=ts">
								<i class="ace-icon fa fa-facebook-square text-primary bigger-150"></i>
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
		<script src="../default/assets/js/jquery.2.1.1.min.js"></script>
		<script src="../default/assets/js/ace-extra.min.js"></script>		
		<script src="../default/js/spa.js"></script>

		<!-- <![endif]-->

		<!--[if IE]>
<script src="../default/assets/js/jquery.1.11.1.min.js"></script>
<![endif]-->

		<!--[if !IE]> -->
		<script type="text/javascript">
			window.jQuery || document.write("<script src='../assets/js/jquery.min.js'>"+"<"+"/script>");
		</script>

		<!-- <![endif]-->

		<!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='../assets/js/jquery1x.min.js'>"+"<"+"/script>");
</script>
<![endif]-->
		<script type="text/javascript">
			if('ontouchstart' in document.documentElement) document.write("<script src='../assets/js/jquery.mobile.custom.min.js'>"+"<"+"/script>");
		</script>
		<script src="../default/assets/js/bootstrap.min.js"></script>

		<!-- page specific plugin scripts -->

		<!--[if lte IE 8]>
		  <script src="../default/assets/js/excanvas.min.js"></script>
		<![endif]-->
		<script src="../default/assets/js/jquery-ui.custom.min.js"></script>
		<script src="../default/assets/js/jquery.ui.touch-punch.min.js"></script>
		<script src="../default/assets/js/chosen.jquery.min.js"></script>
		<script src="../default/assets/js/fuelux.spinner.min.js"></script>
		<script src="../default/assets/js/bootstrap-datepicker.min.js"></script>
		<script src="../default/assets/js/bootstrap-timepicker.min.js"></script>
		<script src="../default/assets/js/moment.min.js"></script>
		<script src="../default/assets/js/daterangepicker.min.js"></script>
		<script src="../default/assets/js/bootstrap-datetimepicker.min.js"></script>
		<script src="../default/assets/js/bootstrap-colorpicker.min.js"></script>
		<script src="../default/assets/js/jquery.knob.min.js"></script>
		<script src="../default/assets/js/jquery.autosize.min.js"></script>
		<script src="../default/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
		<script src="../default/assets/js/jquery.maskedinput.min.js"></script>
		<script src="../default/assets/js/bootstrap-tag.min.js"></script>

		<!-- ace scripts -->
		<script src="../default/assets/js/ace-elements.min.js"></script>
		<script src="../default/assets/js/ace.min.js"></script>

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
			
				$.mask.definitions['~']='[+-]';
				$('.input-mask-date').mask('99/99/9999');
				$('.input-mask-phone').mask('(999) 999-9999');
				$('.input-mask-eyescript').mask('~9.99 ~9.99 999');
				$(".input-mask-product").mask("a*-999-a999",{placeholder:" ",completed:function(){alert("You typed the following: "+this.val());}});
			
			
			
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
				
				$('#date-timepicker1').datetimepicker().next().on(ace.click_event, function(){
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
			
			});
		</script>
		<script src="../default/assets/js/jquery.dataTables.min.js"></script>
		<script src="../default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
		
	</body>
</html>
<?php } ?>
<script src="../js/alerta.js"></script>
		<script type="text/javascript">
			mostrarAlertaReco();
		</script>
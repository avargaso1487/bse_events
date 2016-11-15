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
		$link_tarea = "evento.php";
		$titulo = "Evento: II full day de gestión de TI";
	}
	$eventoID = "";
	if(isset($_POST['eventoID'])){
		$eventoID = $_POST['eventoID'];
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
								<div class="Contenedor  widget-box">
									<div class="table-header">
										Datos generales del evento
						      		</div>
							      	<div class="widget-main row">
							      		<div class="col-md-5 form-group">
											<label><strong> Sucursal  </strong></label>
											<select class="form-control input-sm" id="cboSucursal" name="cboSucursal">
												<option value="0">-- Seleccionar --</option>
											</select>
					      				</div>
					      				<div class="col-md-7 form-group">
											<label><strong> Nombre del evento  </strong></label>
											<input type="text" class="form-control input-sm" id="txtNombre" name="txtNombre">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Fecha inicio </strong></label>
											<input class="form-control" id="txtFechaI" name="txtFechaI" type="date">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Fecha fin </strong></label>
											<input class="form-control" id="txtFechaF" name="txtFechaF" type="date">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Duración </strong>(Días)</label>
											<input type="text" class="form-control input-sm" id="txtDuracion" name="txtDuracion">
					      				</div>
					      				<div class="col-md-3 form-group">
											<label><strong> Precio total </strong>(S/.)</label>
											<input type="text" class="form-control input-sm" id="txtPrecioT" name="txtPrecioT">
					      				</div>
					      				<div class="col-md-8 form-group">
											<label><strong> Descripción </strong></label>
											<textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
					      				</div>
					      				<div class="col-md-4 form-group">
											<label><strong> Estado </strong></label>
											<select class="form-control input-sm" id="cboEstado" name="cboEstado">
												<option value="0">-- Seleccionar --</option>
												<option value="A"> Activo </option>
												<option value="I"> Inactivo </option>
											</select>
					      				</div>
							      	</div>
							      	<div class="form-actions center" style="margin-bottom:-0px;">
										<button type="button" class="btn btn-sm btn-success">
											Submit
											<i class="ace-icon fa fa-arrow-right icon-on-right bigger-110"></i>
										</button>
									</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<div class="col-md-12">

								<div class="Contenedor widget-box">
									<div class="table-header">
										Lista de actividades
										&nbsp;&nbsp;
										<a  href="javascript:;" onclick="abrirModalActi();" id="nueva_actividad" class="white">
				                            <i class='ace-icon fa fa-plus-circle bigger-150'></i>
				                        </a>
						      		</div>
							      	<div class="widget-main">
							      		<table id="tabla_eventos" class="table table-striped table-bordered">
											<thead>
									            <tr>
									                <th>Código</th>
									                <th>Actividad</th>
									                <th>Ponente</th>
									                <th>Fecha</th>
									                <th>Hora Inicio - Fin</th>
									                <th>Precio</th>
									                <th>Tipo actividad</th>
									                <th>Estado</th>
									                <th>Ope</th>
									            </tr>
											</thead>
											<tbody id="cuerpo_tabla_eventos">
												<!-- Lista de eventos -->
											</tbody>
										</table>
							      	</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<!-- Contenedor Lista de actividades -->
							<div class="col-md-12">
								<div class="Contenedor widget-box">
									<div class="table-header">
										Lista de asistentes
						      		</div>
							      	<div class="widget-main">
							      		<table id="tabla_eventos" class="table table-striped table-bordered">
											<thead>
									            <tr>
									                <th>Código</th>
									                <th>Actividad</th>
									                <th>Ponente</th>
									                <th>Fecha</th>
									                <th>Hora Inicio - Fin</th>
									                <th>Precio</th>
									                <th>Tipo actividad</th>
									                <th>Estado</th>
									                <th>Ope</th>
									            </tr>
											</thead>
											<tbody id="cuerpo_tabla_eventos">
												<!-- Lista de eventos -->
											</tbody>
										</table>
							      	</div>
								</div>
								<!-- Contenedor Datos generales del evento -->
							</div>
							<!-- Contenedor Lista de asistentes -->
						</div>




					</div>
					<!-- /.page-content -->							
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
				<!-- footer -->
				<div class="modal fade" id="modalActividad" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog" style="width: 60% !important;">
                      <div class="modal-content">
                        <div class="modal-header">
                          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                          <h4 class="modal-title text-center" id="cabeceraRegistro"><b>Actividad</b></h4>
                        </div>
                        <div class="modal-body">
                       <form action="" method="POST" class="form-horizontal" id="from_actividad"> 
                       		<div id="mensaje"></div>
                            <form role="form" id="frmRegistroEgresados" class="form-horizontal" method="POST">
		                        <div class="row">
		                        	<div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Tipo actividad</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboTipoActividad" name="cboTipoActividad">
		                                   		<option value="0">-- Seleccionar --</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Actividad</label>
		                               <div class="col-md-7">
		                                   <input class="form-control" id="txtActividad" name="txtActividad" type="text" autofocus="">
		                               </div>		                                                  
		                            </div>	
		                            <div class="form-group">
		                               <label class="col-md-2 col-md-offset-1 control-label">Ponente</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboPonente" name="cboPonente">
		                                   		<option value="0">-- Seleccionar --</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Ambiente</label>
		                               <div class="col-md-7">
		                                   <select class="form-control input-sm" id="cboAmbiente" name="cboAmbiente">
		                                   		<option value="0">-- Seleccionar --</option>
		                                   </select>
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Fecha</label>
		                               <div class="col-md-4">
		                                   <input class="form-control" id="txtFecha" name="txtFecha" type="date">
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2   col-md-offset-1  control-label">Hora Inicio / Fin </label>
		                               <div class="col-md-2">
		                                   <input class="form-control" id="txtHoraI" name="txtHoraI" type="text" >
		                               </div>
		                                <div class="col-md-2">
		                                   <input class="form-control" id="txtHoraI" name="txtHoraI" type="text" >
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Precio</label>
		                               <div class="col-md-4">
		                                   <input class="form-control" id="txtPrecio" name="txtPrecio" type="text">
		                               </div>
		                            </div>
		                            <div class="form-group">
		                               <label class="col-md-2  col-md-offset-1  control-label">Descripción</label>
		                               <div class="col-md-7">
		                                   <textarea class="form-control" id="txtDescripcion" name="txtDescripcion"></textarea>
		                               </div>
		                            </div>
		                            
			                        <div class="modal-footer">
			                            <button type="button" class="btn btn-primary" id="cancel_sucursal">Cancelar</button> 
			                            <button type="button" class="btn btn-primary" id="register_sucursal" onclick="guardar_actividad();"> Registrar </button>
			                        </div>
		                    </form>
                        </form>
                        </div>
                      </div>
                    </div>
                </div>
                <!-- Modal -->
				<input type="hidden" dissabled="true" value="<?= $grupo  ?>" id="NombreGrupo">
                <input type="hidden" dissabled="true" value="<?= $tarea  ?>" id="NombreTarea">
				<!-- FIN DE CONTENIDO DE PAGINA -->

			<a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
				<i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
			</a>
		</div><!-- /.main-container -->
	</body>
</html>

<?php require('footer.php') ?>

<script type="text/javascript">
function guardar_actividad(){
	var opcion = 1;
	if($.trim($('#txtActividad').val()).length==0){
		$('#txtActividad').parent().addClass('has-error');
	}else{
		$('#txtActividad').parent().removeClass('has-error');
	}
	if($.trim($('#txtFechaI').val()).length==0){
		$('#txtFechaI').parent().addClass('has-error');
	}else{
		$('#txtFechaI').parent().removeClass('has-error');
	}

    if(document.getElementsByClassName("has-error").length > 0){
      alert("Verifique los datos ingresados");
      return false;
    }
    var formData = new FormData($('#from_actividad')[0]);
    formData.append("opcion",opcion);
    $.ajax({
      url: '../../controller/controlEvento/evento_controller.php',
      type: "post",
      dataType: "html",
      data: formData,
      cache: false,
      contentType: false,
      processData: false,
      success: function(rpta){
        if(rpta == 1){
        	alert("Registro exitoso");
        }else{
        	alert("No se pudo registrar el evento");
        }
      },
      error: function(rpta){
        alert("Error en el registro del protocolo: \n"+rpta);
      }
    });
}
function cargardatos(){
	cargar_datos_generales();
}
function cargar_datos_generales(){ 
  	var opcion = 2;
  	$.ajax({
      	type: 'POST',        
      	data:'opcion='+opcion+'&txtEventoID='+'<?= $eventoID; ?>',
      	url: '../../controller/controlEvento/evento_controller.php',
      	success: function(data){
      		var obj = JSON.parse(data);

      		$('#txtNombre').val(obj.evento[0].Even_nombre);
      		$('#txtFechaI').val(obj.evento[0].Even_fechaInicio);
      		$('#txtFechaF').val(obj.evento[0].Even_fechaFin);
      		$('#txtDuracion').val(obj.evento[0].Even_duracion);
      		$('#txtPrecioT').val(obj.evento[0].Even_precioTotal);
      		$('#txtDescripcion').val(obj.evento[0].Even_descripcion);
      		$('#cboEstado').val(obj.evento[0].Even_estado);
      	},
      	error: function(data){
                 
      	}
  	});
}
function abrirModalActi() {
	$('#modalActividad').modal({
        show:true,
        backdrop:'static',
    });  
}
</script>
<script type="text/javascript">
	<?php if (isset($_POST['eventoID'])): ?>
		cargardatos();
	<?php endif ?>
</script>
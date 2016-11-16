<?php
session_start();
if(!isset($_SESSION['usuario']))
{
    header("Location:../../index.php");
}
else
{
    date_default_timezone_set('America/Lima');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8" />
    <title>Mantenedores - Participantes</title>

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
                    <li><a href="participante_view.php">Participantes</a></li>
                    <li>
                        <span class="invoice-info-label">Fecha:</span>
                        <span class="blue"><?php echo date('d-m-Y'); ?></span>
                    </li>

                </ul><!-- /.breadcrumb -->
            </div>

            <div class="page-content">
                <div class="page-header">
                    <h1>
                        Participantes Registrados
                    </h1>
                </div><!-- /.page-header -->
                <div class="row">
                    <div class="col-md-12">
                        <div id="mensaje2"></div>
                        <div class="table-header">
                            PARTICIPANTES REGISTRADOS &nbsp;&nbsp;
                            <a  href="#" id="btn_nuevo_participante" class="white">
                                <i class='ace-icon fa fa-plus-circle bigger-150'></i>
                            </a>
                        </div>
                        <div>
                            <table id="tablaParticipantes" class="table table-striped table-bordered">
                                <thead>
                                <tr>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 5%;">N°</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 20%;">APELLIDOS Y NOMBRES</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">DOCUMENTO</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">NIVEL</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 12%;">C. PROFESIONAL</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 17%;">EMAIL</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 10%;">ESTADO</th>
                                    <th style="text-align: center; font-size: 11px; height: 10px; width: 8%;">OPERACIONES</th>
                                </tr>
                                </thead>
                                <tbody id="cuerpoParticipantes">

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <input type="hidden" dissabled="true" value="Mantenedores" id="NombreGrupo">
                    <input type="hidden" dissabled="true" value="Participantes" id="NombreTarea">
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
            <div class="modal-dialog" style="width: 78% !important;">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title text-center" id="cabeceraRegistro"><b></b></h4>
                    </div>
                    <div class="modal-body">
                        <div id="mensaje"></div>
                        <form role="form" class="form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nombres*</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="nombre_participante" name="nombre_participante" placeholder="Ingrese el nombre completo" onkeypress="return soloLetras(event)">
                                        </div>
                                        <label class="col-md-1 control-label">Apellidos*</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="apellido_participante" name="apellido_participante" placeholder="Ingrese los apellidos" onkeypress="return soloLetras(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">D.N.I.*</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="dni_participante" name="dni_participante" placeholder="Ingrese el número de DNI" onkeypress="return solonumeros(event)" maxlength="8">
                                        </div>
                                        <label class="col-md-1 control-label">Dirección</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="direccion_participante" name="direccion_participante" placeholder="Ingrese la dirección">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Fecha Nacimiento *</label>
                                        <div class="col-md-4">
                                            <input type="date" class="form-control" id="fechaNacimiento_participante" name="fechaNacimiento_participante">
                                        </div>
                                        <label class="col-md-1 control-label">Teléfono</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="ace-icon fa fa-phone"></i>
                                                </span>
                                                <input type="text" class="form-control" id="telefonoFijo_participante" name="telefonoFijo_participante" placeholder="EJM: (044) - 123456">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Celular</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="ace-icon fa fa-phone"></i>
                                                </span>
                                                <input type="text" class="form-control" id="telefonoMovil_participante" name="telefonoMovil_participante" placeholder="EJM: 999555999">
                                            </div>
                                        </div>
                                        <label class="col-md-1 control-label">Email *</label>
                                        <div class="col-md-4">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="ace-icon fa fa-envelope"></i>
                                                </span>
                                                <input type="text" class="form-control" id="email_participante" name="email_participante" placeholder="Ingrese su correo electrónico" onKeyUp="javascript:validateMail('email_participante')">

                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Nivel *</label>
                                        <div class="col-md-3">
                                            <select class="form-control" id="nivel_participante" name="nivel_participante">
                                                <option value="">Seleccione...</option>
                                                <option value="estudiante">ESTUDIANTE</option>
                                                <option value="egresado">EGRESADO</option>
                                                <option value="profesional">PROFESIONAL</option>
                                            </select>
                                        </div>
                                        <label class="col-md-2 control-label">Carrera Profesional *</label>
                                        <div class="col-md-4">
                                            <input type="text" class="form-control" id="profesion_participante" name="profesion_participante" placeholder="Ingrese la carrera profesional" onkeypress="return soloLetras(event)">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-2 control-label">Centro de Trabajo</label>
                                        <div class="col-md-9">
                                            <input type="text" class="form-control" id="centroTrabajo_participante" name="centroTrabajo_participante" placeholder="Ingrese el centro de trabajo">
                                        </div>
                                    </div>
                                </div>
                                <input  type="hidden" id="operacion" name="operacion" value="Registrar"/>
                                <input  type="hidden" id="codigo" name="codigo"/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <span style="font-size:12px;">(*) Campos obligatorios.</span>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" id="btn_cancelar_participante" class="btn dark btn-outline" data-dismiss="modal">Cancelar</button>
                        <button type="button" id="btn_registrar_participante" class="btn btn-primary">Registrar</button>
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

<script src="../default/js/participante.js"></script>

<!-- inline scripts related to this page -->
</body>
</html>
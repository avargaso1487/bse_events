
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
		
	    <script src="../default/assets/js/jquery.dataTables.min.js"></script>
	    <script src="../default/assets/js/jquery.dataTables.bootstrap.min.js"></script>
	    <script src="../default/assets/js/jquery.maskedinput.min.js"></script>
	    <script src="../default/assets/js/jquery.autosize.min.js"></script>
	    <script src="../default/assets/js/jquery.inputlimiter.1.3.1.min.js"></script>
	    
		<script src="../../view/js/plugins/timepicker/bootstrap-timepicker.min.js"></script>
		<!-- page specific plugin scripts -->
		<!-- ace scripts -->
		<script src="../default/assets/js/ace-elements.min.js"></script>
		<script src="../default/assets/js/ace.min.js"></script>
		

	<script type="text/javascript">
		function mostrarMenu()
		{    
		    var grupo = document.getElementById('NombreGrupo').value;
		    var tarea = document.getElementById('NombreTarea').value;
		    //alert(grupo);
		    $.ajax({
		        type:'POST',
		        data: 'opcion=mostrarMenu&grupo='+grupo+'&tarea='+tarea,        
		        url: "../../controller/controlusuario/usuario.php",
		        success:function(data){
		            $('#permisos').html(data);
		        }
		    });
		    //alert("kjb");
		}
	</script>
	<script type="text/javascript">mostrarMenu();</script>
	<script src="../default/js/scriptEvento.js"></script>

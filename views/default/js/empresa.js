function info_sucursal(){	
	$.ajax({		
		type:'POST',
		data: {param_opcion:'listar'},
		url: "../controller/controlsucursal/sucursal.php",
		success:function(data){
			$('#info_sucursal').html(data);			
		}
	});
}
info_sucursal();
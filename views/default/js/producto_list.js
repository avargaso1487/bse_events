window.onload = function(){
	mostrarDatos();
	$('#dataTables-example').DataTable(); 

};


function mostrarDatos(){
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success: function(respuesta)
		{
			$('#dataTables-example').DataTable().destroy();
			$('#cuerpoTabla').html(respuesta);
			$('#dataTables-example').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
};
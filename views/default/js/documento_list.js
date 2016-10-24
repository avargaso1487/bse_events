window.onload = function(){
	mostrarDatos();
	$('#dataTables-example').DataTable(); 

};


function mostrarDatos(){
	var param_opcion = "mostrarDocumento";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url:"../controller/controldocumento/documento.php",
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


function mostrar(serie, numero)
{
	alert(serie+' - '+numero);
}
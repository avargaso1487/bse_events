window.onload = function(){
	mostrarDatos();
	$('#dataTables-example').DataTable(); 


	$('#registroGama').on('click', function(){verificar();});

	$('#nuevaGama').on('click', function(){
  		limpiar();
  		$('#param_gamaDescripcion').parent().parent().attr("class", "form-group col-md-8 col-md-offset-2 ");              		
		$('#exito').hide();
		$('#error').hide();
  	});
};


function mostrarDatos(){
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url: '../controller/controlproducto/gama.php',
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


function limpiar(){
	document.getElementById('param_gamaDescripcion').value="";
}


function verificar()
{
	var v1=0;
	v1 = validacion('param_gamaDescripcion');		

	if(v1===false)
	{		
		$("#exito").hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',			
			data: $('#form_registro_gama').serialize(),
			url: '../controller/controlproducto/gama.php',
			success: function(data)
			{				
				limpiar();
				$("#error").hide();								
				$("#exito").html('<p>La gama ha sido registrado de forma exitosa.</p>').show(500).delay(8500).hide(500);                
				mostrarDatos();
			}
		});
	}

}



function validacion(campo)
{
	var a=0;
	if(campo === 'param_gamaDescripcion')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 col-md-offset-2 has-error");
            return false;
		}		
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 col-md-offset-2 has-success");            
			return true;
		}
	}	
}

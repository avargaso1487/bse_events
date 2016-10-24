window.onload = function(){
	mostrarDatos();
	$('#dataTables-example').DataTable(); 


	$('#registroMedida').on('click', function(){verificar();});

	$('#nuevaMedida').on('click', function(){
  		limpiar();
  		$('#param_medidaDescripcion').parent().parent().attr("class", "form-group col-md-8 col-md-offset-2 ");              		
		$('#exito').hide();
		$('#error').hide();
  	});
};


function mostrarDatos(){
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url: '../controller/controlproducto/medidas.php',
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
	document.getElementById('param_medidaDescripcion').value="";
}


function verificar()
{
	var v1=0;
	v1 = validacion('param_medidaDescripcion');		

	if(v1===false)
	{		
		$("#exito").hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(2000).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',			
			data: $('#form_registro_medida').serialize(),
			url: '../controller/controlproducto/medidas.php',
			success: function(data)
			{				
				limpiar();
				$("#error").hide();								
				$("#exito").html('<p>La medida ha sido registrada de forma exitosa.</p>').show(500).delay(2000).hide(500);                
				mostrarDatos();
			}
		});
	}

}



function validacion(campo)
{
	var a=0;
	if(campo === 'param_medidaDescripcion')
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

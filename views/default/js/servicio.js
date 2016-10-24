window.onload = function()
{
	mostrarDatos();
	$('#dataTables-example').DataTable(); 

	$('#registroServicio').on('click', function(){verificar();});


	$('#nuevoServicio').on('click', function(){limpiar();});

  	cargarSucursal();
};


function mostrarDatos()
{
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url: '../controller/controlservicio/servicio.php',
		success: function(respuesta)
		{
			$('#dataTables-example').DataTable().destroy();
			$('#cuerpoTabla').html(respuesta);
			$('#dataTables-example').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR");
		}
	});
};

function limpiar()
{
	document.getElementById('param_servDescripcion').value="";
	document.getElementById('param_servPrecioBase').vallue="";
	document.getElementById('param_servCodigo')	.value="";
	document.getElementById('param_personSucursal')	.value="";
}

function cargarSucursal()
{
	var param_opcion = "comboSucursal";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlpersonal/personal.php",
		success:function(respuesta)
		{			
			$('#sucursal').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}



function verificar()
{
	var v1=0; var v2=0; var v3=0; var v4=0;
	v1 = validacion('param_servDescripcion');
	v2 = validacion('param_servCodigo');
	v3 = validacion('param_personSucursal');
	v4 = validacion('param_servPrecioBase');

	if (v1 === false||v2===false||v3===false||v4===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',
			data: $('#form_registro_servicio').serialize(),
			url: '../controller/controlservicio/servicio.php',
			success: function(data)
			{
				limpiar();
				$("#error").hide();
                $("#exito").html('<p>El cliente ha sido registrado de forma exitosa.</p>').show(500).delay(8500).hide(500);
			}
		});
	}
}



function validacion(campo)
{
	var a=0;
	if(campo === 'param_servDescripcion')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-error");            
            return false;
		}		
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-success");            
			return true;
		}
	}

	if(campo === 'param_servCodigo')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-error");            
            return false;
		}		
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-success");            
			return true;
		}
	}

	if(campo === 'param_personSucursal')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-error");            
            return false;
		}		
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-success");            
			return true;
		}
	}

	if(campo === 'param_servPrecioBase')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-error");            
            return false;
		}		
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-12 has-success");            
			return true;
		}
	}
}
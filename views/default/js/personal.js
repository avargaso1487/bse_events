window.onload = function()
{
	cargarSucursal();
	$('#registroPersonal').on('click', function(){verificar();});
};


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
	var v1=0; v2=0; v3=0; v4=0; v5=0; v6=0;
	v1 = validacion('param_personDNI');
	v2 = validacion('param_personNombre');
	v3 = validacion('param_personApellidoPaterno');
	v4 = validacion('param_personApellidoMaterno');
	v5 = validacion('param_personDireccion');
	v6 = validacion('param_personSucursal');

	if(v1===false||v2===false||v3===false||v4===false||v5===false||v6===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',
			data: $('#form_registro_personal').serialize(),
			url: '../controller/controlpersonal/personal.php',
			success: function(data)
			{
				limpiarFormulario();
				$("#exito").hide();
                $("#exito").html('<p>El colaborador ha sido registrado correctamente. Por Favor Inicie Sesión</p>').show();
			}
		});
	}

}



function validacion(campo)
{
	var a=0;
	if(campo === 'param_personDNI')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
			return true;
		}
	}


	if(campo === 'param_personNombre')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
			return true;
		}
	}


	if(campo === 'param_personApellidoPaterno')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
		}
		else 
		{			
			
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
			return true;
		}
	}


	if(campo === 'param_personApellidoMaterno')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{			
			
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
			return true;
		}
	}


	if(campo === 'param_personDireccion')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-success");            
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
}


function limpiarFormulario()
{
	document.getElementById('param_personDNI').value="";
	document.getElementById('param_personNombre').value="";
	document.getElementById('param_personApellidoPaterno').value="";
	document.getElementById('param_personApellidoMaterno').value="";
	document.getElementById('param_personDireccion').value="";
	document.getElementById('param_personFijo').value="";
	document.getElementById('param_personCelular').value="";
	document.getElementById('param_personCorreo').value="";
	document.getElementById('param_personFeNacimiento').value="";
	document.getElementById('param_personFeIngreso').value="";
	document.getElementById('param_personLugarNacimiento').value="";
	document.getElementById('param_personSucursal').value="";	
}
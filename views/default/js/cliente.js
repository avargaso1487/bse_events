window.onload = function()
{	
	$('#registroCliente').on('click', function(){verificar();});
};

function verificar()
{
	var v1=0; v2=0; v3=0; v4=0; v5=0; v6=0;
	v1 = validacion('param_cliDNI');
	v2 = validacion('param_cliNombre');
	v3 = validacion('param_cliApellidoPaterno');
	v4 = validacion('param_cliApellidoMaterno');
	v5 = validacion('param_cliCorreo');

	var codigo = document.getElementById('param_clienteCodigo').value();

	if(v1===false||v2===false||v3===false||v4===false||v5===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',
			data: $('#form_registro_cliente').serialize(),
			url: '../controller/controlcliente/cliente.php',
			success: function(data)
			{
				limpiarFormulario();
				$("#error").hide();
                $("#exito").html('<p>Los datos del cliente han sido actualizados de forma exitosa.</p>').show(500).delay(8500).hide(500);
			}
		});
	}

}



function validacion(campo)
{
	var a=0;
	if(campo === 'param_cliDNI')
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


	if(campo === 'param_cliNombre')
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


	if(campo === 'param_cliApellidoPaterno')
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


	if(campo === 'param_cliApellidoMaterno')
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


	if(campo === 'param_cliCorreo')
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
	document.getElementById('param_cliDNI').value="";
	document.getElementById('param_cliNombre').value="";
	document.getElementById('param_cliApellidoPaterno').value="";
	document.getElementById('param_cliApellidoMaterno').value="";
	document.getElementById('param_cliDireccion').value="";
	document.getElementById('param_cliFijo').value="";
	document.getElementById('param_cliCelular').value="";
	document.getElementById('param_cliCorreo').value="";
	document.getElementById('param_cliFeNacimiento').value="";
	document.getElementById('param_cliFeAniversario').value="";
	document.getElementById('param_cliLugarNacimiento').value="";
	document.getElementById('param_cliMotivoAniversario').value="";	
}
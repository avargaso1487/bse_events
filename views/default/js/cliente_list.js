window.onload = function(){
	mostrarDatos();
	$('#dataTables-example').DataTable(); 

};


function mostrarDatos(){
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url:"../controller/controlcliente/cliente.php",
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


function eliminar(codigo, valor)
{	
	var param_opcion = "eliminar";	
	var nuevoTipo = "";
	if (valor===1)		
		nuevoTipo = "Activo";
	else
		if(valor===0)
			nuevoTipo = "Pasivo";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion+'&param_clienteCodigo='+codigo+'&param_clienteTipo='+nuevoTipo,
		url: '../controller/controlcliente/cliente_edit.php',
		success: function(respuesta)
		{			
			//window.location="cliente_list.php";
			mostrarDatos();
		},
		error: function(respuesta)
		{
			alert("ERROR AL ELIMINAR EL REGISTRO");
		}
	});
}


function mostrar(codigo)
{	
	limpiar();
	deshabilitar(true);
	var param_opcion = "mostrarDetalle";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_clienteCodigo='+codigo,
		url: '../controller/controlcliente/cliente_edit.php',
		//dataType: "json",
		success: function(datos)
		{			
			objeto = JSON.parse(datos);
						
			document.getElementById('param_clienteCodigo').value = objeto[0];
			document.getElementById('param_clienteDNI').value = (objeto[1]);
			document.getElementById('param_clienteNombres').value = objeto[2];
			document.getElementById('param_clienteApellidoPaterno').value = objeto[3];
			document.getElementById('param_clienteApellidoMaterno').value = objeto[4];
			document.getElementById('param_clienteDireccion').value = objeto[5];
			document.getElementById('param_clienteTelefonoFijo').value = objeto[7];
			document.getElementById('param_clienteTelefonoCelular').value = objeto[8];
			document.getElementById('param_clienteCorreo').value = objeto[6];
			document.getElementById('param_clienteNacimiento').value = objeto[9];
			document.getElementById('param_clienteTipo').value = objeto[10];
			document.getElementById('param_clienteFechaAniversario').value = objeto[11];
			document.getElementById('param_clienteMotivo').value = objeto[12];			
		},
		error: function(data)
		{
			alert('ERROR AL OBTENER LOS DATOS');
		}
	});
}


function limpiar()
{
	$('#exito').hide();
	$('#error').hide();

	$('#param_clienteDNI').parent().parent().attr("class", "form-group col-md-5");
	$('#param_clienteNombres').parent().parent().attr("class", "form-group col-md-7");
	$('#param_clienteApellidoPaterno').parent().parent().attr("class", "form-group col-md-5");
	$('#param_clienteApellidoMaterno').parent().parent().attr("class", "form-group col-md-5");
	$('#param_clienteDireccion').parent().parent().attr("class", "form-group col-md-12");
	$('#param_clienteTelefonoFijo').parent().parent().attr("class", "form-group col-md-4");
	$('#param_clienteTelefonoCelular').parent().parent().attr("class", "form-group col-md-4");
	$('#param_clienteCorreo').parent().parent().attr("class", "form-group col-md-12");
	$('#param_clienteNacimiento').parent().parent().attr("class", "form-group col-md-12");
	$('#param_clienteTipo').parent().parent().attr("class", "form-group col-md-4");
	$('#param_clienteFechaAniversario').parent().parent().attr("class", "form-group col-md-4");
	$('#param_clienteMotivo').parent().parent().attr("class", "form-group col-md-8");	


	document.getElementById('param_clienteCodigo').value = "";
	document.getElementById('param_clienteDNI').value = "";
	document.getElementById('param_clienteNombres').value = "";
	document.getElementById('param_clienteApellidoPaterno').value = "";
	document.getElementById('param_clienteApellidoMaterno').value = "";
	document.getElementById('param_clienteDireccion').value = "";
	document.getElementById('param_clienteTelefonoFijo').value = "";
	document.getElementById('param_clienteTelefonoCelular').value = "";
	document.getElementById('param_clienteCorreo').value = "";
	document.getElementById('param_clienteNacimiento').value = "";
	document.getElementById('param_clienteTipo').value = "";
	document.getElementById('param_clienteFechaAniversario').value = "";
	document.getElementById('param_clienteMotivo').value = "";	
}


function edit(codigo)
{
	limpiar();
	deshabilitar(false);
	var param_opcion = "mostrarDetalle";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_clienteCodigo='+codigo,
		url: '../controller/controlcliente/cliente_edit.php',
		//dataType: "json",
		success: function(datos)
		{			
			objeto = JSON.parse(datos);
						
			document.getElementById('param_clienteCodigo').value = objeto[0];
			document.getElementById('param_clienteDNI').value = (objeto[1]);
			document.getElementById('param_clienteNombres').value = objeto[2];
			document.getElementById('param_clienteApellidoPaterno').value = objeto[3];
			document.getElementById('param_clienteApellidoMaterno').value = objeto[4];
			document.getElementById('param_clienteDireccion').value = objeto[5];
			document.getElementById('param_clienteTelefonoFijo').value = objeto[7];
			document.getElementById('param_clienteTelefonoCelular').value = objeto[8];
			document.getElementById('param_clienteCorreo').value = objeto[6];
			document.getElementById('param_clienteNacimiento').value = objeto[9];
			document.getElementById('param_clienteTipo').value = objeto[10];
			document.getElementById('param_clienteFechaAniversario').value = objeto[11];
			document.getElementById('param_clienteMotivo').value = objeto[12];		
		},
		error: function(data)
		{
			alert('ERROR AL OBTENER LOS DATOS');
		}
	});
		
	$('#editarCliente').on('click', function(){editCliente();});
}

function deshabilitar(estado)
{	
	if (estado==false)
	{
		document.getElementById('cancelar').style.display = 'inline';
		document.getElementById('editarCliente').style.display = 'inline';
	}
	else
	{
		document.getElementById('cancelar').style.display = 'none';
		document.getElementById('editarCliente').style.display = 'none';
	}
	
	document.getElementById('param_clienteDNI').disabled = estado;
	document.getElementById('param_clienteNombres').disabled = estado;
	document.getElementById('param_clienteApellidoPaterno').disabled = estado;
	document.getElementById('param_clienteApellidoMaterno').disabled = estado;
	document.getElementById('param_clienteDireccion').disabled = estado;
	document.getElementById('param_clienteTelefonoFijo').disabled = estado;
	document.getElementById('param_clienteTelefonoCelular').disabled = estado;
	document.getElementById('param_clienteCorreo').disabled = estado;
	document.getElementById('param_clienteNacimiento').disabled = estado;
	document.getElementById('param_clienteTipo').disabled = estado;
	document.getElementById('param_clienteFechaAniversario').disabled = estado;
	document.getElementById('param_clienteMotivo').disabled = estado;	
}



function editCliente()
{
	var v1=0; var v2=0; var v3=0; var v4=0; var v5=0; var v6=0; var v7=0; var v8=0; var v9=0; var v10=0; var v11=0; var v12=0;
			
	v1 = validacion('param_clienteDNI');
	v2 = validacion('param_clienteNombres');
	v3 = validacion('param_clienteApellidoPaterno');
	v4 = validacion('param_clienteApellidoMaterno');
	v5 = validacion('param_clienteDireccion');
	v6 = validacion('param_clienteTelefonoFijo');
	v7 = validacion('param_clienteTelefonoCelular');
	v8 = validacion('param_clienteCorreo');
	v9 = validacion('param_clienteNacimiento');
	v10 = validacion('param_clienteTipo');
	v11 = validacion('param_clienteFechaAniversario');
	v12 = validacion('param_clienteMotivo');
	

	if(v1===false||v2===false||v3===false||v4===false||v5===false||v6===false||v7===false||v8===false||v9===false||v10===false||v11===false||v12===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{		
		$.ajax({
			type: 'POST',
			data: $('#form_edit_cliente').serialize(),
			url: '../controller/controlcliente/cliente_edit.php',
			success: function(data)
			{
				//limpiar();
				deshabilitar(true);
				$("#error").hide();
                $("#exito").html('<p>El cliente ha sido registrado de forma exitosa.</p>').show(500).delay(8500).hide(500);
                mostrarDatos();
			}
		});
	}
	//alert("lkjb");
}

function validacion(campo)
{
	var a=0;
	if(campo === 'param_clienteDNI')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-error");            
            return false;
		}
		else 
		{			
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-success");            
			return true;
		}
	}


	if(campo === 'param_clienteNombres')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-7 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-7 has-success");            
			return true;
		}
	}


	if(campo === 'param_clienteApellidoPaterno')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-error");            
            return false;
		}
		else 
		{			
			
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-success");            
			return true;
		}
	}


	if(campo === 'param_clienteApellidoMaterno')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{			
			
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-5 has-success");            
			return true;
		}
	}


	if(campo === 'param_clienteDireccion')
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

	if(campo === 'param_clienteTelefonoFijo')
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

	if(campo === 'param_clienteTelefonoCelular')
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

	if(campo === 'param_clienteCorreo')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 has-success");            
			return true;
		}
	}	

	if(campo === 'param_clienteNacimiento')
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

	if(campo === 'param_clienteTipo')
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

	if(campo === 'param_clienteFechaAniversario')
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

	if(campo === 'param_clienteMotivo')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().parent().attr("class", "form-group col-md-8 has-success");            
			return true;
		}
	}	
}
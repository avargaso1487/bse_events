window.onload = function(){
	cargarSucursal();
	mostrarDatos();
	$('#example').DataTable({responsive:true}); 

};


function mostrarDatos(){
	var param_opcion = "mostrar";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url:"../controller/controlpersonal/personal.php",
		success: function(respuesta)
		{
			$('#example').DataTable().destroy();
			$('#cuerpoTabla').html(respuesta);
			$('#example').DataTable();
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

	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion+'&param_personalCodigo='+codigo+'&param_personalEstado='+valor,
		url: '../controller/controlpersonal/personal_edit.php',
		success: function(respuesta)
		{			
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
		data: 'param_opcion='+param_opcion+'&param_personalCodigo='+codigo,
		url: '../controller/controlpersonal/personal_edit.php',
		//dataType: "json",
		success: function(datos)
		{
			objeto = JSON.parse(datos);
						
			document.getElementById('param_personalCodigo').value = objeto[0];
			document.getElementById('param_personSucursal').value = (objeto[1]);
			document.getElementById('param_personalDNI').value = objeto[2];
			document.getElementById('param_personalNombres').value = objeto[3];
			document.getElementById('param_personalApellidoPaterno').value = objeto[4];
			document.getElementById('param_personalApellidoMaterno').value = objeto[5];
			document.getElementById('param_personalDireccion').value = objeto[6];
			document.getElementById('param_personalCorreo').value = objeto[7];
			document.getElementById('param_personalTelefonoFijo').value = objeto[8];
			document.getElementById('param_personalTelefonoCelular').value = objeto[9];
			document.getElementById('param_personalNacimiento').value = objeto[10];
			document.getElementById('param_personalLugarNacimiento').value = objeto[11];
			document.getElementById('param_personalIngreso').value = objeto[12];
			document.getElementById('param_personalEstado').value = objeto[13];			
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

	$('#param_personalDNI').parent().parent().attr("class", "form-group col-md-5");
	$('#param_personalNombres').parent().parent().attr("class", "form-group col-md-7");
	$('#param_personalApellidoPaterno').parent().parent().attr("class", "form-group col-md-5");
	$('#param_personalApellidoMaterno').parent().parent().attr("class", "form-group col-md-5");
	$('#param_personSucursal').parent().parent().attr("class", "form-group col-md-12");
	$('#param_personalDireccion').parent().parent().attr("class", "form-group col-md-12");
	$('#param_personalTelefonoFijo').parent().parent().attr("class", "form-group col-md-4");
	$('#param_personalTelefonoCelular').parent().parent().attr("class", "form-group col-md-4");
	$('#param_personalCorreo').parent().parent().attr("class", "form-group col-md-12");
	$('#param_personalNacimiento').parent().parent().attr("class", "form-group col-md-4");
	$('#param_personalEstado').parent().parent().attr("class", "form-group col-md-4");
	$('#param_personalLugarNacimiento').parent().parent().attr("class", "form-group col-md-4");
	$('#param_personalIngreso').parent().parent().attr("class", "form-group col-md-4");
	

	document.getElementById('param_personalCodigo').value = "";
	document.getElementById('param_personalDNI').value = "";
	document.getElementById('param_personalNombres').value = "";
	document.getElementById('param_personalApellidoPaterno').value = "";
	document.getElementById('param_personalApellidoMaterno').value = "";
	document.getElementById('param_personSucursal').value = "";
	document.getElementById('param_personalDireccion').value = "";
	document.getElementById('param_personalCorreo').value = "";
	document.getElementById('param_personalTelefonoFijo').value = "";
	document.getElementById('param_personalTelefonoCelular').value = "";
	document.getElementById('param_personalNacimiento').value = "";
	document.getElementById('param_personalLugarNacimiento').value = "";
	document.getElementById('param_personalIngreso').value = "";
	document.getElementById('param_personalEstado').value = "";			
}


function deshabilitar(estado)
{	
	if (estado==false)
	{
		document.getElementById('cancelar').style.display = 'inline';
		document.getElementById('editarPersonal').style.display = 'inline';
	}
	else
	{
		document.getElementById('cancelar').style.display = 'none';
		document.getElementById('editarPersonal').style.display = 'none';
	}
	
	document.getElementById('param_personalDNI').disabled = estado;
	document.getElementById('param_personalNombres').disabled = estado;
	document.getElementById('param_personalApellidoPaterno').disabled = estado;
	document.getElementById('param_personalApellidoMaterno').disabled = estado;
	document.getElementById('param_personSucursal').disabled = estado;
	document.getElementById('param_personalDireccion').disabled = estado;
	document.getElementById('param_personalCorreo').disabled = estado;
	document.getElementById('param_personalTelefonoFijo').disabled = estado;
	document.getElementById('param_personalTelefonoCelular').disabled = estado;
	document.getElementById('param_personalNacimiento').disabled = estado;
	document.getElementById('param_personalLugarNacimiento').disabled = estado;
	document.getElementById('param_personalIngreso').disabled = estado;	
	document.getElementById('param_personalEstado').disabled = estado;		
}


function edit(codigo)
{
	limpiar();	
	
	deshabilitar(false);
	var param_opcion = "mostrarDetalle";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_personalCodigo='+codigo,
		url: '../controller/controlpersonal/personal_edit.php',
		//dataType: "json",
		success: function(datos)
		{
			objeto = JSON.parse(datos);
						
			document.getElementById('param_personalCodigo').value = objeto[0];
			document.getElementById('param_personSucursal').value = (objeto[1]);
			document.getElementById('param_personalDNI').value = objeto[2];
			document.getElementById('param_personalNombres').value = objeto[3];
			document.getElementById('param_personalApellidoPaterno').value = objeto[4];
			document.getElementById('param_personalApellidoMaterno').value = objeto[5];
			document.getElementById('param_personalDireccion').value = objeto[6];
			document.getElementById('param_personalCorreo').value = objeto[7];
			document.getElementById('param_personalTelefonoFijo').value = objeto[8];
			document.getElementById('param_personalTelefonoCelular').value = objeto[9];
			document.getElementById('param_personalNacimiento').value = objeto[10];
			document.getElementById('param_personalLugarNacimiento').value = objeto[11];
			document.getElementById('param_personalIngreso').value = objeto[12];
			document.getElementById('param_personalEstado').value = objeto[13];			
		},
		error: function(data)
		{
			alert('ERROR AL OBTENER LOS DATOS');
		}
	});
		
	$('#editarPersonal').on('click', function(){editarPersonal();});
}

function editarPersonal()
{
	var v1=0; var v2=0; var v3=0; var v4=0; var v5=0; var v6=0; var v7=0; var v8=0; var v9=0; var v10=0; var v11=0; var v12=0; var v13=0;
	
	v1 = validacion('param_personalDNI');
	v2 = validacion('param_personalNombres');
	v3 = validacion('param_personalApellidoPaterno');
	v4 = validacion('param_personalApellidoMaterno');
	v6 = validacion('param_personalDireccion');
	v5 = validacion('param_personSucursal');
	
	

	if(v1===false||v2===false||v3===false||v4===false||v5===false||v6===false||v7===false||v8===false||v9===false||v10===false||v11===false||v12===false||v13===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	
	/*deshabilitar(true);
	$("#error").hide();
	$("#exito").html('<p>El cliente ha sido registrado de forma exitosa.</p>').show(500).delay(8500).hide(500);
    */
    
	else
	{		
		$.ajax({
			type: 'POST',
			data: $('#form_edit_personal').serialize(),
			url: '../controller/controlpersonal/personal_edit.php',
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
	if(campo === 'param_personalDNI')
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


	if(campo === 'param_personalNombres')
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


	if(campo === 'param_personalApellidoPaterno')
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


	if(campo === 'param_personalApellidoMaterno')
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

	if(campo === 'param_personalDireccion')
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

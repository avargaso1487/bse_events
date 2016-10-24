window.onload = function()
{
	cargarLinea();
	cargarMarca();
	cargarSucursal();
	cargarMedida();
	cargarPresentacion();
	cargarGama();
	$('#registroProducto').on('click', function(){verificar();});
};

function verificar()
{
	var v1=0; v2=0; v3=0; v4=0; v5=0; v6=0; v7=0; v8=0; v9=0;
	v1 = validacion('param_prodCodigoInterno');
	v2 = validacion('param_prodNombre');
	v3 = validacion('param_prodLinea');
	v4 = validacion('param_prodMarca');
	v5 = validacion('param_prodEmpaque');
	v6 = validacion('param_prodPresentacion');
	v7 = validacion('param_prodGama');
	v8 = validacion('param_prodSucursal');
	v9 = validacion('param_prodTipo');
	

	if(v1===false||v2===false||v3===false||v4===false||v5===false||v6===false||v7===false||v8===false||v9===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',
			data: $('#form_registro_producto').serialize(),
			url: '../controller/controlproducto/producto.php',
			success: function(data)
			{
				limpiarFormulario();
				$("#error").hide();
                $("#exito").html('<p>El cliente ha sido registrado de forma exitosa.</p>').show(500).delay(8500).hide(500);
			}
		});
	}

}

function limpiarFormulario()
{
	document.getElementById('param_prodCodigoInterno').value = "";
	document.getElementById('param_prodNombre').value = "";
	document.getElementById('param_prodLinea').value = "";
	document.getElementById('param_prodMarca').value = "";
	document.getElementById('param_prodPresentacion').value = "";
	document.getElementById('param_prodEmpaque').value = "";
	document.getElementById('param_prodGama').value = "";
	document.getElementById('param_prodCodigoBarras').value = "";
	document.getElementById('param_prodSucursal').value = "";
	document.getElementById('param_prodTipo').value = "";
	document.getElementById('param_prodPrecioCosto').value = "";
	document.getElementById('param_prodPrecioVenta').value = "";
	document.getElementById('param_prodStockRequerido').value = "";
	document.getElementById('param_prodStockMin').value = "";
	document.getElementById('param_prodStockActual').value = "";
}

function validacion(campo)
{
	var a=0;
	if(campo === 'param_prodCodigoInterno')
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


	if(campo === 'param_prodNombre')
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


	if(campo === 'param_prodLinea')
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


	if(campo === 'param_prodMarca')
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


	if(campo === 'param_prodEmpaque')
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

	if(campo === 'param_prodPresentacion')
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

	if(campo === 'param_prodGama')
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

	if(campo === 'param_prodSucursal')
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
	if(campo === 'param_prodTipo')
	{
		codigo = document.getElementById(campo).value;
		if(codigo ==null || codigo.length ==0)
		{						
			$('#'+campo).parent().attr("class", "form-group col-md-5 has-error");            
            return false;
		}
		else 
		{						
			$('#'+campo).parent().attr("class", "form-group col-md-5 has-success");            
			return true;
		}
	}	
}



function cargarLinea()
{
	var param_opcion = "comboLinea";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success:function(respuesta)
		{			
			$('#linea').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function cargarGama()
{
	var param_opcion = "comboGama";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success:function(respuesta)
		{			
			$('#gama').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function cargarMedida()
{
	var param_opcion = "comboMedida";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success:function(respuesta)
		{			
			$('#medida').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function cargarPresentacion()
{
	var param_opcion = "comboPresentacion";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success:function(respuesta)
		{			
			$('#presentacion').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}


function cargarMarca()
{
	var param_opcion = "comboMarca";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
		success:function(respuesta)
		{			
			$('#marca').html(respuesta);
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function cargarSucursal()
{
	var param_opcion = "comboSucursal";
	$.ajax({
		type:'POST',
		data:'param_opcion='+param_opcion,
		url:"../controller/controlproducto/producto.php",
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
window.numeroDetalleProducto = [];
window.productoID = [];
window.promotorID = [];
window.productoCantidad = [];
window.productoDescuentoPorc = [];
window.productoDescuentoMonto = [];
window.productoMontoTotal = [];

window.numeroDetalleServicio = [];
window.servicioID = [];
window.personalID = [];
window.servicioVariacionPorc = [];
window.servicioVariacionMonto = [];
window.servicioMontoTotal = [];


window.onload = function(){
	$('#registroCliente').on('click', function(){verificarCliente();});

	$('#param_docTipo').on('change', function(){tipoDocumento();});

	$('#tablaClientes').DataTable(); 
	$('#tablaPersonal').DataTable();
	$('#tablaProductos').DataTable();
	$('#tablaServicios').DataTable();
	
	$('#buscarCliente').on('click', function(){mostrarClientes();});

	$('#buscarProducto').on(('click'), function(){mostrarProductos();});
	$('#buscarTrabajadorVenta').on(('click'), function(){mostrarPersonal();});
	$('#buscarServicio').on(('click'), function(){mostrarServicios();});
	$('#buscarPersonalServicio').on(('click'), function(){mostrarPersonalServicios();});
	$('#buscarPromotorVenta').on(('click'), function(){mostrarPersonalPromotor();});

	controlCheckEfectivo = 0;
	$('#checkEfectivo')	.on('change', function(){
		controlCheckEfectivo++;
		if(controlCheckEfectivo%2 == 1)
			document.getElementById('param_docdetPagoContadoMonto').disabled=false;
		else
			document.getElementById('param_docdetPagoContadoMonto').disabled=true;
	});

	controlCheckTarjeta = 0;
	$('#checkTarjeta')	.on('change', function(){
		controlCheckTarjeta++;
		if(controlCheckTarjeta%2 == 1)
		{
			document.getElementById('param_docdetPagoTarjetaBanco').disabled=false;
			document.getElementById('param_docdetPagoTarjetaOperacion').disabled=false;
			document.getElementById('param_docdetPagoTarjetaMonto').disabled=false;
		}
		else
		{
			document.getElementById('param_docdetPagoTarjetaBanco').disabled=true;
			document.getElementById('param_docdetPagoTarjetaOperacion').disabled=true;
			document.getElementById('param_docdetPagoTarjetaMonto').disabled=true;
		}
	});

	controlCheckCheque = 0;
	$('#checkCheque')	.on('change', function(){
		controlCheckCheque++;
		if(controlCheckCheque%2 == 1)
		{
			document.getElementById('param_docdetPagoChequeBanco').disabled=false;
			document.getElementById('param_docdetPagoChequeNumero').disabled=false;
			document.getElementById('param_docdetPagoChequeFecha').disabled=false;
			document.getElementById('param_docdetPagoChequeMonto').disabled=false;
		}
		else
		{
			document.getElementById('param_docdetPagoChequeBanco').disabled=true;
			document.getElementById('param_docdetPagoChequeNumero').disabled=true;
			document.getElementById('param_docdetPagoChequeFecha').disabled=true;
			document.getElementById('param_docdetPagoChequeMonto').disabled=true;
		}
	});


	controlCheckCredito = 0;
	$('#checkCredito')	.on('change', function(){
		controlCheckCredito++;
		if(controlCheckCredito%2 == 1)
			document.getElementById('param_docdetPagoCreditoMonto').disabled=false;
		else
			document.getElementById('param_docdetPagoCreditoMonto').disabled=true;
	});


	controlCheckCanje = 0;
	$('#checkCanje')	.on('change', function(){
		controlCheckCanje++;
		if(controlCheckCanje%2 == 1)
			document.getElementById('param_docdetPagoCanjeMonto').disabled=false;
		else
			document.getElementById('param_docdetPagoCanjeMonto').disabled=true;
	});


	controlCheckRegalo = 0;
	$('#checkRegalo')	.on('change', function(){
		controlCheckRegalo++;
		if(controlCheckRegalo%2 == 1)
			document.getElementById('param_docdetPagoRegaloMonto').disabled=false;
		else
			document.getElementById('param_docdetPagoRegaloMonto').disabled=true;
	});


	$('#tablaDetadocProductos').DataTable();
	$('#tablaDetadocServicios').DataTable();
	$('#tablaPersonalServicio').DataTable();
	$('#tablaPersonalPromotor').DataTable();

	//CABECERA
	$('#tablaClientes tbody').on('dblclick', 'tr', function () {seleccionDobleCliente(this);});
	$('#tablaPersonal tbody').on('dblclick', 'tr', function () {seleccionDoblePersonal(this);});
	
	//DETALLE PRODUCTO
	$('#tablaProductos tbody').on('dblclick', 'tr', function () {seleccionDobleProducto(this);});
	$('#tablaPersonalPromotor tbody').on('dblclick', 'tr', function () {seleccionDoblePersonalPromotor(this);});	

	//DETALLE SERVICIO
	$('#tablaPersonalServicio tbody').on('dblclick', 'tr', function () {seleccionDoblePersonalServicio(this);});	
	$('#tablaServicios tbody').on('dblclick', 'tr', function () {seleccionDobleServicios(this);});	


	montoProductos = 0;
	montoServicios = 0;
	pago = 0;
	montoTotal = 0;

	agregarDetalleProductos();
	agregarDetalleServicios();
	
	


	$('#param_docdetPagoContadoMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoContadoMonto').value * (-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});
	$('#param_docdetPagoTarjetaMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoTarjetaMonto').value *(-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});
	$('#param_docdetPagoChequeMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoChequeMonto').value *(-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});
	$('#param_docdetPagoCreditoMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoCreditoMonto').value *(-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});
	$('#param_docdetPagoCanjeMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoCanjeMonto').value*(-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});
	$('#param_docdetPagoRegaloMonto').on('blur', function(){
		pago = pago - (document.getElementById('param_docdetPagoRegaloMonto').value*(-1));
		document.getElementById('param_docdetPagoTotalDoc').value = pago;
	});

	
	$('#registroDocumento').on('click',function(){guardarDocumento();});


};


function tipoDocumento()
{
	var tipodoc = document.getElementById('param_docTipo').value;
	if (tipodoc == 3)
	{
		document.getElementById('param_docSerie').value = '000';
		document.getElementById('param_docSerie').disabled = true;
	}
	else
	{
		document.getElementById('param_docSerie').disabled=false;
		document.getElementById('param_docSerie').value = '';
	}
}



//FUNCIONES PARA CARGAR LOS DATATABLE DE LOS MODALES
function mostrarPersonalServicios()
{
	var param_opcion = "mostrarPersonal";
	var param_personSucursal = document.getElementById('param_personSucursal').value;
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_sucursal='+param_personSucursal,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaPersonalServicio').DataTable().destroy();
			$('#listaPersonalServicio').html(respuesta);
			$('#tablaPersonalServicio').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function mostrarPersonalPromotor()
{
	var param_opcion = "mostrarPersonal";
	var param_personSucursal = document.getElementById('param_personSucursal').value;
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_sucursal='+param_personSucursal,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaPersonalPromotor').DataTable().destroy();
			$('#listaPersonalPromotor').html(respuesta);
			$('#tablaPersonalPromotor').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function mostrarClientes(){
	var param_opcion = "mostrarClientes";
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaClientes').DataTable().destroy();
			$('#listaClientes').html(respuesta);
			$('#tablaClientes').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function mostrarPersonal(){
	var param_opcion = "mostrarPersonal";
	var param_personSucursal = document.getElementById('param_personSucursal').value;
	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_sucursal='+param_personSucursal,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaPersonal').DataTable().destroy();
			$('#listaPersonal').html(respuesta);
			$('#tablaPersonal').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function mostrarProductos()
{
	var param_opcion = "mostrarProductos";
	var param_sucursal = document.getElementById('param_personSucursal').value;

	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_sucursal='+param_sucursal,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaProductos').DataTable().destroy();
			$('#listaProductos').html(respuesta);
			$('#tablaProductos').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}

function mostrarServicios()
{
	var param_opcion = "mostrarServicios";
	var param_sucursal = document.getElementById('param_personSucursal').value;

	$.ajax({
		type: 'POST',
		data: 'param_opcion='+param_opcion+'&param_sucursal='+param_sucursal,
		url: '../controller/controldocumento/documento.php',
		success: function(respuesta)
		{
			$('#tablaServicios').DataTable().destroy();
			$('#listaServicios').html(respuesta);
			$('#tablaServicios').DataTable();
		},
		error: function(respuesta)
		{
			alert("ERROR AL MOSTRAR DATOS");
		}
	});
}




//FUNCIONES PARA DAR FUNCIONALIDAD AL DAR DOBLE CLICK EN ALGUNA FILA DE LAS TABLAS DE LOS MODALES
function seleccionDobleCliente(e){
	if ($('#tablaClientes tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaClientes').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docCliente').value = $('#tablaClientes').DataTable().cell('.selected', 1).data();
  	document.getElementById('param_docDNI').value = $('#tablaClientes').DataTable().cell('.selected', 0).data();	
  	$('#modal-buscarCliente').modal('hide');
}

function seleccionDoblePersonal(e){
	if ($('#tablaPersonal tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaPersonal').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docCodigoTrabajador').value = $('#tablaPersonal').DataTable().cell('.selected', 0).data();
  	document.getElementById('param_docTrabajador').value = $('#tablaPersonal').DataTable().cell('.selected', 1).data();	
  	$('#modal-buscarTrabajador').modal('hide');
}

function seleccionDoblePersonalServicio(e){
	if ($('#tablaPersonalServicio tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaPersonalServicio').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docdetcodpers').value = $('#tablaPersonalServicio').DataTable().cell('.selected', 0).data();
  	document.getElementById('param_docdetpers').value = $('#tablaPersonalServicio').DataTable().cell('.selected', 1).data();	
  	$('#modal-buscarTrabajadorServicio').modal('hide');
  	
  	document.getElementById('addRowServicio').disabled = false;	
}


function seleccionDoblePersonalPromotor(e){
	if ($('#tablaPersonalPromotor tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaPersonalPromotor').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docdetcodpromotor').value = $('#tablaPersonalPromotor').DataTable().cell('.selected', 0).data();
  	document.getElementById('param_docdetpromotor').value = $('#tablaPersonalPromotor').DataTable().cell('.selected', 1).data();	
  	$('#modal-buscarPromotorVenta').modal('hide');
  	
  		
}


function seleccionDobleServicios(e){
	if ($('#tablaServicios tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaServicios').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docdetcodserv').value = $('#tablaServicios').DataTable().cell('.selected', 0).data();
  	document.getElementById('param_docdetserv').value = $('#tablaServicios').DataTable().cell('.selected', 1).data();	
  	document.getElementById('param_docdetPrecioBase').value = $('#tablaServicios').DataTable().cell('.selected', 2).data();	
  	$('#modal-buscarServicio').modal('hide');

  	document.getElementById('addRowServicio').disabled = false;	
}

function seleccionDobleProducto(e){
	if ($('#tablaProductos tbody tr td').length == 1){
 	   return false;
	}
	

	if ( $(e).hasClass('selected')){
 		$(e).removeClass('selected');
 	}
	else {
      	$('#tablaProductos').DataTable().$('tr.selected').removeClass('selected');
   		$(e).addClass('selected');
   	}
  	document.getElementById('param_docdetcodprod').value = $('#tablaProductos').DataTable().cell('.selected', 0).data();
  	document.getElementById('param_docdetprod').value = $('#tablaProductos').DataTable().cell('.selected', 1).data();	
  	document.getElementById('param_docdetPrecioUnitarioProd').value = $('#tablaProductos').DataTable().cell('.selected', 3).data();	
  	$('#modal-buscarProducto').modal('hide');

  	document.getElementById('addRow').disabled = false;
}




//FUNCIONES PARA AGREGAR VALORES EN LOS DETALLES DE PRODUCTOS Y SERVICIOS
function agregarDetalleProductos()
{
	var counter = 1;
 	var t = $('#tablaDetadocProductos').DataTable();

    $('#addRow').on( 'click', function () {
    	var codigoPromotor = document.getElementById('param_docdetcodpromotor').value;
    	var promotor 	   = document.getElementById('param_docdetpromotor').value;
    	var codigoProducto = document.getElementById('param_docdetcodprod').value;
		var producto       = document.getElementById('param_docdetprod').value;
		var preciounitario = document.getElementById('param_docdetPrecioUnitarioProd').value;
		var cantidad       = document.getElementById('param_docdetCantidadProd').value;
		var descPorc       = document.getElementById('param_docdetDsctoPorcenajeProd').value;
		var descMonto      = document.getElementById('param_docdetDsctoMontoProd').value;
		var precioBruto    = 0;
		var descuento      = 0;
		var total          = 0;
		precioBruto        = (preciounitario * cantidad);

    	if (descPorc > 0)
    	{    		    		
			descPorc  = precioBruto * (descPorc/100);
			descuento = descPorc;    		
    	}
    	if (descMonto>0)
    	{
    		descuento = descuento - (descMonto*(-1));    			
    	}

    	total = precioBruto - descuento;

        t.row.add( [
            counter,
            promotor,
            producto,
            preciounitario,
            cantidad,
            precioBruto,
            descuento,
            total
        ] ).draw( false );
 
 		numeroDetalleProducto.push(counter);
        counter++;
        montoProductos = montoProductos + total
    	montoTotal = montoTotal + total;        	

    	
    	promotorID.push(codigoPromotor);
		productoID.push(codigoProducto);
		productoCantidad.push(cantidad);
		if (descPorc!=0)
			productoDescuentoPorc.push(descPorc);
		else
			productoDescuentoPorc.push(0);
		if (descMonto!=0)
			productoDescuentoMonto.push(descMonto);
		else
			productoDescuentoMonto.push(0);
		
		productoMontoTotal.push(total);


        document.getElementById('param_docdetcodprod').value="";
        document.getElementById('param_docdetprod').value="";
    	document.getElementById('param_docdetpromotor').value="";
    	document.getElementById('param_docdetcodpromotor').value="";    	
        document.getElementById('param_docdetCantidadProd').value=0;
    	document.getElementById('param_docdetPrecioUnitarioProd').value=0;
    	document.getElementById('param_docdetCantidadProd').value=0;
    	document.getElementById('param_docdetDsctoPorcenajeProd').value=0;
    	document.getElementById('param_docdetDsctoMontoProd').value=0;
    	document.getElementById('param_docdetMontoTotalProd').value=montoProductos;
    	document.getElementById('param_docdetMontoTotalDoc').value=montoTotal;

    	document.getElementById('addRow').disabled=true;

    } );
}

function agregarDetalleServicios()
{
	var counter = 1;
 	var t = $('#tablaDetadocServicios').DataTable();

    $('#addRowServicio').on( 'click', function () {
    	var codigoServicio = document.getElementById('param_docdetcodserv').value;
    	var codigoPersonal = document.getElementById('param_docdetcodpers').value;

		var servicio       = document.getElementById('param_docdetserv').value;
		var personal 		= document.getElementById('param_docdetpers').value;
		var precioBase     = document.getElementById('param_docdetPrecioBase').value;
		
		var variacPorc      = document.getElementById('param_docdetVarPorcServicio').value;
		var variacMonto      = document.getElementById('param_docdetVarMontoServicio').value;
		var precioBruto    = 0;
		var variacion      = 0;
		var total          = 0;
		precioBruto        = precioBase;

    	if (variacPorc > 0 || variacPorc < 0)
    	{    		    		
			variacPorc  = precioBruto * (variacPorc/100);
			variacion = variacPorc;    		
    	}
    	else
    		if (variacMonto>0 || variacMonto<0)
    		{
    			variacion = variacMonto;    			
    		}

    	total = precioBruto - (variacion*(-1));



        t.row.add( [
            counter,
            servicio,
            personal,
            precioBase,                        
            variacion,
            total
        ] ).draw( false );
 
        counter++;

    	numeroDetalleServicio.push(counter);
    	montoServicios = montoServicios + total;    	
    	montoTotal = montoTotal + total;

		servicioID.push(codigoServicio);
		personalID.push(codigoPersonal);
		
		
		servicioMontoTotal.push(total);


		if (variacPorc!=0)
			servicioVariacionPorc.push(variacPorc);
		else
			servicioVariacionPorc.push(0);
		if (variacMonto!=0)
			servicioVariacionMonto.push(variacMonto);
		else
			servicioVariacionMonto.push(0);


        document.getElementById('param_docdetcodserv').value="";
        document.getElementById('param_docdetserv').value="";
        document.getElementById('param_docdetcodpers').value="";
    	document.getElementById('param_docdetpers').value="";
    	document.getElementById('param_docdetPrecioBase').value="";    	
    	document.getElementById('param_docdetVarPorcServicio').value="";
    	document.getElementById('param_docdetVarMontoServicio').value="";
    	document.getElementById('param_docdetMontoTotalServ').value = montoServicios;
    	document.getElementById('param_docdetMontoTotalDoc').value=montoTotal;

    	document.getElementById('addRow').disabled=true;
    } );
}


function guardarDocumento()
{
	var montoPagado = document.getElementById('param_docdetPagoTotalDoc').value;
	var montoTotalDocumento = document.getElementById('param_docdetMontoTotalDoc').value;
	alert(montoTotalDocumento);
	if (montoPagado < montoTotalDocumento)
	{
		var diferencia = montoTotalDocumento - montoPagado;
		alert('ERROR! El monto de pago no cubre el monto de la venta. Faltan S/. '+diferencia+'.');
	}
	else
	{
		if (montoPagado > montoTotalDocumento)
		{
			var diferencia = montoPagado - montoTotalDocumento;
			alert('ERROR! El monde pago excede el monto de la venta. Sobran S/. '+diferencia+'.');
		}
		else
		{			
			var param_opcion = "guardarDocumento";
			var param_docTipoDocumento = document.getElementById('param_docTipo').value;
			var param_personSucursal = document.getElementById('param_personSucursal').value;
			var param_docSerie = document.getElementById('param_docSerie').value;
			var param_docNumero = document.getElementById('param_docNumero').value;
			var param_docFechaHora = document.getElementById('fechaHoraDocumento').value;
			var param_docDNICliente = document.getElementById('param_docDNI').value;
			var param_docCodigoPersonalCaja = document.getElementById('param_docCodigoTrabajador').value;
						
			var param_docdetPagoContadoMonto = document.getElementById('param_docdetPagoContadoMonto').value;
			var param_docdetPagoTarjetaBanco = document.getElementById('param_docdetPagoTarjetaBanco').value;
			var param_docdetPagoTarjetaOperacion = document.getElementById('param_docdetPagoTarjetaOperacion').value;
			var param_docdetPagoTarjetaMonto = document.getElementById('param_docdetPagoTarjetaMonto').value;
			var param_docdetPagoChequeBanco = document.getElementById('param_docdetPagoChequeBanco').value;
			var param_docdetPagoChequeNumero = document.getElementById('param_docdetPagoChequeNumero').value;
			var param_docdetPagoChequeMonto = document.getElementById('param_docdetPagoChequeMonto').value;
			var param_docdetPagoChequeFecha = document.getElementById('param_docdetPagoChequeFecha').value;
			var param_docdetPagoCreditoMonto = document.getElementById('param_docdetPagoCreditoMonto').value;
			var param_docdetPagoCanjeMonto = document.getElementById('param_docdetPagoCanjeMonto').value;
			var param_docdetPagoRegaloMonto = document.getElementById('param_docdetPagoRegaloMonto').value;

			


			$.ajax({
				type: 'POST',
				data: 'param_opcion='+param_opcion+'&param_sucursal='+param_personSucursal+
						'&param_docTipoDocumento='+param_docTipoDocumento+'&param_docSerie='+param_docSerie+
						'&param_docNumero='+param_docNumero+'&param_docFechaHora='+param_docFechaHora+
						'&param_docDNICliente='+param_docDNICliente+'&param_docCodigoPersonalCaja='+param_docCodigoPersonalCaja+
							
							'&param_numeroDetalleProducto='+numeroDetalleProducto+'&param_productoID='+productoID+
							'&param_promotorID='+promotorID+'&param_productoCantidad='+productoCantidad+
							'&param_productoDescuentoPorc='+productoDescuentoPorc+'&param_productoDescuentoMonto='+productoDescuentoMonto+
							'&param_productoMontoTotal='+productoMontoTotal+
							
							'&param_numeroDetalleServicio='+numeroDetalleServicio+'&param_servicioID='+servicioID+
							'&param_personalID='+personalID+'&param_servicioVariacionPorc='+servicioVariacionPorc+
							'&param_servicioVariacionMonto='+servicioVariacionMonto+'&param_servicioMontoTotal='+servicioMontoTotal+

							'&param_checkEfectivo='+controlCheckEfectivo+'&param_checkTarjeta='+controlCheckTarjeta+
							'&param_checkCheque='+controlCheckCheque+'&param_checkCredito='+controlCheckCredito+
							'&param_checkCanje='+controlCheckCanje+'&param_checkRegalo='+controlCheckRegalo+

							'&param_docdetPagoContadoMonto='+param_docdetPagoContadoMonto+'&param_docdetPagoTarjetaBanco='+param_docdetPagoTarjetaBanco+
							'&param_docdetPagoTarjetaOperacion='+param_docdetPagoTarjetaOperacion+'&param_docdetPagoTarjetaMonto='+param_docdetPagoTarjetaMonto+
							'&param_docdetPagoChequeBanco='+param_docdetPagoChequeBanco+'&param_docdetPagoChequeNumero='+param_docdetPagoChequeNumero+
							'&param_docdetPagoChequeMonto='+param_docdetPagoChequeMonto+
							'&param_docdetPagoChequeFecha='+param_docdetPagoChequeFecha+'&param_docdetPagoCreditoMonto='+param_docdetPagoCreditoMonto+
							'&param_docdetPagoCanjeMonto='+param_docdetPagoCanjeMonto+'&param_docdetPagoRegaloMonto='+param_docdetPagoRegaloMonto+
							'&param_montoTotal='+montoTotalDocumento,
				url: '../controller/controldocumento/documento.php',
				success: function(respuesta)
				{
					console.log(respuesta);
				},
				error: function(respuesta)
				{
					alert("ERROR AL MOSTRAR DATOS");
				}
			});
		}
	}
}


function verificarCliente()
{
	var v1=0; v2=0; v3=0; v4=0; v5=0; v6=0;
	v1 = validacion('param_cliDNI');
	v2 = validacion('param_cliNombre');
	v3 = validacion('param_cliApellidoPaterno');
	v4 = validacion('param_cliApellidoMaterno');
	v5 = validacion('param_cliCorreo');
	

	if(v1===false||v2===false||v3===false||v4===false||v5===false)
	{
		$('#exito').hide();
		$('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
	}
	else
	{
		$.ajax({
			type: 'POST',
			data: $('#form_grabar_cliente').serialize(),
			url: '../controller/controlcliente/cliente.php',
			success: function(data)
			{
				limpiarModalCliente();
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

function limpiarModalCliente()
{
	document.getElementById('param_cliDNI').value="";
	document.getElementById('param_cliNombre').value="";
	document.getElementById('param_cliApellidoPaterno').value="";
	document.getElementById('param_cliApellidoMaterno').value="";	
	document.getElementById('param_cliCorreo').value="";
}

//47934182
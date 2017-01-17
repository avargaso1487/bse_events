window.numeroDetalleFactura = [];
window.productoId = [];
window.cantidadUC = [];
window.cantidadUV = [];
window.productoPrecio = [];
window.impuestoIva = [];
window.productoDescuento = [];
window.importeProducto = [];
window.almacen = [];

$(document).ready(function(){    
$('#tablaFacturas').DataTable(); //SIEMPREEEEEEEEEE
$('#tablaEventos').DataTable(); 
$('#tablaParticipantes').DataTable(); 
$('#tablaActividades').DataTable(); 
$('#tablaDetalleFactura').DataTable(); 
listarFactura();
listarEvento();
mostrarMenu();  
agregarDetalleFactura();


});



$(function() {
   

    $('#register_pedido').on('click', function(){
       //alert('Listo para realizar el registro');
      if (document.getElementById('participantes').value=='' || document.getElementById('param_serie').value==''||document.getElementById('param_numero').value=='') 
        {
            alert('Falta ingresar datos');

        }
        else{
            if (document.getElementById('estado').value!='') 
                {
                    alert('La factura para este participante ya ha sido generada.');
                }

                else{

       var param_opcion = 'registrar';
       var param_serie = document.getElementById('param_serie').value;
       var param_numero = document.getElementById('param_numero').value;
       var param_evento = document.getElementById('codigoEvento').value;
       var param_participante = document.getElementById('participantes').value;
       var param_monto = document.getElementById('total').value;
       var param_descuento = document.getElementById('descuento').value;
       var param_neto = document.getElementById('neto').value;

       var table = $('#tablaDetallesFactura').DataTable();

       var respuesta = confirm('¿Desea registrar la factura?');
       if (respuesta == true) {
            //alert('Registrar');
            $.ajax({
                type: 'POST',
                data:'param_opcion='+param_opcion+'&param_serie='+param_serie+'&param_numero='+param_numero+
                    '&param_evento='+param_evento+'&param_participante='+param_participante+
                    '&param_monto='+param_monto+'&param_descuento='+param_descuento+
                    '&param_neto='+param_neto,
                url: '../../controller/controlFacturacion/venta_controller.php', 
                success: function(data){
                    alert('Factura registrada correctamente');
                    //mostrarProveedores();
                    document.getElementById('param_serie').value = '';
                    document.getElementById('param_numero').value = '';
                    document.getElementById('codigoEvento').value = '';
                    document.getElementById('participantes').value = '';
                    document.getElementById('paquete').value = '';
                    document.getElementById('condicion').value = '';
                    document.getElementById('total').value = '';
                    document.getElementById('descuento').value = '';
                    document.getElementById('neto').value = '';
                    document.getElementById('estado').value = '';
                        location.href='ventas_view.php';
                    
                    table
                        .clear()
                        .draw(); 
                    

                },
                error: function(data){
                    //$('#cuerpoTabla').html(respuesta);
                }
            });
       } else {
        if (respuesta == false) {
          alert('Se cancelo el registro');
        }

      } 
  }
}
    });


});


function listarDetalleFactura(participante,evento){ 
    var param_opcion = 'listarDetalle';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion+'&param_evento=' +evento+'&param_participante=' +participante,
        url: '../../controller/controlFacturacion/venta_controller.php',
        success: function(data){
            $('#tablaDetalleFactura').DataTable().destroy();
            $('#cuerpoDetalleFactura').html(data);
            $('#tablaDetalleFactura').DataTable();
        },
        error: function(data){
                   
        }
    });    
}


function listarFactura()
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'listar'},
        
        url: "../../controller/controlFacturacion/venta_controller.php",
        success:function(data){
            
        
            $('#tablaFacturas').DataTable().destroy();
            $('#cuerpoFacturas').html(data);
            $('#tablaFacturas').DataTable(
                {
                        "columnDefs": [
                            { "targets": [ 0 ],"width": "12%"},
                            { "targets": [ 1 ],"width": "20%"},
                            { "targets": [ 2 ],"width": "13%"},
                            { "targets": [ 3 ],"width": "20%"},
                            { "targets": [ 4 ],"width": "15%"},
                            { "targets": [ 5 ],"width": "15%"},
                            { "targets": [ 6 ],"width": "10%","visible": false},
                            { "targets": [ 7 ],"width": "15%","visible": false,},
                            { "targets": [ 8 ],"width": "10%"},
                        ],
                        "order": [[ 0, "desc" ]]
                    }

                );
          
                                                                    
        }
    });
}

function listarEvento()
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'listarEvento'},
        
        url: "../../controller/controlFacturacion/venta_controller.php",
        success:function(data){
            
        
            $('#tablaEventos').DataTable().destroy();
            $('#cuerpoEventos').html(data);
            $('#tablaEventos').DataTable();
          
                                                                    
        }
    });
}

function listarParticipantes(idevento)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'listarParticipante',param_evento:idevento},
        
        url: "../../controller/controlFacturacion/venta_controller.php",
        success:function(data){
            
        
            $('#tablaParticipantes').DataTable().destroy();
            $('#cuerpoParticipantes').html(data);
            $('#tablaParticipantes').DataTable();
          
                                                                    
        }
    });
}


function seleccionarEvento(codigo){
    var param_opcion = 'seleccionar_evento';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&param_evento=' +codigo,
      url: '../../controller/controlFacturacion/venta_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $('#verevento').modal('hide');
          $("#codigoEvento").val(objeto[0]);
          $("#evento").val(objeto[1]);
          document.getElementById('paquete').value = '';
        document.getElementById('condicion').value = '';
        document.getElementById('total').value = '';
        document.getElementById('descuento').value = '';
        document.getElementById('neto').value = '';
        document.getElementById('estado').value = '';
         

      },
      error: function(data){
                 
      }
    }); 
}


function seleccionarParticipante(codigo){
    var param_opcion = 'seleccionar_participante';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&param_participante=' +codigo,
      url: '../../controller/controlFacturacion/venta_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $('#verParticipante').modal('hide');
          $("#participantes").val(objeto[0]);
          $("#participanteDescrip").val(objeto[1]);
        document.getElementById('paquete').value = '';
        document.getElementById('condicion').value = '';
        document.getElementById('total').value = '';
        document.getElementById('descuento').value = '';
        document.getElementById('neto').value = '';
        document.getElementById('estado').value = '';

      },
      error: function(data){
                 
      }
    }); 
}

function cargarDatos(evento,participante){
    var param_opcion = 'cargar_datos';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&param_evento=' +evento+'&param_participante=' +participante,
      url: '../../controller/controlFacturacion/venta_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $("#paquete").val(objeto[0]);
          $("#condicion").val(objeto[1]);
         

      },
      error: function(data){
                 
      }
    }); 
}

function mostrarMonto(evento,participante){
    var param_opcion = 'mostrar_monto';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&param_evento=' +evento+'&param_participante=' +participante,
      url: '../../controller/controlFacturacion/venta_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $("#total").val(objeto[0]);
          $("#descuento").val(objeto[1]);
          $("#neto").val(objeto[2]);

      },
      error: function(data){
                 
      }
    }); 
}

function estado(evento,participante){
    var param_opcion = 'estado';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&param_evento=' +evento+'&param_participante=' +participante,
      url: '../../controller/controlFacturacion/venta_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $("#estado").val(objeto[0]);
          

      },
      error: function(data){
                 
      }
    }); 
}
function mostrarDetalle(evento,participante){
     
    if(participante=='')
    {
        alert('Seleccione evento y participante');
    }
    else
    {
     $.ajax({
        type:'POST',
        data: {param_opcion:'mostrarDetalle',param_evento:evento,param_participante:participante},
        url: "../../controller/controlFacturacion/venta_controller.php",
        success:function(data){
            
        
            $('#tablaDetallesFactura').DataTable().destroy();
            $('#cuerpoDetalleFactura').html(data);
            $('#tablaDetallesFactura').DataTable();
          
                                                                    
        }
    });
 }
}

function validarEvento(evento)
{
    if(evento=='')
    {
        alert("Seleccione evento");
    }
    else
        {
          $('#verParticipante').modal({
            show:true,
            backdrop:'static',
          });
          listarParticipantes(document.getElementById('codigoEvento').value);
      }
}



function seleccionDobleProducto(e){
    if ($('#tablaParticipantes tbody tr td').length == 1){
       return false;
    }
    

    if ( $(e).hasClass('selected')){
        $(e).removeClass('selected');
    }
    else {
        $('#tablaParticipantes').DataTable().$('tr.selected').removeClass('selected');
        $(e).addClass('selected');
    }
    document.getElementById('codigoProducto').value = $('#tablaParticipantes').DataTable().cell('.selected', 0).data();
    document.getElementById('producto').value = $('#tablaParticipantes').DataTable().cell('.selected', 1).data();
    document.getElementById('precio').value = $('#tablaParticipantes').DataTable().cell('.selected', 2).data();
    document.getElementById('igv').value = $('#tablaParticipantes').DataTable().cell('.selected', 5).data();  
    document.getElementById('almacen').value = $('#tablaParticipantes').DataTable().cell('.selected', 6).data();  
    $('#verProducto').modal('hide');
    document.getElementById('addRow').disabled = false; 
}

function imprimir(fechaInicio,fechaFin){ 
  
    $.ajax({
        type: 'POST',        
        data:'param_fechaInicio='+fechaInicio+'&param_fechaFin='+fechaFin,
        url: 'anchoF.php', 
        success: function(data){
            alert("Archivo generado exitosamente");
            document.getElementById('archivo').style.display = 'block';
            //open()
            //window.open("file://///wamp/www/bse_events/Reportes");
        },
        error: function(data){
                   
        }
    });}
function imprimir2(fechaInicio,fechaFin){ 
  
    $.ajax({
        type: 'POST',        
        data:'param_fechaInicio='+fechaInicio+'&param_fechaFin='+fechaFin,
        url: 'textoD.php', 
        success: function(data){
            alert("Archivo generado exitosamente");
        },
        error: function(data){
                   
        }
    });}
function agregarDetalleFactura() {
    var counter = 1;
    var t = $('#tablaDetallesFactura').DataTable();


    $('#addRow').on( 'click', function () {
        var codigo              = document.getElementById('codigoProducto').value;
        var descripcion         = document.getElementById('producto').value;
        var cantidad            = document.getElementById('cantidad').value;
        var precio              = document.getElementById('precio').value;
        var iva                 = document.getElementById('igv').value;
        var alma             = document.getElementById('almacen').value;
        var descuento           = document.getElementById('descuento').value;
        var desc= 0;
        var precioBruto= 0;
        var descontar= 0;
        var importe= 0;


        desc = descuento;
        precioBruto = (precio * cantidad);

        if (desc > 0)
        {                       
            desc  = precioBruto* (desc/100);
            descontar = desc;           
        } else {
            descuento = 0;
        }

        importe = precioBruto - descontar;

        t.row.add( [
            codigo,
            descripcion,
            cantidad,
            precio,
            iva,
            descuento,
            importe.toFixed(2),
            alma,
            '<button class="btn btn-danger btn-xs center deleteValid col-md-offset-2" onclick="Eliminar('+"'"+codigo+"'"+','+"'"+cantidad+"'"+','+"'"+precio+"'"+','+"'"+iva+"'"+','+"'"+descuento+"'"+','+importe+','+counter+','+alma+')">Eliminar</button>',        
        ] ).draw( false );
        
        productoId.push(codigo);
        almacen.push(alma);
        numeroDetalleFactura.push(counter);
        counter++;
        montoProductosDetalle = montoProductosDetalle + importe;
        
        totalNeto = montoProductosDetalle;

        //cantidadUC.push(cantidad);
        cantidadUV.push(cantidad);

        productoPrecio.push(precio);
        impuestoIva.push(iva);
        productoDescuento.push(descuento);
        importeProducto.push(importe);
        
        document.getElementById('codigoProducto').value="";
        document.getElementById('producto').value="";
        document.getElementById('cantidad').value="1";
        document.getElementById('precio').value="0"; 
        document.getElementById('igv').value="";
        document.getElementById('descuento').value="";             
        
        document.getElementById('param_total').value=montoProductosDetalle;
        
        document.getElementById('addRow').disabled=true;
     

    } );

    $('#tablaDetallesFactura tbody').on( 'click', 'button', function () {
        t
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });
}


function limpiar()
{
    
    descripcion = document.getElementById("participanteDescrip").value='';
    participante = document.getElementById("participantes").value='';

    

}


function solonumeros(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numeros = "0123456789";
    especiales = "8-37-38-46"
    teclado_especial=false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial= true;
        }
    }

    if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
        return false;
    }
}
function validarCampos()
{
    
    sucursal = document.getElementById("sucursal").selectedIndex;
    codigobarras = document.getElementById("codigobarras").value;
    concepto = document.getElementById("concepto").value;
    descripcion = document.getElementById("descripcion").value;
    referencia = document.getElementById("referencia").value;
    subfamilia = document.getElementById("subfamilia").selectedIndex;
    stock = document.getElementById("stock").value;
    stockminimo = document.getElementById("stockminimo").value;
    costocompra = document.getElementById("costocompra").value;
    precioventa = document.getElementById("precioventa").value;
    igv = document.getElementById("igv").value;

    if( sucursal == null || sucursal == 0 ) {
    return false;
    }

    if( codigobarras == null || codigobarras == 0 ) 
    {
    return false;
    }

    if( concepto == null || concepto == 0 ) {
    return false;
    }

    if( descripcion == null || descripcion == 0 ) 
    {
    return false;
    }
    if( referencia == null || referencia == 0 ) {
    return false;
    }

    if( subfamilia == null || subfamilia == 0 ) 
    {
    return false;
    }
    

    if( stock == null || stock == 0 ) 
    {
    return false;
    }
    if( stockminimo == null || stockminimo == 0 ) {
    return false;
    }

    if( costocompra == null || costocompra == 0 ) 
    {
    return false;
    }
    if( precioventa == null || precioventa == 0 ) {
    return false;
    }
    if( igv == null || igv == 0 ) {
    return false;
    }

 

    
}

function cerrar() { 
  location.href='facturasVentaTienda.php';
}
function mostrarMenu()
{    
    var grupo = document.getElementById('NombreGrupo').value;
    var tarea = document.getElementById('NombreTarea').value;
    //alert(grupo);
    $.ajax({
        type:'POST',
        data: 'opcion=mostrarMenu&grupo='+grupo+'&tarea='+tarea,        
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                              
            $('#permisos').html(data);                
        }
    });
    //alert("kjb");
}

function alerta_almacen()
{
    $.ajax({
        type:'POST',
        data: {opcion:'alerta_almacen'},
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                          
            $('#alertaalmacen').html(data);
        }
    }); 
}

function alerta_spa()
{
    $.ajax({
        type:'POST',
        data: {opcion:'alerta_spa'},
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                          
            $('#alertaspa').html(data);
        }
    }); 
}

function Eliminar(codigo,cantidad,precio,iva,descuento,importe,counter,alma) {  
    document.getElementById('param_total').value=document.getElementById('param_total').value - parseFloat(importe) ;
    montoProductosDetalle = montoProductosDetalle - parseFloat(importe);
    var pos = productoId.indexOf(codigo);
    var pos2 = numeroDetalleFactura.indexOf(counter);
    var pos3 = cantidadUC.indexOf(cantidad);
    var pos4 = cantidadUV.indexOf(cantidad);
    var pos5 = productoPrecio.indexOf(precio);
    var pos6 = impuestoIva.indexOf(iva);
    var pos7 = productoDescuento.indexOf(descuento);
    var pos8 = importeProducto.indexOf(importe);
    var pos9 = almacen.indexOf(alma);
    productoId.splice(pos, 1);
    numeroDetalleFactura.splice(pos2, 1);
    cantidadUC.splice(pos3, 1);
    cantidadUV.splice(pos4, 1);
    productoPrecio.splice(pos5, 1);
    impuestoIva.splice(pos6, 1);
    productoDescuento.splice(pos7, 1);
    importeProducto.splice(pos8, 1);
    almacen.splice(pos9, 1);

    console.log(productoId.toString());
    console.log(numeroDetalleFactura.toString());
    console.log(cantidadUC.toString());
    console.log(cantidadUV.toString());
    console.log(productoPrecio.toString());
    console.log(impuestoIva.toString());
    console.log(productoDescuento.toString());
    console.log(importeProducto.toString());
    console.log(almacen.toString());

}
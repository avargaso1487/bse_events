window.codigoActividad = [];
var counter = 0;
window.onload = function(){       
    mostrarMenu();
    mostrarEvento();   
    mostrarTipoDocumentoPago();
    mostrarPaquetes();       
    $('#tablaDetalleActividades').dataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    }); 
    //$('#tablaProveedorLinea').dataTable(); 
    montoActividadesTotal = 0;
    agregarActividad(); 
}

$(function() {
   $('#buscarParticipante').on('click', function(){       
       $('#modalParticipante').modal({
            show:true,
            backdrop:'static',
        });  
        mostrarParticipantes();        
    }); 

   $('#register_inscripcion').on('click', function(){       
      var param_participanteID = document.getElementById('param_participanteID').value;
      var param_paquete = document.getElementById('param_paquete').value;
      var param_banco = document.getElementById('param_banco').value;
      var Voucher = document.getElementById('Voucher').value;
      var param_nroOperacion = document.getElementById('param_nroOperacion').value;
      var param_monto = document.getElementById('param_monto').value;
      var param_descuento = document.getElementById('param_descuento').value;      
      var table = $('#tablaDetalleActividades').DataTable();
      if (param_participanteID == '' || param_paquete == '' || param_banco == '' || param_nroOperacion == '' || Voucher == '') {
      	alert('Ingrese todos los campos requeridos');
      } else {

        if (param_paquete == '1') {

          $("#tablaDetalleActividades tbody tr").each(function (index) {
            var codigo;
            $(this).children("td").each(function (index2) 
            {
                switch (index2) 
                {
                    case 0: codigo = $(this).text();
                        break;                    
                } 
            })
            //alert(codigo + ' - ' + descripcion + ' - ' + cantidadUC);
            codigoActividad.push(codigo);                       
          })

          var formData = new FormData($("#frmParticipantes")[0]);
          formData.append("codigoActividad", codigoActividad);    
          formData.append("param_monto", param_monto);
          formData.append("param_descuento", param_descuento);        
            $.ajax({
              url: '../../controller/controlEvento/inscripcion_controller.php',
              type:'POST',
              data:formData,
              cache:false,
              processData:false,
              contentType:false,
            }).done(function(resp){            
              alert('Registro Correcto');
            document.getElementById('param_nroOperacion').value= '';
            document.getElementById('param_participante').value= '';
            document.getElementById('param_banco').value= '';  
            document.getElementById('param_paquete').value= '';
            document.getElementById('param_tipoDocumentoPago').value= '';           
            document.getElementById('param_participanteID').value= ''; 
            document.getElementById('param_fechaPago').value= '';
            document.getElementById('param_codigo').value= '';
            document.getElementById('param_actividadID').value= '';  
            document.getElementById('param_monto').value= '';
            document.getElementById('param_descuento').value= '';
            document.getElementById('param_montoNeto').value= '';
            document.getElementById('param_evento').value= '';
            $('#Voucher').ace_file_input('reset_input');
            codigoActividad = [];  
            counter = 0;   
            table
                  .clear()
                  .draw();     
            });
        } else {
          if (param_paquete == '2') {            
            var formData = new FormData($("#frmParticipantes")[0]);
            formData.append("codigoActividad", codigoActividad);    
            formData.append("param_monto", param_monto);
            formData.append("param_descuento", param_descuento);        
              $.ajax({
                url: '../../controller/controlEvento/inscripcion_controller.php',
                type:'POST',
                data:formData,
                cache:false,
                processData:false,
                contentType:false,
              }).done(function(resp){            
                alert('Registro Correcto');
              document.getElementById('param_nroOperacion').value= '';
              document.getElementById('param_participante').value= '';
              document.getElementById('param_banco').value= '';  
              document.getElementById('param_paquete').value= '';
              document.getElementById('param_tipoDocumentoPago').value= '';           
              document.getElementById('param_participanteID').value= ''; 
              document.getElementById('param_fechaPago').value= '';
              document.getElementById('param_codigo').value= '';
              document.getElementById('param_actividadID').value= '';  
              document.getElementById('param_monto').value= '';
              document.getElementById('param_descuento').value= '';
              document.getElementById('param_montoNeto').value= '';
              document.getElementById('param_evento').value= '';
              $('#Voucher').ace_file_input('reset_input');
              codigoActividad = [];  
              counter = 0;   
              table
                    .clear()
                    .draw();     
              });
          }
        }



      	
      }
    });

    $('#cancel_inscripcion').on('click', function(){  
      
    });  

});

function mostrarParticipantes(){
    var opcion = 'mostrar_participante_inscripcion';
    $.ajax({
        type: 'POST',
        data:'opcion='+opcion,
        url: '../../controller/controlMantenedores/participante_controller.php',
        success: function(data){
            $('#tablaParticipantes').DataTable().destroy();
            $('#cuerpoParticipantes').html(data);
            $('#tablaParticipantes').DataTable();
        },
        error: function(data){
        }
    });
}

function seleccionarParticipante(codigo){
    var param_opcion = 'seleccionar_participante';    
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&codigo=' +codigo,
      url: '../../controller/controlEvento/inscripcion_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $('#modalParticipante').modal('hide');
          $("#param_participanteID").val(objeto[0]);
          $("#param_participante").val(objeto[1]);
          
         

      },
      error: function(data){
                 
      }
    }); 
}

function mostrarTipoDocumentoPago(){ 
    var param_opcion = 'combo_tipoDocumentoPago';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
            $('#tipoPago').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function mostrarEvento(){ 
    var param_opcion = 'combo_evento';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
            $('#evento').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function mostrarPaquetes(){ 
    var param_opcion = 'combo_paquetes';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
            $('#paquete').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function mostrarActividades(){ 
    var codigo = document.getElementById('param_evento').value;
    var param_opcion = 'combo_actividades';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion+'&codigo=' +codigo,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
            $('#actividad').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function verActividad(){ 
    var param_opcion = 'seleccionar_actividad';
    var codigo = document.getElementById('param_actividad').value;
    $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&codigo=' +codigo,
      url: '../../controller/controlEvento/inscripcion_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $("#param_actividadID").val(objeto[0]);
          $("#param_nombreActividad").val(objeto[1]);
          $("#param_precio").val(objeto[2]);

      },
      error: function(data){
                 
      }
    }); 
}

function activarActividades(){ 
    //var param_opcion = 'seleccionar_actividad';
    var param_paquete = document.getElementById('param_paquete').value;
    var param_evento = document.getElementById('param_evento').value;

    if (param_evento == '') {
      alert('Seleccione primero el evento a participar.');
      document.getElementById('param_paquete').value = '';      
    } else {
      if (param_paquete == '1') {
        document.getElementById('param_actividad').disabled = true;
        llenarActividades();
        mostrarNeto();
      } else {
        if (param_paquete == '2') {
          document.getElementById('param_actividad').disabled = false;
          var tb = $('#tablaDetalleActividades').DataTable();
          tb
            .clear()
            .draw();
          document.getElementById('param_montoNeto').value = ''; 
          document.getElementById('param_monto').value = ''; 
        }
      }
    }

    
    /*$.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion+'&codigo=' +codigo,
      url: '../../controller/controlEvento/inscripcion_controller.php',
      success: function(data){
          objeto=JSON.parse(data);
          $("#param_actividadID").val(objeto[0]);
          $("#param_nombreActividad").val(objeto[1]);
          $("#param_precio").val(objeto[2]);

      },
      error: function(data){
                 
      }
    }); */
}

function agregarActividad() {
    
    var t = $('#tablaDetalleActividades').DataTable();

    $('#addLinea').on( 'click', function () {
    	document.getElementById('param_descuento').disabled = true; 
    	var actividad           = document.getElementById('param_actividad').value;
      var actividadID         = document.getElementById('param_actividadID').value;                
      var descripcion         = document.getElementById('param_nombreActividad').value;
      var precio              = document.getElementById('param_precio').value;
      



      if (actividad == '') {
        alert('Seleccione una actividad.');
      } else {
        if (codigoActividad.indexOf(actividadID) >= 0) {
          alert('Ya se ha agregado la actividad seleccionada.');
        } else {
        	counter++;
          t.row.add( [
          	
            '<center>'+actividadID+'</center>',
            '<center>'+descripcion+'</center>',
            '<center>'+precio+'</center>', 
            '<center><button class="btn btn-danger btn-xs center deleteValid" onclick="Eliminar('+"'"+actividadID+"'"+','+"'"+precio+"'"+')">Eliminar</button></center>',            
            //'<button class="btn btn-danger btn-xs center deleteValid" onclick="Eliminar('+"'"+codigo+"'"+')">Eliminar</button>',
          ] ).draw( false );
          
          //cursoId.push(codigo);
          codigoActividad.push(actividadID);
          montoActividadesTotal = montoActividadesTotal + parseFloat(precio);
          document.getElementById('param_actividad').value = ''; 
          document.getElementById('param_actividadID').value = ''; 
          document.getElementById('param_nombreActividad').value = ''; 
            
          
          document.getElementById('param_montoNeto').value = montoActividadesTotal;  

          var descuento           = document.getElementById('param_descuento').value;
          var desc= 0;
          var importe= 0;
          var descontar= 0;

          desc = descuento;
          if (desc > 0)
            {                       
                desc  = montoActividadesTotal * (desc/100);
                descontar = desc;           
            } else {
                descuento = 0;
            }

            importe = montoActividadesTotal - descontar;

            document.getElementById('param_monto').value=importe.toFixed(2);  

          console.log(codigoActividad.toString());
        }      
      }       
    });

    $('#tablaDetalleActividades tbody').on( 'click', 'button', function () {
        t
            .row( $(this).parents('tr') )
            .remove()
            .draw();
    });   

    $('#param_descuento').on('blur', function () {
       
        var desc = document.getElementById('param_descuento').value;
        var montoNeto = document.getElementById('param_montoNeto').value;
        var montoTotal = document.getElementById('param_monto').value;

        descPorcentaje = desc;
        
        var montodescuento = montoNeto * (descPorcentaje/100);
        respuesta = parseFloat(montoNeto) - parseFloat(montodescuento);        
        document.getElementById('param_monto').value=respuesta.toFixed(2);

    });
 
}

function Eliminar(codigo, precio) {  
    //alert(codigo);
    counter--;
    var pos = codigoActividad.indexOf(codigo);
    codigoActividad.splice(pos, 1);
    montoActividadesTotal = montoActividadesTotal - parseFloat(precio);
    document.getElementById('param_montoNeto').value = montoActividadesTotal;
    var montoNeto = document.getElementById('param_montoNeto').value;
    var descuento = document.getElementById('param_descuento').value;
    eliminarDescuento  = parseFloat(montoNeto) * (descuento/100);
    document.getElementById('param_monto').value=eliminarDescuento.toFixed(2);  

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

function mostrarMonto() {  
  var condicion =  $('input:radio[name=param_condicion]:checked').val();    
  //alert(condicion);
  if (condicion == 'N') {
    document.getElementById('param_descuento').value = '0';     
    document.getElementById('param_descuento').disabled = true; 
    var desc = document.getElementById('param_descuento').value;
    var montoNeto = document.getElementById('param_montoNeto').value;
    var montoTotal = document.getElementById('param_monto').value;

    descPorcentaje = desc;
    
    var montodescuento = montoNeto * (descPorcentaje/100);
    respuesta = parseFloat(montoNeto) - parseFloat(montodescuento);
    //alert(desPP);
    //neto = parseFloat(desPP) + parseFloat(respuesta);
    //totalBI = montodescuento+totalBI;
    //alert(totalBI);
    document.getElementById('param_monto').value=respuesta.toFixed(2);

  } else {
    if (condicion == 'B') {
      document.getElementById('param_descuento').value = '100'; 
      document.getElementById('param_descuento').disabled = true;
      var desc = document.getElementById('param_descuento').value;
      var montoNeto = document.getElementById('param_montoNeto').value;
      var montoTotal = document.getElementById('param_monto').value;

      descPorcentaje = desc;
      
      var montodescuento = montoNeto * (descPorcentaje/100);
      respuesta = parseFloat(montoNeto) - parseFloat(montodescuento);
      //alert(desPP);
      //neto = parseFloat(desPP) + parseFloat(respuesta);
      //totalBI = montodescuento+totalBI;
      //alert(totalBI);
      document.getElementById('param_monto').value=respuesta.toFixed(2); 
    } else {
      if (condicion == 'D') {
        document.getElementById('param_descuento').value = ''; 
        document.getElementById('param_descuento').disabled = false; 
      }
    }
  }
}


function llenarActividades(){
    var opcion = 'llenar_totas_actividades';
    var param_evento = document.getElementById('param_evento').value;
    $.ajax({
        type: 'POST',
        data:'param_opcion='+opcion+'&codigo='+param_evento,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
            //$('#cuerpoActividades').DataTable().destroy();
            $('#cuerpoActividades').html(data);
            //$('#cuerpoActividades').DataTable();
        },
        error: function(data){
        }
    });
}

function mostrarNeto(){
    var opcion = 'obtener_neto';
    var param_evento = document.getElementById('param_evento').value;
    $.ajax({
        type: 'POST',
        data:'param_opcion='+opcion+'&codigo='+param_evento,
        url: '../../controller/controlEvento/inscripcion_controller.php',
        success: function(data){
          objeto=JSON.parse(data);
          $("#param_montoNeto").val(objeto[0]);
          $("#param_monto").val(objeto[0]);            
        },
        error: function(data){
        }
    });
}



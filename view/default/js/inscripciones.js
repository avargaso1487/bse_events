window.codigoActividad = [];
var counter = 0;
window.onload = function(){       
    mostrarMenu();
    mostrarTipoDocumentoPago();
    mostrarPaquetes();   
    mostrarActividades();   
    $('#tablaDetalleActividades').dataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    }); 
    //$('#tablaProveedorLinea').dataTable(); 
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
      var table = $('#tablaDetalleActividades').DataTable();
      if (param_participanteID == '' || param_paquete == '' || param_banco == '' || param_nroOperacion == '' || Voucher == '') {
      	alert('Ingrese todos los campos requeridos');
      } else {
      	var formData = new FormData($("#frmParticipantes")[0]);
      	formData.append("codigoActividad", codigoActividad);
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
	        document.getElementById('param_nombreActividad').value= '';
	        $('#Voucher').ace_file_input('reset_input');
	        codigoActividad = [];	 
	        counter = 0;   
	        table
                .clear()
                .draw();     
          });
      }
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
    var param_opcion = 'combo_actividades';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
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

      },
      error: function(data){
                 
      }
    }); 
}

function agregarActividad() {
    
    var t = $('#tablaDetalleActividades').DataTable();

    $('#addLinea').on( 'click', function () {
    	
    	var actividad             = document.getElementById('param_actividad').value;
        var actividadID             = document.getElementById('param_actividadID').value;                
        var descripcion         = document.getElementById('param_nombreActividad').value;
  
      if (actividad == '') {
        alert('Seleccione una actividad.');
      } else {
        if (codigoActividad.indexOf(actividadID) >= 0) {
          alert('Ya se ha agregado la actividad seleccionada.');
        } else {
        	counter++;
          t.row.add( [
          	
            '<center>'+counter+'</center>',
            '<center>'+descripcion+'</center>', 
            '<center><button class="btn btn-danger btn-xs center deleteValid" onclick="Eliminar('+"'"+actividadID+"'"+')">Eliminar</button></center>',            
            //'<button class="btn btn-danger btn-xs center deleteValid" onclick="Eliminar('+"'"+codigo+"'"+')">Eliminar</button>',
          ] ).draw( false );
          
          //cursoId.push(codigo);
          codigoActividad.push(actividadID);
          document.getElementById('param_actividad').value = ''; 
          document.getElementById('param_actividadID').value = ''; 
          document.getElementById('param_nombreActividad').value = '';        
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
}

function Eliminar(codigo) {  
    //alert(codigo);
    counter--;
    var pos = codigoActividad.indexOf(codigo);
    codigoActividad.splice(pos, 1);
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
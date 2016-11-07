
window.onload = function(){    
    $('#tablaPonentes').DataTable();    
    //$('#tablaDetalleLineas').DataTable();  
    mostrarMenu();  
    comboDocumentoIdentidad(); 
    mostrarPonentes();
}

$(function() {
   $('#new_ponente').on('click', function(){
       //alert('Agregar Proveeor');        
       $('#cabeceraRegistro').html(".:: Nuevo Ponente ::.");
       //document.getElementById('imagen').value= ''; 
       $('#imagen').ace_file_input('reset_input');
       $('#modalPonentes').modal({
            show:true,
            backdrop:'static',
        });          
    }); 

   $('#register_ponentes').on('click', function(){
      var param_funcion = document.getElementById('param_funcion').value;
      var param_nombres = document.getElementById('param_nombres').value;
      var param_apellidos = document.getElementById('param_apellidos').value;
      var param_tipoDocumento = document.getElementById('param_tipoDocumento').value;
      var param_nroDocumento = document.getElementById('param_nroDocumento').value;
      var param_email = document.getElementById('param_email').value;                
      if (param_funcion == 'N') {       
        if (param_nombres == '' || param_apellidos == '' || param_email == '' || param_nroDocumento == '' || param_tipoDocumento == '') {
          $('#mensaje').html('<p class="alert alert-danger">Ingrese los campos requeridos.</p>').show(200).delay(1200).hide(200);
        } else {
          var formData = new FormData($("#frmPonentes")[0]);
          $.ajax({
            url: '../../controller/controlMantenedores/ponente_controller.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false,
          }).done(function(resp){
            //alert(resp);
            $('#modalPonentes').modal('hide');
            $('#mensaje2').html('<p class="alert alert-success">El ponente ha sido registrado correctamente.</p>').show(200).delay(1200).hide(200);
            mostrarPonentes();
            
          });
        }
        
      } else {
        //alert('Modificar ponente');
        if (param_nombres == '' || param_apellidos == '' || param_email == '' || param_nroDocumento == '' || param_tipoDocumento == '') {
          $('#mensaje').html('<p class="alert alert-danger">Ingrese los campos requeridos.</p>').show(200).delay(1200).hide(200);
        } else {
          var formData = new FormData($("#frmPonentes")[0]);
          $.ajax({
            url: '../../controller/controlMantenedores/ponente_controller.php',
            type:'POST',
            data:formData,
            cache:false,
            processData:false,
            contentType:false,
          }).done(function(resp){
            //alert(resp);
            $('#modalPonentes').modal('hide');
            $('#mensaje2').html('<p class="alert alert-success">El registro seleccionado ha sido modificado correctamente.</p>').show(200).delay(1200).hide(200);
            mostrarPonentes();
            
          });
        }
      }
    });

   $('#cancel_ponentes').on('click', function(){
        $('#modalPonentes').modal('hide');
        document.getElementById('param_nombres').value= '';
        document.getElementById('param_apellidos').value= '';
        document.getElementById('param_tipoDocumento').value= '';  
        document.getElementById('param_nroDocumento').value= ''; 
        document.getElementById('param_telefonoFijo').value= '';
        document.getElementById('param_email').value= '';
        document.getElementById('param_celular').value= '';
        document.getElementById('param_carreraProfesional').value= '';
        document.getElementById('param_fechaNacimiento').value= '';
        document.getElementById('param_nacionalidad').value= '';
        document.getElementById('param_estadoLaboral').value= '';
        document.getElementById('param_resumenHojaVida').value= '';
        document.getElementById('param_centroTrabajo').value= '';
        document.getElementById('param_direccion').value= '';
        $('#imagen').ace_file_input('reset_input');
        document.getElementById('param_opcion').value= 'new_ponente';        
        mostrarPonentes();
                       
    }); 

   $('#cancel_informacion').on('click', function(){
        $('#modalInformacion').modal('hide');        
        mostrarPonentes();
                       
    }); 

});

function editar(ponente){ 
  //alert(ponente);
  $('#cabeceraRegistro').html(".:: Editar Ponente ::.");
  $('#modalPonentes').modal({
      show:true,
      backdrop:'static',
  });
  document.getElementById('param_funcion').value= 'M';
  document.getElementById('param_opcion').value= 'update_ponente';
  document.getElementById('param_codigo').value= ponente;
  var param_opcion = 'recuperar_datos'
  $.ajax({
      type: 'POST',
      data:'param_opcion='+param_opcion+'&param_codigo='+ponente,
      url: '../../controller/controlMantenedores/ponente_controller.php',
      success: function(data){
        objeto=JSON.parse(data);
        $("#param_nombres").val(objeto[0]);        
        $("#param_apellidos").val(objeto[1]);
        document.getElementById('param_tipoDocumento').value = (objeto[2]);
        $("#param_nroDocumento").val(objeto[3]);
        $("#param_direccion").val(objeto[4]);
        $("#param_telefonoFijo").val(objeto[5]);
        $("#param_email").val(objeto[6]);
        $("#param_celular").val(objeto[7]);
        $("#param_carreraProfesional").val(objeto[8]);
        $("#param_fechaNacimiento").val(objeto[9]);
        $("#param_nacionalidad").val(objeto[10]);
        $("#param_estadoLaboral").val(objeto[11]);
        $("#param_resumenHojaVida").val(objeto[12]);
        $("#param_centroTrabajo").val(objeto[13]);
        $('#imagen').ace_file_input('reset_input');
        if (objeto[14] == '') {
          $('#mensajeCV').html('<p><strong>OJO: </strong>No tiene CV registrado.</p>');
        } else {
          $('#mensajeCV').html('<p><strong>OJO: </strong>Tiene CV registrado.</p>');
        }
      },
      error: function(data){

      }
  });
}

function eliminar(ponente){
  var respuesta = confirm('¿Desea desactivar el ponente seleccionado?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'eliminar_ponente';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+ponente,
            url: '../../controller/controlMantenedores/ponente_controller.php',
            success: function(data){
                //alert('La sucursal ha sido descativada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">El ponente seleccionado ha sido descativado correctamente</p>').show(200).delay(1200).hide(200);
                mostrarPonentes();
            },
            error: function(data){
                $('#cuerpoPonentes').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarPonentes();
    }
  }   
}

function descargar(ruta){
  //alert(ruta);
  open(ruta,'','top=50,left=50,width=1200,height=500') ; 
  
}

function activar(ponente){
  var respuesta = confirm('¿Desea activar el ponente seleccionado?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'active_ponente';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+ponente,
            url: '../../controller/controlMantenedores/ponente_controller.php',
            success: function(data){
                //alert('La sucursal ha sido activada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">El ponente ha sido activado correctamente</p>').show(200).delay(1200).hide(200);
                mostrarPonentes();
            },
            error: function(data){
                $('#cuerpoPonentes').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarPonentes();
    }
  }   
}

function detalles(ponente){
  //alert(ponente);
  $('#cabeceraRegistro2').html(".:: Información de Ponente ::.");   
  $('#modalInformacion').modal({
      show:true,
      backdrop:'static',
  });
  var param_opcion = 'recuperar_datos'
  $.ajax({
      type: 'POST',
      data:'param_opcion='+param_opcion+'&param_codigo='+ponente,
      url: '../../controller/controlMantenedores/ponente_controller.php',
      success: function(data){
        objeto=JSON.parse(data);
        $('#nombres').html(objeto[0] +' ' +objeto[1]);
        $('#tipoDoc').html(objeto[16]);
        $('#nroDoc').html(objeto[3]);
        $('#direccion').html(objeto[4]);        
        $('#telefono').html(objeto[5]);        
        $('#email').html(objeto[6]); 
        $('#celular').html(objeto[7]); 
        $('#carreraProfesional').html(objeto[8]);
        $('#fechaNacimiento').html(objeto[9]);
        $('#nacionalidad').html(objeto[10]);
        $('#estadoLaboral').html(objeto[11]);
        $('#hojaVida').html(objeto[12]);
        $('#centroTrabajo').html(objeto[13]);        
      },
      error: function(data){

      }
  });    
  }

function comboDocumentoIdentidad(){ 
    var param_opcion = 'combo_tipoDocumento';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: '../../controller/controlMantenedores/ponente_controller.php',
        success: function(data){
            $('#documentoIdentidad').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function mostrarPonentes(){ 
  var param_opcion = 'mostrar_ponente'; 
  var codigo = 0;
  $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion,
      url: '../../controller/controlMantenedores/ponente_controller.php',
      success: function(data){
          $('#tablaPonentes').DataTable().destroy();
          $('#cuerpoPonentes').html(data);
          $('#tablaPonentes').DataTable();

      },
      error: function(data){
                 
      }
  });    
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
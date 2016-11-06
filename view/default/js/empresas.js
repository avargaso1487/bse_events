
window.onload = function(){    
    $('#tablaEmpresas').DataTable();    
    //$('#tablaDetalleLineas').DataTable();  
    mostrarMenu();  
    mostrarEmpresas(); 
}

$(function() {
    $('#new_empresa').on('click', function(){ 
       $('#cabeceraRegistro').html(".:: Nueva Empresa ::.");
       $('#modalEmpresas').modal({
            show:true,
            backdrop:'static',
        });          
    }); 

    $('#register_empresa').on('click', function(){
      var param_funcion = document.getElementById('param_funcion').value;
      if (param_funcion == 'N') {        
        var param_razonSocial = document.getElementById('param_razonSocial').value;
        var param_direccion = document.getElementById('param_direccion').value;
        var param_ruc = document.getElementById('param_ruc').value;
        var param_opcion = 'new_empresa';  
        if (param_razonSocial == '' || param_direccion == '' || param_ruc =='') {
          //alert('Ingresar todos los campos');
          $('#mensaje').html('<p class="alert alert-danger">Ingrese todos los campos.</p>').show(200).delay(1200).hide(200);
        } else {
          $.ajax({
            type: 'POST',        
            data:'param_opcion='+param_opcion+'&param_razonSocial='+param_razonSocial+'&param_direccion=' +param_direccion+
            '&param_ruc=' +param_ruc,
            url: '../../controller/controlMantenedores/empresas_controller.php',
            success: function(data){
                alert('Registro Correcto');
                document.getElementById('param_razonSocial').value= '';
                document.getElementById('param_direccion').value= '';                
                document.getElementById('param_ruc').value= '';                
                $('#modalEmpresas').modal('hide');
                $('#mensaje2').html('<p class="alert alert-success">Se registro correctamente la empresa.</p>').show(200).delay(1200).hide(200);
                mostrarEmpresas();
                
            },
            error: function(data){
                       
            }
          });
        }
      } else {
        //alert('Modificar empresa');
        var param_razonSocial = document.getElementById('param_razonSocial').value;
        var param_direccion = document.getElementById('param_direccion').value;
        var param_ruc = document.getElementById('param_ruc').value;
        var param_opcion = 'update_empresa';  
        var param_codigo = document.getElementById('param_codigo').value;
        if (param_razonSocial == '' || param_direccion == '' || param_ruc =='') {
          $('#mensaje').html('<p class="alert alert-danger">Ingrese todos los campos.</p>').show(200).delay(1200).hide(200);
        } else {
          $.ajax({
            type: 'POST',        
            data:'param_opcion='+param_opcion+'&param_razonSocial='+param_razonSocial+'&param_direccion=' +param_direccion+
            '&param_ruc=' +param_ruc+'&param_codigo=' +param_codigo,
            url: '../../controller/controlMantenedores/empresas_controller.php',
            success: function(data){
                //alert('Registro Correcto');
                document.getElementById('param_razonSocial').value= '';
                document.getElementById('param_direccion').value= '';                
                document.getElementById('param_ruc').value= '';                
                $('#modalEmpresas').modal('hide');
                $('#mensaje2').html('<p class="alert alert-success">Se modifico correctamente la empresa seleccionada</p>').show(200).delay(1200).hide(200);
                mostrarEmpresas();
                
            },
            error: function(data){
                       
            }
          });
        }
      }
    });

    $('#cancel_empresa').on('click', function(){
        $('#modalEmpresas').modal('hide');
        document.getElementById('param_razonSocial').value= '';
        document.getElementById('param_direccion').value= '';
        document.getElementById('param_ruc').value= '';  
        document.getElementById('param_codigo').value= ''; 
        document.getElementById('param_funcion').value= 'N';
        mostrarEmpresas();
                  
    }); 
});

function mostrarEmpresas(){ 
  var param_opcion = 'mostrar_empresas'; 
  var codigo = 0;
  $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion,
      url: '../../controller/controlMantenedores/empresas_controller.php',
      success: function(data){
          $('#tablaEmpresas').DataTable().destroy();
          $('#cuerpoEmpresas').html(data);
          $('#tablaEmpresas').DataTable();

      },
      error: function(data){
                 
      }
  });    
}

function editar(codigo){ 
  //alert(codigo);
  $('#cabeceraRegistro').html(".:: Editar Empresa ::.");
  $('#modalEmpresas').modal({
      show:true,
      backdrop:'static',
  });
  document.getElementById('param_funcion').value= 'M';
  document.getElementById('param_codigo').value= codigo;
  var param_opcion = 'recuperar_datos'
  $.ajax({
      type: 'POST',
      data:'param_opcion='+param_opcion+'&param_codigo='+codigo,
      url: '../../controller/controlMantenedores/empresas_controller.php',
      success: function(data){
        objeto=JSON.parse(data);
        $("#param_razonSocial").val(objeto[1]);
        $("#param_ruc").val(objeto[2]);
        $("#param_direccion").val(objeto[3]);
      },
      error: function(data){

      }
  });
}

function eliminar(empresa){
  var respuesta = confirm('¿Desea desactivar la empresa seleccionada?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'eliminar_empresa';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+empresa,
            url: '../../controller/controlMantenedores/empresas_controller.php',
            success: function(data){
                //alert('La empresa ha sido descativada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">La empresa ha sido descativada correctamente</p>').show(200).delay(1200).hide(200);
                mostrarEmpresas();
            },
            error: function(data){
                $('#cuerpoEmpresas').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarEmpresas();
    }
  }   
}

function activar(empresa){
  var respuesta = confirm('¿Desea activar la empresa seleccionada?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'active_empresa';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+empresa,
            url: '../../controller/controlMantenedores/empresas_controller.php',
            success: function(data){
                //alert('La empresa ha sido activada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">La empresa ha sido activada correctamente</p>').show(200).delay(1200).hide(200);
                mostrarEmpresas();
            },
            error: function(data){
                $('#cuerpoEmpresas').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarEmpresas();
    }
  }   
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
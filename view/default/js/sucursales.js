
window.onload = function(){    
    $('#tablaSucursal').DataTable();    
    //$('#tablaDetalleLineas').DataTable();  
    mostrarMenu();
    mostrarSucursales();  
    comboEmpresa();
}

$(function() {
   $('#new_sucursal').on('click', function(){
       //alert('Agregar Proveeor');
       document.getElementById('param_nombres').value= '';
       document.getElementById('param_direccion').value= '';
       document.getElementById('param_empresa').value= '';
               
       $('#cabeceraRegistro').html(".:: Nueva Sucursal ::.");
       $('#modalSucursal').modal({
            show:true,
            backdrop:'static',
        });          
    }); 

   $('#register_sucursal').on('click', function(){
      var param_funcion = document.getElementById('param_funcion').value;
      if (param_funcion == 'N') {        
        var param_nombres = document.getElementById('param_nombres').value;
        var param_direccion = document.getElementById('param_direccion').value;
        var param_empresa = document.getElementById('param_empresa').value;
        var param_opcion = 'new_sucursal';  
        if (param_nombres == '' || param_direccion == '' || param_empresa =='') {
          //alert('Ingresar todos los campos');
          $('#mensaje').html('<p class="alert alert-danger">Ingrese todos los campos.</p>').show(200).delay(1200).hide(200);
        } else {
          $.ajax({
            type: 'POST',        
            data:'param_opcion='+param_opcion+'&param_nombres='+param_nombres+'&param_direccion=' +param_direccion+
            '&param_empresa=' +param_empresa,
            url: '../../controller/controlMantenedores/sucursal_controller.php',
            success: function(data){
                //alert('Registro Correcto');
                document.getElementById('param_nombres').value= '';
                document.getElementById('param_direccion').value= '';                
                document.getElementById('param_empresa').value= '';                
                $('#modalSucursal').modal('hide');
                $('#mensaje2').html('<p class="alert alert-success">Se registro correctamente la sucursal.</p>').show(200).delay(1200).hide(200);
                mostrarSucursales();
                
            },
            error: function(data){
                       
            }
          });
        }
      } else {
        //alert('Modificar sucursal');
        var param_nombres = document.getElementById('param_nombres').value;
        var param_direccion = document.getElementById('param_direccion').value;
        var param_empresa = document.getElementById('param_empresa').value;
        var param_opcion = 'update_sucursal';  
        var param_codigo = document.getElementById('param_codigo').value;
        if (param_nombres == '' || param_direccion == '' || param_empresa =='') {
          $('#mensaje').html('<p class="alert alert-danger">Ingrese todos los campos.</p>').show(200).delay(1200).hide(200);
        } else {
          $.ajax({
            type: 'POST',        
            data:'param_opcion='+param_opcion+'&param_nombres='+param_nombres+'&param_direccion=' +param_direccion+
            '&param_empresa=' +param_empresa+'&param_codigo=' +param_codigo,
            url: '../../controller/controlMantenedores/sucursal_controller.php',
            success: function(data){
                //alert('Registro Correcto');
                document.getElementById('param_nombres').value= '';
                document.getElementById('param_direccion').value= '';                
                document.getElementById('param_empresa').value= '';                
                $('#modalSucursal').modal('hide');
                $('#mensaje2').html('<p class="alert alert-success">Se modifico correctamente la sucursal seleccionada</p>').show(200).delay(1200).hide(200);
                mostrarSucursales();
                
            },
            error: function(data){
                       
            }
          });
        }
      }
    });

    $('#cancel_sucural').on('click', function(){
        $('#modalSucursal').modal('hide');
        document.getElementById('param_nombres').value= '';
        document.getElementById('param_direccion').value= '';
        document.getElementById('param_empresa').value= '';  
        document.getElementById('param_codigo').value= ''; 
        document.getElementById('param_funcion').value= 'N';
        mostrarSucursales();
                  
    }); 
});

function comboEmpresa(){ 
    var param_opcion = 'combo_empresa';    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: '../../controller/controlMantenedores/sucursal_controller.php',
        success: function(data){
            $('#empresa').html(data);

        },
        error: function(data){
                   
        }
    });    
}

function mostrarSucursales(){ 
  var param_opcion = 'mostrar_sucursal'; 
  var codigo = 0;
  $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion,
      url: '../../controller/controlMantenedores/sucursal_controller.php',
      success: function(data){
          $('#tablaSucursal').DataTable().destroy();
          $('#cuerpoSucursal').html(data);
          $('#tablaSucursal').DataTable();

      },
      error: function(data){
                 
      }
  });    
}

function editar(codigo){ 
  //alert(codigo);
  $('#cabeceraRegistro').html(".:: Editar sucursal ::.");
  $('#modalSucursal').modal({
      show:true,
      backdrop:'static',
  });
  document.getElementById('param_funcion').value= 'M';
  document.getElementById('param_codigo').value= codigo;
  var param_opcion = 'recuperar_datos'
  $.ajax({
      type: 'POST',
      data:'param_opcion='+param_opcion+'&param_codigo='+codigo,
      url: '../../controller/controlMantenedores/sucursal_controller.php',
      success: function(data){
        objeto=JSON.parse(data);
        $("#param_nombres").val(objeto[1]);        
        $("#param_direccion").val(objeto[2]);
        document.getElementById('param_empresa').value = (objeto[3]);
      },
      error: function(data){

      }
  });
}

function eliminar(sucursal){
  var respuesta = confirm('¿Desea desactivar la sucursal seleccionada?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'eliminar_sucursal';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+sucursal,
            url: '../../controller/controlMantenedores/sucursal_controller.php',
            success: function(data){
                //alert('La sucursal ha sido descativada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">La sucursal ha sido descativada correctamente</p>').show(200).delay(1200).hide(200);
                mostrarSucursales();
            },
            error: function(data){
                $('#cuerposucursales').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarSucursales();
    }
  }   
}

function activar(sucursal){
  var respuesta = confirm('¿Desea activar la sucursal seleccionada?');
  if (respuesta == true) {
    //alert('Acepto');
        var param_opcion = 'active_sucursal';
        $.ajax({
            type: 'POST',
            data:'param_opcion='+param_opcion+'&param_codigo='+sucursal,
            url: '../../controller/controlMantenedores/sucursal_controller.php',
            success: function(data){
                //alert('La sucursal ha sido activada correctamente');
                $('#mensaje2').html('<p class="alert alert-success">La sucursal ha sido activada correctamente</p>').show(200).delay(1200).hide(200);
                mostrarSucursales();
            },
            error: function(data){
                $('#cuerposucursales').html(respuesta);
            }
          });
  } else {
    if (respuesta == false) {
      mostrarSucursales();
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
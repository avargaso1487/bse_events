window.onload = function(){    
    $('#tablaUsuarios').DataTable();        
    mostrarMenu();
    mostrarDatosTabla();
    cargarColaboradores();
    cargarRoles();
    $('#cancelar').on('click', function(){                    
      $('#modalUsuarios').hide();  
      $('#exito').hide();
      $('#error').hide();
    }); 
}


function nuevo(){
  limpiar();
  document.getElementById('colaborador').style.display = 'inline';
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarUsuario').style.display = 'inline';
  document.getElementById('editarUsuario').style.display = 'none';
}


function mostrarDatosTabla(){
  var param_opcion = "mostrar";
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion,
    url: '../../controller/controlAccesoSeguridad/usuarios_controller.php',
    success: function(respuesta)
    {
      $('#tablaUsuarios').DataTable().destroy();
      $('#cuerpoUsuarios').html(respuesta);
      $('#tablaUsuarios').DataTable();
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}


function guardar(){
  var param_opcion = "grabar";
  var v1 = 0, v2 = 0, v3 = 0;
  v1 = validacion('param_usuarioColaborador');
  v2 = validacion('param_usuarioLogin');
  v3 = validacion('param_usuarioPassword');
  v4 = validacion('param_usuarioRol');
  

  if(v1 === false || v2 === false || v3 === false || v4 == false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_usuario').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlAccesoSeguridad/usuarios_controller.php',
      success: function(data)
      {
        if (data === '0')
          alert('EXISTE UN REGISTRO PREVIO DE LA OPCIÓN PARA EL SISTEMA. VERIFIQUE EL ESTADO DE ESTE PARA HABILITARLO, EN CASO ESTÉ DESHABILITADO.');
        else  
        {
          if(data === '1')  
          {            
            alert("REGISTRO EXITOSO");            
            mostrarDatosTabla();
          }
        }               
        $("#modalUsuarios").hide();
        mostrarDatosTabla();
      }
    });
  }
}


function validacion(campo)
{
  var a=0;
  if(campo === 'param_usuarioColaborador')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {                       
      $('#'+campo).parent().parent().attr("class", "input-group col-md-12 has-error");            
            return false;
    }
    else 
    {     
      $('#'+campo).parent().parent().attr("class", "input-group col-md-12 has-success");            
      return true;
    }
  }


  if(campo === 'param_usuarioLogin')
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

  if(campo === 'param_usuarioPassword')
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

  if(campo === 'param_usuarioRol')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "input-group col-md-12 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "input-group col-md-12 has-success");            
      return true;
    }
  }
  
}


function limpiar(){  
  $('#exito').hide();
  $('#error').hide(); 
  
  $('#param_usuarioColaborador').parent().parent().attr("class", "input-group col-md-12");
  $('#param_usuarioLogin').parent().parent().attr("class", "form-group col-md-8");
  $('#param_usuarioPassword').parent().parent().attr("class", "form-group col-md-8");     
  $('#param_usuarioRol').parent().parent().attr("class", "input-group col-md-12");     

  document.getElementById('param_personaId').value = "";
  document.getElementById('param_usuarioColaborador').value = "";
  document.getElementById('param_usuarioLogin').value = "";
  document.getElementById('param_usuarioPassword').value = "";    
  document.getElementById('param_usuarioRol').value = "";    
}


function editarDetalle(codigo){
  nuevo();
  obtenerDatosDetalle(codigo);    
  document.getElementById('editarUsuario').style.display = 'inline';
  document.getElementById('guardarUsuario').style.display = 'none';
  //deshabilitar(false);
}

function obtenerDatosDetalle(codigo){
  var param_opcion = "mostrarDetalle";
  //console.log('codigo: '+codigo);
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_usuarioColaborador='+codigo,
    url: '../../controller/controlAccesoSeguridad/usuarios_controller.php',
    success: function(datos)
    {     
      //console.log(datos);
      objeto = JSON.parse(datos);
            
      document.getElementById('param_personaId').value = objeto[0];      
      document.getElementById('colaborador').style.display = 'none';
      //document.getElementById('param_usuarioColaborador').value = (objeto[0]);
      document.getElementById('param_usuarioLogin').value = objeto[1];
      document.getElementById('param_usuarioRol').value = objeto[2];            
    },
    error: function(data)
    {
      alert('ERROR AL OBTENER LOS DATOS');
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
}


function editar()
{
  var param_opcion = "editar";  
  var param_personaId = document.getElementById('param_personaId').value;

  var v1 = 0, v2 = 0, v3 = 0;
  //v1 = validacion('param_usuarioColaborador');
  v2 = validacion('param_usuarioLogin');
  v3 = validacion('param_usuarioPassword');
  

  if(v2 === false || v3 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_usuario').serialize()+'&param_opcion='+param_opcion+'&param_usuarioColaborador='+param_personaId,
      url: '../../controller/controlAccesoSeguridad/usuarios_controller.php',
      success: function(data)
      {
        
        alert("DATOS ACTUALIZADOS CORRECTAMENTE");                        
        $("#modalUsuarios").hide();
        limpiar();
        mostrarDatosTabla();
      }
    });
  }
}

function eliminar(codigo, valor)
{ 
  var param_opcion = "eliminar";    
  $.ajax({
    type:'POST',
    data:'param_opcion='+param_opcion+'&param_usuarioColaborador='+codigo+'&param_usuarioEstado='+valor,
    url: '../../controller/controlAccesoSeguridad/usuarios_controller.php',
    success: function(respuesta)
    {           
      mostrarDatosTabla();
    },
    error: function(respuesta)
    {
      alert("ERROR AL ELIMINAR EL REGISTRO");
    }
  });
}

function cargarColaboradores()
{
  var param_opcion = "comboPersonalUsuario";
  $.ajax({
    type:'POST',
    data:'param_opcion='+param_opcion,
    url: '../../controller/controlAccesoSeguridad/personal_controller.php',
    success:function(respuesta)
    {
      $('#grupo').html(respuesta);
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}

function cargarRoles()
{
  var param_opcion = "comboRoles";
  $.ajax({
    type:'POST',
    data:'param_opcion='+param_opcion,
    url: '../../controller/controlParametros/roles_controller.php',
    success:function(respuesta)
    {
      $('#rol').html(respuesta);
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}
window.seleccionados = [];
window.onload = function(){    
    $('#tablaPermisos').DataTable();        
    mostrarMenu();    
    //cargarColaboradores();
    cargarRoles();
    $('#cancelar').on('click', function(){                    
      $('#modalPermisos').hide();  
      $('#exito').hide();
      $('#error').hide();
    });        
}

/*
function nuevo(){
  limpiar();
  document.getElementById('colaborador').style.display = 'inline';
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarUsuario').style.display = 'inline';
  document.getElementById('editarUsuario').style.display = 'none';
}
*/

function mostrarDatosTablaPermisos(){
  var param_opcion = "mostrarPermisos";
  var param_usuarioRol = document.getElementById('param_usuarioRol').value;
  //console.log('kjbkjb');
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_usuarioRol='+param_usuarioRol,
    url: '../../controller/controlAccesoSeguridad/permisos_controller.php',
    success: function(respuesta)
    {
      $('#tablaPermisos').DataTable().destroy();
      $('#cuerpoPermisos').html(respuesta);
      $('#tablaPermisos').DataTable();
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}

function mostrarDatosTablaTareas(){
  var param_opcion = "mostrarTareas";
  var param_usuarioRol = document.getElementById('param_usuarioRol').value;
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_usuarioRol='+param_usuarioRol,
    url: '../../controller/controlAccesoSeguridad/permisos_controller.php',
    success: function(respuesta)
    {
      $('#tablaTareas').DataTable().destroy();
      $('#cuerpoTareas').html(respuesta);
      $('#tablaTareas').DataTable();
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}

function checkselected(cb){
  if(cb.checked)
  {
    seleccionados.push(cb.value);
  }
  else
  {
    var index = seleccionados.indexOf(cb.value);
    seleccionados.splice(index, 1);
  }  
}

function guardar(){
  var param_opcion = "asignar";  

  if($('#tablaTareas').dataTable().fnGetData().length==0){
    $('#exito').hide();
    $('#error').html('<strong>ERROR: </strong>No hay opciones disponibles para asignar al rol seleccionado.').show(500).delay(8500).hide(500);
  }
  else    
  {
    if(seleccionados.length==0)
    {
      $('#exito').hide();
      $('#error').html('<strong>ERROR: </strong>No se ha seleccionado ninguna opción para asignarle al rol.').show(500).delay(8500).hide(500);   
    }
    else
    {          
      var param_usuarioRol = document.getElementById('param_usuarioRol').value;
      $.ajax({
        type: 'POST',
        data: '&param_opcion='+param_opcion+'&param_tareaId='+seleccionados+'&param_usuarioRol='+param_usuarioRol,
        url: '../../controller/controlAccesoSeguridad/permisos_controller.php',
        success: function(data)
        {
          console.log(data);
          if (data === '0')
            alert('EXISTE UN REGISTRO PREVIO DE LA OPCIÓN PARA EL SISTEMA. VERIFIQUE EL ESTADO DE ESTE PARA HABILITARLO, EN CASO ESTÉ DESHABILITADO.');
          else  
          {
            if(data === '1')  
            {            
              alert("REGISTRO EXITOSO");            
              mostrarDatosTablaPermisos();
            }
          }               
          $("#modalPermisos").hide();
          seleccionados = [];          
        }
      });
      
    }    
  }
}

function eliminar(codigo, valor)
{ 
  var param_opcion = "eliminar";    
  $.ajax({
    type:'POST',
    data:'param_opcion='+param_opcion+'&param_permisoId='+codigo+'&param_permisoEstado='+valor,
    url: '../../controller/controlAccesoSeguridad/permisos_controller.php',
    success: function(respuesta)
    {           
      mostrarDatosTablaPermisos();
    },
    error: function(respuesta)
    {
      alert("ERROR AL ELIMINAR EL REGISTRO");
    }
  });
}

/*
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
*/

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

function mostrarMenu()
{
  $.ajax({
        type:'POST',
        data: {opcion:'mostrarMenu'},        
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                            
            $('#permisos').html(data);                
        }
    });
}

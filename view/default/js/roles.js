window.onload = function(){    
    $('#tablaRoles').DataTable();        
    mostrarMenu();
    mostrarDatosTabla();
    $('#cancelar').on('click', function(){                    
      $('#modalRoles').hide();  
      $('#exito').hide();
      $('#error').hide();
    }); 
}


function nuevo(){
  limpiar();
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarRol').style.display = 'inline';
  document.getElementById('editarRol').style.display = 'none';
}


function mostrarDatosTabla(){
  var param_opcion = "mostrar";
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion,
    url: '../../controller/controlParametros/roles_controller.php',
    success: function(respuesta)
    {
      $('#tablaRoles').DataTable().destroy();
      $('#cuerpoRoles').html(respuesta);
      $('#tablaRoles').DataTable();
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
  v1 = validacion('param_rol');
  v2 = validacion('param_rolDescripcion');  

  if(v1 === false || v2 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_rol').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/roles_controller.php',
      success: function(data)
      {
        if (data === '0')
          alert('EXISTE UN REGISTRO PREVIO DEL ROL PARA EL SISTEMA. VERIFIQUE EL ESTADO DE ESTE PARA HABILITARLO, EN CASO ESTÉ DESHABILITADO.');
        else  
        {
          if(data === '1')  
          {            
            alert("REGISTRO EXITOSO");            
            mostrarDatosTabla();
          }
        }               
        $("#modalRoles").hide();
        mostrarDatosTabla();
      }
    });
  }
}


function validacion(campo)
{
  var a=0;
  if(campo === 'param_rol')
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


  if(campo === 'param_rolDescripcion')
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


function limpiar(){  
  $('#exito').hide();
  $('#error').hide(); 
  
  $('#param_rol').parent().parent().attr("class", "form-group col-md-12");
  $('#param_rolDescripcion').parent().parent().attr("class", "form-group col-md-12");  

  document.getElementById('param_rol').value = "";
  document.getElementById('param_rolDescripcion').value = "";  
}


function editarDetalle(codigo){
  limpiar();  
  obtenerDatosDetalle(codigo);    
  document.getElementById('editarRol').style.display = 'inline';
  document.getElementById('guardarRol').style.display = 'none';
  //deshabilitar(false);
}

function obtenerDatosDetalle(codigo){
  var param_opcion = "mostrarDetalle";
  //console.log('codigo: '+codigo);
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_rolId='+codigo,
    url: '../../controller/controlParametros/roles_controller.php',
    success: function(datos)
    {     
      //console.log(datos);
      objeto = JSON.parse(datos);
            
      document.getElementById('param_rolId').value = objeto[0];
      document.getElementById('param_rol').value = (objeto[1]);
      document.getElementById('param_rolDescripcion').value = objeto[2];      
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
  var v1 = 0, v2 = 0, v3 = 0;
  v1 = validacion('param_rol');
  v2 = validacion('param_rolDescripcion');
  

  if(v1 === false || v2 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_rol').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/roles_controller.php',
      success: function(data)
      {
        
        alert("DATOS ACTUALIZADOS CORRECTAMENTE");                        
        $("#modalRoles").hide();
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
    data:'param_opcion='+param_opcion+'&param_rolId='+codigo+'&param_rolEstado='+valor,
    url: '../../controller/controlParametros/roles_controller.php',
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

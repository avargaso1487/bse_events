window.onload = function(){    
    $('#tablaGrupos').DataTable();        
    mostrarMenu();
    mostrarDatosTabla();
    $('#cancelar').on('click', function(){                    
      $('#modalGrupos').hide();  
      $('#exito').hide();
      $('#error').hide();
    }); 
}


function nuevo(){
  limpiar();
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarGrupo').style.display = 'inline';
  document.getElementById('editarGrupo').style.display = 'none';
}


function mostrarDatosTabla(){
  var param_opcion = "mostrar";
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion,
    url: '../../controller/controlParametros/grupos_controller.php',
    success: function(respuesta)
    {
      $('#tablaGrupos').DataTable().destroy();
      $('#cuerpoGrupos').html(respuesta);
      $('#tablaGrupos').DataTable();
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
  v1 = validacion('param_grupo');
  v2 = validacion('param_grupoDescripcion');
  v3 = validacion('param_grupoOrden');

  if(v1 === false || v2 === false || v3 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_grupo').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/grupos_controller.php',
      success: function(data)
      {
        if (data === '0')
          alert('EXISTE UN REGISTRO PREVIO DEL GRUPO PARA EL SISTEMA. VERIFIQUE EL ESTADO DE ESTE PARA HABILITARLO, EN CASO ESTÉ DESHABILITADO.');
        else  
        {
          if(data === '1')  
          {            
            alert("REGISTRO EXITOSO");            
            mostrarDatosTabla();
          }
        }               
        $("#modalGrupos").hide();
        mostrarDatosTabla();
      }
    });
  }
}


function validacion(campo)
{
  var a=0;
  if(campo === 'param_grupo')
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


  if(campo === 'param_grupoDescripcion')
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


  if(campo === 'param_grupoOrden')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-3 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-3 has-success");            
      return true;
    }
  }
}


function limpiar(){  
  $('#exito').hide();
  $('#error').hide(); 
  
  $('#param_grupo').parent().parent().attr("class", "form-group col-md-12");
  $('#param_grupoDescripcion').parent().parent().attr("class", "form-group col-md-12");
  $('#param_grupoOrden').parent().parent().attr("class", "form-group col-md-3");   

  document.getElementById('param_grupo').value = "";
  document.getElementById('param_grupoDescripcion').value = "";
  document.getElementById('param_grupoOrden').value = "";  
}


function editarDetalle(codigo){
  limpiar();  
  obtenerDatosDetalle(codigo);    
  document.getElementById('editarGrupo').style.display = 'inline';
  document.getElementById('guardarGrupo').style.display = 'none';
  //deshabilitar(false);
}

function obtenerDatosDetalle(codigo){
  var param_opcion = "mostrarDetalle";
  //console.log('codigo: '+codigo);
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_grupoId='+codigo,
    url: '../../controller/controlParametros/grupos_controller.php',
    success: function(datos)
    {     
      //console.log(datos);
      objeto = JSON.parse(datos);
            
      document.getElementById('param_grupoId').value = objeto[0];
      document.getElementById('param_grupo').value = (objeto[1]);
      document.getElementById('param_grupoDescripcion').value = objeto[2];
      document.getElementById('param_grupoOrden').value = objeto[3];      
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
  v1 = validacion('param_grupo');
  v2 = validacion('param_grupoDescripcion');
  v3 = validacion('param_grupoOrden');

  if(v1 === false || v2 === false || v3 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_grupo').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/grupos_controller.php',
      success: function(data)
      {
        
        alert("DATOS ACTUALIZADOS CORRECTAMENTE");                        
        $("#modalGrupos").hide();
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
    data:'param_opcion='+param_opcion+'&param_grupoId='+codigo+'&param_grupoEstado='+valor,
    url: '../../controller/controlParametros/grupos_controller.php',
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

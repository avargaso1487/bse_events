window.onload = function(){    
    $('#tablaOpciones').DataTable();        
    mostrarMenu();
    mostrarDatosTabla();
    cargarGrupos();
    $('#cancelar').on('click', function(){                    
      $('#modalOpciones').hide();
      $('#exito').hide();
      $('#error').hide();
    }); 
}


function nuevo(){
  limpiar();
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarOpcion').style.display = 'inline';
  document.getElementById('editarOpcion').style.display = 'none';
}


function mostrarDatosTabla(){
  var param_opcion = "mostrar";
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion,
    url: '../../controller/controlParametros/opciones_controller.php',
    success: function(respuesta)
    {
      $('#tablaOpciones').DataTable().destroy();
      $('#cuerpoOpciones').html(respuesta);
      $('#tablaOpciones').DataTable();
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
  v1 = validacion('param_opcionGrupo');
  v2 = validacion('param_tarea');
  v3 = validacion('param_tareaDescripcion');
  v4 = validacion('param_tareaOrden');
  v5 = validacion('param_tareaUrl');

  if(v1 === false || v2 === false || v3 === false || v4 === false || v5 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_opcion').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/opciones_controller.php',
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
        $("#modalOpciones").hide();
        mostrarDatosTabla();
      }
    });
  }
}


function validacion(campo)
{
  var a=0;
  if(campo === 'param_opcionGrupo')
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


  if(campo === 'param_tarea')
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


  if(campo === 'param_tareaDescripcion')
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

  if(campo === 'param_tareaOrden')
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

  if(campo === 'param_tareaUrl')
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
  
  $('#param_opcionGrupo').parent().parent().attr("class", "input-group col-md-12");
  $('#param_tarea').parent().parent().attr("class", "form-group col-md-12");
  $('#param_tareaDescripcion').parent().parent().attr("class", "form-group col-md-12");   
  $('#param_tareaOrden').parent().parent().attr("class", "form-group col-md-3");   
  $('#param_tareaUrl').parent().parent().attr("class", "form-group col-md-12");   

  document.getElementById('param_tareaId').value = "";
  document.getElementById('param_opcionGrupo').value = "";
  document.getElementById('param_tarea').value = "";  
  document.getElementById('param_tareaDescripcion').value = "";  
  document.getElementById('param_tareaOrden').value = "";  
  document.getElementById('param_tareaUrl').value = "";  
}


function editarDetalle(codigo){
  limpiar();  
  obtenerDatosDetalle(codigo);    
  document.getElementById('editarOpcion').style.display = 'inline';
  document.getElementById('guardarOpcion').style.display = 'none';
  //deshabilitar(false);
}

function obtenerDatosDetalle(codigo){
  var param_opcion = "mostrarDetalle";
  //console.log('codigo: '+codigo);
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_tareaId='+codigo,
    url: '../../controller/controlParametros/opciones_controller.php',
    success: function(datos)
    {     
      //console.log(datos);
      objeto = JSON.parse(datos);
            
      document.getElementById('param_tareaId').value = objeto[0];
      document.getElementById('param_opcionGrupo').value = (objeto[1]);
      document.getElementById('param_tarea').value = objeto[2];
      document.getElementById('param_tareaDescripcion').value = objeto[3];      
      document.getElementById('param_tareaOrden').value = objeto[4];      
      document.getElementById('param_tareaUrl').value = objeto[5];
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
  v1 = validacion('param_opcionGrupo');
  v2 = validacion('param_tarea');
  v3 = validacion('param_tareaDescripcion');
  v4 = validacion('param_tareaOrden');
  v5 = validacion('param_tareaUrl');

  if(v1 === false || v2 === false || v3 === false || v4 === false || v5 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_opcion').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlParametros/opciones_controller.php',
      success: function(data)
      {
        
        alert("DATOS ACTUALIZADOS CORRECTAMENTE");                        
        $("#modalOpciones").hide();
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
    data:'param_opcion='+param_opcion+'&param_tareaId='+codigo+'&param_tareaEstado='+valor,
    url: '../../controller/controlParametros/opciones_controller.php',
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

function cargarGrupos()
{
  var param_opcion = "comboGrupos";
  $.ajax({
    type:'POST',
    data:'param_opcion='+param_opcion,
    url: '../../controller/controlParametros/grupos_controller.php',
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


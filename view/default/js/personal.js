window.onload = function(){    
    $('#tablaColaboradores').DataTable();        
    mostrarMenu();
    mostrarDatosTabla();
    cargarEmpresas();
    $('#cancelar').on('click', function(){                    
      $('#modalColaboradores').hide();  
      $('#exito').hide();
      $('#error').hide();
    }); 
    /*$('#param_colaboradorEmpresa').on('select', function(){     
      alert('jhfvjh');               
      cargarSucursales();        
    }); */
}


function nuevo(){
  limpiar();
  document.getElementById('cancelar').style.display = 'inline';
  document.getElementById('guardarPersonal').style.display = 'inline';
  document.getElementById('editarPersonal').style.display = 'none';
}


function mostrarDatosTabla(){
  var param_opcion = "mostrar";
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion,
    url: '../../controller/controlAccesoSeguridad/personal_controller.php',
    success: function(respuesta)
    {
      $('#tablaColaboradores').DataTable().destroy();
      $('#cuerpoColaboradores').html(respuesta);
      $('#tablaColaboradores').DataTable();
    },
    error: function(respuesta)
    {
      alert("ERROR AL MOSTRAR DATOS");
    }
  });
}


function guardar(){
  var param_opcion = "grabar";
  var v1 = 0, v2 = 0, v3 = 0, v4 = 0, v5 = 0, v6 = 0, v7 = 0, v8 = 0, v9 = 0, v10 = 0, v11 = 0, v12 = 0;
  v1 = validacion('param_colaboradorEmpresa');
  v2 = validacion('param_colaboradorSucursal');
  v3 = validacion('param_colaboradorNombre');
  v4 = validacion('param_colaboradorApellidos');
  v5 = validacion('param_colaboradorDNI');

  v6 = validacion('param_colaboradorDireccion');
  v7 = validacion('param_colaboradorNacimiento');
  v8 = validacion('param_colaboradorFijo');

  v9 = validacion('param_colaboradorMovil');
  v10 = validacion('param_colaboradorMail');
  v11 = validacion('param_colaboradorCodigo');
  v11 = validacion('param_colaboradorCodigo');
  v12 = validacion('param_colaboradorIngreso');


  if(v1 === false || v2 === false || v3 === false || v4 === false || v5 === false || v6 === false || v7 === false || v8 === false || v9 === false || v10 === false || v11 === false || v12 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_colaborador').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlAccesoSeguridad/personal_controller.php',
      success: function(data)
      {
        if (data === '0')
          alert('EXISTE UN REGISTRO PREVIO DEL MISMO COLABORADOR PARA EL SISTEMA. VERIFIQUE EL ESTADO DE ESTE PARA HABILITARLO, EN CASO ESTÉ DESHABILITADO.');
        else  
        {
          if(data === '1')  
          {            
            alert("REGISTRO EXITOSO");            
            mostrarDatosTabla();
          }
        }               
        $("#modalColaboradores").hide();
        mostrarDatosTabla();
      }
    });
  }
}


function validacion(campo)
{      
  var a=0;
  if(campo === 'param_colaboradorCodigo')
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

  if(campo === 'param_colaboradorEmpresa')
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


  if(campo === 'param_colaboradorSucursal')
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


  if(campo === 'param_colaboradorNombre')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-6 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-6 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorApellidos')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-6 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-6 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorDNI')
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

  if(campo === 'param_colaboradorDireccion')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorNacimiento')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorFijo')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorMovil')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
      return true;
    }
  }

  if(campo === 'param_colaboradorMail')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-9 has-success");            
      return true;
    }
  }  

  if(campo === 'param_colaboradorIngreso')
  {
    codigo = document.getElementById(campo).value;
    if(codigo ==null || codigo.length ==0)
    {     
      
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-error");            
            return false;
    }
    else 
    {           
      $('#'+campo).parent().parent().attr("class", "form-group col-md-4 has-success");            
      return true;
    }
  }
}


function limpiar(){  
  $('#exito').hide();
  $('#error').hide(); 
  
  $('#param_colaboradorCodigo').parent().parent().attr("class", "form-group col-md-12");   
  $('#param_colaboradorEmpresa').parent().parent().attr("class", "input-group col-md-12");
  $('#param_colaboradorSucursal').parent().parent().attr("class", "input-group col-md-12");
  $('#param_colaboradorNombre').parent().parent().attr("class", "form-group col-md-6");   
  $('#param_colaboradorApellidos').parent().parent().attr("class", "form-group col-md-6");   
  $('#param_colaboradorDNI').parent().parent().attr("class", "form-group col-md-3");   

  $('#param_colaboradorDireccion').parent().parent().attr("class", "form-group col-md-9");
  $('#param_colaboradorNacimiento').parent().parent().attr("class", "form-group col-md-4");
  $('#param_colaboradorFijo').parent().parent().attr("class", "form-group col-md-4");   
  $('#param_colaboradorMovil').parent().parent().attr("class", "form-group col-md-4");   
  $('#param_colaboradorMail').parent().parent().attr("class", "form-group col-md-9");   
  $('#param_colaboradorIngreso').parent().parent().attr("class", "form-group col-md-4");   
  
  document.getElementById('param_colaboradorCodigo').value = "";
  document.getElementById('param_colaboradorEmpresa').value = "";
  document.getElementById('param_colaboradorSucursal').value = "";  
  document.getElementById('param_colaboradorNombre').value = "";  
  document.getElementById('param_colaboradorApellidos').value = "";  
  document.getElementById('param_colaboradorDNI').value = "";  

  document.getElementById('param_colaboradorDireccion').value = "";
  document.getElementById('param_colaboradorNacimiento').value = "";  
  document.getElementById('param_colaboradorFijo').value = "";  
  document.getElementById('param_colaboradorMovil').value = "";  
  document.getElementById('param_colaboradorMail').value = "";  
  document.getElementById('param_colaboradorIngreso').value = "";  
}


function editarDetalle(dni){    
  limpiar();    
  obtenerDatosDetalle(dni);    
  document.getElementById('editarPersonal').style.display = 'inline';
  document.getElementById('guardarPersonal').style.display = 'none';
  //deshabilitar(false);
}

function obtenerDatosDetalle(dni){
  var param_opcion = "mostrarDetalle";
  //console.log('codigo: '+codigo);
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_colaboradorDNI='+dni,
    url: '../../controller/controlAccesoSeguridad/personal_controller.php',
    success: function(datos)
    {       
    console.log(datos);    
      objeto = JSON.parse(datos);
                  
      document.getElementById('param_colaboradorCodigo').value = objeto[0];
      document.getElementById('param_colaboradorEmpresa').value = (objeto[1]);      
      cargarSucursales(objeto[2]);
      //document.getElementById('param_colaboradorSucursal').value = objeto[2];
      document.getElementById('param_colaboradorNombre').value = objeto[3];      
      document.getElementById('param_colaboradorApellidos').value = objeto[4];      
      document.getElementById('param_colaboradorDNI').value = objeto[5];

      document.getElementById('param_colaboradorDireccion').value = (objeto[6]);
      document.getElementById('param_colaboradorNacimiento').value = objeto[7];
      document.getElementById('param_colaboradorFijo').value = objeto[8];      
      document.getElementById('param_colaboradorMovil').value = objeto[9];      
      document.getElementById('param_colaboradorMail').value = objeto[10];
      document.getElementById('param_colaboradorIngreso').value = objeto[11];       
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
  var v1 = 0, v2 = 0, v3 = 0, v4 = 0, v5 = 0, v6 = 0, v7 = 0, v8 = 0, v9 = 0, v10 = 0, v11 = 0, v12 = 0;
  v1 = validacion('param_colaboradorEmpresa');
  v2 = validacion('param_colaboradorSucursal');
  v3 = validacion('param_colaboradorNombre');
  v4 = validacion('param_colaboradorApellidos');
  v5 = validacion('param_colaboradorDNI');

  v6 = validacion('param_colaboradorDireccion');
  v7 = validacion('param_colaboradorNacimiento');
  v8 = validacion('param_colaboradorFijo');

  v9 = validacion('param_colaboradorMovil');
  v10 = validacion('param_colaboradorMail');
  v11 = validacion('param_colaboradorCodigo');
  v11 = validacion('param_colaboradorCodigo');
  v12 = validacion('param_colaboradorIngreso');


  if(v1 === false || v2 === false || v3 === false || v4 === false || v5 === false || v6 === false || v7 === false || v8 === false || v9 === false || v10 === false || v11 === false || v12 === false){
    $('#exito').hide();
    $('#error').html('<strong>Adventencia: </strong>Los campos resaltados deben ser llenados de forma obligatoria.').show(500).delay(8500).hide(500);
  }
  else
  {
    //alert('jb');
    $.ajax({
      type: 'POST',
      data: $('#form_colaborador').serialize()+'&param_opcion='+param_opcion,
      url: '../../controller/controlAccesoSeguridad/personal_controller.php',
      success: function(data)
      {
        
        alert("DATOS ACTUALIZADOS CORRECTAMENTE");                        
        $("#modalColaboradores").hide();
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
    data:'param_opcion='+param_opcion+'&param_colaboradorDNI='+codigo+'&param_colaboradorEstado='+valor,
    url: '../../controller/controlAccesoSeguridad/personal_controller.php',
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

function cargarEmpresas(){ 
  var param_opcion = 'mostrar_empresas_cbo'; 
  var codigo = 0;
  $.ajax({
      type: 'POST',        
      data:'param_opcion='+param_opcion,
      url: '../../controller/controlMantenedores/empresa_controller.php',
      success: function(respuesta){
          $('#empresa').html(respuesta);
      },
      error: function(data){
                 
      }
  });    
}

function cargarSucursales(sucursal){
  var param_colaboradorEmpresa = document.getElementById('param_colaboradorEmpresa').value;
  var param_opcion = 'comboSucursal';
  $.ajax({
    type: 'POST',
    data: 'param_opcion='+param_opcion+'&param_colaboradorEmpresa='+param_colaboradorEmpresa+'&param_colaboradorSucursal='+sucursal,
    url: '../../controller/controlAccesoSeguridad/personal_controller.php',
    success: function(respuesta){      
      $('#sucursal').html(respuesta);
    },
    error: function(data){

    }
  });
}
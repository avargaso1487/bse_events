
window.onload = function(){    
    $('#tablaSucursal').DataTable();    
    //$('#tablaDetalleLineas').DataTable();  
    mostrarMenu();  
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
       alert('Agregar Sucursal');       
    }); 
});

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
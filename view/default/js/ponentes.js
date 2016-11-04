
window.onload = function(){    
    $('#tablaPonentes').DataTable();    
    //$('#tablaDetalleLineas').DataTable();    
}

$(function() {
   $('#new_ponente').on('click', function(){
       //alert('Agregar Proveeor');
       //document.getElementById('param_nombres').value= '';
       
        
       $('#cabeceraRegistro').html(".:: Nuevo Ponente ::.");
       $('#modalPonentes').modal({
            show:true,
            backdrop:'static',
        });          
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
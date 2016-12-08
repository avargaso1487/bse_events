
window.onload = function(){       
    mostrarMenu();
    $('#tablaAsistencia').dataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    }); 
    mostrarParticipantes();
    mostrarNombre();
}

$(function() {
   

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

function registrarAsistencia(participante)
{    
    var param_actividadID = document.getElementById('param_actividadID').value;
    var param_opcion = 'registro_asistencia';
    //alert(grupo);

    $.ajax({
        type:'POST',
        data:'param_opcion='+param_opcion+'&param_participante='+participante+'&param_actividadID='+param_actividadID,   
        url: "../../controller/controlActividad/asistencia_controller.php",
        success:function(data){                              
            mostrarParticipantes();           
        }
    });
    //alert(participante);
}

function mostrarNombre()
{    
    var param_actividadID = document.getElementById('param_actividadID').value;
    var param_opcion = 'mostrar_nombre';
    $.ajax({
        type:'POST',
        data:'param_opcion='+param_opcion+'&param_actividadID='+param_actividadID,   
        url: "../../controller/controlActividad/asistencia_controller.php",
        success:function(data){                              
            objeto=JSON.parse(data);
           
            $('#nombre').html(objeto[0]);        
        }
    });
    //alert(participante);
}

function mostrarParticipantes()
{    
    var param_actividadID = document.getElementById('param_actividadID').value;
    var param_opcion = 'mostrar_participante';
    //alert(grupo);

    $.ajax({
        type:'POST',
        data:'param_opcion='+param_opcion+'&param_actividadID='+param_actividadID,   
        url: "../../controller/controlActividad/asistencia_controller.php",
        success:function(data){                              
          //$('#tablaAsistencia').DataTable().destroy();
          $('#cuerpoAsistencia').html(data);
          $('#tablaAsistencia').DataTable();               
        }
    });
    //alert("kjb");
}


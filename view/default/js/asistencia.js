
window.onload = function(){       
    mostrarMenu();
    $('#tablaAsistencia').dataTable({
        "bPaginate": false,
        "bFilter": false,
        "bInfo": false
    }); 
    mostrarParticipantes();
    mostrarNombre();
    //
        
    //alert(output);
    //alert(fechaHoy);
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

function validarFecha(actual)
{    
    //var actual = document.getElementById('fechaHoy').value;
    var d = new Date();
    var month = d.getMonth()+1;
    var day = d.getDate();

    var output = d.getFullYear()+ "-"+ (month<10 ? '0' : '') + month +"-"+(day<10 ? '0' : '') + day;




    var Digital=new Date()
    var hours=Digital.getHours()
    var minutes=Digital.getMinutes()    
    var dn="AM" 
    if (hours>12){
        dn="PM"
        hours=hours-12
    }
    if (hours==0)
        hours=12
    if (minutes<=9)
        minutes="0"+minutes

    var horaActual = hours+":"+minutes+" "+dn;
   
    var horaHoyInicio = document.getElementById('horaHoyInicio').value;
    var horaHoyFin = document.getElementById('horaHoyFin').value;

    //alert(horaActual);

    if (horaActual<horaHoyInicio || horaActual>horaHoyFin) {
        alert('No se puede realizar la asistencia, se encuentra fuera de la hora');
        mostrarParticipantesFinal();
    } else {
        if (actual != output) {
            alert('No se puede realizar la asistencia, se encuentra fuera de la fecha');
            mostrarParticipantesFinal();
        }
    }


    
    //alert(actual);
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
            $('#fecha').html(objeto[1]);
            $('#hora').html(objeto[2]); 
            $('#fechaHoy').val(objeto[1]);   
            $('#horaHoyInicio').val(objeto[3]);
            $('#horaHoyFin').val(objeto[4]); 
            var actual = document.getElementById('fechaHoy').value;
            
            validarFecha(actual);
            
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

function mostrarParticipantesFinal()
{    
    var param_actividadID = document.getElementById('param_actividadID').value;
    var param_opcion = 'mostrar_participante_final';
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

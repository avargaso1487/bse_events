window.onload = function(){    
    mostrarMenu();  

    $('#dataTables-example').DataTable(); //SIEMPREEEEEEEEEE
    funcionPrincipal();
    
};

//Declarar variables globales

function funcionPrincipal()
{
	//asignar eventos a componentes html
	//EJM (combo) : $("#idDelCombobox").change(nombreDeLaFuncion);
	listarArticulo();
    limpiar();

}



function listarArticulo()
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'listar'},
        
        url: "../../controller/controlMantenedores/local_controller.php",
        success:function(data){
        		
        
            $('#dataTables-example').DataTable().destroy();
            $('#cuerpoTabla').html(data);
            $('#dataTables-example').DataTable();
          
                                                                    
        }
    });
}




function editarAmbiente(idAmbiente)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscar',param_local_id:idAmbiente},
        dataType: 'json',
        url: "../../controller/controlMantenedores/local_controller.php",
        success:function(data){
                if(data.length > 0)
                {
                   $.each(data, function (i, value) 
                        {
                             $("#codigo_e").val(value["Loc_idLocal"]);
                            $("#descripcion_e").val(value["Loc_descripcion"]);
                           $("#direccion_e").val(value["Loc_direccion"]);
                            
                            
                        });


                }
                           
        }
    });
    document.getElementById("codigo_e").disabled=false;
    document.getElementById("descripcion_e").disabled=false;
    document.getElementById("direccion_e").disabled=false;
    document.getElementById("actualizar").style.display='block';
}




function anularAmbiente(idAmbiente)
{
    

    $.ajax({
        type:'POST',
        data: {param_opcion:'eliminar',param_local_id: idAmbiente},
        url: "../../controller/controlMantenedores/local_controller.php",
        success:function(data)
        {
             	listarArticulo();
                            
        }
    });
    
}




function limpiar()
{
    
     descripcion = document.getElementById("descripcion").value='';
    direccion = document.getElementById("direccion").value='';
    
    

}



function validarCampos()
{
    
   
    
    descripcion = document.getElementById("descripcion").value;
    capacidad = document.getElementById("capacidad").value;
    tipoAmb = document.getElementById("tipoAmb").selectedIndex;
    local = document.getElementById("local").selectedIndex;
   



    if( descripcion == null || descripcion == 0 ) {
    return false;
    }

    if( capacidad == null || capacidad == 0 ) 
    {
    return false;
    }
    
    
    if( tipoAmb == null || tipoAmb == 0 ) 
    {
    return false;
    }
    
    if( local == null || local == 0 ) 
    {
    return false;
    }

 

    
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
    //alert("kjb");
}

function alerta_almacen()
{
    $.ajax({
        type:'POST',
        data: {opcion:'alerta_almacen'},
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                          
            $('#alertaalmacen').html(data);
        }
    }); 
}


function alerta_spa()
{
    $.ajax({
        type:'POST',
        data: {opcion:'alerta_spa'},
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){                          
            $('#alertaspa').html(data);
        }
    }); 
}
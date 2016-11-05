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
	mostrarTipo();
    mostrarLocal();
    mostrarTipo_e();
    mostrarLocal_e();
    limpiar();

}



function listarArticulo()
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'listar'},
        
        url: "../../controller/controlambiente/ambiente_controller.php",
        success:function(data){
        		
        
            $('#dataTables-example').DataTable().destroy();
            $('#cuerpoTabla').html(data);
            $('#dataTables-example').DataTable();
          
                                                                    
        }
    });
}

function mostrarTipo(){ 
    var param_opcion = 'comboT';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlambiente/ambiente_controller.php",
        success: function(data){
            $('#combo1').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}

function mostrarLocal(){ 
    var param_opcion = 'comboL';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlambiente/ambiente_controller.php",
        success: function(data){
            $('#combo2').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}

function mostrarTipo_e(){ 
    var param_opcion = 'comboT_e';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlambiente/ambiente_controller.php",
        success: function(data){
            $('#combo1_e').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}

function mostrarLocal_e(){ 
    var param_opcion = 'comboL_e';
    
    $.ajax({
        type: 'POST',        
        data:'param_opcion='+param_opcion,
        url: "../../controller/controlambiente/ambiente_controller.php",
        success: function(data){
            $('#combo2_e').html(data);
            
            

        },
        error: function(data){
                   
        }
    });    
}



function editarAmbiente(idAmbiente)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscar',param_ambiente_id:idAmbiente},
        dataType: 'json',
        url: "../../controller/controlambiente/ambiente_controller.php",
        success:function(data){
                if(data.length > 0)
                {
                   $.each(data, function (i, value) 
                        {
                             $("#codigo_e").val(value["Amb_idAmbiente"]);
                            $("#descripcion_e").val(value["Amb_descripcion"]);
                            $("#capacidad_e").val(value["Amb_capacidad"]);
                            $("#tipoAmb_e").val(value["TipAm_idTipoAmbiente"]);
                            $("#local_e").val(value["Loc_idLocal"]);
                            
                            
                        });

                }
                            
        }
    });
    document.getElementById("codigo_e").disabled=false;
    document.getElementById("descripcion_e").disabled=false;
    document.getElementById("capacidad_e").disabled=false;
    document.getElementById("tipoAmb_e").disabled=false;
    document.getElementById("local_e").disabled=false;
    document.getElementById("actualizar").style.display='block';
}


function mostrarAmbiente(idAmbiente)
{
    $.ajax({
        type:'POST',
        data: {param_opcion:'buscar',param_ambiente_id:idAmbiente},
        dataType: 'json',
        url: "../../controller/controlambiente/ambiente_controller.php",
        success:function(data){
                if(data.length > 0)
                {
                   $.each(data, function (i, value) 
                        {
                            $("#codigo_e").val(value["Amb_idAmbiente"]);
                            $("#descripcion_e").val(value["Amb_descripcion"]);
                            $("#capacidad_e").val(value["Amb_capacidad"]);
                            $("#tipoAmb_e").val(value["TipAm_idTipoAmbiente"]);
                            $("#local_e").val(value["Loc_idLocal"]);
                            
                            
                        });

                }
                            
        }
    });
    document.getElementById("codigo_e").disabled=true;
    document.getElementById("descripcion_e").disabled=true;
    document.getElementById("capacidad_e").disabled=true;
    document.getElementById("tipoAmb_e").disabled=true;
    document.getElementById("local_e").disabled=true;
    document.getElementById("actualizar").style.display='none';
    

}


function anularAmbiente(idAmbiente)
{
    

    $.ajax({
        type:'POST',
        data: {param_opcion:'eliminar',param_ambiente_id: idAmbiente},
        url: "../../controller/controlambiente/ambiente_controller.php",
        success:function(data)
        {
             	listarArticulo();
                            
        }
    });
    
}


function eliminarArticuloF(idArticulo)
{
    var respuesta = confirm('¿Desea eliminar de forma permanente el artículo?');
    if (respuesta == true) {
    $.ajax({
        type:'POST',
        data: {param_opcion:'eliminarF',param_articulo_id: idArticulo},
        url: "../../controller/controlambiente/ambiente_controller.php",
        success:function(data)
        {
                //alert("Artículo eliminado satisfactoriamente"); 
                listarArticulo();
                          
        },
                error: function(data){
                    alert("No se puede eliminar el artículo");
                }

    });
    }else {
        if (respuesta == false) {
          alert('Se cancelo la eliminación');
        }
    }
}

function limpiar()
{
    
    // document.getElementById("codigobarras").value='';
    // document.getElementById("concepto").value='';
    // document.getElementById("descripcion").value='';
    // document.getElementById("presentacion1").value='';
    // document.getElementById("presentacion2").value='';
    // document.getElementById("proporcion").value='';
    // //document.getElementById("subfamilia").selectedIndex=0;
    // document.getElementById("observaciones").value='';
    // //document.getElementById("stock").value='';
    // document.getElementById("stockminimo").value='';
    // document.getElementById("stock1").value='';
    // document.getElementById("stock2").value='';
    // document.getElementById("costocompra").value='';
    // document.getElementById("precioventa").value='';
    // document.getElementById("precioventa1").value='';
    // document.getElementById("precioventa2").value='';
    // document.getElementById("igv").value='';
    // document.getElementById("tran").checked=false;
    // document.getElementById("presentacion1").disabled=true;
    // document.getElementById("presentacion2").disabled=true;
    // document.getElementById("precioventa").disabled=false;
    // document.getElementById("precioventa1").disabled=true;
    // document.getElementById("precioventa2").disabled=true;
    // document.getElementById("stock1").disabled=true;
    // document.getElementById("stock2").disabled=true;

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
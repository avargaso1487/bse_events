window.onload = function()
{	
	mostrarMenu();	
	alerta_almacen();	
    alerta_spa(); 
};


function mostrarMenu()
{
	$.ajax({
        type:'POST',
        data: {opcion:'mostrarMenu'},        
        url: "../../controller/controlusuario/usuario.php",
        success:function(data){        		                 
            $('#permisos').html(data);                
        }
    });
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
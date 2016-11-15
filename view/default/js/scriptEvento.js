function abrirModal(modal) {
	$(modal).modal({
        show:true,
        backdrop:'static',
    });  
}
function cerrarModal(modal){
        $(modal).modal('hide');
}
function soloNumeroEntero(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = "1234567890";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
function soloNumeroDecimal(e){
	key = e.keycode || e.which;	
	teclado = String.fromCharCode(key).toLowerCase();	
	letras = ".1234567890";
	especiales = "8-37-38-46-164-32-0";
	teclado_especial = false;
	for(var i in especiales){
		if(key == especiales[i]){
			teclado_especial = true;
		}
	}
	if(letras.indexOf(teclado)==-1 && !teclado_especial){		
		return false;
	}
}
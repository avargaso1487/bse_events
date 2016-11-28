var f = new Date();
var año=f.getFullYear();
var mes= f.getMonth()+1;
var hoyDMA = f.getDate()+'-'+mes+'-'+año;


function diferenciaFechasDMA(dateStart,dateEnd){//Dia, Mes Año
	valuesStart=dateStart.split("-");
    valuesEnd = dateEnd.split("-");

    var dateStart = new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
    var dateEnd = new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);
    var dif = dateEnd-dateStart;
    //Si es positivo la fecha final es Mayor
    // - La fecha Inicial es mayor
    // 0 Fechas iguales
    return dif;
}
function GetDias (dateStart,dateEnd) {
	valuesStart=dateStart.split("-");
    valuesEnd = dateEnd.split("-");

    var nuevafecha1= new Date(valuesStart[2],(valuesStart[1]-1),valuesStart[0]);
	var nuevafecha2= new Date(valuesEnd[2],(valuesEnd[1]-1),valuesEnd[0]);

	var Dif= nuevafecha2.getTime() - nuevafecha1.getTime();
	var dias= Math.floor(Dif/(1000*24*60*60));
	return dias;
}
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
window.onload = function () {

    $('#tablaParticipantes').DataTable();

    $('#btn_nuevo_participante').on('click', function () {
        $('#cabeceraRegistro').html(".:: Nuevo Participante ::.");
        $('#modalParticipante').modal({
            show:true,
            backdrop:'static',
        });
        document.getElementById('#nombre_participante').value = '';
        document.getElementById('#apellido_participante').value = '';
        document.getElementById('#dni_participante').value = '';
        document.getElementById('#direccion_participante').value = '';
        document.getElementById('#fechaNacimiento_participante').value = '';
        document.getElementById('#telefonoFijo_participante').value = '';
        document.getElementById('#telefonoFijo_participante').value = '';
        document.getElementById('#email_participante').value = '';
        document.getElementById('#nivel_participante').value = '';
        document.getElementById('#profesion_participante').value = '';
        document.getElementById('#centroTrabajo_participante').value = '';
    })
};

$(function () {

});




function solonumeros(e) {
    key = e.keyCode || e.which;
    teclado = String.fromCharCode(key);
    numeros = "0123456789";
    especiales = "8-37-38-46"
    teclado_especial=false;

    for (var i in especiales) {
        if (key == especiales[i]) {
            teclado_especial= true;
        }
    }

    if (numeros.indexOf(teclado)==-1 && !teclado_especial) {
        return false;
    }
}

function telefonovalidation(e) {
    var unicode = e.charCode ? e.charCode : e.keyCode
    if (unicode != 45 && unicode != 32) {
        if (unicode < 48 || unicode > 57) //if not a number
        { return false } //disable key press
    }
}

function soloLetras(e){
    key = e.keyCode || e.which;
    tecla = String.fromCharCode(key).toLowerCase();
    letras = " áéíóúabcdefghijklmnñopqrstuvwxyz";
    especiales = "8-37-39-46";

    tecla_especial = false
    for(var i in especiales){
        if(key == especiales[i]){
            tecla_especial = true;
            break;
        }
    }

    if(letras.indexOf(tecla)==-1 && !tecla_especial){
        return false;
    }
}

$('#id-input-file-1 , #id-input-file-2').ace_file_input({
    no_file:'Ajuntar Cv...',
    btn_choose:'Choose',
    btn_change:'Change',
    droppable:false,
    onchange:null,
    thumbnail:false //| true | large
    //whitelist:'gif|png|jpg|jpeg'
    //blacklist:'exe|php'
    //onchange:''
    //
});

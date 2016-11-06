window.onload = function () {

    $('#tablaParticipantes').DataTable();

    $('#btn_nuevo_participante').on('click', function () {
        $('#cabeceraRegistro').html(".:: Nuevo Participante ::.");
        $('#modalParticipante').modal({
            show:true,
            backdrop:'static',
        });
        document.getElementById('nombre_participante').value = '';
        document.getElementById('apellido_participante').value = '';
        document.getElementById('dni_participante').value = '';
        document.getElementById('direccion_participante').value = '';
        document.getElementById('fechaNacimiento_participante').value = '';
        document.getElementById('telefonoFijo_participante').value = '';
        document.getElementById('telefonoFijo_participante').value = '';
        document.getElementById('email_participante').value = '';
        document.getElementById('nivel_participante').selectedIndex=0;
        document.getElementById('profesion_participante').value = '';
        document.getElementById('centroTrabajo_participante').value = '';
    });
    
    $('#btn_cancelar_participante').on('click', function () {
        $('#modalParticipante').modal('hide');
    })
    
};

$(function () {

    $('#btn_registrar_participante').on('click', function () {
        var operacion = document.getElementById('operacion').value;
        if (operacion == 'Registrar') {
            var opcion          = 'registrar_participante';
            var nombre          = document.getElementById('nombre_participante').value;
            var apellido        = document.getElementById('apellido_participante').value;
            var dni             = document.getElementById('dni_participante').value;
            var direccion       = document.getElementById('direccion_participante').value;
            var fechaNacimiento = document.getElementById('fechaNacimiento_participante').value;
            var telefonoFijo    = document.getElementById('telefonoFijo_participante').value;
            var telefonoMovil   = document.getElementById('telefonoMovil_participante').value;
            var email           = document.getElementById('email_participante').value;
            var nivel           = document.getElementById('nivel_participante').value;
            var profesion       = document.getElementById('profesion_participante').value;
            var centroTrabajo   = document.getElementById('centroTrabajo_participante').value;

            if (nombre.length == 0 || apellido.length == 0 || dni.length == 0 || fechaNacimiento.length == 0 || email.length == 0 || nivel.selectedIndex == 0 || profesion.length == 0) {
                alert('Completa los campos obligatorios (*)');
            } else {
                if (dni.length != 8) {
                    alert('El D.N.I. debe tener 8 dígitos!');
                } else {
                    $.ajax({
                        type     : 'POST',
                        data     : 'opcion='+opcion+'&nombre='+nombre+'&apellido='+apellido+'&dni='+dni+'&direccion='+direccion+
                                    '&fechaNacimiento='+fechaNacimiento+'&telefonoFijo='+telefonoFijo+'&telefonoMovil='+telefonoMovil+
                                    '&email='+email+'&nivel='+nivel+'&profesion='+profesion+'&centroTrabajo='+centroTrabajo,
                        dataType : 'JSON',
                        url      : '../../controller/controlMantenedores/participante_controller.php',
                        success  : function (data) {
                            if (data.length > 0) {
                                alert('Participante registrado correctamente!');
                                document.getElementById('nombre_participante').value = '';
                                document.getElementById('apellido_participante').value = '';
                                document.getElementById('dni_participante').value = '';
                                document.getElementById('direccion_participante').value = '';
                                document.getElementById('fechaNacimiento_participante').value = '';
                                document.getElementById('telefonoFijo_participante').value = '';
                                document.getElementById('telefonoFijo_participante').value = '';
                                document.getElementById('email_participante').value = '';
                                document.getElementById('nivel_participante').selectedIndex=0;
                                document.getElementById('profesion_participante').value = '';
                                document.getElementById('centroTrabajo_participante').value = '';
                                document.getElementById('operacion').value= 'Registrar';
                                $('#modalParticipante').modal('hide');
                                //mostrarParticipantes();
                            }                        },
                        error    : function (data) {
                            alert('Ocurrió algo inesperado!');
                        }    
                    });
                }
            }

        } else {
            if (operacion == 'Editar') {
                var opcion          = 'editar_participante';
                var nombre          = document.getElementById('nombre_participante').value;
                var apellido        = document.getElementById('apellido_participante').value;
                var dni             = document.getElementById('dni_participante').value;
                var direccion       = document.getElementById('direccion_participante').value;
                var fechaNacimiento = document.getElementById('fechaNacimiento_participante').value;
                var telefonoFijo    = document.getElementById('telefonoFijo_participante').value;
                var telefonoMovil   = document.getElementById('telefonoMovil_participante').value;
                var email           = document.getElementById('email_participante').value;
                var nivel           = document.getElementById('nivel_participante').value;
                var profesion       = document.getElementById('profesion_participante').value;
                var centroTrabajo   = document.getElementById('centroTrabajo_participante').value;
            }
        }
    })

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
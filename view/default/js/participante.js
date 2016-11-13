window.onload = function () {

    $('#tablaParticipantes').DataTable();
    mostrarMenu();
    mostrarParticipantes();

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
                $('#mensaje').html('<p class="alert alert-danger">Ingrese los campos obligatorios (*)</p>').show(200).delay(1500).hide(200);
            } else {
                if (dni.length != 8) {
                    $('#mensaje').html('<p class="alert alert-warning">El DNI debe tener 8 digitos!</p>').show(200).delay(1500).hide(200);
                } else {
                    $.ajax({
                        type     : 'POST',
                        data     : 'opcion='+opcion+'&nombre='+nombre+'&apellido='+apellido+'&dni='+dni+'&direccion='+direccion+
                                    '&fechaNacimiento='+fechaNacimiento+'&telefonoFijo='+telefonoFijo+'&telefonoMovil='+telefonoMovil+
                                    '&email='+email+'&nivel='+nivel+'&profesion='+profesion+'&centroTrabajo='+centroTrabajo,
                        dataType : 'json',
                        encode   : true,
                        url      : '../../controller/controlMantenedores/participante_controller.php',
                        success  : function (data) {
                            if (data == 1) {
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
                                $('#mensaje2').html('<p class="alert alert-success">Participante registrado correctamente.</p>').show(200).delay(1500).hide(200);
                                mostrarParticipantes();
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
}

function mostrarParticipantes(){
    var opcion = 'mostrar_participante';
    $.ajax({
        type: 'POST',
        data:'opcion='+opcion,
        url: '../../controller/controlMantenedores/participante_controller.php',
        success: function(data){
            $('#tablaParticipantes').DataTable().destroy();
            $('#cuerpoParticipantes').html(data);
            $('#tablaParticipantes').DataTable();
        },
        error: function(data){
        }
    });
}

function editar(codigo) {
    $('#cabeceraRegistro').html(".:: Editar Participante ::.");
    $('#modalParticipante').modal({
        show:true,
        backdrop:'static',
    });
    
}

function validateMail(idMail)
{
    //Creamos un objeto
    object=document.getElementById(idMail);
    valueForm=object.value;

    // Patron para el correo
    var patron=/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,4})+$/;
    if(valueForm.search(patron)==0)
    {
        //Mail correcto
        object.style.color="#006400";
        return;
    }
    //Mail incorrecto
    object.style.color="#8B0000";
}

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
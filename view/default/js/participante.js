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
        document.getElementById('nombre_participante').disabled = false;
        document.getElementById('apellido_participante').disabled = false;
        document.getElementById('nombre_participante').disabled = false;
        document.getElementById('dni_participante').disabled = false;
        document.getElementById('direccion_participante').disabled = false;
        document.getElementById('fechaNacimiento_participante').disabled = false;
        document.getElementById('telefonoFijo_participante').disabled = false;
        document.getElementById('telefonoMovil_participante').disabled = false;
        document.getElementById('email_participante').disabled = false;
        document.getElementById('nivel_participante').disabled = false;
        document.getElementById('profesion_participante').disabled = false;
        document.getElementById('centroTrabajo_participante').disabled = false;
        document.getElementById('btn_cancelar_participante').style.display = 'inline';
        document.getElementById('btn_registrar_participante').style.display = 'inline';
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
                                $('#modalParticipante').modal('hide');
                                $('#mensaje2').html('<p class="alert alert-success">Participante registrado correctamente.</p>').show(200).delay(1500).hide(200);
                                mostrarParticipantes();
                            } else {
                                if (data.error_dni){
                                    document.getElementById('dni_participante').focus();
                                    $('#mensaje').html('<p class="alert alert-warning">Cuidado!..El participante ya está registrado.</p>').show(200).delay(2000).hide(200);
                                } else {
                                    alert('Error al registrar los datos del participante.');
                                }
                            }
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
                var codigo          = document.getElementById('codigo').value;

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
                            '&email='+email+'&nivel='+nivel+'&profesion='+profesion+'&centroTrabajo='+centroTrabajo+'&codigoParticipante='+codigo,
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
                                    document.getElementById('telefonoMovil_participante').value = '';
                                    document.getElementById('email_participante').value = '';
                                    document.getElementById('nivel_participante').selectedIndex=0;
                                    document.getElementById('profesion_participante').value = '';
                                    document.getElementById('centroTrabajo_participante').value = '';
                                    document.getElementById('codigo').value = '';
                                    document.getElementById('operacion').value= 'Registrar';
                                    $('#modalParticipante').modal('hide');
                                    $('#mensaje2').html('<p class="alert alert-success">Participante actualizado correctamente.</p>').show(200).delay(1500).hide(200);
                                    mostrarParticipantes();
                                } else {
                                    if (data.error_dni){
                                        document.getElementById('dni_participante').focus();
                                        $('#mensaje').html('<p class="alert alert-warning">Cuidado!..El participante ya está registrado.</p>').show(200).delay(2000).hide(200);
                                    } else {
                                        alert('Error al editar los datos del participante.');
                                    }
                                }
                            }
                        });
                    }
                }
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

function editar(codigoParticipante) {
    $('#cabeceraRegistro').html(".:: Editar Participante ::.");
    object=document.getElementById('email_participante');
    object.style.color="#006400";
    document.getElementById('btn_registrar_participante').disabled = false;
    $('#modalParticipante').modal({
        show:true,
        backdrop:'static',
    });
    document.getElementById('operacion').value = 'Editar';
    document.getElementById('nombre_participante').disabled = false;
    document.getElementById('apellido_participante').disabled = false;
    document.getElementById('nombre_participante').disabled = false;
    document.getElementById('dni_participante').disabled = false;
    document.getElementById('direccion_participante').disabled = false;
    document.getElementById('fechaNacimiento_participante').disabled = false;
    document.getElementById('telefonoFijo_participante').disabled = false;
    document.getElementById('telefonoMovil_participante').disabled = false;
    document.getElementById('email_participante').disabled = false;
    document.getElementById('nivel_participante').disabled = false;
    document.getElementById('profesion_participante').disabled = false;
    document.getElementById('centroTrabajo_participante').disabled = false;
    document.getElementById('btn_cancelar_participante').style.display = 'inline';
    document.getElementById('btn_registrar_participante').style.display = 'inline';
    var opcion = 'datos_participante';
    $.ajax({
        type     : 'POST',
        data     : 'opcion='+opcion+'&codigoParticipante='+codigoParticipante,
        dataType : 'json',
        encode   : true,
        url      : '../../controller/controlMantenedores/participante_controller.php',
        success  : function (data) {
            if (data.length > 0) {
                $.each(data, function (i, value) {
                    $('#codigo').val(value[0]);
                    $('#nombre_participante').val(value[1]);
                    $('#apellido_participante').val(value[2]);
                    $('#dni_participante').val(value[3]);
                    $('#direccion_participante').val(value[4]);
                    $('#fechaNacimiento_participante').val(value[5]);
                    $('#telefonoFijo_participante').val(value[6]);
                    $('#telefonoMovil_participante').val(value[7]);
                    $('#email_participante').val(value[8]);
                    $('#nivel_participante').val(value[9]);
                    $('#profesion_participante').val(value[10]);
                    $('#centroTrabajo_participante').val(value[11]);
                })
            }
        },
        error  : function (data) {
            alert('Error al mostrar los datos del participante.');
        }
    });
}

function mostrarInformacion(codigoParticipante) {
    $('#cabeceraRegistro').html(".:: Información del Participante ::.");
    $('#modalParticipante').modal({
        show:true,
        backdrop:'static',
    });
    var opcion = 'datos_participante';
    $.ajax({
        type     : 'POST',
        data     : 'opcion='+opcion+'&codigoParticipante='+codigoParticipante,
        dataType : 'json',
        url      : '../../controller/controlMantenedores/participante_controller.php',
        success  : function (data) {
            if (data.length > 0) {
                $.each(data, function (i, value) {
                    $('#codigo').val(value[0]);
                    $('#nombre_participante').val(value[1]);
                    $('#apellido_participante').val(value[2]);
                    $('#dni_participante').val(value[3]);
                    $('#direccion_participante').val(value[4]);
                    $('#fechaNacimiento_participante').val(value[5]);
                    $('#telefonoFijo_participante').val(value[6]);
                    $('#telefonoMovil_participante').val(value[7]);
                    $('#email_participante').val(value[8]);
                    $('#nivel_participante').val(value[9]);
                    $('#profesion_participante').val(value[10]);
                    $('#centroTrabajo_participante').val(value[11]);
                    document.getElementById('nombre_participante').disabled = true;
                    document.getElementById('apellido_participante').disabled = true;
                    document.getElementById('nombre_participante').disabled = true;
                    document.getElementById('dni_participante').disabled = true;
                    document.getElementById('direccion_participante').disabled = true;
                    document.getElementById('fechaNacimiento_participante').disabled = true;
                    document.getElementById('telefonoFijo_participante').disabled = true;
                    document.getElementById('telefonoMovil_participante').disabled = true;
                    document.getElementById('email_participante').disabled = true;
                    document.getElementById('nivel_participante').disabled = true;
                    document.getElementById('profesion_participante').disabled = true;
                    document.getElementById('centroTrabajo_participante').disabled = true;
                    document.getElementById('btn_cancelar_participante').style.display = 'none';
                    document.getElementById('btn_registrar_participante').style.display = 'none';
                })
            }
        },
        error  : function (data) {
            alert('Error al mostrar los datos del participante.');
        }
    });
}

function eliminar(codigoParticipante) {
    var respuesta = confirm('¿Desea DAR DE BAJA el participante?');
    if (respuesta == true) {
        var opcion = 'eliminar_participante';
        $.ajax({
            type: 'POST',
            data:  'opcion='+opcion+'&codigoParticipante='+codigoParticipante,
            url: '../../controller/controlMantenedores/participante_controller.php',
            success: function(data){
                $('#mensaje2').html('<p class="alert alert-success">Se eliminó el participante seleccionado.</p>').show(200).delay(2000).hide(200);
                mostrarParticipantes();
            },
            error: function(data){
                $('#cuerpoParticipantes').html(respuesta);
            }
        });
    } else {
        if (respuesta == false) {
            mostrarParticipantes();
        }
    }
}

function activar(codigoParticipante) {
    var respuesta = confirm('¿Desea DAR DE ALTA el participante?');
    if (respuesta == true) {
        var opcion = 'activar_participante';
        $.ajax({
            type: 'POST',
            data:  'opcion='+opcion+'&codigoParticipante='+codigoParticipante,
            url: '../../controller/controlMantenedores/participante_controller.php',
            success: function(data){
                $('#mensaje2').html('<p class="alert alert-success">Se activó el participante seleccionado.</p>').show(200).delay(2000).hide(200);
                mostrarParticipantes();
            },
            error: function(data){
                $('#cuerpoParticipantes').html(respuesta);
            }
        });
    } else {
        if (respuesta == false) {
            mostrarParticipantes();
        }
    }
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
        document.getElementById('btn_registrar_participante').disabled = false;
        return;
    }
    //Mail incorrecto
    object.style.color="#8B0000";
    document.getElementById('btn_registrar_participante').disabled = true;
    document.getElementById('email_participante').focus();
    return;
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
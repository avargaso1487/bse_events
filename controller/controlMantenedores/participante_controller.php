<?php

session_start();
include_once '../../model/modelMantenedores/participante_model.php';

$param = array();
$param['opcion'] = '';
$param['nombre'] = '';
$param['apellido'] = '';
$param['dni'] = '';
$param['direccion'] = '';
$param['fechaNacimiento'] = '';
$param['telefonoFijo'] = '';
$param['telefonoMovil'] = '';
$param['email'] = '';
$param['nivel'] = '';
$param['profesion'] = '';
$param['centroTrabajo'] = '';
$param['codigoParticipante'] = '';


if(isset($_POST['opcion']))
{
    $param['opcion'] = $_POST['opcion'];
}

if(isset($_POST['nombre']))
{
    $param['nombre'] = $_POST['nombre'];
}

if(isset($_POST['apellido']))
{
    $param['apellido'] = $_POST['apellido'];
}

if(isset($_POST['dni']))
{
    $param['dni'] = $_POST['dni'];
}

if(isset($_POST['direccion']))
{
    $param['direccion'] = $_POST['direccion'];
}

if(isset($_POST['fechaNacimiento']))
{
    $param['fechaNacimiento'] = $_POST['fechaNacimiento'];
}

if(isset($_POST['telefonoFijo']))
{
    $param['telefonoFijo'] = $_POST['telefonoFijo'];
}

if(isset($_POST['telefonoMovil']))
{
    $param['telefonoMovil'] = $_POST['telefonoMovil'];
}

if(isset($_POST['email']))
{
    $param['email'] = $_POST['email'];
}

if(isset($_POST['nivel']))
{
    $param['nivel'] = $_POST['nivel'];
}

if(isset($_POST['profesion']))
{
    $param['profesion'] = $_POST['profesion'];
}

if(isset($_POST['centroTrabajo']))
{
    $param['centroTrabajo'] = $_POST['centroTrabajo'];
}

if(isset($_POST['codigoParticipante']))
{
    $param['codigoParticipante'] = $_POST['codigoParticipante'];
}

$Participante = new ParticipanteModel();
echo $Participante->gestionar($param);

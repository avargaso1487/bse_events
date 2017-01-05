<?php 
date_default_timezone_set('America/Lima');
ob_start();
session_start();
$conexion = mysqli_connect("localhost","root","","bse_events");
mysqli_set_charset($conexion, "utf8");
$fechaInicio=$_POST["param_fechaInicio"];
$fechaFin=$_POST["param_fechaFin"];

$tipo=$_POST["tipo"];
$serie=$_POST["serie"];
$numero=$_POST["numero"];
$dni=$_POST["dni"];
$nombre=$_POST["nombre"];
$fecha=$_POST["fecha"];

$nombre_fichero = '../../../../../wamp/www/bse_events/view/Reportes/anchofijo.txt';


if($tipo!="")
{
	$tipo1="TD.abreviatura,' ','' ";
}
else
	$tipo1="";



if($serie!="")
{
	$serie1="'',LPAD(D.DocPago_serieDocumentoPago,4,'0'),' '";
}
else
	$serie1="";



if($numero!="")
{
	$numero1="'',LPAD(D.DocPago_numeroDocumentoPago,6,'0'),' '";
}
else
	$numero1="";


if($dni!="")
{
	$dni1="'',PS.Per_dni,' '";
}
else
	$dni1="";

if($nombre!="")
{
	$nombre1="'',RPAD(concat(PS.Per_nombres,' ',PS.Per_apellidos),80,' '),' '";
}
else
	$nombre1="";


if($fecha!="")
{
	$fecha1="'',date(D.DocPago_fecha)";
}
else
	$fecha1="";


if (file_exists($nombre_fichero)) 
{
unlink('../../../../../wamp/www/bse_events/view/Reportes/anchofijo.txt');
}
//$handle=fopen("datos.txt", "w+");
$genera="select concat(".$tipo1."
	".$serie1."
	".$numero1."
	".$dni1."
".$nombre1."
".$fecha1.") as NombreParticipante
from documentopago D inner join
tipodocumentopago TD on  D.TipDocPago_idTipoDocumentoPago=TD.TipDocPago_idTipoDocumentoPago
inner join Participante P on D.Par_idParticipante=P.Par_idParticipante
inner join Persona PS on P.Per_idPersona=PS.Per_idPersona
where D.DocPago_fecha>='".$fechaInicio."'and D.DocPago_fecha<='".$fechaFin."'
order by D.DocPago_fecha asc
INTO OUTFILE '../../../../../wamp/www/bse_events/view/Reportes/anchofijo.txt' FIELDS TERMINATED BY'\r\n'";

echo $genera;
//$genera2=mysqli_real_escape_string($conexion,$genera);
//echo $genera2;
$query=mysqli_query($conexion,$genera);
$tama=filesize($nombre_fichero);
echo '<input id="valor" value='.$tama.'></input>'
//$handle=fopen("textoDelimitado.txt", "w+");
//fwrite($handle, $query);

 ?>
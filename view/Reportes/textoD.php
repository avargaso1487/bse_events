<?php 
date_default_timezone_set('America/Lima');
ob_start();
session_start();
$conexion = mysqli_connect("localhost","root","","bse_events");
mysqli_set_charset($conexion, "utf8");
$fechaInicio=$_POST["param_fechaInicio"];
$fechaFin=$_POST["param_fechaFin"];
$nombre_fichero = '../../../../../wamp/www/bse_events/view/Reportes/textoDelimitado.txt';
if (file_exists($nombre_fichero)) 
{
unlink('../../../../../wamp/www/bse_events/view/Reportes/textoDelimitado.txt');
}
//$handle=fopen("datos.txt", "w+");
$genera="select concat(TD.abreviatura,'|',LPAD(D.DocPago_serieDocumentoPago,4,'0'),'|',LPAD(D.DocPago_numeroDocumentoPago,6,'0'),'|',PS.Per_dni,'|',
PS.Per_nombres,' ',PS.Per_apellidos,'|') as NombreParticipante 
from documentopago D inner join
tipodocumentopago TD on  D.TipDocPago_idTipoDocumentoPago=TD.TipDocPago_idTipoDocumentoPago
inner join Participante P on D.Par_idParticipante=P.Par_idParticipante
inner join Persona PS on P.Per_idPersona=PS.Per_idPersona
where D.DocPago_fecha>='".$fechaInicio."'and D.DocPago_fecha<='".$fechaFin."'
INTO OUTFILE '../../../../../wamp/www/bse_events/view/Reportes/textoDelimitado.txt' FIELDS TERMINATED BY'\n'";
echo $genera;
$query=mysqli_query($conexion,$genera);
//$handle=fopen("textoDelimitado.txt", "w+");
//fwrite($handle, $query);

 ?>
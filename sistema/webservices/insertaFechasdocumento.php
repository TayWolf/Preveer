<?php 
$fechaVisita=$_REQUEST["fechaVisita"];
$idIdentif=$_REQUEST["idIdentif"];
$coments=$_REQUEST["coments"];

//echo "datos";

$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");

$consulta=$conexion->query("INSERT INTO VisitasInmueble(idAsignacion, fechaAgenda, Status, fechaAplicacion, tipoVisita, comentario) VALUES ($idIdentif,'$fechaVisita',0,'0000-00-00',2,'$coments')");
 ?>
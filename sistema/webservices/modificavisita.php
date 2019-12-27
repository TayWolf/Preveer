<?php 
$idIdentif=$_REQUEST["idIdentif"];
$fechPr=$_REQUEST["fechPr"];
$comentE=$_REQUEST["comentE"];

$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
				if (!empty($fechPr)) {
					$consulta=$conexion->query("UPDATE `VisitasInmueble` SET `fechaAgenda`='$fechPr' WHERE idVisita=$idIdentif");
					}else{}

				if (!empty($comentE)) {
					$consulta=$conexion->query("UPDATE `VisitasInmueble` SET `comentario`='$comentE' WHERE idVisita=$idIdentif");
					}else{}


 ?>
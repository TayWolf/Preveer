<?php 
	   
	   ini_set('error_reporting', E_ALL);

		$usuario=$_REQUEST['usuario'];
		
		$conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
		$consulta=$conexion->query("SELECT asignaInmueble.idAsignacion, CentrosDeTrabajo.nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = '$usuario' AND Oti.statusActiva=1;");
		$datos=array();
		foreach ($consulta as $row)
		{

				$datos[]=$row;
		}

		echo json_encode($datos);

?>
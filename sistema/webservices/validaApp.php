<?php 
	   
	   ini_set('error_reporting', E_ALL);

		$usuario=$_REQUEST['usuario'];
		
		$password=$_REQUEST['password'];


        $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
        $conexion->query("SET CHARACTER SET utf8");
		$consulta=$conexion->query("SELECT Logeo.idUsuario, Logeo.nickName, Logeo.password, Logeo.tipo, Usuario.areaUser, Usuario.nombre FROM Logeo JOIN Usuario ON Logeo.idUsuario=Usuario.idUsuario WHERE (Logeo.nickName='$usuario' and Logeo.password='$password')");
		$datos=array();
		foreach ($consulta as $row)
		{

				$datos[]=$row;
		}

		echo json_encode($datos);

?>
<?php
if(isset($_POST['action'])&&isset($_POST['usuario']))
{
    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
    $conexion->query("SET CHARACTER SET utf8");
    $i=0;
    switch ($_POST['action']) {
        case "getDatosAnalisisRiesgo":
            $usuario = $_POST['usuario'];
            $array=null;
            $consulta = $conexion->query("SELECT Subservicios.idSubservicio, asignaInmueble.idProyecto, CONCAT(CentrosDeTrabajo.nombre, '(OTI ', asignaInmueble.idOti, ')') as nombre, asignaInmueble.idAsignacion, asignaInmueble.idOti FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario = Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE Logeo.idUsuario = $usuario AND Oti.statusActiva=1;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idSubservicio'], $fila['idProyecto'], $fila['nombre'], $fila['idAsignacion'], $fila['idOti']);
            }
            print(json_encode($array));
            break;
    }

    $conexion=null;


}
?>
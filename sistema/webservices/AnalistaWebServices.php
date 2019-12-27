<?php
if(isset($_POST['action'])&&isset($_POST['usuario']))
{
    $conexion=new PDO("mysql:host=localhost;dbname=cointic_preveer2","cointic_dbIntal","+ZsntqoVuVh0");
    $conexion->query("SET CHARACTER SET utf8");
    $i=0;
    switch ($_POST['action']) {
        case "getFormulariosAutoadministrables":
            $array=null;
            $consulta = $conexion->query("SELECT * FROM Aut");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idControl'],$fila['nombreFormulario'],$fila['icono']);
            }
            print(json_encode($array));
            break;
        case "getDatosAnalista":
            $usuario = $_POST['usuario'];
            $array=null;
            $consulta = $conexion->query("SELECT CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombreFormato, asignaInmueble.idOti, asignaInmueble.idCentroTrabajo FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY `asignaInmueble`.`idOti` DESC;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['nombreFormato'], $fila['idOti'], $fila['idCentroTrabajo']);
            }
            print(json_encode($array));
            break;
        case "getDatosFichas":
            $usuario = $_POST['usuario'];
            $array=null;
            $consulta = $conexion->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY asignaInmueble.idOti DESC;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idCentroTrabajo'], $fila['nombre'], $fila['idAsignacion']);
            }
            print(json_encode($array));
            break;
        case "normasOti":
            $usuario = $_POST['usuario'];
            $idOti=$_POST['idOti'];
            $centroTrabajo=$_POST['centroTrabajo'];
            $array=null;
            $consulta = $conexion->query("SELECT Subservicios.idSubservicio, Subservicios.nombre as nombreNorma, asignaInmueble.idAsignacion, asignaInmueble.idOti, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombreFormato FROM CentrosDeTrabajo JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario JOIN Logeo ON Usuario.idUsuario = Logeo.idUsuario join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE asignaInmueble.idOti = $idOti AND Logeo.idUsuario = $usuario AND CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') = '$centroTrabajo' AND Oti.statusActiva=1 ORDER BY asignaInmueble.idOti DESC;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idSubservicio'],$fila['nombreNorma'],$fila['idAsignacion'], $fila['idOti']);
            }
            print(json_encode($array));
            break;
        case "bitacoras":
            $usuario = $_POST['usuario'];
            $array=null;
            $consulta = $conexion->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') AS nombre, asignaInmueble.idAsignacion FROM asignaInmueble JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 GROUP BY asignaInmueble.idOti, CentrosDeTrabajo.idCentroTrabajo ORDER BY `asignaInmueble`.`idOti` DESC;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idCentroTrabajo'],$fila['nombre'],$fila['idAsignacion']);
            }
            print(json_encode($array));

            break;
        case "getTodasBitacoras":
            $array=null;
            $consulta = $conexion->query("SELECT * FROM Bitacora");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idBitacora'],$fila['nombre'],$fila['icono']);
            }
            print(json_encode($array));
            break;
        case "getTodasFichas":
            $array=null;
            $consulta = $conexion->query("SELECT idReporte, nombreReportes FROM Reportes_SSHL");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idReporte'],$fila['nombreReportes']);
            }
            print(json_encode($array));
            break;
        case "getBitacorasAsignacion":
            $usuario = $_POST['usuario'];
            $idAsignacion = $_POST['idAsignacion'];
            $array=null;
            $consulta = $conexion->query("SELECT BitacoraAsignacion.idAsignacion, BitacoraAsignacion.idBitacora FROM asignaInmueble JOIN BitacoraAsignacion ON BitacoraAsignacion.idAsignacion = asignaInmueble.idAsignacion INNER JOIN AnalistaOti ON asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND BitacoraAsignacion.idAsignacion = $idAsignacion AND Oti.statusActiva=1 order by BitacoraAsignacion.idAsignacion DESC, BitacoraAsignacion.idBitacora;");
            foreach ($consulta as $fila)
            {
                $array[$i++]=array($fila['idAsignacion'],$fila['idBitacora']);
            }
            print(json_encode($array));
            break;

    }

    $conexion=null;


}
?>
<?php
if(isset($_REQUEST['usuario']))
{
    $conexion = new PDO("mysql:host=localhost;dbname=cointic_preveer2", "cointic_dbIntal", "+ZsntqoVuVh0");
    $conexion->query("SET CHARACTER SET utf8");
    $tabla = $_REQUEST['tabla'];
//SE TOMA LAS TABLAS COMPLETAS EXCEPTO LAS SIGUIENTES PORQUE CONTIENEN MUCHA INFO

    if($tabla=="asignaInmueble")
    {
        $usuario = $_REQUEST['usuario'];
            $data = $conexion->query("SELECT asignaInmueble.idAsignacion, asignaInmueble.idOti, asignaInmueble.idCentroTrabajo, CONCAT(CentrosDeTrabajo.nombre, ' (OTI ', asignaInmueble.idOti, ')') as nombre, asignaInmueble.idProyecto, CentrosDeTrabajo.idDet FROM $tabla JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo INNER JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion INNER JOIN Oti ON Oti.idOti=asignaInmueble.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1;")->fetchAll(PDO::FETCH_OBJ);
    }
    else if($tabla=="BitacoraAsignacion")
    {
        $usuario = $_REQUEST['usuario'];
        $data = $conexion->query("SELECT BitacoraAsignacion.* FROM asignaInmueble JOIN BitacoraAsignacion ON BitacoraAsignacion.idAsignacion = asignaInmueble.idAsignacion INNER JOIN AnalistaOti ON AnalistaOti.idAsignacion = BitacoraAsignacion.idAsignacion JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE AnalistaOti.idUsuario = $usuario AND Oti.statusActiva=1 order by BitacoraAsignacion.idAsignacion, BitacoraAsignacion.idBitacora; ")->fetchAll(PDO::FETCH_OBJ);
    }
    else if($tabla=="DocNormas")
    {

        $usuario = $_REQUEST['usuario'];
        $data = $conexion->query("SELECT DocNormas.*
                                            FROM DocNormas, Subservicios
                                            WHERE idSubservicio IN
                                                  (SELECT S.idSubservicio
                                                   FROM asignaInmueble
                                                     JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo
                                                     JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia
                                                     JOIN municipios ON regiones.municipio=municipios.idMunicipio
                                                     Join serviciosSubservicios S2 on asignaInmueble.idProyecto = S2.idControl
                                                     JOIN Subservicios S on S2.idSubservicio = S.idSubservicio
                                                     JOIN estados ON municipios.estado=estados.id_Estado
                                                     JOIN AnalistaOti O on asignaInmueble.idAsignacion = O.idAsignacion
                                                     JOIN Oti ON asignaInmueble.idOti = Oti.idOti
                                                   WHERE O.idUsuario=$usuario AND Oti.statusActiva=1
                                                  )
                                                  AND DocNormas.idNorma=Subservicios.idSubservicio")->fetchAll(PDO::FETCH_OBJ);
    }
    else if($tabla=="FormularioAlmacenamiento")
    {
        $usuario = $_REQUEST['usuario'];
        $data = $conexion->query("SELECT FormularioAlmacenamiento.* FROM FormularioAlmacenamiento JOIN FormularioAsignacion Asignacion on FormularioAlmacenamiento.idFormularioAsignacion = Asignacion.idFormularioAsignacion JOIN asignaInmueble on Asignacion.idAsignacion = asignaInmueble.idAsignacion JOIN AnalistaOti on asignaInmueble.idAsignacion = AnalistaOti.idAsignacion JOIN Usuario on AnalistaOti.idUsuario = Usuario.idUsuario JOIN Oti ON asignaInmueble.idOti = Oti.idOti WHERE Usuario.idUsuario = $usuario AND Oti.statusActiva=1; ")->fetchAll(PDO::FETCH_OBJ);
    }
    else
    {
        $data = $conexion->query("SELECT * FROM $tabla")->fetchAll(PDO::FETCH_OBJ);
    }
    $salida = array();
    $i = 0;
    foreach ($data as $datum) {
        $salida[$i++] = ($datum);
    }
    echo json_encode($salida);
}
$conexion=null;

?>
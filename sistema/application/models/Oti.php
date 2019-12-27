<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Oti extends CI_Model{
    public $variable;
    function __construct()
    {
        parent::__construct();
        $this->db->query("SET lc_time_names = 'es_MX'");
    }


    function getDatos($no_page, $statusAnalista=null)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $usuario = $this->session->userdata('idusuariobase');
        $tipoUser = $this->session->userdata('tipoUser'); //Obtenemos tipo de usuario de la sesion
        if($tipoUser==1||$tipoUser==5||$tipoUser==9)
        {
            if($statusAnalista===null)
                return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=1 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();
            else
                return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=1 AND Oti.statusAnalista=$statusAnalista GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();


        }

        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=1 AND Oti.idUsuario = $usuario GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();
    }

    function getDatosSH($no_page, $statusAnalista=null)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $usuario = $this->session->userdata('tipoUser');
        if($usuario==1||$usuario==5||$usuario==9)
        {
            if($statusAnalista===null)
                return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=2 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();
            else
                return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=2 AND Oti.statusAnalistaSSH=$statusAnalista GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();

        }
        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') AS nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Proyectos.idArea=2 AND Oti.idUsuario = $usuario GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();

    }

    function getDatosComercial($no_page)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $usuario = $this->session->userdata('idusuariobase');
        return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Oti.idUsuario = $usuario And Proyectos.idArea=1 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();
    }
    function getDatosComercialSshi($no_page)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $usuario = $this->session->userdata('idusuariobase');
        return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto WHERE Oti.idUsuario = $usuario And Proyectos.idArea=2 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC")->result_array();
    }
    function getDatosAn($no_page, $usuario)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $usuario = $this->session->userdata('idusuariobase');
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion where AnalistaOti.idUsuario = $usuario GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();
        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion where AnalistaOti.idUsuario = $usuario GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();

    }

    function getDatosCoor($no_page, $idCoor)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();
        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();

    }

    function inmuebleGet()
    {
        return $this->db->query("SELECT * from inmuebles")->result_array();
    }

    function getDatosGra($idAsignacion)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.* FROM CentrosDeTrabajo join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo where asignaInmueble.idAsignacion=$idAsignacion")->result_array();
    }

    function getDoctosEstado($idAsignacion)
    {
        return $this->db->query("SELECT Documentos.*, estados.nombreEstado FROM 
        Documentos, estados WHERE 
        idEstado=(SELECT estados.id_estado FROM asignaInmueble
        JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo 
        JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia 
        JOIN municipios ON regiones.municipio=municipios.idMunicipio 
        JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) 
        AND Documentos.idEstado=estados.id_Estado")->result_array();
    }
    function getPonderadores()
    {
        return $this->db->query("SELECT * FROM ponderadorDocumento")->result_array();
    }

    function eliminarDato($idDocume,$idAsigna)
    {
        $this->db->where('idDocumento', $idDocume);
        $this->db->where('idAsignacion', $idAsigna);
        $this->db->delete('documentosPCchecklis');
    }
    function cargarEvaluaciones($idAsignacion)
    {
        return $this->db->query("SELECT * FROM documentoValor WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function traerIcon($idAsignacion)
    {
        return $this->db->query("SELECT documentosPCchecklis.*, D.nombreDocumento FROM `documentosPCchecklis` JOIN Documentos D on documentosPCchecklis.idDocumento = D.idDocumentos  WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function formatoGet ()
    {
        return $this->db->query("SELECT * from Formato")->result_array();
    }

    function getDatosCoorAnAsig($no_page, $idCoor)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor AND statusAnalista = 1 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();
        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor AND statusAnalistaSSH = 1 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();

    }

    function getDatosCoorAnNoAsig($no_page, $idCoor)
    {
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor AND statusAnalista = 0 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();
        else
            return $this->db->query("SELECT CONCAT(Clientes.nombreCliente, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')') as nombreCliente, Formato.nombre as centroTrabajo,Oti.idOti,Oti.idCoordinador,Oti.statusAnalistaSSH as statusAnalista, Oti.statusActiva FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti WHERE Oti.idCoordinador = $idCoor AND statusAnalistaSSH = 0 GROUP BY Oti.idOti ORDER BY Oti.statusActiva DESC, Oti.idOti DESC ")->result_array();

    }

    /*function obtenerAnalistasOti($idOti)
    {*/

    /*$perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
    if($no_page == 1){
        $first = 0;
        $last  = $perpage;
    }else{
        $first = ($no_page - 1) * $perpage;
        $last  = $first + ($perpage -1);
    }*/
    /*return $this->db->query("SELECT AnalistaOti.idAnalistaOti,AnalistaOti.idUsuario,Usuario.nombre,asignaInmueble.idOti,  asignaInmueble.idFormato,asignaInmueble.idAsignacion,Formato.centroTrabajo,inmuebles.nombreInmueble,asignaInmueble.direccionInmueble FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario
     join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion
     join Formato on asignaInmueble.idFormato = Formato.idFormato
     join inmuebles on asignaInmueble.idInmueble = inmuebles.idInmueble  WHERE asignaInmueble.idOti=$idOti ")->result_array();*/
    /*}*/


    function obtenerAnalistasOti($idOti, $area, $usuario)
    {

//        if($usuario==1)
//            return $this->db->query("SELECT Proyectos.nombreProyecto, Subservicios.nombre as subservicio, AnalistaOti.idAnalistaOti,AnalistaOti.idUsuario,AnalistaOti.tipo,Usuario.nombre,asignaInmueble.idOti, asignaInmueble.idCentroTrabajo as idFormato ,asignaInmueble.idAsignacion,CentrosDeTrabajo.nombre as centroTrabajo, CentrosDeTrabajo.calle as direccion FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion join CentrosDeTrabajo on asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto JOIN Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Subservicios ON Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE asignaInmueble.idOti=$idOti ")->result_array();
//        else
        return $this->db->query("SELECT Proyectos.nombreProyecto, Subservicios.nombre as subservicio, AnalistaOti.idAnalistaOti,AnalistaOti.idUsuario,AnalistaOti.tipo,Usuario.nombre,asignaInmueble.idOti, asignaInmueble.idCentroTrabajo as idFormato ,asignaInmueble.idAsignacion,CentrosDeTrabajo.nombre as centroTrabajo, CentrosDeTrabajo.calle as direccion FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion join CentrosDeTrabajo on asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto JOIN Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Subservicios ON Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE asignaInmueble.idOti=$idOti AND Usuario.areaUser=$area")->result_array();

    }
    function obtenerAreaAnalista($idUsuario)
    {
        return $this->db->query("SELECT areaUser FROM Usuario WHERE idUsuario=$idUsuario ")->result_array();
    }


    function obtenerNumAnalistasOti($idOti)
    {

        /*$perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }*/
        return $this->db->query("SELECT AnalistaOti.idAnalistaOti,AnalistaOti.idUsuario,AnalistaOti.tipo,Usuario.nombre,asignaInmueble.idOti, asignaInmueble.idCentroTrabajo as idFormato ,asignaInmueble.idAsignacion,CentrosDeTrabajo.nombre as centroTrabajo,  CentrosDeTrabajo.calle as direccion  FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion join CentrosDeTrabajo on asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo WHERE asignaInmueble.idOti=$idOti ")->num_rows();
    }

    function getTotalRowAllData($condicion="", $from="", $select="*")
    {
        if(empty($from))
            $query = $this->db->query("SELECT count(*) as row FROM Oti $condicion")->row_array();
        else
            $query = $this->db->query("SELECT count($select) as row $from $condicion")->row_array();
        return $query['row'];
    }



    /* function getNumAnalistas($idOti)
    {
      $query = $this->db->query("SELECT count(*) as row FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario
        join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion
        join Formato on asignaInmueble.idFormato = Formato.idFormato
        join inmuebles on asignaInmueble.idInmueble = inmuebles.idInmueble  WHERE asignaInmueble.idOti=$idOti")->row_array();
        return $query['row'];
    }*/

    /* function getTotalRowAllDataAnalistasOti($idOti)
     {
       $query = $this->db->query("SELECT count(*) as row FROM AnalistaOti join Usuario on AnalistaOti.idUsuario = Usuario.idUsuario
         join asignaInmueble on AnalistaOti.idAsignacion = asignaInmueble.idAsignacion
         join Formato on asignaInmueble.idFormato = Formato.idFormato
         join inmuebles on asignaInmueble.idInmueble = inmuebles.idInmueble  WHERE asignaInmueble.idOti=$idOti")->row_array();
         return $query['row'];
     }*/

    function insertaDatos($data)
    {
        $this->db->insert('Entregables', $data);
        //echo json_encode($data);altaUser
    }


    function insertaDatosPuenteEntrega($data)
    {
        $this->db->insert('documentoValor', $data);
        //echo json_encode($data);altaUser
    }

    function insertaDatosCentro($data)
    {
        $this->db->insert('CentrosDeTrabajo', $data);
        //echo json_encode($data);altaUser
    }

    function insertaDatosCliente($data)
    {
        $this->db->insert('Clientes', $data);
        //echo json_encode($data);altaUser
    }



    function clienteGet ()
    {
        return $this->db->query("SELECT * from Clientes")->result_array();
    }

    function getEntregables()
    {
        return $this->db->query("SELECT * FROM Entregables")->result_array();
    }
    function getEntregablesCentro($idAsignaInmueble)
    {
        return $this->db->query("SELECT * FROM entregableInmueble WHERE idAsignacion=$idAsignaInmueble")->result_array();
    }

    function getListadoCord ($idA)
    {
        return $this->db->query("SELECT Usuario.idUsuario,Usuario.nombre FROM Usuario join Logeo on Logeo.idUsuario=Usuario.idUsuario WHERE Logeo.tipo=3 and Usuario.areaUser=$idA")->result_array();
    }

    //Obtenemos el listado de todos los analistas del sistema
    function getListadoAnalistas ($area)
    {
        return $this->db->query("SELECT Usuario.idUsuario,Usuario.nombre FROM Usuario join Logeo on Logeo.idUsuario=Usuario.idUsuario WHERE Logeo.tipo=4 and Usuario.areaUser=$area")->result_array();
    }

    //Obtenemos el listado de los inmuebles asignados a una OTI
    function totalRegistro ($idOti)
    {
        return $this->db->query("SELECT COUNT(asignaInmueble.idAsignacion) as total FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Subservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio join Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto WHERE asignaInmueble.idOti=$idOti")->result_array();
    }

    function getListadoInmueblesOti ($idOti, $area, $usuario, $pc=null)
    {
        if(($usuario==1||$area==4) && $pc!=null)
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, asignaInmueble.idAsignacion,asignaInmueble.idOti, CentrosDeTrabajo.nombre as nombre, Proyectos.nombreProyecto as servicio, Subservicios.idSubservicio as idsubser, Subservicios.nombre as subservicio, asignaInmueble.porcentajeValor FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Subservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio join Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto WHERE asignaInmueble.idOti=$idOti AND Proyectos.idArea=$pc")->result_array();
        else
            return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, asignaInmueble.idAsignacion,asignaInmueble.idOti, CentrosDeTrabajo.nombre as nombre, Proyectos.nombreProyecto as servicio, Subservicios.idSubservicio as idsubser, Subservicios.nombre as subservicio, asignaInmueble.porcentajeValor FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Subservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio join Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto JOIN Areas ON Areas.idArea=Proyectos.idArea WHERE asignaInmueble.idOti=$idOti AND Areas.idArea=$area")->result_array();

    }

    function getCent ($idOti)
    {

        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, asignaInmueble.idAsignacion,asignaInmueble.idOti, CentrosDeTrabajo.nombre as nombre FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl  join Proyectos on serviciosSubservicios.idServicio=Proyectos.idProyecto WHERE asignaInmueble.idOti=$idOti AND Proyectos.idArea=2 GROUP by CentrosDeTrabajo.nombre")->result_array();


    }
    function getProyecto()
    {
        return $this->db->query("SELECT * from Areas")->result_array();
    }
    function getServiciosArea($idArea)
    {
        return $this->db->query("SELECT * FROM Proyectos WHERE idArea=$idArea")->result_array();
    }
    function getServiciosControl($idControl)
    {
        return $this->db->query("SELECT * FROM Subservicios JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio WHERE IdServicio= (SELECT idServicio FROM serviciosSubservicios WHERE idControl=$idControl)")->result_array();
    }

    function getSubservicios($idServicio)
    {
        return $this->db->query("SELECT serviciosSubservicios.idControl, Subservicios.* FROM Subservicios Join serviciosSubservicios ON Subservicios.idSubservicio=serviciosSubservicios.idSubservicio WHERE serviciosSubservicios.idServicio=$idServicio")->result_array();
    }

    function obtenerNombreInmue ($idI)
    {
        return $this->db->query("SELECT nombre from CentrosDeTrabajo where idCentroTrabajo=$idI")->row();
    }

    function obtenerNombreTrami ($idT)
    {
        return $this->db->query("SELECT nombreTramite from Tramites where idTramite=$idT")->row();
    }

    function totalId($idUs)
    {
        return $this->db->query("SELECT COUNT(idCoordinador) as total from Oti WHERE idCoordinador=$idUs")->row();
    }
    //Obtener el número total de inmuebles asignados al analista de riesgo
    function totalAnalistaInmueble($idUs)
    {
        return $this->db->query("SELECT COUNT(*) as total from AnalistaOti WHERE idUsuario=$idUs")->row();
    }
    function obtenerNombreProye ($idPr)
    {
        return $this->db->query("SELECT nombreProyecto from Proyectos where idProyecto=$idPr")->row();
    }
    function obtenerNombreSubservicio($idSubservicio)
    {
        return $this->db->query("SELECT nombre from Subservicios JOIN serviciosSubservicios ON serviciosSubservicios.idSubservicio=Subservicios.idSubservicio where idcontrol=$idSubservicio")->row();
    }


    function getCentrosDeTrabajo()
    {
        return $this->db->query("SELECT * from CentrosDeTrabajo")->result_array();
    }


    function getTramite()
    {
        return $this->db->query("SELECT * from Tramites")->result_array();
    }

    function traerForma ($idCliente)
    {
        return $this->db->query("SELECT * from Formato where idCliente =$idCliente ")->result_array();
    }

    function modificaDatos($dataOtiM,$idOti)
    {
        $this->db->where('idOti', $idOti);
        $this->db->update('Oti', $dataOtiM);

    }

    function modificaDatosVisishhi($datos,$idVisi)
    {
        $this->db->where('idvisitas', $idVisi);
        $this->db->update('visitasshi', $datos);

    }
    function actualizarDatosPuente($data, $idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('asignaInmueble', $data);
    }
    function actualizarPorcentaje($idAsignacion, $data)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->update('asignaInmueble', $data);
    }


    function AsignarAnalistaInmueble($data,$oti,$dataOti)
    {
        //Asignar
        $this->db->insert('AnalistaOti',$data);

        $this->db->where('idOti', $oti);
        $this->db->update('Oti', $dataOti);
    }

    function actualizarStatusOti($oti, $dataOti)
    {
        $this->db->where('idOti', $oti);
        $this->db->update('Oti', $dataOti);
    }

    function updateFormato($dataOtiFormatoM,$idOti)
    {
        $this->db->where('idOti', $idOti);
        $this->db->update('Oti', $idOti);

    }

    function borrarDatosuserAAsignados($idControl)
    {
        $this->db->where('idAnalistaOti', $idControl);
        $this->db->delete('AnalistaOti');
    }

    function borrarDatosPuente($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete('asignaInmueble');
    }
    function borrarEntregablesCentro($idAsignaInmueble)
    {
        $this->db->where('idAsignacion', $idAsignaInmueble);
        $this->db->delete('entregableInmueble');
    }

    function borrarTodosDatosPuente($idOti)
    {
        $this->db->where('idOti', $idOti);
        $this->db->delete('asignaInmueble');
    }
    function borrarDatos($idEntr)
    {
        $this->db->where('idEntregable', $idEntr);
        $this->db->delete('Entregables');
    }
    function borrarDatosPuenteEntrega($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete('documentoValor');
    }

    function obtenersuId($fechaSol,$horaSoli)
    {
        return $this->db->query("select * from Oti where fechaSolicitud='$fechaSol' and horaSolicitud ='$horaSoli' ")->result_array();
    }



    function obtenerFicha($idOti)
    {
        return $this->db->query("SELECT Clientes.idCliente, Formato.idFormato, asignaInmueble.*, Oti.*, Proyectos.idProyecto as idServicio, Proyectos.nombreProyecto, Proyectos.idArea, Subservicios.idSubservicio, Subservicios.nombre as nombreSubservicio, CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.nombre as nombreCentroTrabajo From Oti JOIN asignaInmueble on asignaInmueble.idOti=Oti.idOti join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN serviciosSubservicios ON serviciosSubservicios.idControl=asignaInmueble.idProyecto JOIN Subservicios ON Subservicios.idSubservicio=serviciosSubservicios.idSubservicio join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato JOIN Clientes on Clientes.idCliente=Formato.idCliente join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio  where Oti.idOti=$idOti")->result_array();
    }

    function obtenerDatosCentroTrabajo($idFormato)
    {
        return $this->db->query("SELECT * From Formato where idFormato=$idFormato")->result_array();
    }
    function obtenerDatosCentroTrabajoPorFormato($idFormato)
    {
        return $this->db->query("SELECT * From CentrosDeTrabajo where idFormato=$idFormato")->result_array();

    }

    function getLoistadoV($idAsig)
    {
        return $this->db->query("SELECT * From VisitasInmueble where idAsignacion=$idAsig and tipoVisita =1")->result_array();
    }

    function getLoistadoVSSHI($idCentr,$idAsig)
    {
        return $this->db->query("SELECT * FROM `visitasshi` WHERE idCentro=$idCentr and idAsignacion =$idAsig")->result_array();
    }
    function getLoistadoD($idAsig)
    {
        return $this->db->query("SELECT * From VisitasInmueble where idAsignacion=$idAsig and tipoVisita =2")->result_array();

    }
    function borraeFechasshi($id)
    {
        $this->db->where('idvisitas', $id);
        $this->db->delete('visitasshi');
    }
    function insertaVisita($data)
    {
        $this->db->insert('VisitasInmueble', $data);
    }

    function insertaDatosPuenteEntregaDoctos($data)
    {
        $this->db->insert('documentosPCchecklis', $data);
    }


    function insertaVisitasshi($data)
    {
        $this->db->insert('visitasshi', $data);
    }

    function insertaDatosOti($data)
    {
        $this->db->insert('Oti', $data);
    }
    function insertaDatosOtiformato($data)
    {
        $this->db->insert('otiFormato', $data);
        //echo json_encode($data);altaUser
    }
    function insertaDatosPuente($data)
    {
        $this->db->insert('asignaInmueble', $data);
        return  $this->db->insert_id();
    }
    function getPorcetajeValor($idP,$idC)
    {
        $valorP= $this->db->query("select asignaInmueble.porcentajeValor from asignaInmueble where idCentroTrabajo=$idC and asignaInmueble.idProyecto =$idP ")->row_array();
        if (empty($valorP)) {
            return 0;
        }
        return $valorP['porcentajeValor'];
    }
    function insertarBitacoraAsignacion($arregloBitacora)
    {
        $this->db->insert('BitacoraAsignacion', $arregloBitacora);
    }
    function insertarEntregableCentro($data)
    {
        $this->db->insert('entregableInmueble', $data);
    }

    function cambiarEstadoOti($data, $idOti)
    {
        $this->db->where('idOti', $idOti);
        $this->db->update('Oti', $data);
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
        $config['first_link'] = 'Primero';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
        $config['base_url']   = site_url($url);
        $config['total_rows']   = $rows;
        $config['use_page_numbers'] = TRUE;
        $config['uri_segment']   = $uri;
        $config['num_links']   = 5;
        $config['attributes'] = array('class' => 'waves-effect');
        $config['next_tag_open'] = '<li>';
        $config['next_tag_close'] = '</li>';
        $config['next_link']   = '<i class="material-icons">chevron_right</i>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tag_close'] = '</li>';
        $config['prev_link']   = '<i class="material-icons">chevron_left</i>';
        $config['cur_tag_open']='<li class=active><a>';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';

        // untuk config class pagination yg lainnya optional (suka2 lu.. :D )

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    public function CountCoorOtiAsig($id)
    {
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT * FROM Oti WHERE idCoordinador = $id And statusAnalista = 1")->num_rows();
        else
            return $this->db->query("SELECT * FROM Oti WHERE idCoordinador = $id And statusAnalistaSSH = 1")->num_rows();

    }

    public function CountCoorOtiNoAsig($id)
    {
        $area = $this->session->userdata('area');
        if($area==1)
            return $this->db->query("SELECT * FROM Oti WHERE idCoordinador = $id And statusAnalista = 0")->num_rows();
        else
            return $this->db->query("SELECT * FROM Oti WHERE idCoordinador = $id And statusAnalistaSSH = 0")->num_rows();

    }

    public function checkVisitas($idOti)
    {
        return $this->db->query("SELECT VisitasInmueble.idVisita, VisitasInmueble.idAsignacion, VisitasInmueble.tipoVisita FROM VisitasInmueble JOIN asignaInmueble ON VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion WHERE asignaInmueble.idOti=$idOti AND VisitasInmueble.tipoVisita = 1 AND VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion ")->result_array();
    }

    public function checkVisitasDocs($idOti)
    {
        return $this->db->query("SELECT VisitasInmueble.tipoVisita FROM VisitasInmueble JOIN asignaInmueble ON VisitasInmueble.idAsignacion = asignaInmueble.idAsignacion WHERE asignaInmueble.idOti=$idOti AND VisitasInmueble.tipoVisita = 2")->num_rows();
    }
    function obtenerBitacoras()
    {
        return $this->db->query("SELECT idBitacora, nombre as nombreBitacora FROM Bitacora")->result_array();
    }
    function insertaHistoricoDocumental($array)
    {
        $this->db->insert("HistoricoDocumental", $array);
    }
    function actualizarFechaRevisionDocumentos($data, $id)
    {
        $this->db->where("idVisita", $id);
        $this->db->update("VisitasInmueble", $data);
    }
    function getEntregablesPredeterminados($idServicioSubservicio)
    {
        return $this->db->query("SELECT * FROM EntregablesSubservicio WHERE idServicioSubservicio='$idServicioSubservicio'")->result_array();
    }

}
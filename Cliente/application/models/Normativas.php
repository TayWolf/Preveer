<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Normativas extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }
    
    function getDatosBitacoras($idCliente)
    {
        return $this->db->query("SELECT Oti.fechaSolicitud,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre,asignaInmueble.idOti,asignaInmueble.idAsignacion FROM CentrosDeTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Oti on Oti.idOti=asignaInmueble.idOti JOIN regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado where Clientes.idCliente=$idCliente and Proyectos.idArea=2  GROUP by CentrosDeTrabajo.nombre")->result_array();
    }


       function getCentrosDeTrabajo($idCliente)
    {
        return $this->db->query("SELECT Oti.fechaSolicitud,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre,asignaInmueble.idOti,asignaInmueble.idAsignacion FROM CentrosDeTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Oti on Oti.idOti=asignaInmueble.idOti JOIN regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado where Clientes.idCliente=$idCliente and Proyectos.idArea=2  GROUP by CentrosDeTrabajo.nombre")->result_array();
    }

        function getNormasPorCentro($idCliente,$idCentro)
    {
        return $this->db->query("SELECT Subservicios.nombre as nombreNorma,Subservicios.idSubservicio,asignaInmueble.idOti,asignaInmueble.idAsignacion,asignaInmueble.porcentajeValor FROM asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN Formato ON CentrosDeTrabajo.idFormato = Formato.idFormato JOIN Clientes ON Formato.idCliente = Clientes.idCliente WHERE (Clientes.idCliente=$idCliente and Proyectos.idArea = 2) AND CentrosDeTrabajo.idCentroTrabajo=$idCentro GROUP BY asignaInmueble.idProyecto")->result_array();
    }

    function getDatos($idCliente)
    {
        return $this->db->query("SELECT Subservicios.nombre as nombreNorma,Subservicios.idSubservicio FROM asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN Formato ON CentrosDeTrabajo.idFormato = Formato.idFormato JOIN Clientes ON Formato.idCliente = Clientes.idCliente WHERE Clientes.idCliente=$idCliente and Proyectos.idArea = 2 GROUP BY asignaInmueble.idProyecto")->result_array();
    }

    function getcentroNorma($Cliente,$idNorma)
    {
        return $this->db->query("SELECT Clientes.idCliente,CentrosDeTrabajo.nombre,CentrosDeTrabajo.idCentroTrabajo,asignaInmueble.idOti,asignaInmueble.idAsignacion, Subservicios.idSubservicio,asignaInmueble.porcentajeValor from asignaInmueble join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto JOIN Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio join Subservicios on Subservicios.idSubservicio=serviciosSubservicios.idSubservicio where Clientes.idCliente=$Cliente and Proyectos.idArea=2 and Subservicios.idSubservicio=$idNorma")->result_array();
    }
    function getDoctosEstado($idAsignacion,$idSubsee)// no borrar
    {
        return $this->db->query("SELECT DocNormas.*, Subservicios.nombre FROM DocNormas, Subservicios WHERE idSubservicio=(SELECT Subservicios.idSubservicio FROM asignaInmueble JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON regiones.municipio=municipios.idMunicipio JOIN estados ON municipios.estado=estados.id_Estado WHERE idAsignacion=$idAsignacion) AND DocNormas.idNorma=Subservicios.idSubservicio and DocNormas.idNorma=$idSubsee")->result_array();
    }

    function getPonderadores()// no borrar
    {
        return $this->db->query("SELECT * FROM ponderadoresIndicadores")->result_array();
    }

    function cargarEvaluaciones($idAsignacion)// borrar
    {
        return $this->db->query("SELECT * FROM IndicadoresValor WHERE idAsignacion=$idAsignacion")->result_array();
    }

    function getcentroBitacora($Cliente,$idCentroTrabajo)
    {
        return $this->db->query("select Bitacora.idBitacora,Bitacora.nombre,asignaInmueble.idAsignacion from BitacoraAsignacion join asignaInmueble on asignaInmueble.idAsignacion=BitacoraAsignacion.idAsignacion join Bitacora on Bitacora.idBitacora=BitacoraAsignacion.idBitacora join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio where asignaInmueble.idCentroTrabajo=$idCentroTrabajo and Proyectos.idArea=2 GROUP by Bitacora.idBitacora")->result_array();
    }

    function obtenerRespaldos($idCentroTrabajo, $idBitacora)
    {
        return $this->db->query("SELECT asignaInmueble.idAsignacion,BitacoraRespaldo.idBitacoraRespaldo, BitacoraRespaldo.fecha, CentrosDeTrabajo.nombre FROM BitacoraRespaldo join asignaInmueble on asignaInmueble.idAsignacion=BitacoraRespaldo.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE idBitacora=$idBitacora and CentrosDeTrabajo.idCentroTrabajo=$idCentroTrabajo")->result_array();
    }
    function getnombreBitacor($idBitacora)
    {
       // echo "$idBitacora";
        return $this->db->query("select * from Bitacora where idBitacora=$idBitacora")->result_array();
    }

    function obtenerRespaldoBitacora($idRespaldo)
    {
        //echo "$idRespaldo";
        return $this->db->query("SELECT * FROM BitacoraRespaldo WHERE idBitacoraRespaldo=$idRespaldo")->row_array();
    }

     

    function getIndica($idBitacora)
    {
        
        return $this->db->query("SELECT indicadorBitacoras.* from indicadorBitacoras join BitacoraIndicador on BitacoraIndicador.idIndicador=indicadorBitacoras.idIndicador where BitacoraIndicador.idBitacora=$idBitacora ORDER BY BitacoraIndicador.posicion ASC")->result_array();
    }

     function getDatosCentroTrabajoWord($idCe)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.*, regiones.nombreRegion, municipios.nombreMunicipio, estados.nombreEstado, Formato.razonSocial, Formato.foto, U.nombre as nombreUsuario  FROM CentrosDeTrabajo JOIN asignaInmueble ON asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo JOIN Formato on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN regiones ON regiones.idRegiones=CentrosDeTrabajo.idColonia JOIN municipios ON municipios.idMunicipio=regiones.municipio JOIN estados on municipios.estado = estados.id_Estado JOIN AnalistaOti O on asignaInmueble.idAsignacion = O.idAsignacion JOIN Usuario U on O.idUsuario = U.idUsuario WHERE CentrosDeTrabajo.idCentroTrabajo=$idCe")->row_array();
    }
    
}
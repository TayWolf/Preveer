<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fichasgrales extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }
    
    function getDatosFichas($idCliente)
    {
        return $this->db->query("SELECT Oti.fechaSolicitud,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre,asignaInmueble.idOti,asignaInmueble.idAsignacion FROM CentrosDeTrabajo join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente=Formato.idCliente join asignaInmueble on asignaInmueble.idCentroTrabajo=CentrosDeTrabajo.idCentroTrabajo join serviciosSubservicios on serviciosSubservicios.idControl=asignaInmueble.idProyecto join Proyectos on Proyectos.idProyecto=serviciosSubservicios.idServicio JOIN Oti on Oti.idOti=asignaInmueble.idOti JOIN regiones on regiones.idRegiones=CentrosDeTrabajo.idColonia join municipios on municipios.idMunicipio=regiones.municipio join estados on estados.id_Estado=municipios.estado where Clientes.idCliente=$idCliente and Proyectos.idArea=2  GROUP by CentrosDeTrabajo.nombre")->result_array();
    }//listo

    function getDatos($idCliente)
    {
        return $this->db->query("SELECT Subservicios.nombre as nombreNorma,Subservicios.idSubservicio FROM asignaInmueble join serviciosSubservicios on serviciosSubservicios.idControl = asignaInmueble.idProyecto join Subservicios on Subservicios.idSubservicio = serviciosSubservicios.idSubservicio join Proyectos on Proyectos.idProyecto = serviciosSubservicios.idServicio JOIN CentrosDeTrabajo ON asignaInmueble.idCentroTrabajo = CentrosDeTrabajo.idCentroTrabajo JOIN Formato ON CentrosDeTrabajo.idFormato = Formato.idFormato JOIN Clientes ON Formato.idCliente = Clientes.idCliente WHERE Clientes.idCliente=$idCliente and Proyectos.idArea = 2 GROUP BY asignaInmueble.idProyecto")->result_array();
    }



    function getcentroFicha($Cliente,$idCentroTrabajo)
    {
        return $this->db->query("SELECT asignaInmueble.idOti,Reportes_SSHL.*,asignaInmueble.idAsignacion FROM Reportes_SSHL join ReporteAsignacion on ReporteAsignacion.idReporte=Reportes_SSHL.idReporte JOIN asignaInmueble on asignaInmueble.idAsignacion=ReporteAsignacion.idAsignacion where asignaInmueble.idCentroTrabajo=$idCentroTrabajo")->result_array();
    }

    function getcentroActa($Cliente,$idCentroTrabajo)
    {
        return $this->db->query("SELECT asignaInmueble.idOti,asignaInmueble.idAsignacion FROM `actaVerificacion` join asignaInmueble on asignaInmueble.idAsignacion=actaVerificacion.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentroTrabajo")->result_array();
    }

    function getReporteAsignacion($idReporte, $idAsignacion)
    {
        $consulta=$this->db->query("SELECT * FROM ReporteAsignacion WHERE idReporte=$idReporte AND idAsignacion=$idAsignacion")->result_array();
        if(empty($consulta))
        {
            $this->db->insert('ReporteAsignacion', array('idReporte' => $idReporte, 'idAsignacion' => $idAsignacion, 'fecha' => date("Y-m-d")));
            return $this->getReporteAsignacion($idReporte, $idAsignacion);
        }
        return $consulta;

    }
    function getNombreReporte($idReporte)
    {
        return $this->db->query("SELECT nombreReportes FROM Reportes_SSHL WHERE idReporte=$idReporte")->result_array();
    }
    function getApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT Reporte_ApartadoReporte.*, ApartadoReporte.nombre FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->result_array();
    }
    function getIndicadoresApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT Apartado_IndicadorReporte.*, indicadorReporte.nombreIndicador, indicadorReporte.tipo, indicadorReporte.required FROM Reporte_ApartadoReporte JOIN ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idApartadoReporte=Reporte_ApartadoReporte.idApartadoReporte JOIN indicadorReporte ON indicadorReporte.idIndicador=Apartado_IndicadorReporte.idIndicadorReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte ORDER BY Reporte_ApartadoReporte.posicion")->result_array();
    }
    function getCorreccion($idReporte)
    {
        return $this->db->query("SELECT numeroCorrecciones, posicionCorreccion FROM Reportes_SSHL WHERE idReporte=$idReporte")->result_array();
    }
    function obtenerCorrecciones($idReporteAsignacion)
    {
        return $this->db->query("SELECT * FROM ReporteCorreccion WHERE idReporteAsignacion=$idReporteAsignacion")->result_array();
    }
    function getPonderadoresIndicadoresApartadosReporte($idReporte)
    {
        return $this->db->query("SELECT PonderadoresReportes.*, indicadorReporte.idIndicador, indicadorReporte.nombreIndicador, ApartadoReporte.idApartadoReporte FROM PonderadoresReportes JOIN PonderadorIndicadorRep ON PonderadorIndicadorRep.idPonderador=PonderadoresReportes.idPonderador JOIN indicadorReporte ON indicadorReporte.idIndicador=PonderadorIndicadorRep.idIndicador JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idIndicadorReporte=indicadorReporte.idIndicador JOIN ApartadoReporte ON ApartadoReporte.idApartadoReporte=Apartado_IndicadorReporte.idApartadoReporte JOIN Reporte_ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE Reporte_ApartadoReporte.idReporte=$idReporte")->result_array();
    }
    function cargarResultados($idReporteAsignacion)
    {
        return $this->db->query("SELECT ReporteAlmacenamiento.valor, ReporteAlmacenamiento.idIndicadorReporte, Apartado_IndicadorReporte.idApartadoReporte FROM `ReporteAlmacenamiento` JOIN indicadorReporte ON indicadorReporte.idIndicador=ReporteAlmacenamiento.idIndicadorReporte JOIN Apartado_IndicadorReporte ON Apartado_IndicadorReporte.idApartadoReporte=ReporteAlmacenamiento.idApartadoReporte AND ReporteAlmacenamiento.idIndicadorReporte=Apartado_IndicadorReporte.idIndicadorReporte JOIN ApartadoReporte ON Apartado_IndicadorReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte JOIN Reporte_ApartadoReporte ON Reporte_ApartadoReporte.idApartadoReporte=ApartadoReporte.idApartadoReporte WHERE ReporteAlmacenamiento.idReporteAsignacion=$idReporteAsignacion")->result_array();
    }
    
    
}
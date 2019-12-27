<?php

class OportunidadMejora extends CI_Model
{
    function obtenerCentrosTrabajo($idCliente)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.nombre FROM CentrosDeTrabajo join Formato on Formato.idFormato = CentrosDeTrabajo.idFormato join Clientes on Clientes.idCliente = Formato.idCliente JOIN asignaInmueble a on CentrosDeTrabajo.idCentroTrabajo = a.idCentroTrabajo JOIN OMSSH O on a.idAsignacion = O.idAsignacion where Clientes.idCliente = $idCliente GROUP by CentrosDeTrabajo.idCentroTrabajo ORDER BY CentrosDeTrabajo.nombre;")->result_array();
    }
    function getDatosCentroTrabajo($idCentroTrabajo)
    {
        return $this->db->query("SELECT CentrosDeTrabajo.nombre as nombreSucursal, CentrosDeTrabajo.idDet  as numeroSucursal FROM CentrosDeTrabajo WHERE idCentroTrabajo=$idCentroTrabajo")->row_array();
    }
    function obtenerTabla($idCentroTrabajo)
    {
        return $this->db->query("SELECT OMSSH.idOMSSH, YEAR(OMSSH.fechaEjecucion) as year, MONTH(OMSSH.fechaEjecucion) as month, fotoCorreccion0, fotoCorreccion1 FROM OMSSH JOIN asignaInmueble a on OMSSH.idAsignacion = a.idAsignacion JOIN CentrosDeTrabajo Trabajo on a.idCentroTrabajo = Trabajo.idCentroTrabajo LEFT JOIN areaClubesSW ON OMSSH.idArea = areaClubesSW.idArea LEFT join prioridadIntervencion on prioridadIntervencion.idPrioridad = OMSSH.idPrioridadIntervencion WHERE a.idCentroTrabajo = $idCentroTrabajo  AND fechaEjecucion IS NOT NULL ORDER BY year, month;")->result_array();
    }

    function obtenerTablaOMSSH($idCentro)
    {
        return $this->db->query("SELECT OMSSH.*, areaClubesSW.descripcion as area, prioridadIntervencion.nombre as nombrePrioridad, prioridadIntervencion.color as colorPrioridad FROM OMSSH LEFT JOIN areaClubesSW ON OMSSH.idArea=areaClubesSW.idArea LEFT join prioridadIntervencion on prioridadIntervencion.idPrioridad=OMSSH.idPrioridadIntervencion join asignaInmueble on asignaInmueble.idAsignacion=OMSSH.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo WHERE CentrosDeTrabajo.idCentroTrabajo=$idCentro")->result_array();
    }
    function obtenercoloresIntervencion()
    {
        return $this->db->query("SELECT * FROM prioridadIntervencion")->result_array();
    }

    function obtenerProri()
    {
        return $this->db->query("SELECT * FROM prioridadIntervencion")->result_array();
    }

}
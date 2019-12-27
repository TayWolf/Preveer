<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronograma extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }
    function getDatos($orden, $idCliente)
    {

        return $this->db->query("SELECT Usuario.idUsuario, Usuario.nombre as nombreUser, CentrosDeTrabajo.idCentroTrabajo, CentrosDeTrabajo.nombre as nombreUnidad, Formato.nombre, visitasshi.fechaVisita FROM Usuario join AnalistaOti on AnalistaOti.idUsuario = Usuario.idUsuario join asignaInmueble on asignaInmueble.idAsignacion = AnalistaOti.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo = asignaInmueble.idCentroTrabajo join visitasshi on visitasshi.idAsignacion = asignaInmueble.idAsignacion join Formato on Formato.idFormato = CentrosDeTrabajo.idFormato JOIN Clientes C on Formato.idCliente = C.idCliente WHERE C.idCliente=$idCliente GROUP by CentrosDeTrabajo.nombre $orden;")->result_array();
    }
    function getDatosFecha($idUser,$idCe, $idCliente)
    {

        return $this->db->query("SELECT Usuario.nombre as nombreUser,CentrosDeTrabajo.nombre as nombreUnidad,visitasshi.fechaVisita,visitasshi.status FROM Usuario join AnalistaOti on AnalistaOti.idUsuario=Usuario.idUsuario join asignaInmueble on asignaInmueble.idAsignacion=AnalistaOti.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join visitasshi on visitasshi.idAsignacion=asignaInmueble.idAsignacion where Usuario.idUsuario = $idUser and CentrosDeTrabajo.idCentroTrabajo=$idCe order by fechaVisita")->result_array();
    }
}
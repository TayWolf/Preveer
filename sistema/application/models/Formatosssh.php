<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Formatosssh extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

    function insertarValo($data)
    {
        $this->db->insert('formatosSshi', $data);
    }

    function insertarDatosEscalera($data)
    {
        $this->db->insert('formatosEscalera', $data);
    }

    function obtenerFicha ($idFormato){
        // return $this->db->query("SELECT * from Formato where idFormato=$idFormato ")->row();
        return $this->db->query("SELECT * FROM `Formato` INNER JOIN Clientes ON Clientes.idCliente = Formato.idCliente  where idFormato=$idFormato ")->row();
    }


    function modificaDatos($data,$idFormato)
    {
        $this->db->where('idFormato', $idFormato);
        $this->db->update('Formato', $data);
    }

    function insertarDatosGeneralesEscalera($arrayDatosGenerales)
    {
        $this->db->insert('datosGeneralesEscalereas', $arrayDatosGenerales);
    }

    function borrarDatosGeneralesEscalera($idDatosGenerales)
    {
        $this->db->where('idDatosGenerales', $idDatosGenerales);
        $this->db->delete("datosGeneralesEscalereas");
    }

    function getDatos ($idAsi,$idTip)
    {
        return $this->db->query("SELECT formatosSshi.*, nombrePonderador from formatosSshi JOIN ponderadorSshi on formatosSshi.idPonderador=ponderadorSshi.idPonderador where idAsignacion=$idAsi")->result_array();
    }

    function getDatosEscaleras($idAsignacion,$idTipoFormato)
    {
        return $this->db->query("SELECT * FROM formatosEscalera WHERE idAsignacion = $idAsignacion")->result_array();
    }

    function getDatosInspeccion($idAsignacion, $idCentroTrabajo)
    {
        return $this->db->query("SELECT Clientes.nombreCliente, CentrosDeTrabajo.nombre AS CentroDeTrabajo, Formato.nombre, CentrosDeTrabajo.nomContacto, CentrosDeTrabajo.puestoContacto, Usuario.nombre as usuario FROM Clientes JOIN Formato ON Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo ON CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble ON CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion JOIN Usuario ON AnalistaOti.idUsuario = Usuario.idUsuario WHERE CentrosDeTrabajo.idCentroTrabajo = $idCentroTrabajo AND asignaInmueble.idAsignacion = $idAsignacion")->result_array();
    }

    function getDatosGeneralesEscalera($idAsignacion)
    {
        $valor = $this->db->query("SELECT * FROM datosGeneralesEscalereas WHERE idAsignacion = $idAsignacion")->result_array();
        if(empty($valor)){
            $this->db->query("INSERT INTO datosGeneralesEscalereas(idAsignacion) VALUES ($idAsignacion)");
            return $this->getDatosGeneralesEscalera($idAsignacion);
        }
        return $valor;
    }

    function getGruposssh ($tipoF)
    {
        return $this->db->query("SELECT * from grupoSshi where formato=$tipoF")->result_array();
    }
    function getIndicador ($idG)
    {
        return $this->db->query("SELECT * from indicadorSshi where idGrupo= $idG ")->result_array();
    }
    function getPondesshi ()
    {
        return $this->db->query("SELECT * from ponderadorSshi ")->result_array();
    }

    function borrarForm($idAsignacion, $tipo)
    {
        $this->db->query("DELETE formatosSshi FROM formatosSshi JOIN indicadorSshi ON formatosSshi.idIndicador=indicadorSshi.idIndicador JOIN grupoSshi ON indicadorSshi.idGrupo=grupoSshi.idGrupo WHERE grupoSshi.formato=$tipo and formatosSshi.idAsignacion=$idAsignacion");
    }

    function borrarDatosEscalera($idAsignacion)
    {
        $this->db->where('idAsignacion', $idAsignacion);
        $this->db->delete("formatosEscalera");
    }

}
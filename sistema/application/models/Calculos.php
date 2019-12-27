<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Calculos extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

    function getDatos($idIndicador)
    {
        return $this->db->query("SELECT * FROM IndicadorCalculo WHERE idIndicador=$idIndicador")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('IndicadorCalculo', $data);
        return $this->db->insert_id();
    }

    function insertaCondicion($data)
    {
        $this->db->insert('IndicadorCalculoCondicion', $data);
    }

    function obtenerFicha ($idIndicadorCalculo)
    {
        return $this->db->query("SELECT descripcion from IndicadorCalculo WHERE idIndicadorCalculo=$idIndicadorCalculo")->row();
    }

    function modificaDatos($data,$idIndicadorCalculo)
    {
        $this->db->where('idIndicadorCalculo', $idIndicadorCalculo);
        $this->db->update('IndicadorCalculo', $data);
    }

    function borrarDatos($idIndicadorCalculo)
    {
        $this->db->where('idIndicadorCalculo', $idIndicadorCalculo);
        $this->db->delete('IndicadorCalculo');
    }
    function borrarCondicion($idCondicion)
    {
        $this->db->where('idIndicadorCalculoCondicion', $idCondicion);
        $this->db->delete('IndicadorCalculoCondicion');
    }

    function getTipoIndicador($idIndicador)
    {
        return $this->db->query("SELECT tipoIndicador FROM indicadorBitacoras WHERE idIndicador=$idIndicador")->result_array();
    }
    function getNombreIndicador($idIndicador)
    {
        return $this->db->query("SELECT nombreIndicador FROM indicadorBitacoras WHERE idIndicador=$idIndicador")->result_array();
    }

    function getNombreCalculo($idCalculo)
    {
        return $this->db->query("SELECT descripcion FROM IndicadorCalculo WHERE idIndicadorCalculo=$idCalculo")->result_array();
    }

    function getListaCondiciones($idCalculo)
    {
        return $this->db->query("SELECT * FROM IndicadorCalculoCondicion WHERE idIndicadorCalculo=$idCalculo")->result_array();
    }
    function getListaOpcionesIndicador($idCalculo)
    {
        return $this->db->query("SELECT BitacoraPonderador.* FROM IndicadorCalculo JOIN indicadorBitacoras ON IndicadorCalculo.idIndicador=indicadorBitacoras.idIndicador JOIN indicadorPonderadorbitacoras ON indicadorBitacoras.idIndicador=indicadorPonderadorbitacoras.idIndicador JOIN BitacoraPonderador ON BitacoraPonderador.idBitacoraPonderador=indicadorPonderadorbitacoras.idPonderador WHERE IndicadorCalculo.idIndicadorCalculo=$idCalculo")->result_array();
    }

}
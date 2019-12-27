<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Indicadoresbitacoras extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }



    function getDatos()
    {
        return $this->db->query("SELECT * FROM indicadorBitacoras ")->result_array();
    }

    function obtenerContador($idIndicador)
    {
        return $this->db->query("SELECT esContador FROM indicadorBitacoras WHERE idIndicador=$idIndicador")->result_array();
    }
    function establecerContador($idIndicador,$data)
    {
        $this->db->where("idIndicador", $idIndicador);
        $this->db->update("indicadorBitacoras", $data);
    }

    function insertaDatos($data)
    {
        $this->db->insert('indicadorBitacoras', $data);
    }

     function insertaDatosPuente($data)
    {
        $this->db->insert('indicadorPonderadorbitacoras', $data);
    }

    function obtenerFicha ($idIndicador){
        return $this->db->query("SELECT * from indicadorBitacoras where idIndicador=$idIndicador ")->row();
    }

     function getListadoPond ($idIndicador){
        return $this->db->query("SELECT BitacoraPonderador.texto,BitacoraPonderador.idBitacoraPonderador,indicadorPonderadorbitacoras.idPuente FROM `BitacoraPonderador` join indicadorPonderadorbitacoras on indicadorPonderadorbitacoras.idPonderador=BitacoraPonderador.idBitacoraPonderador where indicadorPonderadorbitacoras.idIndicador=$idIndicador")->result_array();
    }
     function getListaPonder (){
        return $this->db->query("SELECT * from BitacoraPonderador")->result_array();
    }

    function modificaDatos($data,$idIndicador)
    {
        $this->db->where('idIndicador', $idIndicador);
        $this->db->update('indicadorBitacoras', $data);

    }


    function borrarDatos($indicado)
    {
        $this->db->where('idIndicador', $indicado);
        $this->db->delete('indicadorBitacoras');
    }
    function borrarDatosPuente($idIndic)
    {
        $this->db->where('idPuente', $idIndic);
        $this->db->delete('indicadorPonderadorbitacoras');
    }

}
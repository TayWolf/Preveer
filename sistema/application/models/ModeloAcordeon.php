<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloAcordeon extends CI_Model
{
    function __construct(){
        parent::__construct();
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Acordeon")->row_array();
        return $query['row'];
    }

    function data_pagination($url, $rows = 5, $uri = 3)
    {
        $this->load->library('pagination');
        $config['per_page']   = 10;
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
        $config['cur_tag_open']='<li><a>';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';

        // untuk config class pagination yg lainnya optional (suka2 lu.. :D )

        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }


    function getDatos($no_page)
    {
        return $this->db->query("SELECT * FROM Acordeon")->result_array();
    }
    function obtenerIndicadoresAcordeon($llavePrimaria, $where="")
    {
        return $this->db->query("SELECT AcordeonIndicador.*, formIndicador.nombreIndicador FROM AcordeonIndicador JOIN formIndicador ON AcordeonIndicador.idIndicador=formIndicador.idIndicador WHERE AcordeonIndicador.idAcordeon=$llavePrimaria $where ORDER BY AcordeonIndicador.posicion")->result_array();
    }
    function obtenerIndicadoresRestantes($where="")
    {
        return $this->db->query("SELECT formIndicador.* FROM formIndicador $where")->result_array();
    }

    function borrarIndicadores($llavePrimaria)
    {
        $this->db->where('idAcordeon', $llavePrimaria);
        $this->db->delete('AcordeonIndicador');
    }
    function insertIndicador($data)
    {
        $this->db->insert('AcordeonIndicador',$data);
    }
    function insertaDatos($arreglo)
    {
        $this->db->insert('Acordeon',$arreglo);
    }

    function obtenerFicha ($idAcordeon){
        return $this->db->query("SELECT * from Acordeon where idAcordeon=idAcordeon ")->row();
    }

    function obtenerResultado($idIndi)
    {

        return $this->db->query("select * from Acordeon where idAcordeon=$idIndi")->row();

    }

    function modificaDatos($arreglo,$idAcordeon)
    {
        $this->db->where('idAcordeon', $idAcordeon);
        $this->db->update('Acordeon', $arreglo);

    }


    // function modificaDatosPuente($data2,$idUser)
    // {
    //   $this->db->where('idUsuario', $idUser);
    //   $this->db->update('Logeo', $data2);

    //   }

    function borrarDatos($idAcordeon)
    {
        $this->db->where('idAcordeon', $idAcordeon);
        $this->db->delete('Acordeon');
    }
    //   function borrarDatospuente($id)
    // {
    //   $this->db->where('idUsuario', $id);
    //   $this->db->delete('Logeo');
    //   }


    function getListadoindInf($idAcordeon)
    {
        return $this->db->query("select AcordeonIndicador.idPuente,formIndicador.nombreIndicador FROM  AcordeonIndicador join formIndicador on  AcordeonIndicador.idIndicador=formIndicador.idIndicador where  AcordeonIndicador.idAcordeon=$idAcordeon")->result_array();
    }


    function getListaTododlistadoIndicador()
    {
        return $this->db->query("SELECT * FROM `formIndicador`")->result_array();
    }

    function insertaDatosPuente($data2)
    {

        $this->db->insert('AcordeonIndicador',$data2);
    }


    function borrarDatosindicabReq($id)
    {
        $this->db->where('idPuente', $id);
        $this->db->delete('AcordeonIndicador');
    }

}
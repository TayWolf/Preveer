<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelAutoad extends CI_Model
{
    function __construct(){
        parent::__construct();
    }
    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Aut")->row_array();
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

        return $this->db->query("SELECT * FROM Aut ")->result_array();
    }


    function insertaDatos($arreglo)
    {
        $this->db->insert('Aut',$arreglo);
    }

    function obtenerFicha ($idControl){
        return $this->db->query("SELECT * from Aut where idControl=idControl ")->row();
    }

    function obtenerResultado($idControl)
    {

        return $this->db->query("select * from Aut where idControl=$idControl")->row();

    }

    function modificaDatos($arreglo,$idControl)
    {
        $this->db->where('idControl', $idControl);
        $this->db->update('Aut', $arreglo);

    }


    // function modificaDatosPuente($data2,$idUser)
    // {
    //   $this->db->where('idUsuario', $idUser);
    //   $this->db->update('Logeo', $data2);

    //   }

    function borrarDatos($idControl)
    {
        $this->db->where('idControl', $idControl);
        $this->db->delete('Aut');
    }
    //   function borrarDatospuente($id)
    // {
    //   $this->db->where('idUsuario', $id);
    //   $this->db->delete('Logeo');
    //   }

    function getListadoindInf($idControl)
    {
        return $this->db->query("select FormularioAcordeon.idPuente,Acordeon.nombreAcordeon FROM  FormularioAcordeon join Acordeon on  FormularioAcordeon.idAcordeon=Acordeon.idAcordeon where  FormularioAcordeon.idControl=$idControl")->result_array();
    }
    function obtenerAcordeones($llavePrimaria)
    {
        return $this->db->query("SELECT FormularioAcordeon.*, Acordeon.nombreAcordeon FROM FormularioAcordeon JOIN Acordeon ON FormularioAcordeon.idAcordeon=Acordeon.idAcordeon WHERE FormularioAcordeon.idControl=$llavePrimaria ORDER BY FormularioAcordeon.posicion")->result_array();
    }
    function obtenerAcordeonesRestantes()
    {
        return $this->db->query("SELECT Acordeon.* FROM Acordeon")->result_array();
    }

    function borrarAcordeones($llavePrimaria)
    {
        $this->db->where('idControl', $llavePrimaria);
        $this->db->delete('FormularioAcordeon');
    }
    function insertAcordeon($data)
    {
        $this->db->insert('FormularioAcordeon',$data);
    }


    function getListaTodolistaAcordeon()
    {
        return $this->db->query("SELECT * FROM `Acordeon`")->result_array();
    }

    function insertaDatosPuente($data2)
    {

        $this->db->insert('FormularioAcordeon',$data2);
    }


    function borrarDatosindicabReq($id)
    {
        $this->db->where('idPuente', $id);
        $this->db->delete('FormularioAcordeon');
    }



}

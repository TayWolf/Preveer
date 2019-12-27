<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ApartadoReporte extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }


    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM ApartadoReporte")->row_array();
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
        $perpage = 10; // nilai $perpage disini sama dengan di $config['per_page']
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT * FROM ApartadoReporte")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('ApartadoReporte', $data);
    }

    function obtenerFicha ($idApartadoReporte)
    {
        return $this->db->query("SELECT * from ApartadoReporte where idApartadoReporte=$idApartadoReporte ")->row();
    }


    function modificaDatos($data,$idApartadoReporte)
    {
        $this->db->where('idApartadoReporte', $idApartadoReporte);
        $this->db->update('ApartadoReporte', $data);
    }


    function borrarDatos($idApartadoReporte)
    {
        $this->db->where('idApartadoReporte', $idApartadoReporte);
        $this->db->delete('ApartadoReporte');
    }
    function obtenerIndicadoresApartado($idApartado)
    {
        return $this->db->query("SELECT Apartado_IndicadorReporte.*, indicadorReporte.nombreIndicador FROM Apartado_IndicadorReporte JOIN indicadorReporte ON Apartado_IndicadorReporte.idIndicadorReporte=indicadorReporte.idIndicador WHERE Apartado_IndicadorReporte.idApartadoReporte=$idApartado ORDER BY Apartado_IndicadorReporte.posicion")->result_array();
    }
    function obtenerIndicadoresApartadoRestantes()
    {
        return $this->db->query("SELECT indicadorReporte.* FROM indicadorReporte")->result_array();
    }
    function insertIndicador($data)
    {
        $this->db->insert('Apartado_IndicadorReporte',$data);
    }
    function borrarIndicadores($idApartado)
    {
        $this->db->where('idApartadoReporte', $idApartado);
        $this->db->delete('Apartado_IndicadorReporte');
    }


}
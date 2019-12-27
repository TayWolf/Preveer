<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Acuses extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM AcuseIndicadores")->row_array();
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
        $config['cur_tag_open']='<li class=active><a>';
        $config['cur_tag_close']='</a></li>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['full_tag_open']='<ul class="pagination">';
        $config['full_tag_close']='</ul>';
        $this->pagination->initialize($config);
        return $this->pagination->create_links();
    }

    function getDatos($no_page)
    {
        $perpage = 10;
        if($no_page == 1){
            $first = 0;
            $last  = $perpage;
        }else{
            $first = ($no_page - 1) * $perpage;
            $last  = $first + ($perpage -1);
        }
        return $this->db->query("SELECT AcuseIndicadores.idIndicador, AcuseIndicadores.nombreIndicador, AcuseIndicadores.idGrupoIndicador,  grupoIndicador.nombreGrupo  FROM AcuseIndicadores INNER JOIN grupoIndicador ON AcuseIndicadores.idGrupoIndicador =  grupoIndicador.idGrupoIndicador limit 10 offset $first")->result_array();
    }

    function getGrupoIndicadores()
    {
        return $this->db->query("SELECT * FROM grupoIndicador")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('AcuseIndicadores', $data);
    }

    function obtenerFicha($idIndicador)
    {
        return $this->db->query("SELECT * FROM AcuseIndicadores WHERE idIndicador = $idIndicador")->row();
    }

    function modificaDatos($data, $idIndicador)
    {
        $this->db->where('idIndicador', $idIndicador);
        $this->db->update('AcuseIndicadores', $data);
    }

    function borrarDatos($idIndicador)
    {
        $this->db->where('idIndicador', $idIndicador);
        $this->db->delete('AcuseIndicadores');
    }


}
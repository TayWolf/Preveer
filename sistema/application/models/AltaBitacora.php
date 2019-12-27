<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class altaBitacora extends CI_Model{
    public $variable;
    function __construct(){
        parent::__construct();
    }

    function getTotalRowAllData()
    {
        $query = $this->db->query("SELECT count(*) as row FROM Bitacora")->row_array();
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
        return $this->db->query("SELECT * FROM Bitacora")->result_array();
    }
    function getDatosIndicadorInforme($idIndicador)
    {
        return $this->db->query("SELECT * FROM IndicadorInformeBitacora WHERE idIndicadorInforme=$idIndicador")->result_array();
    }

    function insertaDatos($data)
    {
        $this->db->insert('Bitacora', $data);
    }
    function insertarIndicadorInforme($datos)
    {
        $this->db->insert('IndicadorInformeBitacora', $datos);
    }

    function obtenerFicha ($idBitacora){
        return $this->db->query("SELECT * from Bitacora where idBitacora=$idBitacora ")->row();
    }

    function modificaDatos($data,$idBitacora)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->update('Bitacora', $data);
    }


    function modificarIndicadorInforme($data,$idIndicadorInforme)
    {
        $this->db->where('idIndicadorInforme', $idIndicadorInforme);
        $this->db->update('IndicadorInformeBitacora', $data);
    }


    function borrarDatos($idBitacora)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->delete('Bitacora');
    }
    function getListaTodosIndicadores()
    {
        return $this->db->query("SELECT * FROM indicadorBitacoras")->result_array();
    }
    function obtenerIndicadoresBitacora($idBitacora)
    {
        return $this->db->query("SELECT BitacoraIndicador.*, indicadorBitacoras.nombreIndicador FROM BitacoraIndicador JOIN indicadorBitacoras ON BitacoraIndicador.idIndicador=indicadorBitacoras.idIndicador WHERE idBitacora=$idBitacora ORDER BY BitacoraIndicador.posicion")->result_array();
    }
    function obtenerIndicadoresBitacoraRestantes()
    {
        return $this->db->query("SELECT indicadorBitacoras.* FROM indicadorBitacoras")->result_array();
    }
    function borrarIndicadores($idBitacora)
    {
        $this->db->where('idBitacora', $idBitacora);
        $this->db->delete('BitacoraIndicador');
    }
    function deleteIndicadorInforme($idIndicador)
    {
        $this->db->where('idIndicadorInforme', $idIndicador);
        $this->db->delete('IndicadorInformeBitacora');
    }
    function insertIndicador($data)
    {
        $this->db->insert('BitacoraIndicador',$data);
    }
    function getListaIndicadorInforme($idBitacora)
    {
        return $this->db->query("SELECT * FROM IndicadorInformeBitacora WHERE idBitacora=$idBitacora")->result_array();
    }
}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inmuebles extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
    }
    
    function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM inmuebles")->row_array();
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
		return $this->db->query("SELECT * FROM inmuebles")->result_array();
	}

	function insertaDatos($data)
	{
		$this->db->insert('inmuebles', $data);
		//echo json_encode($data);altaUser
   	}
   	

   	function obtenerFicha ($idArea){
        return $this->db->query("SELECT * from inmuebles where idInmueble=$idArea ")->row();
   	}

   	

      function modificaDatos($data,$idInmueble)
  { 
    $this->db->where('idInmueble', $idInmueble);
    $this->db->update('inmuebles', $data); 
    
    }


    function borrarDatos($idInmueble)
  { 
    $this->db->where('idInmueble', $idInmueble);
    $this->db->delete('inmuebles'); 
    }
  //   function borrarDatospuente($id)
  // { 
  //   $this->db->where('idUsuario', $id);
  //   $this->db->delete('Logeo'); 
  //   }



}
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Areas extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
  }
  
  
  function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Areas")->row_array();
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
		return $this->db->query("SELECT * FROM Areas")->result_array();
	}

	function insertaDatos($data)
	{
		$this->db->insert('Areas', $data);
		//echo json_encode($data);altaUser
   	}
   	function insertaDatosPuent($data2)
   	{
   		$this->db->insert('Logeo', $data2);
   	}

   	function obtenerFicha ($idArea){
        return $this->db->query("SELECT * from Areas where idArea=$idArea ")->row();
   	}

   	function obtenerIdUser($nombreIden,$direccion)
    { 
      /*$this -> db -> select('*');
      $this->db->from('Usuario');
      $this->db->where('nombre',$nombreIden);
       $this->db->where('direccion',$direccion);
      $query = $this->db->get();
      return $query->row();*/
      	return $this->db->query("SELECT * from Usuario where nombre='$nombreIden' and direccion ='$direccion'; ")->result_array();

  

    }

      function modificaDatos($data,$idArea)
  { 
    $this->db->where('idArea', $idArea);
    $this->db->update('Areas', $data); 
    
    }


  function modificaDatosPuente($data2,$idUser)
  { 
    $this->db->where('idUsuario', $idUser);
    $this->db->update('Logeo', $data2); 
    
    }

    function borrarDatos($idArea)
  { 
    $this->db->where('idArea', $idArea);
    $this->db->delete('Areas'); 
    }
  //   function borrarDatospuente($id)
  // { 
  //   $this->db->where('idUsuario', $id);
  //   $this->db->delete('Logeo'); 
  //   }



}
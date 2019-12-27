<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Clientes extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
  }
  
  function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Clientes")->row_array();
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
		return $this->db->query("SELECT * FROM Clientes")->result_array();
	}

	function insertaDatos($data)
	{
		$this->db->insert('Clientes', $data);
		//echo json_encode($data);altaUser
   	}
   	// function insertaDatosPuent($data2)
   	// {
   	// 	$this->db->insert('Logeo', $data2);
   	// }

   	function obtenerFicha ($idCliente){
        return $this->db->query("SELECT * from Clientes where idCliente=$idCliente ")->row();
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

      function modificaDatos($data,$idCliente)
  { 
    $this->db->where('idCliente', $idCliente);
    $this->db->update('Clientes', $data); 
    
    }


  // function modificaDatosPuente($data2,$idUser)
  // { 
  //   $this->db->where('idUsuario', $idUser);
  //   $this->db->update('Logeo', $data2); 
    
  //   }

    function borrarDatos($idCliente)
  { 
    $this->db->where('idCliente', $idCliente);
    $this->db->delete('Clientes'); 
    }
  //   function borrarDatospuente($id)
  // { 
  //   $this->db->where('idUsuario', $id);
  //   $this->db->delete('Logeo'); 
  //   }



}
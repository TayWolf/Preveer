<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModelPrioridadIntervencion extends CI_Model
{
	function __construct(){
		parent::__construct();
  }
 function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM prioridadIntervencion")->row_array();
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
		return $this->db->query("SELECT * FROM prioridadIntervencion")->result_array();
	}


	function insertaDatos($arreglo)
	{
		$this->db->insert('prioridadIntervencion',$arreglo);
	}

function obtenerFicha ($idPrioridad){
        return $this->db->query("SELECT * from prioridadIntervencion where idPrioridad=idPrioridad ")->row();
   	}

   	function obtenerResultado($idPrioridad)
    { 
     
      	return $this->db->query("select * from prioridadIntervencion where idPrioridad=$idPrioridad")->row();

    }  

      function modificaDatos($arreglo,$idPrioridad)
  { 
    $this->db->where('idPrioridad', $idPrioridad);
    $this->db->update('prioridadIntervencion', $arreglo); 
    
    }


  // function modificaDatosPuente($data2,$idUser)
  // { 
  //   $this->db->where('idUsuario', $idUser);
  //   $this->db->update('Logeo', $data2); 
    
  //   }

    function borrarDatos($idPrioridad)
  { 
    $this->db->where('idPrioridad', $idPrioridad);
    $this->db->delete('prioridadIntervencion'); 
    }
  //   function borrarDatospuente($id)
  // { 
  //   $this->db->where('idUsuario', $id);
  //   $this->db->delete('Logeo'); 
  //   }



}

<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ModeloIndicadorReporte extends CI_Model
{
	function __construct(){
		parent::__construct();
  }
 function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM indicadorReporte")->row_array();
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
 		$config['cur_tag_open']='<li class="active"><a>';
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
		return $this->db->query("SELECT * FROM indicadorReporte")->result_array();
	}


	function insertaDatos($arreglo)
	{
		$this->db->insert('indicadorReporte',$arreglo);
	}

function obtenerFicha ($idIndicador){
        return $this->db->query("SELECT * from indicadorReporte where idIndicador=idIndicador ")->row();
   	}

   	function obtenerResultado($idIndi)
    { 
     
      	return $this->db->query("select * from indicadorReporte where idIndicador=$idIndi")->row();

    }  

      function modificaDatos($arreglo,$idIndicador)
  { 
    $this->db->where('idIndicador', $idIndicador);
    $this->db->update('indicadorReporte', $arreglo); 
    
    }


  // function modificaDatosPuente($data2,$idUser)
  // { 
  //   $this->db->where('idUsuario', $idUser);
  //   $this->db->update('Logeo', $data2); 
    
  //   }

    function borrarDatos($idIndicador)
  { 
    $this->db->where('idIndicador', $idIndicador);
    $this->db->delete('indicadorReporte'); 
    }
  //   function borrarDatospuente($id)
  // { 
  //   $this->db->where('idUsuario', $id);
  //   $this->db->delete('Logeo'); 
  //   }


function getListadoPondInf($indicador)
{
    return $this->db->query("select  PonderadorIndicadorRep.idControl,PonderadoresReportes.nombrePonderador FROM  PonderadorIndicadorRep join PonderadoresReportes on  PonderadorIndicadorRep.idPonderador=PonderadoresReportes.idPonderador where  PonderadorIndicadorRep.idIndicador=$indicador")->result_array();
}


function getListaTododlistadoponderador()
{
    return $this->db->query("SELECT * FROM `PonderadoresReportes`")->result_array();
}

function insertaDatosPuente($data2)
{

    $this->db->insert(' PonderadorIndicadorRep',$data2);
}


    function borrarDatosindicabReq($id)
    {
        $this->db->where('idControl', $id);
        $this->db->delete(' PonderadorIndicadorRep');
    }

}
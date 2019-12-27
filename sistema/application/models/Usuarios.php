<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Usuarios extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
	}
	function login($correo,$password)
	{

		$this ->db-> select('*');
		$this ->db-> from('Logeo');
		$this ->db->where('nickName', $correo);
		$this ->db->where('password', $password);
		$this->db->join('Usuario', 'Logeo.idUsuario = Usuario.idUsuario');
		$query = $this -> db -> get();
		// return $query= $this->db->query("SELECT Logeo.nickName, Logeo.tipo, Logeo.idUsuario, Logeo.cambio,Usuario.areaUser FROM Logeo JOIN Usuario ON Logeo.idUsuario = Usuario.idUsuario WHERE Logeo.nickName='$correo' AND Logeo.password=$password")->row();
		if($query -> num_rows() >= 1)
   		{
     		return $query->row();
   		}
   		else
   		{
     		return false;
   		}
	}

  function obtenerUser($nickUser,$correoUser)
  {
    return $this->db->query("SELECT COUNT(Usuario.idUsuario) as cantidad from Usuario join Logeo on Usuario.idUsuario=Logeo.idUsuario where Usuario.correo='$correoUser' || Logeo.nickName='$nickUser'")->row();
  }

  function obtenerUserEditado($nickUser,$correoUser,$idUser)
  {
    return $this->db->query("SELECT COUNT(Usuario.idUsuario) as cantidad from Usuario join Logeo on Usuario.idUsuario=Logeo.idUsuario where (Usuario.correo='$correoUser' || Logeo.nickName='$nickUser') and Usuario.idUsuario!=$idUser")->row();
  }

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Usuario")->row_array();
 		return $query['row'];
	}

	function data_pagination($url, $rows = 5, $uri = 3)
	{
 		$this->load->library('pagination');
		 $config['per_page']   = 10;
		 $config['first_link'] = 'Primero';
        $config['first_tag_open'] = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_link'] = 'Último';
        $config['last_tag_open'] = '<li>';
        $config['last_tag_close'] = '</li>';
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
		return $this->db->query("SELECT Logeo.*, Areas.nombreArea as areaUser FROM Logeo JOIN Usuario ON Logeo.idUsuario = Usuario.idUsuario JOIN Areas ON Areas.idArea=Usuario.areaUser")->result_array();
	}

	function insertaDatos($data)
	{
		$this->db->insert('Usuario', $data);
		//echo json_encode($data);altaUser
   	}
   	function insertaDatosPuent($data2)
   	{
   		$this->db->insert('Logeo', $data2);
   	}

   	function obtenerFicha ($idUser){
   		return $this->db->query("SELECT Usuario.*,Logeo.* from Usuario join Logeo on Usuario.idUsuario=Logeo.idUsuario where Usuario.idUsuario=$idUser ")->row();
   	}

   	function obtenerIdUser($nombreIden,$rfcUser)
    { 
      	return $this->db->query("SELECT * from Usuario where nombre='$nombreIden' and rfcUser ='$rfcUser'; ")->result_array();
    }

      function modificaDatos($data,$idUser)
  { 
    $this->db->where('idUsuario', $idUser);
    $this->db->update('Usuario', $data); 
    
    }
    function modificaPassword($data,$idUser)
  { 
    $this->db->where('idUsuario', $idUser);
    $this->db->update('Logeo', $data); 
    
    }


  function modificaDatosPuente($data2,$idUser)
  { 
    $this->db->where('idUsuario', $idUser);
    $this->db->update('Logeo', $data2); 
    
    }

    function borrarDatos($id)
  { 
    $this->db->where('idUsuario', $id);
    $this->db->delete('Usuario'); 
    }
    function borrarDatospuente($id)
  { 
    $this->db->where('idUsuario', $id);
    $this->db->delete('Logeo'); 
		}
	
	function getAreas()
	{
		return $this->db->query("SELECT * FROM Areas")->result_array();
	}



}
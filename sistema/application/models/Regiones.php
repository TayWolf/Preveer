<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Regiones extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
	}

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM regiones")->row_array();
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
		return $this->db->query("SELECT regiones.*, municipios.nombreMunicipio FROM regiones JOIN municipios ON regiones.municipio=municipios.idMunicipio")->result_array();
	}
	
	function getEstados(){
		return $this->db->query("SELECT * FROM estados")->result_array();
	}
	
	function traerMunicipio($idEdo){
		return $this->db->query("SELECT * FROM municipios WHERE estado=$idEdo")->result_array();
	}
	
	function traercp($idMunicipio){
		return $this->db->query("SELECT * FROM regiones WHERE municipio=$idMunicipio group by cp")->result_array();
	}

	function insertaDatos($data)
	{
		$this->db->insert('regiones', $data);
		//echo json_encode($data);altaUser
   	}


      function modificaDatos($data,$idR)
  { 
    $this->db->where('idRegiones', $idR);
    $this->db->update('regiones', $data); 
    
    }

 

    function borrarDatos($id)
	{ 
		$this->db->where('idRegiones', $id);
    $this->db->delete('regiones'); 
    }
	
	function cuentaTodosRegiones()
    {
        return $this->db->get('regiones')->num_rows();
    }
	
	function allRegiones($limit,$start,$col,$dir)
    {
        
        $query = $this->db->select("regiones.*,municipios.idMunicipio, municipios.nombreMunicipio,estados.nombreEstado,estados.id_Estado")
            ->from("regiones")
            ->join("municipios", "regiones.municipio=municipios.idMunicipio")
            ->join("estados", "estados.id_Estado=municipios.estado")
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();

        // echo "select regiones.*, municipios.nombreMunicipio from regiones join municipios on regiones.municipio=municipios.idMunicipio limit $limit,$start order_by $col,$dir ";
        if($query->num_rows()>0)
        {
            
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }

	
	 function busquedaRegion($limit,$start,$search,$col,$dir)
    {
        $query = $this->db->select("regiones.*,municipios.idMunicipio, municipios.nombreMunicipio,estados.nombreEstado,estados.id_Estado")
            ->from("regiones ")
            ->join("municipios", "regiones.municipio=municipios.idMunicipio")
            ->join("estados", "estados.id_Estado=municipios.estado")
            ->like('nombreRegion',$search)
            ->or_like('nombreMunicipio',$search)
            ->or_like('cp',$search)
            ->or_like('nombreEstado',$search)
            ->limit($limit,$start)
            ->order_by($col,$dir)
            ->get();


        if($query->num_rows()>0)
        {
            return $query->result_array();
        }
        else
        {
            return null;
        }
    }
	
	function cuentaRegionesfiltrados($search)
    {
        $query = $this
            ->db->select("regiones.idRegiones")
            ->from("regiones ")
            ->join("municipios", "regiones.municipio=municipios.idMunicipio")
            ->join("estados", "estados.id_Estado=municipios.estado")
            ->like('nombreRegion',$search)
            ->or_like('nombreMunicipio',$search)
            ->or_like('cp',$search)
            ->or_like('nombreEstado',$search)
            ->get();

        return $query->num_rows();
    }



}
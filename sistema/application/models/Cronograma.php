<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cronograma extends CI_Model{
    public $variable;
	function __construct(){
		parent::__construct();
	}
	

	function getTotalRowAllData()
	{
 		$query = $this->db->query("SELECT count(*) as row FROM Usuario")->row_array();
 		return $query['row'];
	}

	function getOtis()
    {
        return $this->db->query("SELECT Oti.idOti FROM Oti")->result_array();
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

	function getDatos($orden)
	{
		 
		return $this->db->query("SELECT Usuario.idUsuario,Usuario.nombre as nombreUser,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre as nombreUnidad,Formato.nombre,visitasshi.fechaVisita FROM Usuario join AnalistaOti on AnalistaOti.idUsuario=Usuario.idUsuario join asignaInmueble on asignaInmueble.idAsignacion=AnalistaOti.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join visitasshi on visitasshi.idAsignacion=asignaInmueble.idAsignacion join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato GROUP by CentrosDeTrabajo.nombre $orden")->result_array();
	}
	function getDatosVisitas()
    {
        return $this->db->query("SELECT Usuario.idUsuario,Usuario.nombre as nombreUser,CentrosDeTrabajo.idCentroTrabajo,CentrosDeTrabajo.nombre as nombreUnidad,
                                      Formato.nombre,visitasshi.fechaVisita, regiones.nombreRegion, municipios.nombreMunicipio, estados.nombreEstado
                                    FROM Usuario
                                      join AnalistaOti on AnalistaOti.idUsuario=Usuario.idUsuario
                                      join asignaInmueble on asignaInmueble.idAsignacion=AnalistaOti.idAsignacion
                                      join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo
                                      JOIN regiones ON CentrosDeTrabajo.idColonia = regiones.idRegiones
                                      JOIN municipios ON regiones.municipio = municipios.idMunicipio
                                      JOIN estados ON municipios.estado = estados.id_Estado
                                      join visitasshi on visitasshi.idAsignacion=asignaInmueble.idAsignacion
                                      join Formato on Formato.idFormato=CentrosDeTrabajo.idFormato
                                    GROUP by CentrosDeTrabajo.nombre ORDER BY nombreEstado, nombreMunicipio, nombreRegion;")->result_array();

    }

  function getDatosFecha($idUser,$idCe)
  {
     
    return $this->db->query("SELECT Usuario.nombre as nombreUser,CentrosDeTrabajo.nombre as nombreUnidad,visitasshi.fechaVisita,visitasshi.status FROM Usuario join AnalistaOti on AnalistaOti.idUsuario=Usuario.idUsuario join asignaInmueble on asignaInmueble.idAsignacion=AnalistaOti.idAsignacion join CentrosDeTrabajo on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo join visitasshi on visitasshi.idAsignacion=asignaInmueble.idAsignacion where Usuario.idUsuario = $idUser and CentrosDeTrabajo.idCentroTrabajo=$idCe order by fechaVisita")->result_array();
  }

	
   	function obtenerFicha ($idUser){
   		return $this->db->query("SELECT Usuario.*,Logeo.* from Usuario join Logeo on Usuario.idUsuario=Logeo.idUsuario where Usuario.idUsuario=$idUser ")->row();
   	}


}
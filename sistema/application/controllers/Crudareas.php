<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAreas extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("areas"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->areas->data_pagination("/Cruduareas/index/", 
        $this->areas->getTotalRowAllData(), 3);
     	$data['listAreas'] = $this->areas->getDatos($index); 
		$this->load->view('viewtodoareas',$data);  

		
	}

	public function formAltaArea()
	{
			$this->load->view('formareas');  
	}


	

public function formEditarArea($idArea=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idArea' => $idArea];
			$this->load->view('grideditararea',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->areas->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idArea = $this->input->post('idArea');
      $data = ['nombreArea' => $this->input->post('nombreArea')];
			$this->areas->modificaDatos($data,$idArea);

	}
	

	
		function altaArea()
	{	

			 $data = ['nombreArea' => $this->input->post('nombreArea')];

			$this->areas->insertaDatos($data);
	}


	function deleteArea($idArea){

		$this->areas->borrarDatos($idArea);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudareas');
		
	}
		

	}

?>
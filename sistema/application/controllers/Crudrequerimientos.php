<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudRequerimientos extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("requerimientos"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->requerimientos->data_pagination("/Crudrequerimientos/index/", 
        $this->requerimientos->getTotalRowAllData(), 3);
     	$data['listRequerimientos'] = $this->requerimientos->getDatos($index); 
		$this->load->view('viewtodorequerimientos',$data);  

		
	}

	public function formAltaRequerimiento()
	{
			$this->load->view('formrequerimiento');  
	}


	

public function formEditarRequerimiento($idRequerimiento=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idRequerimiento' => $idRequerimiento];
			$this->load->view('grideditarequerimiento',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->requerimientos->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idRequerimiento = $this->input->post('idRequerimiento');
      $data = ['nombreRequerimiento' => $this->input->post('nombreRequerimiento')];
			$this->requerimientos->modificaDatos($data,$idRequerimiento);

	}
	

	
		function altaRequerimiento()
	{	

			 $data = ['nombreRequerimiento' => $this->input->post('nombreRequerimiento')];
			//echo "dato".$this->input->post('nombreRequerimiento');
			$this->requerimientos->insertaDatos($data);
	}


	function deleteRequerimiento($idRequerimiento){

		$this->requerimientos->borrarDatos($idRequerimiento);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudrequerimientos');
		
	}
		

	}

?>
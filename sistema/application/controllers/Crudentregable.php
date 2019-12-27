<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudEntregable extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("entregable"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->entregable->data_pagination("/Crudentregable/index/", 
        $this->entregable->getTotalRowAllData(), 3);
     	$data['listEntregable'] = $this->entregable->getDatos($index); 
		$this->load->view('viewtodoentregable',$data);  

		
	}

	public function formAltaEntregable()
	{
			$this->load->view('formentregable');  
	}


	

public function formEditarInmueble($idEntregable=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idEntregable' => $idEntregable];
			$this->load->view('grideditaentregable',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->entregable->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idEntregable = $this->input->post('idEntregable');
      $data = ['nombreEntregable' => $this->input->post('nombreEntregable')];
			$this->entregable->modificaDatos($data,$idEntregable);

	}
	

	
		function altaEntregable()
	{	

			 $data = ['nombreEntregable' => $this->input->post('nombreEntregable')];

			$this->entregable->insertaDatos($data);
	}


	function deleteEntregable($idEntre){

		$this->entregable->borrarDatos($idEntre);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudentregable');
		
	}
		

	}

?>
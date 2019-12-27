<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudInmueble extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("inmuebles"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->inmuebles->data_pagination("/Crudinmueble/index/", $this->inmuebles->getTotalRowAllData(), 3);
     	$data['listInmuebles'] = $this->inmuebles->getDatos($index); 
		$this->load->view('viewtodoinmuebles',$data);  

		
	}

	public function formAltaInmuebles()
	{
			$this->load->view('forminmuebles');  
	}


	

public function formEditarInmueble($idInmueble=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idInmueble' => $idInmueble];
			$this->load->view('grideditainmueble',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->inmuebles->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idInmueble = $this->input->post('idInmueble');
      $data = ['nombreInmueble' => $this->input->post('nombreInmueble')];
			$this->inmuebles->modificaDatos($data,$idInmueble);

	}
	

	
		function altaInmueble()
	{	

			 $data = ['nombreInmueble' => $this->input->post('nombreInmueble')];

			$this->inmuebles->insertaDatos($data);
	}


	function deleteInmueble($idInmueble){

		$this->inmuebles->borrarDatos($idInmueble);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudinmueble');
		
	}
		

	}

?>
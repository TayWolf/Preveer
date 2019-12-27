<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudClientes extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("clientes"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->clientes->data_pagination("/Crudclientes/index/", 
        $this->clientes->getTotalRowAllData(), 3);
     	$data['listClientes'] = $this->clientes->getDatos($index); 
		$this->load->view('viewtodoclientes',$data);  

		
	}

	public function formAltaCliente()
	{
			$this->load->view('formcliente');  
	}


	

public function formEditarCliente($idCliente=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idCliente' => $idCliente];
			$this->load->view('grideditarcliente',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->clientes->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idCliente = $this->input->post('idCliente');
      //$data = ['nombreCliente' => $this->input->post('nombreCliente')];
      $data = array(	
			'nombreCliente' => $this->input->post('nombreCliente'),
			'correoCl' => $this->input->post('correClient'),
			'passwordCl' => $this->input->post('passwoCliente')
			);
			$this->clientes->modificaDatos($data,$idCliente);

	}
	

	
		function altaCliente()
	{	
		$data = array(	
			'nombreCliente' => $this->input->post('nombreCliente'),
			'correoCl' => $this->input->post('correClient'),
			'passwordCl' => $this->input->post('passwoCliente')
			);

			$this->clientes->insertaDatos($data);
	}


	function deleteCliente($idCliente){

		$this->clientes->borrarDatos($idCliente);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudclientes');
		
	}
		

	}

?>
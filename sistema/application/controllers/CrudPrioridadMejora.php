<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPrioridadMejora extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelPrioridadMejora');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModelPrioridadMejora->data_pagination("/CrudPrioridadMejora/index/", 
        $this->ModelPrioridadMejora->getTotalRowAllData(), 3);
     	$data['listaprioridad'] = $this->ModelPrioridadMejora->getDatos($index); 
		$this->load->view('viewTodoPrioridadMejora',$data);  
    }

    public function formAltaPrioridad()
	{
			$this->load->view('viewPrioridadMejora');  
			//$this->load->view('formnombre');  
	}


public function formEditarPrioridad($idPrioridad=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idPrioridad' => $idPrioridad];
			$this->load->view('grideditarPrioridad',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModelPrioridadMejora->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idPrioridad = $this->input->post('idPrioridad');
			$data=array(
				'nombre'=>$this->input->post('nombre'),
				'color'=>$this->input->post('color')
			);
      
			$this->ModelPrioridadMejora->modificaDatos($data,$idPrioridad);

	}
	

	
		function altaPrioridad()
	{	
			
			$nombre=$this->input->post('nombre');
			$color=$this->input->post('color');

			$data=array(
				'nombre'=>$nombre, 'color' => $color);
				
			//echo "entra $nombre cantidadFotos $cantidadFotos";
			$this->ModelPrioridadMejora->insertaDatos($data);
			
	}


	function deletePrioridad($idPrioridad){

		$this->ModelPrioridadMejora->borrarDatos($idPrioridad);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPrioridadMejora');
		
	}

	function getDatosprioridad($idPrioridad){

    	echo json_encode ($this->ModelPrioridadMejora->obtenerResultado($idPrioridad));

	}


	}

?>
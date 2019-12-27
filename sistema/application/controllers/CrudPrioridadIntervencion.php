<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPrioridadIntervencion extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelPrioridadIntervencion');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModelPrioridadIntervencion->data_pagination("/CrudPrioridadIntervencion/index/", 
        $this->ModelPrioridadIntervencion->getTotalRowAllData(), 3);
     	$data['listaprioridad'] = $this->ModelPrioridadIntervencion->getDatos($index); 
		$this->load->view('viewTodoPrioridadIntervencion',$data);  
    }

    public function formAltaPrioridad()
	{
			$this->load->view('viewPrioridadIntervencion');  
			//$this->load->view('formnombre');  
	}


public function formEditarPrioridad($idPrioridad=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idPrioridad' => $idPrioridad];
			$this->load->view('grideditarIntervencion',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModelPrioridadIntervencion->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			
			$idPrioridad = $this->input->post('idPrioridad');
			$data=array(
				'nombre'=>$this->input->post('nombre'),
				'color'=>$this->input->post('color')
				
			);
      
			$this->ModelPrioridadIntervencion->modificaDatos($data,$idPrioridad);

	}
	

	
		function altaPrioridad()
	{	
			
			$nombre=$this->input->post('nombre');
			$color=$this->input->post('color');
			$data=array(
				
			'nombre' => $this->input->post('nombre'),
            'color' => $this->input->post('color')
				);
			//echo "entra $nombre cantidadFotos $cantidadFotos";
			$this->ModelPrioridadIntervencion->insertaDatos($data);
			
	}


	function deletePrioridad($idPrioridad){

		$this->ModelPrioridadIntervencion->borrarDatos($idPrioridad);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPrioridadIntervencion');
		
	}

	function getDatosprioridad($idPrioridad){
		$Resultado= $this->ModelPrioridadIntervencion->obtenerResultado($idPrioridad);
    	echo json_encode ($Resultado);

	}


	}

?>
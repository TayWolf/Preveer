<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPonderadorReporte extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModeloPonderadorReporte');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModeloPonderadorReporte->data_pagination("/CrudPonderadorReporte/index/", 
        $this->ModeloPonderadorReporte->getTotalRowAllData(), 3);
     	$data['listaPonderador'] = $this->ModeloPonderadorReporte->getDatos($index); 
		$this->load->view('viewTodoPondeReporte',$data);  
    }

    public function formAltaPonderador()
	{
			$this->load->view('viewPonderadorReporte');  
			//$this->load->view('formPonderador');  
	}


public function formEditarPonderador($idPonderador=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idPonderador' => $idPonderador];
			$this->load->view('grideditarPondeReporte',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModeloPonderadorReporte->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idPonderador = $this->input->post('idPonderador');
			$data=array(
				'nombrePonderador'=>$this->input->post('nombrePonderador')
				
			);
      
			$this->ModeloPonderadorReporte->modificaDatos($data,$idPonderador);

	}
	

	
		function altaPonderador()
	{	
			$ponderador=$this->input->post('nombrePonderador');
			
			$data=array(
				'nombrePonderador'=>$ponderador);
				
			//echo "entra $Ponderador cantidadFotos $cantidadFotos";
			$this->ModeloPonderadorReporte->insertaDatos($data);
			
	}


	function deletePonderador($idPonderador){

		$this->ModeloPonderadorReporte->borrarDatos($idPonderador);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPonderadorReporte');
		
	}

	function getDatosPonderador($idPonderador){
		$Resultado= $this->ModeloPonderadorReporte->obtenerResultado($idPonderador);
    	echo json_encode ($Resultado);

	}


	}

?>
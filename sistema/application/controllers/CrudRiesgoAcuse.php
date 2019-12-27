<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudRiesgoAcuse extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('RiesgoAcuse');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->RiesgoAcuse->data_pagination("/CrudRiesgoAcuse/index/", 
        $this->RiesgoAcuse->getTotalRowAllData(), 3);
     	$data['listaRiesgoAcuse'] = $this->RiesgoAcuse->getDatos($index); 
		$this->load->view('viewTodoRiesgoAcuse',$data);  
    }

    public function formAltaRiesgoAcuse()
	{
			$this->load->view('formRegistroAcuse');  
			//$this->load->view('formPonderador');  
	}


public function formEditarRiesgoAcuse($idRiesgo=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idRiesgo' => $idRiesgo];
			$this->load->view('gridEditarRiesgoAcuse',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->RiesgoAcuse->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idRiesgo = $this->input->post('idRiesgo');
			$data=array(
				'nombreRiesgo'=>$this->input->post('nombreRiesgo')
				
			);
      
			$this->RiesgoAcuse->modificaDatos($data,$idRiesgo);

	}
	

	
		function altaRiesgoAcuse()
	{	
			$riesgo=$this->input->post('nombreRiesgo');
			
			$data=array(
				'nombreRiesgo'=>$riesgo);
				
			//echo "entra $Ponderador cantidadFotos $cantidadFotos";
			$this->RiesgoAcuse->insertaDatos($data);
			
	}


	function deleteRiesgoAcuse($idRiesgo){

		$this->RiesgoAcuse->borrarDatos($idRiesgo);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudRiesgoAcuse');
		
	}

	function getDatosRiesgoAcuse($idRiesgo){
		$Resultado= $this->RiesgoAcuse->obtenerResultado($idRiesgo);
    	echo json_encode ($Resultado);

	}


	}

?>
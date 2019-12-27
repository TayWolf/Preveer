<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IndicadorInfraestructura extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('IndicadorInfraestructuraModelo');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->IndicadorInfraestructuraModelo->data_pagination("/IndicadorInfraestructura/index/", 
        $this->IndicadorInfraestructuraModelo->getTotalRowAllData(), 3);

     	$data['listaInd'] = $this->IndicadorInfraestructuraModelo->getDatos($index); 



		$this->load->view('viewTodoIndicadoresInfraestructura',
			$data);  


    }

    public function formAltaIndicador()
	{
			$this->load->view('viewpIndicadorinfra');  
			//$this->load->view('formindicador');  
	}


public function formEditarIndicador($idIndicaor=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idIndicador' => $idIndicador];
			$this->load->view('grideditarindicador',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->IndicadorInfraestructuraModelo->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idIndicaor = $this->input->post('idIndicador');
      $data = ['nombreIndicador' => $this->input->post('nombreIndicador')];
			$this->IndicadorInfraestructuraModelo->modificaDatos($data,$idIndicador);

	}
	

	
		function altaIndicador()
	{	

			 $data = ['nombreIndicador' => $this->input->post('nombreIndicador')];

			$this->clientes->insertaDatos($data);
	}


	function deleteIndicador($idCliente){

		$this->IndicadorInfraestructuraModelos->borrarDatos($idIndicador);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/IndicadorInfraestructura');
		
	}
		

	}

?>
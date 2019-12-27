<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudIndicadorReporte extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModeloIndicadorReporte');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModeloIndicadorReporte->data_pagination("/CrudIndicadorReporte/index/", 
        $this->ModeloIndicadorReporte->getTotalRowAllData(), 3);
     	$data['listaIndicador'] = $this->ModeloIndicadorReporte->getDatos($index); 
		$this->load->view('viewTodoIndicadorReportes',$data);  
    }

    public function formAltaIndicador()
	{
			$this->load->view('viewIndReporte');  
			//$this->load->view('formindicador');  
	}


public function formEditarIndicador($idIndicador=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idIndicador' => $idIndicador];
			$this->load->view('grideditarIndReporte',$data); 
	}

	

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModeloIndicadorReporte->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idIndicaor = $this->input->post('idIndicador');
			$data=array(
				'nombreIndicador'=>$this->input->post('nombreIndicador'),
				'tipo'=>$this->input->post('tipo'),
				'required'=>$this->input->post('required')
			);
      
			$this->ModeloIndicadorReporte->modificaDatos($data,$idIndicaor);

	}
	

	
		function altaIndicador()
	{	
			$indicador=$this->input->post('nombreIndicador');
			$cantidadFotos=$this->input->post('tipo');
			$required=$this->input->post('required');
			$data=array(
				'nombreIndicador'=>$indicador,
				'tipo'=>$cantidadFotos,
			     'required'=>$required);
			//echo "entra $indicador cantidadFotos $cantidadFotos";
			$this->ModeloIndicadorReporte->insertaDatos($data);
			
	}


	function deleteIndicador($idIndicador){

		$this->ModeloIndicadorReporte->borrarDatos($idIndicador);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorReporte');
		
	}

	function getDatosIndiucador($idIndicador){
		$Resultado= $this->ModeloIndicadorReporte->obtenerResultado($idIndicador);
    	echo json_encode ($Resultado);

	}

	public function listaPonderador($idIndicador)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idIndicador' => $idIndicador];
		   $data['listadoponderador'] = $this->ModeloIndicadorReporte->getListadoPondInf($idIndicador);
		     $data['listadoponderadores'] = $this->ModeloIndicadorReporte->getListaTododlistadoponderador();
			$this->load->view('gridlistapondeReporte',$data); 
	}

	function altaPuente()
	{
		$idIndicador=$this->input->post('idIndicador');
		$tot=$this->input->post('tot');


		 for ($i=1; $i <= $tot ; $i++) { 
            $idP= $this->input->post('idR'.$i);
            if ($idP != "") {
            	//echo "entra idponde $idP";
                 $data2 = array(
                'idIndicador' => $idIndicador,    
                'idPonderador' => $idP 
                 );
                $this->ModeloIndicadorReporte->insertaDatosPuente($data2);
                
            }
        }
		

	}

		function deletePuente($id,$idI){

		$this->ModeloIndicadorReporte->borrarDatosindicabReq($id);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorReporte/listaPonderador/'.$idI);
		
	}
		


	}

?>
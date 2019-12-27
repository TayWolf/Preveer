<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudIndicadorInfra extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModeloIndicadorInfraestructura');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModeloIndicadorInfraestructura->data_pagination("/CrudIndicadorInfra/index/", 
        $this->ModeloIndicadorInfraestructura->getTotalRowAllData(), 3);
     	$data['listaIndicador'] = $this->ModeloIndicadorInfraestructura->getDatos($index); 
		$this->load->view('viewTodoIndicadoresInfraestructura',$data);  
    }

    public function formAltaIndicador()
	{
			$this->load->view('viewpIndicadorinfra');  
			//$this->load->view('formindicador');  
	}


public function formEditarIndicador($idIndicador=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idIndicador' => $idIndicador];
			$this->load->view('grideditarindicador',$data); 
	}

	

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModeloIndicadorInfraestructura->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idIndicaor = $this->input->post('idIndicador');
			$data=array(
				'nombreIndicador'=>$this->input->post('nombreIndicador'),
				'nombreFotos'=>$this->input->post('nombreFotos')
			);
      
			$this->ModeloIndicadorInfraestructura->modificaDatos($data,$idIndicaor);

	}
	

	
		function altaIndicador()
	{	
			$indicador=$this->input->post('nombreIndicador');
			$cantidadFotos=$this->input->post('nombreFotos');
			$data=array(
				'nombreIndicador'=>$indicador,
				'nombreFotos'=>$cantidadFotos);
			//echo "entra $indicador cantidadFotos $cantidadFotos";
			$this->ModeloIndicadorInfraestructura->insertaDatos($data);
			
	}


	function deleteIndicador($idIndicador){

		$this->ModeloIndicadorInfraestructura->borrarDatos($idIndicador);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorInfra');
		
	}

	function getDatosIndiucador($idIndicador){
		$Resultado= $this->ModeloIndicadorInfraestructura->obtenerResultado($idIndicador);
    	echo json_encode ($Resultado);

	}

	public function listaPonderador($idIndicador)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idIndicador' => $idIndicador];
		   $data['listadoponderador'] = $this->ModeloIndicadorInfraestructura->getListadoPondInf($idIndicador);
		     $data['listadoponderadores'] = $this->ModeloIndicadorInfraestructura->getListaTododlistadoponderador();
			$this->load->view('gridlistaponderado',$data); 
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
                $this->ModeloIndicadorInfraestructura->insertaDatosPuente($data2);
                
            }
        }
		

	}

		function deletePuente($id,$idI){

		$this->ModeloIndicadorInfraestructura->borrarDatosindicabReq($id);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorInfra/listaPonderador/'.$idI);
		
	}
		


	}

?>
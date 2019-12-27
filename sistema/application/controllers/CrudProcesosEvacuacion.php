<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudProcesosEvacuacion extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelProcesosEvacuacion');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModelProcesosEvacuacion->data_pagination("/CrudProcesosEvacuacion/index/", 
        $this->ModelProcesosEvacuacion->getTotalRowAllData(), 3);
     	$data['listaprocesos'] = $this->ModelProcesosEvacuacion->getDatos($index); 
		$this->load->view('viewTodoProcesosEvacuacion',$data);  
    }

    public function formAltaProcesos()
	{
			$data['listaPasos']= $this->ModelProcesosEvacuacion->obtenerListaPasos();
			$this->load->view('viewProcesosEvacuacion',$data);  
			//$this->load->view('formnombre');  
	}


	public function formEditarProcesos($idProceso)

	{
		// $idArea=$_REQUEST['id'];

			$data['listaPasos']= $this->ModelProcesosEvacuacion->obtenerListaPasos();
		    $data['idProceso'] = $idProceso;
		    $data['datosProceso'] = $this->ModelProcesosEvacuacion->obtenerFicha($idProceso);
			$this->load->view('grideditarProceso',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModelProcesosEvacuacion->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		$idProceso = $this->input->post('idProceso');
		$data=array(
			'proceso'=>$this->input->post('proceso'),
			'id_paso'=>$this->input->post('idPaso')
		);
      $this->ModelProcesosEvacuacion->modificaDatos($data,$idProceso);

	}
	
	function ordenarProcesos()
    {
        $arreglo=$this->input->post("arreglo");
        for($i=0; $i<sizeof($arreglo); $i++)
        {
            $idProceso=$arreglo[$i];
            $this->ModelProcesosEvacuacion->modificaDatos(array("orden" => $i), $idProceso);
        }
        echo json_encode($this->ModelProcesosEvacuacion->getAllProcesos());
    }
	
		function altaProceso()
	{	
			
			$nombre=$this->input->post('proceso');
			$paso=$this->input->post('idPaso');
			$orden=1;

			$data=array(
				'proceso'=>$nombre, 'id_paso' => $paso, 'orden'=>$orden);
				
			//echo "entra $nombre cantidadFotos $cantidadFotos";
			$this->ModelProcesosEvacuacion->insertaDatos($data);
			
	}


	function deleteProceso($idProceso){

		$this->ModelProcesosEvacuacion->borrarDatos($idProceso);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudProcesosEvacuacion');
		
	}

	function getDatosproceso($idProceso){

    	echo json_encode ($this->ModelProcesosEvacuacion->obtenerResultado($idProceso));

	}


	}

?>
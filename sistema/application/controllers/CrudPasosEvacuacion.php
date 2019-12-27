<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPasosEvacuacion extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model('ModelPasosEvacuacion');
	}

	public function index($index=1)
	{
		//Carga la paginacion
		$data['page'] = $this->ModelPasosEvacuacion->data_pagination("/CrudPasosEvacuacion/index/", 
        $this->ModelPasosEvacuacion->getTotalRowAllData(), 3);
     	$data['listapasos'] = $this->ModelPasosEvacuacion->getDatos($index); 
		$this->load->view('viewTodoPasosEvacuacion',$data);  
    }

    public function formAltaPasos()
	{
			$data['listapasos'] = $this->ModelPasosEvacuacion->obtenerListaPasos();
			$this->load->view('viewPasosEvacuacion');  
			//$this->load->view('formnombre');  
	}


    public function formEditarPaso($id_paso)

	{
		    $data['listapasos'] = $this->ModelPasosEvacuacion->obtenerListaPasos();
		    $data = ['id_paso' => $id_paso];
			$this->load->view('grideditarPasosEvacuacion',$data); 
	}


	function obtenerDatos($idu)
	{
		
    	$prueba= $this->ModelPasosEvacuacion->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){
			
		$id_paso = $this->input->post('id_paso');
		$data=array('paso'=>$this->input->post('paso')
				
				
		);
      
		$this->ModelPasosEvacuacion->modificaDatos($data,$id_paso);

	}
	

	
		function altaPasos()
	{	
			
			$paso=$this->input->post('paso');
			
			$data=array(
				
			'paso' => $this->input->post('paso')
            
				);
			//echo "entra $nombre cantidadFotos $cantidadFotos";
			$this->ModelPasosEvacuacion->insertaDatos($data);
			
	}


	function deletePaso($id_paso){

		$this->ModelPasosEvacuacion->borrarDatos($id_paso);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPasosEvacuacion');
		
	}


	function ordenarStatus(){

	    $arreglo=$this->input->post("arreglo");
        for($i=0; $i<sizeof($arreglo); $i++)
        {
            $id_paso=$arreglo[$i];
            $this->ModelPasosEvacuacion->modificaDatos(array("ordenPaso" => $i),$id_paso);
        }
        echo json_encode($this->ModelPasosEvacuacion->getAllProcesos());
    }

    function getDatosPasoEvacuacion($id_paso)
    {
  		echo json_encode($this->ModelPasosEvacuacion->obtenerResultado($id_paso));
    }


	}

?>


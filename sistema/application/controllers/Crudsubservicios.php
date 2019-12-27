<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudSubservicios extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("subservicios"); //cargamos el modelo
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->subservicios->data_pagination("/Crudsubservicios/index/", 
        $this->subservicios->getTotalRowAllData(), 3);
     	$data['listSubServicios'] = $this->subservicios->getDatos($index); 
		$this->load->view('viewtodosubservicios',$data);  

		
	}

	public function formAltaSubservicio()
	{
			$data['servicios'] = $this->subservicios->getListadoServicios(); //obtener las areas registradas en la Base de Datos
			$this->load->view('formsubservicio',$data);  
	}


	

public function formEditarSubservicio($idSubservicio=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idSubservicio' => $idSubservicio, 'servicios' => $this->subservicios->getListadoServicios()];
			$this->load->view('grideditarsubservicio',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->subservicios->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idSubserv = $this->input->post('idSubserv');
      $data = ['nombre' => $this->input->post('nombreSubservicio')];
			$this->subservicios->modificaDatos($data,$idSubserv);

	}
	

	
		function altaSubservicio()
	{	

			//Creao un arreglo con la misma estructura de la tabla a insertar
			$data = array(
							
							'nombre'=>$this->input->post('nombreSubservicio')
						 );

			$this->subservicios->insertaDatos($data);
	}


	function deleteSubservicio($idsubserv){

        $this->subservicios->borrarDatos($idsubserv);
		// $this->usuarios->borrarDatospuente($idUser);
		//redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios');

	}


	public function listaRequerimientos($idSubserv=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idSubserv' => $idSubserv];
		    $data['listaSubseReq'] = $this->subservicios->getListadoSubReq($idSubserv);
		    $data['listaReq'] = $this->subservicios->getListarequerimientos();
			$this->load->view('gridlistasubsereq',$data); 
	}

	function altaPuente($tot)
    {
        
         for ($i=1; $i <= $tot ; $i++) { 
            $idReque = $this->input->post('idR'.$i);
            $idSubSer = $this->input->post('idSubserv');
          
            if ($idReque != "") {
                $data2 = array(
                'idSubservicio' => $idSubSer,    
                'idRequerimiento' => $idReque 
                );
                $this->subservicios->insertaDatosPuente($data2);
                
            }
        }
	}
	
	function deletePuente($id){

		$this->subservicios->borrarDatosSubReq($id);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudsubservicios');
		
	}
		

	}

?>
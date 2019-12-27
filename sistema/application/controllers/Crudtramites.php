<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudTramites extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("tramites"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->tramites->data_pagination("/Crudtramites/index/", 
        $this->tramites->getTotalRowAllData(), 3);
     	$data['listTramites'] = $this->tramites->getDatos($index); 
		$this->load->view('viewtodotramites',$data);  

		
	}

	public function formAltaTramite()
	{
			$this->load->view('formtramite');  
	}


	

public function formEditarTramite($idTramite=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idTramite' => $idTramite];
			$this->load->view('grideditartramite',$data); 
	}

	function obtenerDatos($idu)
	{
		
    	$prueba= $this->tramites->obtenerFicha($idu);
    	echo json_encode ($prueba);
	}

	function modificarDatos(){

		 
			$idTramite = $this->input->post('idTramite');
      $data = ['nombreTramite' => $this->input->post('nombreTramite')];
			$this->tramites->modificaDatos($data,$idTramite);

	}
	

	
		function altaTramite()
	{	

			 $data = ['nombreTramite' => $this->input->post('nombreTramite')];

			$this->tramites->insertaDatos($data);
	}


	function deleteTramite($idTramite){

		$this->tramites->borrarDatos($idTramite);
		// $this->usuarios->borrarDatospuente($idUser);
		redirect('https://cointic.com.mx/preveer/sistema/index.php/Crudtramites');
		
	}
		

	}

?>
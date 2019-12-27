<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class RiesgoAcuse extends CI_Controller {
	function __construct(){
		parent::__construct();
	}

	public function index()
	{

		$tipo=$this->session->userdata('tipoUser');
		if($tipo!='' && $_SESSION['idusuariobase'] != '')
		{
		//$data['page'] = $this->usuarios->data_pagination("/Crudusuarios/index/", 
        //$this->usuarios->getTotalRowAllData(), 3);
		 // $data['listAreas'] = $this->areas->getDatos($index); 
		 if($tipo == 1){
			$this->load->view('viewRiesgoAcuse'); 
		 } else if($tipo == 2){
			$this->load->view(''); 
		 }
		 

		}
    }
}  
?>
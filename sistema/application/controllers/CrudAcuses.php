<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAcuses extends CI_Controller {

    function __construct()
    {
        parent::__construct();
        $this->load->model("acuses");
    }

    public function index($index = 1)
    {
        $data['page'] = $this->acuses->data_pagination("/CrudAcuses/index/", $this->acuses->getTotalRowAllData(), 3);
        $data['listaAcuses'] = $this->acuses->getDatos($index);
        $this->load->view('viewtodoacuses',$data);
    }


    public function formAltaAcuseIndicador()
    {
    	
    	 $data['grupoIndicador'] = $this->acuses->getGrupoIndicadores();
        $this->load->view('formAcuseIndicador',$data);
    }


    public function formEditarAcuseIndicador($idIndicador)
    {
        $data['datosAcuse'] = $this->acuses->obtenerFicha($idIndicador);
        $data['grupoIndicador'] = $this->acuses->getGrupoIndicadores();
        $this->load->view('grideditaracuseindicador', $data);
    }


    public function formDetalleAcuseIndicador($idIndicador)
    {
        //$idUser=$_REQUEST['id'];
    	$data['datosAcuse'] = $this->acuses->obtenerFicha($idIndicador);
        $data['grupoIndicador'] = $this->acuses->getGrupoIndicadores();
        $this->load->view('gridDetalleAcuseIndicador',$data);
    }


    function obtenerDatos($idu)
    {

        $prueba= $this->acuses->obtenerFicha($idu);
        echo json_encode ($prueba);
    }


    function editarAcuseIndicador()
    {

        $idIndicador = $this->input->post('idIndicador');

        $data = array(
            'nombreIndicador' => $this->input->post('nombreIndicador'),
            'idGrupoIndicador' => $this->input->post('idGrupoIndicador')
        );

        $this->acuses->modificaDatos($data, $idIndicador);
    }

     function altaIndicador()
    {

        $nombreIndicador = $this->input->post('nombreIndicador');
        $idGrupoIndicador = $this->input->post('idGrupoIndicador');

        $data = array(
            'nombreIndicador' => $nombreIndicador,
            'idGrupoIndicador' => $idGrupoIndicador
        );

        $this->acuses->insertaDatos($data);
    }



    function altaAcuseIndicador()
    {

    }


    function eliminarAcuseIndicador($idIndicador){

        $this->acuses->borrarDatos($idIndicador);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAcuses');
    }
}

?>
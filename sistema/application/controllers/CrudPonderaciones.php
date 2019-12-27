<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPonderaciones extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("ponderaciones"); //cargamos el modelo

    }

    public function index($index = 1)
    {
        $data['page'] = $this->ponderaciones->data_pagination("/CrudPonderaciones/index/",
        $this->ponderaciones->getTotalRowAllData(), 3);
        $data['listPonderaciones'] = $this->ponderaciones->getDatos($index);
        $this->load->view('viewtodoponderaciones',$data);


    }

    public function formAltaPonderacion()
    {
        $this->load->view('formponderaciones');
    }



    public function formEditarPonderacion($idPonderacion=null)

    {
        $data = ['idPonderador' => $idPonderacion];
        $this->load->view('grideditarponderacion',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->ponderaciones->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idPonderacion = $this->input->post('idPonderador');
        $data = ['nombrePonderador' => $this->input->post('nombrePonderador'),
            'valor'=> $this->input->post('valorPonderador')];
        $this->ponderaciones->modificaDatos($data,$idPonderacion);

    }



    function altaPonderacion()
    {
        $arreglo= array(
            'nombrePonderador' => $this->input->post('nombrePonderacion'),
            'valor' => $this->input->post('valorPonderacion')
        );
        $data = $arreglo;

        $this->ponderaciones->insertaDatos($data);
    }


    function deletePonderacion($idPonderacion){

        $this->ponderaciones->borrarDatos($idPonderacion);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPonderaciones');

    }



}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPonderacionesArnes extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("ponderacionesarnes"); //cargamos el modelo

    }

    public function index($index = 1)
    {
        $data['page'] = $this->ponderacionesarnes->data_pagination("/CrudPonderacionesArnes/index/",
        $this->ponderacionesarnes->getTotalRowAllData(), 3);
        $data['listPonderacionesArnes'] = $this->ponderacionesarnes->getDatos($index);
        $this->load->view('viewtodoponderacionesarnes',$data);


    }

    public function formAltaPonderacionArnes()
    {
        $this->load->view('formponderacionesarnes');
    }



    public function formEditarPonderacionArnes($idPonderacion=null)

    {
        $data = ['idPonderador' => $idPonderacion];
        $this->load->view('grideditarponderacionarnes',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->ponderacionesarnes->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idPonderacion = $this->input->post('idPonderador');
        $data = ['nombrePonderador' => $this->input->post('nombrePonderador')];
        $this->ponderacionesarnes->modificaDatos($data,$idPonderacion);

    }



    function altaPonderacion()
    {
        $arreglo= array(
            'nombrePonderador' => $this->input->post('nombrePonderacion')
        );
        $data = $arreglo;

        $this->ponderacionesarnes->insertaDatos($data);
    }


    function deletePonderacion($idPonderacion){

        $this->ponderacionesarnes->borrarDatos($idPonderacion);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPonderacionesArnes');

    }



}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPonderadorInfra extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('ModelPonderadorInfra');
    }

    public function index($index=1)
    {
        //Carga la paginacion
        $data['page'] = $this->ModelPonderadorInfra->data_pagination("/CrudPonderadorInfra/index/",
            $this->ModelPonderadorInfra->getTotalRowAllData(), 3);
        $data['listaPonderador'] = $this->ModelPonderadorInfra->getDatos($index);
        $this->load->view('viewTodoPonInfraestructura',$data);
    }

    public function formAltaPonderador()
    {
        $this->load->view('viewPonderadorInfra');
        //$this->load->view('formPonderador');
    }


    public function formEditarPonderador($idPonderador=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idPonderador' => $idPonderador];
        $this->load->view('grideditarponinfra',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->ModelPonderadorInfra->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idPonderador = $this->input->post('idPonderador');
        $data=array(
            'nombrePonderador'=>$this->input->post('nombrePonderador')

        );

        $this->ModelPonderadorInfra->modificaDatos($data,$idPonderador);

    }



    function altaPonderador()
    {
        $ponderador=$this->input->post('nombrePonderador');

        $data=array(
            'nombrePonderador'=>$ponderador);

        //echo "entra $Ponderador cantidadFotos $cantidadFotos";
        $this->ModelPonderadorInfra->insertaDatos($data);

    }


    function deletePonderador($idPonderador){

        $this->ModelPonderadorInfra->borrarDatos($idPonderador);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPonderadorInfra');

    }

    function getDatosPonderador($idPonderador){
        $Resultado= $this->ModelPonderadorInfra->obtenerResultado($idPonderador);
        echo json_encode ($Resultado);

    }


}

?>
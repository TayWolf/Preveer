<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudPonderadorForm extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model('ModelPondForm');
    }

    public function index($index=1)
    {
        //Carga la paginacion
        $data['page'] = $this->ModelPondForm->data_pagination("/CrudPonderadorForm/index/",
            $this->ModelPondForm->getTotalRowAllData(), 3);
        $data['listaPonderador'] = $this->ModelPondForm->getDatos($index);
        $this->load->view('viewTodoPondform',$data);
    }

    public function formAltaPonderador()
    {
        $this->load->view('viewPonderadorForm');
        //$this->load->view('formPonderador');
    }


    public function formEditarPonderador($idPonderador=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idPonderador' => $idPonderador];
        $this->load->view('grideditarPonForm',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->ModelPondForm->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos(){


        $idPonderador = $this->input->post('idPonderador');
        $data=array(
            'nombrePonderador'=>$this->input->post('nombrePonderador')

        );

        $this->ModelPondForm->modificaDatos($data,$idPonderador);

    }



    function altaPonderador()
    {
        $ponderador=$this->input->post('nombrePonderador');

        $data=array(
            'nombrePonderador'=>$ponderador);

        //echo "entra $Ponderador cantidadFotos $cantidadFotos";
        $this->ModelPondForm->insertaDatos($data);

    }


    function deletePonderador($idPonderador){

        $this->ModelPondForm->borrarDatos($idPonderador);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudPonderadorForm');

    }

    function getDatosPonderador($idPonderador){
        $Resultado= $this->ModelPondForm->obtenerResultado($idPonderador);
        echo json_encode ($Resultado);

    }


}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudBitacoraPonderador extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("BitacoraPonderador"); //cargamos el modelo de User
    }

    public function index($index = 1)
    {
        $data['page'] = $this->BitacoraPonderador->data_pagination("/CrudBitacoraPonderador/index/",
            $this->BitacoraPonderador->getTotalRowAllData(), 3);
        $data['listBitacoraPonderador'] = $this->BitacoraPonderador->getDatos($index);
        $this->load->view('viewTodoBitacoraPonderador',$data);
    }

    public function formAltaBitacoraPonderador()
    {
        $this->load->view('formBitacoraPonderador');
    }

    public function formEditarBitacoraPonderador($idBitacoraPonderador)
    {
        $data = ['idBitacoraPonderador' => $idBitacoraPonderador];
        $this->load->view('gridEditarBitacoraPonderador',$data);
    }

    function obtenerDatos($idu)
    {

        $prueba= $this->BitacoraPonderador->obtenerFicha($idu);
        echo json_encode ($prueba);
    }

    function modificarDatos()
    {
        $idBitacoraPonderador = $this->input->post('idBitacoraPonderador');
        $data = ['texto' => $this->input->post('texto')];
        $this->BitacoraPonderador->modificaDatos($data,$idBitacoraPonderador);
    }

    function altaBitacoraPonderador()
    {
        $data = ['texto' => $this->input->post('texto')];
        $this->BitacoraPonderador->insertaDatos($data);
    }


    function deleteBitacoraPonderador($idBitacora){

        $this->BitacoraPonderador->borrarDatos($idBitacora);
        // $this->usuarios->borrarDatospuente($idUser);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudBitacoraPonderador');

    }


}

?>
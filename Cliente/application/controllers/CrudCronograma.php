<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class CrudCronograma extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("cronograma"); //cargamos el modelo de User
        $this->load->library('user_agent');

    }

    public function index($index = 1)
    {


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewcronograma');
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewcronograma');
            $this->load->view('footer');
        }

    }


    function getVisi($orden="")
    {
        $idCliente=$this->session->userdata('idCliente');
        $prueba = $this->cronograma->getDatos($orden, $idCliente);
        echo json_encode($prueba);
    }
    function getFecha($idUser, $idCe)
    {
        $idCliente=$this->session->userdata('idCliente');
        $prueba = $this->cronograma->getDatosFecha($idUser, $idCe, $idCliente);
        echo json_encode($prueba);
    }

}

?>
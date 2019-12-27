<?php


class CrudOportunidadMejora extends CI_Controller
{
    private $idCliente;
    function __construct()
    {
        parent::__construct();
        $this->load->model("OportunidadMejora");
        $this->idCliente=$this->session->userdata('idCliente');
        $this->load->library('user_agent');
    }
    function oportunidades()
    {
        $data['centrosTrabajo']=$this->OportunidadMejora->obtenerCentrosTrabajo($this->idCliente);
        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewOportunidadesMejora', $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewOportunidadesMejora', $data);
            $this->load->view('footer');
        }
    }
    function verOportunidadMejoraSSH($idCentroTrabajo)
    {
        $data['idCentroTrabajo']=$idCentroTrabajo;
        //obtiene el numero y nombre del centro
        $data['datosCentroTrabajo']=$this->OportunidadMejora->getDatosCentroTrabajo($idCentroTrabajo);
        //obtiene la tabla a mostrar
        $data['tabla']= $this->OportunidadMejora->obtenerTabla($idCentroTrabajo);
        $data['tablaOMSSH']= $this->OportunidadMejora->obtenerTablaOMSSH($idCentroTrabajo);
        $data['coloresIntervencion']= json_encode($this->OportunidadMejora->obtenercoloresIntervencion());
        $data['getPrioritario']= $this->OportunidadMejora->obtenerProri();

        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewOportunidadMejoraSSH', $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewOportunidadMejoraSSH', $data);
            $this->load->view('footer');
        }
    }
}
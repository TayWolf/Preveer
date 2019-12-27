<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudBotonespc extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("botonesproteccioncivil");
        $this->load->library("user_agent");


    }
    function iniciarSesion($idUser,$tipo, $area)
    {
        if(!empty($idUser.$tipo.$area))
        {
            $this->session->set_userdata("idusuariobase",$idUser);
            $this->session->set_userdata("tipoUser",$tipo);
            $this->session->set_userdata("area",$area);
        }
    }

    function verificarMovil()
    {
        return $this->agent->is_mobile();
    }
    public function listCentroTrabajo($idUser="", $idTipo="", $idArea="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $idUser = $this->session->userdata('idusuariobase');
        $data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti($idUser);


        if ($desdeMovil)
        {
            $this->load->view('headerMovil');
            $this->load->view('gridcentrotrabajoChecklista', $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridcentrotrabajoChecklista', $data);
            $this->load->view('footer');
        }
    }
    public function listCentroTrabajoAV($idUser="", $idTipo="", $idArea="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $areaUsr = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        $idUser = $this->session->userdata('idusuariobase');
        $data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti($idUser);

        if ($desdeMovil)
        {

            $this->load->view('headerMovil');
            $this->load->view('gridcentrotrabajoChecklistaAV', $data);
            $this->load->view('footerMovil');

        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridcentrotrabajoChecklistaAV', $data);
            $this->load->view('footer');
        }
    }
    public function listCentroTrabajoOM($idUser="", $idTipo="", $idArea="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $idUser = $this->session->userdata('idusuariobase');
        $data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti($idUser);

        if ($desdeMovil)
        {

            $this->load->view('headerMovil');
            $this->load->view('gridcentrotrabajoChecklistaOM', $data);
            $this->load->view('footerMovil');

        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridcentrotrabajoChecklistaOM', $data);
            $this->load->view('footer');
        }
    }
    function listProcedimientoEvacuacion($idUser="", $idTipo="", $idArea="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $idUser = $this->session->userdata('idusuariobase');
        $data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti($idUser);

        if ($desdeMovil)
        {

            $this->load->view('headerMovil');
            $this->load->view('gridProcedimientoEvacuacion', $data);
            $this->load->view('footerMovil');

        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridProcedimientoEvacuacion', $data);
            $this->load->view('footer');
        }
    }

}

?>
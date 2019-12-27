<?php


class CrudRiesgoIncendio extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model("RiesgoIncendio");
        $this->load->model("visitaAnalisis");
        $this->load->library("user_agent");

    }

    function verRiesgoIncendio($idAsignacion)
    {
        $desdeMovil=$this->verificarMovil();
        $data['idAsignacion']=$idAsignacion;
        $data['idCentroTrabajo'] = $this->RiesgoIncendio->getIdCentroTrabajo($idAsignacion);
        $data['datosCentroTrabajo'] = $this->RiesgoIncendio->getDatosCentroTrabajo($idAsignacion);
        $data['nombreCentroTrabajo']=$this->RiesgoIncendio->getNombreCentroTrabajo($idAsignacion);
        $data['inmueble']=$this->RiesgoIncendio->getTiposInmueble();
        $data['formato']=$this->RiesgoIncendio->getAllFormatos();
        $data['abreviaturas']=$this->RiesgoIncendio->getAbreviaturas();
        $data['indicadores']=$this->RiesgoIncendio->getIndicadores();
        $data['indicadoresTablas']=$this->RiesgoIncendio->getIndicadoresTablas();
        $data['tablas']=$this->getInformacionTablas($idAsignacion);
        if ($desdeMovil)
        {
            $this->load->view('headerMovil');
            $this->load->view('gridRiesgoIncendio', $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridRiesgoIncendio', $data);
            $this->load->view('footer');
        }
    }
    function getInformacionDetalle($idAsignacion)
    {
        echo json_encode($this->RiesgoIncendio->getInformacionDetalle($idAsignacion));
    }

    function getInformacionTablas($idAsignacion)
    {
        return $this->RiesgoIncendio->getInformacionTablas($idAsignacion);
    }
    function verificarMovil()
    {
        return $this->agent->is_mobile();
    }
    function getExtensionConstruccion($idAsignacion)
    {
        echo ($this->RiesgoIncendio->getExtensionConstruccion($idAsignacion));
    }

}
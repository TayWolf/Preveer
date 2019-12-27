<?php


class CrudProcedimientoEvacuacion extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model("ProcedimientoEvacuacion");
        $this->load->library("user_agent");

    }

    function verificarMovil()
    {
        return $this->agent->is_mobile();
    }
    function procedimiento($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['procesos']=$this->ProcedimientoEvacuacion->getProcesosProcedimientoEvacuacion();
        $data['recomendaciones']=$this->ProcedimientoEvacuacion->getRecomendaciones($idAsignacion);
        $data['idCentroTrabajo']=$this->ProcedimientoEvacuacion->getIdCentroTrabajo($idAsignacion);
        $data['nombreCentroTrabajo']=$this->ProcedimientoEvacuacion->getNombreCentroTrabajo($idAsignacion);
        $data['datosCentroTrabajo']=$this->ProcedimientoEvacuacion->getDatosCentroTrabajo($idAsignacion);
        $data['formato']=$this->ProcedimientoEvacuacion->getAllFormatos();
        $data['nombreUsuarioVisita']= $this->ProcedimientoEvacuacion->nombreUsuarioVisita($this->session->userdata('idusuariobase'));

        $desdeMovil=$this->verificarMovil();

        if ($desdeMovil)
        {

            $this->load->view('headerMovil');
            $this->load->view("formProcedimientoEvacuacion", $data);
            $this->load->view('footerMovil');

        }
        else
        {
            $this->load->view('header');
            $this->load->view("formProcedimientoEvacuacion", $data);
            $this->load->view('footer');
        }

    }
    function traerDatos($idAsignacion)
    {
        echo json_encode($this->ProcedimientoEvacuacion->traerDatosProcedimiento($idAsignacion));
    }
    function guardarProcedimientoEvacuacion($idAsignacion)
    {
        $idProceso=$this->input->post("id_proceso");
        $this->ProcedimientoEvacuacion->insertarExistencia($idAsignacion, $idProceso,array('id_proceso'=> $idProceso, 'idAsignacion' => $idAsignacion));

        $equipo=$this->input->post("equipo");
        $procedimiento=$this->input->post("procedimiento");
        if(!empty($procedimiento))
        {
            $this->ProcedimientoEvacuacion->updateProcedimientoEvacuacion($idAsignacion, $idProceso, array('valorProcedimiento' => $procedimiento));
        }
        else if(!empty($equipo))
        {
            $this->ProcedimientoEvacuacion->updateProcedimientoEvacuacion($idAsignacion, $idProceso, array('valorEquipo' => $equipo));
        }
    }
    function guardarRecomendaciones($idAsignacion)
    {
        $recomendaciones=$this->input->post("recomendaciones");
        $this->ProcedimientoEvacuacion->insertarExistenciaRecomendaciones($idAsignacion, array('idAsignacion'=>$idAsignacion,'recomendaciones' => $recomendaciones));
        echo "1";
    }
}
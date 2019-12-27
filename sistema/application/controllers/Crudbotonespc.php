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
	
public function listCentroTrabajoRiesgo($idUser="", $idArea="", $idTipo="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $idUser = $this->session->userdata('idusuariobase');
		$idTipo = $this->session->userdata('tipoUser');
		$idArea = $this->session->userdata('area');
		$data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti2 ($idUser);
        $data['desdeMovil']=$desdeMovil;

        if ($desdeMovil)
        {
            $this->load->view('headerMovil');
            $this->load->view('gridCalculoriesgo', $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridCalculoriesgo', $data);
            $this->load->view('footer');
        }
    }
	
    public function listCentroTrabajo($idUser="", $idTipo="", $idArea="")
    {
        $this->iniciarSesion($idUser, $idTipo, $idArea);
        $desdeMovil=$this->verificarMovil();
        $idUser = $this->session->userdata('idusuariobase');
        $data['cenTra'] = $this->botonesproteccioncivil->getListadoInmueblesOti($idUser);
        $data['desdeMovil']=$desdeMovil;

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
        $data['desdeMovil']=$desdeMovil;

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
        $data['desdeMovil']=$desdeMovil;

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
        $data['desdeMovil']=$desdeMovil;

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

     function getListadoCentro()
    {
        $columnas=array(
            0 => 'idAsignacion',
            1 => 'nombre',
            2 => 'nombreProyecto',
            3 => 'subservicio',
            4 => 'RI'
        );
        $limit = $this->input->post('length');
        $start = $this->input->post('start');
        $order = $columnas[$this->input->post('order')[0]['column']];
        $dir = $this->input->post('order')[0]['dir'];

        $totalData = $this->botonesproteccioncivil->cuentaTodosOtis();
        foreach ($totalData as $key ) {
            $totalData=$key["totalPc"];
        }
        $totalFiltered = $totalData;

        if(empty($this->input->post('search')['value']))
        {
            $riesgoIncendio = $this->botonesproteccioncivil->allRi($limit,$start,$order,$dir);
        }
        else {
            $search = $this->input->post('search')['value'];
            $riesgoIncendio =  $this->botonesproteccioncivil->busquedaOtis($limit,$start,$search,$order,$dir);
            $totalFiltered = $this->pacientes->cuentaPacientesFiltrados($search);
        }
        $data = array();
        if(!empty($riesgoIncendio))
        {
            foreach ($riesgoIncendio as $ri)
            {

                $nestedData['idAsignacion']=$ri['idAsignacion'];
                $nestedData['nombre']=$ri['nombre'];
                $nestedData['nombreProyecto']=$ri['servicio'];
                $nestedData['subservicio']=$ri['subservicio'];
                $nestedData['RI']="<td><a href='https://cointic.com.mx/preveer/sistema/index.php/CrudRiesgoIncendio/verRiesgoIncendio/".$ri['idAsignacion']."' ><i class='fa fa-fire'></i> </a></td>";

                $data[] = $nestedData;

            }
        }

        $json_data = array(
            "draw"            => intval($this->input->post('draw')),
            "recordsTotal"    => intval($totalData),
            "recordsFiltered" => intval($totalFiltered),
            "data"            => $data
        );

        echo json_encode($json_data);

    }

}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Crudfichasgrales extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("fichasgrales"); //cargamos el modelo de User
        $this->load->library('user_agent');
	}

    public function fichascentroGrales()//no borrar
    {
         $Cliente=$this->session->userdata('idCliente');
         $data['fichasTotales'] = $this->fichasgrales->getDatosFichas($Cliente);

        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewfichascentro',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewfichascentro',$data);
            $this->load->view('footer');
        }

    }
	

	public function fichasGralescentro($idCentroTrabajo)//no borrar
	{
		 $Cliente=$this->session->userdata('idCliente');
		  $data = ['idCentroTrabajo' => $idCentroTrabajo];
		   $data['fichas'] = $this->fichasgrales->getcentroFicha($Cliente,$idCentroTrabajo); 
           $data['actaCentro'] = $this->fichasgrales->getcentroActa($Cliente,$idCentroTrabajo); 


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view('viewfichacentro',$data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view('viewfichacentro',$data);
            $this->load->view('footer');
        }
	}

    function verReportes($idReporte, $idAsignacion)
    {
        $data['idReporte'] = $idReporte;
        $data['idAsignacion'] = $idAsignacion;
        $data['ReporteAsignacion'] = $this->fichasgrales->getReporteAsignacion($idReporte, $idAsignacion);
        $data['nombreReporte'] = $this->fichasgrales->getNombreReporte($idReporte)[0]['nombreReportes'];
        $data['apartados'] = $this->fichasgrales->getApartadosReporte($idReporte);
        $data['indicadores'] = $this->fichasgrales->getIndicadoresApartadosReporte($idReporte);
        $data['correccion']=$this->fichasgrales->getCorreccion($idReporte);


        if($this->agent->is_mobile())
        {
            $this->load->view('headerMovil');
            $this->load->view("gridReporteAdministrable", $data);
            $this->load->view('footerMovil');
        }
        else
        {
            $this->load->view('header');
            $this->load->view("gridReporteAdministrable", $data);
            $this->load->view('footer');
        }
    }
     function obtenerCorrecciones($idReporteAsignacion)
    {
        echo json_encode($this->fichasgrales->obtenerCorrecciones($idReporteAsignacion));
    }

    function obtenerPonderadoresReporte($idReporte)
    {
        echo json_encode($this->fichasgrales->getPonderadoresIndicadoresApartadosReporte($idReporte));
    }

    function cargarResultados($idReporteAsignacion)
    {
        echo json_encode($this->fichasgrales->cargarResultados($idReporteAsignacion));
    }

	}

?>
<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Menus extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("usuarios"); 
	}
	public function index()
	{
		$tipo=$this->session->userdata('tipoUser');//Recibimos el tipo d ela variable de sessión
		$correo=$this->session->userdata('correoUser');//Recibimos el tipo d ela variable de sessión de correo
		$area=$this->session->userdata('area');//Recibimos el tipo d ela variable de sessión de correo

		//echo "datos $tipo correo $correo";
		//  $data['total'] = $this->usuarios->total(); 
		if($tipo!='' && $_SESSION['idusuariobase'] != '')
		{
			if($tipo==1) //Usuario administrador
			{
                
				$this->load->view('header');	
				$this->load->view('dashboard_view');	
				$this->load->view('footer');

			} 
			
			else if($tipo == 2){ //Usuario comercial
                $this->load->view('header');	
				$this->load->view('dashboard_comercial');	
				$this->load->view('footer');
			} 
			
			else if($tipo == 3){ //Usuario coordinador
				$this->load->model('oti');
				$id = $this->session->userdata('idusuariobase');
				$data =	["totalOtisAsignada" => $this->oti->CountCoorOtiAsig($id), "totalOtisNoAsignada" =>  $this->oti->CountCoorOtiNoAsig($id)];

				$this->load->view('header');	
				$this->load->view('dashboard_coordinador',$data);	
				$this->load->view('footer');
			}

			else if($tipo == 4){ //Uisuario analista de riesgo
				//Proteccion civil
				if($area==1)
				{
					$this->load->view('header');
				$this->load->view('dashboard_analista');	
				$this->load->view('footer');

				}
				//SSHI
				if($area==2)
				{
					$this->load->view('header');
				$this->load->view('dashboard_analista_sshi');	
				$this->load->view('footer');
				}
				
			} 
			
			else if($tipo == 5||$tipo==9) {//Uisuario gerente
                $this->load->model('oti');
				$this->load->view('header');
                if($area==1)
                    $data =	["totalOtisAsignada" => $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalista=1", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ),
                        "totalOtisNoAsignada" =>  $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalista=0", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" )];
                else
                    $data =	["totalOtisAsignada" => $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalistaSSH=1", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ),
                        "totalOtisNoAsignada" =>  $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalistaSSH=0", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" )];
				$this->load->view('dashboard_gerente', $data);
				$this->load->view('footer');
			}
			
		}
		else{
			header("location: https://cointic.com.mx/preveer/sistema/");
		}
	}
}
	
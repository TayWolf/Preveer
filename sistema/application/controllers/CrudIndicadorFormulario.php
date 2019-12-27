<?php
defined('BASEPATH') OR exit('No direct script access allowed');
	class CrudIndicadorFormulario extends CI_Controller 
	{
		function __construct()
		{
			parent::__construct();
			$this->load->model('ModeloIndicadoresform');
		}

		public function index($index=1)
		{
			//Carga la paginacion
			$data['page'] = $this->ModeloIndicadoresform->data_pagination("/CrudIndicadorFormulario/index/", 
			$this->ModeloIndicadoresform->getTotalRowAllData(), 3);
			$data['listaIndicador'] = $this->ModeloIndicadoresform->getDatos($index);
			// obtenemos el array de profesiones y lo preparamos para enviar
			$this->load->view('viewTodoIndform',$data);  
		}

		public function formAltaIndicador($idIndicador=null)
		{
			$data = ['idIndicador' => $idIndicador];
			$data['abreviaturaPc'] = $this->ModeloIndicadoresform->get_abreviaturaPc();
			$data['abreviaturaIndicador'] = $this->ModeloIndicadoresform->get_abreviaturaIndicador();
			$this->load->view('viewIndForm',$data);  
		}

		public function formEditarIndicador($idIndicador=null)
		{
			// $idArea=$_REQUEST['id'];
			$data = ['idIndicador' => $idIndicador];
			$data['abreviaturaPc'] = $this->ModeloIndicadoresform->get_abreviaturaPc();
			// Son los radio button
			$data['abreviaturaIndicador'] = $this->ModeloIndicadoresform->get_abreviaturaIndicador();
			$this->load->view('grideditarindform',$data); 
		}

		function obtenerDatos($idu)
		{
			$prueba= $this->ModeloIndicadoresform->obtenerFicha($idu);
			echo json_encode ($prueba);
		}

		function modificarDatos()
		{
			$idIndicador = $this->input->post('idIndicador');
			$tipoIdi=$this->input->post('tipoIdi');
			$idAbreviaturaPc=$this->input->post('abPc');

			$data=array(
				'nombreIndicador'=>$this->input->post('nombreIndicador'),
				'tipoindicador'=>$tipoIdi
			);

			$this->ModeloIndicadoresform->modificarDatos($data,$idIndicador);

			$idAbreviaturaPc=$this->input->post('abPc');
			$MultiRadio=$this->input->post('MultiRadio');
			if (empty($idAbreviaturaPc)) 
			{
				$this->ModeloIndicadoresform->eliminarAbreviaturaIndicador($idIndicador);
				$this->ModeloIndicadoresform->eliminarMultiplicadorIndicador($idIndicador);
			}
			else if ($idAbreviaturaPc == 'multiplicador') 
			{	
				if ($this->ModeloIndicadoresform->verificarExistenciaMultiplicador($idIndicador)) 
				{
					$data=array(
						'idIndicador'=>$idIndicador,
						'IdAbIndicador'=>$MultiRadio
					);
					$this->ModeloIndicadoresform->modificaDatosMultiplicador($data,$idIndicador);
				}
				else
				{
					// Insertar
					$data=array(
					'idIndicador'=>$idIndicador,
					'IdAbIndicador'=>$MultiRadio
				);
				$this->ModeloIndicadoresform->insertaDatosMultiplicador($data);
				}
			}
			else if ($idAbreviaturaPc !=0)
			{

				// 1. Verificar si el indicador existe en la tabla Abreviatura si existe se va a actualizar si no se va a insertar
				if ($this->ModeloIndicadoresform->verificarExistenciaAbreviatura($idIndicador)) 
				{
					// Actualizar
					$data=array(
						'idAbreviaturaPc'=>$idAbreviaturaPc
					);
					$this->ModeloIndicadoresform->modificarDatosAbPC($data,$idIndicador);
				}
				else
				{
					// Insertar
					$data=array(
						'idAbreviaturaPc'=>$idAbreviaturaPc,
						'idIndicador'=>$idIndicador
					);
					$this->ModeloIndicadoresform->insertaDatosAbPC($data);
				}
				$this->ModeloIndicadoresform->eliminarMultiplicadorIndicador($idIndicador);
			}
			
			
		}

		function altaIndicador()
		{	
			$indicador=$this->input->post('nombreIndicador');
			$tipoIdi=$this->input->post('tipoIdi');
			$data=array(
				'nombreIndicador'=>$indicador,  
				'tipoindicador'=>$tipoIdi
			);
			$idIndicador = $this->ModeloIndicadoresform->insertaDatos($data);

			$idAbreviaturaPc=$this->input->post('abPc');
			$MultiRadio=$this->input->post('MultiRadio');
			if ($idAbreviaturaPc !=0)
			{
				$data=array(
					'idAbreviaturaPc'=>$idAbreviaturaPc,
					'idIndicador'=>$idIndicador
				);
				$this->ModeloIndicadoresform->insertaDatosAbPC($data);
			}
			else if ($idAbreviaturaPc == 'multiplicador') 
			{
				$data=array(
					'idIndicador'=>$idIndicador,
					'IdAbIndicador'=>$MultiRadio
				);
				$this->ModeloIndicadoresform->insertaDatosMultiplicador($data);
			}
		}

		function deleteIndicador($idIndicador)
		{
			$this->ModeloIndicadoresform->borrarDatos($idIndicador);
			// $this->usuarios->borrarDatospuente($idUser);
			redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario');
		}

		function getDatosIndiucador($idIndicador)
		{
			$Resultado= $this->ModeloIndicadoresform->obtenerResultado($idIndicador);
			echo json_encode ($Resultado);
		}

		public function listaPonderador($idIndicador)
		{
			// $idArea=$_REQUEST['id'];
			$data = ['idIndicador' => $idIndicador];
			$data['listadoponderador'] = $this->ModeloIndicadoresform->getListadoPondInf($idIndicador);
			$data['listadoponderadores'] = $this->ModeloIndicadoresform->getListaTododlistadoponderador();
			$this->load->view('gridlistaform',$data); 
		}

		function altaPuente()
		{
			$idIndicador=$this->input->post('idIndicador');
			$tot=$this->input->post('tot');

			for ($i=1; $i <= $tot ; $i++) 
			{ 
				$idP= $this->input->post('idR'.$i);
				if ($idP != "") 
				{
					$data2 = array(
					'idIndicador' => $idIndicador,    
					'idPonderador' => $idP 
					);
					$this->ModeloIndicadoresform->insertaDatosPuente($data2);
				}
			}
		}

		function deletePuente($id,$idI)
		{
			$this->ModeloIndicadoresform->borrarDatosindicabReq($id);
			// $this->usuarios->borrarDatospuente($idUser);
			redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudIndicadorFormulario/listaPonderador/'.$idI);
		}
	}
?>
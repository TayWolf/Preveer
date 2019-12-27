<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudOti extends CI_Controller {
	function __construct(){
		parent::__construct();
		$this->load->model("oti"); //cargamos el modelo de User
		
	}

	public function index($index = 1)
	{
		$data['page'] = $this->oti->data_pagination("/CrudOti/index/", 
        $this->oti->getTotalRowAllData(), 3);
     	$data['listOti'] = $this->oti->getDatos($index); //Trae la lista de Otis dadas de alta en el sistema
     	$data['cooridnadores'] = $this->oti->getListadoCord(); //Valida si ya se asigno algún coordinador a la OTI
     	$this->load->view('viewtodooti',$data);  

		
	}

	public function cargarAnalistasOti($idOti)
	{
        //$idO = $this->input->post('idOti');        
            //$datos= $this->oti->obtenerAnalistasOti($idO);
			/*$data['page'] = $this->oti->data_pagination("/CrudOti/cargarAnalistasOti/", 
        	$this->oti->getTotalRowAllDataAnalistasOti($idOti), 3);*/
            $data = ['idOti' => $idOti];
            //$data['analistasTotal']=$this->oti->getTotalAnalistasOti($idOti) 
            $data['analistas'] = $this->oti->getListadoAnalistas();
            $data['asignacion'] = $this->oti->getListadoInmueblesOti($idOti);
		    $data['analistaOti']= $this->oti->obtenerAnalistasOti($idOti);
            $this->load->view('gridanalistaoti',$data); 
    	//echo json_encode ($datos);
	}

	public function formAltaOti()
	{
			$data['cliente']= $this->oti->clienteGet(); 
			$data['centrosTrabajo']= $this->oti->getCentrosDeTrabajo(); 
			$data['areas']= $this->oti->getProyecto(); 
			$data['tramite']= $this->oti->getTramite(); 
			$this->load->view('formoti',$data);  
	}


	public function formDetalleOti($idOti=null)

	{
		// $idArea=$_REQUEST['id'];
		    $data = ['idOti' => $idOti];
		    $data['cliente']= $this->oti->clienteGet(); 
			$data['inmueb']= $this->oti->getCentrosDeTrabajo(); 
			$data['proyecto']= $this->oti->getProyecto(); 
			$data['tramite']= $this->oti->getTramite(); 
			$this->load->view('gridetalleoti',$data); 
	}

public function formEditarO($idOti=null)

	{
		// $idArea=$_REQUEST['id'];
		   	$data = ['idOti' => $idOti];
		    $data['cliente']= $this->oti->clienteGet(); 
			$data['inmueb']= $this->oti->getCentrosDeTrabajo(); 

			$data['tramite']= $this->oti->getTramite(); 
			$data['areas']= $this->oti->getProyecto(); 
			$this->load->view('grideditaoti',$data); 
	}

	

	function obtenerDatos($idO)
	{
		
    	$prueba= $this->oti->obtenerFicha($idO);
    	echo json_encode ($prueba);
	}

	function todoCentro()
	{
    	$prueba= $this->oti->getCentrosDeTrabajo();
    	echo json_encode ($prueba);
	}

	function todoServicio($idControl)
	{
		$prueba= $this->oti->getServiciosControl($idControl);
		
    	echo json_encode ($prueba);
	}

	function todoTramite()
	{
    	$prueba= $this->oti->getTramite();
    	echo json_encode ($prueba);
	}


	function obtenerDatosCentroTrabajo($idCentroTrabajo)
	{
		//Este sirve para obtener los datos del formato
    	$prueba= $this->oti->obtenerDatosCentroTrabajo($idCentroTrabajo);
    	echo json_encode ($prueba);
	}

	function obtenerDatosCentroTrabajoPorFormato($idCentroTrabajo)
	{
		//Esta sirve para llenar el select de los centros de trabajo
    	$prueba= $this->oti->obtenerDatosCentroTrabajoPorFormato($idCentroTrabajo);
    	echo json_encode ($prueba);		
	}

	function traerNombreInm($idInmu)
		{
    		$prueba= $this->oti->obtenerNombreInmue($idInmu);
    		//$prueba2= $this->oti->obtenerNombreProye($idProyecto);
    		//$arr = array('prueba' => $prueba, 'prueba2' => $prueba2);
    		echo json_encode ($prueba);
		}
		function traerNombrePro($idProyecto)
		{
    		$prueba= $this->oti->obtenerNombreProye($idProyecto);
    		//$prueba2= $this->oti->obtenerNombreProye($idProyecto);
    		//$arr = array('prueba' => $prueba, 'prueba2' => $prueba2);
    		echo json_encode ($prueba);
		}
		function traerNombreSubservicio($idSubservicio)
		{
    		$prueba= $this->oti->obtenerNombreSubservicio($idSubservicio);
    		//$prueba2= $this->oti->obtenerNombreProye($idProyecto);
    		//$arr = array('prueba' => $prueba, 'prueba2' => $prueba2);
    		echo json_encode ($prueba);
		}
		function traerNombreTrami($idTramite)
		{
    		$prueba= $this->oti->obtenerNombreTrami($idTramite);
    		//$prueba2= $this->oti->obtenerNombreProye($idProyecto);
    		//$arr = array('prueba' => $prueba, 'prueba2' => $prueba2);
    		echo json_encode ($prueba);
		}

		function getTotal($idUs)
		{
    		$prueba= $this->oti->totalId($idUs);
    		echo json_encode ($prueba);
		}
        //Obtener el número total de inmuebles asignados al analista de riesgo
		function getTotalInmueblesAnalista($idUs)
		{
    		$prueba= $this->oti->totalAnalistaInmueble($idUs);
    		echo json_encode ($prueba);
		}

		/*function getTotalAnalistasOti($idOti)
		{
    		$total= $this->oti->getNumAnalistas($idOti);
    		echo json_encode ($total);
		}*/

	function getForm($idCliente)
	{
		$prueba= $this->oti->traerForma($idCliente);
    	echo json_encode ($prueba);
	}

	function getHistorialVi($id)
	{
		$prueba= $this->oti->getLoistadoV($id);
    	echo json_encode ($prueba);
	}

	function getHistorialDoc($id)
	{
		$prueba= $this->oti->getLoistadoD($id);
    	echo json_encode ($prueba);
	}

	function altaClient()
	{
		 $data = ['nombreCliente' => $this->input->post('nombre')];
			$this->oti->insertaDatosCliente($data);
	}

	function modiFic($idOt,$idCorde)
	{
		$status=1;
		$data = array(	
			'idCoordinador' => $idCorde,
			'status' => $status
			);
			$this->oti->modificaDatos($data,$idOt);
	}

	function AgendarVisita()
	{
		$status=1;
		$tipoVisi=1;
		$fechaAc="0000-00-00";
		$fechaVisita = $this->input->post('fechaVisita');
		$idIdentif = $this->input->post('idIdentif');
		$data = array(	
			'idAsignacion' => $idIdentif,
			'fechaAgenda' => $fechaVisita,
			'Status' => $status,
			'fechaAplicacion' => $fechaAc,
			'tipoVisita' => $tipoVisi
			);
			$this->oti->insertaVisita($data);
	}

	function AgendarVisitaDoctos()
	{
		$status=1;
		$tipoVisi=2;
		$fechaAc="0000-00-00";
		$fechaVisita = $this->input->post('fechaVisitadoc');
		$idIdentif = $this->input->post('idIdentifdoc');
		$data = array(	
			'idAsignacion' => $idIdentif,
			'fechaAgenda' => $fechaVisita,
			'Status' => $status,
			'fechaAplicacion' => $fechaAc,
			'tipoVisita' => $tipoVisi
			);
			$this->oti->insertaVisita($data);
	}

	/*function cerrarVisita($idIdentif,$fechaAct)
	{
		$status=2;
		$fechaAc="0000-00-00";
		$data = array(	
			'idAsignacion' => $idIdentif,
			'fechaAgenda' => $fechaAct,
			'Status' => $status,
			'tipoPrimeravez' => $status,
			'fechaAplicacion' => $fechaAc,
			'tipoVisita' => $status
			);
			$this->oti->insertaVisita($data);

	}
*/

	//Se asigna el analista al inmueble asignado a la OTI
		function AsignaAnalistaInmueble($idAsignacion,$idAnalista,$oti,$tipo)
	{
		$status=1;
		$oti=$oti;
		$data = array(	
			'idUsuario' => $idAnalista,
			'idAsignacion' => $idAsignacion,
			'tipo' => $tipo
			);
		$dataOti=array(	
			'statusAnalista' => $status
			);
			$this->oti->AsignarAnalistaInmueble($data,$oti,$dataOti);
	}



	//Se asigna fecha de visita
	public function AsignaFechaVisita($fechavisita,$idanoti)
	{
		
		$this->oti->AsignarFechaVisita($data);
	}


	function modificaOtis(){

		 
			$idOti = $this->input->post('idOti');


     		$dataOtiM = array(	
			'fechaAceptacion' => $this->input->post('fechaAcep'),
			'horaAceptacion' => $this->input->post('horaAcept')
			);
			$this->oti->modificaDatos($dataOtiM,$idOti);

			 $dataOtiFormatoM = array(	
			'idFormato' => $this->input->post('idFormato')
			);
			 $this->oti->updateFormato($dataOtiFormatoM,$idOti);


			// $this->oti->borrarDatosPuente($idOti);
			
			$pruebass	= $this->input->post('arreglo');
			$pruebaDos= json_encode($pruebass);
			foreach ($pruebass as $key => $value) {
				foreach ($value as $key => $value) {
					$dataPuente = array(	
					'idInmueble' => $value['idInmuebleModal'],
					'idFormato' => $idFormato,
					'ComentarioDireccion' => $value['cometarioIn'],
					'idProyecto' => $value['idProyecto'],
					'idTramite' => $value['idTramite'],
					'capacitacion' => $value['capacitacioTB'],
					'fechaEntrega' => $value['fechaEntrega'],
					'comentariosEntrega' => $value['comentariosEnt'],
					'TipoIngreso' => $value['tipoIngre'],
					'idOti' => $idOti
					);
					$this->oti->insertaDatosPuente($dataPuente);
					echo "entra ".$value['idInmuebleModal']." <> ";
				}
			}			 
	}

	function actualizarOti($deleteDatos)
	{

		
		$idOti=$this->input->post('idOti');
		
		$fechaSol=$this->input->post('fechaSol');
		$horaSoli=$this->input->post('horaSoli');
		$fechaAcep=$this->input->post('fechaAcep');
		$dataOti=array(
		'fechaSolicitud' => $fechaSol,
		'horaSolicitud'=> $horaSoli,
		'fechaAceptacion'=> $fechaAcep
		);
		
		
		$this->oti->modificaDatos($dataOti, $idOti);
		
		
		if($deleteDatos)
		{
			$this->oti->borrarTodosDatosPuente($idOti);
		}
		
		
		$pruebass= $this->input->post('arreglo');
		
		foreach ($pruebass as $key => $value) 
		{
			foreach ($value as $key2 => $value2) 
			{
				$accion=$value2['accion'];
				//INSERT
				if($accion==1)
				{
					$dataPuente = array(	
					'idProyecto' => $value2['idControl'],
					'idTramite' => $value2['idTramite'],
					'ComentarioDireccion' => $value2['cometarioIn'],
					'capacitacion' => $value2['capacitacioTB'],
					'fechaEntrega' => $value2['fechaEntrega'],
					'comentariosEntrega' => $value2['comentariosEnt'],
					'TipoIngreso' => $value2['tipoIngre'],
					'idOti' => $idOti,
					'idCentroTrabajo' => $value2['idInmuebleModal']
						);
					$this->oti->insertaDatosPuente($dataPuente);
				}
				//UPDATE
				else if($accion==2)
				{
					$id=$value2['idAsignacion'];
					$dataPuente = array(	
					'idProyecto' => $value2['idControl'],
					'idTramite' => $value2['idTramite'],
					'ComentarioDireccion' => $value2['cometarioIn'],
					'capacitacion' => $value2['capacitacioTB'],
					'fechaEntrega' => $value2['fechaEntrega'],
					'comentariosEntrega' => $value2['comentariosEnt'],
					'TipoIngreso' => $value2['tipoIngre'],
					'idOti' => $idOti,
					'idCentroTrabajo' => $value2['idInmuebleModal']
					);
					$this->oti->actualizarDatosPuente($dataPuente, $id);
				}
				//DELETE
				else if($accion==3)
				{
					$id=$value2['idAsignacion'];
					$this->oti->borrarDatosPuente($id);
				}
			}
		}	
	}
	

/*	
		function altaOti()
	{	
			$fechaSol = $this->input->post('fechaSol');
			$horaSoli = $this->input->post('horaSoli');
			$idFormato = $this->input->post('idFormato');
			$stat =0;
			 
			 $dataOti = array(	
			'fechaSolicitud' => $this->input->post('fechaSol'),
			'horaSolicitud' => $this->input->post('horaSoli'),
			'fechaAceptacion' => $this->input->post('fechaAcep'),
			'status' => $stat
			
			);
				//$this->oti->insertaDatosOti($dataOti);

				/*$prueba= $this->oti->obtenersuId($fechaSol,$horaSoli);
				$idOti=0;
				foreach ($prueba as $row)	{
		    		$idOti= $row['idOti'];
		    	}

		    $dataOtiFormato = array(	
			//'idOti' => $idOti,
			'idFormato' => $this->input->post('idFormato')
			);
			//$this->oti->insertaDatosOtiformato($dataOtiFormato);

			$pruebass	= $this->input->post('arreglo');
			//echo "tamaño".sizeof($pruebass);
			$pruebaDos= json_encode($pruebass);
			
			foreach ($pruebass as $key => $value) {
				foreach ($value as $key => $value2) {
echo "entra ".$value['idProyecto']." <> ";
					//echo "prueba".$value['idInmuebleModal'];
					$dataPuente = array(	
				'idProyecto' => $value2['idProyecto'],
				'idTramite' => $value2['idTramite'],
				'ComentarioDireccion' => $value2['cometarioIn'],
				'capacitacion' => $value2['capacitacioTB'],
				'fechaEntrega' => $value2['fechaEntrega'],
				'comentariosEntrega' => $value2['comentariosEnt'],
				'TipoIngreso' => $value2['tipoIngre'],
				//'idOti' => $idOti,
				'idCentroTrabajo' => $value2['idInmuebleModal']
					);
					//$this->oti->insertaDatosPuente($dataPuente);
					
				}
			}
	}
*/


	function altaOti()
	{	
			$fechaSol = $this->input->post('fechaSol');
			$horaSoli = $this->input->post('horaSoli');
			$idFormato = $this->input->post('idFormato');
			$stat =0;
			 
			 $dataOti = array(	
			'fechaSolicitud' => $this->input->post('fechaSol'),
			'horaSolicitud' => $this->input->post('horaSoli'),
			'fechaAceptacion' => $this->input->post('fechaAcep'),
			'horaAceptacion' => '00:00:00',
			'idCoordinador' => 0,
			'status' => $stat,
			'statusanalista' => 0,
			'statusActiva' => 1			
			);
				$this->oti->insertaDatosOti($dataOti);

				$prueba= $this->oti->obtenersuId($fechaSol,$horaSoli);
				$idOti=0;
				foreach ($prueba as $row)	{
		    		$idOti= $row['idOti'];
		    	}

		    $dataOtiFormato = array(	
			'idOti' => $idOti,
			'idFormato' => $this->input->post('idFormato')
			);
			//$this->oti->insertaDatosOtiformato($dataOtiFormato);

			$pruebass	= $this->input->post('arreglo');
			//echo ("idProyecto: ".$pruebass[0]." idTramite: ".$pruebass[1]." comentarioDireccion: ".$pruebass[2]." capacitacion: ".$pruebass[3]." fechaEntrega".$pruebass[4]." ComentariosEntrega: ".$pruebass[5]." TipoIngreso ".$pruebass[6]."IdOti ".$pruebass[7]." idCentroTrabajo".$pruebass[8]);

			$pruebaDos= json_encode($pruebass);
			
			foreach ($pruebass as $key => $value) {
				foreach ($value as $key => $value2) {

					//echo "prueba".$value['idInmuebleModal'];
					$dataPuente = array(	
				'idProyecto' => $value2['idControl'],
				'idTramite' => $value2['idTramite'],
				'ComentarioDireccion' => $value2['cometarioIn'],
				'capacitacion' => $value2['capacitacioTB'],
				'fechaEntrega' => $value2['fechaEntrega'],
				'comentariosEntrega' => $value2['comentariosEnt'],
				'TipoIngreso' => $value2['tipoIngre'],
				'idOti' => $idOti,
				'idCentroTrabajo' => $value2['idInmuebleModal']
					);
					$this->oti->insertaDatosPuente($dataPuente);

				}
			}
	}
	function desactivarOti($idOti)
	{
		$data = array(
					'statusActiva' => "0"
					);
		$this->oti->cambiarEstadoOti($data,$idOti);	

	}
	function activarOti($idOti)
	{
		$data = array(
					'statusActiva' => "1"
					);
		$this->oti->cambiarEstadoOti($data,$idOti);	

	}

	public function listCentroTrabajo($idOti)
	{
		$data = ['idOti' => $idOti];
		$data['cenTra'] = $this->oti->getListadoInmueblesOti($idOti);
		$this->load->view('gridlistacentrotrabajo', $data);
	}
	public function obtenerServicios($idArea)
	{

		$data= $this->oti->getServiciosArea($idArea);
		echo json_encode($data);
	}

	public function obtenerSubservicios($idServicio)
	{

		$data= $this->oti->getSubservicios($idServicio);
		echo json_encode($data);
	}

	public function obtenerListadoEntregables()
	{
		$data= $this->oti->getEntregables();
		echo json_encode($data);
	}

	public function coordinador($id)
	{
		$index = 1;
		$data['page'] = $this->oti->data_pagination("/CrudOti/coordinador/", $this->oti->getTotalRowAllData(), 3);
     	$data['listOti'] = $this->oti->getDatosCoor($index, $id); //Trae la lista de Otis dadas de alta en el sistema
     	$data['cooridnadores'] = $this->oti->getListadoAnalistas(); //Valida si ya se asigno algún coordinador a la OTI
     	$this->load->view('viewtodooti',$data);  

		
	}
	public function obtenerEntregablesCentroTrabajo()
	{
		$idAsignaInmueble=$this->input->post('idAsignaInmueble');
		$data=$this->oti->getEntregablesCentro($idAsignaInmueble);
		echo json_encode($data);
	}
	public altaEntregables($total)
    {
    	//BORRAR LOS ENTREGABLES DEL INMUEBLE
    	
    	$idAsignacion= $this->input->post('entregableID');
    	$this->oti->borrarEntregablesCentro($idAsignacion);
        for ($i=0; $i < $total ; $i++) 
        { 

            $checkbox = $this->input->post('entregableCheck'.$i);

            if($checkbox!=0)
            {
            	//Insertar la informacion
            	$idEntregable= $this->input->post('identificador',$i);
            	$cantidad= $this->input->post('entregableCantidad'.$i);
            	$nota= $this->input->post('entregableNota'.$i);

            	$data=array(
            		'idAsignacion' => $idAsignacion,
            		'idEntregable' => $idEntregable,
            		'nota' => $nota,
            		'cantidad' => $cantidad);
            	//mandar a llamar a la insercion en entregablesInmueble
            	$this->oti->insertarEntregableCentro($data);

            }
        }
    }

	}

?>
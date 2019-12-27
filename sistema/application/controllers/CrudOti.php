<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudOti extends CI_Controller {
    function __construct()
    {
        parent::__construct();
        $this->load->model("oti"); //cargamos el modelo de User
    }

    public function index($index=1)
    {
        $usuario = $this->session->userdata('tipoUser'); //Obtenemos tipo de usuario de la sesion
        $data['page'] = $this->oti->data_pagination("/CrudOti/index/",
            $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=1", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        if($usuario == 1||$usuario==5||$usuario==9)
        { //Verificamos que tipo de usuario es para cargar los datos
            $data['listOti'] = $this->oti->getDatos($index); //Trae la lista de todas Otis dadas de alta en el sistema
        }
        elseif($usuario == 4)
        {
            $data['page'] = $this->oti->data_pagination("/CrudOti/otish/",
                $this->oti->getTotalRowAllData("where AnalistaOti.idUsuario = ".$id=$this->session->userdata('idusuariobase'),"FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion", "DISTINCT(Oti.idOti)"), 3);
            $data['listOti'] = $this->oti->getDatosAn($index,$usuario); //Trae la lista de Otis de acuerdo al analista al que se le asignaron
        }
        else
        {
            $data['page'] = $this->oti->data_pagination("/CrudOti/otish/",
                $this->oti->getTotalRowAllData("WHERE Oti.idUsuario = ".$id=$this->session->userdata('idusuariobase')." And Proyectos.idArea=1","FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(CONCAT(Clientes.nombreCliente, Formato.nombre, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')'))"), 3);
            $data['listOti'] = $this->oti->getDatosComercial($index); //Trae la lista de Otis filtradas por el usuario que las levanto
        }
        $idA=1;
        $data['cooridnadores'] = $this->oti->getListadoCord($idA); //Valida si ya se asigno algún coordinador a la OTI

        $this->load->view('viewtodooti',$data);

    }

    public function subgerenteAnalista($index=1)
    {
        $area = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser'); //Obtenemos tipo de usuario de la sesion
        if($area==1)
            $data['page'] = $this->oti->data_pagination("/CrudOti/subgerenteAnalista/",
                $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalista=1", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        else
            $data['page'] = $this->oti->data_pagination("/CrudOti/subgerenteAnalista/",
                $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalistaSSH=1", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        if($usuario == 1||$usuario==5||$usuario==9)
        { //Verificamos que tipo de usuario es para cargar los datos

            if($area==1)
                $data['listOti'] = $this->oti->getDatos($index, 1); //Trae la lista de todas Otis dadas de alta en el sistema
            else
                $data['listOti'] = $this->oti->getDatosSH($index, 1); //Trae la lista de todas Otis dadas de alta en el sistema

        }

        $data['cooridnadores'] = $this->oti->getListadoCord($area); //Valida si ya se asigno algún coordinador a la OTI
        if($area==1)
            $this->load->view('viewtodooti',$data);
        else
            $this->load->view('viewtodooti_sshi',$data);
    }

    public function subgerenteNoAnalista($index=1)
    {
        $area = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser'); //Obtenemos tipo de usuario de la sesion
        if($area==1)
            $data['page'] = $this->oti->data_pagination("/CrudOti/subgerenteNoAnalista/",
                $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalista=0", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        else
            $data['page'] = $this->oti->data_pagination("/CrudOti/subgerenteNoAnalista/",
                $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=$area AND Oti.statusAnalistaSSH=0", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        if($usuario == 1||$usuario==5||$usuario==9)
        { //Verificamos que tipo de usuario es para cargar los datos
            if($area==1)
                $data['listOti'] = $this->oti->getDatos($index, 0); //Trae la lista de todas Otis dadas de alta en el sistema
            else
                $data['listOti'] = $this->oti->getDatosSH($index, 0); //Trae la lista de todas Otis dadas de alta en el sistema
        }

        $data['cooridnadores'] = $this->oti->getListadoCord($area); //Valida si ya se asigno algún coordinador a la OTI
        if($area==1)
            $this->load->view('viewtodooti',$data);
        else
            $this->load->view('viewtodooti_sshi',$data);

    }

    public function Otish($index=1)
    {
        $usuario = $this->session->userdata('tipoUser'); //Obtenemos tipo de usuario de la sesion
        $data['page'] = $this->oti->data_pagination("/CrudOti/otish/",
            $this->oti->getTotalRowAllData(" WHERE Proyectos.idArea=2", "FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(Oti.idOti)" ), 3);
        if($usuario == 1||$usuario==5||$usuario==9)
        { //Verificamos que tipo de usuario es para cargar los datos
            $data['listOti'] = $this->oti->getDatosSH($index); //Trae la lista de todas Otis dadas de alta en el sistema
        }
        else if($usuario == 4){
            $data['page'] = $this->oti->data_pagination("/CrudOti/otish/",
                $this->oti->getTotalRowAllData("where AnalistaOti.idUsuario = ".$id=$this->session->userdata('idusuariobase'),"FROM Oti JOIN asignaInmueble ON asignaInmueble.idOti=Oti.idOti JOIN AnalistaOti ON AnalistaOti.idAsignacion = asignaInmueble.idAsignacion", "DISTINCT(Oti.idOti)"), 3);
            $data['listOti'] = $this->oti->getDatosAn($index,$usuario); //Trae la lista de Otis de acuerdo al analista al que se le asignaron
        }
        else
        {
            $data['page'] = $this->oti->data_pagination("/CrudOti/otish/",
                $this->oti->getTotalRowAllData("WHERE Oti.idUsuario = ".$id=$this->session->userdata('idusuariobase')." And Proyectos.idArea=2","FROM Clientes join Formato on Formato.idCliente=Clientes.idCliente JOIN CentrosDeTrabajo on CentrosDeTrabajo.idFormato=Formato.idFormato JOIN asignaInmueble on CentrosDeTrabajo.idCentroTrabajo=asignaInmueble.idCentroTrabajo JOIN Oti on asignaInmueble.idOti=Oti.idOti JOIN serviciosSubservicios ON asignaInmueble.idProyecto = serviciosSubservicios.idControl JOIN Proyectos ON serviciosSubservicios.idServicio =Proyectos.idProyecto", "DISTINCT(CONCAT(Clientes.nombreCliente, Formato.nombre, ' (', DATE_FORMAT(Oti.fechaSolicitud, '%e de %M de %Y'), ')'))"), 3);
            $data['listOti'] = $this->oti->getDatosComercialSshi($index); //Trae la lista de Otis filtradas por el usuario que las levanto
        }
        $idA=2;
        $data['cooridnadores'] = $this->oti->getListadoCord($idA); //Valida si ya se asigno algún coordinador a la OTI
        $this->load->view('viewtodooti_sshi',$data);


    }

    public function verificacionControlcalidad($idAsignacion,$idOti)
    {
        $data = ['idAsignacion' => $idAsignacion,'idOti'=>$idOti];
        $data['datosCentroTrabajo']=$this->oti->getDatosGra($idAsignacion);
        $data['doctosEdo'] = $this->oti->getDoctosEstado($idAsignacion);
        $data['ponderadores']=$this->oti->getPonderadores();
        $data['evaluaciones']=$this->oti->cargarEvaluaciones($idAsignacion);

        $data['hayDatosGuardados']=sizeof($data['evaluaciones']);
        $this->load->library("user_agent");
        if ($this->agent->is_mobile())
        {

            $this->load->view('headerMovil');
            $this->load->view('gridlistadoedomexico',$data);
            $this->load->view('footerMovil');

        }
        else
        {
            $this->load->view('header');
            $this->load->view('gridlistadoedomexico',$data);
            $this->load->view('footer');
        }

    }
    function descargarArchivos($idAsignacion)
    {
        $nombreZip="./Documentos".$idAsignacion.".zip";
        if(file_exists($nombreZip))
        {
            unlink($nombreZip);
        }
        $this->load->helper('download');
        $documentos=$this->pintarIcon($idAsignacion);
        $zip=new ZipArchive();


        if ($zip->open($nombreZip, ZipArchive::CREATE)!==TRUE) {
            exit("No se puede trabajar con el archivo <$nombreZip>\n");
        }

        foreach ($documentos as $documento)
        {
            $ext=explode(".", $documento['nombreDocto']);
            $zip->addFile("assets/doctosPcCheck/".$documento['nombreDocto'],  strtr(($documento['nombreDocumento']).".".array_pop($ext), array('+' => '+', '-' => '=', '~' => '=','/' => '|' )));
        }

        $zip->close();
        force_download($nombreZip, NULL);


    }

    public function cargarAnalistasOti($idOti)
    {
        //$idO = $this->input->post('idOti');        
        //$datos= $this->oti->obtenerAnalistasOti($idO);
        /*$data['page'] = $this->oti->data_pagination("/CrudOti/cargarAnalistasOti/",
        $this->oti->getTotalRowAllDataAnalistasOti($idOti), 3);*/
        $data = ['idOti' => $idOti];
        $area = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        //$data['analistasTotal']=$this->oti->getTotalAnalistasOti($idOti)
        //echo "tipo $usuario";
        $data['analistas'] = $this->oti->getListadoAnalistas($area);
        $data['asignacion'] = $this->oti->getListadoInmueblesOti($idOti, $area, $usuario);
        $data['totaRegi'] = $this->oti->totalRegistro($idOti);
        $data['analistaOti']= $this->oti->obtenerAnalistasOti($idOti, $area, $usuario);
        $this->load->view('gridanalistaoti',$data);
        //echo json_encode ($datos);
    }
    public function cargarAnalistasOtiSSH($idOti)
    {
        //$idO = $this->input->post('idOti');
        //$datos= $this->oti->obtenerAnalistasOti($idO);
        /*$data['page'] = $this->oti->data_pagination("/CrudOti/cargarAnalistasOti/",
        $this->oti->getTotalRowAllDataAnalistasOti($idOti), 3);*/
        $data = ['idOti' => $idOti];
        $area = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        //$data['analistasTotal']=$this->oti->getTotalAnalistasOti($idOti)
        //echo "tipo $usuario";
        $data['analistas'] = $this->oti->getListadoAnalistas(2);
        $data['asignacion'] = $this->oti->getListadoInmueblesOti($idOti, 2, $usuario);
        $data['totaRegi'] = $this->oti->totalRegistro($idOti);
        $data['analistaOti']= $this->oti->obtenerAnalistasOti($idOti, 2, $usuario);
        $this->load->view('gridanalistaoti',$data);
        //echo json_encode ($datos);
    }


    public function formAltaOti()
    {
        $data['cliente']= $this->oti->clienteGet();
        $data['centrosTrabajo']= $this->oti->getCentrosDeTrabajo();
        $data['areas']= $this->oti->getProyecto();
        $data['tramite']= $this->oti->getTramite();
        $data['formato']= $this->oti->formatoGet();
        $data['inmueble']=$this->oti->inmuebleGet();
        $data['bitacoras']=$this->oti->obtenerBitacoras();
        $this->load->view('formoti',$data);
    }

    function altaCentroTrabajo()
    {

        $idFormato = $this->input->post('idFormatoModal');
        $idInmueble= $this->input->post('idInmuebleModal');
        $nombreCentro=$this->input->post('nombreCentroModal');
        $idDet = $this->input->post('idDetModal');

        $colonia= $this->input->post('coloniaModal');
        $calle=$this->input->post('calleModal');
        $numeroInterior=$this->input->post('numInteriorModal');
        $numeroExterior=$this->input->post('numExteriorModal');

        if(strlen($numeroInterior)<1)
        {
            $numeroInterior=0;
        }
        if(strlen($numeroExterior)<1)
        {
            $numeroExterior=0;
        }

        $nomContacto = $this->input->post('nomContactoModal');
        $puestoContacto = $this->input->post('puestoContactoModal');
        $telContacto = $this->input->post('telContactoModal');
        $correoContacto =$this->input->post('correoContactoModal');
        $aplica=null;
        if($this->input->post('aplicaHorarioAtencion')=='NoAplica')
        {
            $aplica=1;
        }

        $data= array(
            'nombre' => $nombreCentro,
            'idDet' =>$idDet ,
            'nomContacto' =>$nomContacto ,
            'puestoContacto' =>$puestoContacto ,
            'telContacto' =>$telContacto ,
            'email' => $correoContacto,
            'idColonia' => $colonia,
            'calle' => $calle,
            'numeroInterior' => $numeroInterior,
            'numeroExterior' => $numeroExterior,

            'telefonoInmueble' => $this->input->post('telefonoInmueble'),
            'correoInmueble' => $this->input->post('correoInmueble'),
            'horarioFuncionamientoInicio' => $this->input->post('horarioFuncionamientoInicio'),
            'horarioFuncionamientoFin' => $this->input->post('horarioFuncionamientoFin'),
            'aplicaHorarioAtencion' => $aplica,
            'horarioAtencionInicio' => $this->input->post('horarioAtencionInicio'),
            'horarioAtencionFin' => $this->input->post('horarioAtencionFin'),
            'giroInmueble' => $this->input->post('giroInmueble'),
            'latitud' => $this->input->post('latitud'),
            'longitud'  => $this->input->post('longitud'),
            'Metros'  => $this->input->post('Metros'),

            'idFormato' =>$idFormato,
            'idInmueble' =>$idInmueble
        );

        $this->oti->insertaDatosCentro($data);
        echo "1";

    }


    public function formDetalleOti($idOti=null, $ssh=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idOti' => $idOti];
        $data['cliente']= $this->oti->clienteGet();
        $data['inmueb']= $this->oti->getCentrosDeTrabajo();
        $data['proyecto']= $this->oti->getProyecto();
        $data['tramite']= $this->oti->getTramite();
        if(!empty($ssh))
            $data['ssh']='/Otish';
        else
            $data['ssh']='';
        $this->load->view('gridetalleoti',$data);
    }

    public function formEditarO($idOti=null, $ssh=null)

    {
        // $idArea=$_REQUEST['id'];
        $data = ['idOti' => $idOti];
        $data['cliente']= $this->oti->clienteGet();
        $data['inmueb']= $this->oti->getCentrosDeTrabajo();

        $data['tramite']= $this->oti->getTramite();
        $data['areas']= $this->oti->getProyecto();
        $data['bitacoras']=$this->oti->obtenerBitacoras();


        $data['formato']= $this->oti->formatoGet();
        $data['inmueble']=$this->oti->inmuebleGet();
        if(!empty($ssh))
            $data['ssh']='/Otish';
        else
            $data['ssh']='';
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

    function getHistorialViSSHI($id,$idAsi)
    {
        $prueba= $this->oti->getLoistadoVSSHI($id,$idAsi);
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

    function modificarAgenda()
    {
        $idVi = $this->input->post('idVi');
        $statusSelec = $this->input->post('statusSelec');
        $data = array(
            'status' => $statusSelec
        );
        $this->oti->modificaDatosVisishhi($data,$idVi);
    }

    function actualHistorialV()
    {
        $idVisi=$this->input->post('idVisi');
        $fechvv=$this->input->post('fechvv');
        $observ=$this->input->post('observ');
        if (!empty($fechvv)) {
            $data = array(
                'fechaVisita' => $this->input->post('fechvv')
            );
            $this->oti->modificaDatosVisishhi($data,$idVisi);
        }else{}

        if (!empty($observ)) {
            $data = array(
                'observaciones' => $this->input->post('observ')
            );
            $this->oti->modificaDatosVisishhi($data,$idVisi);
        }else{}
    }

    function AgendarVisita()
    {
        $status=1;
        $tipoVisi=1;
        $fechaAc="0000-00-00";
        $fechaVisita = $this->input->post('fechaVisita');
        $idIdentif = $this->input->post('idIdentif');
        $coments = $this->input->post('coments');
        $data = array(
            'idAsignacion' => $idIdentif,
            'fechaAgenda' => $fechaVisita,
            'Status' => $status,
            'fechaAplicacion' => $fechaAc,
            'tipoVisita' => $tipoVisi,
            'comentario' => $coments
        );
        $this->oti->insertaVisita($data);
    }

    function AgendarVisitasshi()
    {
        $idIdentif = $this->input->post('idIdentif');
        $idAsig = $this->input->post('idAsig');
        $fechaVisita = $this->input->post('fechaVisita');
        $coments = $this->input->post('coments');
        $statVisita = $this->input->post('statVisita');
        $data = array(
            'idCentro' => $idIdentif,
            'idAsignacion' => $idAsig,
            'fechaVisita' => $fechaVisita,
            'observaciones' => $coments,
            'status' => $statVisita
        );
        $this->oti->insertaVisitasshi($data);
    }

    function AgendarVisitaDoctos()
    {
        $status=1;
        $tipoVisi=2;
        $fechaAc="0000-00-00";
        $fechaVisita = $this->input->post('fechaVisitadoc');
        $idIdentif = $this->input->post('idIdentifdoc');
		$coment = $this->input->post('comentdocs');
        $data = array(
            'idAsignacion' => $idIdentif,
            'fechaAgenda' => $fechaVisita,
            'Status' => $status,
            'fechaAplicacion' => $fechaAc,
            'tipoVisita' => $tipoVisi,
			'comentario' => $coment
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
    function AsignaAnalistaInmueble($total)
    {
        $status=1;
        //echo "entra antes de ciclo";
        $idUsuario = $this->input->post('analistaId');
        $analistatipo = $this->input->post('analistatipo');
        $idOti = $this->input->post('idOti');
        $total = $total;

        for ($i=1; $i <= $total ; $i++) {
            $idAsig = $this->input->post('Cent'.$i);

            if ($idAsig != "") {
                $data = array(
                    'idUsuario' => $idUsuario,
                    'idAsignacion' => $idAsig,
                    'tipo' => $analistatipo
                );
                //OBTENER EL AREA DEL ANALISTA
                $areaAnalista=$this->oti->obtenerAreaAnalista($idUsuario);
                if($areaAnalista[0]['areaUser']==1)
                    $dataOti=array(
                        'statusAnalista' => $status
                    );
                else
                    $dataOti=array(
                        'statusAnalistaSSH' => $status
                    );
                //echo "entra ciclo";
                $this->oti->AsignarAnalistaInmueble($data,$idOti,$dataOti);
            }
        }

        print $status." ".$dataOti[0]." ".$idOti;
    }



    //Se asigna fecha de visita
    public function AsignaFechaVisita($fechavisita,$idanoti)
    {

        $this->oti->AsignarFechaVisita($data);
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
            echo $key;
            foreach ($value as $key2 => $value2)
            {
                $accion=$value2['accion'];
                $getPorcetajeVal=$this->oti->getPorcetajeValor($value2['idControl'],$value2['idInmuebleModal']);
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
                        'idCentroTrabajo' => $value2['idInmuebleModal'],'porcentajeValor'=>$getPorcetajeVal
                    );
                    $idAsignacion=$this->oti->insertaDatosPuente($dataPuente);
                    for($numeroBitacora=0; $numeroBitacora<$value2['numeroBitacoras']; $numeroBitacora++)
                    {
                        if($value2['Bitacora'.$numeroBitacora]=='true')
                        {
                            $arregloBitacora=array('idAsignacion' => $idAsignacion, 'idBitacora'=> $value2['idBitacora'.$numeroBitacora]);
                            $this->oti->insertarBitacoraAsignacion($arregloBitacora);
                        }
                    }
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
                        'idCentroTrabajo' => $value2['idInmuebleModal'],'porcentajeValor'=>$getPorcetajeVal
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

    function altaOti()
    {

        $fechaSol = $this->input->post('fechaSol');
        $horaSoli = $this->input->post('horaSoli');
        $idFormato = $this->input->post('idFormato');
        $stat =0;
        $usuario = $this->session->userdata('idusuariobase');
        $dataOti = array(
            'fechaSolicitud' => $this->input->post('fechaSol'),
            'horaSolicitud' => $this->input->post('horaSoli'),
            'fechaAceptacion' => $this->input->post('fechaAcep'),
            'horaAceptacion' => '00:00:00',
            'idCoordinador' => 0,
            'status' => $stat,
            'statusanalista' => 0,
            'statusActiva' => 1,
            'idUsuario' => 	$usuario
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

        foreach ($pruebass as $key => $value)
        {
            foreach ($value as $key => $value2)
            {
                $getPorcetajeVal=$this->oti->getPorcetajeValor($value2['idControl'],$value2['idInmuebleModal']);


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
                    'idCentroTrabajo' => $value2['idInmuebleModal'],'porcentajeValor'=>$getPorcetajeVal
                );
                $idAsignacion=$this->oti->insertaDatosPuente($dataPuente);
                //Inserta las bitacoras que van a trabajar los analistas de sshi
                for($numeroBitacora=0; $numeroBitacora<$value2['numeroBitacoras']; $numeroBitacora++)
                {
                    if($value2['Bitacora'.$numeroBitacora]=='true')
                    {
                        $arregloBitacora=array('idAsignacion' => $idAsignacion, 'idBitacora'=> $value2['idBitacora'.$numeroBitacora]);
                        $this->oti->insertarBitacoraAsignacion($arregloBitacora);
                    }
                }

                //Inserta los entregables predeterminados de una asignacion
                $entregablesDefault=$this->oti->getEntregablesPredeterminados($value2['idControl']);
                foreach ($entregablesDefault as $entregable)
                {
                    $this->oti->insertarEntregableCentro(array(
                        'idAsignacion' => $idAsignacion,
                        'idEntregable' => $entregable['idEntregable'],
                        'nota' => $entregable['nota'],
                        'cantidad' => $entregable['cantidad'],
                    ));
                }


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

    function guardarDocto($tot, $porcentaje)
    {
        $uno=0;
        $x=array();

        $idAsigna = $this->input->post('idAsigna');

        $this->oti->borrarDatosPuenteEntrega($idAsigna);
        for ($i=0; $i < $tot ; $i++) {
            $idDocume = $this->input->post('documento'.$i);
            $ponderador=$this->input->post('idident'.$i);
            $comenta = $this->input->post('comet'.$i);
            $fechaCptura = $this->input->post('fechaCptura'.$i);
            $nombreDcotoTemporal = $this->input->post('nombreDcotoTemporal'.$i);

            $nombre_archivoima = $_FILES['archivoAdjunto'.$i]['name'];
            $temp_archivoima = $_FILES['archivoAdjunto'.$i]['tmp_name'];

            if ($ponderador != "")
            {

                $data2 = array(
                    'idDocumento' =>$idDocume ,
                    'idPonderador' => $ponderador,
                    'idAsignacion' => $idAsigna,
                    'comentario' => $comenta,
                    'fechaCaptura' => $fechaCptura
                );
                $this->oti->insertaDatosPuenteEntrega($data2);
            }

            if ($nombre_archivoima != "") {

                if($nombreDcotoTemporal)
                    unlink('assets/doctosPcCheck/'.$nombreDcotoTemporal);
                $this->oti->eliminarDato($idDocume,$idAsigna);
                $ext = explode('.', basename($nombre_archivoima));
                $foto=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
                $ruta="assets/doctosPcCheck/".$foto;
                if(move_uploaded_file($temp_archivoima, $ruta))
                {
                    echo "entra aca $temp_archivoima -> $ruta";
                    $dataT = array(
                        'idDocumento' => $idDocume,
                        'idAsignacion' => $idAsigna,
                        'nombreDocto' => $foto
                    );
                    $this->oti->insertaDatosPuenteEntregaDoctos($dataT);
                }
            }

        }
        $data=array('porcentajeValor' => $porcentaje);
        $this->oti->actualizarPorcentaje($idAsigna, $data);

        /*
         * Guardar la fecha en la que se guardó y el usuario que lo guardó
         * */

        $arrayHistorico=array('idAsignacion' => $idAsigna, 'fecha' => date("Y-m-d"), 'idUsuario' => $this->session->userdata('idusuariobase'), 'porcentajeHistorico' => $porcentaje);
        $this->oti->insertaHistoricoDocumental($arrayHistorico);

    }

    public function listCentroTrabajo($idOti)
    {
        $areaUsr = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        $data = ['idOti' => $idOti];
        $data['cenTra'] = $this->oti->getListadoInmueblesOti($idOti, $areaUsr, $usuario, 1);
        $data['isVisita'] = $this->oti->checkVisitas($idOti);
        $data['isVisitaDocs'] = $this->oti->checkVisitasDocs($idOti);

        if($areaUsr == 1||$areaUsr==4){
            $this->load->view('gridlistacentrotrabajo', $data);

        } elseif($areaUsr == 2){

            $this->load->view('gridlistacentrotrabajo_sshi', $data);
        }



    }
    public function listCentroTrabajoSSHI($idOti)
    {
        $areaUsr = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        $data = ['idOti' => $idOti];
        $data['cenTra'] = $this->oti->getListadoInmueblesOti($idOti, $areaUsr, $usuario, 2);
        $data['isVisita'] = $this->oti->checkVisitas($idOti);
        $data['isVisitaDocs'] = $this->oti->checkVisitasDocs($idOti);


        $this->load->view('gridlistacentrotrabajo_sshi', $data);

    }

    public function candelarizacionSSHI($idOti)
    {
        $areaUsr = $this->session->userdata('area');
        $usuario = $this->session->userdata('tipoUser');
        $data = ['idOti' => $idOti];
        $data['cenTraCandela'] = $this->oti->getCent($idOti);
        $data['isVisita'] = $this->oti->checkVisitas($idOti);
        $data['isVisitaDocs'] = $this->oti->checkVisitasDocs($idOti);


        $this->load->view('gridcalendariossshi', $data);

    }
    public function obtenerServicios($idArea)
    {

        $data= $this->oti->getServiciosArea($idArea);
        echo json_encode($data);
    }

    function pintarIcon($idAsignacion)
    {
        $data= $this->oti->traerIcon($idAsignacion);
        echo json_encode($data);
        return $data;
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

    public function coordinador($index=1)
    {
        $area = $this->session->userdata('area');
        $id=$this->session->userdata('idusuariobase');
        $data['page'] = $this->oti->data_pagination("/CrudOti/coordinador/", $this->oti->getTotalRowAllData("WHERE Oti.idCoordinador=".$id),3);
        $data['listOti'] = $this->oti->getDatosCoor($index, $id); //Trae la lista de Otis dadas de alta en el sistema
        $data['cooridnadores'] = $this->oti->getListadoAnalistas($area); //Valida si ya se asigno algún coordinador a la OTI
        $this->load->view('viewtodooti',$data);
    }


    // AnAsig= Analistas Asignados

    public function coordinadorAnAsig($index=1)
    {
        $area = $this->session->userdata('area');
        $id=$this->session->userdata('idusuariobase');
        $data['page'] = $this->oti->data_pagination("/CrudOti/coordinador/", $this->oti->getTotalRowAllData("WHERE Oti.idCoordinador=".$id), 3);
        $data['listOti'] = $this->oti->getDatosCoorAnAsig($index, $id); //Trae la lista de Otis dadas de alta en el sistema
        $data['cooridnadores'] = $this->oti->getListadoAnalistas($area); //Valida si ya se asigno algún coordinador a la OTI
        $this->load->view('viewtodooti',$data);
    }

    public function coordinadorAnNoAsig($index=1)
    {
        $area = $this->session->userdata('area');
        $id=$this->session->userdata('idusuariobase');
        $data['page'] = $this->oti->data_pagination("/CrudOti/coordinador/", $this->oti->getTotalRowAllData("WHERE Oti.idCoordinador=".$id), 3);
        $data['listOti'] = $this->oti->getDatosCoorAnNoAsig($index, $id); //Trae la lista de Otis dadas de alta en el sistema
        $data['cooridnadores'] = $this->oti->getListadoAnalistas($area); //Valida si ya se asigno algún coordinador a la OTI
        $this->load->view('viewtodooti',$data);
    }



    public function obtenerEntregablesCentroTrabajo()
    {
        $idAsignaInmueble=$this->input->post('idAsignaInmueble');
        $data=$this->oti->getEntregablesCentro($idAsignaInmueble);
        echo json_encode($data);
    }
    public function altaEntregables($total)
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
                $idEntregable= $this->input->post('identificador'.$i);
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

    function eliminarAsignaOti($idControl,$idOt){
        $this->oti->borrarDatosuserAAsignados($idControl);

        $numFilas = $this->oti->obtenerNumAnalistasOti($idOt);
        $status = 0;
        if($numFilas == 0)
        {
            $dataOti=array(
                'statusAnalista' => $status
            );

            $this->oti->actualizarStatusOti($idOt,$dataOti);
        }

        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudOti/cargarAnalistasOti/'.$idOt);
    }

    function eliminarAsignaOtiSSH($idControl,$idOt){
        $this->oti->borrarDatosuserAAsignados($idControl);

        $numFilas = $this->oti->obtenerNumAnalistasOti($idOt);
        $status = 0;
        if($numFilas == 0)
        {
            $dataOti=array(
                'statusAnalista' => $status
            );

            $this->oti->actualizarStatusOti($idOt,$dataOti);
        }


    }

    function eliminarFecha($idC){
        $this->oti->borraeFechasshi($idC);
    }
    function cambiarFechaRevisionDocumentos()
    {
        $id=$this->input->post('id');
        $fecha=$this->input->post('fecha');
        $comentario=$this->input->post('comentario');
        if(!empty($fecha))
        {
            $this->oti->actualizarFechaRevisionDocumentos(array('fechaAgenda' => $fecha), $id);
        }
        if(!empty($comentario))
        {
            $this->oti->actualizarFechaRevisionDocumentos(array('comentario' => $comentario), $id);
        }
    }

}

?>
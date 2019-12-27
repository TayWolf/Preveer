<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudHidrantes extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("hidrantes"); //cargamos el modelo

    }

    public function index($index = 1)
    {
        $usuario=$this->session->userdata('idusuariobase');
        $data['page'] = $this->hidrantes->data_pagination("/CrudAnalisisRiesgo/index/",
            $this->hidrantes->getTotalRowAllData(), 3);
        $data['listAnalisisRiesgo'] = $this->hidrantes->getDatos($index, $usuario);
        $this->load->view('viewtodoanalisisriesgo',$data);
    }

    public function formDatosGenerales($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistencia($idAsignacion);

        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaDatosGenerales($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistencia($idAsignacion);
        }

        $this->load->view('gridDatosGeneralespr', $data);
    }

    public function formInstalacionesElectricas($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaInstalacionesElectricas($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaInstalacionesElectricas($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaInstalacionesElectricas($idAsignacion);
        }
        $this->load->view('gridInstalacionesElectricas', $data);
    }

    public function formRevisionInstalaciones($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaRevisionInstalaciones($idAsignacion);
        $data['catalogoRevision']=$this->hidrantes->obtenerDatosCatalogoRevision();
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaRevisionInstalaciones($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaRevisionInstalaciones($idAsignacion);
        }
        $this->load->view('gridRevisionInstalaciones', $data);
    }


    public function registrarRevisionInstalaciones(){

        $data['catalogoRevision']=$this->hidrantes->obtenerDatosCatalogoRevision();
        $datosRevisionInstalacion = array();

        foreach ($data as $key => $value){
            $idCatalogoRevision = $this->input->post('idCatalogoRevision'+ $key['idCatalogoRevision']);
            $estadoInstalacion = $this->input->post('estadoInstalacion'+ $key['idCatalogoRevision']);
            $cantidad = $this->input->post('cantidad'+ $key['idCatalogoRevision']);
            $ubicacion = $this->input->post('ubicacion'+ $key['idCatalogoRevision']);
            $observaciones = $this->input->post('tuberia'+ $key['idCatalogoRevision']);
            $idAsignacion = $this->input->post('idAsignacion'+ $key['idCatalogoRevision']);

            $datoRevisionInstalacion = array(
                'idCatalogoRevision'=>$idCatalogoRevision,
                'estadoInstalacion'=>$estadoInstalacion,
                'cantidad'=>$cantidad,
                'ubicacion'=>$ubicacion,
                'observaciones'=>$observaciones,
                'idAsignacion' => $idAsignacion
            );
            $datosRevisionInstalacion.array_push($datoRevisionInstalacion);
        }

        $this->hidrantes->nuevaExistenciaRevisionPrueba($datosRevisionInstalacion);
    }

    public function formMaterialesPeligrosos($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaMaterialesPeligrosos($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaMaterialesPeligrosos($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaMaterialesPeligrosos($idAsignacion);
        }
        $this->load->view('gridMaterialesPeligrosos', $data);
    }

    public function formColindancia($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaColindancia($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaColindancia($idAsignacion);

            $data['existencia']=$this->hidrantes->verificarExistenciaColindancia($idAsignacion);
        }
        $this->load->view('gridFormColindancia', $data);
    }

    public function formInstalacionesHidraulicas($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaHidraulicas($idAsignacion);
        $data['catalogo']=$this->hidrantes->getCatalogoHidraulica();

        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaHidraulica($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaHidraulicas($idAsignacion);
        }
        $data['hidraulicaPuente']=$this->hidrantes->getHidraulicaPuente($idAsignacion);
        $this->load->view('gridInstalacionesHidraulicas', $data);
    }


    public function actualizarMaterialesPeligrosos()
    {

        $datosParaActualizar=Array(
            'fechaVisita'=>$this->input->post('fechaVisita'),
            'tipoDeGas'=>$this->input->post('tipoDeGas'),
            'NoTanques'=>$this->input->post('NoTanques'),
            'Capacidad'=>$this->input->post('Capacidad'),
            'anoDeFabricacion'=>$this->input->post('anoDeFabricacion'),
            'dictamen'=>$this->input->post('dictamen'),
            'ano'=>$this->input->post('ano'),
            'isometrico'=>$this->input->post('isometrico'),
            'ubicacionGas'=>$this->input->post('ubicacionGas'),
            'cantDiesel'=>$this->input->post('cantDiesel'),
            'ubicaDiesel'=>$this->input->post('ubicaDiesel'),
            'diqueContencionDiesel'=>$this->input->post('diqueContencionDiesel'),
            'cantGasolina'=>$this->input->post('cantGasolina'),
            'ubicaGasolina'=>$this->input->post('ubicaGasolina'),
            'diqueContencionGasolina'=>$this->input->post('diqueContencionGasolina')
        );

        $this->hidrantes->actualizarMaterialPeligroso($datosParaActualizar, $this->input->post('idAsignacion'));
    }

    public function actualizarInstalacionHidraulica()
    {
        //instalacionesHidraulicas
        $suministro = $this->input->post('suministro');
        if($suministro == 3){ $sumOtro = $this->input->post('sumOtro'); }
        else{ $sumOtro = ""; }
        $tuberia = $this->input->post('tuberia');
        $idAsignacion = $this->input->post('idAsignacion');
        $idInstalacionesHidraulicas= $this->input->post('idInstalacionesHidraulicas');
        $datosInHidraulica=Array(
            'suministro'=>$suministro,
            'sumOtro'=>$sumOtro,
            'tuberia'=>$tuberia
        );

        $this->hidrantes->actualizarExistenciaHidraulica($datosInHidraulica, $idAsignacion);

        //HidraulicaCatalogoPuente
        $datosPuenteHidraulica = json_decode($this->input->post('datosPuenteHidraulica'));


        foreach ($datosPuenteHidraulica as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $dataPuente = array(
                    'idInstalacion' => $idInstalacionesHidraulicas,
                    'idCatalogo' => $value2->instalacion,
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'observaciones' => $value2->observaciones
                );
                $this->hidrantes->insertaDatosHidraulicaPuente($dataPuente);
            }
            //UPDATE
            else if($accion == 2)
            {
                $idHidraulicaCatalogo = $value2['idHidraulicaCatalogo'];
                $dataPuente = array(
                    'idInstalacion' => $value2->instalacion,
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'observaciones' => $value2->observaciones
                );
                $this->hidrantes->actualizarDatosHidraulicaPuente($dataPuente, $idHidraulicaCatalogo);
            }
            //DELETE
            else if($accion == 3)
            {
                $idHidraulicaCatalogo = $value2->idHidraulicaCatalogo;
                $this->hidrantes->borrarDatosHidraulicaPuente($idHidraulicaCatalogo);
            }

        }
        var_dump($datosPuenteHidraulica);
    }



    /*    public function formDatosGeneralesPr($idAsignacion)
        {
            $data['idAsignacion']=$idAsignacion;
            $data['existencia']=$this->hidrantes->verificarExistencia($idAsignacion);
            $contador=0;
            foreach ($data['existencia'] as $row)
            {
                $contador++;
            }
            if($contador==0)
            {
                $this->hidrantes->nuevaExistenciaDatosGenerales($idAsignacion);
            }

            $this->load->view('gridDatosGeneralespr', $data);
        }*/



    public function subirFachada($idAsignacion)
    {
        if (empty($_FILES['fachada'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fachada'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fachada'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagen($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }
    public function subirLicencia($idAsignacion)
    {
        if (empty($_FILES['licenciaFuncionamiento'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['licenciaFuncionamiento'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('licenciaFuncionamiento'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagen($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }

    public function subirfotoVidrio($idAsignacion)
    {
        if (empty($_FILES['fotoVidrio'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoVidrio'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoVidrio'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagen($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }

    public function subirfotoPelicula($idAsignacion)
    {
        if (empty($_FILES['fotoPelicula'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoPelicula'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoPelicula'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagen($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }




    public function actualizarDatosGenerales()
    {


        $fechaVisita=$this->input->post('fechaVisita');
        $numVisita=$this->input->post('numVisita');
        $numPersonalInterno=$this->input->post('numPersonalInterno');
        $numPersonalExterno=$this->input->post('numPersonalExterno');
        $aforo=$this->input->post('aforo');
        $fechaConstruccion=$this->input->post('fechaConstruccion');
        $fechaInicioOperaciones=$this->input->post('fechaInicioOperaciones');
        $areasRemodeladas=$this->input->post('areasRemodeladas');
        $metrosConstruccion=$this->input->post('metrosConstruccion');
        $metrosTerreno=$this->input->post('metrosTerreno');
        $usoDelInmueble=$this->input->post('usoDelInmueble');
        $vidrioTemplado=$this->input->post('vidrioTemplado');
        $peliculaAntiAsalto=$this->input->post('peliculaAntiAsalto');
        $docRespaldo=$this->input->post('docRespaldo');
        $retardante=$this->input->post('retardante');
        $alertaSismo=$this->input->post('alertaSismo');
        $idAsignacion=$this->input->post('idAsignacion');

        $datosParaActualizar=Array(
            'fechaVisita'=>$fechaVisita,
            'numVisita'=>$numVisita,
            'numPersonalInterno'=>$numPersonalInterno,
            'numPersonalExterno'=>$numPersonalExterno,
            'aforo'=>$aforo,
            'fechaConstruccion'=>$fechaConstruccion,
            'fechaInicioOperaciones'=>$fechaInicioOperaciones,
            'areasRemodeladas'=>$areasRemodeladas,
            'metrosConstruccion'=>$metrosConstruccion,
            'metrosTerreno'=>$metrosTerreno,
            'usoDelInmueble'=>$usoDelInmueble,
            'vidrioTemplado'=>$vidrioTemplado,
            'peliculaAntiAsalto'=>$peliculaAntiAsalto,
            'docRespaldo'=>$docRespaldo,
            'retardante'=>$retardante,
            'alertaSismo'=>$alertaSismo,
            'idAsignacion' => $idAsignacion
        );

        $this->hidrantes->actualizarDatoGeneral($datosParaActualizar, $idAsignacion);

    }

    public function actualizarInstalacionElectrica()
    {
        $idAsignacion=$this->input->post('idAsignacion');
        $acometidaCpa=$this->input->post('acometidaCpa');
        $tipoAcome=$this->input->post('tipoAcome');
        $observaAcome=$this->input->post('observaAcome');
        $transformadorCan=$this->input->post('transformadorCan');
        $subestacion=$this->input->post('subestacion');
        $observaSubestacion=$this->input->post('observaSubestacion');
        $plantaEm=$this->input->post('plantaEm');
        $capacidadPlanta=$this->input->post('capacidadPlanta');
        $capacidadDiesel=$this->input->post('capacidadDiesel');
        $observaPlanta=$this->input->post('observaPlanta');

        $datosParaActualizar=Array(
            'acometida'=>$acometidaCpa,
            'tipoAcometida'=>$tipoAcome,
            'observacionesAcometida'=>$observaAcome,
            'transformador'=>$transformadorCan,
            'subEstacion'=>$subestacion,
            'observacionesSubEstacion'=>$observaSubestacion,
            'plantaEmergencia'=>$plantaEm,
            'capPlantaEmergencia'=>$capacidadPlanta,
            'almDieselPE'=>$capacidadDiesel,
            'observacionPlantaEmergencia'=>$observaPlanta

        );
        //echo " dato  $idAsignacion ";
        $this->hidrantes->actualizarImagenTransformador( $idAsignacion,$datosParaActualizar);
    }

    public function actualizarColindancia()
    {
        $idAsignacion=$this->input->post('idAsignacion');
        $idColindancia=$this->input->post('idColindancia');
        $fechaVisita=$this->input->post('fechaVisita');
        $calleNorte=$this->input->post('calleNorte');
        $localNorte=$this->input->post('localNorte');
        $calleSur=$this->input->post('calleSur');
        $localSur=$this->input->post('localSur');
        $calleOriente=$this->input->post('calleOriente');
        $localOriente=$this->input->post('localOriente');
        $callePoniente=$this->input->post('callePoniente');
        $localPoniente=$this->input->post('localPoniente');

        $datosParaActualizar=Array(
            'calleNorte'=>$calleNorte,
            'localNorte'=>$localNorte,
            'calleSur'=>$calleSur,
            'localSur'=>$localSur,
            'calleOriente'=>$calleOriente,
            'localOriente'=>$localOriente,
            'callePoniente'=>$callePoniente,
            'localPoniente'=>$localPoniente

        );
        //echo " dato  $idColindancia ";
        $this->hidrantes->actualizarColindancia($datosParaActualizar, $idAsignacion);


        $areaMetros=$this->input->post('areaMetros');
        $numberCajo=$this->input->post('numberCajo');
        $numberCajoincapa=$this->input->post('numberCajoincapa');
        $tipoEsta=$this->input->post('tipoEsta');

        //  $this->hidrantes->borrarDatosEstacionamiento($idAsignacion);

        $datosEstacionamientos=Array(
            'cajones'=>$numberCajo,
            'area'=>$areaMetros,
            //'fotoEstacionamiento'=>$calleSur,
            'cajonesDiscapacitados'=>$numberCajoincapa,
            //'fotoEstaDisca'=>$calleOriente,
            'tipo'=>$tipoEsta,
            'idAsignacion'=>$idAsignacion

        );
        $this->hidrantes->updateEstacionamiento($datosEstacionamientos,$idAsignacion);

        $this->hidrantes->borrarDatosPuenteAnte($idAsignacion);
        $pruebass   = $this->input->post('arreglo');
        $pruebaDos= json_encode($pruebass);

        foreach ($pruebass as $key => $value) {
            foreach ($value as $key => $value2) {

                //echo "prueba".$value['idInmuebleModal'];
                $dataPuenteAntecedente = array(
                    'fecha' => $value2['anioAnte'],
                    'evento' => $value2['eventoAnte'],
                    'observacion' => $value2['observaAnte'],
                    'idAsignacion' => $idAsignacion
                );
                $this->hidrantes->insertaDatosPuente($dataPuenteAntecedente);

            }
        }



    }

    public function formAltaCentroTrabajo()

    {
        $data['formato']= $this->hidrantes->formatoGet();
        $data['inmueble']=$this->hidrantes->inmuebleGet();
        $this->load->view('formcentrotrabajo',$data);
    }


    public function formEditarCentroTrabajo($idCentroTrabajo=null)

    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->hidrantes->formatoGet(), 'inmueble' => $this->hidrantes->inmuebleGet()];
        $this->load->view('grideditarcentrotrabajo',$data);
    }

    public function formDetalleCentroTrabajo($idCentroTrabajo=null)

    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->hidrantes->formatoGet(), 'inmueble' => $this->hidrantes->inmuebleGet()];
        $this->load->view('griddetallecentrotrabajo',$data);
    }

    function obtenerDatos($idc)
    {
        $prueba= $this->hidrantes->obtenerFicha($idc);
        echo json_encode ($prueba);
    }


    function getArray($idAsigna)
    {
        $prueba= $this->hidrantes->obtenerArray($idAsigna);
        echo json_encode ($prueba);
    }

    function modificarDatos(){

        $colonia= $this->input->post('colonia');
        $calle=$this->input->post('calle');
        $numeroInterior=$this->input->post('numInterior');
        $numeroExterior=$this->input->post('numExterior');

        $idCentroTrabajo = $this->input->post('idCentroTrabajo');
        $data = array(
            'nombre' => $this->input->post('nombreCentro'),
            'idDet' => $this->input->post('idDet'),
            'nomContacto' => $this->input->post('nomContacto'),
            'puestoContacto' => $this->input->post('puestoContacto'),
            'telContacto' => $this->input->post('telContacto'),
            'email' => $this->input->post('correoContacto'),
            'idColonia' => $colonia,
            'calle' => $calle,
            'numeroInterior' => $numeroInterior,
            'numeroExterior' => $numeroExterior,
            'idFormato'=>$this->input->post('idFormato'),
            'idInmueble'=>$this->input->post('inmueble')
        );

        $this->hidrantes->modificaDatos($data,$idCentroTrabajo);

    }



    function altaCentroTrabajo()
    {

        $idFormato = $this->input->post('idFormato');
        $idInmueble= $this->input->post('idInmueble');
        $nombreCentro=$this->input->post('nombreCentro');
        $idDet = $this->input->post('idDet');

        $colonia= $this->input->post('colonia');
        $calle=$this->input->post('calle');
        $numeroInterior=$this->input->post('numInterior');
        $numeroExterior=$this->input->post('numExterior');

        if(strlen($numeroInterior)<1)
        {
            $numeroInterior=0;
        }
        if(strlen($numeroExterior)<1)
        {
            $numeroExterior=0;
        }

        $nomContacto = $this->input->post('nomContacto');
        $puestoContacto = $this->input->post('puestoContacto');
        $telContacto = $this->input->post('telContacto');
        $correoContacto =$this->input->post('correoContacto');

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
            'idFormato' =>$idFormato,
            'idInmueble' =>$idInmueble
        );

        $this->hidrantes->insertaDatos($data);
        echo "1";

    }


    function deleteCentroTrabajo($idCentroTrabajo){

        $this->hidrantes->borrarDatos($idCentroTrabajo);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo');

    }

    function obtenerEstados()
    {
        $estados=$this->hidrantes->getEstados();
        echo json_encode($estados);
    }
    function obtenerMunicipios($idEstado)
    {
        $municipios=$this->hidrantes->getMunicipios($idEstado);
        echo json_encode($municipios);
    }
    function obtenerColonias($idMunicipio)
    {
        $regiones=$this->hidrantes->getRegiones($idMunicipio);
        echo json_encode($regiones);
    }
    function obtenerCodigoPostal($idColonia)
    {
        $cp=$this->hidrantes->getCodigoPostal($idColonia);
        echo json_encode($cp);
    }


    function subirFotoEstacionamiento($idAsignacion)
    {
        if (empty($_FILES['fotoEstacionamiento'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoEstacionamiento'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoEstacionamiento'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenEstacionamiento($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }


    function subirfotoEstaDisca($idAsignacion)
    {
        if (empty($_FILES['fotoEstaDisca'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoEstaDisca'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoEstaDisca'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenEstacionamiento($idAsignacion, $data);

                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }

        if ($success === true) {



            $output = [];

        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }


        echo json_encode($output);

    }

    function subirfotoTanqueGas($idAsignacion)
    {
        if (empty($_FILES['fotoTanqueGas'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoTanqueGas'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoTanqueGas/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoTanqueGas'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTanqueGas($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirFotoAcometida($idAsignacion)
    {
        if (empty($_FILES['fotoAcometida'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoAcometida'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/Acometida/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoAcometida'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenAcometida($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }




    function subirfotoTransformador($idAsignacion)
    {
        if (empty($_FILES['fotoTransformador'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoTransformador'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoTransformador/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoTransformador'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotosubestacion($idAsignacion)
    {
        if (empty($_FILES['fotoSenaSubEstacion'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoSenaSubEstacion'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoSubestacion/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoSenaSubEstacion'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotosubestacionDos($idAsignacion)
    {
        if (empty($_FILES['fotoSubEstacion'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoSubEstacion'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoSubestacion/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoSubEstacion'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotoPlantaEmergencia($idAsignacion)
    {
        if (empty($_FILES['fotoPlantaEmergencia'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoPlantaEmergencia'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoPlanta/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoPlantaEmergencia'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotoPlantatanque($idAsignacion)
    {
        if (empty($_FILES['fotoTanqueDieselUno'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoTanqueDieselUno'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoTanqueDieselUno'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }
    function subirfotoPlantatanqueDos($idAsignacion)
    {
        if (empty($_FILES['fotoTanqueDieselDos'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoTanqueDieselDos'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoTanqueDieselDos'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotoPlantatanqueTres($idAsignacion)
    {
        if (empty($_FILES['senalPlantaEmergencia'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['senalPlantaEmergencia'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('senalPlantaEmergencia'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenTransformador($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function eliminarImagen($campo, $tabla, $idAsignacion)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->hidrantes->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->hidrantes->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$campo/$nombreImagen");
            echo "OK";
        }

    }

    function eliminarImagenServidor($campo, $tabla, $idAsignacion)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->hidrantes->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->hidrantes->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$nombreImagen");
            echo "OK";
        }

    }

    function eliminarImagenCarpeta($campo, $tabla, $idAsignacion, $carpeta)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->hidrantes->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->hidrantes->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$carpeta/$nombreImagen");
            echo "OK";
        }

    }

    //codigo Hidrantes

    public function formHidrantes($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaHidrantes($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaHidrante($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaHidrantes($idAsignacion);
        }
        $data['cuartoBombas'] = $this->hidrantes->vericarExistenciaCuartoBombas($idAsignacion);

        $this->load->view('gridhidrantes', $data);
    }

    function subirfotoInter($idAsignacion)
    {
        if (empty($_FILES['fotoInterior'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoInterior'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoInterior/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoInterior'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenInterior($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotoExte($idAsignacion)
    {
        if (empty($_FILES['fototExterior'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fototExterior'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fototExterior/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fototExterior'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenInterior($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    function subirfotoSiamesa($idAsignacion)
    {
        if (empty($_FILES['fotoSiamesa'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoSiamesa'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoSiamesa/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoSiamesa'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenInterior($idAsignacion, $data);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    public function actualizarHidrantes()
    {
        $datosParaActualizar=Array(
            'fechaVisita'=>$this->input->post('fechaVisita'),
            'boquillaExterior15'=>$this->input->post('exteBoqui'),
            'totalBoquillas'=>$this->input->post('totalBoquillas'),
            'llaveExteroior15'=>$this->input->post('exteLave'),
            // 'llaveExterior30'=>$this->input->post(''),
            'boquillaInterior15'=>$this->input->post('InterBoqui'),
            //'boquillaInterior30'=>$this->input->post(''),
            'llaveInterior15'=>$this->input->post('InterLave'),
            'totalLlaves'=>$this->input->post('totalLlaves'),
            //'llaveInterior30'=>$this->input->post(''),
            'siamesa'=>$this->input->post('tomaSiamesas'),
            'ubicacionSiamesa'=>$this->input->post('ubicacionSiame'),
            'observacionesGral'=>$this->input->post('observacionesGral'),
            'observacionesGrales'=>$this->input->post('observaGrales')
        );



        $datosCuartoBombas =Array(
            'bombaJockey'=> (!$this->input->post('bombaJockey'))? null : $this->input->post('bombaJockey'),
            'obsBombaJockey'=> $this->input->post('obsBombaJockey'),
            'bombaInterna'=> (!$this->input->post('bombaInterna')) ? null : $this->input->post('bombaInterna'),
            'obsBombaInterna'=>$this->input->post('obsBombaInterna'),
            'bombaElectrica'=> (!$this->input->post('bombaElectrica')) ? null : $this->input->post('bombaElectrica'),
            'obsBombaElectrica'=>$this->input->post('obsBombaElectrica'),
            'fugaCombustible'=> (!$this->input->post('fugaCombustible')) ? null : $this->input->post('fugaCombustible'),
            'obsFugaCombustible'=>$this->input->post('obsFugaCombustible'),
            'fugaAgua'=> (!$this->input->post('fugaAgua')) ? null : $this->input->post('fugaAgua'),
            'obsFugaAgua'=>$this->input->post('obsFugaAgua'),
            'presionPrueba'=> (!$this->input->post('presionPrueba')) ? null : $this->input->post('presionPrueba'),
            'obsPresionPrueba'=>$this->input->post('obsPresionPrueba'),
            //'observacionesGrales'=>$this->input->post('observaGrales'),
            'extintor'=> (!$this->input->post('extintor')) ? null : $this->input->post('extintor'),
            'senializacion'=> (!$this->input->post('senializacion')) ? null : $this->input->post('senializacion'),
            'detectorHumo'=> (!$this->input->post('detectorHumo')) ? null : $this->input->post('detectorHumo'),
            'diqueContencion'=> (!$this->input->post('diqueContencion')) ? null : $this->input->post('diqueContencion'),
            'tablerosIdentificados'=> (!$this->input->post('tablerosIdentificados')) ? null : $this->input->post('tablerosIdentificados'),
            'tanqueDiselIndentificado'=> (!$this->input->post('tanqueDiselIndentificado')) ? null : $this->input->post('tanqueDiselIndentificado')
        );

        $this->hidrantes->actualizarCuartoBombas($this->input->post('idAsignacion'),$datosCuartoBombas);
        $this->hidrantes->actualizarImagenInterior($this->input->post('idAsignacion'),$datosParaActualizar);
    }

    function eliminarImagenes($campo, $tabla, $idAsignacion)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->hidrantes->getNombreImagenes($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->hidrantes->deleteImagenes($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$campo/$nombreImagen");
            echo "OK";
        }

    }
    // fin codigo Hidrantes



    // codigo extintores
    public function fomrExtintores($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->hidrantes->verificarExistenciaExtintores($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->hidrantes->nuevaExistenciaHidrante($idAsignacion);
            $data['existencia']=$this->hidrantes->verificarExistenciaMaterialesPeligrosos($idAsignacion);
        }
        $this->load->view('gridextintores', $data);
    }

    // fin codigo extintores


    /*
     * SUBIR FOTO GENERAL
     *
     */

    function subirFotoGeneral($campo, $tabla, $idAsignacion)
    {
        if (empty($_FILES[$campo]))
        {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths= [];
        $filenames = $images['name'];

        if(!file_exists("assets/img/fotoAnalisisRiesgo/$campo/") && !is_dir("assets/img/fotoAnalisisRiesgo/$campo/")) {
            mkdir("assets/img/fotoAnalisisRiesgo/$campo/");
        }
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/$campo/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array("$campo"=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->hidrantes->actualizarImagenGeneral($idAsignacion, $data, $tabla);
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $output = [];
        } elseif ($success === false) {
            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $output = ['error'=>'No hay archivos para procesar.'];
        }
        echo json_encode($output);
    }

    /*
      * SUBIR FOTO GENERAL
      *
      */



}//Class


?>
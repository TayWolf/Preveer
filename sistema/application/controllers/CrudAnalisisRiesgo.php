<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class CrudAnalisisRiesgo extends CI_Controller {
    function __construct(){
        parent::__construct();
        $this->load->model("analisisRiesgo"); //cargamos el modelo
    }

    public function index($index = 1)
    {
        $usuario=$this->session->userdata('idusuariobase');
        $areaUse=$this->session->userdata('area');
        $data['page'] = $this->analisisRiesgo->data_pagination("/CrudAnalisisRiesgo/index/",
            $this->analisisRiesgo->getTotalRowAllData($areaUse,$usuario), 3);

        if($areaUse==2)
        {
            $data['listAnalisisRiesgo'] = $this->analisisRiesgo->getDatosAnalista($index, $usuario);
        }
        else
        {
            $data['listAnalisisRiesgo'] = $this->analisisRiesgo->getDatos($index, $usuario);
        }
        $this->load->view('viewtodoanalisisriesgo',$data);
    }


    public function bitacoraHidrantes($idAsignacion)
    {
        $data = ['idAsignacion' => $idAsignacion];
        $this->load->view('gridbitacorahidrantes',$data);
    }

    public function formDatosGenerales($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistencia($idAsignacion);
        $data['tipoVisita']=0;
        $data['fotos']=$this->analisisRiesgo->verificarExistenciaFotosDatosGenerales($idAsignacion);
        $contador=0;
        $contadorFotos=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        foreach ($data['fotos'] as $row)
        {
            $contadorFotos++;
        }

        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaDatosGenerales($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistencia($idAsignacion);
            $data['tipoVisita']=1;
        }
        if($contadorFotos==0)
        {
            $this->analisisRiesgo->nuevaExistenciaFotosDatosGenerales($idAsignacion);
            $data['fotos']=$this->analisisRiesgo->verificarExistenciaFotosDatosGenerales($idAsignacion);
        }
        foreach ($this->analisisRiesgo->getCentroTrabajo($idAsignacion) as $id)
        {
            $data['idCentroTrabajo']=$id['idCentroTrabajo'];
            $data['idFormato']=$id['idFormato'];
        }

        $this->load->view('gridDatosGeneralespr', $data);
    }

    public function formInstalacionesElectricas($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaInstalacionesElectricas($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaInstalacionesElectricas($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaInstalacionesElectricas($idAsignacion);
        }
        $data['tanquePuente']=$this->analisisRiesgo->getTanquePuente($idAsignacion);
        $this->load->view('gridInstalacionesElectricas', $data);
    }

    public function otrosDatos($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        /* $data['existencia']=$this->analisisRiesgo->verificarExistenciaInstalacionesElectricas($idAsignacion);
         $contador=0;
         foreach ($data['existencia'] as $row)
         {
             $contador++;
         }
         if($contador==0)
         {
             $this->analisisRiesgo->nuevaExistenciaInstalacionesElectricas($idAsignacion);
             $data['existencia']=$this->analisisRiesgo->verificarExistenciaInstalacionesElectricas($idAsignacion);

         }
          $data['tanquePuente']=$this->analisisRiesgo->getTanquePuente($idAsignacion);*/
        $this->load->view('gridInstalacionesElectricas', $data);
    }

    public function formRevisionInstalaciones($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaRevisionInstalaciones($idAsignacion);
        $data['catalogoRevision']=$this->analisisRiesgo->obtenerDatosCatalogoRevision();
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaRevisionInstalaciones($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaRevisionInstalaciones($idAsignacion);
        }
        $data['revisionCatalogoInstalaciones']=$this->analisisRiesgo->getCatalogoRevision($idAsignacion);
        $this->load->view('gridRevisionInstalaciones', $data);
    }


    function actualizarRevisionInstalaciones()
    {

        //var_dump($datosPuenteHidraulica);
    }

    public function formMaterialesPeligrosos($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaMaterialesPeligrosos($idAsignacion);


        $data['existenciaSustancias']=$this->analisisRiesgo->verificarExistenciaSustancias($idAsignacion);

        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaMaterialesPeligrosos($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaMaterialesPeligrosos($idAsignacion);
        }
        $data['GasPuente']=$this->analisisRiesgo->getGasPuente($idAsignacion);
        $this->load->view('gridMaterialesPeligrosos', $data);
    }

    public function formColindancia($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaColindancia($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaColindancia($idAsignacion);

            $data['existencia']=$this->analisisRiesgo->verificarExistenciaColindancia($idAsignacion);
        }
        $this->load->view('gridFormColindancia', $data);
    }

    public function formExtintores($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['datoExtintor']=$this->analisisRiesgo->getDatoExtintor($idAsignacion);
        $this->load->view('gridExtintores', $data);
    }

    public function formInstalacionesHidraulicas($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaHidraulicas($idAsignacion);
        $data['catalogo']=$this->analisisRiesgo->getCatalogoHidraulica();

        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaHidraulica($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaHidraulicas($idAsignacion);
        }
        $data['hidraulicaPuente']=$this->analisisRiesgo->getHidraulicaPuente($idAsignacion);
        $this->load->view('gridInstalacionesHidraulicas', $data);
    }

    /*
    * FORM PARA EQUIPO DIELECTRICO
    * */
    public function formEquipoDielectrico($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaEquipoDielectrico($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaEquipoDielectrico($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaEquipoDielectrico($idAsignacion);
        }
        $this->load->view('gridEquipoDielectrico', $data);
    }

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
                $this->analisisRiesgo->actualizarImagenGeneral($idAsignacion, $data, $tabla);
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

    function subirFotoSusQuimicas($campo, $tabla, $idAsignacion)
    {
        if (empty($_FILES[$campo])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths= [];
        $filenames = $images['name'];

        if(!file_exists("assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/") && !is_dir("assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/")) {
            mkdir("assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/");
        }
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array("$campo"=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenGeneral($idAsignacion, $data, $tabla);
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

    function subirFotoGeneralTabla($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        if (empty($_FILES[$campo])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES[$campo];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        if(!file_exists("assets/img/fotoAnalisisRiesgo/$campo/") && !is_dir("assets/img/fotoAnalisisRiesgo/$campo/"))
        {
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
                $this->analisisRiesgo->actualizarImagenGeneralTabla($campoLlave, $llavePrimaria, $data, $tabla);
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


    function actualizarEquipoDielectrico()
    {
        $datosParaActualizar=Array(
            'pertiga'=>$this->input->post('cantPerti'),
            //'condicionesPertiga'=>$this->input->post('condicionesPertiga'),
            'casco'=>$this->input->post('cantCasco'),
           // 'condicionesCasco'=>$this->input->post('condicionesCasco'),
            'googles'=>$this->input->post('cantiLente'),
            //'condicionesGoogles'=>$this->input->post('condicionesGoogles'),
            'guantes'=>$this->input->post('cantGuante'),
            'guantesCarnazas'=>$this->input->post('cantCarn'),
            'calzado'=>$this->input->post('cantCalza'),
           // 'condicionesCalzado'=>$this->input->post('condicionesCalzado'),
            'tarimas'=>$this->input->post('cantTarim'),
           // 'codicionesTarima'=>$this->input->post('codicionesTarima'),
            'arnes'=>$this->input->post('cantArn'),
            //'condicionesArnes'=>$this->input->post('condicionesArnes'),
            'lineaVida'=>$this->input->post('cantLine'),
            //'condicionesLineavida'=>$this->input->post('condicionesLineavida'),
            'sistemaAnclaje'=>$this->input->post('cantiSistema'),
            'observacionesGrales'=>$this->input->post('obserbacionesGrales'),
            'idAsignacion' => $this->input->post('idAsignacion')
        );


        $this->analisisRiesgo->actualizarEquipoDieletrico($datosParaActualizar, $this->input->post('idAsignacion'));
    }
    /*
    *FIN DEL FORM PARA EQUIPO DIELECTRICO
    * */


    /*
    * FORM PARA EQUIPO BOMBERO
    * */
    public function formEquipoBombero($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaEquipoBombero($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaEquipoBombero($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaEquipoBombero($idAsignacion);
        }
        $data['tablaEquipo']=$this->analisisRiesgo->cargarTablaPuenteE($idAsignacion);
        $this->load->view('gridEquipoBombero', $data);
    }
    /*
    *FIN DEL FORM PARA EQUIPO BOMBERO
    * */

    /*
  * FORM PARA RESIDUOS PELIGROSOS
  * */
    public function formResiduosPeligrosos($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaResiduosPeligrosos($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaResiduosPeligrosos($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaResiduosPeligrosos($idAsignacion);
        }
        $this->load->view('gridResiduosPeligrosos', $data);
    }
    /*
    *FIN DEL FORM PARA EQUIPO BOMBERO
    * */

    /*
   * FORM PARA PRIMEROS AUXILIOS
   * */
    function formPrimerosAuxilios($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaPrimerosAuxilios($idAsignacion);
        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaPrimerosAuxilios($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaPrimerosAuxilios($idAsignacion);
        }

        for($i=5; $i<=6; $i++)
        {
            $data['instalacion'.$i] = $this->analisisRiesgo->getInstalacion($i);
        }
        $data['contenidoBotiquin']=$this->analisisRiesgo->getContenidoBotiquin($idAsignacion);

        $this->load->view('gridPrimerosAuxilios', $data);
    }


    function actualizarPrimerosAuxilios($idAsignacion, $contador5, $contador6)
    {

        $this->analisisRiesgo->borrarContenidoBotiquin($idAsignacion);

        $datosParaActualizar=Array(
            'camilla'=>$this->input->post('camilla'),
            'ferulas'=>$this->input->post('ferulas'),
            'collarin'=>$this->input->post('collarin'),
            'botiquinFijo'=>$this->input->post('botiquinFijo'),
            'botiquinMovil'=>$this->input->post('botiquinMovil'),
            'inmoCraneal'=>$this->input->post('inmoCraneal'),
            'inmoviTipoarana'=>$this->input->post('inmoviTipoarana'),
            'regadera'=>$this->input->post('regadera'),
            'otrosContenidoBotiquin'=>$this->input->post('botiquinOtros'),
            'observacionesPrimerosAuxilios'=>$this->input->post('observacionesPrimerosAuxilios'),
            'observacionesBotiquin'=>$this->input->post('observacionesBotiquin'),
            'idAsignacion' => $idAsignacion
        );


        //HUMEDO
        for($i=0; $i<$contador5; $i++)
        {
            $idIndicador=$this->input->post("indicadorMaterialHumedo".$i);
            $idPonderador=$this->input->post("ponderadorMaterialHumedo".$i);
            $cantidad=$this->input->post("cantidadMaterialHumedo".$i);
            if(!empty($idPonderador))
            {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'cantidad' => $cantidad,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertarContenidoBotiquin($array);
            }

        }
        //SECO
        for($i=0; $i<$contador6; $i++)
        {
            $idIndicador=$this->input->post("indicadorMaterialSeco".$i);
            $idPonderador=$this->input->post("ponderadorMaterialSeco".$i);
            $cantidad=$this->input->post("cantidadMaterialSeco".$i);
            if(!empty($idPonderador))
            {
                $array = array(
                    'idIndicador' => $idIndicador,
                    'idPonderador' => $idPonderador,
                    'cantidad' => $cantidad,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertarContenidoBotiquin($array);
            }
        }


        $this->analisisRiesgo->actualizarPrimerosAuxilios($datosParaActualizar, $this->input->post('idAsignacion'));
    }
    /*
    *FIN DEL FORM PARA PRIMEROS AUXILIOS
    * */


    public function actualizarMaterialesPeligrosos()
    {

        $datosParaActualizar=Array(
            //'fechaVisita'=>$this->input->post('fechaVisita'),
            //'tipoDeGas'=>$this->input->post('tipoDeGas'),
            //'NoTanques'=>$this->input->post('NoTanques'),
            'noAplicaGas'=>$this->input->post('noAplicaGas'),
            'areaEquipo'=>$this->input->post('areaEquipo'),
            'ubicacValculacierre'=>$this->input->post('ubicacValculacierre'),
            'dictamen'=>$this->input->post('dictamen'),
            'ano'=>$this->input->post('ano'),
            'isometrico'=>$this->input->post('isometrico'),
            'ubicacionGas'=>$this->input->post('ubicacionGas'),
            'observacionesInstalacionGas'=>$this->input->post('observacionesInstalacionGas'),
            'observacionesInstalacionDiesel'=>$this->input->post('observacionesInstalacionDiesel'),
            'cantDiesel'=>$this->input->post('cantDiesel'),
            'ubicaDiesel'=>$this->input->post('ubicaDiesel'),
            'diqueContencionDiesel'=>$this->input->post('diqueContencionDiesel'),
            'cantGasolina'=>$this->input->post('cantGasolina'),
            'ubicaGasolina'=>$this->input->post('ubicaGasolina'),
            'diqueContencionGasolina'=>$this->input->post('diqueContencionGasolina')
        );

        $this->analisisRiesgo->actualizarMaterialPeligroso($datosParaActualizar, $this->input->post('idAsignaciond'));
        $idAsignacion = $this->input->post('idAsignaciond');

        $datosGas = json_decode($this->input->post('datosGas'));
        foreach ($datosGas as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $dataPuente = array(
                    'tipoGas' => $value2->tipoDeGas,
                    'noTanque' => $value2->NoTanques,
                    'capacidadGas' => $value2->Capacidad,
                    'AnioFabricacion' => $value2->anoDeFabricacion,
                    'ubicacionGas' => $value2->Ubicacion,
                    'senalizacion' => $value2->seRotu,
                    'observacionesGas' => $value2->observaGas,

                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertaDatosGasPuente($dataPuente);
            }
            //UPDATE
            else if($accion == 2)
            {
                $idPuente = $value2['idPuente'];
                $dataPuente = array(
                    'tipoGas' => $value2->tipoDeGas,
                    'noTanque' => $value2->NoTanques,
                    'capacidadGas' => $value2->Capacidad,
                    'AnioFabricacion' => $value2->anoDeFabricacion,
                    'ubicacionGas' => $value2->Ubicacion,
                    'senalizacion' => $value2->seRotu,
                    'observacionesGas' => $value2->observaGas,

                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->actualizarDatosGasPuente($dataPuente, $idPuente);
            }
            //DELETE
            else if($accion == 3)
            {
                $idPuente = $value2->idPuente;
                $this->analisisRiesgo->borrarDatosGasPuente($idPuente);
            }
        }

        $datosSustanciasQuimicas = json_decode($this->input->post('datosSustanciasQuimicas'));

        foreach ($datosSustanciasQuimicas as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $datosSustancia = array(
                    'nombreSustancia' => $value2->nombreSustancia,
                    'cantidadReporte' => $value2->cantidadReporte,
                    'sitioAlmacenamiento' => $value2->sitioAlmacenamiento,
                    'usoSustancia' => $value2->usoSustancia,
                    'hojaSeguridad' => $value2->hojaSeguridad
                );
                $this->analisisRiesgo->insertarDatosSustaciaQuimica($datosSustancia);
            }
            //UPDATE
            else if($accion == 2)
            {
                $idSustanciaQuimica = $value2->idSustanciaQuimica;
                $datosSustancia = array(
                    'nombreSustancia' => $value2->nombreSustancia,
                    'cantidadReporte' => $value2->cantidadReporte,
                    'sitioAlmacenamiento' => $value2->sitioAlmacenamiento,
                    'usoSustancia' => $value2->usoSustancia,
                    'hojaSeguridad' => $value2->hojaSeguridad
                );
                $this->analisisRiesgo->actualizarDatosSustanciaQuimica($datosSustancia, $idSustanciaQuimica);
            }
            //DELETE
            else if($accion == 3)
            {
                $idSustanciaQuimica = $value2->idSustanciaQuimica;
                $this->analisisRiesgo->borrarDatosSustanciaQuimica($idSustanciaQuimica);
            }

        }
    }

     public function actualizarInstalacionHidraulica()
    {
        //instalacionesHidraulicas
        $suministro = $this->input->post('suministro');
        if($suministro == 3){ $sumOtro = $this->input->post('sumOtro'); }
        else{ $sumOtro = ""; }
        $tuberia = $this->input->post('tuberia');
        $observacionesDatos = $this->input->post('observacionesDatos');
        $idAsignacion = $this->input->post('idAsignacion');
        $idInstalacionesHidraulicas= $this->input->post('idInstalacionesHidraulicas');
        $datosInHidraulica=Array(
            'suministro'=>$suministro,
            'sumOtro'=>$sumOtro,
            'tuberia'=>$tuberia,
            'observacionesDatos' => $observacionesDatos
        );
        $this->analisisRiesgo->actualizarExistenciaHidraulica($datosInHidraulica, $idAsignacion);
        //HidraulicaCatalogoPuente
        $datosPuenteHidraulica = json_decode($this->input->post('datosPuenteHidraulica'));


        foreach ($datosPuenteHidraulica as $key => $value2)
        {
            $accion=$value2->action;
             $idHidraulicaCatalogo = $value2->idHidraulicaCatalogo;
            //INSERT
            if($accion == 1)
            {
                 

                $dataPuente = array(
                    'idInstalacion' => $value2->instalacion,
                    'idAsignacion' => $idAsignacion,
                    'idCatalogo' => $value2->catalogo,
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'ubicacion' => $value2->ubicacion,
                    'observaciones' => $value2->observaciones
                    );
                $this->analisisRiesgo->borrarDatosRevisionHidraulicas($idHidraulicaCatalogo);
                $this->analisisRiesgo->insertaDatosHidraulicaPuente($dataPuente);
            }
            //UPDATE
            else if($accion == 2)
            {
                $idHidraulicaCatalogo = $value2['idHidraulicaCatalogo'];
                $dataPuente = array(
                    'idInstalacion' => $value2->instalacion,
                    'idAsignacion' => $idAsignacion,
                    'idCatalogo' => $value2->catalogo,
                    
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'ubicacion' => $value2->ubicacion,
                    'observaciones' => $value2->observaciones
                );
                $this->analisisRiesgo->actualizarDatosHidraulicaPuente($dataPuente, $idHidraulicaCatalogo);
            }
            //DELETE
            else if($accion == 3)
            {
                $idHidraulicaCatalogo = $value2->idHidraulicaCatalogo;
                $this->analisisRiesgo->borrarDatosHidraulicaPuente($idHidraulicaCatalogo);
            }
        }
    }
   


    /*
        RESIDUOS PELIGROSOS

    */

    function insertarArregloResiduosPeligrosos($idAsignacion)
    {
        $datosResiduosPeligrosos = json_decode($this->input->post('datos'));

        foreach ($datosResiduosPeligrosos as $key => $value2)
        {
            //INSERT
            $arrayResiduosPeligrosos = array(
                'tipoAlmacen' => $value2->tipoAlmacen,
                'cantidad' => $value2->cantidadMaterial,
                'ubicacion' => $value2->ubicacionMaterial,
                'materialesComunes' => $value2->materialesComunes,
                'observaciones' => $value2->observaciones,
                'idAsignacion' => $idAsignacion
            );
            $idPrimaria = $this->analisisRiesgo->insertarArregloResiduosPeligrosos($arrayResiduosPeligrosos);
            foreach ($idPrimaria as $key3 =>$val)
                echo($val['LAST_INSERT_ID()']);

        }
    }

    function obtenerFotosResiduos($id)
    {
        echo json_encode($this->analisisRiesgo->obtenerFotosResiduosPeligrosos($id));
    }
    function obtenerFotosAlertamiento($idAsignacion)
    {
        echo json_encode($this->analisisRiesgo->obtenerFotosAlertamiento($idAsignacion));
    }
    function obtenerFotosBrigadista($idAsignacion)
    {
        echo json_encode($this->analisisRiesgo->obtenerFotosBrigadista($idAsignacion));
    }
    function obtenerFotosEvaluacionAlertamiento($idAsignacion)
    {
        echo json_encode($this->analisisRiesgo->obtenerFotosEvaluacionAlertamiento($idAsignacion));
    }


    function actualizarResiduosPeligrosos()
    {
        //datosResiduosPeligrosos
        $datosResiduosPeligrosos = json_decode($this->input->post('datosResiduosPeligrosos'));
        $idAsignacion = $this->input->post('idAsignacion');

        foreach ($datosResiduosPeligrosos as $key => $value2)
        {
            $accion = $value2->action;
            $idResiduosPeligrosos = $value2->idResiduosPeligrosos;
            //INSERT
            if($accion == 1)
            {
                $arrayResiduosPeligrosos = array(
                    'tipoAlmacen' => $value2->tipoAlmacen,
                    'cantidad' => $value2->cantidadMaterial,
                    'ubicacion' => $value2->ubicacionMaterial,
                    'materialesComunes' => $value2->materialesComunes,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->borrarDatosResiduosPeligrosos($idResiduosPeligrosos);
                $this->analisisRiesgo->insertarDatosResiduosPeligrosos($arrayResiduosPeligrosos);
            }
            //UPDATE
            else if($accion == 2)
            {
                $arrayResiduosPeligrosos = array(
                    'idCatalogoRevision' => $value2->idCatalogoRevision,
                    'estadoInstalacion' => $value2->estadoInstalacion,
                    'cantidadInstalacion' => $value2->cantidadInstalacion,
                    'ubicacion' => $value2->ubicacion,
                    'observaciones' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->actualizarDatosResiduosPeligrosos($arrayResiduosPeligrosos, $idResiduosPeligrosos);
            }
            //DELETE
            else if($accion == 3)
            {
                $this->analisisRiesgo->borrarDatosResiduosPeligrosos($idResiduosPeligrosos);
            }

        }
        //var_dump($datosPuenteHidraulica);
    }

    /*
        FIN RESIDUS PELIGROSOS
    */



    /*
     *
     * SUSTANCIAS QUIMICAS
     *
     * */

    function insertarSustanciaQuimica($idAsignacion)
    {
        $datosSustanciaQuimica = json_decode($this->input->post('datosSustanciaQuimica'));

        foreach ($datosSustanciaQuimica as $key => $value)
        {
            //INSERT
            $arraySustanciaQuimica = array(
                'nombreSustancia' => $value->sustanciaQuimica,
                'cantidadReporte' => $value->cantidadReporte,
                'sitioAlmacenamiento' => $value->sitioAlmacenamiento,
                'usoSustancia' => $value->usoSustancia,
                'hojaSeguridad' => $value->hojaSeguridad,
                'idAsignacion' => $idAsignacion
            );

            //RETORNA ID PRIMARIA REGISTRADA
            $nuevaIdPrimaria = $this->analisisRiesgo->insertarDatosSustaciaQuimica($arraySustanciaQuimica);

            foreach ($nuevaIdPrimaria as $key3 =>$val)
                echo($val['LAST_INSERT_ID()']);

        }
    }

    function obtenerFotosSustancias($id)
    {
        echo json_encode($this->analisisRiesgo->obtenerFotosSustanciasQuimicas($id));
        //echo json_encode($this->analisisRiesgo->obtenerFotosResiduosPeligrosos($id));
    }

    /*
    *
    * SUSTANCIAS QUIMICAS
    *
    * */






    /*    public function formDatosGeneralesPr($idAsignacion)
        {
            $data['idAsignacion']=$idAsignacion;
            $data['existencia']=$this->analisisRiesgo->verificarExistencia($idAsignacion);
            $contador=0;
            foreach ($data['existencia'] as $row)
            {
                $contador++;
            }
            if($contador==0)
            {
                $this->analisisRiesgo->nuevaExistenciaDatosGenerales($idAsignacion);
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
                $this->analisisRiesgo->actualizarImagen($idAsignacion, $data);

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
                $this->analisisRiesgo->actualizarImagen($idAsignacion, $data);

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
                $this->analisisRiesgo->actualizarImagen($idAsignacion, $data);

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
                $this->analisisRiesgo->actualizarImagen($idAsignacion, $data);

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

    //aqui emieza
    public function actualizarDatosGenerales()
    {
        $fechaVisita=$this->input->post('fechaVisita');
        $numVisita=$this->input->post('numVisita');
        $numPersonalInterno=$this->input->post('numPersonalInterno');
        $numPersonalExterno=$this->input->post('numPersonalExterno');
        $aforo=$this->input->post('aforo');
        $fechaConstruccion=$this->input->post('fechaConstruccion');
        $fechaInicioOperaciones=$this->input->post('fechaInicioOperaciones');
        $aplicaUltimaRemodelacion=$this->input->post('aplicaUltimaRemodelacion');
        $ultimaRemodelacion=$this->input->post('ultimaRemodelacion');
        $modificacionesRealizadas=$this->input->post('modificacionesRealizadas');
        if(strcmp($aplicaUltimaRemodelacion,"NoAplica") && isset($_POST['aplicaUltimaRemodelacion']))
        {
            $aplicaUltimaRemodelacion=1;
            $ultimaRemodelacion=null;
        }
        else
        {
            $aplicaUltimaRemodelacion=0;
        }

        $aplicaOtrasEntidades=$this->input->post('aplicaOtrasEntidades');
        $otrasEntidades=$this->input->post('otrasEntidades');
        if(strcmp($aplicaOtrasEntidades,"NoAplica") && isset($_POST['aplicaOtrasEntidades']))
        {
            $aplicaOtrasEntidades=1;
            $otrasEntidades=null;
        }
        else
        {
            $aplicaOtrasEntidades=0;
        }
        $aplicaOtrasActividades=$this->input->post('aplicaOtrasActividades');
        $otrasActividades=$this->input->post('otrasActividades');
        if(strcmp($aplicaOtrasActividades,"NoAplica") && isset($_POST['aplicaOtrasActividades']))
        {
            $aplicaOtrasActividades=1;
            $otrasActividades=null;
        }
        else
        {
            $aplicaOtrasActividades=0;
        }

        $visual = $this->input->post('visual');
        $auditiva =$this->input->post('auditiva');
        $fisica=$this->input->post('fisica');
        $intelectual=$this->input->post('intelectual');
        $mental=$this->input->post('mental');

        $cantidadPersonalDiscapacidad=$this->input->post('cantidadPersonalDiscapacidad');

        if($this->input->post('personalDiscapacidad')==1)
        {
            if (isset($_POST['visual']))
                $visual = 1;
            else
                $visual = 0;
            if ( isset($_POST['auditiva']))
                $auditiva = 1;
            else
                $auditiva = 0;
            if ( isset($_POST['fisica']))
                $fisica = 1;
            else
                $fisica = 0;
            if ( isset($_POST['intelectual']))
                $intelectual = 1;
            else
                $intelectual = 0;
            if ( isset($_POST['mental']))
                $mental = 1;
            else
                $mental = 0;
        }
        else
        {
            $visual = null;
            $auditiva =null;
            $fisica=null;
            $intelectual=null;
            $mental=null;
            $cantidadPersonalDiscapacidad=null;
        }

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
            'ultimaRemodelacion' => $ultimaRemodelacion,
            'aplicaUltimaRemodelacion' =>$aplicaUltimaRemodelacion,
            'modificacionesRealizadas' =>$modificacionesRealizadas,
            'otrasEntidades' =>$otrasEntidades,
            'aplicaOtrasEntidades' =>$aplicaOtrasEntidades,
            'otrasActividades' =>$otrasActividades,
            'aplicaOtrasActividades' =>$aplicaOtrasActividades,
            'areasRemodeladas'=>$areasRemodeladas,
            'numeroNiveles'=>$this->input->post('numeroNiveles'),
            'observacionesNiveles'=>$this->input->post('observacionesNiveles'),
            'metrosConstruccion'=>$metrosConstruccion,
            'metrosTerreno'=>$metrosTerreno,
            'usoDelInmueble'=>$usoDelInmueble,
            'serviciosDiscapacidad'=>$this->input->post('serviciosDiscapacidad'),
            'observacionesServiciosDiscapacidad'=>$this->input->post('observacionesServiciosDiscapacidad'),
            'personalDiscapacidad'=>$this->input->post('personalDiscapacidad'),
            'visual' => $visual,
            'auditiva' => $auditiva,
            'fisica' => $fisica,
            'intelectual' => $intelectual,
            'mental' => $mental,
            'cantidadPersonalDiscapacidad'=>$cantidadPersonalDiscapacidad,
            'observacionesPersonalDiscapacidad'=>$this->input->post('observacionesPersonalDiscapacidad'),
            'vidrioTemplado'=>$vidrioTemplado,
            'peliculaAntiAsalto'=>$peliculaAntiAsalto,
            'docRespaldo'=>$docRespaldo,
            'retardante'=>$retardante,
            'alertaSismo'=>$alertaSismo,
            'idAsignacion' => $idAsignacion
        );
        $this->analisisRiesgo->actualizarDatoGeneral($datosParaActualizar, $idAsignacion);
        $cimientos=Array(
            'observacionesVidrio'=>$this->input->post('obsevacionesVidrio'),
            'observacionesPelicula'=>$this->input->post('observacionesPelicula'),
            'observacionesRetardante'=>$this->input->post('obsevacionesFuego'),
            'observacionesSismica'=>$this->input->post('obsevacionesAlerta'),

            'descripcionTecho'=>$this->input->post('descripcionTecho'),
            'observacionesTecho'=>$this->input->post('observacionesTecho'),
            'descripcionMuro'=>$this->input->post('descripcionMuro'),
            'observacionesMuro'=>$this->input->post('observacionesMuro'),
            'descripcionPiso'=>$this->input->post('descripcionPiso'),
            'observacionesPiso'=>$this->input->post('observacionesPiso'),
            'descripcionIluminacion'=>$this->input->post('descripcionIluminacion'),
            'observacionesIluminacion'=>$this->input->post('observacionesIluminacion'),
            'idAsignacion' => $idAsignacion
        );
        $this->analisisRiesgo->actualizarFotoDatoGeneral($cimientos, $idAsignacion);


        $visitas=array(
            'idAsignacion' => $idAsignacion,
            'fechaAgenda' => $fechaVisita,
            'Status' => $this->input->post('tipoVisita'),
            'fechaAplicacion' => '0000-00-00',
            'tipoVisita' => 2,
            'comentario' => null
        );

        $this->analisisRiesgo->nuevaFecha($visitas);
    }
    // aqui termina

    public function actualizarInstalacionElectrica()
    {
        $fechaVisita = date("Y-m-d");

        $idAsignacion=$this->input->post('idAsignacion');
        $acometidaCpa=$this->input->post('acometidaCpa');
        $tipoAcome=$this->input->post('tipoAcome');
        $observaAcome=$this->input->post('observaAcome');
        $transformadorCan=$this->input->post('transformadorCan');
        $noAplicaTransformador = $this->input->post('noAplicaTransformador');
        $unidadTransformador=$this->input->post('unidadTransformador');
        $observacionesTransformador=$this->input->post('observacionesTransformador');
        $subestacion=$this->input->post('subestacion');
        $noAplicaSubestacion = $this->input->post('noAplicaSubestacion');
        $observaSubestacion=$this->input->post('observaSubestacion');
        $plantaEm = $this->input->post('plantaEm');
        $noAplicaPlantaEmerg = $this->input->post('noAplicaPlantaEmerg');
        $cantidadPlantas =$this->input->post('cantidadPlantas');
        $capacidadPlanta=$this->input->post('capacidadPlanta');
        $unidadPlantaEmergencia=$this->input->post('unidadPlantaEmergencia');

        $capacidadDiesel=$this->input->post('capacidadDiesel');
        $capacidadDi=$this->input->post('capacidadDi');
        $observaPlanta=$this->input->post('observaPlanta');

        $noAplicaSubestacion = $this->input->post('noAplicaSubestacion');
        $subestacion = ($noAplicaSubestacion == 1) ? 0 : $subestacion;

        $noAplicaTransformador = $this->input->post('noAplicaTransformador');
        $transformadorCan = ($noAplicaTransformador == 1) ? 0 : $transformadorCan;
        $unidadTransformador = ($noAplicaTransformador == 1) ? "" : $unidadTransformador;

        $noAplicaPlantaEmerg = $this->input->post('noAplicaPlantaEmerg');
        $plantaEm = ($noAplicaPlantaEmerg == 1) ? "" : $plantaEm;
        $cantidadPlantas = ($noAplicaPlantaEmerg == 1) ? 0 : $cantidadPlantas;
        $capacidadPlanta = ($noAplicaPlantaEmerg == 1) ? 0 : $capacidadPlanta;
        $unidadPlantaEmergencia = ($noAplicaPlantaEmerg == 1) ? "" : $unidadPlantaEmergencia;


        $datosParaActualizar=Array(
            'acometida'=>$acometidaCpa,
            'tipoAcometida'=>$tipoAcome,
            'observacionesAcometida'=>$observaAcome,
            'transformador'=>$transformadorCan,
            'noAplicaTransformador'=>$noAplicaTransformador,
            'unidadTransformador'=>$unidadTransformador,
            'observacionesTransformador'=>$observacionesTransformador,
            'subEstacion'=>$subestacion,
            'noAplicaSubestacion'=>$noAplicaSubestacion,
            'observacionesSubEstacion'=>$observaSubestacion,
            'plantaEmergencia'=>$plantaEm,
            'noAplicaPlantaEmerg'=>$noAplicaPlantaEmerg,
            'cantPlantaEmergencia'=>$cantidadPlantas,
            'capPlantaEmergencia'=>$capacidadPlanta,
            'unidadPlantaEmergencia'=>$unidadPlantaEmergencia,
            'fechaVisita'=>$fechaVisita
            //'almDieselPE'=>$capacidadDi,
            //'observacionPlantaEmergencia'=>$observaPlanta

        );
        //echo " dato  $idAsignacion ";
        $this->analisisRiesgo->actualizarImagenTransformador( $idAsignacion,$datosParaActualizar);


        //aqui codigo array
        $datosPuenteFoto = json_decode($this->input->post('datosPuenteFoto'));
        foreach ($datosPuenteFoto as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $dataPuente = array(
                    'UbicacionTanque' => $value2->UbicacionTanque,
                    'cantidadTanque' => $value2->cantidadTanq,
                    'CapacidadTanque' => $value2->capacidadDi,
                    'observacionesTanque' => $value2->observaPlanta,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertaDatosTanquePuente($dataPuente);
            }
            //UPDATE
            else if($accion == 2)
            {
                $idControl = $value2['idControl'];
                $dataPuente = array(
                    'UbicacionTanque' => $value2->UbicacionTanque,
                    'cantidadTanque' => $value2->cantidadTanq,
                    'CapacidadTanque' => $value2->capacidadDi,
                    'observacionesTanque' => $value2->observaPlanta,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->actualizarDatosTanquesPuente($dataPuente, $idControl);
            }
            //DELETE
            else if($accion == 3)
            {
                $idControl = $value2->idControl;
                $this->analisisRiesgo->borrarDatosTanquePuente($idControl);
            }

        }
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

        $riesgosExternos=$this->input->post('riesgosExternos');
        $aplicaRiesgosExternos=$this->input->post('aplicaRiesgosExternos');



        if($aplicaRiesgosExternos==1)
            $riesgosExternos = "no hay observaciones";


        $datosParaActualizar=Array(
            'calleNorte'=>$calleNorte,
            'localNorte'=>$localNorte,
            'calleSur'=>$calleSur,
            'localSur'=>$localSur,
            'calleOriente'=>$calleOriente,
            'localOriente'=>$localOriente,
            'callePoniente'=>$callePoniente,
            'localPoniente'=>$localPoniente,
            'aplicaRiesgosExternos' => $aplicaRiesgosExternos,
            'riesgosExternos' => $riesgosExternos


        );
        //echo " dato  $idColindancia ";
        $this->analisisRiesgo->actualizarColindancia($datosParaActualizar, $idAsignacion);


        $areaMetros=$this->input->post('areaMetros');
        $numberCajo=$this->input->post('numberCajo');
        $numberCajoincapa=$this->input->post('numberCajoincapa');
        $tipoEsta=$this->input->post('tipoEsta');
        $obsEstacionamiento=$this->input->post('obsEstacionamiento');

        //  $this->analisisRiesgo->borrarDatosEstacionamiento($idAsignacion);

        $datosEstacionamientos=Array(
            'cajones'=>$numberCajo,
            'area'=>$areaMetros,
            //'fotoEstacionamiento'=>$calleSur,
            'cajonesDiscapacitados'=>$numberCajoincapa,
            //'fotoEstaDisca'=>$calleOriente,
            'tipo'=>$tipoEsta,
            'obsEstacionamiento'=>$obsEstacionamiento,
            'idAsignacion'=>$idAsignacion

        );
        $this->analisisRiesgo->updateEstacionamiento($datosEstacionamientos,$idAsignacion);

        $this->analisisRiesgo->borrarDatosPuenteAnte($idAsignacion);
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
                $this->analisisRiesgo->insertaDatosPuente($dataPuenteAntecedente);

            }
        }
    }

    public function actualizarExtintor()
    {

        $datos = json_decode($this->input->post('arreglo'));
        $idAsignacion = $this->input->post('idAsignacion');

        foreach ($datos as $key => $value2)
        {
            $accion = $value2->action;

            //INSERT
            if($accion == 1)
            {
                $datos = array(
                    'idExtintor' => $value2->idExtintor,
                    'tipoFuego' => $value2->tipoFuego,
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'tipoRecipiente' => $value2->tipoRecipiente,
                    'sistemaSupresion' => $value2->sistemaSupresion,
                    'sistemaSupresionObservaciones' => $value2->sistemaSupresionObservaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertaDatosPuenteExtintor($datos);
            }
            //UPDATE
            else if($accion == 2)
            {
                $datos = array(
                    'idExtintor' => $value2->idExtintor,
                    'tipoFuego' => $value2->tipoFuego,
                    'capacidad' => $value2->capacidad,
                    'cantidad' => $value2->cantidad,
                    'tipoRecipiente' => $value2->tipoRecipiente,
                    'sistemaSupresion' => $value2->sistemaSupresion,
                    'sistemaSupresionObservaciones' => $value2->sistemaSupresionObservaciones,
                    'idAsignacion' => $idAsignacion
                );
                //AGREGAR MODELO DE ACTUALIZAR
            }
            //DELETE
            else if($accion == 3)
            {
                $this->analisisRiesgo->borrarDatosExtintor($value2->idExtintor);
            }

        }

        $arregloDato=array
        (
            'cumpleAltura' => $this->input->post('cumpleAltura'),
            'etiquetaCollarin' => $this->input->post('etiquetaCollarin'),
            'cumpleDistribucion' => $this->input->post('cumpleDistribucion'),
            'equiposRecargados' => $this->input->post('equiposRecargados'),
            'equiposDescargados' => $this->input->post('equiposDescargados'),
            'equipoDanado' => $this->input->post('equipoDanado'),
            'bitacoraCoincide' => $this->input->post('bitacoraCoincide'),
            'fechaRecarga1' => $this->input->post('fechaRecarga1'),
            'fechaRecarga2' => $this->input->post('fechaRecarga2'),
            'fechaRecarga3' => $this->input->post('fechaRecarga3'),
            'fechaRecarga4' => $this->input->post('fechaRecarga4'),
            'fechaRecarga5' => $this->input->post('fechaRecarga5'),
            'observacionesGenerales' => $this->input->post('observacionesGenerales'),
            'idAsignacion' => $this->input->post('idAsignacion')
        );
            $this->analisisRiesgo->borrarDatoExtintor($idAsignacion);
            $this->analisisRiesgo->insertarDatoExtintor($arregloDato);



    }
    public function getFotosExtintor($idExtintor)
    {
        echo json_encode($this->analisisRiesgo->getFotosExtintor($idExtintor));
    }



    public function formAltaCentroTrabajo()

    {
        $data['formato']= $this->analisisRiesgo->formatoGet();
        $data['inmueble']=$this->analisisRiesgo->inmuebleGet();
        $this->load->view('formcentrotrabajo',$data);
    }


    public function formEditarCentroTrabajo($idCentroTrabajo=null)

    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->analisisRiesgo->formatoGet(), 'inmueble' => $this->analisisRiesgo->inmuebleGet()];
        $this->load->view('grideditarcentrotrabajo',$data);
    }

    public function formDetalleCentroTrabajo($idCentroTrabajo=null)

    {
        $data = ['idCentroTrabajo' => $idCentroTrabajo, 'formato' => $this->analisisRiesgo->formatoGet(), 'inmueble' => $this->analisisRiesgo->inmuebleGet()];
        $this->load->view('griddetallecentrotrabajo',$data);
    }

    function obtenerDatos($idc)
    {
        $prueba= $this->analisisRiesgo->obtenerFicha($idc);
        echo json_encode ($prueba);
    }


    function getArray($idAsigna)
    {
        $prueba= $this->analisisRiesgo->obtenerArray($idAsigna);
        echo json_encode ($prueba);
    }
    function getArrayExtintor($idAsigna)
    {
        $prueba= $this->analisisRiesgo->obtenerArrayExtintor($idAsigna);
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

        $this->analisisRiesgo->modificaDatos($data,$idCentroTrabajo);

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

        $this->analisisRiesgo->insertaDatos($data);
        echo "1";

    }


    function deleteCentroTrabajo($idCentroTrabajo){

        $this->analisisRiesgo->borrarDatos($idCentroTrabajo);
        redirect('https://cointic.com.mx/preveer/sistema/index.php/CrudAnalisisRiesgo');

    }

    function obtenerEstados()
    {
        $estados=$this->analisisRiesgo->getEstados();
        echo json_encode($estados);
    }
    function obtenerMunicipios($idEstado)
    {
        $municipios=$this->analisisRiesgo->getMunicipios($idEstado);
        echo json_encode($municipios);
    }
    function obtenerColonias($idMunicipio)
    {
        $regiones=$this->analisisRiesgo->getRegiones($idMunicipio);
        echo json_encode($regiones);
    }
    function obtenerCodigoPostal($idColonia)
    {
        $cp=$this->analisisRiesgo->getCodigoPostal($idColonia);
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
                $this->analisisRiesgo->actualizarImagenEstacionamiento($idAsignacion, $data);

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

    function fotoInstalacion($idAsignacion,$idCta,$estado)
    {
        if (empty($_FILES['fotoInstalacion'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoInstalacion'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoInstalacion/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoInstalacion'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenInsta($idAsignacion,$idCta,$estado, $data);

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

    function subirFotoEstacionamientotres($idAsignacion)
    {
        if (empty($_FILES['fotoEstacionamientotres'])) {
            echo json_encode(['error'=>'No hay imagen.']);

            return;
        }

        $images = $_FILES['fotoEstacionamientotres'];

        $success = null;

        $paths= [];

        $filenames = $images['name'];

        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {

                $data=Array('fotoEstacionamientotres'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenEstacionamiento($idAsignacion, $data);

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

    function retornoFoto($idAsi,$idCata,$Estadid)
    {
        $prueba= $this->analisisRiesgo->retornarFoto($idAsi,$idCata,$Estadid);
        echo json_encode ($prueba);
    }

    function retornoFotoTanque($idAsi,$capa,$canti)
    {
        $prueba= $this->analisisRiesgo->retornarFotoTanqu($idAsi,$capa,$canti);
        echo json_encode ($prueba);
    }

    function retornofotoHidra($idAsi,$idT,$capa,$canti)
    {
        $prueba= $this->analisisRiesgo->retornarFotoHidrante($idAsi,$idT,$capa,$canti);
        echo json_encode ($prueba);
    }

    function retornoFotoGas($idAsi,$tipG,$capa)
    {
        $prueba= $this->analisisRiesgo->retornarFotoGas($idAsi,$tipG,$capa);
        echo json_encode ($prueba);
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
                $this->analisisRiesgo->actualizarImagenEstacionamiento($idAsignacion, $data);

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
                $this->analisisRiesgo->actualizarImagenTanqueGas($idAsignacion, $data);
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
                $this->analisisRiesgo->actualizarImagenAcometida($idAsignacion, $data);
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
                $this->analisisRiesgo->actualizarImagenTransformador($idAsignacion, $data);
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
                $this->analisisRiesgo->actualizarImagenTransformador($idAsignacion, $data);
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
                $this->analisisRiesgo->actualizarImagenTransformador($idAsignacion, $data);
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
                $this->analisisRiesgo->actualizarImagenTransformador($idAsignacion, $data);
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

    function subirfotoPlantatanque($idAsignacion,$capac,$cantid)
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
                $data=Array('fotoTanqueU'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenTanque($idAsignacion,$capac,$cantid, $data);
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
    //
    function subirfotoHidra($idAsignacion,$idT,$capac,$cantid)
    {
        if (empty($_FILES['fotoHidraulica'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        //echo "entrante $idAsignacion  $idT $capac $cantid";
        $images = $_FILES['fotoHidraulica'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoHidraulicas/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('foto'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenHidra($idAsignacion,$idT,$capac,$cantid, $data);
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

    function subirfotoPlantatanqueDos($idAsignacion,$capac,$cantid)
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
                $data=Array('fotoTanqueD'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarImagenTanque($idAsignacion,$capac,$cantid, $data);
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
                $this->analisisRiesgo->actualizarImagenTransformador($idAsignacion, $data);
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

    //
    function subirfotoGas($idAsignacion,$tipoG,$Capa)
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
            $target = "assets/img/fotoAnalisisRiesgo/fotoTanqueGas/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoGas'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarGas($idAsignacion,$tipoG,$Capa, $data);
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

    function subirfotoGasD($idAsignacion,$tipoG,$Capa)
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
            $target = "assets/img/fotoAnalisisRiesgo/fotoTanqueGas/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoGasDos'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarGas($idAsignacion,$tipoG,$Capa, $data);
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

    function subirfotoGasT($idAsignacion,$tipoG,$Capa)
    {
        if (empty($_FILES['fotoTanqueDieselTres'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoTanqueDieselTres'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoTanqueGas/" . $nombre;
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoGasTres'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizarGas($idAsignacion,$tipoG,$Capa, $data);
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
    //

    function eliminarImagen($campo, $tabla, $idAsignacion)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->analisisRiesgo->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->analisisRiesgo->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$campo/$nombreImagen");
            echo "OK";
        }

    }
    function eliminarImagenArreglo($campo, $tabla, $llavePrimaria, $campoLlave)
    {
        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->analisisRiesgo->getNombreImagenTabla($campo, $tabla, $llavePrimaria, $campoLlave);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->analisisRiesgo->deleteImagenTabla($borrar, $tabla, $llavePrimaria, $campoLlave);
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
        $data=$this->analisisRiesgo->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->analisisRiesgo->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$nombreImagen");
            echo "OK";
        }

    }

    function eliminarImagenServidorGas($idAsi, $tipoG, $Capac)
    {
        $data=$this->analisisRiesgo->getNombreImagenGas($idAsi, $tipoG, $Capac);
        $borrar=Array('fotoGas' => null);
        $this->analisisRiesgo->deleteImagenGas($idAsi, $tipoG, $Capac, $borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoGas'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoTanqueGas/$nombreImagen");
            echo "OK";
        }
    }

    function eliminarImagenServidorGasD($idAsi, $tipoG, $Capac)
    {
        $data=$this->analisisRiesgo->getNombreImagenGas($idAsi, $tipoG, $Capac);
        $borrar=Array('fotoGasDos' => null);
        $this->analisisRiesgo->deleteImagenGas($idAsi, $tipoG, $Capac, $borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoGasDos'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoTanqueGas/$nombreImagen");
            echo "OK";
        }
    }

    function eliminarImagenServidorGasT($idAsi, $tipoG, $Capac)
    {
        $data=$this->analisisRiesgo->getNombreImagenGas($idAsi, $tipoG, $Capac);
        $borrar=Array('fotoGasTres' => null);
        $this->analisisRiesgo->deleteImagenGas($idAsi, $tipoG, $Capac, $borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoGasTres'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoTanqueGas/$nombreImagen");
            echo "OK";
        }
    }


    function eliminarImagenServidorTanque($idAsi, $capa, $canti)
    {
        $data=$this->analisisRiesgo->getNombreImagenTanques($idAsi, $capa, $canti);
        $borrar=Array('fotoTanqueU' => null);
        $this->analisisRiesgo->deleteImagenTanques($idAsi, $capa, $canti,$borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoTanqueU'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/$nombreImagen");
            echo "OK";
        }
    }

    function eliminarImagenServidorHidraulico($idAsi,$idT ,$capa, $canti,$idContr)
    {
        $data=$this->analisisRiesgo->getNombreImagenHidrau($idAsi, $capa, $canti,$idT ,$capa, $canti,$idContr);
        $borrar=Array('foto' => null);
        $this->analisisRiesgo->deleteImagenHidraulica($idAsi,$idT ,$capa, $canti,$idContr,$borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['foto'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoHidraulicas/$nombreImagen");
            echo "OK";
        }
    }

    function eliminarImagenServidorTanqueD($idAsi, $capa, $canti)
    {
        $data=$this->analisisRiesgo->getNombreImagenTanques($idAsi, $capa, $canti);
        $borrar=Array('fotoTanqueD' => null);
        $this->analisisRiesgo->deleteImagenTanques($idAsi, $capa, $canti,$borrar);
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoTanqueD'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoPlantaTanque/$nombreImagen");
            echo "OK";
        }
    }


    function eliminarImagenServidorInstala($idControl)
    {
        echo "entra el idControl $idControl";
        $data=$this->analisisRiesgo->getNombreImagenControl($idControl);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array('fotoInstalacion' => null);
        $this->analisisRiesgo->deleteImagenControl($idControl,$borrar);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row['fotoInstalacion'];
            unlink("assets/img/fotoAnalisisRiesgo/fotoInstalacion/$nombreImagen");
            echo "OK";
        }


    }

    function eliminarImagenCarpeta($campo, $tabla, $idAsignacion, $carpeta)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->analisisRiesgo->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->analisisRiesgo->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/$carpeta/$nombreImagen");
            echo "OK";
        }

    }

    function eliminarImagenSusQ($campo, $tabla, $idAsignacion)
    {

        //Comunicar con el modelo para sacar el nombre de la imagen
        $data=$this->analisisRiesgo->getNombreImagen($campo, $tabla, $idAsignacion);
        //Delete el nombre de la imagen de la base de datos
        $borrar=Array($campo => null);
        $this->analisisRiesgo->deleteImagen($borrar, $tabla, $idAsignacion);
        //Unlink el nombre de la imagen del servidor
        foreach($data as $row)
        {
            $nombreImagen=$row[$campo];
            unlink("assets/img/fotoAnalisisRiesgo/fotoSustanciasQuimicas/$nombreImagen");
            echo "OK";
        }

    }


    public function actualizarEquipoBombero()
    {
        $idAsignacion=$this->input->post('idAsignacion');
       /* $casco=$this->input->post('casco');
        $condicionesCasco=$this->input->post('condicionesCasco');
        $monja=$this->input->post('monja');
        $condicionesMonja=$this->input->post('condicionesMonja');
        $chaqueton=$this->input->post('chaqueton');
        $condicionesChaqueton=$this->input->post('condicionesChaqueton');
        $pantalon=$this->input->post('pantalon');
        $condicionesPantalon=$this->input->post('condicionesPantalon');
        $guantes=$this->input->post('guantes');
        $condicionesGuantes=$this->input->post('condicionesGuantes');
        $botas=$this->input->post('botas');
        $condicionesBotas=$this->input->post('condicionesBotas');
        $botasLargas=$this->input->post('botasLargas');
        $condicionesBotasLar=$this->input->post('condicionesBotasLar');
        $pala=$this->input->post('pala');
        $condicionesPala=$this->input->post('condicionesPala');
        $picoHacha=$this->input->post('picoHacha');
        $condicionesPicoHacha=$this->input->post('condicionesPicoHacha');*/
        $obserbacionesGrales=$this->input->post('obserbacionesGrales');

        $datosParaActualizar=Array(
            'Observaciones'=>$obserbacionesGrales
        );
        echo " dato  $idAsignacion y Observaciones $obserbacionesGrales ";
        $this->analisisRiesgo->actualizaEqBombero( $idAsignacion,$datosParaActualizar);

        $datosGabinete = json_decode($this->input->post('datosGabinete'));
        foreach ($datosGabinete as $key => $value2)
        {
            $accion=$value2->action;
            //INSERT
            if($accion == 1)
            {
                $dataPuente = array(
                    'casco' => $value2->casco,
                    'monja' => $value2->monjaCant,
                    'chaqueton' => $value2->chaquetonCant,
                    'pantalon' => $value2->cantidadPanta,
                    'guantes' => $value2->cantidGuantes,
                    'botas' => $value2->botasCantida,
                    'pala' => $value2->palaCantida,
                    'pico' => $value2->picoCantida,
                    'hacha' => $value2->hachaCantida,
                    'cuentaBitacora' => $value2->cuentaBitacora,
                    //'pico' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->insertarDatosEquipos($dataPuente, 'equipoBomberospuente');
            }
            //UPDATE
            else if($accion == 2)
            {
                $idControl = $value2->idControl;
                $dataPuente = array(
                    'casco' => $value2->casco,
                    'monja' => $value2->monjaCant,
                    'chaqueton' => $value2->chaquetonCant,
                    'pantalon' => $value2->cantidadPanta,
                    'guantes' => $value2->cantidGuantes,
                    'botas' => $value2->botasCantida,
                    'pala' => $value2->palaCantida,
                    'pico' => $value2->picoCantida,
                    'hacha' => $value2->hachaCantida,
                    'cuentaBitacora' => $value2->cuentaBitacora,
                    //'pico' => $value2->observaciones,
                    'idAsignacion' => $idAsignacion
                );
                $this->analisisRiesgo->actualizarDatosEquipo($dataPuente, $idControl, 'equipoBomberospuente');
            }
            //DELETE
            else if($accion == 3)
            {
                $idControl = $value2->idControl;
                $this->analisisRiesgo->borrarDatosBitacora($idControl, 'BitacoraSenaleticaPuente');
            }
        }

    }

    function insertarArregloRevisionInstalaciones($idAsignacion)
{
  $datosResiduosPeligrosos = json_decode($this->input->post('datos'));

  foreach ($datosResiduosPeligrosos as $key => $value2)
  {
      //INSERT
      $array = array(
          'idCatalogoRevision' => $value2->idCatalogoRevision,
          'estadoInstalacion' => $value2->estadoInstalacion,
          'cantidadInstalacion' => $value2->cantidadInstalacion,
          'ubicacion' => $value2->ubicacion,
          'observaciones' => $value2->observaciones,
          'idAsignacion' => $idAsignacion
      );
      $idPrimaria = $this->analisisRiesgo->insertarArregloRevisionInstalaciones($array);
      foreach ($idPrimaria as $key3 =>$val)
          echo($val['LAST_INSERT_ID()']);

  }
}
    function insertarArrayExtintor($idAsignacion)
    {
        $datos = json_decode($this->input->post('datos'));

        foreach ($datos as $key => $value2)
        {
            //INSERT
            $array = array(
                'tipoFuego' => $value2->tipoFuego,
                'capacidad' => $value2->capacidad,
                'cantidad' => $value2->cantidad,
                'tipoRecipiente' => $value2->tipoRecipiente,
                'sistemaSupresion' => $value2->sistemaSupresion,
                'sistemaSupresionObservaciones' => $value2->sistemaSupresionObservaciones,
                'idAsignacion' => $idAsignacion
            );
            $idPrimaria = $this->analisisRiesgo->insertarArregloExtintores($array);
            foreach ($idPrimaria as $key3 =>$val)
                echo($val['LAST_INSERT_ID()']);

        }
    }

function insertarArregloInstalacionesHidraulicas($idAsignacion)
{
  $datosInstalacionesHidraulicas = json_decode($this->input->post('datos'));

  foreach ($datosInstalacionesHidraulicas as $key => $value2)
  {
      //INSERT
  	 $array = array(
        'idInstalacion' => $value2->instalacion,
        'idAsignacion' => $idAsignacion,
        'idCatalogo' => $value2->catalogo,
        'capacidad' => $value2->capacidad,
        'capacidadBomba' => $value2->capacidadBomba,
        'cantidad' => $value2->cantidad,
        'ubicacion' => $value2->ubicacion,
        'observaciones' => $value2->observaciones
        );
          
      $idPrimaria = $this->analisisRiesgo->insertaDatosHidraulicaPuente($array);
      foreach ($idPrimaria as $key3 =>$val)
          echo($val['LAST_INSERT_ID()']);
  }
}

function retornoFotoPK($idLlavePrimaria, $tabla, $campo)
{
  echo json_encode( $this->analisisRiesgo->retornarFotoPK($idLlavePrimaria, $tabla, $campo));
}
    /*Fotos equipo bombero*/
    function subirFotoCascoB($idAsignacion)
    {
        if (empty($_FILES['fotoCasco'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoCasco'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoCasco'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoMonjaB($idAsignacion)
    {
        if (empty($_FILES['fotoMonja'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoMonja'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoMonja'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoChaquetonB($idAsignacion)
    {
        if (empty($_FILES['fotoChaqueton'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoChaqueton'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoChaqueton'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoPantalonB($idAsignacion)
    {
        if (empty($_FILES['fotoPantalon'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoPantalon'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoPantalon'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoGuantesB($idAsignacion)
    {
        if (empty($_FILES['fotoGuantes'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoGuantes'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoGuantes'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoBotasB($idAsignacion)
    {
        if (empty($_FILES['fotoBotas'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoBotas'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoBotas'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoBotasLarB($idAsignacion)
    {
        if (empty($_FILES['fotoBotaslarga'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoBotaslarga'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoBotaslarga'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoPicoHacB($idAsignacion)
    {
        if (empty($_FILES['fotoPicoHac'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoPicoHac'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoPicoHac'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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

    function subirFotoPalaB($idAsignacion)
    {
        if (empty($_FILES['fotoPala'])) {
            echo json_encode(['error'=>'No hay imagen.']);
            return;
        }
        $images = $_FILES['fotoPala'];
        $success = null;
        $paths= [];
        $filenames = $images['name'];
        for($i=0; $i < count($filenames); $i++){
            $ext = explode('.', basename($filenames[$i]));
            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            $target = "assets/img/fotoAnalisisRiesgo/fotoEquipoBombero/" . $nombre;
            //  echo "entra $nombre";
            if(move_uploaded_file($images['tmp_name'][$i], $target)) {
                $data=Array('fotoPala'=>$nombre);
                //AQUI VA A GUARDAR EN LA BASE DE DATOS
                $this->analisisRiesgo->actualizaEqBombero($idAsignacion, $data);
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


    function actualizarSensores()
    {
        $datosParaActualizar=Array(
            'sensorHumoAplica'=>$this->input->post('aplicaSensorHumo'),
            'sensorHumoCantidad'=>$this->input->post('sensorHumoCantidad'),
            'sensorHumoFaltantes'=>$this->input->post('sensorHumoFaltantes'),
            'sensorHumoAveriados'=>$this->input->post('sensorHumoAveriados'),
            'sensorHumoObservaciones'=>$this->input->post('sensorHumoObservaciones'),
            'sensorTemperaturaAplica'=>$this->input->post('aplicaSensorTemperatura'),
            'sensorTemperaturaCantidad'=>$this->input->post('sensorTemperaturaCantidad'),
            'sensorTemperaturaFaltantes'=>$this->input->post('sensorTemperaturaFaltantes'),
            'sensorTemperaturaAveriados'=>$this->input->post('sensorTemperaturaAveriados'),
            'sensorTemperaturaObservaciones'=>$this->input->post('sensorTemperaturaObservaciones'),
            'sensorTipoHazAplica'=>$this->input->post('aplicaSensorTipoHaz'),
            'sensorTipoHazCantidad'=>$this->input->post('sensorTipoHazCantidad'),
            'sensorTipoHazFaltantes'=>$this->input->post('sensorTipoHazFaltantes'),
            'sensorTipoHazAveriados'=>$this->input->post('sensorTipoHazAveriados'),
            'sensorTipoHazObservaciones'=>$this->input->post('sensorTipoHazObservaciones'),
            'sensorHidrogenoAplica'=>$this->input->post('aplicaSensorHidrogeno'),
            'sensorHidrogenoCantidad'=>$this->input->post('sensorHidrogenoCantidad'),
            'sensorHidrogenoFaltantes'=>$this->input->post('sensorHidrogenoFaltantes'),
            'sensorHidrogenoAveriados'=>$this->input->post('sensorHidrogenoAveriados'),
            'sensorHidrogenoObservaciones'=>$this->input->post('sensorHidrogenoObservaciones'),
            'sensorInfrarrojoAplica'=>$this->input->post('aplicaSensorInfrarrojo'),
            'sensorInfrarrojoCantidad'=>$this->input->post('sensorInfrarrojoCantidad'),
            'sensorInfrarrojoFaltantes'=>$this->input->post('sensorInfrarrojoFaltantes'),
            'sensorInfrarrojoAveriados'=>$this->input->post('sensorInfrarrojoAveriados'),
            'sensorInfrarrojoObservaciones'=>$this->input->post('sensorInfrarrojoObservaciones'),
            'pulsadorManual'=>$this->input->post('pulsadorManual'),
            'alarmaLuminosa'=>$this->input->post('alarmaLuminosa'),
            'megafono'=>$this->input->post('megafono'),
            'otro'=>$this->input->post('otro'),
            'observacionesIncendio' => $this->input->post('observacionesIncendio'),
            'idAsignacion' => $this->input->post('idAsignacion')
        );


        $datosBrigadistas= array(
            'gafetes' => $this->input->post('gafetes'),
            'brazaletes' => $this->input->post('brazaletes'),
            'chalecos' => $this->input->post('chalecos'),
            'colores' => $this->input->post('colores'),
            'observaciones' => $this->input->post('observacionesBrigadista')
        );

        $datosEvaluacion = array
        (
            'lamparaEmergencia' => $this->input->post('lamparaEmergencia'),
            'salidaEmergencia' => $this->input->post('salidaEmergencia'),
            'puntoReunion' => $this->input->post('puntoReunion'),
            'radio' => $this->input->post('radio'),
            'silbato' => $this->input->post('silbato'),
            'observacionesEvaluacion' => $this->input->post('observacionesEvaluacion')
        );

        $this->analisisRiesgo->actualizarSensores($datosBrigadistas,$datosEvaluacion,$datosParaActualizar, $this->input->post('idAsignacion'));

    }

    public function formSensores($idAsignacion)
    {
        $data['idAsignacion']=$idAsignacion;
        $data['existencia']=$this->analisisRiesgo->verificarExistenciaSensores($idAsignacion);
        $data['Brigadista'] =$this->analisisRiesgo->getDatosIdentificacionBrigadista($idAsignacion);
        $data['Evaluacion'] =$this->analisisRiesgo->getDatosEvaluacionAlertamiento($idAsignacion);

        $contador=0;
        foreach ($data['existencia'] as $row)
        {
            $contador++;
        }
        if($contador==0)
        {
            $this->analisisRiesgo->nuevaExistenciaSensores($idAsignacion);
            $data['existencia']=$this->analisisRiesgo->verificarExistenciaSensores($idAsignacion);
        }
        $this->load->view('gridAlertamiento', $data);
    }
    /*END Fotos equipo bombero*/


}//Class


?>
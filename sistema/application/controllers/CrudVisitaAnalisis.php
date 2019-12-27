<?php

defined('BASEPATH') OR exit('No direct script access allowed');



class CrudVisitaAnalisis extends CI_Controller

{

    function __construct()

    {

        parent::__construct();

        $this->load->model("visitaAnalisis");

    }

    function index($index=1)

    {

        $usuario=$this->session->userdata('idusuariobase');

        $areaUse=$this->session->userdata('area');

        $data['visitas']=$this->visitaAnalisis->getDatos( $usuario);

        $data['formularios']=$this->visitaAnalisis->getFormularios();

        $this->load->view('viewTodoVisitaAnalisis',$data);



    }

    function verAnalisisRiesgo($idAsignacion, $idFormulario)

    {

        $arregloFormularioAsignacion=$this->visitaAnalisis->getFormularioAsignacion($idAsignacion, $idFormulario);

        $data['idReporteAsignacion']=$arregloFormularioAsignacion;

        $data['idAsignacion']=$idAsignacion;

        $data['idFormulario']=$idFormulario;
        $data['idCentroTrabajo']=$this->visitaAnalisis->getIdCentroTrabajo($idAsignacion);
        $data['nombreCentroTrabajo']=$this->visitaAnalisis->getNombreCentroTrabajo($idAsignacion);

        $data['tablas']=$this->visitaAnalisis->getTablas($arregloFormularioAsignacion[0]['idFormularioAsignacion']);

        $data['fotos']=$this->visitaAnalisis->getFotosFormulario($arregloFormularioAsignacion[0]['idFormularioAsignacion']);

        $data['nombreFormulario']=$this->visitaAnalisis->getNombreFormulario($idFormulario);
        //echo $data['nombreFormulario']."==Datos Generales||$idFormulario==12";
        if($data['nombreFormulario']=="Datos Generales"||$idFormulario==12)
        {
            $data['inmueble']=$this->visitaAnalisis->getTiposInmueble();
            $data['formato']=$this->visitaAnalisis->getAllFormatos();

        }

        $data['acordeones']=$this->visitaAnalisis->getAcordeones($idFormulario);

        $data['indicadores']=$this->visitaAnalisis->getIndicadores($idFormulario);

        $this->load->view('formVisitaAnalisis', $data);

    }

    function getPonderadores($idFormulario)

    {

        echo json_encode($this->visitaAnalisis->getPonderadores($idFormulario));

    }

    function subirAnalisisRiesgo($idFormularioAsignacion, $numeroTotalIndicadores)

    {

        $this->visitaAnalisis->borrarAlmacenamiento($idFormularioAsignacion);

        for ($i = 0; $i < $numeroTotalIndicadores; $i++)

        {

            $idIndicador=$this->input->post('idIndicador'.$i);

            $valor=$this->input->post('idIndic'.$i);

            $idAcordeon=$this->input->post('idAcordeonPerteneciente'.$i);



            if(!empty($idIndicador)&&!empty($valor))

            {

                $arreglo=array('idIndicador' => $idIndicador, 'valor' => $valor,'idAcordeon' => $idAcordeon,'idFormularioAsignacion' => $idFormularioAsignacion);

                $this->visitaAnalisis->insertarAlmacenamiento($arreglo);

            }

        }

    }

    function obtenerDatosGuardados($idFormularioAsignacion)

    {

        echo json_encode($this->visitaAnalisis->obtenerDatosGuardados($idFormularioAsignacion));

    }

    function borrarFotoModal($idFormulario, $idFormularioAsignacion, $idFormularioTablaAcordeon, $numeroFoto)

    {

        $nombreFoto=$this->visitaAnalisis->borrarFotoModal($idFormularioAsignacion, $idFormularioTablaAcordeon, $numeroFoto);

        if(!empty($nombreFoto))

            unlink("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion".$nombreFoto);

    }

    function borrarFoto($idFormulario, $idFormularioAsignacion, $idIndicador, $idAcordeon)

    {

        $nombreFoto=$this->visitaAnalisis->borrarFoto($idFormularioAsignacion, $idIndicador, $idAcordeon);

        if(!empty($nombreFoto))

            unlink("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion".$nombreFoto);

    }

    function subirFotoFila($idFormulario, $idFormularioAsignacion, $idFormularioTablaAcordeon, $numeroFoto)

    {



        if (empty($_FILES["fotoModal".$numeroFoto]))

        {

            echo json_encode(['error'=>'No hay imagen.']);

            return;

        }

        $images = $_FILES["fotoModal".$numeroFoto];

        $success = null;

        $paths= [];

        $filenames = $images['name'];



        if(!file_exists("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/") && !is_dir("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/")) {

            mkdir("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/");

        }

        for($i=0; $i < count($filenames); $i++)

        {

            $ext = explode('.', basename($filenames[$i]));

            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);

            $target = "assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/" . $nombre;

            //  echo "entra $nombre";

            if(move_uploaded_file($images['tmp_name'][$i], $target))

            {

                $this->borrarFotoModal($idFormulario,$idFormularioAsignacion, $idFormularioTablaAcordeon, $numeroFoto);

                $data=Array('idFormularioAsignacion' => $idFormularioAsignacion,'foto'=>$nombre, 'idFormularioTablaAcordeon' =>$idFormularioTablaAcordeon, 'numeroFotoTabla'=>$numeroFoto);

                //AQUI VA A GUARDAR EN LA BASE DE DATOS

                $this->visitaAnalisis->actualizarImagenTabla($data, 'FormularioFotos');

                $success = true;

                $paths[] = $target;

            } else {

                $success = false;

                break;

            }

        }

        if ($success === true) {

            $output = [];

        }

        elseif ($success === false)

        {

            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file)

            {

                unlink($file);

            }

        }

        else

        {

            $output = ['error'=>'No hay archivos para procesar.'];

        }

        echo json_encode($output);

    }

    function subirFoto($idFormulario,$idFormularioAsignacion, $idIndicador, $idAcordeon)

    {

        if (empty($_FILES["$idIndicador-$idAcordeon"]))

        {

            echo json_encode(['error'=>'No hay imagen.']);

            return;

        }

        $images = $_FILES["$idIndicador-$idAcordeon"];

        $success = null;

        $paths= [];

        $filenames = $images['name'];



        if(!file_exists("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/") && !is_dir("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/")) {

            mkdir("assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/");

        }

        for($i=0; $i < count($filenames); $i++){

            $ext = explode('.', basename($filenames[$i]));

            $nombre=DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);

            $target = "assets/img/fotoAnalisisRiesgo/$idFormularioAsignacion/" . $nombre;

            //  echo "entra $nombre";

            if(move_uploaded_file($images['tmp_name'][$i], $target))

            {

                $this->borrarFoto($idFormulario, $idFormularioAsignacion, $idIndicador, $idAcordeon);

                $data=Array('idFormularioAsignacion' => $idFormularioAsignacion,'foto'=>$nombre, 'idIndicador' => $idIndicador, 'idAcordeon' => $idAcordeon);

                //AQUI VA A GUARDAR EN LA BASE DE DATOS

                $this->visitaAnalisis->actualizarImagen($data, 'FormularioFotos');

                $success = true;

                $paths[] = $target;

            } else {

                $success = false;

                break;

            }

        }

        if ($success === true) {

            $output = [];

        }

        elseif ($success === false)

        {

            $output = ['error'=>'Error al subir las imagenes. Por favor, contacte al administrador'];

            foreach ($paths as $file)

            {

                unlink($file);

            }

        }

        else

        {

            $output = ['error'=>'No hay archivos para procesar.'];

        }

        echo json_encode($output);

    }

    function subirFilaTabla($idAcordeon, $contadorTotal, $idFormularioAsignacion)

    {

        $idTabla=$this->visitaAnalisis->crearFilaTabla($idAcordeon, $idFormularioAsignacion);

        for($i=0; $i<$contadorTotal;$i++)

        {

            $idIndicador=$this->input->post('idAcordeonIndicador'.$i);

            $valor=$this->input->post('idIndicAcordeon'.$i);

            $arreglo=array('idFormularioTablaAcordeon' => $idTabla, 'idIndicador' => $idIndicador, 'valor' => $valor);

            $this->visitaAnalisis->insertarFilaTabla('FormularioAlmacenamientoAcordeon', $arreglo);



        }

        echo $idTabla;

    }

    function eliminarFilaTabla($idFila)

    {

        $this->visitaAnalisis->eliminarFilaTabla($idFila);

    }

    function obtenerFotosFila($idFila)

    {

        echo json_encode($this->visitaAnalisis->obtenerFotosFila($idFila));

    }

    function guardarHistoricoFormulario($idAsignacion, $idUsuario)

    {

        $array=array('idAsignacion' =>$idAsignacion, 'idUser' => $idUsuario, 'fechaCaptura' => date("Y-m-d"));

        $this->visitaAnalisis->insertarHistoricoFormulario($array);

        echo json_encode("1");

    }





}